<?php
session_start();
include('config/db.php');

if (isset($_POST['register_btn'])) {
    // FIX 1: Use ?? to prevent "Undefined array key" warnings
    $name = mysqli_real_escape_string($conn, $_POST['full_name'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = mysqli_real_escape_string($conn, $_POST['role'] ?? 'Customer');

    // Basic Validation
    if (empty($name) || empty($email) || empty($password)) {
        echo "<script>alert('Please fill all fields!'); window.location='register.php';</script>";
        exit();
    }

    // FIX 2: Check for Duplicate Email before INSERT
    $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($check_email_run) > 0) {
        // This replaces the "Fatal Error" with a nice alert
        echo "<script>alert('This email is already registered. Please Login.'); window.location='login.php';</script>";
        exit();
    } else {
        // Hash password and Insert
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registered Successfully!'); window.location='login.php';</script>";
            exit();
        } else {
            die("Database Error: " . mysqli_error($conn));
        }
    }
} else {
    header("Location: register.php");
    exit();
}
?>
