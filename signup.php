<?php
if(!isset($_GET['key'])) {
    header("Location: ../login.php?err=no");
    exit();
} else {
    if(empty($_GET['key'])) {
        header("Location: ../login.php?err=emp");
        exit();
    } else {
        $key = $_GET['key'];
        include_once("include/db.php");
        $sql = "SELECT * FROM userKeys WHERE signInKey = '$key'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1) {
            header("Location: ../login.php?err=$key");
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
    <link href="/css/signin.css" rel="stylesheet">
</head>
<body>
    <div class"container" align="center">
        <form class="form-signin" action="/util/signup.util.php" method="POST">
            <img class="mb-4" src="/img/logo-M.png" alt="" width="84" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>
            <label for="userName" class="sr-only">User Name</label>
            <input type="text" name="userName" id="userName" class="form-control" placeholder="User name" required autofocus />
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required />
            <input type="hidden" name="key" value="<?php echo $key; ?>" />
            <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign Up</input>
            <p class="mt-5 mb-3 text-muted">&copy; McNeese State University <?php echo date('Y'); ?></p>
        </form>
    </div>
<?php
if(!empty($_GET['err'])){
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
</body>
</html>
<?php
        }
    }
}