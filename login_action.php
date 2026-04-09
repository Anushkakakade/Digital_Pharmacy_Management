<?php
session_start();
include('config/db.php'); // Uses your updated Anushka@16 password

if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Fetch user and role from database
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Store session data
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name']; 
        $_SESSION['role'] = $user['role'];

        $role = $user['role'];

        // Redirection based on your specific filenames
        if ($role == 'Admin') {
            header("Location: dashboard.php");
        } 
        elseif ($role == 'Pharmacist') {
            header("Location: home.php");
        } 
        else {
            // This is for the 'Customer' role
            header("Location: customer_home.php");
        }
        exit();
    } else {
        echo "<script>alert('Error: Invalid Email or Password!'); window.location.href='login.php';</script>";
    }
}
?>
