<?php
session_start();
include('config/db.php');

if (isset($_POST['login_btn'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // ⚠️ do NOT use mysqli_real_escape_string here

    // Step 1: Fetch user by email ONLY
    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        // 🔥 Step 2: Verify hashed password
        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            $role = strtolower($user['role']); // 🔥 important

            // Step 3: Role-based redirect
            if ($role == 'admin') {
                header("Location: dashboard.php");
            } elseif ($role == 'pharmacist') {
                header("Location: home.php");
            } else {
                header("Location: customer_home.php");
            }

            exit();

        } else {
            echo "<script>alert('Invalid Password!'); window.location.href='login.php';</script>";
        }

    } else {
        echo "<script>alert('User not found!'); window.location.href='login.php';</script>";
    }
}
?>
