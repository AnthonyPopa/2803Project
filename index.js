function showUsernameError() {
    document.getElementById("loginError").innerHTML = "* Username not found in database. " +
    "Double-check your spelling and make sure you are registered.";
    document.getElementById("loginError").style.color = "red";
}

function showPasswordError() {
    document.getElementById("loginError").innerHTML = "* Incorrect password.";
    document.getElementById("loginError").style.color = "red";
}