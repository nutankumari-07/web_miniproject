<?php
error_reporting(0);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$error = false;

if (isset($_POST['email'])) {

    $xml = simplexml_load_file("xml/users.xml");

    if ($xml !== false) {

        foreach ($xml->user as $u) {

            if (
                $u->email == $_POST['email'] &&
                password_verify($_POST['password'], $u->password)
            ) {

                // ✅ STORE USER DATA
                $_SESSION['user']  = (string)$u->id;
                $_SESSION['name']  = (string)$u->name;
                $_SESSION['email'] = (string)$u->email;

                // ✅ FLASH MESSAGE (show once on index.php)
                $_SESSION['success'] = "Login Successful!";

                header("Location: index.php");
                exit();
            }
        }
    }

    // ❌ login failed
    $error = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="auth-container">
    <div class="auth-box">

        <h2>Login</h2>

        <?php if (!empty($_GET['signup'])) { ?>
            <p class="success">Signup successful! Please login</p>
        <?php } ?>

        <?php if ($error) { ?>
            <p class="error">Wrong email or password</p>
        <?php } ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>
        </form>

        <p>No account? <a href="signup.php">Create one</a></p>

    </div>
</div>

</body>
</html>