$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

$(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
