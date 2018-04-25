<?php
include_once("sessionCheck.util.php");
include_once("../include/db.php");
if($_SESSION['super'] == 1) {
    $sql = "UPDATE events SET hide=1";
} else {
    $uid = $_SESSION['uid'];
    $sql = "UPDATE events SET hide=1 WHERE createdBy = '$uid'";
}

mysqli_query($conn, $sql);
mysqli_close($conn);
header("Location: ../");
exit();