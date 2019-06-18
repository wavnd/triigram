<?php
    include '../partials/header.php';
    if (isLoggedIn()) {
        header('Location: /');
    }
?>
<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>
<div class="vertical-center">
    <form  action="/database/DBClient.php" method="post" name="login" onsubmit="return validateLogin();">
        <h1 style="padding-top: 100px;">Login</h1>
        <div class="input-container">
            <i class="fa fa-envelope icon"></i>
            <input id="email" name="email" class="input-field" type="email" placeholder="email" required>
        </div>
        <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input id="password" name="password" class="input-field" type="password" placeholder="password" required>
        </div>
        <div id="error" class="error" style="display: <?php echo ($_SESSION['error'] ? 'block' : 'none' )?>;">
            <p class="error-message-php" id="error-message-php" style="align-content: center">
                <?php echo $_SESSION['error'] ?>
            </p>
            <p class="error-message-js" id="error-message-js"></p>
        </div>
        <div class="input-container">
            <input type="submit" name="form" value="Login" class="btn">
        </div>
        <div class="input-container">
            <a href="/user/reset-password.php" class="btn">Forgot Password</a>
        </div>
        <div class="input-container">
            <a href="/user/register.php" class="btn">Create Account</a>
        </div>
    </form>
</div>
<script src="/assets/js/form-validation.js"></script>
<?php
    include '../partials/footer.php';
?>
