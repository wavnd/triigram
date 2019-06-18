<?php
    include '../../partials/header.php';
?>
<style>
    .footer {
        position: fixed;
    }
</style>

<div class="row">
    <form action="/database/DBClient.php" name="add-card" method="post" title="Card Information">
        <h1>Add New Card</h1>
        <div class="input-container">
            <i class="fa fa-cc-mastercard icon"></i>
            <input placeholder="Card Holder" type="text" name="card-holder" class="input-field" required>
        </div>
        <div class="input-container">
            <input placeholder="Month" type="number" name="month" class="input-field" required>
            <input placeholder="Year" type="number" name="year" class="input-field" required>
        </div>
        <div class="input-container">
            <input placeholder="CVV" type="number" name="cvv" class="input-field" required>
        </div>
        <div class="input-container">
            <input type="submit" name="form" value="Add Card Details" class="btn">
        </div>
    </form>
</div>
<?php
    include '../../partials/footer.php';
?>