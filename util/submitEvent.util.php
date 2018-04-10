<?php
if(!isset($_POST['submit'])){
    header("Location: ../createEvent.php?err=noSub");
    exit();
} else if(!isset($_POST['eventName']) || !isset($_POST['location'])){
    header("Location: ../createEvent.php?err=noSet");
    exit();
} else {
    if(empty($_POST['date']) || empty($_POST['sTime'])) {
        header("Location: ../createEvent.php?err=noTime");
        exit();
    } else {
        include_once("../include/db.php");
        $name = mysqli_real_escape_string($conn, $_POST['eventName']);
        $loc = mysqli_real_escape_string($conn, $_POST['location']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $sTime = mysqli_real_escape_string($conn, $_POST['sTime']);
        $eTime = mysqli_real_escape_string($conn, $_POST['eTime']);

        $date = date("m/d/Y", strtotime($date));

        $sql = "INSERT INTO events (name, location, date, startTime, endTime) VALUES ('$name', '$loc', '$date', '$sTime', '$eTime')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);

        header("Location: ../");
        exit();
    }
}