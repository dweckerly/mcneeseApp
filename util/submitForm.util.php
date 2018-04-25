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
            $_SESSION['sDate'] = $rows['startDate']; 
            $sDate = $_SESSION['sDate'];
            if($rows['endDate'] != "") {
                $_SESSION['eDate'] = $rows['endDate'];
                $eDate = $_SESSION['eDate']; 
            } else {
                $eDate = "";
            }
            $_SESSION['sTime'] = $rows['startTime'];
            $sTime = $_SESSION['sTime'];
            $_SESSION['eTime'] = $rows['endTime'];
            $eTime = $_SESSION['eTime'];
            $count = $rows['count']; 
            $count = $count + 1;
            $_SESSION['name'] = mysqli_real_escape_string($conn, $_POST['name']);
            $_SESSION['company'] = mysqli_real_escape_string($conn, $_POST['company']);
            $_SESSION['count'] = $count;

            $sql = "UPDATE events SET count = $count WHERE ID = '$id'";
            mysqli_query($conn, $sql);

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $company = mysqli_real_escape_string($conn, $_POST['company']);
            $event = $rows['name'];

            $sql ="INSERT INTO attendees (name, company, event, eid, count, startDate, endDate, startTime, endTime) VALUES ('$name', '$company', '$event', '$id', '$count', '$sDate', '$eDate', '$sTime', '$eTime')";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header("Location: ../pdf/parkingPass.php");
            exit();
        }
    }
}