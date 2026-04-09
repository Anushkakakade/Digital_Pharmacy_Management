<?php
include("../config/db.php");

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $category = $_POST['category'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $expiry = $_POST['expiry'];

    $conn->query("INSERT INTO medicines 
    (name,category,quantity,price,expiry_date)
    VALUES('$name','$category','$qty','$price','$expiry')");
}
?>

<form method="POST">
<input name="name" placeholder="Medicine Name">
<input name="category" placeholder="Category">
<input name="qty" type="number">
<input name="price">
<input type="date" name="expiry">
<button name="add">Add Medicine</button>
</form>
