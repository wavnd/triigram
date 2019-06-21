<?php
    include 'partials/header.php';
    $data = new db();
    $listings = $data->getLatestListings();
    //error_reporting(E_ALL);
    //ini_set('display_errors', 1);
?>

<div class="hero-image">
    <div class="hero-text">
        <h1 style="font-size:2.5em">Search Destinations</h1>
        <form action="/property/results.php" method="post" name="search">
            <div class="input-container">
                <i class="fa fa-search icon"></i>
                <input class="input-field" type="search" placeholder="Search Destinations" name="search" onkeyup="showResult(this.value)" required>
                <div id="livesearch"></div>
            </div>
        </form>
    </div>
</div>

<div class="parallax">
        <h1>Most Recent Listings Added</h1>

        <?php for ($i = 0; $i < 6; $i++) {
            if($i === 0 || $i === 3) { ?>
                <div class="row">
            <?php } ?>
        <div class="column">
            <div class="card-column">
                <div class="index-container">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($listings[$i]->Picture); ?>" alt="<?php
                    echo $listings[$i]->Name; ?>"
                        style="width:100%;">
                    <div class="index-content">
                        <h6><?php echo $listings[$i]->Name; ?></h6>
                        <p class="index-para"><?php echo substr($listings[$i]->About,0, 60); ?>...</p>
                        <?php displayRatings($listings[$i]->Price, $listings[$i]->Rating, $listings[$i]->ID);?>
                    </div>
                </div>
            </div>
        </div>
            <?php if ($i === 2 || $id === 5) { ?>
                </div>
            <?php } ?>
        <?php } ?>
</div>

<?php
function displayRatings($price, $ratings, $id) {
    echo('<fieldset>');
    echo('<legend> R' . $price .'</legend>');
    $counter = 0;
    while ($counter < $ratings) {
        echo('<img src="/assets/img/icons/star.png" alt="star" class="index-star">');
        ++$counter;
    }
    echo('<a class="anchor-tag" href="/property/listing.php?id='.$id.'">more<i class="fa fa-paper-plane"></i></a>');
    echo('</fieldset>');
}
?>

    <script src="/assets/js/live-search.js"></script>
<?php
    include 'partials/footer.php';
?>
