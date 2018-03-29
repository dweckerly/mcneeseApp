<?php
include_once("sessionCheck.util.php");
include_once("../include/db.php");
$sql = "DELETE FROM events";
mysqli_query($conn, $sql);
mysqli_close($conn);
header("Location: ../");
exit();