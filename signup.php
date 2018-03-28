<?php
if(!isset($_GET['key'])) {
    header("Location: ../login.php");
} else {
    $key = $_GET['key'];
    include_once("../inculde/db.php");
    $sql = "SELECT * FROM keys WHERE signInKey = '$key'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    if($rows == 0) {
        header("Location: ../login.php");
    } else {

    }
}