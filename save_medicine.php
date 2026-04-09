<?php
session_start();
include('config/db.php');

if (isset($_POST['save_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    // Checkbox logic: if checked it's 1, else 0
    $prescription = isset($_POST['prescription']) ? 1 : 0;

    $query = "INSERT INTO medicines (name, category, price, stock_quantity, prescription_required) 
              VALUES ('$name', '$category', '$price', '$stock', '$prescription')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['status'] = "Medicine Added Successfully!";
        header("Location: dashboard.php");
    } else {
        $_SESSION['status'] = "Error: " . mysqli_error($conn);
        header("Location: dashboard.php");
    }
}
?>
<div class="col-md-3">
    <a href="add_medicine.php" class="btn btn-light w-100 p-3 rounded-4 border text-start shadow-sm">
        <i class="bi bi-plus-circle text-success me-2"></i> Add Medicine
    </a>
</div>
