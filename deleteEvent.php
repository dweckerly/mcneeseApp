<?php
include_once("util/sessionCheck.util.php");
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: error.php");
    exit();
} else {
    include_once("layout/header.php");
    $id = $_GET['id'];
    include_once("include/db.php");
    $sql = "SELECT * FROM events WHERE ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $rCheck = mysqli_num_rows($result);
    if($rCheck == 0){
        header("Location: ../");
        exit();
    } else {
        $rows = mysqli_fetch_assoc($result);
?>
    <div class="container">
        <h3 style="margin-top:100px;">Are you sure that you want to delete the event <?php echo $rows['name']; ?>?</h1>
        <a class="btn btn-danger" href="util/deleteEvent.util.php?id=<?php echo $rows['ID']; ?>">YES</a>
        <a class="btn btn-secondary" href="/">NO</a>
    </div>
<?php
    }
}
include_once("layout/footer.php");