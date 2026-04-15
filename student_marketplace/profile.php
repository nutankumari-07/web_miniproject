<?php
error_reporting(0);

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include("includes/navbar.php"); ?>

<div class="profile-container">
<div class="profile-box">

<h2>My Profile</h2>

<p><strong>Name:</strong> <?php echo $_SESSION['name'] ?? "Not Available"; ?></p>
<p><strong>Email:</strong> <?php echo $_SESSION['email'] ?? "Not Available"; ?></p>

<br>

<a href="orders.php" class="btn">My Orders</a>
<a href="wishlist.php" class="btn-outline">Wishlist</a>

</div>
</div>

</body>
</html>