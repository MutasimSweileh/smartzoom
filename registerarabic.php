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
$_msg = plang("تم انشاء الحساب بنجاح يمكنك تسجيل الدخول الان", "The account has been created successfully. You can log in now");
$msg = $core->isv("msg");
if ($msg)
    $msg = base64_decode($msg);
if ($_affiliate) {
    $_msg = plang("تم تسجيل الحساب بنجاح سيتم  الموافقه عليه من قبل الادارة وستصلك رسالة قريبا ...", "The account has been registered successfully. It will be approved by the administration and you will receive a message soon ...");
}
$_msg = base64_encode($_msg);
$rd = $core->isv("rd");
$forgot = $core->isv("forgot");
$rest = $core->isv("rest");
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
                                <form action="#" method="post" enctype="multipart/form-data" data-id="users" data-rd="<?= ($rd ? $core->getPageUrl("cart", "?out=1") : $core->getPageUrl(($_affiliate ? "register" : "login"), "?msg=" . $_msg . "&affiliate=" . ($_affiliate ? 1 : 0)))  ?>" <?php if (!$_affiliate && 1 == 2) { ?> data-msg="<?= plang("تم انشاء الحساب بنجاح يمكنك تسجيل الدخول الان", "The account has been created successfully. You can log in now") ?>" <?php } ?> id="login">
                                    <div class="alert alert-danger justify-content-center" role="alert"></div>
                                    <input name="active" value="<?= (!$_affiliate ? 1 : 0) ?>" type="hidden" />
                                    <!--                    <input name="_affiliate" value="<?= ($_affiliate ? 1 : 0) ?>" type="hidden" />
-->
                                    <div class="box-border">
                                        <h4 class="im-4"><?= $exTitle ?></h4>
                                        <p class="im-p text-center"><?= plang("قم بكتابة بملىء الحقول التالية", "Type and fill in the following fields") ?></p>
                                        <p>
                                            <label><?= plang("ادخل اسم المستخدم", "Enter your username") ?></label>
                                            <input name="username" type="text" />
                                        </p>
                                        <p>
                                            <label><?= plang("ادخل البريد الالكترونى", "Enter your email") ?></label>
                                            <input name="email" type="text" />
                                        </p>
                                        <p>
                                            <label><?= plang("كلمة المرور", "Password") ?></label>
                                            <input name="password" type="password" />
                                        </p>
                                        <p>
                                            <button type="submit" class="button"><i class="fa fa-user"></i> <?= plang("ارسال", "Send") ?></button>
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