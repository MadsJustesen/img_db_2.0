function validateSignUp() {
    var valid = true;
    var username = document.forms["signupform"]["add_user_username"].value;
    var password = document.forms["signupform"]["add_user_password"].value;
    var passwordConfirmation = document.forms["signupform"]["add_user_password_confirm"].value;
    var passwordLength = password.length;

    //Make sure fixed errors cleared
    document.getElementById("username-missing-error").innerHTML = "";
    document.getElementById("password-match-error").innerHTML = "";
    document.getElementById("password-length-error").innerHTML = "";

    if (username == null || username.trim() == "") {
        document.getElementById("username-missing-error").innerHTML = "*Username must be filled out";
        valid = false;
    }

    if(!(password == passwordConfirmation)) {
        document.getElementById("password-match-error").innerHTML = "*Passwords didn't match";
        valid = false;
    }

    if(passwordLength < 6) {
        document.getElementById("password-length-error").innerHTML = "*Password must be at least 6 characters";
        valid = false;
    }

    if(!valid) {
        document.getElementById("error-div").style.display = 'block';
        return false;
    }
}