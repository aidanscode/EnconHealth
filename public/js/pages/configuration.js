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

    addToEmailList(newEmail);
    $("#add-email-input").val("");
});

$(document).on("click", ".remove-email-btn", e => {
    let parent = e.target.parentElement.parentElement;
    parent.remove();
});

//On every page load, we "clear" the existing email list and fill it with all the emails defined in emails
$("#email-list").empty();
emails.forEach(email => {
    addToEmailList(email);
});
