let template = $("#response-item").html();

filterManager = {
    filters: { employee: null },
    search: () => {
        $("#filter-spinner").show();
        $.ajax({
            url: employeeEndpoint,
            method: "POST",
            data: filterManager.filters,
            dataType: "json",
            success: response => {
                $("#filter-spinner").hide();
                $("#response-list").empty();

                filterManager.displayResults(response);
            },
            error: (xhr, status, error) => {
                $("#filter-spinner").hide();
                console.log("Error!");
            }
        });
    },
    displayResults: response => {
        adminInput.updateAdminInput(
            response.user_id,
            response.is_admin,
            response.is_self
        );

        let responses = response.responses;
        if (responses.length == 0) {
            $("#response-list").append(
                "<h3>This user has not submitted any responses.</h3>"
            );
        } else {
            responses.forEach(responseItem => {
                let newListing = $("<div>");
                newListing.append(template);

                newListing.find(".date").text(responseItem.created_at);
                newListing
                    .find(".choice")
                    .text(responseTypes[responseItem.response_type_id]);

                $("#response-list").append(newListing.html());
            });
        }
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

var adminInput = {
    userId: null,
    isAdmin: null,
    isSelf: null,
    updateAdminInput: (userId, isAdmin, isSelf) => {
        adminInput.userId = userId;
        adminInput.isAdmin = isAdmin;
        adminInput.isSelf = isSelf;

        adminInput.updateUI();
    },
    updateUI: () => {
        $("#user_id").val(adminInput.userId);
        $("#is_admin_text").text(adminInput.isAdmin ? " " : " not ");
        $("#is_admin_checkbox").prop("checked", adminInput.isAdmin);

        if (adminInput.isSelf) {
            $(".can_change_group").hide();
        } else {
            $(".can_change_group").show();
        }

        $("#admin_status").show();
    },
    changeAdminStatus: newStatus => {
        $.ajax({
            url: adminEndpoint,
            method: "POST",
            data: { isAdmin: newStatus, userId: adminInput.userId },
            dataType: "json",
            success: response => {
                adminInput.isAdmin = newStatus;
                adminInput.updateUI();
            },
            error: () => {
                //Failed to update status, reset the checkbox
                $("#is_admin_checkbox").prop("checked", adminInput.isAdmin);
            }
        });
    }
};

$("#is_admin_checkbox").on("click", () => {
    let newStatus = $("#is_admin_checkbox").prop("checked");
    adminInput.changeAdminStatus(newStatus);
});
