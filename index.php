<?php 
include_once("util/sessionCheck.util.php");
include_once("layout/header.php");
include_once("include/db.php");
$sql = "SELECT * FROM events";
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
                    <th onclick="sortTable(0)">Event</th>
                    <th onclick="sortTable(1)">Location</th>
                    <th onclick="sortTable(2)">Date</th>
                    <th onclick="sortTable(3)">Time</th>
                    <th>Functions</th>
                    <th>Invite</th>
                </tr>
            </thead>
            <tbody>
<?php 
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
?>
        <tr>
            <td><a href='event.php?id=<?php echo $row["ID"]; ?>'><?php echo $row["name"]; ?></a></td>
            <td><?php echo $row["location"]; ?></td>
            <td><?php echo $row["date"]; ?></td>
            <td><?php echo $row["time"]; ?></td>
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
<?php 
mysqli_close($conn);
include_once("layout/footer.php");
?>