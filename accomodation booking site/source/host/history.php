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
    <?php displayHostHistory(); ?>
</div>

<?php
    function displayHostHistory(){
        echo("<div class=\"os-row\">");
        echo("<div class=\"os-card\">");
        echo("<table border=\"0.0625em solid black;\">");
        echo("<tr>");
        echo("<th>Guest</th>");
        echo ("<th>Venue</th>");
        echo("<th>Checked-In</th>");
        echo("<th>Checked-Out</th>");
        echo("</tr>");
        $db = new db();
        $listings = $db->getListings($_SESSION['user']->Email);
        if(!$listings){
            echo("</table>");
            echo("</div>");
            echo("</div>");
            echo("<div class=\"os-card\" style=\"text-align: center; height: 200px; padding-bottom: 20px;\">");
            echo("<h3><br><strong>No History To Display, Your History will appear here after a booking has been made.</strong><br></h3>");
            echo("</div>");
        }else{
            foreach($listings as $listing){
                $history = $db->getUserHistoryID($listing->ID);
                if($history){
                    foreach($history as $hist){
                        echo("<tr>");
                        echo("<td>" . $hist->User ."</td>");
                        echo("<td>" . $listing->Name . "</td>");
                        echo("<td>" . $hist->CheckIn . "</td>");
                        echo("<td>" . $hist->CheckOut . "</td>");
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
