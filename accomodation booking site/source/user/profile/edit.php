<?php
include '../../partials/header.php';
//$email = $_SERVER['QUERY_STRING'];
?>

<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>

<div class="main" style="padding-bottom: 350px;">
    <div class="row">
    <form action="/database/DBClient.php" name="edit-profile" method="POST" title="Edit Information">
            <h1>Edit Information</h1>
            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input id="fname" name="fname" class="input-field" type="text" placeholder="first name"
                       required value="<?php echo ltrim($_SESSION['user']->Name); ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input id="lname" name="lname" class="input-field" type="text" placeholder="last name" required
                       value="<?php echo trim($_SESSION['user']->Surname); ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-envelope icon"></i>
                <input id="email" name="email" class="input-field" type="email" placeholder="email" required
                       value="<?php echo trim($_SESSION['user']->Email); ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-institution icon"></i>
                <input id="state" name="state" class="input-field" type="text" placeholder="province/state" required
                       value="<?php echo trim($_SESSION['user']->State); ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-institution icon"></i>
                <input id="city" name="city" class="input-field" type="text" placeholder="city" required
                       value="<?php echo trim($_SESSION['user']->City); ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-institution icon"></i>
                <input id="saddress" name="saddress" class="input-field" type="text" placeholder="street adress"
                       required value="<?php echo trim($_SESSION['user']->Street); ?>">
            </div>

            <div class="input-container">
                <i class="fa fa-institution icon"></i>
                <input id="pcode" name="pcode" class="input-field" type="text" placeholder="Postal Code" required
                       value="<?php echo trim($_SESSION['user']->Postal); ?>">
            </div>
                <div class="input-container">
                <i class="fa fa-institution icon"></i>
                <textarea name="pbio" class="input-field" cols="30" rows="10" width="100%"><?php echo trim($_SESSION['user']->Bio); ?></textarea>
            </div>
            <div class="input-container">
                <input type="submit" name="form" value="Edit User Profile" class="btn">
            </div>
        </form>
    </div>

</div>

<script>
function proceedEditUser() {
  alert("User information updated!");
  window.location.href = "/admin/index.php";
}
</script>

<?php
include '../../partials/footer.php';
?>
