<?php
include_once("util/sessionCheck.util.php");
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: error.php");
    exit();
} else {
    include_once("include/db.php");

    // need to query event info
?>
    <div class='card'>
        <div class='card-body'>
            <h2 class='card-title'><?php echo $row["name"]; ?></h2>
            <h4 class='card-subtitle mb-2 text-muted'><?php echo $row["location"]; ?></h4>
            <p class='card-text'><?php echo $row['date']; ?> at <?php echo $row["time"]; ?></p>
        </div>
    </div>
    <?php
        // will query attendees list for all that are going to this event
    ?>

<?php
}
mysqli_close($conn);
include_once("layout/footer.php");
?>