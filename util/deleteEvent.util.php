<?php
include_once("sessionCheck.util.php");
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../");
    exit();
} else {
    $id = $_GET['id'];
    include_once("../include/db.php");
    $sql = "SELECT * FROM events WHERE ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $rCheck = mysqli_num_rows($result);
    if($rCheck == 0) {
        mysqli_close($conn);
        header("Location: ../");
        exit();
    } else {
        $sql = "DELETE FROM events WHERE ID='$id'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: ../");
        exit();
    }
}