<?php
session_start();
include_once("../include/db.php");
$yr = $_GET['yr'];
if($_SESSION['super'] == 1) {
    $sql = "SELECT * FROM events WHERE startDate LIKE '$yr%'";
} else {
    $uid = $_SESSION['uid'];
    $sql = "SELECT * FROM events WHERE startDate LIKE '$yr%' AND createdBy = '$uid'";
}
$result = mysqli_query($conn, $sql);
$months = array();
while($row = $result->fetch_assoc()) {
    $ar = explode('-', $row['startDate']);
    array_push($months, $ar[1]);
}
$uMonths = array_unique($months);
?>
    <div id="month-div" class="form-group col">
        <label>Please select a month.</label>
        <select id="month-select" class="form-control">
            <option value=""></option>
    <?php
    foreach($uMonths as $m) {
        echo "<option value='" . $m . "'>" . $m . "</option>";
    }
?>
        </select>
    </div>
    <script>
        $('#month-select').change(function() {
            var month = this.value;
            if($('#json-data').length > 0) {
                $('#json-data').remove();
            }
            $('#append-month').html('Please wait...');
            $.get("util/getReportData.util.php?yr=" + yr + "&month=" + month, function(data) {
                $('#append-month').html(data);
            });
        });
    </script>
    <span id="append-month"></span>
