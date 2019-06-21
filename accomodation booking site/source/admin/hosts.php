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
    <h1 class="header-text">Hosts</h1>
    <table class="host-results sortable">
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
        $hosts = $db->getUserOfCategory('host');
        foreach ($hosts as $value) {
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
</div>

<?php
include '../partials/footer.php';
?>
<script type="text/javascript" src="../assets/js/sort-tables.js"></script>
