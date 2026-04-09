<?php
session_start();
include('config/db.php');

// Fetch medicines for the dropdown
$med_query = "SELECT * FROM medicines WHERE stock_quantity > 0";
$med_result = mysqli_query($conn, $med_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Bill - Pharmacy System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Generate Billing</h4>
        </div>
        <div class="card-body">
            <form action="process_bill.php" method="POST">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Select Medicine</label>
                        <select name="medicine_id" class="form-select" required>
                            <?php while($row = mysqli_fetch_assoc($med_result)): ?>
                                <option value="<?php echo $row['id']; ?>">
                                    <?php echo $row['medicine_name']; ?> (₹<?php echo $row['price']; ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control" min="1" required>
                    </div>
                </div>
                <button type="submit" name="generate_bill" class="btn btn-primary">Generate & Print Bill</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
