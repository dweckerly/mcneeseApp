<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>McNeese Event Parking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
    <script src="../js/script.js"></script>
</head>
<body>
  <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top jus" id="mainNav">
        <a class="navbar-brand" href="/">
            <img src="../img/logo-M.png" width="40" height="30" class="d-inline-block align-top">
            &nbsp&nbspMcNeese Event Parking
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link" href="/">
                        <span class="nav-link-text">Event List</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link" href="/createEvent.php">
                        <span class="nav-link-text">Create Event</span>
                    </a>
                </li>
                <?php 
            if($_SESSION['super'] == 1) {?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link" href="/createUser.php">
                        <span class="nav-link-text">New User</span>
                    </a>
                </li>
                <?php
            }
            ?>
                <li class="nav-item dropdown float-right" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php 
                        session_start();
                        echo $_SESSION['user'];
                        ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../util/logout.util.php">Log Out</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        
                    </a>
                </li>
            </ul>
        </div>
    </nav>