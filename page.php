<?php
$pagg = 4;
include "inc.php";
$id = isv("id");
$pid = isv("pid");
$type = isv("type");
if (!$id)
  $id = isv("level");
$data = $core->getPages(array("id" => $id));
$data = $data[0];
/*
$lang : get form  inc.php  = arabic || english;
$plang : get form  inc.php for  php file name  = arabic || "";
$clang : get form  inc.php for column name  =  _arabic || "" ;
*/
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
  $attachment  = $_FILES["attachment"];
  $writecode  = $_POST["writecode"];
  $securitycode  = $_POST["securitycode"];
  if ($writecode == $securitycode) {
    unset($_POST["securitycode"]);
    unset($_POST["writecode"]);
    unset($_POST["btnSubmit"]);
    $text = "I have sent the following message to you through a form on the web.<br />";
    foreach ($_POST as $k => $v) {
      if (!in_array(strtoupper($k), array("FORM_BOTCHECK", "BTNSUBMIT")))
        $text .= ucfirst($k) . " : " . $v . '<br>';
    }
    if ($attachment) {
      $target_dir = "images/";
      $target_file = $target_dir . basename($attachment["name"]);
      move_uploaded_file($attachment["tmp_name"], $target_file);
      $text .= "Attachment : <a href='" . $PUr . "/" . $attachment["name"] . "'>" . $PUr . "/" . $attachment["name"] . "</a>";
      $_POST["attachment"] = $attachment["name"];
    }
    $sql = $core->SqlIn(($data["id"] == 3 ? "agents_form" : "employment_form"), $_POST);
    //$text .= " Full Name  : $firstname <br />  Email  : $email  <br /> Country  : $country <br /> City  : $city <br /> Address  : $address   <br /> Message  : $message <br />";
    //require("class.phpmailer.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "mail.sherktk.net";
    $mail->SMTPAuth = true;
    //$mail->SMTPSecure = "ssl";
    $mail->Port = 587;
    $mail->Username = "mail@sherktk.net";
    $mail->Password = "JCrS%^)qc!eH";
    $mail->From = "mail@sherktk.net";
    $mail->FromName = $firstname;
    $info_media["code"] = "email";
    $contents = $core->getinfo_media($info_media);
    $emaills = $contents[0]["link"];
    $mail->AddAddress($emaills);
    //$mail->AddReplyTo("mail@mail.com");
    $mail->IsHTML(true);
    $mail->Subject = $title;
    $mail->Body = $text;
    //$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    $er = 1;
    if (!$mail->Send()) {
      $msg = plang("تعثر في ارسال الرسالة برجاء اعادة ارسال لاحقا", "Stumbled upon sending the message, please resend later.");
    } else {
      $er = 0;
      $msg = plang("شكرا على التسجيل سوف نتواصل معكم خلال " . ($id == 2 ? "24" : "72") . " ساعة", "Thanks for registering. We will contact you within " . ($id == 2 ? "24" : "72") . " hours.");
    }
  } else {
    $msg = plang("يرجى كتابة الكود الصحيح", "Please type the correct code");
  }
}
$loop[] = array($core->getBlogUrl(array($data["id"], $data["name" . $clang]), "page"), $exTitle);
?>
<style type="text/css">
  .col-md-6.column {
    float: left;
  }
</style>
<div class="intro2 ng-scope" style="background-image: url(images/<?= ($data["image"] ? $data["image"] : "back22.jpg") ?>);">
  <div class="container">
    <div class="row">
      <div class="col-md-6 column">
        <div class="medium-12 column flex-video">
          <!--<iframe width="560" height="315" src="//www.youtube.com/embed/_aiWMcg3_jM?rel=0" frameborder="0" allowfullscreen></iframe>-->
        </div>
      </div>
      <div class="col-md-6 column introInfo">
        <div class="verticalMiddle">
          <?php if ($data["id"] == 7 && 1 == 2) { ?>
            <h2 class="introTitle ng-scope" translate="">كن شريكا معنا في النجاح</h2>
            <h2 class="introDesc ng-binding"> أنضم لفريق عضوية الشماس</h2>
          <?php } ?>
          <!--<c:if test="${currentUser == null}">-->
          <!--<div><a href="/login/register" class="button green-button "><spring:message code="home.join.btn" ></spring:message></a></div>-->
          <!--</c:if>-->
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="block block-breadcrumbs clearfix">
    <ul>
      <li class="home">
        <a href="<?= $core->getPageUrl("index") ?>"><?= getTitle("index") ?></a>
        <span></span>
      </li>
      <?php function getSubCat($id)
      {
        global $core;
        global $loop;
        global $clang;
        $cat = $core->getCat(array("id" => $id))[0];
        if ($cat["level"]) {
          $data = $core->getCat(array("id" => $cat["level"]))[0];
          $loop[] = array($core->getPageUrl("products", "?cat=" . $data["id"]), $data["name" . $clang]);
        }
        $loop[] = array($core->getPageUrl("products", "?cat=" . $cat["id"]), $cat["name" . $clang]);
        return $loop;
      }
      if ($pid) {
        $data = $core->getData("employment", "where active=1 and id=" . $pid)[0];
        $loop[] =  array("", $data["name" . $clang]);
      }
      $index = 0;
      if ($loop) foreach ($loop as $val) { ?>
        <li class="">
          <a href="<?= $val[0] ?>"><?= $val[1] ?></a>
          <?php if ($index != (count($loop) - 1)) echo '<span></span>'; ?>
        </li>
      <?php $index++;
      } ?>
    </ul>
  </div>
</div>
<div class="abt-first">
  <div class="container">
    <h2><?= $data["name" . $clang] ?></h2>
    <p>
      <?= $data["description" . $clang] ?>
    </p>
    <?php if ($id != 1) if ($pid) { ?>
      <br>
      <form id="contact_form" name="contact_form" enctype="multipart/form-data" action="#" method="post">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="alert alert-<?= (!$er ? "success" : "danger") ?> justify-content-center" role="alert" style="display: <?= ($msg ? "block" : "none") ?>;"><?= $msg ?><button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button></div>
        </div>
        <div class="col-md-12 col-lg-12 cart-table-wrap">
          <div class="wprt-content-box">
            <div class="inner">
              <!-- Contact Form -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?= plang("البريد الالكتروني ", "E-mail") ?></label>
                    <input name="email" value="" class="form-control required email" type="email" required="required">
                  </div>
                </div>
                <div class="col-sm-6 pull-rightt">
                  <div class="form-group">
                    <label><?= plang("الاسم", "Full Name") ?></label>
                    <input name="name" value="" class="form-control" type="text" required="required">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-lg-6">
                  <div class="form-group">
                    <label><?= plang("الموبيل", "Mobile") ?></label>
                    <input name="mobile" class="form-control" type="text" placeholder="" value="">
                  </div>
                </div>
                <div class="col-sm-6 pull-rightt">
                  <div class="form-group">
                    <label><?= plang("الدوله", "Country") ?></label>
                    <select class="form-control required" name="country" style="width: 100%;">
                      <?php include "country.php"; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?= plang("العنوان", "Address") ?></label>
                    <input name="address" class="form-control required" type="text" value="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?= plang("المدينة", "City") ?></label>
                    <input name="city" class="form-control required " type="text" value="" required="required">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label><?= plang("المرفق", "Attachment") ?></label>
                <input name="attachment" class="form-control required " type="file" value="">
                <?php if ($id == 2) { ?>
                  <input name="employee" class="form-control required " type="hidden" value="<?= $data["name" . $clang] ?>"> <?php } ?>
              </div>
              <div class="form-group">
                <label><?= plang("المزيد من التفاصيل", "More details") ?></label>
                <textarea name="message" class="form-control required" rows="5"></textarea>
              </div>
              <div class="form-group pull-left4" style="width: 100%">
                <div class="col-md5-12">
                  <div class="form-group" style="
  <!--  text-align: center;  -->
">
                    <? $checknumber = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9); ?>
                    <span class="arabiccaptchaa" style="
    font-size: 37px;
    color: #000;
    text-align: right;
    margin-<?= ($plang ? "left" : "right") ?>: 10px;
    position: relative;
    top: -7px;
    float: <?= (!$plang ? "left" : "right") ?>;"><?= $checknumber ?></span>
                    <input name="securitycode" class="form-control" type="hidden" style="width: 70%" placeholder="اعد كتابه هذا الكود" required="required" value="<?= $checknumber ?>" autocomplete="off">
                    <input name="writecode" class="form-control" type="text" style="    width: 20%;
    float: none;
    display: inline;" placeholder="<?= plang("اعد كتابه هذا الكود", "Write Code") ?>" required="required" autocomplete="off">
                    <button type="submit" name="btnSubmit" value="btnSubmit" class="btn btn-dark btn-theme-colored btn-flat mr-5" id="btn" title="ارسال"><?= plang("ارسال", "Send") ?></button>
                    <button type="reset" class="btn btn-default btn-flat btn-theme-colored" title="مسح"><?= plang("مسح", "Clear") ?></button>
                  </div>
                </div>
              </div>
              <div class="form-group" style="    text-align: center;">
              </div>
            </div>
          </div>
        </div><!-- /.col-md-6 -->
      </form>
    <?php } else if ($data["id"] == 3) { ?>
      <div class="faq-content-box">
        <h3><?= ($data["id"] != 4 ? plang("الوظائف المتاحة", "Available jobs") : plang("عناوين الفروع", "Branches addresses")) ?></h3>
        <div class="accordion" id="accordionExample">
          <?php
          $table = ($data["id"] == 4 ? "branches" : "employment");
          $data = $core->getData($table, "where active=1");
          foreach ($data as $d) {
          ?>
            <!--Start single accordion box-->
            <div class="accordion-item">
              <div class="accordion-header" id="headingTwo<?= $d["id"] ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo<?= $d["id"] ?>" aria-expanded="false" aria-controls="collapseTwo<?= $d["id"] ?>">
                  <?= $d["name" . $clang] ?>
                </button>
              </div>

              <div id="collapseTwo<?= $d["id"] ?>" class="accordion-collapse collapse" aria-labelledby="headingTwo<?= $d["id"] ?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p><?= $d["description" . $clang] ?></p>
                  <?php if ($table != "branches") { ?>
                    <a class="anco" href="<?= $core->getBlogUrl(array($id, $d["name" . $clang]), "employment") ?>&pid=<?= $d["id"] ?>"><?= plang("انضم الان", "Join now") ?></a>
                  <?php } ?>
                  <div style="clear: both;"></div>
                </div>
              </div>
            </div>
            <!--End single accordion box-->
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<!-- style -->
<!-- style -->
<!-- style -->
<!-- style -->
<style>
  .intro2 {
    background: #291b10 url(images/back22.jpg) 18% top no-repeat;
    background-size: 100% 100%;
    height: 350px;
  }

  .introInfo {
    display: table;
    margin: 28px 0 0 0;
  }

  .introInfo .verticalMiddle {
    display: table-cell;
    vertical-align: middle;
    padding: 120px 0;
  }

  .introTitle {
    color: #fff;
    margin: 2px 0 0 0;
    font-size: 24px;
    line-height: 30px;
  }

  .introDesc {
    color: #ff4538;
    font-size: 24px;
    line-height: 100%;
    margin: 10px 0 0 0;
  }

  .abt-first h2 {
    text-align: center;
    margin: 20px 0;
    font-size: 22px;
    position: relative;
    padding-bottom: 20px;
  }

  .abt-first h2:after {
    position: absolute;
    content: "";
    bottom: 0;
    left: 50%;
    margin-left: -50px;
    width: 100px;
    height: 1px;
    background: #ddd;
  }

  .abt-first h2:before {
    position: absolute;
    content: "";
    bottom: -5px;
    left: 50%;
    margin-left: -30px;
    width: 60px;
    height: 1px;
    background: #ddd;
  }

  @media (max-width: 991px) {
    .abt-first h2 {
      font-size: 17px;
    }

    .abt-first {
      padding: 20px 0;
    }

    .intro2 {
      background: #291b10 url(images/back22.jpg) 18% top no-repeat;
      background-size: 100% 100%;
      height: 200px;
    }

    .introInfo .verticalMiddle {
      padding: 20px 0;
    }

    .introDesc,
    .introTitle {
      font-size: 20px;
    }
  }
</style>
<?php
include "inc/footer.php";
?>