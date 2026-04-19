<?php
session_start();

// LOAD FILES
$orders = @simplexml_load_file("xml/orders.xml");
$products = @simplexml_load_file("xml/products.xml");

if(!$orders){
    $orders = simplexml_load_string("<orders></orders>");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rented Items</title>
    <link rel="stylesheet" href="/student_marketplace/css/style.css">
</head>
<body>

<?php include("includes/navbar.php"); ?>

<div class="container">
    <h2 class="page-title">🛒 Rented Items</h2>

    <div class="product-grid">

    <?php
    if(!isset($orders->order)){
        echo "<h3 style='width:100%; text-align:center;'>No rented items yet 😢</h3>";
    }

    foreach($orders->order as $o){
        foreach($products->product as $p){
            if($p->id == $o->product_id){
    ?>

        <div class="product-card">
            <img src="assets/images/<?php echo $p->image; ?>">

            <div class="card-body">
                <h3><?php echo $p->name; ?></h3>
                <p class="price">₹<?php echo $p->price; ?></p>

                <p>Return by: <?php echo $o->return_date ?? 'N/A'; ?></p>
            </div>
        </div>

    <?php
            }
        }
    }
    ?>

    </div>
</div>

<?php include("includes/footer.php"); ?>

</body>
</html>