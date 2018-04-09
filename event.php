<?php
include_once("util/sessionCheck.util.php");
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: /");
    exit();
} else {
    $id = $_GET['id'];
    include_once("include/db.php");
    $sql = "SELECT * FROM events WHERE ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $rCheck = mysqli_num_rows($result);
    if($rCheck == 0) {
        header("Location: /");
    } else {
        include_once("layout/eHeader.php");
        $row = mysqli_fetch_assoc($result);
        $date = $row['date']; 
        $d = new DateTime($date);
        $fDate = $d->format('l, F jS, Y');
?>
<h4 class="display-4 text-center" style="margin-top:100px;">Event Info</h4>
<div class="container" align="center">
    <div class='card'>
        <div class='card-body'>
            <h2 class='card-title'><?php echo $row["name"]; ?></h2>
            <h4 class='card-subtitle mb-2 text-muted'><?php echo $row["location"]; ?></h4>
            <p class='card-text'><?php echo $fDate; ?> from <?php echo $row["startTime"] . " to " . $row["endTime"]; ?></p>
            <a class="btn btn-info" href="eventInvite.php?id=<?php echo $id; ?>">Invite</a>
            <a class="btn btn-warning" href="editEvent.php?id=<?php echo $id; ?>">Edit</a>
            <a class="btn btn-danger" href="deleteEvent.php?id=<?php echo $id; ?>">Delete</a>
        </div>
    </div>
</div>
<?php
    $sql = "SELECT * FROM attendees WHERE eid = '$id'";
    $result = mysqli_query($conn, $sql);
?>
    <h4 class="text-center" style="margin-top: 50px;">Registered Parking Passes</h4>
    <div class="card-body container">
    <a href='#' class="btn btn-info" onclick='downloadCSV({ filename: "attendees-list.csv" });'>Download CSV</a>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Company</th>
                </tr>
            </thead>
            <tbody>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {   
    ?>   
    <tr>   
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["company"]; ?></td>
    </tr>
<?php
        }
    }
?>  
        </tbody>
    </table>
</div>
</div>
<script type="text/javascript"> 
    var json = [
<?php
    $sql = "SELECT * FROM attendees WHERE eid = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        while($rows = $result->fetch_assoc()) {   
?> 
        {
            Name: "<?php echo $rows['name']; ?>",
            Company: "<?php echo $rows['company']; ?>"
        },
<?php
    }?>
    ];<?php
}
?>
</script>
<script src="../js/csv.js"></script>
<?php
    }
}
mysqli_close($conn);
include_once("layout/footer.php");
?>