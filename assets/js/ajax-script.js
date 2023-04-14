$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "data.php",
        dataType: "html",
        success: function (data) {
            $("#data").html(data);

        }
    });
});