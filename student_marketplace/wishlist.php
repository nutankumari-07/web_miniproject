<?php
session_start();

// INIT WISHLIST
if(!isset($_SESSION['wishlist'])){
    $_SESSION['wishlist'] = [];
}

// ADD ITEM
if(isset($_GET['add'])){
    if(!in_array($_GET['add'], $_SESSION['wishlist'])){
        $_SESSION['wishlist'][] = $_GET['add'];
    }
}

// REMOVE ITEM
if(isset($_GET['remove'])){
    $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [$_GET['remove']]);
}

// LOAD PRODUCTS
$xml = simplexml_load_file("xml/products.xml");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wishlist</title>
    <link rel="stylesheet" href="http://localhost/student_marketplace/css/style.css?v=2">
</head>
<body>

<?php include("includes/navbar.php"); ?>

<div class="container">
    <h2 class="page-title">❤️ My Wishlist</h2>

    <div class="product-grid">

    <?php
    // EMPTY STATE
    if(empty($_SESSION['wishlist'])){
        echo "<h3 style='width:100%; text-align:center;'>Your wishlist is empty 💔</h3>";
    }

    // LOOP THROUGH WISHLIST
    foreach($_SESSION['wishlist'] as $id){
        foreach($xml->product as $p){
            if($p->id == $id){
    ?>

        <!-- PRODUCT CARD -->
        <div class="product-card">
            <img src="assets/images/<?php echo $p->image; ?>" alt="product">

            <div class="card-body">
                <h3><?php echo $p->name; ?></h3>
                <p class="price">₹<?php echo $p->price; ?></p>

                <div class="actions">
                    <a href="cart.php?id=<?php echo $p->id; ?>" class="btn-primary">Rent</a>
                    <a href="?remove=<?php echo $p->id; ?>" class="btn-danger">Remove</a>
                </div>
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