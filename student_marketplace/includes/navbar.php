<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<nav class="navbar">

    <!-- LEFT: LOGO -->
    <div class="nav-left">
        <a href="index.php" class="logo">CampusMarket</a>
    </div>

    <!-- CENTER: SEARCH -->
    <div class="nav-center">
        <form class="search-box" action="index.php" method="GET">
            <input type="text" name="search" placeholder="Search rentals">
        </form>
    </div>

    <!-- RIGHT: ACTIONS -->
    <div class="nav-right">

<?php if(isset($_SESSION['user'])){ ?>

        <a href="add-product.php" class="nav-link">➕ Add Product</a>
        <a href="wishlist.php" class="nav-link">❤️ Wishlist</a>

        <!-- PROFILE -->
        <div class="profile-menu">

    <button class="profile-btn" onclick="toggleDropdown()">
        👤 <?php echo $_SESSION['name'] ?? "User"; ?>
    </button>

    <div class="dropdown" id="dropdownMenu">
        <a href="profile.php">👤 My Profile</a>
        <a href="orders.php">📦 My Orders</a>
        <a href="rented.php">🛒 Rented Items</a>
        <a href="settings.php">⚙️ Settings</a>
        <a href="wishlist.php">❤️ Wishlist</a>
        <hr>
        <a href="logout.php">🚪 Logout</a>
    </div>

</div>

<?php } else { ?>

        <a href="login.php" class="nav-link">Login</a>
        <a href="signup.php" class="nav-link">Sign Up</a>

<?php } ?>

    </div>

</nav>

<script>
function toggleDropdown() {
    const menu = document.getElementById("dropdownMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

// close when clicking outside
window.onclick = function(e) {
    if (!e.target.closest('.profile-menu')) {
        document.getElementById("dropdownMenu").style.display = "none";
    }
}
</script>
❤️ Wishlist (<?php echo count($_SESSION['wishlist'] ?? []); ?>)