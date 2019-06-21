<?php
include '../partials/sidebar.php';
?>
<h1>Profile</h1>
<form action="/database/DBClient.php">
  <label>Name: <input type="text" name="name" placeholder="Name"/></label><br/>
  <label>Surname: <input type="text" name="surname" placeholder="Surname"/></label><br/>
  <label>Rating: 4/5</label><br/>
  <label>Email: <input type="email" name="email" placeholder="Email"/></label><br/>
  <label>Profile Picture <br/>
      <img src="/assets/img/person.png" alt="Persons name"><br/>
    <input type="file" name="profile-picture" accept="image/png, image/jpg"><br/>
  </label>
  <label>Location <br><input type="text" name="location" placeholder="Location"/></label><br/>
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1655.1530836087084!2d18.8624485!3d-33.9332527!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcdb25d85e3a55d%3A0xb72befceeab8779!2sAdmin+A!5e0!3m2!1sen!2sza!4v1549529227891"
    width="400" height="300" frameborder="0" allowfullscreen>
  </iframe>
  <br>
  <label>Profile Description: <br>
    <textarea name="description" id="" cols="30" rows="10"
              placeholder="Enter your Description">
        </textarea>
  </label><br>
  <button>Update</button>
</form>
<form action="">
  <h2>Payment Details</h2>
  <h3></h3>
  <form action="" method="post" title="Card Information">
    <label>Card Holder: <input type="text" name="card-holder"></label><br>
    <label>Month: <input type="number" name="month"></label>
    <label>Year: <input type="number" name="year"></label><br>
    <label>CVV: <input type="number" name="cvv"></label><br>
    <br>
  </form>
  <br><br>
</form>
<button>Delete Account</button>
<footer>
  <fieldset>
      <a href="/about-us.php">About Us</a>
      <a href="/contact-us.php">Contact Us</a>
      <a href="/faq.php">FAQ</a>
      <a href="/legal/terms.html">Terms</a>
      <a href="/legal/policies.html">Policies</a>
      <a href="/legal/privacy-policy.html">Privacy</a>
  </fieldset>
</footer>
</body>
</html>
