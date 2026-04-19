<?php
include("config/db.php");
include("includes/navbar.php");

if(!isset($_SESSION['user'])){
    echo "Please login to continue.";
    exit;
}

$uid = $_SESSION['user'];
$cart = $_SESSION['cart'];

$pid = $cart['id'];
$days = $cart['days'];
$total = $cart['total'];

$start = date("Y-m-d");
$end = date("Y-m-d", strtotime("+$days days"));

$conn->query("INSERT INTO orders(user_id, product_id, days, start_date, end_date, status)
VALUES($uid,$pid,$days,'$start','$end','active')");

unset($_SESSION['cart']);

echo "<h2>Order Successful!</h2>";
echo "<a href='orders.php'><button>View Orders</button></a>";

include("includes/footer.php");
?>