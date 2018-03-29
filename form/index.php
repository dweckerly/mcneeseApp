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
        $id = $rows['eID'];
        mysqli_close($conn);
        include_once("../layout/linkHeader.php");
    ?>
        <h1>McNeese Special Event Parking Pass Form</h1>
        <p>Please complete the following form to receive a parking pass for this event.</p>
        <div class='alert alert-warning' role='alert'>
            Clicking 'Submit' will produce your parking pass. This link will expire in 24 hours.
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
include_once("../layout/footer.php");
?>