<?php
include '../partials/header.php';
?>
<div class="row">
    <form name="createListings" method="post" action="/database/DBClient.php" enctype="multipart/form-data">
        <h1>Your Listing</h1>

        <?php
        if (isAdmin()) {
        ?>
        <div class="input-container" style="max-width: 100%;">
            <i class="fa fa-institution icon"></i>
            <select class="input-field" name="host">
                <?php
                $db = new db();
                $hosts = $db->getUserOfCategory('host');
                foreach ($hosts as $host) {
                    ?>
                <?php $email = $host->Email; ?>
                <option value=<?php echo $host->Email; ?>> <?php $host->Email; ?><?php echo $host->Email; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <?php
            } else if (isHost()) {
                    ?>
        <input type="hidden" name="host" value="<?php echo $_SESSION['user']->Email; ?>">
        <?php
                } else {
                    header('Location: /guest/');
                }
                ?>



        <figure class="section-property">
            <h2>Property Details</h2>

            <div class="input-container">
                <label class="labels-property">What is the name of your listing?
                    <input class="input-field" type="text" name="name" required>
                </label>
            </div>

            <div class="input-container">
                <label class="labels-property">What is the minimum number of nights guests can stay?
                    <input class="counter-field" type="number" min="1" step="1" value="1" name="min_nights" required>
                </label>
            </div>
            <div class="input-container">
                <label class="labels-property">Please enter information about your listing:
                    <textarea class="input-field" rows="4" cols="50" name="about"></textarea>
                </label>
            </div>

            <div class="input-container">
                <label class="labels-property">Available from:
                    <input id="dob" name="a_from" type="date" required class="input-field">
                </label>
            </div>

            <div class="input-container">
                <label class="labels-property">Available until:
                    <input id="dob" name="a_until" type="date" required class="input-field">
                </label>
            </div>

            <div class="input-container">
                <label class="labels-property">Check-in time:
                    <input id="dob" name="check_in" type="time" required class="input-field">
                </label>
            </div>

            <div class="input-container">
                <label class="labels-property">Check-out time:
                    <input id="dob" name="check_out" type="time" required class="input-field">
                </label>
            </div>


        </figure>
        <figure class="section-property">
            <h2>Property Location</h2>
            <div class="input-container">
                <?php include __ROOT__ . '/partials/property-nationality.php' ?>
            </div>

            <div class="input-container">
                <i class="fa fa-institution icon"></i>
                <input class="input-field" type="text" placeholder="Street address" name="street" required>
            </div>

            <div class="input-container">
                <i class="fa fa-institution icon"></i>
                <input class="input-field" type="text" placeholder="State" name="state" required>
            </div>

            <div class="input-container">
                <i class="fa fa-institution icon"></i>
                <input class="input-field" type="text" placeholder="Postcode" name="postcode" required>
            </div>

            <div class="input-container">
                <i class="fa fa-institution icon"></i>
                <input class="input-field" type="text" placeholder="City" name="city" required>
            </div>

            <div class="input-container">
                <i class="fa fa-institution icon"></i>
                <input class="input-field" type="text" placeholder="Latitude" name="latitude" required>
            </div>

            <div class="input-container">
                <i class="fa fa-institution icon"></i>
                <input class="input-field" type="text" placeholder="Longitude" name="longitude" required>
            </div>

        </figure>
        <figure class="section-property">
            <h2>Property Type</h2>
            <div class="input-container">
                <?php include __ROOT__ . '/partials/property-type.php' ?>
            </div>
        </figure>

        <figure class="section-property">
            <h2>Room Information</h2>
            <div class="input-container">
                <label class="labels-property">How many guests can stay? <br />
                    <input class="counter-field" type="number" min="1" step="1" value="1" name="guests" required>
                </label>
            </div>


        </figure>

        <figure class="section-property">
            <h2>What does your place look like?</h2>
            <div class="input-container">
                <i class="labels-property"> Add at least one photo now, you can add more later <br /><br />
                    <input class="file-upload" type="file" id="pictures" name="pictures" accept="image/*"
                        onchange="upload()">
                </i>
            </div>

            <div class="input-container">
                <img src="" alt="" id="image" name="image" style="width: 100%;">
            </div>
        </figure>

        <figure class="section-property">
            <h2>What can guests use at your place?</h2>
            <div class="input-container">
                <ul class="property-checkbox">
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="wifi">Free
                            Wifi</label><br>
                    </li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="breakfast">Free
                            Breakfast</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]"
                                value="parking">Parking</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="aircon">Air
                            Conditioning</label><br>
                    </li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="fitness-center">Fitness
                            Center</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="kid-friendly">Kid
                            Friendly</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="pet-friendly">Pet
                            Friendly</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]"
                                value="swimming-pool">Pool</label><br>
                    </li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="bar">Bar</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]"
                                value="restaurant">Restaurant</label><br>
                    </li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]"
                                value="kitchen">Kitchen</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]"
                                value="shampoo">Shampoo</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="indoor-fireplace">Indoor
                            Fireplace</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="washer">Washer</label><br>
                    </li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="iron">Iron</label><br>
                    </li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="dryer">Hair
                            dryer</label><br>
                    </li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="laptop-area">Laptop
                            Friendly workspace</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="tv">TV</label><br>
                    </li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="crib">Crib</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="high-chair">High
                            chair</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]"
                                value="heating">Heating</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="smoke-detector">Smoke
                            Detector</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="carbon-detector">Carbon
                            Monoxide Detector</label><br></li>
                    <li><label><input class="check1" type="checkbox" name="amenity[]" value="private-bathroom">Private
                            bathroom</label><br></li>
                </ul>
            </div>
        </figure>

        <figure class="section-property">
            <h2>How much do you want to earn per night?</h2>
            <div class="input-container">
                <label class="labels-property">Earnings per night in ZAR:
                    <input class="input-field" type="text" name="price" required>
                </label>
            </div>

            <div class="input-container">
                <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
            </div>

        </figure>
        <figure class="section-property">
            <div class="input-container">
                <input type="submit" name="form" value="Create Property Listing" class="btn">
            </div>
        </figure>
    </form>



    <script>
    function upload() {
        let file = document.getElementById('pictures').files[0]; //Files[0] = 1st file
        let image = document.getElementById('image');
        let reader = new FileReader();
        reader.onload = function() {
            image.src = reader.result;
        };
        reader.readAsDataURL(file);
    }
    </script>




    <?php
    include '../partials/footer.php';
    ?>