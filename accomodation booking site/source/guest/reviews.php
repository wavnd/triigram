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

<div class="main" style="padding-bottom: 350px">
    <h3 class="header-text" style="text-align: center; padding-top:50px;">Reviews</h3>
    <!-- display the guest reviews -->
    <?php displayGuestReviews($_SESSION['user']->Email); ?>
</div>

<?php
/**
 * Function responsible for displaying the guest user's reviews.
 *
 * @param guestEmail     the email of the guest user who has reviews to be displayed.
 */
function displayGuestReviews($guestEmail) {
    $db = new db();
    $reviews = $db->getReviewsByEmail($guestEmail);
    //echo(count($reviews));
    if(!$reviews) {
        echo("<div class=\"os-card\" style=\"height: 200px; padding-bottom: 20px;\">");
        echo("<h3><br><strong>No Reviews Made, The Reviews You make will appear here.</strong><br></h3>");
        echo("</div>");
    } else {
        foreach ($reviews as $review) {
            echo("<div class=\"os-card\" style=\"min-height: 150px; padding-bottom: 20px;\">");
            $listing_name = $db->getListing($review->Listing);
            echo("<br><br><strong>".$listing_name->Name ."</strong><br>");
            echo("<p><i><a href=\"/property/venue-hotel.php?id=".$review->Listing."\">".$review->Review."</a></i></p><br>");

            $star = 1;
            echo("<fieldset>");
            while ($star <= $review->Rating) {
                echo("<img src=\"/assets/img/icons/star.png\" alt=\"star\" class=\"index-star\">");
                $star = $star + 1;
            }
            echo("</fieldset>");
            echo("</div>");
        }
    }
}

include '../partials/footer.php';
?>
