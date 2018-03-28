<?php
if(!isset($_POST['submit'])){
    header("Location: ../login.php");
    exit();
} else if(!isset($_POST['userName']) || !isset($_POST['password'])){
    header("Location: ../login.php");
    exit();
} else {
    if(empty($_POST['userName']) || empty($_POST['password'])) {
        header("Location: ../login.php");
        exit();
    } else {
        include_once("../include/db.php");
        $user = mysqli_real_escape_string($_POST['userName']);
        $pwd = mysqli_real_escape_string($_POST['password']);
        $sql = "SELECT * FROM users WHERE userName = '$user'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck == 1) {
            $row = mysqli_fetch_assoc($result);
            $has = $row['password'];
            if(password_verify($pwd, $hash)) {
                mysqli_close($conn);
                session_start();
                $_SESSION['login'] = TRUE;
                header("Location: ../");
                exit();
            } else {
                mysqli_close($conn);
                header("Location: ../login.php");
                exit();
            }
        } else {
            mysqli_close($conn);
            header("../login.php");
            exit();
        }
       
    }
}