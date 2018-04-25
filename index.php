<?php 
include_once("util/sessionCheck.util.php");
include_once("layout/header.php");
include_once("include/db.php");
if($_SESSION['super'] == 1) {
    $sql = "SELECT * FROM events WHERE hide = 0";
} else {
    $uid = $_SESSION['uid'];
    $sql = "SELECT * FROM events WHERE createdBy = '$uid AND hide = 0";
}
$result = mysqli_query($conn, $sql);

$time = date("m-d-Y h:i:sa");
?>
<div class="container-fluid" style="margin-top:100px;">
<div class="card-body container" >
    <a href="deleteAll.php" class="btn btn-warning float-right">Delete All Events</a>
    <div class="table-responsive">
        <table id="eventTable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th onclick="sortTable(0)" class="sortable">Event</th>
                    <th onclick="sortTable(1)" class="sortable">Location</th>
                    <th onclick="sortTable(2)" class="sortable">Date</th>
                    <th onclick="sortTable(3)" class="sortable">Time</th>
                    <th>Functions</th>
                    <th>Invite</th>
                </tr>
            </thead>
            <tbody>
<?php 

if ($result->num_rows > 0) {
    $ids = array();
    while($row = $result->fetch_assoc()) {
        array_push($ids, $row['ID']);
        $sDate = $row['startDate']; 
        $eDate = $row['endDate'];
        if($eDate == "") {
            $fDate = date('l, F jS, Y', strtotime($sDate));
        } else {
            $fDate = date('l, F jS', strtotime($sDate)) . " - " . date('l, F jS, Y', strtotime($eDate));
        }
        $sTime = date("h:i A", strtotime($row["startTime"]));
        $eTime = date("h:i A", strtotime($row['endTime']));
?>
        <tr>
            <td><a href='event.php?id=<?php echo $row["ID"]; ?>'><?php echo $row["name"]; ?></a></td>
            <td><?php echo $row["location"]; ?></td>
            <td><?php echo $fDate; ?></td>
            <td><?php echo $sTime . ' to ' . $eTime; ?></td>
            <td><a href='editEvent.php?id=<?php echo $row["ID"]; ?>'>Edit</a> | <a href='deleteEvent.php?id=<?php echo $row["ID"]; ?>'>Delete</a></td>
            <td><a class="btn btn-info" href='eventInvite.php?id=<?php echo $row["ID"]; ?>'>Invite</a></td>
        </tr>
<?php
    }
}
?>
            </tbody>
        </table>
    </div>
</div>
</div>
<div class='card-footer small text-muted'>Queried on <?php echo $time; ?></div>
</div>
<script type="text/javascript"> 
    var json = [
<?php
    foreach($ids as $x => $x_val) {
        $sql = "SELECT * FROM attendees WHERE eid = '$x_val'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
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
    }?>
    ];<?php
}
?>
</script>
<script src="js/csv.js"></script>
<?php 
mysqli_close($conn);
include_once("layout/footer.php");
?>