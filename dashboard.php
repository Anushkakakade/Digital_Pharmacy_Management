<?php
session_start();
include('config/db.php');

// --- DEBUG MODE (Set to false when you go live) ---
$debug = false; 
if ($debug) {
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = "Yash";
    $_SESSION['role'] = "Admin";
}
// ------------------------------------------------

// 1. Absolute Security Check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php?error=unauthorized");
    exit();
}

// 2. Variable Assignment
$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | E-PHARMA Control Panel</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --pharma-green: #2d6a4f;
            --pharma-bg: #f8faf9;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--pharma-bg);
            color: #1a1a1a;
            margin: 0;
        }

        /* Sidebar Design */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: #ffffff;
            border-right: 1px solid #eef2f0;
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .brand-logo {
            color: var(--pharma-green);
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            margin-bottom: 3rem;
            text-decoration: none;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            flex-grow: 1;
        }

        .nav-item { margin-bottom: 0.5rem; }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #5c635f;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .nav-link i { font-size: 1.25rem; margin-right: 1rem; }

        .nav-link:hover, .nav-link.active {
            background-color: var(--pharma-green);
            color: #ffffff !important;
        }

        /* Main Content Layout */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            padding: 2.5rem;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        /* Stat Cards */
        .stat-card {
            background: #ffffff;
            border: 1px solid #eef2f0;
            border-radius: 20px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            transition: transform 0.3s;
        }

        .stat-card:hover { transform: translateY(-5px); }

        .icon-circle {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1.25rem;
        }

        .bg-soft-green { background-color: #ecf3f0; color: var(--pharma-green); }
        .bg-soft-blue { background-color: #edf2ff; color: #448aff; }

        /* Action Card */
        .action-card {
            border: 2px dashed #d1dbd6;
            border-radius: 20px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5c635f;
            text-decoration: none;
            transition: 0.3s;
        }

        .action-card:hover {
            border-color: var(--pharma-green);
            background: #fff;
            color: var(--pharma-green);
        }

        /* Table Styling */
        .custom-table-card {
            background: #ffffff;
            border-radius: 24px;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
            overflow: hidden;
        }

        .table thead { background-color: #f9fbf9; }
        .table th {
            padding: 1rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #88938e;
            border-bottom: 1px solid #f0f3f1;
        }

        .table td { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f0f3f1; }
    </style>
</head>
<body>

<aside class="sidebar">
    <a href="#" class="brand-logo">
        <i class="bi bi-capsule-pill me-2"></i> E-PHARMA
    </a>
    
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link active">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="customer_home.php" class="nav-link">
                <i class="bi bi-shop"></i> Shop View
            </a>
        </li>
        <li class="nav-item">
            <a href="add_medicine.php" class="nav-link">
                <i class="bi bi-plus-circle"></i> Add Medicine
            </a>
        </li>
    </ul>

    <div class="mt-auto">
        <a href="logout.php" class="btn btn-light w-100 rounded-pill fw-bold text-danger py-2">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
    </div>
</aside>

<main class="main-wrapper">
    <header class="header-top">
        <div>
            <h2 class="fw-bold mb-1">Welcome back, <?php echo $user_name; ?>!</h2>
            <p class="text-muted mb-0">Pharmacy Control Panel Overview</p>
        </div>
        
        <div class="d-flex align-items-center">
            <div class="bg-white px-4 py-2 rounded-pill shadow-sm d-flex align-items-center border">
                <div class="text-end me-3">
                    <p class="small fw-bold mb-0"><?php echo $user_name; ?></p>
                    <p class="text-muted small mb-0" style="font-size: 0.7rem;"><?php echo $user_role; ?></p>
                </div>
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>
        </div>
    </header>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="icon-circle bg-soft-green">
                    <i class="bi bi-wallet2"></i>
                </div>
                <div>
                    <p class="text-muted small fw-bold mb-1">TOTAL SALES</p>
                    <h3 class="fw-bold mb-0">₹45,200</h3>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="stat-card">
                <div class="icon-circle bg-soft-blue">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div>
                    <p class="text-muted small fw-bold mb-1">ACTIVE STOCK</p>
                    <h3 class="fw-bold mb-0">1,240 <span class="small fw-normal text-muted" style="font-size: 0.9rem;">Units</span></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <a href="add_medicine.php" class="action-card py-4">
                <div class="text-center">
                    <i class="bi bi-plus-lg fs-3 d-block mb-1"></i>
                    <span class="fw-bold">Add Medicine</span>
                </div>
            </a>
        </div>
    </div>

    <div class="custom-table-card card">
        <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
            <h5 class="fw-bold mb-0">Recent Inventory Items</h5>
            <a href="#" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Product Details</th>
                        <th>Category</th>
                        <th>Stock Level</th>
                        <th>Price (Unit)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM medicines ORDER BY id DESC LIMIT 5");
                    while($row = mysqli_fetch_assoc($res)) {
                        $stock_class = ($row['stock_quantity'] < 20) ? 'text-danger' : 'text-success';
                    ?>
                    <tr>
                        <td>
                            <div class="fw-bold"><?php echo $row['name']; ?></div>
                            <span class="text-muted small">Batch #PH-<?php echo $row['id']; ?></span>
                        </td>
                        <td><span class="badge bg-light text-dark border px-3 rounded-pill"><?php echo $row['category']; ?></span></td>
                        <td>
                            <div class="fw-bold <?php echo $stock_class; ?>"><?php echo $row['stock_quantity']; ?> Units</div>
                        </td>
                        <td class="fw-bold">₹<?php echo number_format($row['price'], 2); ?></td>
                        <td>
                            <button class="btn btn-sm btn-light rounded-circle text-muted"><i class="bi bi-three-dots"></i></button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
