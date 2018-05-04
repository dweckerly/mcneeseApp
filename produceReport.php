<?php 
include_once("util/sessionCheck.util.php");
include_once("layout/header.php");
include_once("include/db.php");
session_start();

if($_SESSION['super'] == 1) {
    $sql = "SELECT * FROM events";
} else {
    $uid = $_SESSION['uid'];
    $sql = "SELECT * FROM events WHERE createdBy = '$uid'";
}
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $years = array();
    while($row = $result->fetch_assoc()) {
        $ar = explode('-', $row['startDate']);
        array_push($years, $ar[0]);
    }
    $uYears = array_unique($years);
    ?>
<script src="js/jquery.js"></script>
<div class="container" style="margin-top:100px;">
<div class="alert alert-info" role="alert">
Clicking 'Submit' will produce a CSV containing attendee information for the selected time.
</div>
<form>
<div class="form-row">
    <div id="year-div" class="form-group col">
        <label>Please select a year.</label>
        <select class="form-control" id="year-select">
            <option value=""></option>
<?php
    foreach($uYears as $y) {
        echo "<option value='" . $y . "'>" . $y . "</option>";
    }
?>
        </select>
    </div>
    <span id="append-yr"></span>
</div>
</div>
<?php
} else {
    echo "<h4 style='margin-top:60px;'>No events found.</h4>";   
}
?>
<script src="js/report.js"></script>