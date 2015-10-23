$(document).ready(function() {
    $(".menu-button").click(function() {
        if($("#menu").is(":hidden")) {
            $("#menu").show();
        } else {
            $("#menu").hide();
        }
    });
});