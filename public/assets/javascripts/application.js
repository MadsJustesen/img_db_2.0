// validate sign-up form
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
    return true;
}

// validate edit form
function validateEdit() {
    var valid = true;
    var password = document.forms["editform"]["new_password"].value;
    var passwordConfirmation = document.forms["editform"]["new_password_confirm"].value;
    var passwordLength = password.length;

    //Make sure fixed errors cleared
    document.getElementById("username-missing-error").innerHTML = "";
    document.getElementById("password-match-error").innerHTML = "";
    document.getElementById("password-length-error").innerHTML = "";

    if(passwordLength > 0 && passwordLength < 6) {
        document.getElementById("password-length-error").innerHTML = "*Password must be at least 6 characters";
        valid = false;
    }

    if(!(password == passwordConfirmation)) {
        document.getElementById("password-match-error").innerHTML = "*Passwords didn't match";
        valid = false;
    }

    if(!valid) {
        document.getElementById("error-div").style.display = 'block';
        return false;
    }
    return true;
}

// register when window is scrolled
$(function() {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});

// Snap nav-bar to top, when scrolled to
function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
        $('#sticky-anchor').height($('#sticky').outerHeight());
    } else {
        $('#sticky').removeClass('stick');
        $('#sticky-anchor').height(0);
    }
}