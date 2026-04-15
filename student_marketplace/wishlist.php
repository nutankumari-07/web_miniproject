<?php
session_start();
include("includes/navbar.php");

// INIT
if(!isset($_SESSION['wishlist'])){
    $_SESSION['wishlist'] = [];
}

// ADD ITEM
if(isset($_GET['add'])){
    if(!in_array($_GET['add'], $_SESSION['wishlist'])){
        $_SESSION['wishlist'][] = $_GET['add'];
    }
}

// REMOVE ITEM ✅
if(isset($_GET['remove'])){
    $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [$_GET['remove']]);
}

// LOAD XML
$xml = simplexml_load_file("xml/products.xml");
?>

<h2 class="section-title">Your Wishlist</h2>

<div class="product-grid">

<?php
// EMPTY STATE ✅
if(empty($_SESSION['wishlist'])){
    echo "<h3 style='text-align:center;width:100%;'>Your wishlist is empty 💔</h3>";
}

// LOOP PRODUCTS
foreach($_SESSION['wishlist'] as $id){
    foreach($xml->product as $p){
        if($p->id == $id){
?>

    <div class="card">

        <!-- IMAGE -->
        <div class="img-box">
            <img src="assets/images/<?php echo htmlspecialchars($p->image); ?>" alt="<?php echo htmlspecialchars($p->name); ?>">
        </div>

        <!-- NAME -->
        <h3><?php echo htmlspecialchars($p->name); ?></h3>

        <!-- PRICE -->
        <p class="price">₹<?php echo $p->rent; ?> / day</p>

        <!-- BUTTONS -->
        <div style="display:flex; gap:10px; justify-content:center;">

            <a href="product.php?id=<?php echo $p->id; ?>">
                <button class="btn">View</button>
            </a>

            <a href="wishlist.php?remove=<?php echo $p->id; ?>">
                <button class="btn-outline">❌</button>
            </a>

        </div>

    </div>

<?php
        }
    }
}
?>

</div>

<?php include("includes/footer.php"); ?>