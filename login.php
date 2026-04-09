<?php
session_start();
include('config/db.php'); // Ensure Anushka@16 password is set in this file

$error_msg = "";
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: customer_home.php");
        exit();
    } else {
        $error_msg = "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Portal | Secure Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            /* Restoring the professional pill background */
            background: linear-gradient(rgba(233, 240, 254, 0.6), rgba(255, 255, 255, 0.8)), 
                        url('https://images.unsplash.com/photo-1587854680352-936b22b91030?q=80&w=2069');
            background-size: cover;
            background-position: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            backdrop-filter: blur(3px); /* Matching your reference blur */
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 50px 40px;
            border-radius: 28px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .icon-circle {
            width: 85px;
            height: 85px;
            background-color: #e6f4f1;
            border-radius: 50%;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2d6a4f;
            font-size: 2.5rem;
            border: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(45, 106, 79, 0.1);
        }

        .login-title {
            color: #2d6a4f; /* Signature pharmacy green */
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 1.8rem;
        }

        .subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 35px;
        }

        /* Styling inputs with the light-blue tint */
        .form-control {
            background-color: #e9f0fe; 
            border: 1px solid #dce7ff;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #40916c;
            box-shadow: 0 0 0 4px rgba(64, 145, 108, 0.1);
            outline: none;
        }

        .btn-login {
            background-color: #40916c; 
            border: none;
            color: white;
            padding: 15px;
            width: 100%;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: #2d6a4f;
            transform: translateY(-2px);
        }

        .footer-link {
            margin-top: 25px;
            font-size: 0.9rem;
            color: #64748b;
        }

        .footer-link a {
            color: #2d6a4f;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="icon-circle">
        <i class="bi bi-capsule-pill"></i>
    </div>
    
    <h2 class="login-title">Pharmacy Login</h2>
    <p class="subtitle">Enter your credentials to manage your inventory.</p>
    
    <?php if($error_msg): ?>
        <div class="alert alert-danger py-2 small mb-3"><?php echo $error_msg; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-1 text-start">
            <label class="small fw-bold text-muted ms-1">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
        </div>
        <div class="mb-1 text-start">
            <label class="small fw-bold text-muted ms-1">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••••••" required>
        </div>
        
        <button type="submit" name="login" class="btn btn-login">Login to System</button>
    </form>

    <div class="footer-link">
        Don't have an account? <a href="register.php">
