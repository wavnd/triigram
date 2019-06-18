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
                        <input name="start-date" class="input-field" type="date" value="<?php echo $booking->Start_Date; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="head">End Date</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-key icon"></i>
                        <input name="end-date" class="input-field" type="date" value="<?php echo $booking->End_Date; ?>">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <input type="hidden" name="listing" value="<?php echo $booking->Listing; ?>">
        <input type="hidden" name="id" value="<?php echo $booking->ID; ?>">
        <input type="hidden" name="guest" value="<?php echo $_SESSION['user']->Email; ?>">
        <div class="input-container">
        <button class="btn index-container" name="form" type="submit" value="Save Booking Details">Save Booking Details</button>
        <button class="btn index-container" name="form" type="submit" value="Delete Booking">Delete Booking</button>
        </div>
    </form>
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
            <td><?php echo $listing->type ?></td>
        </tr>
        <tr>
            <td class="head">Price</td>
            <td>R<?php echo $listing->Price; ?></td>
        </tr>
        <tr>
            <td class="head">About</td>
            <td>
                    <p><?php echo $listing->About; ?></p>
            </td>
        </tr>
        <tr>
            <td class="head">Street</td>

            <td>
                    <p><?php echo $listing->Street; ?></p>
            </td>
        </tr>
        <tr>
            <td class="head">City</td>
            <td>
                    <p><?php echo $listing->City; ?></p>
            </td>
        </tr>
        <tr>
            <td class="head">State</td>
            <td>
                    <p><?php echo $listing->State; ?></p>
            </td>
        </tr>
        <tr>
            <td class="head">Postal Code</td>
            <td>
                    <p><?php echo $listing->Postal; ?></p>
            </td>
        </tr>
        <tr>
            <td class="head">Country</td>
            <td><?php echo $listing->Nationality ?></td>
        </tr>
        <tr>
            <td class="head">Latitude</td>
            <td>
                    <p><?php echo $listing->Latitude; ?>"</p>

            </td>
        </tr>
        <tr>
            <td class="head">Longitude</td>
            <td>
                    <p><?php echo $listing->Longitude; ?></p>
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
