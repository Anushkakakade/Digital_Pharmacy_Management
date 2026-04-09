<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] == 'Customer') {
    header("Location: login.php"); // Customers shouldn't be here
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Pharmacy Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --sidebar-color: #1e293b; }
        .sidebar { background: var(--sidebar-color); min-height: 100vh; color: white; }
        .nav-link { color: #cbd5e1; }
        .nav-link:hover { color: white; background: #334155; }
        .stat-card { border: none; border-radius: 15px; transition: 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-3 d-none d-md-block">
            <h5 class="text-center mb-4 fw-bold text-success">PHARMA-SYS</h5>
            <hr>
            <nav class="nav flex-column">
                <a class="nav-link py-2" href="home.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                <a class="nav-link py-2" href="add_medicine.php"><i class="bi bi-plus-square me-2"></i> Add Medicine</a>
                <a class="nav-link py-2" href="billing.php"><i class="bi bi-cart-check me-2"></i> Sales & Billing</a>
                <a class="nav-link py-2" href="inventory.php"><i class="bi bi-box-seam me-2"></i> Inventory</a>
                <hr>
                <a class="nav-link py-2 text-danger" href="logout.php"><i class="bi bi-power me-2"></i> Logout</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Management Dashboard</h4>
                <span class="badge bg-success-subtle text-success p-2 px-3 border border-success-subtle">
                    User: <?php echo $_SESSION['user_name']; ?> | Role: <?php echo $_SESSION['role']; ?>
                </span>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card stat-card shadow-sm p-4 text-center">
                        <div class="bg-success-subtle p-3 rounded-circle d-inline-block mb-3 mx-auto">
                            <i class="bi bi-capsule text-success fs-1"></i>
                        </div>
                        <h5>Manage Inventory</h5>
                        <p class="text-muted">Stock up on new medicines or update pricing.</p>
                        <a href="add_medicine.php" class="btn btn-success w-100 py-2">Go to Add Medicine</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card stat-card shadow-sm p-4 text-center border-primary-subtle">
                        <div class="bg-primary-subtle p-3 rounded-circle d-inline-block mb-3 mx-auto">
                            <i class="bi bi-receipt-cutoff text-primary fs-1"></i>
                        </div>
                        <h5>Billing Station</h5>
                        <p class="text-muted">Generate instant digital bills for pharmacy customers.</p>
                        <a href="billing.php" class="btn btn-primary w-100 py-2">Open Billing Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
