<?php
include_once("util/sessionCheck.util.php");
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: error.php");
    exit();
} else {
    include_once("layout/header.php");
    $id = $_GET['id'];
    include_once("include/db.php");
    $sql = "SELECT * FROM events WHERE ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $rCheck = mysqli_num_rows($result);
    if($rCheck == 0){
        header("Location: ../");
        exit();
    } else {
        $rows = mysqli_fetch_assoc($result);
?>  
<div class="container">
    <h1 style="margin-top:100px;">Create New Event</h1>
    <form action="util/updateEvent.util.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $rows['id']; ?>" />
        <div class="form-group">
            <label for="eventName">Event Name</label>
            <input required="true" type="text" id="eventName" name="eventName" class="form-control" value="<?php echo $rows['name']; ?>">
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input required="true" type="text" id="location" name="location" class="form-control" value="<?php echo $rows['location']; ?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date</label>
                <input required="true" type="date" id="date" name="date" class="form-control" value="<?php echo $rows['date']; ?>">
            </div>                
            <div class="form-group col-md-6">
                <label for="time">Time</label>
                <input required="true" type="time" id="time" name="time" class="form-control" value="<?php echo $rows['time']; ?>">
            </div>
        </div>
        <button type="submit" name='submit' class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
    }
}
include_once("layout/footer.php");
?>