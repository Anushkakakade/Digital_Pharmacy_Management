<?php
session_start();
include('../config/db.php'); // Note the ../ because we are inside the pharmacist folder

// Security check
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'pharmacist') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS Billing - Pharmacy System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        .navbar-pharmacy { background-color: #2a5f3d; }
        .billing-card { border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .btn-generate { background-color: #2a5f3d; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-pharmacy mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../home.php">
            <i class="bi bi-capsule"></i> Pharmacy POS
        </a>
        <div class="navbar-text text-white">
            Pharmacist: <?php echo $_SESSION['user_name']; ?>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card billing-card p-4">
                <h5 class="text-success fw-bold mb-3">Add Medicine</h5>
                <form id="billingForm">
                    <div class="mb-3">
                        <label class="form-label small">Medicine ID / Barcode</label>
                        <input type="text" class="form-control" placeholder="Scan or type ID" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Quantity</label>
                        <input type="number" class="form-control" value="1" min="1">
                    </div>
                    <button type="submit" class="btn btn-generate w-100">Add to List</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card billing-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-success fw-bold">Current Bill</h5>
                    <button class="btn btn-sm btn-outline-danger">Clear All</button>
                </div>
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Medicine Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No medicines added yet.</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="text-end">
                    <h4>Total Amount: <span class="text-success">₹0.00</span></h4>
                    <button class="btn btn-success btn-lg px-5 mt-2">Generate Final Bill</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
