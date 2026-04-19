<?php
error_reporting(0);

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

// Load XML safely
$xml = @simplexml_load_file("xml/products.xml");
if(!$xml){
    $xml = simplexml_load_string("<products></products>");
}

// Filters
$search = $_GET['search'] ?? "";
$cat    = $_GET['cat'] ?? "";
$max    = $_GET['max'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Campus Market</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include("includes/navbar.php"); ?>

<!-- SUCCESS MESSAGE -->
<?php
if (isset($_SESSION['success'])) {
    echo "<div class='success-box'>".$_SESSION['success']."</div>";
    unset($_SESSION['success']);
}
?>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h1>Your Campus Marketplace</h1>
        <p>Rent & Sell products within your campus</p>

        <div class="hero-buttons">
            <a href="#products" class="btn">Browse Products</a>
            <a href="add-product.php" class="btn-outline">Sell an Item</a>
        </div>
    </div>
</section>

<!-- FILTER -->
<section class="filter-section">
    <form method="GET" class="filter-bar">

        <input type="text" name="search" placeholder="Search products..." value="<?php echo $search; ?>">

        <select name="cat">
            <option value="">All Categories</option>
            <option value="Books" <?php if($cat=="Books") echo "selected"; ?>>Books</option>
            <option value="Electronics" <?php if($cat=="Electronics") echo "selected"; ?>>Electronics</option>
            <option value="Furniture" <?php if($cat=="Furniture") echo "selected"; ?>>Furniture</option>
            <option value="others" <?php if($cat=="others") echo "selected"; ?>>others</option>
        </select>

        <input type="number" name="max" placeholder="Max price" value="<?php echo $max; ?>">

        <button class="btn">Apply</button>
    </form>
</section>

<!-- CATEGORIES -->
<section class="categories">
    <h2 class="section-title">Product Categories Available for Rent</h2>

    <div class="cat-grid">
        <a href="?cat=Books" class="cat-card">📘 Books</a>
        <a href="?cat=Electronics" class="cat-card">💻 Electronics</a>
        <a href="?cat=Furniture" class="cat-card">🪑 Furniture</a>
        <a href="?cat=others" class="cat-card">🎒 others</a>
    </div>
</section>

<!-- PRODUCTS -->
<section class="products" id="products">
    <h2 class="section-title">Available for Rent</h2>

    <div class="product-grid">

<?php
if(isset($xml->product)){
    foreach($xml->product as $p){

        // FILTERS
        if($search && stripos($p->name, $search) === false) continue;
        if($cat && $p->category != $cat) continue;
        if($max && $p->price > $max) continue;

        // SAFE VALUES
        $img = htmlspecialchars($p->image);
        $name = htmlspecialchars($p->name);
        $id = htmlspecialchars($p->id);
        $price = htmlspecialchars($p->price);

        echo "
        <div class='card'>

            <a href='product.php?id=$id'>
                <div class='img-box'>
                    <img src='assets/images/$img' alt='$name'>
                </div>
            </a>

            <h3>$name</h3>

            <p class='price'>₹$price / day</p>

            <div class='card-actions'>
                <a href='product.php?id=$id'>
                    <button class='btn'>Rent</button>
                </a>

                <a href='wishlist.php?add=$id'>
                    <button class='btn-outline'>♡</button>
                </a>
            </div>

        </div>";
    }
}
?>

    </div>
</section>

<?php include("includes/footer.php"); ?>

</body>
</html>