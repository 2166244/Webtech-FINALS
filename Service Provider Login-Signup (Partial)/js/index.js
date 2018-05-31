$(document).ready(function() {
        $("#signup__link").click(function() {
            $(".signup-page-container").removeClass("signup-form-open");
            $(".signup-page-container").addClass("login-form-open");
        });
        $("#login__link").click(function() {
            $(".signup-page-container").addClass("signup-form-open");
            $(".signup-page-container").removeClass("login-form-open");
        });
    });