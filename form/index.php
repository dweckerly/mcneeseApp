<?php
if(!isset($_GET['key']) || empty($_GET['key'])) {
    header("Location: error.php");
    exit();
} else {
    $key = $_GET['key'];
    include_once("../include/db.php");
    $sql = "SELECT * FROM eventKeys WHERE eKey = '$key'";
    $result = mysqli_query($conn, $sql);
    $rCheck = mysqli_num_rows($result);
    if($rCheck == 0) {
        header("Location: invalid.php");
        exit();
    } else {
        $rows = mysqli_fetch_assoc($result);
        $currentTime = time();
        $timeout = 60*60*24*5;
        $time = $rows['createTime'];
        if($currentTime > ($time + $timeout)) {
            $sql = "DELETE FROM eventKeys WHERE eKey = '$key'";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header("Location: invalid.php");
            exit();
        } else {
            $id = $rows['eID'];
            $sql = "DELETE FROM eventKeys WHERE eKey = '$key'";
            mysqli_query($conn, $sql);
            $sql = "SELECT * FROM events WHERE ID = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            mysqli_close($conn);
            include_once("../layout/linkHeader.php");

    
    ?>
        <h1>McNeese Special Event Parking Pass Form</h1>
        <h2>Event: <?php echo $row['name'];?></h2>
        <p>Please complete the following form to receive a parking pass for this event.</p>
        <div class='alert alert-warning' role='alert'>
            This link is only good once. Clicking 'Submit' will produce your parking pass. 
        </div>
        <form action='../util/submitForm.util.php' method='POST'>
            <div class='form-group'>
                <label for='name'>Your Name</label>
                <input required='true' type='text' id='name' name='name' class='form-control'>
            </div>
            <div class='form-group'>
                <label for='company'>Your Company</label>
                <input required='true' type='text' id='company' name='company' class='form-control'>
            </div>
            <input type='hidden' name='eid' value='<?php echo $id; ?>' />
            <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
        </form>

    <?php
        }
    }
}
include_once("../layout/footer.php");
?>
