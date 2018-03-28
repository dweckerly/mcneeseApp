<?php 
session_start();
if(!$_SESSION['login'] || !isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit();
} else {
    include_once("../layout/header.php");
}
?>


<?php 
include_once("../layout/footer.php");
?>