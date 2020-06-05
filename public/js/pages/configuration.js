//Checkbox inputs logic:
function updateConfigurationOption(key, value) {
    $.ajax({
        url: configurationEndpoint,
        method: "POST",
        data: { key: key, value: value },
        dataType: "json",
        success: () => {},
        error: () => {}
    });
}
$(".config-checkbox").change(function(e) {
    let target = e.target;
    let key = target.dataset.key;
    let value = target.checked ? 1 : 0;
    updateConfigurationOption(key, value);
});

//Email list logic
function updateServerEmailList(action, email, elementToRemove = null) {
    $.ajax({
        url: emailListEndpoint,
        method: "POST",
        data: { action: action, email: email },
        dataType: "json",
        success: () => {
            if (action == "add") {
                addToEmailList(email);
            } else {
                elementToRemove.remove();
            }
        },
        error: () => {
            alert(
                "An error occurred while attempting to update the email list"
            );
        }
    });
}

function addToEmailList(email) {
    var template = $("#email").html();
    let emailListing = $("<div>");
    emailListing.append(template);

    emailListing.find("input").attr("value", email);

    $("#email-list").append(emailListing.html());
}

$("#add-email-btn").on("click", () => {
    let newEmail = $("#add-email-input")
        .val()
        .trim();

    if (newEmail === "") {
        alert("Please enter an email address before submitting");
        return;
    }

    updateServerEmailList("add", newEmail);
    $("#add-email-input").val("");
});

$(document).on("click", ".remove-email-btn", e => {
    let toBeRemoved = e.target.parentElement.parentElement;
    let email = e.target.parentElement.previousElementSibling.value;
    updateServerEmailList("remove", email, toBeRemoved);
});

//On every page load, we "clear" the existing email list and fill it with all the emails defined in emails
$("#email-list").empty();
emails.forEach(email => {
    addToEmailList(email);
});
