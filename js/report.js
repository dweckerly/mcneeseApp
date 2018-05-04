var yr;
var month;

$('#year-select').change(function() {
    yr = this.value;
    if($('#month-select').length > 0) {
        $('#month-div').remove();
    }
    $('#append-yr').html('Please wait...');
    $.get("util/getMonth.util.php?yr=" + yr, function(data) {
        $('#append-yr').html(data);
    });
});
