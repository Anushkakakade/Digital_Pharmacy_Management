<?php
$result = $conn->query("SELECT * FROM medicines 
WHERE quantity < 10 OR expiry_date < CURDATE() + INTERVAL 7 DAY");

while($row = $result->fetch_assoc()){
    echo "Alert: ".$row['name']."<br>";
}
?>
