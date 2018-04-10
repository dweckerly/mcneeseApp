<?php
if(!isset($_POST['submit'])){
    header("Location: ../editEvent.php?err=noSub");
    exit();
} else if(!isset($_POST['eventName']) || !isset($_POST['location'])){
    header("Location: ../editEvent.php?err=noSet");
    exit();
} else {
    if(empty($_POST['date']) || empty($_POST['time'])) {
        header("Location: ../editEvent.php?err=noTime");
        exit();
    } else {
        $id = $_POST['id'];
        include_once("../include/db.php");
        $name = mysqli_real_escape_string($conn, $_POST['eventName']);
        $loc = mysqli_real_escape_string($conn, $_POST['location']);
        $sDate = mysqli_real_escape_string($conn, $_POST['sDate']);
        $sDate = date("m/d/Y", strtotime($sDate));
        $eDate = mysqli_real_escape_string($conn, $_POST['eDate']);
        $eDate = date("m/d/Y", strtotime($eDate));
        $sTime = mysqli_real_escape_string($conn, $_POST['sTime']);
        $eTime = mysqli_real_escape_string($conn, $_POST['eTime']);

        $sql = "UPDATE events SET name='$name', location='$loc', startDate='$sDate', endDate='$eDate',  startTime='$sTime', endTime='eTime' WHERE ID = '$id'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);

        header("Location: ../event.php?id=$id");
        exit();
    }
}