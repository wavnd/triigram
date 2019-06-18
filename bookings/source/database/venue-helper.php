<?php
include __ROOT__ . '/database/results-helper.php';

function setImages($row) {
?>

<td colspan="3">
  <section class="image-section">
    <br>
    <br>
    <br>
    <br>
    <div class="slideshow-container">
      <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
          <img src="data:image/jpeg;base64,<?php echo base64_encode($row->Picture); ?>" alt="<?php echo $row->Name; ?>"
          style="width:100%;">
        <div class="text">This stunning hotel in Stellenbosch!</div>
      </div>
      <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="../assets/img/hotels/Renaissance-Riverside.jpg" alt="image-2" style="width:100%">
        <div class="text">A emaculate pool nestled at the steps of the biodiversified garden</div>
      </div>
      <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="../assets/img/hotels/Leonardo-Beach.jpg" alt="image-3" style="width:100%">
        <div class="text">The rooms are exceptional and have a B* rating by the IMF</div>
      </div>
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <div style="text-align:center">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
    </div>
  </section>
</td>
<?php
}
function setName($row) {
?>
<h1 class="heading-1"><?php echo $row->Name;?></h1>
<?php
}
function setSummary($row,$userow) {
?>
<section class="summary-section">
  <h4><label class="hotelname">Summary</label></h4>
  <p class='par-1'> <?php find_Reviews($row->Rating) ?> <br/>
    <?php
      echo $row->Nationality.'<br/>';
      echo $row->City.'<br/>';
      echo $row->State.'<br/>';
      echo $row->Street.'<br/>';
      echo $userow->Cell;?>
  </p>
  <br/>

  <form action="/database/DBClient.php" post="post" onsubmit="confirmed()">
  <input type="hidden" name="id" value="<?php echo $row->ID; ?>">
  <input type="hidden" name="user" value="<?php echo  $_SESSION['user']->Email; ?>">
  <input type="submit" name="form" value="Add to Favourites" class="btn">
  </form>

</section>
<?php
}
function setPrices($row,$userow) {
?>
<section class="prices-section">
  <h4><label class="hotelname">Availability</label></h4>
  <h5><label class="hotelname"><?php echo 'R '.$row->Price?></label></h5>
  <form action="pay-room.php" method="POST">
    Available from : <?php echo $row->Availablefrom;?>
    <br>
    Available until :<?php echo $row->Availableuntil;?>
    <br>
    <label>Check-in:<input type="date" name="checkin" min="<?php echo $row->Availablefrom;?>" max="<?php echo $row->Availableuntil;?>"></label>
    <br>
    <label>Check-out:<input type="date" name="checkout" min="<?php echo $row->Availablefrom;?>" max="<?php echo $row->Availableuntil;?>"></label>
    <br>
    <input type="submit" name="form" value="Place a Booking" class="btn">
  </form>
  <h3><label>Contact host</label></h3>
  Email: <a href="mailto:info@scphotel.com"><?php echo $userow->Email?></a><br>
  Phone: <a href="tel:+1 719-430-5400"><?php echo $userow->Cell?></a><br>
  Check-in time - <?php echo $row->Checkintime; ?><br>
  Check-out time - <?php echo $row->Checkouttime; ?><br>
</section>
<br>
<?php
}
function setAbout($row) {
?>
<section class="about-place-section">
  <h2><label>Details</label></h2>
  <p>
    <?php echo $row->About;?>
  </p>
  <h3><label>Amenities</label></h3>
  <?php find_Ammenities2($row->Amenities);?>
</section>
<?php
}
function setReviews($reviews,$Id) {
  if (isLoggedIn()) {
?>
<section class="reviews-section">
    <form action="/database/DBClient.php" method="post">
        <h3><label class="hotelname">Reviews</label></h3>
        <table class="review-table">
            <tr>
                <td  class="thumb-space" colspan="2">
                        <span class="ratings-thumb" id="ratingsThumb">
                          <img src="../assets/img/search-icons/star.png" alt="wifi">
                          <label id="ratingsValueReview">5</label>
                        </span>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="range" name="ratings" min="0" max="10" id="ratingsReview" value="10"
                           oninput="updateRatingsReview();">
                </td>
            </tr>
        </table>
        <table class="review-table">
            <tr>
                <td>
                    <textarea rows="4" name="review"></textarea>
                </td>
            </tr>
            <tr >
                <td>
                    <button type="submit" name="form" value="Create Review">Post Rating and Review</button>
                </td>
            </tr>
            <input type="hidden" name="guest" value="<?php echo $_SESSION['user']->Email; ?>">
            <input type="hidden" name="listing" value="<?php echo $Id; ?>">
        </table>
    </form>
  <hr>
  <?php
}
  foreach ($reviews as $row ) {
  ?>
  <div class="review">
    <table class="review-table">
      <tr>
        <td class="image">
          <img src="<?php echo $row->Picture?>" alt="Profile">
        </td>
        <td>
          <label><?php echo $row->Guest; ?></label>
          <br>
          <label><i><?php find_Reviews($row->Rating) ?></i></label>
        </td>
      </tr>
      <tr >
        <td colspan="2">
          <br/>
          <p>
            <?php echo $row->Review; ?>
          </p>
          <br/>
          <br/>
        </td>
      </tr>
    </table>
  </div>
<?php
 }
?>
</section>
<?php
}
function setLinks($row) {
?>
<td class="venue-hotel-table-side2">
    <iframe
            id="gmap_canvas" class="map"
            frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCRoMp9qZzwXY1gaWMh8uZDkbT46Dd7BRg
    &q=<?php echo $row->Latitude;?>,<?php echo $row->Longitude;?>" allowfullscreen>
    </iframe>
</td>

<?php
}
function generateDetails($row,$userow,$reviews) {
?>
<main class="main-contents">
  <link rel="stylesheet" href="/assets/css/venue-hotel.css">
  <table class="venue-hotel-table">
    <tr>
      <?php setImages($row);?>
    </tr>
    <tr>
      <td colspan="3" class="venue-hotel-table-title">
        <?php setName($row);?>
      </td>
    </tr>
    <tr>
      <td class="venue-hotel-table-side1">
        <?php
          setSummary($row,$userow);
          setPrices($row,$userow);
        ?>

      </td>
      <td rowspan="1" class="venue-hotel-table-details">
        <?php
            setAbout($row);
            setReviews($reviews,$row->ID);
          ?>
      </td>
      <?php setLinks($row);?>
    </tr>
  </table>
  <br>
<?php
include '../partials/footer.php';
?>
<script type="text/javascript" src="../assets/js/venue-hotel.js"></script>
</main>
<?php
}
?>

<script>
function confirmed() {
    alert("Your booking has been confirmed!");
}
</script>
