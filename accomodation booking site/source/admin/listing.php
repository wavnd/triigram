<?php
include '../partials/sidebar.php';
$db = new db();
$listing = $db->getListing($_GET['id']);
if (!$booking) {
    // Tell user that this booking does not exist no more and redirect
    header('Location /admin');
}
?>

<style media="screen">
    .footer {
        position: fixed;
        bottom: 0;
    }

    .head {
        width: 15%;
    }
</style>
<div class="main" style="padding-bottom: 350px;">

    <h2>Listing Detail - ID <?php echo $listing->ID; ?></h2>

    <form action="/database/DBClient.php" method="post">
        <table>
            <tbody>
            <tr>
                <td class="head">ID</td>
                <td><?php echo $listing->ID; ?></td>
                <input type="hidden" name="listing" value="<?php echo $listing->ID; ?>">
            </tr>
            <tr>
                <td class="head">Host</td>
                <td><?php echo $listing->Host; ?></td>
            </tr>
            <tr>
                <td class="head">Created At</td>
                <td><?php echo $listing->Created_At; ?></td>
            </tr>
            <tr>
                <td class="head">Name</td>
                <td><?php echo $listing->Name; ?></td>
            </tr>
            <tr>
                <td class="head">Type</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-institution icon"></i>
                        <select class="input-field" name="type" id="type">
                        <option value="0">Hotel</option>
                        <option value="1">Apartment</option>
                        <option value="2">Cottage</option>
                        <option value="3">Cabin</option>
                        </select>
                    </div>

                </td>
            </tr>
            <tr>
                <td class="head">Guest</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-user icon"></i>
                        <input class="input-field" type="number" min="1" step="1" name="numg" value="<?php echo $listing->NumOfGuests; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="head">Price</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-key icon"></i>
                        <input class="input-field" type="number" min="1" step="1" name="price" value="<?php echo $listing->Price; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="head">About</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-key icon"></i>
                        <textarea name="about" id="" cols="30" class="input-field"
                                rows="10"><?php echo $listing->About; ?></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="head">Street</td>

                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-key icon"></i>
                        <input class="input-field" type="text" name="street" value="<?php echo $listing->Street; ?>">
                    </div>

                </td>
            </tr>
            <tr>
                <td class="head">City</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-key icon"></i>
                        <input class="input-field" type="text" name="city" value="<?php echo $listing->City; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="head">State</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-key icon"></i>
                        <input class="input-field" type="text" name="state" value="<?php echo $listing->State; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="head">Postal Code</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-key icon"></i>
                        <input class="input-field" type="text" name="postal" value="<?php echo $listing->Postal; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="head">Country</td>
                <td>
                <div class="input-container" style="max-width: 100%;">
                    <i class="fa fa-institution icon"></i>
                    <select class="input-field" name="nationality" required>
                        <option value="AF">Afghanistan</option>
                        <option value="AX">Åland Islands</option>
                        <option value="AL">Albania</option>
                        <option value="DZ">Algeria</option>
                        <option value="AS">American Samoa</option>
                        <option value="AD">Andorra</option>
                        <option value="AO">Angola</option>
                        <option value="AI">Anguilla</option>
                        <option value="AQ">Antarctica</option>
                        <option value="AG">Antigua and Barbuda</option>
                        <option value="AR">Argentina</option>
                        <option value="AM">Armenia</option>
                        <option value="AW">Aruba</option>
                        <option value="AU">Australia</option>
                        <option value="AT">Austria</option>
                        <option value="AZ">Azerbaijan</option>
                        <option value="BS">Bahamas</option>
                        <option value="BH">Bahrain</option>
                        <option value="BD">Bangladesh</option>
                        <option value="BB">Barbados</option>
                        <option value="BY">Belarus</option>
                        <option value="BE">Belgium</option>
                        <option value="BZ">Belize</option>
                        <option value="BJ">Benin</option>
                        <option value="BM">Bermuda</option>
                        <option value="BT">Bhutan</option>
                        <option value="BO">Bolivia, Plurinational State of</option>
                        <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                        <option value="BA">Bosnia and Herzegovina</option>
                        <option value="BW">Botswana</option>
                        <option value="BV">Bouvet Island</option>
                        <option value="BR">Brazil</option>
                        <option value="IO">British Indian Ocean Territory</option>
                        <option value="BN">Brunei Darussalam</option>
                        <option value="BG">Bulgaria</option>
                        <option value="BF">Burkina Faso</option>
                        <option value="BI">Burundi</option>
                        <option value="KH">Cambodia</option>
                        <option value="CM">Cameroon</option>
                        <option value="CA">Canada</option>
                        <option value="CV">Cape Verde</option>
                        <option value="KY">Cayman Islands</option>
                        <option value="CF">Central African Republic</option>
                        <option value="TD">Chad</option>
                        <option value="CL">Chile</option>
                        <option value="CN">China</option>
                        <option value="CX">Christmas Island</option>
                        <option value="CC">Cocos (Keeling) Islands</option>
                        <option value="CO">Colombia</option>
                        <option value="KM">Comoros</option>
                        <option value="CG">Congo</option>
                        <option value="CD">Congo, the Democratic Republic of the</option>
                        <option value="CK">Cook Islands</option>
                        <option value="CR">Costa Rica</option>
                        <option value="CI">Côte d'Ivoire</option>
                        <option value="HR">Croatia</option>
                        <option value="CU">Cuba</option>
                        <option value="CW">Curaçao</option>
                        <option value="CY">Cyprus</option>
                        <option value="CZ">Czech Republic</option>
                        <option value="DK">Denmark</option>
                        <option value="DJ">Djibouti</option>
                        <option value="DM">Dominica</option>
                        <option value="DO">Dominican Republic</option>
                        <option value="EC">Ecuador</option>
                        <option value="EG">Egypt</option>
                        <option value="SV">El Salvador</option>
                        <option value="GQ">Equatorial Guinea</option>
                        <option value="ER">Eritrea</option>
                        <option value="EE">Estonia</option>
                        <option value="ET">Ethiopia</option>
                        <option value="FK">Falkland Islands (Malvinas)</option>
                        <option value="FO">Faroe Islands</option>
                        <option value="FJ">Fiji</option>
                        <option value="FI">Finland</option>
                        <option value="FR">France</option>
                        <option value="GF">French Guiana</option>
                        <option value="PF">French Polynesia</option>
                        <option value="TF">French Southern Territories</option>
                        <option value="GA">Gabon</option>
                        <option value="GM">Gambia</option>
                        <option value="GE">Georgia</option>
                        <option value="DE">Germany</option>
                        <option value="GH">Ghana</option>
                        <option value="GI">Gibraltar</option>
                        <option value="GR">Greece</option>
                        <option value="GL">Greenland</option>
                        <option value="GD">Grenada</option>
                        <option value="GP">Guadeloupe</option>
                        <option value="GU">Guam</option>
                        <option value="GT">Guatemala</option>
                        <option value="GG">Guernsey</option>
                        <option value="GN">Guinea</option>
                        <option value="GW">Guinea-Bissau</option>
                        <option value="GY">Guyana</option>
                        <option value="HT">Haiti</option>
                        <option value="HM">Heard Island and McDonald Islands</option>
                        <option value="VA">Holy See (Vatican City State)</option>
                        <option value="HN">Honduras</option>
                        <option value="HK">Hong Kong</option>
                        <option value="HU">Hungary</option>
                        <option value="IS">Iceland</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IR">Iran, Islamic Republic of</option>
                        <option value="IQ">Iraq</option>
                        <option value="IE">Ireland</option>
                        <option value="IM">Isle of Man</option>
                        <option value="IL">Israel</option>
                        <option value="IT">Italy</option>
                        <option value="JM">Jamaica</option>
                        <option value="JP">Japan</option>
                        <option value="JE">Jersey</option>
                        <option value="JO">Jordan</option>
                        <option value="KZ">Kazakhstan</option>
                        <option value="KE">Kenya</option>
                        <option value="KI">Kiribati</option>
                        <option value="KP">Korea, Democratic People's Republic of</option>
                        <option value="KR">Korea, Republic of</option>
                        <option value="KW">Kuwait</option>
                        <option value="KG">Kyrgyzstan</option>
                        <option value="LA">Lao People's Democratic Republic</option>
                        <option value="LV">Latvia</option>
                        <option value="LB">Lebanon</option>
                        <option value="LS">Lesotho</option>
                        <option value="LR">Liberia</option>
                        <option value="LY">Libya</option>
                        <option value="LI">Liechtenstein</option>
                        <option value="LT">Lithuania</option>
                        <option value="LU">Luxembourg</option>
                        <option value="MO">Macao</option>
                        <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                        <option value="MG">Madagascar</option>
                        <option value="MW">Malawi</option>
                        <option value="MY">Malaysia</option>
                        <option value="MV">Maldives</option>
                        <option value="ML">Mali</option>
                        <option value="MT">Malta</option>
                        <option value="MH">Marshall Islands</option>
                        <option value="MQ">Martinique</option>
                        <option value="MR">Mauritania</option>
                        <option value="MU">Mauritius</option>
                        <option value="YT">Mayotte</option>
                        <option value="MX">Mexico</option>
                        <option value="FM">Micronesia, Federated States of</option>
                        <option value="MD">Moldova, Republic of</option>
                        <option value="MC">Monaco</option>
                        <option value="MN">Mongolia</option>
                        <option value="ME">Montenegro</option>
                        <option value="MS">Montserrat</option>
                        <option value="MA">Morocco</option>
                        <option value="MZ">Mozambique</option>
                        <option value="MM">Myanmar</option>
                        <option value="NA">Namibia</option>
                        <option value="NR">Nauru</option>
                        <option value="NP">Nepal</option>
                        <option value="NL">Netherlands</option>
                        <option value="NC">New Caledonia</option>
                        <option value="NZ">New Zealand</option>
                        <option value="NI">Nicaragua</option>
                        <option value="NE">Niger</option>
                        <option value="NG">Nigeria</option>
                        <option value="NU">Niue</option>
                        <option value="NF">Norfolk Island</option>
                        <option value="MP">Northern Mariana Islands</option>
                        <option value="NO">Norway</option>
                        <option value="OM">Oman</option>
                        <option value="PK">Pakistan</option>
                        <option value="PW">Palau</option>
                        <option value="PS">Palestinian Territory, Occupied</option>
                        <option value="PA">Panama</option>
                        <option value="PG">Papua New Guinea</option>
                        <option value="PY">Paraguay</option>
                        <option value="PE">Peru</option>
                        <option value="PH">Philippines</option>
                        <option value="PN">Pitcairn</option>
                        <option value="PL">Poland</option>
                        <option value="PT">Portugal</option>
                        <option value="PR">Puerto Rico</option>
                        <option value="QA">Qatar</option>
                        <option value="RE">Réunion</option>
                        <option value="RO">Romania</option>
                        <option value="RU">Russian Federation</option>
                        <option value="RW">Rwanda</option>
                        <option value="BL">Saint Barthélemy</option>
                        <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                        <option value="KN">Saint Kitts and Nevis</option>
                        <option value="LC">Saint Lucia</option>
                        <option value="MF">Saint Martin (French part)</option>
                        <option value="PM">Saint Pierre and Miquelon</option>
                        <option value="VC">Saint Vincent and the Grenadines</option>
                        <option value="WS">Samoa</option>
                        <option value="SM">San Marino</option>
                        <option value="ST">Sao Tome and Principe</option>
                        <option value="SA">Saudi Arabia</option>
                        <option value="SN">Senegal</option>
                        <option value="RS">Serbia</option>
                        <option value="SC">Seychelles</option>
                        <option value="SL">Sierra Leone</option>
                        <option value="SG">Singapore</option>
                        <option value="SX">Sint Maarten (Dutch part)</option>
                        <option value="SK">Slovakia</option>
                        <option value="SI">Slovenia</option>
                        <option value="SB">Solomon Islands</option>
                        <option value="SO">Somalia</option>
                        <option value="ZA">South Africa</option>
                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                        <option value="SS">South Sudan</option>
                        <option value="ES">Spain</option>
                        <option value="LK">Sri Lanka</option>
                        <option value="SD">Sudan</option>
                        <option value="SR">Suriname</option>
                        <option value="SJ">Svalbard and Jan Mayen</option>
                        <option value="SZ">Swaziland</option>
                        <option value="SE">Sweden</option>
                        <option value="CH">Switzerland</option>
                        <option value="SY">Syrian Arab Republic</option>
                        <option value="TW">Taiwan, Province of China</option>
                        <option value="TJ">Tajikistan</option>
                        <option value="TZ">Tanzania, United Republic of</option>
                        <option value="TH">Thailand</option>
                        <option value="TL">Timor-Leste</option>
                        <option value="TG">Togo</option>
                        <option value="TK">Tokelau</option>
                        <option value="TO">Tonga</option>
                        <option value="TT">Trinidad and Tobago</option>
                        <option value="TN">Tunisia</option>
                        <option value="TR">Turkey</option>
                        <option value="TM">Turkmenistan</option>
                        <option value="TC">Turks and Caicos Islands</option>
                        <option value="TV">Tuvalu</option>
                        <option value="UG">Uganda</option>
                        <option value="UA">Ukraine</option>
                        <option value="AE">United Arab Emirates</option>
                        <option value="GB">United Kingdom</option>
                        <option value="US">United States</option>
                        <option value="UM">United States Minor Outlying Islands</option>
                        <option value="UY">Uruguay</option>
                        <option value="UZ">Uzbekistan</option>
                        <option value="VU">Vanuatu</option>
                        <option value="VE">Venezuela, Bolivarian Republic of</option>
                        <option value="VN">Viet Nam</option>
                        <option value="VG">Virgin Islands, British</option>
                        <option value="VI">Virgin Islands, U.S.</option>
                        <option value="WF">Wallis and Futuna</option>
                        <option value="EH">Western Sahara</option>
                        <option value="YE">Yemen</option>
                        <option value="ZM">Zambia</option>
                        <option value="ZW">Zimbabwe</option>
                    </select>
                </div>
                </td>
            </tr>
            <tr>
                <td class="head">Latitude</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-key icon"></i>
                        <input class="input-field" type="text" name="latitude" value="<?php echo $listing->Latitude; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="head">Longitude</td>
                <td>
                    <div class="input-container" style="max-width: 100%;">
                        <i class="fa fa-key icon"></i>
                        <input class="input-field" type="text" name="longtitude" value="<?php echo $listing->Longitude; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="head">Min Length of Stay</td>
                <td><?php echo $listing->MinLength; ?></td>
            </tr>
            <tr>
                <td class="head">Number of Guests</td>
                <td><?php echo $listing->NumOfGuests; ?></td>
            </tr>
            <tr>
                <td class="head">Number of Ratings</td>
                <td><?php echo $listing->NumOfRatings; ?></td>
            </tr>
            <tr>
                <td class="head">Rating</td>
                <td><?php echo $listing->Rating; ?></td>
            </tr>
            </tbody>
        </table>
        <input type="hidden" name="cat" value="<?php echo $_SESSION['user']->Category; ?>">
        <div class="input-container" style="max-width: 100%; padding-top: 15px;">
            <button type="submit" class="btn" name="form" value="Edit Listing">Edit Listing</button>
            <button type="submit" class="btn" name="form" value="Delete Listing">Delete Listing</button>
        </div>
    </form>

    <?php getReviews($_GET['id']); ?>
</div>
<script>
    window.onload = function () {
        document.getElementById('type').value = <?php echo $listing->Type; ?>;
        console.log(<?php echo $listing->Type; ?>);
        document.getElementById('type').value = <?php echo $listing->Nationality; ?>;
    }
</script>
<?php
include '../partials/footer.php';
?>
