<?php
if(!isset($_POST['submit'])){
    header("Location: ../login.php?err=post");
    exit();
} else if(!isset($_POST['userName']) || !isset($_POST['password'])){
    header("Location: ../login.php?err=sUnP");
    exit();
} else {
    if(empty($_POST['userName']) || empty($_POST['password'])) {
        header("Location: ../login.php?err=eUnP");
        exit();
    } else {
        include_once("../include/db.php");
        $user = mysqli_real_escape_string($conn, $_POST['userName']);
        $pwd = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = "SELECT * FROM users WHERE userName = '$user'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck == 1) {
            $row = mysqli_fetch_assoc($result);
            $hash = $row['password'];
            if(password_verify($pwd, $hash)) {
                mysqli_close($conn);
                session_start();
                $_SESSION['login'] = TRUE;
                $_SESSION['user'] = $_POST['userName'];
                $_SESSION['uid'] = $row['uID'];
                $_SESSION['super'] = $row['super'];
                header("Location: ../");
                exit();
            } else {
                mysqli_close($conn);
                header("Location: ../login.php?err=pwd");
                exit();
            }
        } else {
            mysqli_close($conn);
            header("../login.php?err=nof");
            exit();
        }
       
    }
}