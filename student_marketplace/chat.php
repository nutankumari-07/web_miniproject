<?php
session_start();
include("includes/navbar.php");

if(isset($_POST['msg'])){
  $line = $_SESSION['user'].": ".$_POST['msg']."\n";
  file_put_contents("chat.txt",$line,FILE_APPEND);
}
?>

<h3>Chat</h3>

<div class="chat-box">
<?php
if(file_exists("chat.txt")){
  echo nl2br(file_get_contents("chat.txt"));
}
?>
</div>

<form method="POST">
  <input name="msg" placeholder="Type message">
  <button>Send</button>
</form>