let responseTemplate = $("#response-template").html();
let noResponseTemplate = $("#no-response-template").html();

filterManager = {
    filters: { date: null },
    setDate: (date, resetInput = false) => {
        filterManager.filters.date = date;

        if (resetInput) {
            $("#date-selection").val(date);
        }
    },
    search: () => {
        $("#filter-spinner").show();
        $.ajax({
            url: endpoint,
            method: "POST",
            data: filterManager.filters,
            dataType: "json",
            success: response => {
                $("#filter-spinner").hide();
                $(".result-list").empty();
                filterManager.displayResults(response);
            },
            error: (xhr, status, error) => {
                $("#filter-spinner").hide();
                console.log("Error!");
            }
        });
    },
    displayResults: response => {
        for (let responseType in response) {
            if (response.hasOwnProperty(responseType)) {
                let template =
                    responseType == "no_response"
                        ? noResponseTemplate
                        : responseTemplate;

                let list = "";
                if (responseType == "positive") list = "healthy-list";
                else if (responseType == "negative") list = "unhealthy-list";
                else list = "no-response-list";

                response[responseType].forEach(user => {
                    let newListing = $("<div>");
                    newListing.append(template);

                    newListing.find(".name").text(user.name);
                    newListing.find(".email").text(user.email);

                    if (user.created_at) {
                        newListing.find(".timestamp").text(user.created_at);
                    }

                    $("#" + list).append(newListing.html());
                });
            }
        }
    }
};

let today = new Date();
let year = today.getFullYear();
let month = ("0" + (today.getMonth() + 1)).slice(-2);
let day = ("0" + today.getDate()).slice(-2);

filterManager.setDate(year + "-" + month + "-" + day, true);
filterManager.search();

//Prevent filter form from submitting
$("form").submit(e => {
    e.preventDefault();

    let newVal = $("#date-selection").val();
    filterManager.setDate(newVal);
    filterManager.search();
});

$("#filter-submit-btn").on("click", () => {
    let newVal = $("#date-selection").val();
    filterManager.setDate(newVal);
    filterManager.search();
});
