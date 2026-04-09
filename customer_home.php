<?php
session_start();
include('config/db.php'); // Ensure your DB connection is working
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pharma | Healthcare at Your Doorstep</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root { --brand-green: #107252; --soft-bg: #f8f9fa; }
        body { font-family: 'Inter', sans-serif; background-color: var(--soft-bg); }

        /* Navigation Style */
        .navbar { background: white; border-bottom: 1px solid #eee; padding: 15px 0; }
        .nav-link { font-weight: 600; color: #444 !important; font-size: 0.9rem; margin: 0 10px; }

        /* Hero Banner */
        .hero-banner { 
            background: linear-gradient(90deg, #134e4a 0%, #107252 100%); 
            color: white; padding: 60px 0; border-radius: 0 0 40px 40px; 
            margin-bottom: 40px;
        }
        .search-box { 
            background: white; border-radius: 12px; padding: 10px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-top: 20px;
        }

        /* Quick Service Cards */
        .service-card {
            background: white; border: 1px solid #edf2f7; border-radius: 20px;
            padding: 25px; transition: 0.3s ease; height: 100%;
            text-decoration: none; display: block; color: inherit;
        }
        .service-card:hover { transform: translateY(-5px); border-color: var(--brand-green); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .icon-box { 
            width: 60px; height: 60px; border-radius: 15px; 
            display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin-bottom: 15px;
        }

        /* Category Grid */
        .cat-item {
            background: white; border-radius: 12px; padding: 20px; border: 1px solid #eee;
            text-align: left; transition: 0.2s;
        }
        .cat-item:hover { background: #e6f4f1; }

        .section-title { font-weight: 700; color: #1a202c; margin-bottom: 25px; }
    </style>
</head>
<body>

<nav class="navbar sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-success" href="#">
            <i class="bi bi-capsule me-2"></i>E-PHARMA
        </a>
        <div class="d-none d-md-flex">
            <a href="#" class="nav-link">Buy Medicines</a>
            <a href="#" class="nav-link">Find Doctors</a>
            <a href="#" class="nav-link">Lab Tests</a>
            <a href="#" class="nav-link">Health Records</a>
        </div>
        <div class="ms-auto d-flex align-items-center">
            <span class="me-3 small text-muted d-none d-lg-inline">Welcome, <strong>Anushka</strong></span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm rounded-pill px-3">Logout</a>
        </div>
    </div>
</nav>

<div class="hero-banner">
    <div class="container text-center">
        <h1 class="display-6 fw-bold">Buy Medicines and Essentials</h1>
        <p class="opacity-75">Get 20%* off on your first order. Delivered within 60 mins.</p>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="search-box d-flex">
                    <input type="text" class="form-control border-0 px-4" placeholder="Search Medicines, Health Products...">
                    <button class="btn btn-success px-4 fw-bold rounded-3" style="background: var(--brand-green);">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <a href="medicines.php" class="service-card">
                <div class="icon-box bg-success-subtle text-success"><i class="bi bi-bag-plus"></i></div>
                <h5 class="fw-bold">Buy Medicines</h5>
                <p class="text-muted small">Flat 20% OFF on all prescription drugs.</p>
            </a>
        </div>
        <div class="col-md-3">
            <a href="#" class="service-card">
                <div class="icon-box bg-primary-subtle text-primary"><i class="bi bi-person-video3"></i></div>
                <h5 class="fw-bold">Find Doctors</h5>
                <p class="text-muted small">Consult top specialists via video call.</p>
            </a>
        </div>
        <div class="col-md-3">
            <a href="#" class="service-card">
                <div class="icon-box bg-danger-subtle text-danger"><i class="bi bi-microscope"></i></div>
                <h5 class="fw-bold">Lab Tests</h5>
                <p class="text-muted small">Sample collection from your home.</p>
            </a>
        </div>
        <div class="col-md-3">
            <a href="#" class="service-card">
                <div class="icon-box bg-warning-subtle text-warning"><i class="bi bi-heart-pulse"></i></div>
                <h5 class="fw-bold">Health Insurance</h5>
                <p class="text-muted small">Secure your family with premium plans.</p>
            </a>
        </div>
    </div>

    <h4 class="section-title">Browse by Health Conditions</h4>
    <div class="row g-3 mb-5">
        <?php 
        $conditions = [
            ['Diabetes Care', 'bi-droplet', '65% off'],
            ['Cardiac Care', 'bi-heart', 'Upto 40% off'],
            ['Stomach Care', 'bi-activity', 'Upto 30% off'],
            ['Pain Relief', 'bi-bandaid', 'Flat 20% off'],
            ['Personal Care', 'bi-person', 'Upto 80% off'],
            ['Summer Store', 'bi-sun', 'Best Sellers']
        ];
        foreach($conditions as $c) { ?>
        <div class="col-md-4 col-lg-2">
            <div class="cat-item">
                <i class="bi <?php echo $c[1]; ?> h4 text-success d-block mb-2"></i>
                <h6 class="fw-bold mb-1 small"><?php echo $c[0]; ?></h6>
                <span class="text-success fw-bold" style="font-size: 0.75rem;"><?php echo $c[2]; ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
