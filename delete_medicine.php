<?php
include('config/db.php');

// Get the ID from the URL
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    // Delete query
    $query = "DELETE FROM medicines WHERE id = $id";
    
    if(mysqli_query($conn, $query)){
        // Redirect back to inventory with a success message
        header("Location: inventory.php?msg=deleted");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?><?php
include('config/db.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM medicines WHERE id=$id");
    header("Location: inventory.php");
}
?>
