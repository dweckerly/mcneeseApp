<?php
if(!isset($_POST['submit'])){
    header("Location: ../signup.php?key=sub");
    exit();
} else if(!isset($_POST['userName']) || !isset($_POST['password'])){
    header("Location: ../signup.php?key=isUnP");
    exit();
} else {
    if(empty($_POST['userName']) || empty($_POST['password'])) {
        header("Location: ../signup.php?key=eUnP");
        exit();
    } else {
        $key = $_POST['key'];
        $super = $_POST['super'];
        include_once("../include/db.php");
        $user = mysqli_real_escape_string($conn, $_POST['userName']);
        $pwd = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = "SELECT * FROM users WHERE userName = '$user'";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);
        if($resultcheck >= 1) {
            header("Location: ../signup.php?key=dup&err=dup");
            mysqli_close($conn);
            exit();
        } else {
            $hash = password_hash($pwd, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (userName, password, super) VALUES ('$user', '$hash', '$super')";
            mysqli_query($conn, $sql);
            $sql = "DELETE FROM userKeys WHERE signInKey = '$key'";
            mysqli_query($conn, $sql);
            session_start();
            $_SESSION['login'] = TRUE;
            $_SESSION['user'] = $user;
            header("Location: ../");
            mysqli_close($conn);
            exit();
        }
    }
}


