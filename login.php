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
        <form class="form-signin" action="util/login.util.php" method="POST">
            <img class="mb-4" src="/img/logo-M.png" alt="" width="84" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Log In</h1>
            <label for="inputEmail" class="sr-only">User Name</label>
            <input type="text" name="userName" id="userName" class="form-control" placeholder="User name" required autofocus />
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />
            <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" />
            <p class="mt-5 mb-3 text-muted">&copy; McNeese State University <?php echo date('Y'); ?></p>
        </form>
    </div>
</body>
</html>