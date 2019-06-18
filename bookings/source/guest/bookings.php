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
    <h1 class="header-text">Bookings</h1>
    <table>
        <thead>
        <tr id="table-search">
            <th scope="col">ID</th>
            <th scope="col">Listing ID</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
        </tr>
        </thead>
        <tbody>
        <?php $db = new db();
        $listings = $db->getUserBookings($_SESSION['user']->Email);
        foreach ($listings as $value) {  ?>
            <tr onclick="indexClick('/guest/booking.php?id='+ <?php echo $value->ID; ?>)">
                <td><?php echo $value->ID; ?></td>
                <td><?php echo $value->Listing; ?></td>
                <td><?php echo $value->Start_Date; ?></td>
                <td><?php echo $value->End_Date; ?></td>
            </tr>
        <?php   } ?>
        </tbody>
    </table>

    <br><br>
    <div class="input-container" style="max-width: 100%;">
        <a href="/property/venue-edit.php" class="btn">Add New Booking</a>
    </div>
</div>

<script src="/assets/js/search-tables.js"></script>
<?php
include '../partials/footer.php';
?>
