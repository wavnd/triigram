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
    <h3 style="text-align: center; padding-top: 50px;">Reviews</h3>
    <?php displayHostReviews(); ?>
</div>

<?php
    function displayHostReviews(){
        echo("<div class=\"os-row\">");
        echo("<div class=\"os-card\">");
        echo("<table border=\"0.0625em solid black;\">");
        echo("<tr>");
        echo("<th>Guest</th>");
        echo ("<th>Venue</th>");
        echo("<th>Review</th>");
        echo("<th>Rating</th>");
        echo("</tr>");
        $db = new db();
        $listings = $db->getListings($_SESSION['user']->Email);
        if(!$listings){
            echo("</table>");
            echo("</div>");
            echo("</div>");
            echo("<div class=\"os-card\" style=\"text-align: center; height: 200px; padding-bottom: 20px;\">");
            echo("<h3><br><strong>No Reviews to display. Your reviews will appear here after a booking has been made.</strong><br></h3>");
            echo("</div>");
        }else{
            foreach($listings as $listing){
                $reviews = $db->getReviewsByListing($listing->ID);
                if($reviews){
                    foreach($reviews as $review){
                        echo("<tr>");
                        echo("<td>" . $review->Guest ."</td>");
                        echo("<td>" . $listing->Name . "</td>");
                        echo("<td>" . $review->Review . "</td>");
                        $star = 1;
                        echo("<td>");
                        while ($star <= $review->Rating) {
                        ?>
                            <img src="/assets/img/icons/star.png" alt=\"star\" class=\"index-star\">;
                        <?php
                            $star = $star + 1;
                        }
                        echo("</td>");
                        echo("</tr>");
                    }
                }
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
