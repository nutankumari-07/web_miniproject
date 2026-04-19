<?php
session_start();
if(isset($_POST['email'])){
    $xml = simplexml_load_file("xml/users.xml");

    $user = $xml->addChild("user");
    $user->addChild("id", rand(1000,9999));
    $user->addChild("name", $_POST['name']);
    $user->addChild("email", $_POST['email']);
    $user->addChild("password", password_hash($_POST['password'], PASSWORD_DEFAULT));

    $xml->asXML("xml/users.xml");
    $success = true;
}
?>

<?php include("includes/navbar.php"); ?>

<h2>Create Account</h2>

<?php if(!empty($success)){ ?>
<p style="color:green;">Account created! <a href="login.php">Login Now</a></p>
<?php } ?>

<form method="POST">
<input name="name" placeholder="Name" required><br>
<input type="email" name="email" placeholder="Email" required><br>
<input type="password" name="password" placeholder="Password" required><br>
<button>Sign Up</button>
</form>

<?php include("includes/footer.php"); ?>