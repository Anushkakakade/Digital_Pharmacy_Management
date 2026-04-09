<?php
session_start();
include('config/db.php');

if(isset($_POST['place_order_btn'])) {
    $id = $_POST['medicine_id'];
    $qty = (int)$_POST['quantity'];

    // Check if stock exists
    $query = "SELECT medicine_name, stock_quantity FROM medicines WHERE id = '$id'";
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);

    if($data['stock_quantity'] >= $qty) {
        $new_qty = $data['stock_quantity'] - $qty;
        
        // Update stock
        $update = "UPDATE medicines SET stock_quantity = '$new_qty' WHERE id = '$id'";
        if(mysqli_query($conn, $update)) {
            echo "<script>alert('Success: Order placed for " . $data['medicine_name'] . "!'); window.location='customer_home.php';</script>";
        }
    } else {
        echo "<script>alert('Error: Not enough stock! Only " . $data['stock_quantity'] . " left.'); window.location='customer_home.php';</script>";
    }
}
?>
