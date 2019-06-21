<?php
include '../partials/header.php';
?>

<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>
<div class="vertical-center">
    <form action="/database/DBClient.php" method="post" name="reset-password">
        <h1 style="padding-top: 6.25em;">Reset Password</h1>
        <div class="input-container">
            <i class="fa fa-envelope icon"></i>
            <input id="email" name="email" class="input-field" type="text" placeholder="email" required>
        </div>
        <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input id="pass0" name="pass0" class="input-field" type="password" placeholder="password" required>
        </div>
        <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input id="pass1" name="pass1" class="input-field" type="password" placeholder="confirm password" required>
        </div>
        <div class="input-container">
            <input type="submit" name="form" value="Forgot Password" class="btn">
        </div>
    </form>
</div>
<?php
include '../partials/footer.php';
?>
