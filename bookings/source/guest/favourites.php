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
    <h3 class="header-text" style="text-align: center; padding-top:50px;">Favorites</h3>
    <!-- display the guest history -->
    <?php displayGuestFavorites($_SESSION["user"]->Email);?>
</div>

<?php
/**
 * Function responsible for displaying the guest user's history.
 *
 * @param guestEmail     the email of the guest user who has history to be displayed.
 */
function displayGuestFavorites($guestEmail) {
    echo("<div class=\"os-row\">");
    echo("<div class=\"os-card\">");
    echo("<table border=\"0.0625em solid black;\">");
    echo("<tr>");
    echo("<th>Listing Host</th>");
    echo("<th>Destination</th>");
    echo("<th>Name</th>");
    echo("<th>Price</th>");
    echo("<th>Type</th>");
    echo("</tr>");
    $db = new db();
    $favorites = $db->getSavedListings($guestEmail);

    if (!$favorites) {
        echo("</table>");
        echo("</div>");
        echo("</div>");
        echo("<div class=\"os-card\" style=\"text-align: center; height: 200px; padding-bottom: 20px;\">");
        echo("<h3><br><strong>No History To Display, Your History will appear here after a booking has been made.</strong><br></h3>");
        echo("</div>");
    } else {
        foreach ($favorites as $favorite) {
            $listing = $db->getListing($favorite->Listing);
            echo("<tr>");
            echo("<td>" . $listing->Host . "</td>");
            echo("<td>" . $listing->Nationality . "</td>");
            echo("<td>" . $listing->Name . "</td>");
            echo("<td>" . $listing->Price . "</td>");
            switch ($listing->Type) {
                case "1": echo("<td> Hotel      </td>"); break;
                case "2": echo("<td> AppartMent </td>"); break;
                case "3": echo("<td> Cottage    </td>"); break;
                case "4": echo("<td> Cabin      </td>"); break;
            }
            echo("</tr>");
        }
        echo("</table>");
        echo("</div>");
        echo("</div>");
    }
}

include '../partials/footer.php';
?>
