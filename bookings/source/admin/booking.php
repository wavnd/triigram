<?php
include '../partials/sidebar.php';
$db = new db();
$booking = $db->getBooking($_GET['id']);
if (!$booking) {
   // Tell user that this booking does not exist no more and redirect
    header('Location /admin');
}
$listing = $db->getListing($booking->Listing);
?>

<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
    .head {
        width: 15%;
    }
</style>

<div class="main" style="padding-bottom: 450px;">
    <h1 class="header-text">Booking - ID <?php echo $_GET['id']; ?></h1>
    <h2>Booking Details</h2>
    <form method="post" action="/database/DBClient.php">
        <table>
            <tbody>
            <tr>
                <td class="head">ID</td>
                <td><?php echo $booking->ID; ?></td>
            </tr>
            <tr>
                <td class="head">Listing ID</td>
                <td><?php echo $booking->Listing; ?></td>
            </tr>
            <tr>
                <td class="head">Start Date</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-key icon"></i>
                        <input class="input-field" type="date" value="<?php echo $booking->Start_Date; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="head">End Date</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-key icon"></i>
                        <input class="input-field" type="date" value="<?php echo $booking->End_Date; ?>">
                    </div>

                </td>
            </tr>
            </tbody>
        </table>
        <button class="btn index-container" value="Save Booking Details" type="submit">Save Booking Details</button>
    </form>
    <form action="/database/DBClient.php" method="post">
    <h2>Listing Detail - ID <?php echo $booking->Listing; ?></h2>
    <table>
        <tbody>
        <tr>
            <td class="head">ID</td>
            <td><?php echo $listing->ID; ?></td>
        </tr>
        <tr>
            <td class="head">Host</td>
            <td><?php echo $listing->Host; ?></td>
        </tr>
        <tr>
            <td class="head">Created At</td>
            <td><?php echo $listing->Created_At; ?></td>
        </tr>
        <tr>
            <td class="head">Name</td>
            <td><?php echo $listing->Name; ?></td>
        </tr>
        <tr>
            <td class="head">Type</td>
            <td><?php include __ROOT__. '/partials/property-type.php' ?></td>
        </tr>
        <tr>
            <td class="head">Price</td>
            <td>
                <div class="input-container" style="max-width: 100%;">
                    <i class="fa fa-key icon"></i>
                    <input class="input-field" type="number" min="1" step="1" name="guests" value="<?php echo $listing->Price; ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td class="head">About</td>
            <td>
                <div class="input-container" style="max-width: 100%;">
                    <i class="fa fa-key icon"></i>
                    <textarea name="about" id="" cols="30" class="input-field" rows="10"><?php echo $listing->About; ?></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td class="head">Street</td>

            <td>
                <div class="input-container" style="max-width: 100%;">
                    <i class="fa fa-key icon"></i>
                    <input class="input-field" type="text" name="street" value="<?php echo $listing->Street; ?>">
                </div>

            </td>
        </tr>
        <tr>
            <td class="head">City</td>
            <td>
                <div class="input-container" style="max-width: 100%;">
                    <i class="fa fa-key icon"></i>
                    <input class="input-field" type="text" name="city" value="<?php echo $listing->City; ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td class="head">State</td>
            <td>
                <div class="input-container" style="max-width: 100%;">
                    <i class="fa fa-key icon"></i>
                    <input class="input-field" type="text" name="state" value="<?php echo $listing->State; ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td class="head">Postal Code</td>
            <td>
                <div class="input-container" style="max-width: 100%;">
                    <i class="fa fa-key icon"></i>
                    <input class="input-field" type="text" name="postal" value="<?php echo $listing->Postal; ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td class="head">Country</td>
            <td><?php include __ROOT__. '/partials/property-nationality.php' ?></td>
        </tr>
        <tr>
            <td class="head">Latitude</td>
            <td>
                <div class="input-container" style="max-width: 100%;">
                    <i class="fa fa-key icon"></i>
                    <input class="input-field" type="text" name="latitude" value="<?php echo $listing->Latitude; ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td class="head">Longitude</td>
            <td>
                <div class="input-container" style="max-width: 100%;">
                    <i class="fa fa-key icon"></i>
                    <input class="input-field" type="text" name="longtitude" value="<?php echo $listing->Longitude; ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td class="head">Min Length of Stay</td>
            <td><?php echo $listing->MinLength; ?></td>
        </tr>
        <tr>
            <td class="head">Number of Guests</td>
            <td><?php echo $listing->NumOfGuest; ?></td>
        </tr>
        <tr>
            <td class="head">Number of Ratings</td>
            <td><?php echo $listing->NumOfRatings; ?></td>
        </tr>
        <tr>
            <td class="head">Rating</td>
            <td><?php echo $listing->Ratings; ?></td>
        </tr>
        </tbody>
    </table>
    </form>
    <?php getReviews($booking->Listing); ?>
    <script>
        window.onload = function () {
            setTimeout(() => {
                document.getElementById('type').value = <?php echo $listing->Type; ?>;
                document.getElementById('type').value = <?php echo $listing->Nationality; ?>;
            }, 5000);

        }
        </script>
    <?php
    include '../partials/footer.php';
?>
