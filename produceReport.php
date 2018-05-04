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
    $months= array();
    while($row = $result->fetch_assoc()) {
        $ar = explode('-', $row['startDate']);
        array_push($years, $ar[0]);
        array_push($months, $ar[1]);
    }
    $uYears = array_unique($years);
    $uMonths = array_unique($months);
    ?>
<div class="container" style="margin-top:100px;">
<div class="alert alert-info" role="alert">
Clicking 'Submit' will produce a CSV containing attendee information for the selected time.
</div>
<form>
<div class="form-row">
    <div class="form-group col">
        <label>Please select a year.</label>
        <select class="form-control">
<?php
    foreach($uYears as $y) {
        echo "<option value='" . $y . "'>" . $y . "</option>";
    }
?>
        </select>
    </div>
    <div class="form-group col">
        <label>Please select a month.</label>
        <select class="form-control">
    <?php
    foreach($uMonths as $m) {
        echo "<option value='" . $m . "'>" . $m . "</option>";
    }
?>
        </select>
    </div>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php
} else {
    echo "<h4 style='margin-top:60px;'>No events found.</h4>";   
}