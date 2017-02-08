window.onload = function () {
    document.getElementById('submit_button').addEventListener('click', onSubmitForm, false);
    document.getElementById('refresh_button').addEventListener('click', onRefreshForm, false);
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
        alert("Thank you " + name + ". Your comments `" + comment + "` have been received. We shall send a response to " + email + " soon");
    }
}