var template = $("#email").html();

function addToEmailList(email) {
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
