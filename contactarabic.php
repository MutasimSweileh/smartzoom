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
    /*require("class.phpmailer.php");     */
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
      $contactmessage = "تعثر في ارسال الرسالة برجاء اعادة ارسال لاحقا";
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
          <a href="<?= $core->getPageUrl("index") ?>">الرئيسية</a>
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
    <div class="row no-gutters">
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
            <form id="contact_form" name="contact_form" class="" action="#" method="post">
              <div class="row">
                <div class="col-sm-6 pull-right">
                  <div class="form-group">
                    <label>الاسم</label>
                    <input name="name" class="form-control" type="text" placeholder=" ادخل الاسم" required="required" value="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>البريد الالكتروني </label>
                    <input name="email" class="form-control required email" type="email" placeholder="ادخل البريد الالكتروني" value="" required="required">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>الموبيل</label>
                    <input name="mobile" class="form-control" type="text" placeholder="الموبيل" value="">
                  </div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>التليفون</label>
                    <input name="phone" class="form-control" type="text" placeholder="ادخل التليفون" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 pull-right">
                  <div class="form-group">
                    <label>الدوله</label>
                    <select class="form-control required" name="country" style="width: 100%;    direction: rtl;">
                      <OPTION value=مصر>مصر</OPTION>
                      <OPTION value=الكويت>الكويت</OPTION>
                      <OPTION value=قطر>قطر</OPTION>
                      <OPTION value=الأردن>الأردن</OPTION>
                      <OPTION value="المملكة العربية السعودية">المملكة العربية السعودية</OPTION>
                      <OPTION value=اليمن>اليمن</OPTION>
                      <OPTION value=عمان>عمان</OPTION>
                      <OPTION value=البحرين>البحرين</OPTION>
                      <OPTION value=فلسطين المحتلة>فلسطين المحتلة</OPTION>
                      <OPTION value=سوريا>سوريا</OPTION>
                      <OPTION value=لبنان>لبنان</OPTION>
                      <OPTION value=العراق>العراق</OPTION>
                      <OPTION value=السودان>السودان</OPTION>
                      <OPTION value=ليبيا>ليبيا</OPTION>
                      <OPTION value=الجزائر>الجزائر</OPTION>
                      <OPTION value=موريتانيا>موريتانيا</OPTION>
                      <OPTION value=المغرب>المغرب</OPTION>
                      <OPTION value=تونس>تونس</OPTION>
                      <OPTION value="جزر القمر">جزر القمر</OPTION>
                      <OPTION value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</OPTION>
                      <OPTION value=تركيا>تركيا</OPTION>
                      <OPTION value=ماليزيا>ماليزيا</OPTION>
                      <OPTION value=أفغانستان>أفغانستان</OPTION>
                      <OPTION value=باكستان>باكستان</OPTION>
                      <OPTION value="المملكة المتحدة">المملكة المتحدة</OPTION>
                      <OPTION value="الولايات المتحدة الامريكية">الولايات المتحدة الامريكية</OPTION>
                      <OPTION value=كندا>كندا</OPTION>
                      <OPTION value=فرنسا>فرنسا</OPTION>
                      <OPTION value=النمسا>النمسا</OPTION>
                      <OPTION value=ألمانيا>ألمانيا</OPTION>
                      <OPTION value=ax>جزر
                        آلاند</OPTION>
                      <OPTION value=ألبانيا>ألبانيا</OPTION>
                      <OPTION value="ساموا  الأمريكية">ساموا الأمريكية</OPTION>
                      <OPTION value=أندورا>أندورا</OPTION>
                      <OPTION value=أنغولا>أنغولا</OPTION>
                      <OPTION value=أنجويلا>أنجويلا</OPTION>
                      <OPTION value=أنتاركتيكا>أنتاركتيكا</OPTION>
                      <OPTION value="أنتيغوا وبربودا">أنتيغوا وبربودا</OPTION>
                      <OPTION value=الأرجنتين>الأرجنتين</OPTION>
                      <OPTION value=أرمينيا>أرمينيا</OPTION>
                      <OPTION value=أروبا>أروبا</OPTION>
                      <OPTION value=أستراليا>أستراليا</OPTION>
                      <OPTION value=النمسا>النمسا</OPTION>
                      <OPTION value=أذربيجان>أذربيجان</OPTION>
                      <OPTION value="جزر  البهاما">جزر البهاما</OPTION>
                      <OPTION value=بنغلاديش>بنغلاديش</OPTION>
                      <OPTION value=بربادوس>بربادوس</OPTION>
                      <OPTION value="روسيا  البيضاء (بيلاروسيا)">روسيا البيضاء (بيلاروسيا)</OPTION>
                      <OPTION value=بلجيكا>بلجيكا</OPTION>
                      <OPTION value=بليز>بليز</OPTION>
                      <OPTION value=بينين>بينين</OPTION>
                      <OPTION value=برمودا>برمودا</OPTION>
                      <OPTION value=بوتان>بوتان</OPTION>
                      <OPTION value=بوليفيا>بوليفيا</OPTION>
                      <OPTION value="البوسنة والهرسك">البوسنة والهرسك</OPTION>
                      <OPTION value=بتسوانا>بتسوانا</OPTION>
                      <OPTION value="جزيرة بوفيه">جزيرة بوفيه</OPTION>
                      <OPTION value=البرازيل>البرازيل</OPTION>
                      <OPTION value="إقليم المحيط الهندي البريطاني">إقليم المحيط الهندي البريطاني</OPTION>
                      <OPTION value="جزر فيرجين البريطانية">جزر فيرجين البريطانية</OPTION>
                      <OPTION value=بروناي>بروناي</OPTION>
                      <OPTION value=بلغاريا>بلغاريا</OPTION>
                      <OPTION value="بوركينا فاسو">بوركينا فاسو</OPTION>
                      <OPTION value=بوروندي>بوروندي</OPTION>
                      <OPTION value=كامبوديا>كامبوديا</OPTION>
                      <OPTION value=الكاميرون>الكاميرون</OPTION>
                      <OPTION value="جزيرة الرأس الأخضر">جزيرة الرأس الأخضر</OPTION>
                      <OPTION value=جزر كايمان>جزر كايمان</OPTION>
                      <OPTION value="جمهورية أفريقيا الوسطى">جمهورية أفريقيا الوسطى</OPTION>
                      <OPTION value=تشاد>تشاد</OPTION>
                      <OPTION value=تشيلي>تشيلي</OPTION>
                      <OPTION value=الصين>الصين</OPTION>
                      <OPTION value=جزيرة الكريسماس>جزيرة الكريسماس</OPTION>
                      <OPTION value="جزر كوكوس (كيلنج)">جزر كوكوس (كيلنج)</OPTION>
                      <OPTION value=كولومبيا>كولومبيا</OPTION>
                      <OPTION value=الكونغو>الكونغو</OPTION>
                      <OPTION value=جزر كوك>جزر كوك</OPTION>
                      <OPTION value=كوستاريكا>كوستاريكا</OPTION>
                      <OPTION value=كرواتيا>كرواتيا</OPTION>
                      <OPTION value=كوبا>كوبا</OPTION>
                      <OPTION value=قبرص>قبرص</OPTION>
                      <OPTION value="جمهورية التشيك">جمهورية التشيك</OPTION>
                      <OPTION value="جمهورية الكونغو الديمقراطية">جمهورية الكونغو الديمقراطية</OPTION>
                      <OPTION value=الدنمارك>الدنمارك</OPTION>
                      <OPTION value="منطقة متنازع عليها">منطقة متنازع عليها</OPTION>
                      <OPTION value=جيبوتي>جيبوتي</OPTION>
                      <OPTION value=دومينيكا>دومينيكا</OPTION>
                      <OPTION value="جمهورية الدومنيكان">جمهورية الدومنيكان</OPTION>
                      <OPTION value="تيمور الشرقية">تيمور الشرقية</OPTION>
                      <OPTION value=الإكوادور>الإكوادور</OPTION>
                      <OPTION value=السلفادور>السلفادور</OPTION>
                      <OPTION value="غينيا الاستوائية">غينيا الاستوائية</OPTION>
                      <OPTION value=أرتيريا>أرتيريا</OPTION>
                      <OPTION value=إستونيا>إستونيا</OPTION>
                      <OPTION value=أثيوبيا>أثيوبيا</OPTION>
                      <OPTION value=جزر فوكلاند>جزر فوكلاند</OPTION>
                      <OPTION value="جزر فارو">جزر فارو</OPTION>
                      <OPTION value="ولايات  ميكرونيسيا المتحدة">ولايات ميكرونيسيا المتحدة</OPTION>
                      <OPTION value=فيجي>فيجي</OPTION>
                      <OPTION value=فنلندا>فنلندا</OPTION>
                      <OPTION value="غويانا  الفرنسية">غويانا الفرنسية</OPTION>
                      <OPTION value="بولينيزيا الفرنسية">بولينيزيا الفرنسية</OPTION>
                      <OPTION value=الغابون>الغابون</OPTION>
                      <OPTION value=غامبيا>غامبيا</OPTION>
                      <OPTION value=جورجيا>جورجيا</OPTION>
                      <OPTION value=غانا>غانا</OPTION>
                      <OPTION value="جبل طارق">جبل
                        طارق</OPTION>
                      <OPTION value=اليونان>اليونان</OPTION>
                      <OPTION value=جرينلاند>جرينلاند</OPTION>
                      <OPTION value=غرينادا>غرينادا</OPTION>
                      <OPTION value=غوادلوب>غوادلوب</OPTION>
                      <OPTION value=غوام>غوام</OPTION>
                      <OPTION value=غواتيمالا>غواتيمالا</OPTION>
                      <OPTION value=غينيا>غينيا</OPTION>
                      <OPTION value="غينيا-بيساو">غينيا-بيساو</OPTION>
                      <OPTION value=غويانا>غويانا</OPTION>
                      <OPTION value=هايتي>هايتي</OPTION>
                      <OPTION value="جزيرة هيرد وجزر ماكدونالد">جزيرة هيرد وجزر ماكدونالد</OPTION>
                      <OPTION value=هندوراس>هندوراس</OPTION>
                      <OPTION value="هونغ كونغ">هونغ كونغ</OPTION>
                      <OPTION value="المجر (هنغاريا)">المجر (هنغاريا)</OPTION>
                      <OPTION value=أيسلندا>أيسلندا</OPTION>
                      <OPTION value=الهند>الهند</OPTION>
                      <OPTION value=إندونيسيا>إندونيسيا</OPTION>
                      <OPTION value=إيران>إيران</OPTION>
                      <OPTION value=أيرلندا>أيرلندا</OPTION>
                      <OPTION value=إيطاليا>إيطاليا</OPTION>
                      <OPTION value=ساحل العاج>ساحل العاج</OPTION>
                      <OPTION value=جامايكا>جامايكا</OPTION>
                      <OPTION value=اليابان>اليابان</OPTION>
                      <OPTION value=الأردن>الأردن</OPTION>
                      <OPTION value=كازاخستان>كازاخستان</OPTION>
                      <OPTION value=كينيا>كينيا</OPTION>
                      <OPTION value="جزر  الكيريباتي">جزر الكيريباتي</OPTION>
                      <OPTION value=قيرغيزستان>قيرغيزستان</OPTION>
                      <OPTION value=لاوس>لاوس</OPTION>
                      <OPTION value=لاتفيا>لاتفيا</OPTION>
                      <OPTION value=ليسوتو>ليسوتو</OPTION>
                      <OPTION value=ليبريا>ليبريا</OPTION>
                      <OPTION value=ليختنشتاين>ليختنشتاين</OPTION>
                      <OPTION value=ليتوانيا>ليتوانيا</OPTION>
                      <OPTION value=لوكسمبورغ>لوكسمبورغ</OPTION>
                      <OPTION value=ماكاو>ماكاو</OPTION>
                      <OPTION value=مقدونيا>مقدونيا</OPTION>
                      <OPTION value=مدغشقر>مدغشقر</OPTION>
                      <OPTION value=ملاوي>ملاوي</OPTION>
                      <OPTION value=المالديف>المالديف</OPTION>
                      <OPTION value=مالي>مالي</OPTION>
                      <OPTION value=مالطا>مالطا</OPTION>
                      <OPTION value="جزر مارشال">جزر مارشال</OPTION>
                      <OPTION value=مارتينيك>مارتينيك</OPTION>
                      <OPTION value=موريشيوس>موريشيوس</OPTION>
                      <OPTION value=مايوت>مايوت</OPTION>
                      <OPTION value=المكسيك>المكسيك</OPTION>
                      <OPTION value=مولدوفا>مولدوفا</OPTION>
                      <OPTION value=موناكو>موناكو</OPTION>
                      <OPTION value=منغوليا>منغوليا</OPTION>
                      <OPTION value=مونتسرات>مونتسرات</OPTION>
                      <OPTION value=موزمبيق>موزمبيق</OPTION>
                      <OPTION value=ميانمار>ميانمار</OPTION>
                      <OPTION value=ناميبيا>ناميبيا</OPTION>
                      <OPTION value=ناورو>ناورو</OPTION>
                      <OPTION value=نيبال>نيبال</OPTION>
                      <OPTION value=هولندا>هولندا</OPTION>
                      <OPTION value="كاليدونيا الجديدة">كاليدونيا الجديدة</OPTION>
                      <OPTION value=نيوزيلندا>نيوزيلندا</OPTION>
                      <OPTION value=نيكاراغوا>نيكاراغوا</OPTION>
                      <OPTION value=النيجر>النيجر</OPTION>
                      <OPTION value=نيجيريا>نيجيريا</OPTION>
                      <OPTION value=نيوي>نيوي</OPTION>
                      <OPTION value="جزيرة نورفولك">جزيرة نورفولك</OPTION>
                      <OPTION value="كوريا الشمالية">كوريا الشمالية</OPTION>
                      <OPTION value=النرويج>النرويج</OPTION>
                      <OPTION value=بالاو>بالاو</OPTION>
                      <OPTION value=بنما>بنما</OPTION>
                      <OPTION value="بابوا غينيا الجديدة">بابوا غينيا الجديدة</OPTION>
                      <OPTION value=باراغواي>باراغواي</OPTION>
                      <OPTION value=بيرو>بيرو</OPTION>
                      <OPTION value=الفلبين>الفلبين</OPTION>
                      <OPTION value="جزر بيتكيرن">جزر بيتكيرن</OPTION>
                      <OPTION value=بولندا>بولندا</OPTION>
                      <OPTION value=البرتغال>البرتغال</OPTION>
                      <OPTION value=بورتوريكو>بورتوريكو</OPTION>
                      <OPTION value=ريونيون>ريونيون</OPTION>
                      <OPTION value=رومانيا>رومانيا</OPTION>
                      <OPTION value=روسيا>روسيا</OPTION>
                      <OPTION value=رواندا>رواندا</OPTION>
                      <OPTION value=سانت كيتس ونيفس>سانت كيتس ونيفس</OPTION>
                      <OPTION value="سانت لوسيا">سانت لوسيا</OPTION>
                      <OPTION value="سانت بيير وميكويلون">سانت بيير وميكويلون</OPTION>
                      <OPTION value="سانت فينسنت وجزر غرينادين">سانت فينسنت وجزر غرينادين</OPTION>
                      <OPTION value=ساموا>ساموا</OPTION>
                      <OPTION value=سان مارينو>سان مارينو</OPTION>
                      <OPTION value="ساو تومي وبرنسيب">ساو تومي وبرنسيب</OPTION>
                      <OPTION value=السنغال>السنغال</OPTION>
                      <OPTION value=سيشيل>سيشيل</OPTION>
                      <OPTION value=سيراليون>سيراليون</OPTION>
                      <OPTION value=سنغافورة>سنغافورة</OPTION>
                      <OPTION value=سلوفاكيا>سلوفاكيا</OPTION>
                      <OPTION value=سلوفينيا>سلوفينيا</OPTION>
                      <OPTION value=جزر سليمان>جزر سليمان</OPTION>
                      <OPTION value=الصومال>الصومال</OPTION>
                      <OPTION value=جنوب أفريقيا>جنوب أفريقيا</OPTION>
                      <OPTION value=كوريا الجنوبية>كوريا الجنوبية</OPTION>
                      <OPTION value=إسبانيا>إسبانيا</OPTION>
                      <OPTION value=جزر سبراتلي>جزر سبراتلي</OPTION>
                      <OPTION value=سريلانكا>سريلانكا</OPTION>
                      <OPTION value=سورينام>سورينام</OPTION>
                      <OPTION value="سفالبارد وجان ماين">سفالبارد وجان ماين</OPTION>
                      <OPTION value=سوازيلند>سوازيلند</OPTION>
                      <OPTION value=السويد>السويد</OPTION>
                      <OPTION value=سويسرا>سويسرا</OPTION>
                      <OPTION value=تايوان>تايوان</OPTION>
                      <OPTION value=طاجكستان>طاجكستان</OPTION>
                      <OPTION value=تنزانيا>تنزانيا</OPTION>
                      <OPTION value=تايلاند>تايلاند</OPTION>
                      <OPTION value=توغو>توغو</OPTION>
                      <OPTION value=توكيلو>توكيلو</OPTION>
                      <OPTION value=تونغا>تونغا</OPTION>
                      <OPTION value="ترينيداد وتوباغو">ترينيداد وتوباغو</OPTION>
                      <OPTION value=تركمانستان>تركمانستان</OPTION>
                      <OPTION value="جزر تركس وكايكوس">جزر تركس وكايكوس</OPTION>
                      <OPTION value=توفالو>توفالو</OPTION>
                      <OPTION value=أوغندا>أوغندا</OPTION>
                      <OPTION value=أوكرانيا>أوكرانيا</OPTION>
                      <OPTION value=أوروغواي>أوروغواي</OPTION>
                      <OPTION value=أوزباكستان>أوزباكستان</OPTION>
                      <OPTION value=فانواتو>فانواتو</OPTION>
                      <OPTION value=مدينة الفاتيكان>مدينة الفاتيكان</OPTION>
                      <OPTION value=فنزويلا>فنزويلا</OPTION>
                      <OPTION value=فيتنام>فيتنام</OPTION>
                      <OPTION value="والس وفوتونا">والس وفوتونا</OPTION>
                      <OPTION value="الصحراء الغربية">الصحراء الغربية</OPTION>
                      <OPTION value=زامبيا>زامبيا</OPTION>
                      <OPTION value=زيمبابوي>زيمبابوي</OPTION>
                      <OPTION value=صربيا>صربيا</OPTION>
                      <OPTION value="الجبل الأسود">الجبل الأسود</OPTION>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>المدينة</label>
                    <input name="city" class="form-control required " type="text" placeholder="ادخل مدينتك" value="" required="required">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>العنوان</label>
                    <input name="address" class="form-control required" type="text" placeholder="ادخل الموضوع" value="">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>الرساله</label>
                <textarea name="message" class="form-control required" rows="5" placeholder="ادخل رسالتك"></textarea>
              </div>
              <div class="form-group pull-left" style="width: 100%">
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
    float: left;"><?= $checknumber ?></span>
                    <input name="securitycode" class="form-control" type="hidden" style="width: 70%" placeholder="اعد كتابه هذا الكود" required="required" value="<?= $checknumber ?>" autocomplete="off">
                    <input name="writecode" class="form-control" type="text" style="    width: 65%;
    float: none;
    display: inline;" placeholder="اعد كتابه هذا الكود" required="required" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="form-group" style="    text-align: center;">
                <input name="form_botcheck" class="form-control" type="hidden" value="">
                <button type="submit" name="btnSubmit" value="btnSubmit" class="btn btn-dark btn-info btn-theme-colored btn-flat mr-5" data-loading-text="من فضلك انتظر ..." id="btn" title="ارسال">ارسال</button>
                <button type="reset" class="btn btn-default btn-flat btn-theme-colored" title="مسح">مسح البيانات</button>
              </div>
            </form>
          </div>
        </div>
      </div><!-- /.col-md-6 -->
      <div class="col-md-6">
        <div class="wprt-content-box text-white bg-about-1 bg-about">
          <div class="inner">
            <p>للتواصل معنا من خلال معلوات الاتصال</p>
            <ul class="styled-icons icon-dark icon-sm icon-circled mb-20">
              <li><a href="<?= getValue("facebook") ?>" data-bg-color="#3B5998" style="background: rgb(59, 89, 152) !important;"><i class="fab fa-facebook"></i></a></li>
              <li><a href="<?= getValue("twitter") ?>" data-bg-color="#02B0E8" style="background: rgb(2, 176, 232) !important;"><i class="fab fa-twitter"></i></a></li>
              <li><a href="https://web.whatsapp.com/send?phone=<?= getValue("whatsapp") ?>" data-bg-color="#D9CCB9" style="background: rgb(98 232 74) !important"><i class="fab fa-whatsapp"></i></a></li>
              <li><a href="<?= getValue("youtube") ?>" data-bg-color="#D71619" style="background: rgb(215, 22, 25) !important;"><i class="fab fa-youtube"></i></a></li>
            </ul>
            <div class="icon-box media mb-15"> <a class="media-left pull-right flip ml-20" href="#"> <i class="fa fa-map-marker"></i></a>
              <div class="media-body">
                <h5 class="mt-0">عناوين فروعنا</h5>
                <p><?= getValue("address" . $plang) ?></p>
              </div>
            </div>
            <div class="icon-box media mb-15"> <a class="media-left pull-right flip ml-15 " href="#"> <i class="fa fa-phone"></i></a>
              <div class="media-body">
                <h5 class="mt-0">الهواتف</h5>
                <p style="direction: ltr;"><a href="tel:<?= getValue("mobilepage") ?>"> <?= getValue("mobilepage") ?></a></p>
              </div>
            </div>
            <div class="icon-box media mb-15"> <a class="media-left pull-right flip ml-15" href="#"> <i class="fa fa-envelope"></i></a>
              <div class="media-body">
                <h5 class="mt-0">البريد الالكتروني</h5>
                <p><a href="mailto:<?= getValue("email") ?>"><?= getValue("email") ?></a></p>
              </div>
            </div>
            <iframe src="<?= getValue("googlemap") ?>" style="width: 100%" height="250" frameborder="0" allowfullscreen=""></iframe>
          </div>
        </div><!-- /.wprt-content-box -->
      </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
  </div><!-- /.wprt-container -->
</div> <!-- /.row-ab-why-choose-us -->
</div> <!-- /.row-ab-why-choose-us -->
<?php include "inc/footer.php" ?>