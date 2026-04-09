<?php
session_start();
include('config/db.php');

// Security: Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all medicines
$query = "SELECT * FROM medicines ORDER BY medicine_name ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management - Pharmacy System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #2a5f3d; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .card { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .table thead { background-color: #f8f9fa; border-bottom: 2px solid #2a5f3d; }
        .btn-success { background-color: #2a5f3d; border: none; }
        .btn-success:hover { background-color: #214d31; }
        .badge-cat { font-size: 0.8rem; padding: 0.5em 0.8em; border-radius: 20px; background-color: #6c757d; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark mb-4 p-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="home.php">
            <i class="bi bi-capsule-pill me-2"></i> Pharmacy Inventory
        </a>
        <a href="home.php" class="btn btn-sm btn-outline-light px-3">Back to Dashboard</a>
    </div>
</nav>

<div class="container">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-success fw-bold mb-0">Stock Overview</h3>
            <button class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#addMedicineModal">
                <i class="bi bi-plus-circle me-2"></i> Add New Medicine
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="py-3">ID</th>
                        <th class="py-3">Medicine Name</th>
                        <th class="py-3">Category</th>
                        <th class="py-3">Price (₹)</th>
                        <th class="py-3">Stock Qty</th>
                        <th class="py-3">Expiry Date</th>
                        <th class="py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="text-muted"><?php echo $row['id']; ?></td>
                        <td class="fw-bold text-dark"><?php echo $row['medicine_name']; ?></td>
                        <td><span class="badge-cat"><?php echo $row['category']; ?></span></td>
                        <td>₹<?php echo number_format($row['price'], 2); ?></td>
                        <td>
                            <?php if($row['stock_quantity'] < 20): ?>
                                <span class="text-danger fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i><?php echo $row['stock_quantity']; ?></span>
                            <?php else: ?>
                                <span class="text-dark"><?php echo $row['stock_quantity']; ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $row['expiry_date']; ?></td>
                        <td class="text-center">
                            <a href="delete_medicine.php?id=<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('Are you sure you want to delete this medicine?')">
                               <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold">Add New Stock</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form action="add_medicine_action.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase">Medicine Name</label>
                        <input type="text" name="medicine_name" class="form-control bg-light" placeholder="e.g. Paracetamol" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-uppercase">Category</label>
                            <select name="category" class="form-select bg-light">
                                <option value="Tablet">Tablet</option>
                                <option value="Capsule">Capsule</option>
                                <option value="Syrup">Syrup</option>
                                <option value="Injection">Injection</option>
                                <option value="Supplement">Supplement</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-uppercase">Price (₹)</label>
                            <input type="number" step="0.01" name="price" class="form-control bg-light" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-uppercase">Stock Qty</label>
                            <input type="number" name="stock_quantity" class="form-control bg-light" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-uppercase">Expiry Date</label>
                            <input type="date" name="expiry_date" class="form-control bg-light" required>
                        </div>
                    </div>
                    <button type="submit" name="add_medicine_btn" class="btn btn-success w-100 py-2 mt-3 fw-bold">SAVE TO INVENTORY</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
include('config/db.php');
// ... rest of your code
<?php
session_start();
include('config/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM medicines ORDER BY medicine_name ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        .navbar { background-color: #2a5f3d; }
        .card { border-radius: 15px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<nav class="navbar navbar-dark mb-4 p-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="home.php"><i class="bi bi-capsule-pill me-2"></i> Pharmacy Inventory</a>
        <a href="home.php" class="btn btn-sm btn-outline-light px-3">Back to Dashboard</a>
    </div>
</nav>

<div class="container">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-success fw-bold mb-0">Stock Overview</h3>
            <button class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#addMedicineModal">
                <i class="bi bi-plus-circle me-2"></i> Add New Medicine
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Medicine Name</th>
                        <th>Category</th>
                        <th>Price (₹)</th>
                        <th>Stock Qty</th>
                        <th>Expiry Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td class="fw-bold"><?php echo $row['medicine_name']; ?></td>
                        <td><span class="badge bg-secondary"><?php echo $row['category']; ?></span></td>
                        <td>₹<?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo $row['stock_quantity']; ?></td>
                        <td><?php echo $row['expiry_date']; ?></td>
                        <td class="text-center">
                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] !== 'Customer'): ?>
                                <a href="delete_medicine.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Are you sure?')">
                                   <i class="bi bi-trash"></i>
                                </a>
                            <?php else: ?>
                                <span class="text-muted small">View Only</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
include('config/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch medicines
$result = mysqli_query($conn, "SELECT * FROM medicines ORDER BY medicine_name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pharmacy Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-success p-3 mb-4">
    <div class="container">
        <span class="navbar-brand">Pharmacy System | Logged in as: <?php echo $_SESSION['role']; ?></span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container">
    <div class="card shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-success">Stock Overview</h3>
            <?php if($_SESSION['role'] !== 'Customer'): ?>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMedicineModal">Add Medicine</button>
            <?php endif; ?>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Expiry</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['medicine_name']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td>₹<?php echo $row['price']; ?></td>
                    <td><?php echo $row['stock_quantity']; ?></td>
                    <td><?php echo $row['expiry_date']; ?></td>
                    <td class="text-center">
                        <?php if($_SESSION['role'] !== 'Customer'): ?>
                            <a href="delete_medicine.php?id=<?php echo $row['id']; ?>" class="text-danger" onclick="return confirm('Delete this?')"><i class="bi bi-trash"></i></a>
                        <?php else: ?>
                            <span class="badge bg-light text-dark border">Read-Only</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
