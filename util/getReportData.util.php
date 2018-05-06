<?php
session_start();
$yr = $_GET['yr'];
$month = $_GET['month'];
include_once("../include/db.php");
$concat = $yr . "-" . $month;
if($_SESSION['super'] == 1) {
    $sql = "SELECT * FROM events WHERE startDate LIKE '$concat%'";
} else {
    $uid = $_SESSION['uid'];
    $sql = "SELECT * FROM events WHERE startDate LIKE '$concat%' AND createdBy = '$uid'";
}
$result = mysqli_query($conn, $sql);
$ids = array();
while($row = $result->fetch_assoc()) {
    array_push($ids, $row['ID']);
}
foreach($ids as $id) {
    $sql = "SELECT * FROM attendees WHERE eid = '$id'";
    $result = mysqli_queryx($conn, $sql);
    if($result->num_rows > 0) {?>
    <button class="btn btn-info" onclick='downloadCSV({ filename: "attendees-list.csv" });'>Submit</button>
<script id="json-data" style="display:none;">
var json= [
    <?php
        while($rows = $result->fetch_assoc()) {   
            ?> 
        {
            Permit: "<?php echo $rows['count']; ?>",
            Name: "<?php echo $rows['name']; ?>",
            Company: "<?php echo $rows['company']; ?>",
            Event: "<?php echo $rows['event']; ?>",
            StartDate: "<?php echo $rows['startDate']; ?>",
            EndDate: "<?php echo $rows['endDate']; ?>",
            StartTime: "<?php echo $rows['startTime']; ?>",
            EndTime: "<?php echo $rows['endTime']; ?>"
        },
        <?php
        }
        ?>
    ];
    </script>
    <script src="js/csv.js"></script>
        <?php
    } else {
        echo "No attendees found.";
    }
}