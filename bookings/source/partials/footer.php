<div class="footer">
    <div class="row-footer">
        <div class="column-footer">
            <br><br><br>
            <a href="/info/about-us.php">About Us</a> <br>
            <a href="/info/contact-us.php">Contact Us</a> <br>
            <a href="/info/faq.php">FAQ</a> <br>
            <a href="/legal/terms-legal.php">Terms of Use</a> <br>
            <a href="/legal/privacy-policy.php">Policies & Privacy</a>
            <br>
            <?php if (!isLoggedIn()) { ?>
            <a href="/user/login.php">Sign-in</a> <br>
            <a href="/user/register.php">Sign-up</a>
            <?php } else { ?>
                <a id="modal-btn">Sign Out</a>
                <script type="text/javascript" src="/assets/js/signout-modal.js"></script>
            <?php } ?>
        </div>

        <div class="column-footer">
            <h2>Lets get Connected</h2>
            <div class="incolumn">
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <p><a href="mailto:reception@bigfeet.com"
                      class="footer-normal-atag">reception@bigfeet.com</a></p>
                <p><a href="tel:+27 011 333 2000" class="footer-normal-atag">+27
                    011 333 2000</a></p>
            </div>
            <img src="/assets/img/logo.png" class="footer-img" alt="Logo">
        </div>

        <div class="column-footer">
            <h2>Address</h2>
            <p>
                52 Ryneveld Street <br/>
                Stellenbosch Central <br/>
                Stellenbosch <br/>
                7600<br/><br/>
            </p>
            <p>&copy; BigFeet</p>
        </div>
    </div>
</div>
<script type="application/javascript" src="/assets/js/index-click.js"></script>
