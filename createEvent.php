<?php
include_once("util/sessionCheck.util.php");
include_once("layout/header.php");
?>
<div class="container">
    <h1 style="margin-top:100px;">Create New Event</h1>
    <form action="util/submitEvent.util.php" method="POST">
        <div class="form-group">
            <label for="eventName">Event Name</label>
            <input required="true" type="text" id="eventName" name="eventName" class="form-control">
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input required="true" type="text" id="location" name="location" class="form-control">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date</label>
                <input required="true" type="date" id="date" name="date" class="form-control">
            </div>                
            <div class="form-group col-md-3">
                <label for="time">Start Time</label>
                <input required="true" type="time" id="time" name="sTime" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="time">End Time</label>
                <input required="true" type="time" id="time" name="eTime" class="form-control">
            </div>
        </div>
        <button type="submit" name='submit' class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
include_once("layout/footer.php");
?>