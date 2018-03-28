<?php
session_start();
if(!$_SESSION['login'] || !isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit();
} else {
    include_once("../layout/header.php");
}   // will use this to generate keys for new users to the app

$key = random_int();
include_once("../include/db.php");
$sql = "INSERT INTO keys (signInKey) VALUES ('$key')";
mysqli_query($conn, $sql);
mysqli_close($conn);
?>

<div class="container">
    <h4 class="display">Use the following URL to create a new user.</h5>
    <br />
    <a href="mcn.96.lt/signup.php?key=<?php echo $key; ?>">mcn.96.lt/signup.php?key=<?php echo $key; ?></a>
</div>

<?php
include_once("../layout/footer.php");
?>


