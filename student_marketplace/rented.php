<?php
session_start();
include("includes/navbar.php");

$orders = @simplexml_load_file("xml/orders.xml");
$products = @simplexml_load_file("xml/products.xml");

?>

<h2 class="section-title">🛒 Rented Items</h2>

<div class="product-grid">

<?php

if(!isset($orders->order)){
    echo "<h3 style='width:100%; text-align:center;'>No rented items yet 😢</h3>";
}

foreach($orders->order as $o){
    foreach($products->product as $p){
        if($p->id == $o->product_id){
?>

    <div class="card">

        <div class="img-box">
            <img src="assets/images/<?php echo $p->image; ?>">
        </div>

        <h3><?php echo $p->name; ?></h3>
        <p class="price">₹<?php echo $p->rent; ?> / day</p>

        <p>📅 Rented for <?php echo $o->days; ?> days</p>

    </div>

<?php
        }
    }
}
?>

</div>

<?php include("includes/footer.php"); ?>