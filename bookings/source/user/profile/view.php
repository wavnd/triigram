<?php
include '../../partials/sidebar.php';
$user = $_SESSION['user'];
if($_GET) {
    $email = $_GET['email'];
    if ($email) {
        $data = new db();
        $user = $data->getUser($email);
    }
}
?>
<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>
<link rel="stylesheet" href="/assets/css/overview-stats.css">
<body onload="delayMap()">
    <div class="main" style="padding-bottom: 350px;">
        <div class="os-row" style="auto;">
            <div class="or-card">

            <h1>My Profile</h1>
                <div class="or-column">
                    <img src="<?php echo $user->Picture; ?>" alt="Profile Picture" class="profile-picture"
                         width="200.0em;">
                </div>
                <div class="or-column">
                    <strong>Name : </strong> <?php echo $user->Name; ?><br/>
                    <strong>Surname : </strong> <?php echo $user->Surname; ?><br/>
                    <strong>Email : </strong> <?php echo $user->Email; ?><br/>
                    <strong>Contact : </strong> <?php echo $user->Cell; ?><br/>
                    <strong>DOB : </strong> <?php echo $user->DOB; ?><br/>
                    <strong>Bio : </strong>
                    <p><?php echo $user->Bio ?></p>
                </div>
            </div>
        </div>

        <div class="os-row">
            <div class="os-column">
                <div class="os-card">
                    <div id="loader"></div>
                    <div id="myDiv" class="animate-bottom" style="display:none;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1655.1530836087084!2d18.8624485!3d-33.9332527!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcdb25d85e3a55d%3A0xb72befceeab8779!2sAdmin+A!5e0!3m2!1sen!2sza!4v1549529227891"
                            width="100%" height="410px" frameborder="0" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="os-column">
                <div class="os-card">
                    <h2 style="padding-top: 10px; margin-bottom: 0; margin-top: 0;">Payment Details</h2>
                    <?php if ($user->Card_Number) { ?>
                        <form action="edit-card.php" title="Card Information">
                            <h3>Master Card •••• <?php echo substr((string)$user->Card_Number, 12); ?></h3>
                            <p>
                                <strong>Card Holder: </strong><?php echo $user->Card_Holder; ?><br>
                                <strong>Month : </strong><?php echo $user->Card_Month; ?>
                                <strong>Year : </strong><?php echo $user->Card_Year; ?><br>
                                <strong>CVV : </strong><?php echo $user->CVV; ?><br>
                            </p>
                        </form>
                        <div class="container">
                            <div class="input-container" style="max-width: 100%;">
                                <a href="/user/profile/edit-card.php" class="btn">Edit Card Details</a>
                            </div>
                            <div class="input-container" style="max-width: 100%;">
                                <?php if ($email) { ?>
                                    <a class="btn" href="edit.php?email=<?php echo $email; ?>">Edit Profile</a>
                                <?php } else { ?>
                                    <a class="btn" href="change-password.php">Change Password</a>
                                    <a class="btn" href="edit.php">Edit Profile</a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php  } else { ?>
                        <h3>Master Card •••• ••••••••••••</h3>
                        <p>
                            <strong>Card Holder: </strong>•••••••• ••••••••<br>
                            <strong>Month      : </strong>••<br>
                            <strong>Year       : </strong>••••<br>
                            <strong>CVV        : </strong>••••<br>
                        </p>
                        <div class="container">
                            <div class="input-container" style="max-width: 100%;">
                                <a class="btn" href="add-card.php">Add new Card</a>
                            </div>
                            <?php if ($email) { ?>
                                <a class="btn" href="edit.php?email=<?php echo $email; ?>">Edit Profile</a>
                            <?php } else { ?>
                                <a class="btn" href="change-password.php">Change Password</a>
                                <a class="btn" href="edit.php">Edit Profile</a>
                            <?php } ?>
                        </div>
                    <?php  }  ?>
                </div>
            </div>
        </div>
        <div class="input-container" style="max-width: 100%;">
            <button class="btn" onclick="listView()"><i class="fa fa-bars"></i> List</button>
            <button class="btn" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../assets/js/overview-stats.js"></script>

<?php
    include '../../partials/footer.php';
?>
