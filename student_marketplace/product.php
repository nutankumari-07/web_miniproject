<?php
session_start();
include("includes/navbar.php");

$xml = simplexml_load_file("xml/products.xml");

$id = $_GET['id'] ?? 0;
$product = null;

/* FIND PRODUCT SAFELY */
foreach($xml->product as $p){
    if($p->id == $id){
        $product = $p;
        break;
    }
}

if(!$product){
    echo "<h2>Product not found</h2>";
    exit;
}
?>

<div class="product-page">

    <!-- IMAGE -->
    <div class="product-image">
        <img src="assets/images/<?php echo $product->image; ?>">
    </div>

    <!-- DETAILS -->
    <div class="product-details">
        <h2><?php echo $product->name; ?></h2>

        <p class="price">₹<?php echo $product->price; ?> / day</p>

        <p class="desc">
            <?php echo $product->description ?? "No description available"; ?>
        </p>

        <p class="contact">
            📞 Contact: <?php echo $product->contact ?? "Not provided"; ?>
        </p>

        <div class="actions">

            <a href="wishlist.php?add=<?php echo $product->id; ?>">
                <button class="btn-outline">♡ Add to Wishlist</button>
            </a>

            <a href="checkout.php?id=<?php echo $product->id; ?>">
                <button class="btn">Rent Now</button>
            </a>

        </div>
    </div>

</div>

<?php include("includes/footer.php"); ?>