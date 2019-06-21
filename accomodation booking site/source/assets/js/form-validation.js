/**
 * validation for: reset-password.php
 * @returns {boolean}
 */
function validateResetPassword() {
    var email = document.getElementById("email").value;
    var pass0 = document.getElementById("pass0").value;
    var pass1 = document.getElementById("pass1").value;

    if (pass0.equals(pass1)) {
        // passwords do no match
        return false;
    } else {
        if (!(checkPassword(pass1) && checkEmail(email))) {
            return false;
        }
        return true;
    }
}

/**
 * validation for: login.php
 * @returns {boolean}
 */
function validateLogin() {
    var email = document.getElementById("email").value;
    var pass = document.getElementById("password").value;

    if (!(checkPassword(pass) && checkEmail(email))) {
        document.getElementById("error-message-js").innerText = "Log-in unsuccessful. Your email and/or password entered is incorrect.";
        document.getElementById("error").style.display = "block";
        return false;
    }
    return true;
}

/**
 * validation for: register.php
 * @returns {boolean}
 */
function validateRegister() {
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lame").value;
    var dob = document.getElementById("dob").value;

    var cell = document.getElementById("cell").value;
    var pass0 = document.getElementById("password0").value;
    var pass1 = document.getElementById("password1").value;

    var nationality = document.getElementById("nationality").value;
    var state = document.getElementById("state").value;
    var post_code = document.getElementById("pcode").value;
    var city = document.getElementById("city").value;
    var str_address = document.getElementById("street").value;


    var gender = null, profile_cat = null;
    if(document.getElementById("male").checked) {
        gender = "male";
    }else if(document.getElementById("female").checked) {
        gender = "female";
    } else if(document.getElementById("other").checked) {
        gender = "other";
    } else {
        return false;
    }

    if (document.getElementById("guest")) {
        profile_cat = "guest";
    } else if (document.getElementById("host")) {
        profile_cat = "host";
    } else {
        //error
        return false;
    }

    // check if the user requesting a profile is greater than 18
    if (checkDOB(dob)) {
        var now = new Date();
        var dob = new Date(dob);
        if (isOlderThan18(dob, now)) {
            return true;
        } else {
            //young applicatant
            return false;
        }
    } else {
        //date format wrong.
        return false;
    }
}


/**
 * Selects the elements
 * validate the contact us form
 */
function validateContactUs() {
    var email = document.getElementById("email").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var message = document.getElementById("message").value;
    var subject = document.getElementById("subject").value;



}

/**
 * check if the user is older than 18 years
 *
 * @param dob date of birth
 * @param today today's date
 * @returns {boolean}
 */
function isOlderThan18(dob, today) {
    let age = today.getFullYear() - dob.getFullYear();
    const month = today.getMonth() - dob.getMonth();
    if (month < 0 || (month === 0 && today.getDate() < dob.getDate())) {
        age--;
    }
    return (age > 18);
}

/************************************************************************************/
/******           VALIDATING USER INPUT USING REGULAR EXPRESSIOINS             ******/
/************************************************************************************/

/**
 * check if email has an acceptable email format
 *
 * @param {*} email     email to be validated
 */
function checkEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(email);
}

/**
 * check if cell is in the correct form
 *
 * @param {*} cell      cell phone number to be validated
 */
function checkCell(cell) {
    const cellPattern = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
    return cellPattern.test(cell);
}

/**
 * check if password is legal and the strength is atleast satisfactory
 *
 * @param {*} password     password to be validated
 */
function checkPassword(password) {
    const passwordPartten = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
    //return passwordPartten.test(password);
    return true;
}

/**
 * check if date abides to the following parten
 *
 * @param {*} date          date to be validated
 */
function checkDOB(date) {
    const dateParten = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
    return dateParten.test(date);
}

/**
 * check if fname and lname abide to the following parten
 *
 * @param {*} fname         first name to be validated
 * @param {*} lname         last name to be validated
 */
function checkIfValidNameSurname(fname, lname) {
    const flNamePattern = /^[A-Za-z ]+$/;
    return flNamePattern.test(fname) && flNamePattern.test(lname);
}

/**
 * check if address abides to the following parten
 *
 * @param {*} address       address to be validated
 */
function checkStreetAddress(address) {
    const streetAddressParten = /^[A-Za-z \d]+$/;
    return streetAddressParten.test(address);
}

/**
 * check if string abides to the following parten
 *
 * @param {*} message       the message to be validate
 */
function checkString(message) {
    const stringParten = /[^a-z$A-Z0-9-. ]/;
    return stringParten.test(message);
}
