<?php include('config/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding: 50px; }
        .form-card { background: white; padding: 30px; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .btn-success { background-color: #2d6a4f; border: none; border-radius: 10px; padding: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-card">
                    <h4 class="fw-bold mb-4 text-success">Add New Medicine</h4>
                    <form action="save_medicine.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Medicine Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Paracetamol" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Category</label>
                                <select name="category" class="form-select">
                                    <option>Cardiac Care</option>
                                    <option>Diabetes Care</option>
                                    <option>General</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Price (₹)</label>
                                <input type="number" step="0.01" name="price" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Stock Quantity</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="prescription" class="form-check-input" id="rx">
                            <label class="form-check-label small" for="rx">Prescription Required</label>
                        </div>
                        <button type="submit" name="save_btn" class="btn btn-success w-100 fw-bold">Add to Inventory</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
