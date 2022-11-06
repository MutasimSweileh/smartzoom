<?php
$pagg = 8;
include "inc.php";
if (@$_POST["btnSubmit"]) {
  $_SESSION["cpost"] = $_POST;
  $firstname  = $_POST["name"];
  $email  = $_POST["email"];
  $mobile  = $_POST["mobile"];
  $subject  = $_POST["subject"];
  $message  = $_POST["message"];
  $address  = $_POST["address"];
  $phone  = $_POST["phone"];
  $city  = $_POST["city"];
  $country  = $_POST["country"];
  $writecode  = $_POST["writecode"];
  $securitycode  = $_POST["securitycode"];
  if ($writecode == $securitycode) {
    $text = "I have sent the following message to you through a form on the web.<br />";
    $text .= " Name  : $firstname <br />  Email  : $email  <br /> Country  : $country <br /> City  : $city <br /> Address  : $address   <br /> Message  : $message <br />";
    /*require("class.phpmailer.php"); */
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "outlook.office365.com";
    //$mail->Host = "smtp.office365.com";
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth   = true;
    $mail->Port = 587;
    $mail->Username = "Webmaster@healthyfoodegypt.com";
    $mail->Password = "HWOrd@Hosys$!20#21";
    $mail->From = "Webmaster@healthyfoodegypt.com";
    $mail->FromName = $firstname;
    $info_media["code"] = "email";
    $contents = $core->getinfo_media($info_media);
    $emaills = $contents[0]["link"];
    $mail->AddAddress($emaills);
    //$mail->AddReplyTo("mail@mail.com");
    $mail->IsHTML(true);
    $mail->Subject = "Contact us";
    $mail->Body = $text;
    //$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    if (!$mail->Send()) {
      $contactmessage = "تعثر في ارسال الرسالة برجاء اعادة ارسال لاحقا <br>" . $mail->ErrorInfo;
    } else {
      $contactmessage = "شكرا على التسجيل سوف نتواصل معكم خلال 24 ساعة";
    }
  } else {
    $contactmessage = "يرجى كتابة الكود الصحيح";
  }
}
$loop[] = array("", $exTitle);
?>
<style type="text/css">
  .tittle {
    margin-bottom: 60px;
  }

  .block.block-breadcrumbs.clearfix {
    margin-bottom: 15px;
    margin-top: 10px;
  }
</style>
<!-- Why Choose Us -->
<div class="about-company wow2 page-content" style="margin-bottom: 10px" id="pageContent">
  <div class="container">
    <!-- Breadcrumbs -->
    <div class="block block-breadcrumbs clearfix">
      <ul>
        <li class="home">
          <a href="<?= $core->getPageUrl("index") ?>"><?= getTitle("index") ?></a>
          <span></span>
        </li>
        <?php $index = 0;
        if ($loop) foreach ($loop as $val) { ?>
          <li class="">
            <a href="<?= $val[0] ?>"><?= $val[1] ?></a>
            <?php if ($index != (count($loop) - 1)) echo '<span></span>'; ?>
          </li>
        <?php $index++;
        } ?>
      </ul>
    </div>
    <!-- Breadcrumbs End -->
    <div class="row no-gutters2">
      <?php if ($contactmessage) { ?>
        <div class="col-md-12" style="text-align: center">
          <div class="alert alert-info justify-content-center" role="alert">
            <?= $contactmessage ?>
          </div>
        </div> <?php } ?>
      <div>
        <p><?= getValue("contact_txt", $lang) ?></p>
      </div>
      <div class="col-md-6">
        <div class="wprt-content-box bg-about">
          <div class="inner">
            <!-- Contact Form -->
            <!-- Contact Form -->
            <form id="contact_form" name="contact_form" class="" action="#" method="post">
              <div class="row">
                <div class="col-sm-6 pull-right4">
                  <div class="form-group">
                    <label>Name</label>
                    <input name="name" class="form-control" type="text" placeholder="Name" required="required" value="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input name="email" class="form-control required email" type="email" placeholder="Email" value="" required="required">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>Mobile</label>
                    <input name="mobile" class="form-control" type="text" placeholder="Mobile" value="">
                  </div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>Phone</label>
                    <input name="phone" class="form-control" type="text" placeholder="Phone" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 pull-right4">
                  <div class="form-group">
                    <label>Country</label>
                    <select class="form-control" name="country" style="width: 100%;">
                      <option value="Afganistan">Afghanistan</option>
                      <option value="Albania">Albania</option>
                      <option value="Algeria">Algeria</option>
                      <option value="American Samoa">American Samoa</option>
                      <option value="Andorra">Andorra</option>
                      <option value="Angola">Angola</option>
                      <option value="Anguilla">Anguilla</option>
                      <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                      <option value="Argentina">Argentina</option>
                      <option value="Armenia">Armenia</option>
                      <option value="Aruba">Aruba</option>
                      <option value="Australia">Australia</option>
                      <option value="Austria">Austria</option>
                      <option value="Azerbaijan">Azerbaijan</option>
                      <option value="Bahamas">Bahamas</option>
                      <option value="Bahrain">Bahrain</option>
                      <option value="Bangladesh">Bangladesh</option>
                      <option value="Barbados">Barbados</option>
                      <option value="Belarus">Belarus</option>
                      <option value="Belgium">Belgium</option>
                      <option value="Belize">Belize</option>
                      <option value="Benin">Benin</option>
                      <option value="Bermuda">Bermuda</option>
                      <option value="Bhutan">Bhutan</option>
                      <option value="Bolivia">Bolivia</option>
                      <option value="Bonaire">Bonaire</option>
                      <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                      <option value="Botswana">Botswana</option>
                      <option value="Brazil">Brazil</option>
                      <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                      <option value="Brunei">Brunei</option>
                      <option value="Bulgaria">Bulgaria</option>
                      <option value="Burkina Faso">Burkina Faso</option>
                      <option value="Burundi">Burundi</option>
                      <option value="Cambodia">Cambodia</option>
                      <option value="Cameroon">Cameroon</option>
                      <option value="Canada">Canada</option>
                      <option value="Canary Islands">Canary Islands</option>
                      <option value="Cape Verde">Cape Verde</option>
                      <option value="Cayman Islands">Cayman Islands</option>
                      <option value="Central African Republic">Central African Republic</option>
                      <option value="Chad">Chad</option>
                      <option value="Channel Islands">Channel Islands</option>
                      <option value="Chile">Chile</option>
                      <option value="China">China</option>
                      <option value="Christmas Island">Christmas Island</option>
                      <option value="Cocos Island">Cocos Island</option>
                      <option value="Colombia">Colombia</option>
                      <option value="Comoros">Comoros</option>
                      <option value="Congo">Congo</option>
                      <option value="Cook Islands">Cook Islands</option>
                      <option value="Costa Rica">Costa Rica</option>
                      <option value="Cote DIvoire">Cote D'Ivoire</option>
                      <option value="Croatia">Croatia</option>
                      <option value="Cuba">Cuba</option>
                      <option value="Curaco">Curacao</option>
                      <option value="Cyprus">Cyprus</option>
                      <option value="Czech Republic">Czech Republic</option>
                      <option value="Denmark">Denmark</option>
                      <option value="Djibouti">Djibouti</option>
                      <option value="Dominica">Dominica</option>
                      <option value="Dominican Republic">Dominican Republic</option>
                      <option value="East Timor">East Timor</option>
                      <option value="Ecuador">Ecuador</option>
                      <option selected="selected" value="Egypt">Egypt</option>
                      <option value="El Salvador">El Salvador</option>
                      <option value="Equatorial Guinea">Equatorial Guinea</option>
                      <option value="Eritrea">Eritrea</option>
                      <option value="Estonia">Estonia</option>
                      <option value="Ethiopia">Ethiopia</option>
                      <option value="Falkland Islands">Falkland Islands</option>
                      <option value="Faroe Islands">Faroe Islands</option>
                      <option value="Fiji">Fiji</option>
                      <option value="Finland">Finland</option>
                      <option value="France">France</option>
                      <option value="French Guiana">French Guiana</option>
                      <option value="French Polynesia">French Polynesia</option>
                      <option value="French Southern Ter">French Southern Ter</option>
                      <option value="Gabon">Gabon</option>
                      <option value="Gambia">Gambia</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Germany">Germany</option>
                      <option value="Ghana">Ghana</option>
                      <option value="Gibraltar">Gibraltar</option>
                      <option value="Great Britain">Great Britain</option>
                      <option value="Greece">Greece</option>
                      <option value="Greenland">Greenland</option>
                      <option value="Grenada">Grenada</option>
                      <option value="Guadeloupe">Guadeloupe</option>
                      <option value="Guam">Guam</option>
                      <option value="Guatemala">Guatemala</option>
                      <option value="Guinea">Guinea</option>
                      <option value="Guyana">Guyana</option>
                      <option value="Haiti">Haiti</option>
                      <option value="Hawaii">Hawaii</option>
                      <option value="Honduras">Honduras</option>
                      <option value="Hong Kong">Hong Kong</option>
                      <option value="Hungary">Hungary</option>
                      <option value="Iceland">Iceland</option>
                      <option value="India">India</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="Iran">Iran</option>
                      <option value="Iraq">Iraq</option>
                      <option value="Ireland">Ireland</option>
                      <option value="Isle of Man">Isle of Man</option>
                      <option value="Israel">Israel</option>
                      <option value="Italy">Italy</option>
                      <option value="Jamaica">Jamaica</option>
                      <option value="Japan">Japan</option>
                      <option value="Jordan">Jordan</option>
                      <option value="Kazakhstan">Kazakhstan</option>
                      <option value="Kenya">Kenya</option>
                      <option value="Kiribati">Kiribati</option>
                      <option value="Korea North">Korea North</option>
                      <option value="Korea Sout">Korea South</option>
                      <option value="Kuwait">Kuwait</option>
                      <option value="Kyrgyzstan">Kyrgyzstan</option>
                      <option value="Laos">Laos</option>
                      <option value="Latvia">Latvia</option>
                      <option value="Lebanon">Lebanon</option>
                      <option value="Lesotho">Lesotho</option>
                      <option value="Liberia">Liberia</option>
                      <option value="Libya">Libya</option>
                      <option value="Liechtenstein">Liechtenstein</option>
                      <option value="Lithuania">Lithuania</option>
                      <option value="Luxembourg">Luxembourg</option>
                      <option value="Macau">Macau</option>
                      <option value="Macedonia">Macedonia</option>
                      <option value="Madagascar">Madagascar</option>
                      <option value="Malaysia">Malaysia</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Maldives">Maldives</option>
                      <option value="Mali">Mali</option>
                      <option value="Malta">Malta</option>
                      <option value="Marshall Islands">Marshall Islands</option>
                      <option value="Martinique">Martinique</option>
                      <option value="Mauritania">Mauritania</option>
                      <option value="Mauritius">Mauritius</option>
                      <option value="Mayotte">Mayotte</option>
                      <option value="Mexico">Mexico</option>
                      <option value="Midway Islands">Midway Islands</option>
                      <option value="Moldova">Moldova</option>
                      <option value="Monaco">Monaco</option>
                      <option value="Mongolia">Mongolia</option>
                      <option value="Montserrat">Montserrat</option>
                      <option value="Morocco">Morocco</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="Myanmar">Myanmar</option>
                      <option value="Nambia">Nambia</option>
                      <option value="Nauru">Nauru</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Netherland Antilles">Netherland Antilles</option>
                      <option value="Netherlands">Netherlands (Holland, Europe)</option>
                      <option value="Nevis">Nevis</option>
                      <option value="New Caledonia">New Caledonia</option>
                      <option value="New Zealand">New Zealand</option>
                      <option value="Nicaragua">Nicaragua</option>
                      <option value="Niger">Niger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option>
                      <option value="Norfolk Island">Norfolk Island</option>
                      <option value="Norway">Norway</option>
                      <option value="Oman">Oman</option>
                      <option value="Pakistan">Pakistan</option>
                      <option value="Palau Island">Palau Island</option>
                      <option value="Palestine">Palestine</option>
                      <option value="Panama">Panama</option>
                      <option value="Papua New Guinea">Papua New Guinea</option>
                      <option value="Paraguay">Paraguay</option>
                      <option value="Peru">Peru</option>
                      <option value="Phillipines">Philippines</option>
                      <option value="Pitcairn Island">Pitcairn Island</option>
                      <option value="Poland">Poland</option>
                      <option value="Portugal">Portugal</option>
                      <option value="Puerto Rico">Puerto Rico</option>
                      <option value="Qatar">Qatar</option>
                      <option value="Republic of Montenegro">Republic of Montenegro</option>
                      <option value="Republic of Serbia">Republic of Serbia</option>
                      <option value="Reunion">Reunion</option>
                      <option value="Romania">Romania</option>
                      <option value="Russia">Russia</option>
                      <option value="Rwanda">Rwanda</option>
                      <option value="St Barthelemy">St Barthelemy</option>
                      <option value="St Eustatius">St Eustatius</option>
                      <option value="St Helena">St Helena</option>
                      <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                      <option value="St Lucia">St Lucia</option>
                      <option value="St Maarten">St Maarten</option>
                      <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                      <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                      <option value="Saipan">Saipan</option>
                      <option value="Samoa">Samoa</option>
                      <option value="Samoa American">Samoa American</option>
                      <option value="San Marino">San Marino</option>
                      <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                      <option value="Saudi Arabia">Saudi Arabia</option>
                      <option value="Senegal">Senegal</option>
                      <option value="Serbia">Serbia</option>
                      <option value="Seychelles">Seychelles</option>
                      <option value="Sierra Leone">Sierra Leone</option>
                      <option value="Singapore">Singapore</option>
                      <option value="Slovakia">Slovakia</option>
                      <option value="Slovenia">Slovenia</option>
                      <option value="Solomon Islands">Solomon Islands</option>
                      <option value="Somalia">Somalia</option>
                      <option value="South Africa">South Africa</option>
                      <option value="Spain">Spain</option>
                      <option value="Sri Lanka">Sri Lanka</option>
                      <option value="Sudan">Sudan</option>
                      <option value="Suriname">Suriname</option>
                      <option value="Swaziland">Swaziland</option>
                      <option value="Sweden">Sweden</option>
                      <option value="Switzerland">Switzerland</option>
                      <option value="Syria">Syria</option>
                      <option value="Tahiti">Tahiti</option>
                      <option value="Taiwan">Taiwan</option>
                      <option value="Tajikistan">Tajikistan</option>
                      <option value="Tanzania">Tanzania</option>
                      <option value="Thailand">Thailand</option>
                      <option value="Togo">Togo</option>
                      <option value="Tokelau">Tokelau</option>
                      <option value="Tonga">Tonga</option>
                      <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                      <option value="Tunisia">Tunisia</option>
                      <option value="Turkey">Turkey</option>
                      <option value="Turkmenistan">Turkmenistan</option>
                      <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                      <option value="Tuvalu">Tuvalu</option>
                      <option value="Uganda">Uganda</option>
                      <option value="Ukraine">Ukraine</option>
                      <option value="United Arab Erimates">United Arab Emirates</option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option value="United States of America">United States of America</option>
                      <option value="Uraguay">Uruguay</option>
                      <option value="Uzbekistan">Uzbekistan</option>
                      <option value="Vanuatu">Vanuatu</option>
                      <option value="Vatican City State">Vatican City State</option>
                      <option value="Venezuela">Venezuela</option>
                      <option value="Vietnam">Vietnam</option>
                      <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                      <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                      <option value="Wake Island">Wake Island</option>
                      <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                      <option value="Yemen">Yemen</option>
                      <option value="Zaire">Zaire</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>City</label>
                    <input name="city" class="form-control required " type="text" placeholder="City" value="" required="required">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input name="address" class="form-control required" type="text" placeholder="Address" value="">
                  </div>
                </div>
              </div>
              <?php if ($id) { ?>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label><?= getTitle("services" . $plang) ?></label>
                      <select class="form-control" name="Product" style="width: 100%;">
                        <?php $sproducts = $core->getproducts(array("!level" => 1));  ?>
                        <?php for ($i = 0; $i < count($sproducts); $i++) {      ?>
                          <option value="<?= $sproducts[$i]["name" . $clang] ?>" <?php if ($id == $sproducts[$i]["id"]) { ?> selected="selected" <?php } ?>><?= $sproducts[$i]["name" . $clang] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <div class="form-group">
                <label>Message</label>
                <textarea name="message" class="form-control required" rows="5" placeholder="Message"></textarea>
              </div>
              <div class="form-group pull-left4" style="width: 100%">
                <div class="col-md-12">
                  <div class="form-group" style="
    text-align: center;
">
                    <? $checknumber = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9); ?>
                    <span class="arabiccaptchaa" style="
    font-size: 37px;
    color: #000;
    text-align: right;
    margin-left: 5px;
    position: relative;
    top: -7px;
    float: right;"><?= $checknumber ?></span>
                    <input name="securitycode" class="form-control" type="hidden" style="width: 70%" placeholder="اعد كتابه هذا الكود" required="required" value="<?= $checknumber ?>" autocomplete="off">
                    <input name="writecode" class="form-control" type="text" style="    width: 65%;
    float: none;
    display: inline;" placeholder="Write Code" required="required" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="form-group" style="    text-align: center;">
                <input name="form_botcheck" class="form-control" type="hidden" value="">
                <button type="submit" name="btnSubmit" value="btnSubmit" class="btn btn-dark btn-theme-colored btn-flat mr-5" data-loading-text="من فضلك انتظر ..." id="btn" title="ارسال">Send</button>
                <button type="reset" class="btn btn-default btn-flat btn-theme-colored" title="مسح">Clear</button>
              </div>
            </form>
          </div>
        </div>
      </div><!-- /.col-md-6 -->
      <div class="col-md-6 bg-about">
        <p>Contact us through contact information</p>
        <ul class="styled-icons icon-dark icon-sm icon-circled mb-20">
          <li><a target="_blank" href="<?= getValue("facebook") ?>" data-bg-color="#3B5998" style="background: rgb(59, 89, 152) !important;"><i class="fab fa-facebook"></i></a></li>
          <li><a target="_blank" href="<?= getValue("twitter") ?>" data-bg-color="#02B0E8" style="background: rgb(2, 176, 232) !important;"><i class="fab fa-twitter"></i></a></li>
          <li><a target="_blank" href="https://web.whatsapp.com/send?phone=<?= getValue("whatsapp") ?>" data-bg-color="#D9CCB9" style="background: rgb(98 232 74) !important"><i class="fab fa-whatsapp"></i></a></li>
          <li><a target="_blank" href="<?= getValue("youtube") ?>" data-bg-color="#D71619" style="background: rgb(215, 22, 25) !important;"><i class="fab fa-youtube"></i></a></li>
        </ul>
        <div class="icon-box media mb-15"> <a class="media-left  flip ml-20" href="#"> <i class="fa fa-map-marker"></i></a>
          <div class="media-body">
            <h5 class="mt-0">Our Address</h5>
            <p><?= getValue("address" . $plang) ?></p>
          </div>
        </div>
        <div class="icon-box media mb-15"> <a class="media-left  flip ml-15 " href="#">
            <i class="fa fa-phone"></i></a>
          <div class="media-body">
            <h5 class="mt-0">Mobile</h5>
            <p><a href="tel:<?= getValue("mobilepage") ?>"> <?= getValue("mobilepage") ?></a></p>
          </div>
        </div>
        <div class="icon-box media mb-15"> <a class="media-left flip ml-15" href="#"> <i class="fa fa-envelope"></i></a>
          <div class="media-body">
            <h5 class="mt-0">Email</h5>
            <p><a href="mailto:<?= getValue("email") ?>"><?= getValue("email") ?></a></p>
          </div>
        </div>
        <iframe src="<?= getValue("googlemap") ?>" style="width: 100%" height="250" frameborder="0" allowfullscreen=""></iframe>
      </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
  </div><!-- /.wprt-container -->
</div> <!-- /.row-ab-why-choose-us -->
</div> <!-- /.row-ab-why-choose-us -->
<?php include "inc/footer.php" ?>