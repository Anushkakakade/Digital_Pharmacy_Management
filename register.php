<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1586024486164-ce9b3d87e09f?q=80&w=2000');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .register-card {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 450px;
        }
        .btn-success { background-color: #438a5e; border: none; }
        .btn-success:hover { background-color: #356d4a; }
    </style>
</head>
<body>

<div class="register-card">
    <div class="text-center mb-4">
        <div class="mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Profile" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
        </div>
        <h2 class="fw-bold text-success" style="color: #438a5e !important;">Pharmacy Registration</h2>
        <p class="text-muted small">Create an account for the Inventory System</p>
    </div>

    <form action="register_action.php" method="POST">
        
        <div class="mb-3">
            <label class="form-label fw-bold small">Full Name</label>
            <input type="text" name="full_name" class="form-control" placeholder="Enter your name" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small">Email</label>
            <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small">Password</label>
            <input type="password" name="password" class="form-control" placeholder="********" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small">Role</label>
            <select name="role" class="form-select" required>
                <option value="Customer">Customer</option>
                <option value="Pharmacist">Pharmacist</option>
                <option value="Admin">Admin</option>
            </select>
        </div>

        <div class="mt-4">
            <button type="submit" name="register_btn" class="btn btn-success w-100 fw-bold">Register</button>
        </div>

        <div class="text-center mt-3">
            <span class="small">Already registered? <a href="login.php" class="text-success text-decoration-none fw-bold">Login</a></span>
        </div>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
