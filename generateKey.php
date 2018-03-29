<?php
include_once("util/sessionCheck.util.php");
include_once("layout/header.php");
$key = rand();
include_once("include/db.php");
$sql = "INSERT INTO userKeys (signInKey) VALUES ('$key')";
mysqli_query($conn, $sql);
mysqli_close($conn);
?>

    <div class="container" align="center">
        <h4 style="margin-top: 100px;">Use the following URL to create a new user.</h4>
        <br />
        <a href="/signup.php?key=<?php echo $key; ?>"><code>mcn.96.lt/signup.php?key=<?php echo $key; ?></code></a>
    </div>

<?php
include_once("layout/footer.php");
?>


