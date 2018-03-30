<?php
include_once("util/sessionCheck.util.php");
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: /");
    exit();
} else {
    $id = $_GET['id'];
    $key = rand();
    $time = time();
    include_once("include/db.php");
    $sql = "INSERT INTO eventKeys (eKey, eID, createTime) VALUES ('$key', '$id', '$time')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);

    include_once("layout/header.php");
?>
    <div class="container" align="center">
        <h4 style="margin-top: 100px;">Use the following URL to create a parking pass.</h4>
        <div class='alert alert-warning' role='alert'>
            This link will expire in 24 hours.
        </div>
        <br />
        <a href="/form/index.php?key=<?php echo $key; ?>"><code>mcn.96.lt/form/index.php?key=<?php echo $key; ?></code></a>
    </div>
<?php
}
include_once("layout/footer.php");
?>