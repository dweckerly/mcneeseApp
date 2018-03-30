<?php
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../");
    exit();
} else {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="AttendingList.csv"');

    $file = fopen('php://output', 'w');

    $id = $_GET['id'];
    include_once("../include/db.php");
    $sql = "SELECT * FROM attendees WHERE eid = '$id'";
    if($rows = mysqli_query($conn, $sql)) {
        while($row = mysqli_fetch_assoc($rows)) {
            fputcsv($file, $row);
        }
        mysqli_free_reslt($result);
    }

    mysqli_close($conn);
    header("Location: ../event.php?id=$id");
    exit();
}



