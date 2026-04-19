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

<link rel="stylesheet" href="css/style.css">

<div class="auth-container">
<div class="auth-box">

<h2>Sign Up</h2>

<?php if(!empty($success)){ ?>
<p class="success">Signup successful! <a href="login.php">Login</a></p>
<?php } ?>

<form method="POST">
<input name="name" placeholder="Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit">Sign Up</button>
</form>

<p>Already have account? <a href="login.php">Login</a></p>

</div>
</div>