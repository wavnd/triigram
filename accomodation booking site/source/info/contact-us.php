<?php
include '../partials/header.php';
?>
<div class="row">
    <h1>Contact Us</h1>
    <div class="column">
        <div class="card-column">
            <h3>Office Hours:</h3>
            <fieldset>
                <p>
                    <strong>Monday to Friday: </strong>08:00 – 17:00<br/>
                    <strong>Saturday: </strong>09:00 – 14:00<br/>
                    <strong>Public Holidays: </strong>09:00 – 13:00 <br/>
                </p>
            </fieldset>
        </div>
    </div>

    <div class="column">
        <div class="card-column">
            <h3>Location:</h3>
            <fieldset>
                  <iframe class="input-field"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1655.1530836087084!2d18.8624485!3d-33.9332527!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcdb25d85e3a55d%3A0xb72befceeab8779!2sAdmin+A!5e0!3m2!1sen!2sza!4v1549529227891"  width="auto" height="auto" frameborder="0" allowfullscreen>
                  </iframe>
                    <p>
                        <strong>For all travel enquiries, email use at:</strong>
                        <a href="mailto:help@bigfeet.co.za">help@bigfeet.co.za</a> <br>
                        <strong>or call us at:</strong> <br>
                        <a href="tel:0215684325">021 568 4325</a>
                    </p>
            </fieldset>
        </div>
    </div>

    <div class="column">
        <div class="card-column">
            <h2>Address:</h2>
            <fieldset>
                <p>
                    52 Ryneveld Street <br/>
                    Stellenbosch Central <br/>
                    Stellenbosch <br/>
                    7600
                </p>
            </fieldset>
        </div>
    </div>
</div>

<form action="/action_page.php">
  <h1>Inquiry Form</h1>
    <div class="input-container">
        <i class="fa fa-user icon"></i>
        <input id="fname" name="fname" class="input-field" type="text" placeholder="first name" required>
    </div>

    <div class="input-container">
        <i class="fa fa-user icon"></i>
        <input id="lname" name="lname" class="input-field" type="text" placeholder="last name" required>
    </div>

    <div class="input-container">
        <i class="fa fa-at icon"></i>
        <input id="email" name="email" class="input-field" type="email" placeholder="email" required>
    </div>

    <div class="input-container">
        <i class="fa fa-comment icon"></i>
        <input id="subject" name="subject" class="input-field" type="text" placeholder="subject" required>
    </div>

    <div class="input-container">
        <i class="fa fa-envelope icon"></i>
        <textarea id="message" name="message" class="input-field" placeholder="Write something.." style="height:12.5em" required></textarea>
    </div>

    <div class="input-container">
        <input type="submit" name="submit" value="Send Inquiry" class="btn">
    </div>
</form>
<?php
include '../partials/footer.php';
?>
