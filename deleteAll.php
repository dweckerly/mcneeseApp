<?php
include_once("util/sessionCheck.util.php");
include_once("layout/header.php");
?>
    <div class="container">
        <h3 style="margin-top:100px;">Are you sure that you want to delete ALL events?</h1>
        <a class="btn btn-danger" href="util/deleteAll.util.php">YES</a>
        <a class="btn btn-secondary" href="/">NO</a>
    </div>
<?php
include_once("layout/footer.php");
?>