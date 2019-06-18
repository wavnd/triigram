<?php
include '../partials/sidebar.php';
$db = new db();
?>
<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>
<div class="main">
    <h1 class="header-text">Admin</h1>
    <table>
        <tr>
            <th scope="col">Type</th>
            <th scope="col">Amount</th>
        </tr>
        <tr>
            <td>
                <a href="/admin/guests.php">Number of Guests</a>
            </td>
            <td>
                <?php echo $db->getCategoryCount('guest'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <a href="/admin/hosts.php">Number of Hosts</a>
            </td>
            <td>
                <?php echo $db->getCategoryCount('host'); ?>
            </td>
        </tr>
        <tr>
            <td>
                Number of Admins
            </td>
            <td>
                <?php echo $db->getCategoryCount('admin'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <a href="/admin/listings.php">Number of Listings</a>
            </td>
            <td>
                <?php echo $db->getListingsCount(); ?>
            </td>
        </tr>
        <tr>
            <td>
                <a href="/admin/bookings.php">Number of bookings</a>
            </td>
            <td>
                <?php echo $db->getBookingsCount(); ?>
            </td>
        </tr>
    </table>
</div>

<?php
    include '../partials/footer.php';
?>
