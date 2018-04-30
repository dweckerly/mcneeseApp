<?php 
include_once("util/sessionCheck.util.php");
include_once("layout/header.php");
include_once("include/db.php");
session_start();

if($_SESSION['super'] == 1) {
    $sql = "SELECT * FROM events";
} else {
    $uid = $_SESSION['uid'];
    $sql = "SELECT * FROM events WHERE createdBy = '$uid'";
}
$result = mysqli_query($conn, $sql);