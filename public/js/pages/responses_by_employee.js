let template = $("#response-item").html();

filterManager = {
    filters: { employee: null },
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
        response.forEach(responseItem => {
            let newListing = $("<div>");
            newListing.append(template);

            newListing.find(".date").text(responseItem.created_at);
            newListing
                .find(".choice")
                .text(responseTypes[responseItem.response_type_id]);

            $("#result-list").append(newListing.html());
        });
    }
};

$("#filter-submit-btn").on("click", () => {
    let selectedUserId = $("#employee-select").val();

    if (selectedUserId !== null) {
        filterManager.filters.employee = selectedUserId;
        filterManager.search();
    } else {
        alert("Please select an employee before submitting!");
    }
});
