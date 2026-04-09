<?php
session_start();
include('config/db.php'); // Ensure this file exists with your MySQL password

$error_msg = "";
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Checking for the user
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Start sessions for the new attractive dashboard
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: customer_home.php");
        exit();
    } else {
        $error_msg = "Incorrect Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PHARMA Portal | Secure Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { --primary-green: #2d6a4f; --dark-green: #1b4332; }
        
        body {
            /* REPLACED BLACK: Light blue-to-white gradient for 'digital' feel */
            background: linear-gradient(135deg, #e9f0fe 0%, #ffffff 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            color: #1a202c;
        }

        /* Centered Login Card */
        .login-card {
            background: #ffffff;
            padding: 50px 45px;
            border-radius: 25px; /* Softer rounded corners */
            width: 100%;
            max-width: 480px;
            box-shadow: 0 15px 50px rgba(16, 114, 82, 0.08); /* Soft green-tinted shadow */
            text-align: center;
            border: 1px solid rgba(16, 114, 82, 0.1);
        }

        /* ADDED IN AVATAR SPACE: Medical Flask & Cross Icon */
        .avatar-box {
            width: 90px; height: 90px;
            background-color: #dce7ff;
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex; align-items: center; justify-content: center;
            border: 3px solid #f0f4ff;
        }
        .avatar-box img {
            width: 55%;
            opacity: 0.9;
        }

        .login-title {
            color: var(--primary-green); /* Matching your reference */
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 2.2rem;
        }
        .subtitle {
            color: #718096;
            font-size: 0.95rem;
            margin-bottom: 40px;
        }

        /* Input Styling */
        .form-control {
            background-color: #e9f0fe; 
            border: 1px solid #dce7ff;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1rem;
            color: #1a202c;
        }
        .form-control:focus {
            background-color: #ffffff;
            border-color: #40916c;
            box-shadow: 0 0 0 3px rgba(64, 145, 108, 0.1);
            outline: none;
        }

        /* Professional Green Button */
        .btn-login {
            background-color: #40916c; 
            border: none;
            color: white;
            padding: 16px;
            width: 100%;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: 0.3s ease;
            margin-top: 10px;
        }
        .btn-login:hover {
            background-color: #2d6a4f;
            transform: translateY(-2px);
            color: white;
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            color: #718096;
            font-size: 0.9rem;
        }
        .footer-text a {
            color: #40916c;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="avatar-box shadow-inner">
        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0ODUgNDg1IiBmaWxsPSIjNDQ0Ij48cGF0aCBkPSJNMjQyLjUgOTBhNzUuMSA3NS4xIDAgMSA0NDUgNDQgNDQuNS00NC41LTQ0LjUtNzUuMS03NS4xaC03NS4xaC03NS4xSDI0Mi41djQ0LjV6bTAtNTQuNWExMzAgMTMwIDAgMSA0NDQgNCA0NC41LTQ0LjUtNDQuNS0xMjkuNjk5LTEyOS42OTljLTc1LjEtNzUuMUgyNDI.nY0NC41ek0yNDIuNSAxNjVhMTE4LjcgMTE4LjcgMCAxIDUzMy41IDI4LjcgNDQuNS00NC41LTQ0LjUtMTE4LjctMTE4LjdIMjQyLjV2NDQuNXptMCA4OS45YTU4IDU4IDAgMSA4ODkgNCA0NC41LTQ0LjUtNDQuNS05OC45LTk4LjljLTc1LjEtNzUuMUgyNDIuNnY0NC41ek00NjguMSA0MTNhMTEuNSAxMS41IDAgMCAxLTUuNiAyMy4yTDQwMC41IDQ2NWwtNjcuNSA2Ny41YTEwLjY5OSAxMC42OTkgMCAwIDE tMjMuMkw0MTMuMUgzNTYuNGMtNDMuMS00My4xLTgyLjctODUuMy0xMjEtMTI3LjEtMzkuMyA0My4xLTgyLjctODYuMS0xMjcuMSAxMjcuMUg3MS42YTEwLjY5OSAxMC42OTkgMCAwIDE tMjMuMkwxMTQuOSA0NjVMMTIuOSA0MTNhMTEuNSAxMS41IDAgMCAxIDUuNiAyMy4yTDg0LjUgMzI0LjNjNDUuOCAzMyA5Mi4xIDY1IDEzOS40IDk3LjdWNDc1LjljMCAxOS42IDE1LjkgMzUuNSAzNS41IDM1LjVoMjE1YzE5LjYgMCAzNS41LTE1LjkgMzUuNS0zNS41di0xNTEuOGM0Ny4zLTMyLjcgOTMuNi02NC44IDEzOS40LTk3LjdMODQgMzE4LjNWNDEzeiIvPjwvc3ZnPg==" alt="Digital Pharmacy Icon">
    </div>
    
    <h2 class="login-title">Pharmacy Login</h2>
    <p class="subtitle">Welcome back! Access your professional healthcare portal.</p>
    
    <?php if(!empty($error_msg)): ?>
        <div class="alert alert-danger text-center py-2" style="font-size: 0.85rem;">
            <?php echo $error_msg; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
        </div>
        <div class="mb-4">
            <input type="password" name="password" class="form-control" placeholder="••••••••••••" required>
        </div>
        
        <button type="submit" name="login" class="btn btn-login">Login to System</button>
    </form>

    <div class="footer-text">
        Don't have an account? <a href="register.php">Create Account</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
