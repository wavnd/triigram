<?php
  include '../../partials/header.php';
?>

<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>

<div class="vertical-center">
    <form action="/database/DBClient.php" method="post" title="Card Information">
    <h1 style="padding-top: 100px;">Edit <?php echo $_SESSION['user']->Card_Type;?> •••• <?php echo substr((string)$_SESSION['user']->Card_Number, 12); ?></h1>
        <div class="input-container">
            <i class="fa fa-cc-mastercard icon"></i>
            <input placeholder="Card Holder" type="text" name="card-number" class="input-field"
                   minlength="16" value="<?php echo $_SESSION['user']->Card_Number; ?>" required>
        </div>
        <div class="input-container">
            <i class="fa fa-cc-mastercard icon"></i>
            <input placeholder="Card Holder" type="text" name="card-holder" class="input-field"
                   value="<?php echo $_SESSION['user']->Card_Holder; ?>" required>
        </div>
        <div class="input-container">
            <input placeholder="Month" type="number" name="month" class="input-field"
                   value="<?php echo trim($_SESSION['user']->Card_Month); ?>" required>
            <input placeholder="Year" type="number" name="year" class="input-field"
                   value="<?php echo trim($_SESSION['user']->Card_Year); ?>" required>
        </div>
        <div class="input-container">
            <input placeholder="CVV" type="number" name="cvv" class="input-field"
                   value="<?php echo trim($_SESSION['user']->CVV); ?>" required>
        </div>
        <div class="input-container">
            <input type="submit" name="form" value="Edit Card Details" class="btn">
        </div>
        <div class="input-container">
            <a href="/user/profile/view.php" class="btn">Remove Card</a>
        </div>
    </form>
</div>

<?php
  include '../../partials/footer.php';
?>
