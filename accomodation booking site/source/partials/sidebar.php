<?php
include 'header.php';
?>
<link rel="stylesheet" href="/assets/css/sidebar.css">
<link rel="stylesheet" href="/assets/css/tables.css">

<style>
    .footer {
        display: flex;
    }
</style>

<div class="sidenav">
    <ul>
        <li><img src="<?php echo $_SESSION['user']->Picture; ?>" alt="Profile Picture" class="img-circle"></li>
        <fieldset style="padding: 0;">
            <li><a href="/user/profile/view.php">
                <?php echo $_SESSION['user']->Name;?> <?php echo $_SESSION['user']->Surname;?>
            </a></li>
        </fieldset>
        <?php if ($_SESSION['user']->Category === 'admin') {?>
            <fieldset style="padding: 0;">
                <li><a href="/admin">Admin Dashboard</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/admin/hosts.php">View Hosts</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/property/index.php">Add Listing</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/admin/listings.php">View Listings</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/admin/guests.php">View Guests</a></li>
            </fieldset>
        <?php } else if ($_SESSION['user']->Category === 'host') { ?>
            <fieldset style="padding: 0;">
                <li><a href="/host">Host Dashboard</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/property/index.php">Add Listing</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/host/history.php">View History</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/host/reviews.php">View Reviews</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/property/index.php">Add Listing</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/host/listings.php">View Listings</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/host/index.php">Overview Statistics</a></li>
            </fieldset>
        <?php } else if ($_SESSION['user']->Category === 'guest') { ?>
            <fieldset style="padding: 0;">
                <li><a href="/guest">Guest Dashboard</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/property/results.php">View Offers</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/guest/bookings.php">My Booking(s)</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/guest/favourites.php">My Favourites</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/guest/reviews.php">My Reviews</a></li>
            </fieldset>
            <fieldset style="padding: 0;">
                <li><a href="/guest/history.php">My History</a></li>
            </fieldset>
        <?php }?>
        <fieldset style="padding: 0;">
            <li><a id="modal-btn">Sign Out</a></li>
        </fieldset>
    </ul>
</div>
<?php
if (!isLoggedIn()) {
    header('Location: /user/login.php');
}
?>
