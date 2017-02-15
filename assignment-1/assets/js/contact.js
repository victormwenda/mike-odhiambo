INTENT_USER_FEEDBACK = "intent-user-feedback";

window.onload = function () {
    document.getElementById('submit_button').addEventListener('click', onSubmitForm, false);
    document.getElementById('refresh_button').addEventListener('click', onRefreshForm, false);
}
function onRefreshForm() {
    document.getElementById("name").value = "";
    document.getElementById("email").value = "";
    document.getElementById("message").value = "";
}
function onSubmitForm(e) {
    e.preventDefault();
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var comment = document.getElementById("message").value;

    var errors = "";
    var errorCount = 0;
    if (name == "") {
        errorCount++;
        errors += "Error " + errorCount + " name cannot be blank\r\n";
    }
    if (email == "") {
        errorCount++;
        errors += "Error " + errorCount + " email cannot be blank\r\n";
    }
    if (comment == "") {
        errorCount++;
        errors += "Error " + errorCount + " comment(s) cannot be blank\r\n";
    }

    if (errorCount > 0) {
        alert(errors);
    } else {

        var requestUrl = "backend/php/contacts.php";
        var requestParams = "email=" + email + "&comment=" + comment + "&name=" + name;
        var requestIntent = INTENT_USER_FEEDBACK;
        sendPOSTHttpRequest(requestUrl, requestParams, requestIntent);
    }
}


function onSuccessfulXHR(request_intent, xhr, response) {
    switch (request_intent) {
        case INTENT_USER_FEEDBACK:
            alert(response);
            onRefreshForm();
            break;
        default :
            alert("Cannot perform action[" + request_intent + "]");
    }
}

function onFailedXHR(request_intent, xhr) {
    switch (request_intent) {
        case INTENT_USER_FEEDBACK:
            alert("You have a server error");
            break;
        default :
            alert("Cannot perform action[" + request_intent + "]");
    }
}