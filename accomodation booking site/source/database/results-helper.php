<?php

$amenitiesArray = array(
  1 => array('0' => 'Free Wifi','1' => 'wifi.png'),
  2 => array('0' =>  'Free Breakfast','1' =>  'breakfast.png'),
  4 => array('0' =>  'Parking','1' => 'parking.png'),
  8 => array('0' =>  'Air Conditioned','1' => 'aircon.png'),
  16 => array('0' =>  'Fitness Center','1' => 'fitness.png'),
  32 => array('0' =>  'kid Friendly','1' => 'kid.png'),
  64 => array('0' =>  'Pet Friendly','1' => 'pet.png'),
  128 => array('0' =>  'Pool','1' => 'pool.png'),
  256 => array('0' =>  'Bar','1' => 'bar.png'),
  512 => array('0' =>  'Restaurant','1' => 'resturant.png'),
  1024 => array('0' =>  'Kitchen','1' => 'kitchen.png'),
  2048 => array('0' =>  'Shampoo','1' => 'shampoo.png'),
  4096 => array('0' =>  'Indoor fireplace','1' => 'fireplace.png'),
  8192 => array('0' =>  'Washer','1' => 'washer.png'),
  16384 => array('0' =>  'Iron','1' => 'iron.png'),
  32768 => array('0' =>  'Hair dryer','1' => 'dryer.png'),
  65536 => array('0' =>  'Laptop friendly workspace','1' => 'laptop.png'),
  131072 => array('0' =>  'TV','1' => 'tv.png'),
  262144 => array('0' =>  'Crib','1' => 'crib.png'),
  524288 => array('0' =>  'High chair','1' => 'highchair.png'),
  1048576 => array('0' =>  'Heating','1' => 'heating.png'),
  2097152 => array('0' =>  'Smoke detector','1' => 'smokedetector.png'),
  4194304 => array('0' =>  'Carbon monoxide detector','1' => 'carbonmonoxide.png'),
  8388608 => array('0' =>  'Private bathroom','1' => 'privateroom.png')

);
$accommodationArray = array(
  '1' => array('0' => 'hotel','1' => 'hotel.png'),
  '2' => array('0' => 'apartment','1' => 'apartment.png'),
  '3' => array('0' => 'cottage','1' => 'cottage.png'),
  '4' => array('0' => 'cabin','1' => 'cabin.png')
);
$amenitiesPath = "../assets/img/search-icons/";
$accommodationPath = "../assets/img/search-icons/";//
$star_image = "<i class=\"fa fa-star s-color\" aria-hidden=\"true\"></i>";
$half_star_image = "<i class=\"fa fa-star-half-o s-color\" aria-hidden=\"true\"></i>";
$empty_star = "<i class=\"fa fa-star-o s-color\" aria-hidden=\"true\"></i>";

function find_Ammenities($value) {
  foreach ($GLOBALS['amenitiesArray'] as $key => $val) {
    if (($key & ((int)$value)) != 0) {
      echo  "<div class=\"place-amenities\">";
      echo  "<img src=\"".$GLOBALS['amenitiesPath'].$val['1']."\" alt=\"wifi\"/>";
      echo  "<label>".$val['0']."</label>";
      echo  "</div>";
    }
  }
}
function find_Ammenities2($value) {
  foreach ($GLOBALS['amenitiesArray'] as $key => $val) {
    if (($key & ((int)$value)) != 0) {
      echo  "<div class=\"place-amenities2\">";
      echo  "<img src=\"".$GLOBALS['amenitiesPath'].$val['1']."\" alt=\"wifi\"/>";
      echo  "<label>".$val['0']."</label>";
      echo  "</div><br>";
    }
  }
}
function find_Accomodation($value) {
    $val = (string)$value;
  echo "<div class=\"place-amenities\">";
  echo "<img src=\"".$GLOBALS['accommodationPath'].$GLOBALS['accommodationArray'][$val]['1']."\" alt=\"wifi\"/>";
  echo "<label>".$GLOBALS['accommodationArray'][$val]['0']."</label>";
  echo "</div>";
}
function find_Accomodation2($value) {
    $val = (string)$value;
  echo $GLOBALS['accommodationPath'].$GLOBALS['accommodationArray'][$val]['1'];
}
function find_Reviews($value) {
    $val = (float) ($value/2.0);
    for ($x = 1; $x <= 5; $x = $x+1) {
      if ($x <= $val) {
        echo $GLOBALS['star_image'];
      } elseif ( ($x - $val) == 0.5 || ($x - $val) == -0.5 ) {
        echo $GLOBALS['half_star_image'];
      } else {
        echo $GLOBALS['empty_star'];
      }
    }
}
function setFilters($offset) {
?>
<div class="Top-filler">
</div>
<table class="filters">
  <tr>
    <td>
      <label class="Top-label">FILTERS</label>
      <hr class="Top-label-underline"/>
    </td>
  </tr>
  <tr>
    <td>
      <div class="search-input">
        <i class="fas fa-map-marker-alt add1"></i>
        <input class="the-search" type="text" name="place" placeholder="(near you)" id="secondSearchInput" onkeyup="thelivesearch(this);" onfocusout="clearReasults();"><br>
        <table class="search-results" id="secondSearchResults">
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <div class="duration-options">
        <table>
          <tr>
            <td>
              <input type="date" name="duration-start">
            </td>
            <td>
              <div class="vert"></div>
            </td>
            <td>
              <input type="date" name="duration-end">
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <div class="price-range-filter">
        <label class="Top-label">PRICE</label>
        </br>
        <hr class="Top-label-underline"/>
        <table class="price-slider">
          <tr>
            <td class="thumb-space" colspan="2">
              <span class="price-thumb" id="priceThumb">R0</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="range" name="prices" min="0" max="10000" id="price" value="0" oninput="updatePrice();">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="min-price">R0</span><span class="max-price">R10,000+</span>
            </td>
          </tr>
          <tr>
            <td class="options-clear" onclick="cancellPrice();">
              <h2>Clear</h2>
            </td>
            <td class="options-apply"  onclick="nextsearch(<?php echo $offset; ?>,2);">
              <h2>Apply</h2>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <div class="guests-rating-filter">
        <label class="Top-label">GUEST RATINGS</label>
        </br>
        <hr class="Top-label-underline"/>
        <table class="ratings-slider">
          <tr>
            <td  class="thumb-space" colspan="2">
              <span class="ratings-thumb" id="ratingsThumb">
                <img src="../assets/img/search-icons/star.png" alt="wifi">
                <label id="ratingsValue">0.0</label>
              </span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="range" name="ratings" min="0" max="10" id="ratings" value="0" oninput="updateRatings();">
            </td>
          </tr>
          <tr>
            <td class="options-clear" onclick="cancellRatings();">
              <h2>Clear</h2>
            </td>
            <td class="options-apply"  onclick="nextsearch(<?php echo $offset; ?>,1);">
              <h2>Apply</h2>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <div class="number-of-guests-filter">
        <label class="Top-label">1-GUEST</label>
        </br>
        <hr class="Top-label-underline"/>
        <table>
          <tr>
            <td colspan="2" class="number-of-guests-options" onclick="updateNumberOfGuests(1);">
              <img src="../assets/img/search-icons/guests.png" alt="wifi">
              <label class="guests-options">1 guest</label>
            </td>
          </tr>
          <tr>
            <td colspan="2"  class="number-of-guests-options" onclick="updateNumberOfGuests(2);">
              <img src="../assets/img/search-icons/guests.png" alt="wifi">
              <label class="guests-options">2 guests</label>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="number-of-guests-options" onclick="updateNumberOfGuests(3);">
              <img src="../assets/img/search-icons/guests.png" alt="wifi">
              <label class="guests-options">3 guests</label>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="number-of-guests-options" onclick="updateNumberOfGuests(4);">
              <img src="../assets/img/search-icons/guests.png" alt="wifi">
              <label class="guests-options">4 guests</label>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="number-of-guests-options" onclick="updateNumberOfGuests(5);">
              <img src="../assets/img/search-icons/guests.png" alt="wifi">
              <label class="guests-options">more or less</label>
            </td>
          </tr>
          <tr>
            <td class="options-clear" onclick="updateNumberOfGuests(0);">
              <h2>Clear</h2>
            </td>
            <td class="options-apply"  onclick="nextsearch(<?php echo $offset; ?>,0);">
              <h2>Apply</h2>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <div class="accommodation-filter">
        <label class="Top-label">ACCOMMODATION</label>
        </br>
        <hr class="Top-label-underline"/>
        <table>
          <tr>
            <td colspan="2" class="number-accommodation-options" onclick="updateAccommodation(1);">
              <img src="../assets/img/search-icons/hotel.png" alt="wifi">
              <label class="accommodation-options">hotel</label>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="number-accommodation-options" onclick="updateAccommodation(2);">
              <img src="../assets/img/search-icons/apartment.png" alt="wifi">
              <label class="accommodation-options">apartment</label>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="number-accommodation-options" onclick="updateAccommodation(3);">
              <img src="../assets/img/search-icons/cottage.png" alt="wifi">
              <label class="accommodation-options">cottage</label>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="number-accommodation-options" onclick="updateAccommodation(4);">
              <img src="../assets/img/search-icons/cabin.png" alt="wifi">
              <label class="accommodation-options">cabin </label>
            </td>
          </tr>
          <tr>
            <td class="options-clear"  onclick="updateAccommodation(0);">
              <h2>Clear</h2>
            </td>
            <td class="options-apply" onclick="nextsearch(<?php echo $offset; ?>,0);">
              <h2>Apply</h2>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <div class="amenities-filter">
        <label class="Top-label">AMENITIES</label>
        </br>
        <hr class="Top-label-underline"/>
        <table>
          <tr>
            <td class="number-ammenities-options" onclick="updateAmenities(1)">
              <img src="../assets/img/search-icons/wifi.png" alt="wifi"><br>
              <label class="amenities-options">Free Wifi</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(2)">
              <img src="../assets/img/search-icons/breakfast.png" alt="wifi"><br>
              <label class="amenities-options">Free Breakfast</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(3)">
              <img src="../assets/img/search-icons/parking.png" alt="wifi"><br>
              <label class="amenities-options">Parking</label>
            </td>
          </tr>
          <tr>
            <td class="number-ammenities-options" onclick="updateAmenities(4)">
              <img src="../assets/img/search-icons/aircon.png" alt="wifi"><br>
              <label class="amenities-options">Air Conditioned</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(5)">
              <img src="../assets/img/search-icons/fitness.png" alt="wifi"><br>
              <label class="amenities-options">Fitness Center</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(6)">
              <img src="../assets/img/search-icons/kid.png" alt="wifi"><br>
              <label class="amenities-options">kid Friendly</label>
            </td>
          </tr>
          <tr>
            <td class="number-ammenities-options" onclick="updateAmenities(7)">
              <img src="../assets/img/search-icons/pet.png" alt="wifi"><br>
              <label class="amenities-options">Pet Friendly</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(8)">
              <img src="../assets/img/search-icons/pool.png" alt="wifi"><br>
              <label class="amenities-options">Pool</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(9)">
              <img src="../assets/img/search-icons/bar.png" alt="wifi"><br>
              <label class="amenities-options">Bar</label>
            </td>
          </tr>
          <tr>
            <td class="number-ammenities-options" onclick="updateAmenities(10)">
              <img src="../assets/img/search-icons/resturant.png" alt="wifi"><br>
              <label class="amenities-options">Restaurant</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(11)">
              <img src="../assets/img/search-icons/kitchen.png" alt="wifi"><br>
              <label class="amenities-options">Kitchen</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(12)">
              <img src="../assets/img/search-icons/shampoo.png" alt="wifi"><br>
              <label class="amenities-options">Shampoo</label>
            </td>
          </tr>
          <tr>
            <td class="number-ammenities-options" onclick="updateAmenities(13)">
              <img src="../assets/img/search-icons/fireplace.png" alt="wifi"><br>
              <label class="amenities-options">Indoor fireplace</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(14)">
              <img src="../assets/img/search-icons/washer.png" alt="wifi"><br>
              <label class="amenities-options">Washer</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(15)">
              <img src="../assets/img/search-icons/iron.png" alt="wifi"><br>
              <label class="amenities-options">Iron</label>
            </td>
          </tr>
          <tr>
            <td class="number-ammenities-options" onclick="updateAmenities(16)">
              <img src="../assets/img/search-icons/dryer.png" alt="wifi"><br>
              <label class="amenities-options">Hair dryer</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(17)">
              <img src="../assets/img/search-icons/laptop.png" alt="wifi"><br>
              <label class="amenities-options">Laptop friendly workspace</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(18)">
              <img src="../assets/img/search-icons/tv.png" alt="wifi"><br>
              <label class="amenities-options">TV</label>
            </td>
          </tr>
          <tr>
            <td class="number-ammenities-options" onclick="updateAmenities(19)">
              <img src="../assets/img/search-icons/crib.png" alt="wifi"><br>
              <label class="amenities-options">Crib</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(20)">
              <img src="../assets/img/search-icons/highchair.png" alt="wifi"><br>
              <label class="amenities-options">High chair</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(21)">
              <img src="../assets/img/search-icons/heating.png" alt="wifi"><br>
              <label class="amenities-options">Heating</label>
            </td>
          </tr>
          <tr>
            <td class="number-ammenities-options" onclick="updateAmenities(22)">
              <img src="../assets/img/search-icons/smokedetector.png" alt="wifi"><br>
              <label class="amenities-options">Smoke detector</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(23)">
              <img src="../assets/img/search-icons/carbonmonoxide.png" alt="wifi"><br>
              <label class="amenities-options">Carbon monoxide detector</label>
            </td>
            <td class="number-ammenities-options" onclick="updateAmenities(24)">
              <img src="../assets/img/search-icons/privateroom.png" alt="wifi"><br>
              <label class="amenities-options">Private bathroom</label>
            </td>
          </tr>
          <tr>
            <td class="silent" style="border:none">
            </td>
            <td class="options-clear" style="border:none"  onclick="updateAmenities(0)">
              <h4><label>Clear</label></h4>
            </td>
            <td class="options-apply" style="border:none" onclick="nextsearch(<?php echo $offset; ?>,0);">
              <h4><label>Apply</label></h4>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <div class="sort-filter">
        <label class="Top-label">SORT</label>
          <br>
        <hr class="Top-label-underline"/>
        <table>
          <tr>
            <td colspan="2" class="number-sort-options" onclick="updateSort(1);">
              <img src="../assets/img/search-icons/best.png" alt="Customer">
              <label class="sort-options">Best Match</label>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="number-sort-options" onclick="updateSort(2);">
              <img src="../assets/img/search-icons/price.png" alt="Customer">
              <label class="sort-options">Lowest Price</label>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="number-sort-options" onclick="updateSort(3);">
              <img src="../assets/img/search-icons/star.png" alt="Customer">
              <label class="sort-options">Highest Ratings</label>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>
<section class="hotels-section">
<?php
}

function setHeaderForResults() {
?>
<script src="../assets/js/results.js"></script>
<main class="main-contents">
<?php
}
function setFooterForResults($num,$offset,$type) {
  $allign = 0;
  $searchType = $type;
  $pre = 'display:block';
  $nex = 'display:block';
if ($offset === 0) {
    $pre = 'display:none';
  }
  if ($num >= 0 && $num < 10) {
    $nex = 'display:none';
  } elseif ( $num >= 10) {
    $allign = 1;
  }

?>
</section>
<div class="next-card">
  <table class="next-table">
    <tr>
      <td>
        <div class="prev-block">
          <button class="next-button" style="<?php echo $pre;?>" onclick="PreviousButton(<?php echo $offset;?>,<?php echo $searchType; ?>)">Previous</button>
        </div>
      </td>
      <td>
        <div class="next-block">
          <button class="next-button" style="<?php echo $nex;?>" onclick="NextButton(<?php echo $offset;?>,<?php echo $searchType; ?>)">Next</button>
        </div>
      </td>
    </tr>
  </table>
</div>
<br>
<?php
 return $allign;
}
function manageResult($row) {
?>
<br>
  <div class="listing-card">
    <table class="listing-table">
      <tr>
        <td rowspan="7" style="width:21.25em;">
          <img class="place-image" src="data:image/jpeg;base64,<?php echo base64_encode($row->Picture); ?>" alt="<?php echo $row->Name; ?>">
      </td>
      </tr>
      <tr>
        <td class="place-table-data1">
          <label class="place-name"><?php echo $row->Name; ?></label>
          <div class="place-price">R<?php echo $row->Price; ?></div>
        </td>
      </tr>
      <tr>
        <td class="place-table-data2">
          <div class="place-ratings">
            <?php
            find_Reviews($row->Rating);
            ?>
          </div>
          <div  class="place-reviews">
           <label><?php echo $row->NumOfRatings; ?> reviews</label>
          </div>
        </td>
      </tr>
      <tr>
        <td class="place-table-data3">
          <div class="place-details ">
            <?php
            echo $row->About;
            ?>
           </div>
        </td>
      </tr>
      <tr>
        <td class="place-table-data4">
          <?php
          find_Accomodation($row->Type);
          ?>
        </td>
      </tr>
      <tr>
        <td class="place-table-data4">
          <?php
          find_Ammenities($row->Amenities);
          ?>
        </td>
      </tr>
      <tr>
        <td class="place-table-data5">
            <form action="/property/listing.php" method="post">
              <input type="hidden" name="listing" value="<?php echo $row->ID;?>">
              <button type="submit" class="place-view" >view</button>
          </form>
        </td>
      </tr>
    </table>
  </div>
<?php
}
function endResult($guests,$type,$sort,$amenities,$price,$ratings,$allign,$place) {
?>
<script>initialize_filters(<?php echo $guests;?>,<?php echo $type;?>,<?php echo $sort;?>,'<?php echo $amenities;?>',<?php echo $price; ?>,<?php echo $ratings; ?>);</script>
<script>alignFooter(<?php echo $allign; ?>);setPlace('<?php echo $place;?>');setRootPath('<?php echo __ROOT__;?>');</script>
</main>

</body>
</html>
<?php
}
function titleResults($row)
{
?>
<tr onclick="thelivesearch('<?php echo $row->Name; ?>',4)">
  <td>
    <img src="<?php find_Accomodation2($row->Type);?>" alt="wifi">
  </td>
  <td>
    <span class="city"><?php echo $row->Name; ?></span>
    <span class="place"><?php echo $row->Nationality; ?></span><br>
    <span class="adress"><?php echo $row->State.','.$row->City; ?></span>
  </td>
</tr>
<?php
}
function locationResults($row)
{
?>
<tr  onclick="thelivesearch('<?php echo $row->State; ?>',3)">
  <td>
    <img src="../assets/img/search-icons/location.png" alt="wifi">
  </td>
  <td>
    <span class="city"><?php echo $row->Nationality; ?></span>
    <span class="place"><?php echo $row->State; ?></span><br>
    <span class="adress"><?php echo $row->City.','.$row->Street; ?></span>
  </td>
</tr>
<?php
}
?>
