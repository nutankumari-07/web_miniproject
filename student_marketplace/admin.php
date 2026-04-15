<?php
session_start();
include("includes/navbar.php");

if(!isset($_SESSION['user'])){
  echo "Login required";
  exit;
}

if(isset($_GET['delete'])){
  $id=$_GET['delete'];
  $xml=simplexml_load_file("xml/products.xml");

  $i=0;
  foreach($xml->product as $p){
    if($p->id==$id){
      unset($xml->product[$i]);
      break;
    }
    $i++;
  }
  $xml->asXML("xml/products.xml");
}

echo "<h2>Admin Panel</h2>";

$xml=simplexml_load_file("xml/products.xml");
foreach($xml->product as $p){
  echo "<p>$p->name
  <a href='admin.php?delete=$p->id'>❌</a></p>";
}
?>