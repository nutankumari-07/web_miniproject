<?php
session_start();
include("includes/navbar.php");

// LOAD FILES
$orders = @simplexml_load_file("xml/orders.xml");
$products = @simplexml_load_file("xml/products.xml");

if(!$orders){
    $orders = simplexml_load_string("<orders></orders>");
}
?>

<h2 class="section-title">📦 My Orders</h2>

<div class="product-grid">

<?php

// EMPTY STATE
if(!isset($orders->order)){
    echo "<h3 style='width:100%; text-align:center;'>No orders yet 😢</h3>";
}

// LOOP ORDERS
foreach($orders->order as $o){

    foreach($products->product as $p){

        if($p->id == $o->product_id){

?>

    <div class="card">

        <!-- IMAGE -->
        <div class="img-box">
            <img src="assets/images/<?php echo $p->image; ?>" alt="<?php echo $p->name; ?>">
        </div>

        <!-- NAME -->
        <h3><?php echo $p->name; ?></h3>

        <!-- PRICE -->
        <p class="price">₹<?php echo $p->rent; ?> / day</p>

        <!-- DAYS -->
        <p>📅 Days: <?php echo $o->days; ?></p>

        <!-- TOTAL -->
        <p><strong>Total: ₹<?php echo ($p->rent * $o->days); ?></strong></p>

    </div>

<?php
        }
    }
}
?>

</div>

<?php include("includes/footer.php"); ?>