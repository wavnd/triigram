<?php
include '../partials/header.php';
?>

<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }
</style>

<body>
<ul class="topnav">
    <li><a class="active" href="/source/index.phpdex.php"><span
                class="home-link">Bigfeet</span> <img src="/source/assets/img/logo.png"
                                          alt="Logo" class="logo"></a></li>
    <li class="topnav-menu"><a href="/testimonials.php">Testimonials</a></li>
    <li class="topnav-menu"><a href="/contact-us.php">Contact</a></li>
    <li class="topnav-menu"><a href="/about-us.php">About</a></li>
    <li class="topnav-menu"><a href="/faq.php">FAQ</a></li>
    <li class="topnav-menu"><a href="/source/user/register.html">Sign-up</a></li>
    <li class="topnav-menu"><a href="/source/user/login.html">Sign-in</a></li>
</ul>
<style>
  .img {
    border-radius: 50%;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }

  .column-as {
    text-align: center;
  }

  .column-as a {
    padding-right: 5em;
    padding-bottom: 3em;
  }

  .saved-as {
    color: black;
    text-decoration: none;
    font-size: 2em;

  }

  .section {
    border: 0.625em solid;
    box-sizing: content-box;
    border-width: 0.125em;
    padding-top: 0.3125em;
    padding-bottom: 0.3125em;
  }

  .img:hover {
    border: 0.625em solid #05386B;
  }

  .description li {
    text-align: center;
    display: block;
    font-size: large;
  }


  h3 {
    text-align: center;
    padding-top: 0.3125em;
    display: block;
  }


</style>


<figure class="section">
  <h1>Stellenbosch Hotel</h1>
  <h3>Corner of Dorp & Andringa Streets, Stellenbosch, 7600</h3>
</figure>
<img class="img" src="/source/assets/img/venue/room.jpg" alt="hotel1" width="500" height="400">
<h2>Hotel</h2>
<figure class="section">
  <div class="description">
    <ul>
      <li>Bedroom: 1 <br></li>
      <li>Bathroom: 1 <br></li>
      <li>Guests: 2 <br></li>
      <li>Price per night: ZAR 1550</li>
    </ul>
  </div>
</figure>
<div class="column-as">
  <div class="row-as">
      <a class="saved-as" href="index.php">Edit</a>
      <a class="saved-as" href="/source/index.phpdex.php">Complete registration</a>
  </div>
</div>

</body>


<?php
include '../partials/footer.php';
?>
