<?php
include '../partials/header.php';
?>

<style media="screen">
.footer {
    position: fixed;
    bottom: 0;
}
</style>
<?php
if ( isset( $_POST['form'] ) ) {
$adate = $_REQUEST['checkin'];
$ddate = $_REQUEST['checkout'];
$diff = strtotime($ddate) - strtotime( $adate);
$nights = $diff/86400;
echo $nights;
if(isGuest() || isAdmin()){ ?>
<form name="createBooking" method="post" onsubmit="confirmed()" action="/database/DBClient.php"
    enctype="multipart/form-data">
    <figure class="section-property">
        <h2>Booking Details</h2>
        <div class="input-container">
            <label class="labels-property" name="start_date">Check-in: <?php echo $adate;?><br />
            </label>
            <label class="labels-property" name="end_date">Check-out: <?php echo $ddate;?><br />
            </label>
            <label class="labels-property">Number of nights: <?php echo $nights ?> <br/>
            </label>
        </div>
    </figure>

    <figure class="section-property">
        <input type="hidden" name="id" value="5">
        <input type="hidden" name="user" value="<?php echo  $_SESSION['user']->Email; ?>">
        <h2>Banking details</h2>
        <div class="input-container">
            <?php
    $db = new db();
    $card_email =  $_SESSION['user']->Email;
    $card_holder =  $_SESSION['user']->Card_Holder;
    $card_year =  $_SESSION['user']->Card_Year;
    $card_month =  $_SESSION['user']->Card_Month;
    $card_number =  $_SESSION['user']->Card_Number;
    ?>
            <label class="labels-property">Card-Holder Email: <?php echo $card_email;?>
            </label>
            <label class="labels-property">Card-Holder: <?php echo $card_holder;?>
            </label>
            <label class="labels-property">Card-Year: <?php echo $card_year;?>
            </label>
            <label class="labels-property">Card-Month: <?php echo $card_month;?>
            </label>
            <label class="labels-property">Card-Number: <?php echo $card_number;?>
            </label>
        </div>
    </figure>

    <figure class="section-property">
        <div class="input-container">
            <input type="submit" name="form" value="Book" class="btn">
        </div>
    </figure>
</form>

<?php } else{ ?>

<body onload=noAccess()>

</body>

<?php } ?>

<?php } ?>
<script>
function confirmed() {
    alert("Your booking has been confirmed!");
}

function noAccess() {
    var redirect = confirm("Redirect to homepage");
    if (redirect == true) {
        window.location.href = 'http://clblade-8-flute.cs.sun.ac.za:8083/index.php';
    } else if (redirect == false) {
        header("location:javascript://history.go(-1)");
    }
}
</script>

<?php
include '../partials/footer.php';
?>
