<?php
session_start();
include("includes/navbar.php");
?>

<h2 class="section-title">⚙️ Settings</h2>

<div style="max-width:400px; margin:auto;">

    <form>
        <input type="text" placeholder="Change Name" style="width:100%; padding:10px; margin:10px 0;">
        <input type="password" placeholder="New Password" style="width:100%; padding:10px; margin:10px 0;">

        <button class="btn" style="width:100%;">Update</button>
    </form>

</div>

<?php include("includes/footer.php"); ?>