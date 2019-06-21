<?php
define('__ROOT__', dirname(dirname(__FILE__)));
include __ROOT__ . '/database/db.php';
include __ROOT__ . '/partials/helper.php';
include __ROOT__ . '/partials/map.php';

if ($_POST) {
    switch ($_POST['form']) {
        case 'Add to Favourites':
            $addFavourite = array(
                'id' => $_POST['id'],
                'user' => $_POST['user']
            );
            $db = new db();
            $db->createFavourite($addFavourite);
            header('Location: ../');
            break;

        case 'Edit Listing':
            $newListingDetails = array(
                ':nation' => $_POST['nationality'],
                ':type'   => $_POST['type'],
                ':price'  => $_POST['price'],
                ':blurb'  => $_POST['about'],
                ':str'    => $_POST['street'],
                ':city'   => $_POST['city'],
                ':state'  => $_POST['state'],
                ':post'   => $_POST['postal'],
                ':lati'   => $_POST['latitude'],
                ':long'   => $_POST['longtitude'],
                ':numG'   => $_POST['numg'],
                ':id'     => $_POST['listing']
            );

            $db = new db();
            $status = $db->editListing($newListingDetails);
            if ($status === true) {
                //updateSession();
                header('Location: /'.$_POST['cat'].'/listings.php');
            }
            break;

        case 'Delete Listing':
            $db = new db();
            $status = $db->deleteListing($_POST['listing']);
            if ($status === true) {
                //updateSession();
                //$user = $db->getUser();
                header('Location: /'.$_POST['cat'].'/listings.php');
            }
            break;

        case 'Edit User Profile':
            if (isLoggedIn()) {
                $newProfileData = array(
                    'fname' => $_POST['fname'],
                    'lname' => $_POST['lname'],
                    'email' => $_POST['email'],
                    'state' => $_POST['state'],
                    'city' => $_POST['city'],
                    'saddress' => $_POST['saddress'],
                    'pcode' => $_POST['pcode'],
                    'pbio' => $_POST['pbio']
                );
                $db = new db();
                $status = $db->editUserProfile($_SESSION['user']->Email, $newProfileData);
                if ($status === true) {
                    updateSession();
                    header('Location: /user/profile/view.php');
                }
            }
            break;

        case 'Create Account':
            $new_user = array(
                'name' => $_POST['fname'],
                'surname' => $_POST['lname'],
                'password' => $_POST['password0'],
                'gender' => $_POST['gender'],
                'email' => $_POST['email'],
                'cell' => $_POST['cell'],
                'nationality' => $_POST['nationality'],
                'state' => $_POST['state'],
                'city' => $_POST['city'],
                'street' => $_POST['street'],
                'postal' => $_POST['pcode'],
                'category' => $_POST['category'],
                'dob' => $_POST['dob']
            );
            $db = new db();
            $status = $db->createUser($new_user);

            if ($status === true) {
                logIn($new_user['email'], $new_user['password']);
                header('Location: /user/profile/view.php');
            } else {
                echo('Failed to create the account');
            }
            break;

        case 'Edit Card Details':
        case 'Add Card Details':
            if (isLoggedIn()) {
                $db = new db();
                $newCardData = array(
                    'cardH' => $_POST['card-holder'],
                    'cardN' => mt_rand(1000, 10000) . '',
                    'cardM' => $_POST['month'],
                    'cardY' => $_POST['year'],
                    'cardC' => $_POST['cvv'],
                    'cardT' => 'Master Card'
                );
                $status = $db->editCardDetails($_SESSION['user']->Email, $newCardData);
                if ($status === true) {
                    updateSession();
                    header('Location: /user/profile/view.php');
                }
            }
            break;

        case 'Forgot Password':
            if ($_POST['pass0'] === $_POST['pass1']) {
                $db = new db();
                $status = $db->forgotPassword($_POST['pass0'], $_POST['email']);
                header('Location: /user/login.php');
            }
            break;

        case 'Change Password':
            if (($_POST['password2'] === $_POST['password1']) && isLoggedIn()) {
                $db = new db();
                $status = $db->resetPassword($_POST['password'], $_POST['password1'], $_SESSION['user']->Email);
                header('Location: /user/profile/view.php');
            }
            break;

        case 'Login':
            if (logIn($_POST['email'], $_POST['password'])) {
                $_SESSION['error'] = '';
                header('Location: /user/profile/view.php');
                break;
            }
            $_SESSION['error'] = 'Email or Password is incorrect';
            header('Location: /user/login.php');
            break;

        case 'Confirm':
            logOut();
            header('Location: /user/login.php');
            break;

        case 'Create Property Listing':
            $created_at = date('Y-m-d');
            $image = upload();
            $new_property = array(
                'created_at' => $created_at,
                'host' => $_POST['host'],
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'pictures' => $image,
                'price' => $_POST['price'],
                'amenities' => amenities($_POST['amenity']),
                'about' => $_POST['about'],
                'street' => $_POST['street'],
                'state' => $_POST['state'],
                'city' => $_POST['city'],
                'postal' => $_POST['postcode'],
                'nationality' => $_POST['nationality'],
                'latitude' => $_POST['latitude'],
                'longitude' => $_POST['longitude'],
                'available' => 0,
                'minlength' => $_POST['min_nights'],
                'numofguests' => $_POST['guests'],
                'numofratings' => 0,
                'rating' => 0,
                'availablefrom' => $_POST['a_from'],
                'availableuntil' => $_POST['a_until'],
                'checkintime' => $_POST['check_in'],
                'checkouttime' => $_POST['check_out']
            );
            $db = new db();
            $listing_id = $db->createListing($new_property);
            header('Location: /host/index.php?id=' . $listing_id);
            break;

        case 'Create Review':
            $new_review = array(
                'guest' => $_SESSION['user']->Email,
                'listing' => $_POST['listing'],
                'review' => $_POST['review'],
                'rating' => $_POST['rating'],
                'picture' => $_SESSION['user']->Picture
            );
            $db = new db();
            $db->createReview($new_review);
            header('Location: /property/listing.php?id=' . $_POST['listing']);
            break;

        case 'Book':
            $new_booking = array(
                'user' => $_SESSION['user'],
                'id' => $_POST['id'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date']
            );
          /*  $new_history = array(
                'user' => $_SESSION['user']->Email,
                'host' => $_POST['host'],
                'listing' => $_POST['listing'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
            );*/
            $db = new db();
            $db->createBooking($new_booking);
            //$db->createHistory($new_history);
            header('Location: /index.php');
            break;

        case 'create-review':
            $new_review = array(
                'guest' => $_POST['guest'],
                'review' => $_POST['review'],
                'listing' => $_POST['listing'],
                'rating' => $_POST['ratings']
            );
            $data = new db();
            $data->createReview($new_review);
            header('Location: /property/listing.php?id=' . $_POST['listing']);
            break;

        case 'Delete Booking':
            $db = new db();

            var_dump($_POST);
//            $db->deleteBooking($_POST['id']);
//            header('Location /guest/bookings');
            break;



        case 'Delete Listings':
            $db = new db();
            var_dump($_POST);
//            $db->deleteBooking($_POST['id']);
//            header('Location /guest/bookings');
            break;

        case 'Save Booking Details':
            $db = new db();
            $book = array(
                'listing' => $_POST['listing'],
                'id' => $_POST['id'],
                'guest' => $_POST['guest'],
                'start-date' => $_POST['start-date'],
                'end-date' => $_POST['end-date']
            );
            $db->updateBooking($book);
            header('Location /guest/bookings.php?id='.$_POST['id']);
            break;

        case 'NoAccess':
        header('Location: /index.php');
        break;

        default:
            var_dump($_POST);
    }
}
/**
 * update the db with the current users session
 */
function updateSession()
{
    $db = new db();
    $_SESSION['user'] = $db->getUser($_SESSION['user']->Email);
}

/**
 * upload pictures from user to db
 * $dir current directory of the picture
 * $filename file name of the current picture
 */
function upload()
{
    return file_get_contents($_FILES['pictures']['tmp_name']);
}


/**
 * @return mixed
 */
function loggedInAs()
{
    session_start();
    return $_SESSION['user'];
}

/**
 * @return bool true if user is logged in
 */
function isLoggedIn()
{
    return loggedInAs() !== null;
}

/**
 * @param $email
 * @param $password
 * @return bool true if the login was successful
 */
function logIn($email, $password)
{
    session_start();
    $hash = crypt($password, 'BigFeet');
    $db = new db();
    $user = $db->getUser($email);
    if ($user === null) {
        return false;
    }
    if ($user->Hash === $hash) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

/**
 * @return bool true if admin user
 */
function isAdmin()
{
    if (isLoggedIn()) {
        return $_SESSION['user']->Category === 'admin';
    }
    return false;
}

/**
 * @return bool true if host user
 */
function isHost()
{
    if (isLoggedIn()) {
        return $_SESSION['user']->Category === 'host';
    }
    return false;
}

/**
 * @return bool true if guest user
 */
function isGuest()
{
    if (isLoggedIn()) {
        return $_SESSION['user']->Category === 'guest';
    }
    return false;
}

/**
 * deletes the session data when user logs out
 */
function logOut()
{
    session_start();
    unset($_SESSION['user']);
}

/***
 * assigns amenities to a unique binary number
 */

function amenities($array)
{
    $amenities = array(
        'wifi' => 1,
        'breakfast' => 2,
        'parking' => 4,
        'aircon' => 8,
        'fitness-center' => 16,
        'kid-friendly' => 32,
        'pet-friendly' => 64,
        'swimming-pool' => 128,
        'bar' => 256,
        'restaurant' => 512,
        'kitchen' => 1024,
        'shampoo' => 2048,
        'indoor-fireplace' => 4096,
        'washer' => 8192,
        'iron' => 16384,
        'dryer' => 32768,
        'laptop-area' => 65536,
        'tv' => 131072,
        'crib' => 262144,
        'high-chair' => 524288,
        'heating' => 1048576,
        'smoke-detector' => 2097152,
        'carbon-detector' => 4194304,
        'private-bathroom' => 8388608
    );
    $a = 0;
    foreach ($array as $arr) {
        $a += $amenities[$arr];
    }
    return $a;
}

function uploadPictures()
{
    $target_dir = '/assets/img/listings/';
    $target_file = $target_dir . basename($_FILES["pictures"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["pictures"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["pictures"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["pictures"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["pictures"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}


/*
function sendEmail($email = 'nobody@example.com', $subject = 'BigFeet', $message= 'I want to watch you sleep :)') {
    $headers = 'From: thebigd@bigfeet.co.za' . "\r\n".
               'Reply-To: noreply@bigfeet.co.za' . "\r\n";
    mail($email, $subject, $message, $headers);
}
*/
