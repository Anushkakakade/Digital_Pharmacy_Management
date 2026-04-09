<?php
session_start();
include('config/db.php');

if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Plain text check for debugging - easiest way to get back in
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name']; 
        $_SESSION['role'] = $user['role'];

        // Redirecting to your dashboard
        header("Location: customer_home.php");
        exit();
    } else {
        echo "<script>alert('Error: Check your Email or Password in the Database!'); window.location.href='login.php';</script>";
    }
}
?>
