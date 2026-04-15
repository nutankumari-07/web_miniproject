<?php
include("config/db.php");
include("includes/navbar.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$uid = $_SESSION['user'];
$result = $conn->query("SELECT * FROM orders WHERE user_id=$uid");

echo "<h2>Your Orders</h2>";

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "
        <div class='card'>
            <p>Product ID: ".$row['product_id']."</p>
            <p>Days: ".$row['days']."</p>
            <p>From: ".$row['start_date']."</p>
            <p>To: ".$row['end_date']."</p>
            <p>Status: ".$row['status']."</p>
        </div>";
    }
}else{
    echo "<p>No rentals yet.</p>";
}

include("includes/footer.php");
?>