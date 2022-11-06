<style type="text/css">
    .bg-white {
        background-color: rgba(255, 255, 255, 0) !important;
    }
</style>
<div class="container">
    <!-- Outer Row -->
    <?php $forgot = $core->isv("forgot"); ?>
    <?php $rest = $core->isv("rest"); ?>
    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4" style="    font-size: 55px;"><i class="fas fa-fw fa-tachometer-alt"></i></h1>
                                    <?php if ($rest) { ?>
                                        <h6 class="text-gray-900 mb-4">قم بكتابة البريد الالكتروني سيتم ارسال كود تعين كلمة المرور عليه</h6>
                                    <?php } else if (!$forgot) { ?>
                                        <h6 class="text-gray-900 mb-4">قم بتسجيل الدخول للمتابعة</h6>
                                    <?php } else { ?>
                                        <h6 class="text-gray-900 mb-4">قم بادخل كود تعيين كلمة المرور المرسل عبر البريد</h6>
                                    <?php } ?>
                                </div>
                                <form class="user" action="?app=home">
                                    <?php if ($rest) { ?>
                                        <div class="form-group">
                                            <input type="email" name="email" class="text-center form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="ادخل بريدك">
                                        </div>
                                    <?php } elseif ($forgot) { ?>
                                        <div class="form-group">
                                            <input type="text" name="code" class="text-center form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="ادخل الكود">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="text-center form-control form-control-user" id="exampleInputPassword" placeholder="كلمة المرور الجديدة">
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group">
                                            <input type="text" name="username" class="text-center form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="اسم المستخدم">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="text-center form-control form-control-user" id="exampleInputPassword" placeholder="كلمة المرور">
                                        </div>
                                    <?php } ?>
                                    <button type="submit" class="btn btn-primary btn-user btn-block" value="login"> <?= $rest ? "ارسال" : "تسجيل الدخول  " ?> </button>
                                    <input id="forgot" type="hidden" name="forgot" value="<?= $forgot ?>">
                                    <input id="rest" type="hidden" name="rest" value="<?= $rest ?>">
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="?app=<?= $app ?>&rest=true">
                                        <?php if (!$forgot && !$rest) { ?>
                                            نسيت كلمة المرور ؟
                                        <?php } else if ($forgot) { ?>
                                            اعادة ارسال الكود ؟
                                        <?php } ?>
                                    </a>
                                    <?php if ($forgot || $rest) { ?> <br>
                                        <a class="small" href="?app=<?= $app ?>"> رجوع</a> <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>