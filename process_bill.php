<?php
include('config/db.php');

if (isset($_POST['generate_bill'])) {
    $medicine_id = $_POST['medicine_id'];
    $qty_sold = $_POST['qty'];

    // 1. Get current price and stock
    $res = mysqli_query($conn, "SELECT * FROM medicines WHERE id = $medicine_id");
    $med = mysqli_fetch_assoc($res);

    if ($med['stock_quantity'] < $qty_sold) {
        die("Error: Not enough stock available!");
    }

    $total_amount = $med['price'] * $qty_sold;
    $med_name = $med['medicine_name'];
    $unit_price = $med['price'];

    // 2. Insert into Sales table
    mysqli_query($conn, "INSERT INTO sales (medicine_id, medicine_name, quantity_sold, unit_price, total_amount) 
                         VALUES ($medicine_id, '$med_name', $qty_sold, $unit_price, $total_amount)");

    // 3. Update (Reduce) Stock in Medicines table
    mysqli_query($conn, "UPDATE medicines SET stock_quantity = stock_quantity - $qty_sold WHERE id = $medicine_id");

    echo "<h1>Bill Generated Successfully!</h1>";
    echo "<p>Medicine: $med_name <br> Total: ₹$total_amount</p>";
    echo "<a href='billing.php'>Create another bill</a> | <a href='inventory.php'>Check Inventory</a>";
}
?>
