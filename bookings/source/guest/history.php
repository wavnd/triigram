<?php
    include '../partials/sidebar.php';
?>

<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>

<div class="main" style="padding-bottom: 350px;">
    <h3 style="text-align: center; padding-top: 50px;">History</h3>
    <!-- display the guest history -->
    <?php displayGuestHistory($_SESSION["user"]->Email); ?>
</div>

<?php
/**
 * Function responsible for displaying the guest user's history
 *
 * @param guestEmail     the email of the guest user who has a history to be displayed.
 */
function displayGuestHistory($guestEmail) {
    echo("<div class=\"os-row\">");
    echo("<div class=\"os-card\">");
    echo("<table border=\"0.0625em solid black;\">");
    echo("<tr>");
    echo("<th>Destination</th>");
    echo("<th>Name</th>");
    echo("<th>Price</th>");
    echo("<th>Type</th>");
    echo("<th>Checked-In</th>");
    echo("<th>Checked-Out</th>");
    echo("<th>Duration</th>");
    echo("<th>Rating</th>");
    echo("</tr>");
    $db = new db();
    $history = $db->getUserHistory($guestEmail);
    if (!$history) {
        echo("</table>");
        echo("</div>");
        echo("</div>");
        echo("<div class=\"os-card\" style=\"text-align: center; height: 200px; padding-bottom: 20px;\">");
        echo("<h3><br><strong>No History To Display, Your History will appear here after a booking has been made.</strong><br></h3>");
        echo("</div>");
    } else {
        foreach ($history as $hist) {
            $listing = $db->getListing($hist->Listing);
            echo("<tr>");
            echo("<td>" . $listing->Nationality ."</td>");
            echo("<td>" . $listing->Name . "</td>");
            echo("<td>" . $listing->Price . "</td>");
            switch ($listing->Type) {
                case "1": echo("<td> Hotel      </td>"); break;
                case "2": echo("<td> Appartment </td>"); break;
                case "3": echo("<td> Cottage    </td>"); break;
                case "4": echo("<td> Cabin      </td>"); break;
            }
            echo("<td>" . $hist->CheckIn ."</td>");
            echo("<td>" . $hist->CheckOut ."</td>");
            $temp = round((strtotime($hist->CheckOut) - strtotime($hist->CheckIn))/86400);
            echo("<td>" . $temp . " Days</td>");

            $review = $db->getReviewsByID($hist->ID);
            $star = 1;
            echo("<td>");
            while ($star <= $review->Rating) {
                echo("<img src=\"/assets/img/icons/star.png\" alt=\"star\" class=\"index-star\">");
                $star = $star + 1;
            }
            echo("</td>");
            echo("</tr>");
        }
        echo("</table>");
        echo("</div>");
        echo("</div>");
    }
}

include '../partials/footer.php';
?>
