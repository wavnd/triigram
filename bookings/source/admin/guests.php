<?php
include '../partials/sidebar.php';
?>

<link rel="stylesheet" href="../assets/css/sidebar.css">
<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>

<div class="main" style="padding-bottom: 350px">
    <h1 class="header-text">Guests</h1>
    <table class="guests-results sortable">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $db = new db();
        $guests = $db->getUserOfCategory('guest');
        foreach ($guests as $value) {
            ?>
            <tr onclick="indexClick('/user/profile/view.php?email='+<?php echo $value->Email; ?>)">
                <td><?php echo $value->Name; ?></td>
                <td><?php echo $value->Surname; ?></td>
                <td><?php echo $value->Email; ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    </table>
    <br><br>
    <div class="input-container" style="max-width: 100%;">
        <a href="/user/profile/add-user.php" class="btn">Add New Guest</a>
    </div>
</div>


<?php
    include '../partials/footer.php';
?>
<script type="text/javascript" src="../assets/js/sort-tables.js"></script>
<script type="text/javascript" src="../assets/js/signout-modal.js"></script>
