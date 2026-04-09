<?php
session_start();
include('config/db.php');

if (isset($_POST['add_medicine_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['medicine_name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock_quantity']);
    $expiry = mysqli_real_escape_string($conn, $_POST['expiry_date']);

    $query = "INSERT INTO medicines (medicine_name, category, price, stock_quantity, expiry_date) 
              VALUES ('$name', '$category', '$price', '$stock', '$expiry')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: inventory.php?status=success");
    } else {
        header("Location: inventory.php?status=error");
    }
}
?>
