<?php
define('__ROOT__', dirname(dirname(__FILE__)));
include __ROOT__ . '/database/DBClient.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/assets/img/favicon.png"/>

    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/forms.css">
    <link rel="stylesheet" href="/assets/css/signout.css">

    <link rel="stylesheet" href="/assets/css/about-us.css">
    <link rel="stylesheet" href="/assets/css/faq.css">
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/terms-legal.css">
    <link rel="stylesheet" href="/assets/css/view.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/results.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Bigfeet</title>
</head>

<body>
<ul class="topnav">
    <li><a class="active" href="/index.php">
            <span class="home-link">Bigfeet</span> <img src="/assets/img/logo.png" alt="Logo" class="logo"></a></li>
    <li class="topnav-menu"><a href="/user/testimonials.php">Testimonials</a></li>
    <li class="topnav-menu"><a href="/info/contact-us.php">Contact</a></li>
    <li class="topnav-menu"><a href="/info/about-us.php">About</a></li>
    <li class="topnav-menu"><a href="/info/faq.php">FAQ</a></li>
    <li class="topnav-menu"><a href="/info/articles.php">Articles</a></li>
    <?php if (!isLoggedIn()) { ?>
        <li class="topnav-menu"><a href="/user/register.php">Sign-up</a></li>
        <li class="topnav-menu"><a href="/user/login.php">Sign-in</a></li>
    <?php } else { ?>
        <div class="dropdown">
            <li class="topnav-menu"><a href="#"><?php echo $_SESSION['user']->Name;?> <?php echo $_SESSION['user']->Surname;?><i class="fa fa-caret-down"></i></a></li>
            <div class="dropdown-content">
                <li class="topnav-menu"><a href="/user/profile/view.php">Profile</a></li>
                <li class="topnav-menu"><a href="/<?php echo $_SESSION['user']->Category; ?>"><?php echo ucfirst($_SESSION['user']->Category) . ' Dashboard';?></a>
                </li>
                <li class="topnav-menu"><a id="modal-btn">Sign Out</a></li>
            </div>
        </div>
            <div id="my-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Would you like to Signout?</h2>
                    </div>
                    <div class="modal-body">
                        <form class="modal-body" action="/database/DBClient.php" method="post">
                            <input class="modal-button" type="submit" name="form" value="Confirm"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <h3>Confirm Signout</h3>
                    </div>
                </div>
            </div>
    <?php } ?>
</ul>
