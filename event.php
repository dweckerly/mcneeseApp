<?php
include_once("util/sessionCheck.util.php");
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: error.php");
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
        include_once("layout/header.php");
        $row = mysqli_fetch_assoc($result);
?>
<h4 class="display-4 text-center" style="margin-top:100px;">Event Info</h4>
<div class="container" align="center">
    <div class='card'>
        <div class='card-body'>
            <h2 class='card-title'><?php echo $row["name"]; ?></h2>
            <h4 class='card-subtitle mb-2 text-muted'><?php echo $row["location"]; ?></h4>
            <p class='card-text'><?php echo $row['date']; ?> at <?php echo $row["time"]; ?></p>
        </div>
    </div>
</div>
<?php
    $sql = "SELECT * FROM attendees WHERE eid = '$id'";
    $result = mysqli_query($conn, $sql);
?>
    <h4 class="display-4 text-center">Registered Parking Passes</h4>
    <div class="card-body container">
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
<?php
    }
}
mysqli_close($conn);
include_once("layout/footer.php");
?>