<?php
if(!isset($_GET['key'])) {
    header("Location: ../login.php");
    exit();
} else {
    if(empty($_GET['key'])) {
        header("Location: ../login.php");
        exit();
    } else {
        $key = $_GET['key'];
        include_once("../inculde/db.php");
        $sql = "SELECT * FROM keys WHERE signInKey = '$key'";
        $result = mysqli_query($conn, $sql);
        $rCheck = mysqli_num_rows($result);
        if($rCheck == 0) {
            header("Location: ../login.php");
            exit();
        } else { 
            $row = mysqli_fetch_assoc($result);
            mysqli_close($conn);
            if($row['used'] == 1) {
                header("Location: ../signup.php?err=used");
                exit();
            } else { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>McNeese Event Parking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <div class"container" align="center">
        <form action="../util/signup.util.php?key=<?php echo $key; ?>" metho="post">
            <div class="form-group">
                <label for="userName">User Name</label>
                <input class="form-control" id="userName" name="userName" placeholder="Enter user name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
<?php
if(isset($_GET['err'])){
    $err = $_GET['err'];
    if($err == 'dup') {
        $errMess = "This username already exists.";
    } else if($err == 'used') {
        $errMess = "This sign in key has already been used.";
    } else {
        $errMess = "Unknown error.";
    }
?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errMess; ?>
        </div>
<?php
}
?>
    </div>
</body>
</html>
<?php
            }
        }
    }
}