<?php
  include '../partials/header.php';
?>
<div class="row">
    <form action="/admin/index.php" method="POST">
        <h1>Listing</h1>
        <br>
        <h3 align="center">Listing information</h3>
        <br>
        <div class="input-container">
            <i class="fa fa-institution icon"></i>
            <input id="apartname" name="apartname" class="input-field" type="text" placeholder="Apartment name" required>
        </div>
        <div class="input-container">
            <i class="fa fa-institution icon"></i>
            <input id="highlights" name="highlights" class="input-field" type="text" placeholder="Enter apartment highlights" required>
        </div>

        <div class="input-container">
            <i class="fa fa-institution icon"></i>
            <input id="amenities" name="amenities" class="input-field" type="text" placeholder="Enter apartment amenities" required>
        </div>

        <div class="input-container">
            <i class="fa fa-institution icon"></i>
            <input id="apartdetails" name="apartdetails" class="input-field" type="text" placeholder="Enter apartment details" required>
        </div>

        <div class="input-container">
            <i class="fa fa-institution icon"></i>
            <input id="state" name="state" class="input-field" type="text" placeholder="province/state" required>
        </div>

        <div class="input-container">
            <i class="fa fa-institution icon"></i>
            <input id="city" name="city" class="input-field" type="text" placeholder="city" required>
        </div>

        <div class="input-container">
            <i class="fa fa-institution icon"></i>
            <input id="saddress" name="saddress" class="input-field" type="text" placeholder="street adress" required>
        </div>

        <div class="input-container">
            <i class="fa fa-institution icon"></i>
            <input id="pcode" name="pcode" class="input-field" type="text" placeholder="Postal Code" required>
        </div>

        <h3 align="center">Host information</h3>
        <br>
        <div class="input-container">
            <i class="fa fa-envelope icon"></i>
            <input id="email" name="email" class="input-field" type="email" placeholder="email" required>
        </div>
        <div class="input-container">
            <button type="submit" name="add unit" value="Edit details" class="btn">Proceed</button>
        </div>
    </form>
</div>
<?php
  include '../partials/footer.php';
?>
<script>
function proceedAddUnit() {
  alert("Listing added!");
  window.location.href = "/admin/index.php";
}
</script>
