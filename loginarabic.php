<?php
$pagg = 6;
include "inc.php";
/*
$lang : get form  inc.php  = arabic || english;
$plang : get form  inc.php for  php file name  = arabic || "";
$clang : get form  inc.php for column name  =  _arabic || "" ;
*/
//echo $core->getPageUrl("index","",true);
if ($_Login) {
    header("Location: " . $core->getPageUrl(($_affiliate ? "affiliates" : "index"), "", true));
    die();
}
$affiliate = "";
if ($_affiliate)
    $affiliate = "affiliate=1";
$forgot = $core->isv("forgot");
$msg = $core->isv("msg");
$rd = $core->isv("rd");
$er = $core->isv("er");
$rest = $core->isv("rest");
if ($rd)
    $rd = "?rd=out";
?>
<div id="pageContent" class="page-content">
    <div class="container" style=" padding-bottom: 30px;">
        <div class="col-xs-12 col-sm-12 col-md-12" id="content">
            <div class="row">
                <div id="notification"></div>
                <!-- Breadcrumbs -->
                <div class="block block-breadcrumbs clearfix">
                    <ul>
                        <li class="home">
                            <a href="/"><?= getTitle("index") ?></a>
                            <span></span>
                        </li>
                        <li> <?= $exTitle ?></li>
                    </ul>
                </div>
                <style type="text/css">
                    .alert.justify-content-center {
                        margin-top: 12px;
                        text-align: center;
                        display: none;
                    }
                </style>
                <div class="main-page">
                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <form action="#" method="post" enctype="multipart/form-data" data-id="login" id="login" <?php if ($rd) { ?> data-rd="<?= $core->getPageUrl("cart", "?out=1") ?>" <?php } ?> <?php if ($_affiliate) { ?> data-rd="<?= $core->getPageUrl("orders", "?affiliate=1") ?>" <?php } ?>>
                                    <div class="alert alert-<?= ($rd || $er ? "danger" : "success") ?> justify-content-center" style="display: <?= ($msg ? "block" : "none") ?>;" role="alert"><?= base64_decode($msg) ?></div>
                                    <input name="accountType" value="" type="hidden" />
                                    <div class="box-border">
                                        <h4 class="im-4"><?= $exTitle ?></h4>
                                        <?php if ($rest) { ?>
                                            <p class="im-p text-center"><?= plang("قم بكتابة البريد الالكتروني سيتم ارسال  كود تعين كلمة المرور عليه", "Type in the email and a code to set the password will be sent to it") ?></p>
                                        <?php } else if (!$forgot) { ?>
                                            <p class="im-p text-center"><?= plang("قم بتسجيل الدخول الى حسابك", "Log in to your account") ?></p>
                                        <?php } else { ?>
                                            <p class="im-p text-center"><?= plang("قم بادخل كود تعيين كلمة المرور  المرسل عبر البريد", "Enter the password set code sent by email") ?></p>
                                        <?php } ?>
                                        <?php if ($rest) { ?>
                                            <div class="form-group">
                                                <input type="email" name="email" class="text-center form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="<?= plang("ادخل بريدك", "Enter your email") ?>">
                                            </div>
                                        <?php } elseif ($forgot) { ?>
                                            <div class="form-group">
                                                <input type="text" name="code" class="text-center form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="<?= plang("ادخل الكود", "Enter the code") ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="text-center form-control form-control-user" id="exampleInputPassword" placeholder="<?= plang("كلمة المرور الجديدة", "new password") ?>">
                                            </div>
                                        <?php } else { ?>
                                            <p>
                                                <label><?= plang("البريد الالكترونى", "Email") ?></label>
                                                <input name="username" type="text" />
                                            </p>
                                            <p>
                                                <label><?= plang("كلمة المرور", "Password") ?></label>
                                                <input name="password" type="password" />
                                            </p> <?php } ?>
                                        <p class="text-left">
                                            <a class="small" href="<?= $core->getPageUrl("register", $rd . "?" . $affiliate) ?>"><?= plang("انشاء حساب جديد", "Create a new account") ?></a><br>
                                            <a class="small" href="<?= $core->getPageUrl("login", "?rest=true&" . $affiliate) ?>">
                                                <?php if (!$forgot && !$rest) { ?>
                                                    <?= plang("نسيت كلمة المرور ؟", "Forgot your password ?") ?>
                                                <?php } else if ($forgot) { ?>
                                                    <?= plang("اعادة ارسال الكود ؟ ", "Resend the code?") ?>
                                                <?php } ?>
                                            </a>
                                            <?php if ($forgot || $rest) { ?> <br>
                                                <a class="small" href="<?= $core->getPageUrl("login", "?" . $affiliate) ?>"> <?= plang("رجوع", "Back") ?></a> <?php } ?>
                                        </p>
                                        <input id="forgot" type="hidden" name="forgot" value="<?= $forgot ?>">
                                        <input id="rest" type="hidden" name="rest" value="<?= $rest ?>">
                                        <p>
                                            <button type="submit" class="button"><i class="fa fa-lock"></i> <?= $rest ? plang("ارسال", "send") : plang("تسجيل الدخول  ", "Login") ?></button>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php
include "inc/footer.php";
?>