<?php
include_once("util/sessionCheck.util.php");
include_once("layout/header.php");
session_start();
if($_SESSION['super'] != 1) {
    header("Location: /");
} else {
    $key = rand();
    include_once("include/db.php");
    $super = $_GET['super'];
    $sql = "INSERT INTO userKeys (signInKey, super) VALUES ('$key', '$super')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
?>

    <div class="container" align="center">
        <h4 style="margin-top: 100px;">Use the following URL to create a new user. <?php echo $_GET['super'];?></h4>
        <br />
        <a href="/signup.php?key=<?php echo $key; ?>"><code>https://testurl.tech/signup.php?key=<?php echo $key; ?></code></a>
    </div>

<?php
}
include_once("layout/footer.php");
?>