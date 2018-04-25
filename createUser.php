<?php
include_once("util/sessionCheck.util.php");
include_once("layout/header.php");

if($_SESSION['super'] == 1) {
?>

<div class="container">
    <h3 style="margin-top:100px;">What kind of user would you like to create?</h1>
    <a class="btn btn-success" href="generateKey.php?super=1">Super</a>
    <a class="btn btn-primary" href="generateKey.php?super=0">Basic</a>
</div>
<?php    
} else {
    header("Location: /");
}
?>