<?php 
include("includes/navbar.php");

if(!isset($_POST['id'])){
    echo "Invalid Request";
    exit;
}

$id = $_POST['id'];
$days = $_POST['days'];

$xml = simplexml_load_file("xml/products.xml");

foreach($xml->product as $p){
    if($p->id == $id){

        $total = $p->rent * $days;

        $_SESSION['cart'] = [
            'id' => $id,
            'name' => $p->name,
            'days' => $days,
            'total' => $total
        ];

        echo "
        <div class='card' style='width:300px;margin:auto;'>
            <h2>Rental Summary</h2>
            <p>Item: $p->name</p>
            <p>Days: $days</p>
            <p>Total Price: ₹$total</p>
            <a href='checkout.php'><button>Confirm Rental</button></a>
        </div>";
    }
}

include("includes/footer.php");
?>