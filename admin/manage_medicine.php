<?php
include("../config/db.php");

$result = $conn->query("SELECT * FROM medicines");

while($row = $result->fetch_assoc()){
    echo $row['name']." - ".$row['quantity']."<br>";
}
?>
