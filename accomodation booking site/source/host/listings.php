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
    <h3 style="text-align: center; padding-top: 50px;">My Listings</h3>
    <?php displayMyListings(); ?>
</div>

<?php
function displayMyListings(){
    echo("<div class=\"os-row\">");
    echo("<div class=\"os-card\">");
    echo("<table border=\"0.0625em solid black;\">");
    echo("<tr>");
    echo("<th>ID</th>");
    echo("<th>Venue</th>");
    echo("<th>Created at</th>");
    echo("<th>Availability</th>");
    echo("</tr>");
    $db = new db();
    $listings =  $db->getListings($_SESSION['user']->Email);

    if(!$listings){
        echo("</table>");
        echo("</div>");
        echo("</div>");
        echo("<div class=\"os-card\" style=\"text-align: center; height: 200px; padding-bottom: 20px;\">");
        echo("<h3><br><strong>No Listings to display. Your listings will appear here after adding them on the Add Listing page.</strong><br></h3>");
        echo("</div>");
    }else{
        foreach ($listings as $listing) {
            ?>
            <tr onclick="indexClick('/admin/listing.php?id='+<?php echo $listing->ID; ?>)">
            <?php
            echo("<td>" . $listing->ID . "</td>");
            echo("<td>" . $listing->Name . "</td>");
            echo("<td>" . $listing->Created_At . "</td>");
            switch($listing->Available){
                case "0": echo("<td>Not available</td>"); break;
                case "1": echo("<td>Available</td>"); break;
            }
            echo("</tr>");
        }
        echo("</table>");
        echo("</div>");
        echo("</div>");
    }
}
?>

<?php
    include '../partials/footer.php';
?>
