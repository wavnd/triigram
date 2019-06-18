<?php
/**
 * sanity check the type, length and if the variable is empty or not
 *
 * @param $var
 * @param $type
 * @param $length
 * @return bool
 */
function checkvartype($var, $type, $length){
    $type = 'is_'.$type;
    if(!$type($var)){
        return false;
    }
    if (empty($var)) {
        return false;
    }
    return !(strlen($var) > $length);
}

/**/

/**
 * check if all var's are set
 * @return bool
 */
function checkisset(){
    return isset($_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['dob'],
        $_POST['pass0'], $_POST['pass1'], $_POST['nationality'], $_POST['state'],
        $_POST['city'], $_POST['saddress'], $_POST['pcode']);
}
/*------------------------------------sanitizing mathods------------------------
/**
 * sanitize email
 * @return mixed
 */
function saniemail(){
    return filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
}

/**
 * sanitize first name
 * @return mixed
 */
function sanifname(){
    return filter_var($_POST['fname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
}

/**
 * sanitize last name
 * @return mixed
 */
function sanilname(){
    return filter_var($_POST['lname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
}

/**
 * sanitize date of birth
 * @return mixed
 */
function sanidob(){
    $dob = filter_var(preg_replace("([^0-9/] | [^0-9-])", "", htmlentities($_POST['dob'])));
    return $dob;
}

/**
 * sanitize nationality
 * @return mixed
 */
function saniNationality(){
    $nationality = filter_var($_POST['nationality'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    return $nationality;
}

/**
 * santize state
 * @return mixed
 */
function saniState(){
    $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW);
    return $state;
}

/**
 * sanitize city
 * @return mixed
 */
function saniCity(){
    $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_HIGH);
    return $city;
}
/*sanitize street address*/
function saniaAddress(){
    $saddress = filter_var($_POST['saddress'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    return $saddress;
}

/**
 * sanitize postal code
 * @return mixed
 */
function sanipcode(){
    return filter_var($_POST['pcode'], FILTER_SANITIZE_NUMBER_INT);
}

/**
 * sanitize first password
 * @return mixed
 */
function saniPassZero(){
    $pass0 = filter_var($_POST['pass0'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    return pass0;
}

/**
 * sanitize confirm password
 * @return mixed
 */
function saniPassOne(){
    $pass1 = filter_var($_POST['pass1'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    return pass1;
}
