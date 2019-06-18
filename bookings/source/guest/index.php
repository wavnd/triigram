<?php
    include '../partials/sidebar.php';
?>
<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>

<link rel="stylesheet" href="/assets/css/overview-stats.css">
<div class="main" style="padding-bottom: 350px;">
    <h3 style="text-align: center; padding-top: 50px;">Guest Details</h3>
    <?php displayGuestDetails($_SESSION['user']->Email);?>
</div>

<?php

function displayGuestDetails($guestEmail) {
    $db = new db();

    $hCount = $db->getUserHistoryCount($guestEmail);
    $rCount = $db->getUserReviewsCount($guestEmail);
    $bCount = $db->getGBookingsCount($guestEmail);
    $fCount = $db->getUserFavouritesCount($guestEmail);
    echo("<table>");
    echo("<tr>");
    echo("<th scope=\"col\">Details:</th>");
    echo("<th scope=\"col\">Total</th>");
    echo("</tr>");

    echo("<tr>");
    echo("<td> <a href=\"/guest/reviews.php\">My Reviews</a> </td>");
    echo("<td>" . $rCount . "</td>");
    echo("</tr>");

    echo("<tr>");
    echo("<td> <a href=\"/guest/history.php\">My History</a> </td>");
    echo("<td>" . $hCount . "</td>");
    echo("</tr>");

    echo("<tr>");
    echo("<td> <a href=\"/guest/bookings.php\">My Bookings</a> </td>");
    echo("<td>" . $bCount . "</td>");
    echo("</tr>");

    echo("<tr>");
    echo("<td> <a href=\"/guest/favourites.php\">My Favourites</a> </td>");
    echo("<td>" . $fCount . "</td>");
    echo("</tr>");
    echo("</table>");
}

include '../partials/footer.php';
?>
