<?php
include('config/db.php');
$res = mysqli_query($conn, "SELECT * FROM medicines");

while($row = mysqli_fetch_assoc($res)) {
    $original_price = $row['price'];
    // Assuming the DB price is the discounted price, calculate MRP:
    $mrp = $original_price / 0.8; 
?>
<div class="col-md-3 mb-4">
    <div class="card border-0 shadow-sm p-3 rounded-4">
        <span class="badge bg-danger mb-2 w-50">20% OFF</span>
        <h6 class="fw-bold"><?php echo $row['name']; ?></h6>
        <p class="text-muted small mb-1"><?php echo $row['category']; ?></p>
        
        <div class="d-flex align-items-center mb-3">
            <span class="text-dark fw-bold h5 mb-0">₹<?php echo number_format($original_price, 2); ?></span>
            <span class="text-muted small text-decoration-line-through ms-2">₹<?php echo number_format($mrp, 2); ?></span>
        </div>
        
        <?php if($row['prescription_required']): ?>
            <p class="text-danger small fw-bold"><i class="bi bi-file-earmark-medical"></i> RX Required</p>
        <?php endif; ?>
        
        <button class="btn btn-outline-success btn-sm rounded-pill w-100">Add to Cart</button>
    </div>
</div>
<?php } ?>
