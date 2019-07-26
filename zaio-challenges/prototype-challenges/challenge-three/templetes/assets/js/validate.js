/**
*get all the input data from the registration form and validate it
*by checking if passwords match and that every field was populated
*if all is good, submit the form
**/
function validateFormReg(){
    var p1 = document.getElementById("password");
    var p2 = document.getElementById("passwordTwo");
    var name = document.getElementById("name");
    var surname = document.getElementById("surname");
    var email = document.getElementById("email");
    var form = document.getElementById("register-me");

    if (name.value.replace(/\s/g, "") != "" && surname.value.replace(/\s/g, "") != "" &&
        email.value.replace(/\s/g, "") != "" && p1.value.replace(/\s/g, "") != "" && p2.value.replace(/\s/g, "") != ""){
            if ((p1.value.replace(/\s/g, "") != p2.value.replace(/\s/g, ""))) {
                $("#status").html("<p>Please enter matching passwords</p>");
                $("#status").css("color", "#ff0000");
            }else{
                if (validEmail(email.value) == true) {
                    if (validPassword(p1.value)) {
                        if (validNameAndSurname(name.value, surname.value)) {
                            form.submit();
                        }else{
                            $("#status").html("<p>Please enter valid Name or Surname</p>");
                            $("#status").css("color", "#ff0000");
                        }
                    }else{
                        $("#status").html("<p>1 upper and lowercase letter, symbol and number</p>");
                        $("#status").css("color", "#ff0000");
                    }
                }else{
                    $("#status").html("<p>Please enter valid email</p>");
                    $("#status").css("color", "#ff0000");
                }
            }
    }else{
        $("#status").html("<p>All fields are mendatory</p>");
        $("#status").css("color", "#ff0000");
    }
}

/**
*validate the login form
*check if every input field was populated
**/
function validateFormLog() {
    var email = document.getElementById("email-log");
    var password = document.getElementById("password-log");
    var form = document.getElementById("login");

    if (email.value.replace(/\s/g, "") == "" || password.value.replace(/\s/g, "") == "") {
        $("#status").html("<p>All fields are mendatory</p>");
        $("#status").css("color", "#ff0000");
    }else{
        if (validEmail(email.value)) {
            if (validPassword(password.value)) {
                form.submit();
            }else{
                $("#status").html("<p>Please enter a valid password</p>");
                $("#status").css("color", "#ff0000");
            }
        }else{
            $("#status").html("<p>Please enter a valid email</p>");
            $("#status").css("color", "#ff0000");
        }
    }
}

/** 
 *check if all the fields are populated, display an error on the form with appropriate prompt
 * 
 **/

function validateFormEdit(){

    var name = document.getElementById("name");
    var surname = document.getElementById("surname");
    var age = document.getElementById("age");
    var university = document.getElementById("university");
    var faculty = document.getElementById("faculty");
    var fcourse = document.getElementById("fcourse");
    var form = document.getElementById("edit-profile");

    if (name.value.replace(/\s/g, "") == "" || surname.value.replace(/\s/g, "") == "" && age.value.replace(/\s/g, "") == ""
            && university.value.replace(/\s/g, "") == "" && faculty.value.replace(/\s/g, "") == "" && fcourse.value.replace(/\s/g, "") == "") {
                
                $("#status").html("<p>All fields are mendatory</p>");
                $("#status").css("color", "#ff0000");
    
            } else {
                
        if (validNameAndSurname(name.value, surname.value)){
            if (course(fcourse.value)){

                        form.submit();
                    }else{
                        $("#status").html("<p>Please enter a valid course name</p>");
                        $("#status").css("color", "#ff0000");   
                    }

                }else{
                    $("#status").html("<p>Please enter a valid name or surname</p>");
                    $("#status").css("color", "#ff0000");
                }

            }
}


/*******************************************************************************
 validate some of the input using regular expressions
********************************************************************************/
/**
*validate the enter email using regular EXPRESSIOINS
*@param {*} email the email address that will be validated
**/
function validEmail(email) {
    const pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return pattern.test(email);
}
function validPassword(password) {
    const pattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
    return pattern.test(password);
}
/**
*@param {*} name name of the user
*@param {*} surname surname of the user
*both should contain alphabets only
**/
function validNameAndSurname(name, surname) {
    const pattern = /^[A-Za-z ]+$/;
    return pattern.test(name) && pattern.test(surname);
}

function course(fcourse){
    const pattern = /^[a-zA-Z0-9 _]+$/;
    return pattern.test(fcourse);
}
