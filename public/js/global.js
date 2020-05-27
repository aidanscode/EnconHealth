$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

$(document).ready(function() {
    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
    $(".select2").select2();
});
