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
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $time = mysqli_real_escape_string($conn, $_POST['time']);

        $sql = "UPDATE events SET name='$name', location='$loc', date='$date', time='$time' WHERE ID = '$id'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);

        header("Location: ../event.php?id=$id");
        exit();
    }
}