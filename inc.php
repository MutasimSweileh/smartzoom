<?php
@ob_start();
@session_start();
include('inc/TinyMinify.php');
include('inc/top-cache.php');
include_once("classes/core.php");
$core = new core;
require("class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "mail.sherktk.net";
$mail->SMTPAuth = true;
$mail->Port = 587;
$mail->Username = "mail@sherktk.net";
$mail->Password = "JCrS%^)qc!eH";
$mail->From = "mail@sherktk.net";
$name = pathinfo(basename($_SERVER["PHP_SELF"]))["filename"];
$_id = isv("id");
if (!$_id)
  $_id = isv("level");
$pname = pathinfo(basename($_SERVER["PHP_SELF"]))["filename"];
$_show = array("products");
$_hide = array("rest", "forgot", "register", "cart", "out", "products");
$_show = (in_array($name, $_show) && !$_id);
$_affiliate = ($core->isv("affiliate")  || strpos($name, "affiliate") !== false);
$_Login = $core->Sion("admin_id");
if ($_Login)
  $_Login = $core->getlogin(array("id" => $_Login));
if ($_Login) {
  $_Login = $_Login[0];
  $_Login["name"] = ($_Login["name"] ? $_Login["name"] : $_Login["username"]);
}
/*print_r($_Login);
die();*/
$lang = (strpos($name, "arabic") ? "arabic" : "english");
$plang = ($lang == "arabic" ? $lang : "");
//$plang = "";
$clang = ($lang == "english" ? "" : "_arabic");
$cartClear = false;
//$lang = "arabic";
$_key = getKey();
if ($core->isv("logout")) {
  $core->Sion("admin_name", "false");
  $core->Sion("admin_id", "false");
  header("Location: " . $core->getPageUrl("index", "", true));
  die();
}
if (strpos($FUr, "php") === false) {
  //header("Location: " . $core->getPageUrl("indexarabic", "", true));
}
if (!$core->isv("action")) {
  include  "inc/header.php";
}
if (isset($_POST["subscribe"])) {
  $text =  $_POST["email"];
  $mail->FromName = $alt . " - Subscribe";
  $info_media["code"] = "email";
  $contents = $core->getinfo_media($info_media);
  $emaills = $contents[0]["link"];
  $mail->AddAddress($emaills);
  //$mail->AddReplyTo("mail@mail.com");
  $mail->IsHTML(true);
  $mail->Subject = "Subscribe";
  $mail->Body = $text;
  //$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
  $core->addemail(array("email" => $_POST["email"]));
  if ($mail->Send()) {
?>
    <script type="text/javascript">
      alert(<?= plang("شكرا لك , تم الاشتراك بنجاح فى القائمة البريديه", "Thank you, you have successfully subscribed to the mailing list") ?>);
    </script>
  <?php
  } else { ?>
    <script type="text/javascript">
      alert("<?= trim(htmlspecialchars_decode(str_replace("</p>", " ", str_replace("<p>", " ", $mail->ErrorInfo)))) ?>");
    </script>
<?php  }
}
?>