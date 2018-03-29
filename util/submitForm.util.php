<?php
if(!isset($_POST['submit'])){
    header("Location: ../form/error.php?err=sub");
    exit();
} else if(!isset($_POST['name']) || !isset($_POST['company'])){
    header("Location: ../form/error.php?err=iss");
    exit();
} else {
    if(empty($_POST['name']) || empty($_POST['company'])) {
        header("Location: ../form/error.php?err=empt");
        exit();
    } else {
        $id = $_POST['eid'];
        include_once("../include/db.php");
        $sql = "SELECT * FROM events WHERE ID = '$id'";
        $result = mysqli_query($conn, $sql);
        $rCheck = mysqli_num_rows($result);
        if($rCheck == 0) {
            header("Location: ../form/error.php?err=noE");
            exit();
        } else {
            $rows = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['eName'] = $rows['name'];
            $_SESSION['location'] = $rows['location'];
            $_SESSION['date'] = $rows['date'];
            $_SESSION['time'] = $rows['time'];
            $_SESSION['name'] = mysqli_real_escape_string($conn, $_POST['name']);
            $_SESSION['company'] = mysqli_real_escape_string($conn, $_POST['company']);

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $company = mysqli_real_escape_string($conn, $_POST['company']);
            $event = $rows['name'];

            $sql ="INSERT INTO attendees (name, company, event, eid) VALUES ('$name', '$company', '$event', '$id')";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header("Location: ../pdf/parkingPass.php");
            exit();
        }
    }
}