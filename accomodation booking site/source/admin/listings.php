<?php
include '../partials/sidebar.php';
?>

<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>

<div class="main" style="padding-bottom: 450px;">
    <h1 class="header-text">Listings</h1>
    <table class="listing-results sort">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Host</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Price</th>
            <th scope="col">Available</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $db = new db();
        $listings = $db->getAllListings();
        foreach ($listings as $value) {
        ?>
            <tr onclick="indexClick('/admin/listing.php?id='+<?php echo $value->ID; ?>)">
                <td><?php echo $value->ID; ?></td>
                <td><?php echo $value->Host; ?></td>
                <td><?php echo $value->Name; ?></td>
                <?php $temp = ''; ?>
                <?php switch ($value->Type) {
                        case "1": $temp .= 'Hotel';      break;
                        case "2": $temp .= 'Appartment'; break;
                        case "3": $temp .= 'Cottage';    break;
                        case "4": $temp .= 'Cabin';      break;
                } ?>
                <td><?php echo $temp; ?></td>
                <td><?php echo $value->Price; ?></td>
                <td><?php echo $value->Available;?></td>
            </tr>
        <?php  }  ?>
        </tbody>
    </table>
    <br><br>
    <div class="input-container" style="max-width: 100%;">
        <a href="/property/index.php" class="btn">Add New Listing</a>
    </div>
</div> 

<?php
    include '../partials/footer.php';
?>
