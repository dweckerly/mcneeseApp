<?php
if(empty($_GET['key'])) {
    header("Location: ../login.php");
    exit();
} else {
    $key = $_GET['key'];
    if(!isset($_POST['submit'])){
        header("Location: ../signup.php");
        exit();
    } else if(!isset($_POST['userName']) || !isset($_POST['password'])){
        header("Location: ../signup.php");
        exit();
    } else {
        if(empty($_POST['userName']) || empty($_POST['password'])) {
            header("Location: ../signup.php");
            exit();
        } else {
            include_once("../include/db.php");
            $user = mysqli_real_escape_string($_POST['userName']);
            $pwd = mysqli_real_escape_string($_POST['password']);
            $sql = "SELECT * FROM users WHERE userName = '$user'";
            $result = mysqli_query($conn, $sql);
            $resultcheck = mysqli_num_rows($result);
            if($resultcheck >= 1) {
                header("Location: ../signup.php?err=dup");
                mysqli_close($conn);
                exit();
            } else {
                $hash = password_hash($pwd, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (userName, password) VALUES ('$user', '$hash')";
                mysqli_query($conn, $sql);
                $sql = "UPDATE keys SET used=1 WHERE signUpKey = '$key'";
                mysqli_query($conn, $sql);
                session_start();
                $_SESSION['login'] = TRUE;
                header("Location: ../");
                mysqli_close($conn);
                exit();
            }
        }
    }    
}

