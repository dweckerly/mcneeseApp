<?php
if(!isset($_POST['submit'])){
    header("Location: ../createEvent.php?err=noSub");
    exit();
} else if(!isset($_POST['eventName']) || !isset($_POST['location'])){
    header("Location: ../createEvent.php?err=noSet");
    exit();
} else {
    if(empty($_POST['sDate']) || empty($_POST['sTime'])) {
        header("Location: ../createEvent.php?err=noTime");
        exit();
    } else {
        include_once("../include/db.php");
        $name = mysqli_real_escape_string($conn, $_POST['eventName']);
        $loc = mysqli_real_escape_string($conn, $_POST['location']);
        $sDate = mysqli_real_escape_string($conn, $_POST['sDate']);
        if(!empty($_POST['eDate'])){
            $eDate = mysqli_real_escape_string($conn, $_POST['eDate']);
        } else {
            $eDate = "";
        }
        $sTime = mysqli_real_escape_string($conn, $_POST['sTime']);
        $eTime = mysqli_real_escape_string($conn, $_POST['eTime']);

        $date = date("m/d/Y", strtotime($date));
        session_start();
        $uid = $_SESSION['uid'];
        $sql = "INSERT INTO events (name, location, startDate, endDate, startTime, endTime, createdBy) VALUES ('$name', '$loc', '$sDate', '$eDate', '$sTime', '$eTime', '$uid')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);

        header("Location: ../");
        exit();
    }
}