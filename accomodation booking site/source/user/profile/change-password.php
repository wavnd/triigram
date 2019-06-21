<?php
include '../../partials/header.php';
?>

<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>

<h1 style="padding-top: 100px;">Change Password</h1>
<div class="row">
    <form action="/database/DBClient.php" method="post" name="change-password">
        <div class="input-container">
            <input placeholder="Current Password" type="password" name="password" class="input-field" required>
        </div>
        <div class="input-container">
            <input placeholder="New Password" type="password" name="password1" class="input-field" required>
        </div>
        <div class="input-container">
            <input placeholder="Confirm Password" type="password" name="password2" class="input-field" required>
        </div>
        <div class="input-container">
            <input type="submit" name="form" value="Change Password" class="btn">
        </div>
    </form>
</div>
<?php
include '../../partials/footer.php';
?>
