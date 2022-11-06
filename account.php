<?php
$pagg = 6;
include "inc.php";
?>
<style type="text/css">
  input.qty {
    margin-left: 2px;
    display: inline-block;
    vertical-align: middle;
    height: 38px;
    width: auto;
    font-size: 14px;
    text-align: center;
    color: #08c;
    border-color: #e1e1e1;
    border: 1px solid #ccc;
  }

  button.button {
    -webkit-border-fit: lines;
    overflow: visible;
    width: auto;
    border: 0;
    padding: 0;
    margin: 0;
    background: transparent;
    cursor: pointer;
  }

  button.button span span {
    border: 0;
    padding: 0;
    color: inherit;
    border-width: 0;
    background: transparent;
    line-height: inherit;
  }

  .cart .totals .checkout-types {
    font-size: 13px;
    text-align: center;
  }

  button.button span {
    display: block;
    border: 0;
    background: #2f9c0a;
    padding: 0 15px;
    font-weight: 400;
    font-size: 14px;
    text-align: center;
    white-space: nowrap;
    color: #fff;
    line-height: 38px;
    border-radius: 5px;
  }

  .cart-table thead th {
    text-align: right;
  }

  .block-breadcrumbs {
    font-size: 12px;
    margin-bottom: 20px;
  }

  button#btn {
    background-color: #fcca0d;
    color: #000;
    margin: 0 10px;
  }
</style>
<div id="pageContent" class="page-content cart">
  <div class="container" style=" padding-bottom: 30px;">
    <div class="col-xs-12 col-sm-12 col-md-12" id="content">
      <div class="row">
        <div id="notification"></div>
        <!-- Breadcrumbs -->
        <div class="block block-breadcrumbs clearfix">
          <ul>
            <li class="home">
              <a href=""><?= getTitle("index") ?></a>
              <span></span>
            </li>
            <li> <?= $exTitle ?></li>
          </ul>
        </div>
        <style type="text/css">
          .alert.justify-content-center {
            margin-top: 12px;
            /*    text-align: center;  */
          }
        </style>
        <div class="main-page">
          <div class="page-content">
            <div class="row">
              <?php if (!$_Login) {
                $msg = plang("قم بتسجيل الدخول اولا حتى تتمكن من المتابعه او قم بتسجيل حساب جديد .", "Log in first to be able to continue or register a new account.");
                header("Location: " . $core->getPageUrl("login", "?msg=" . base64_encode($msg) . "&affiliate=1", true));
                die();
              }
              ?>
              <form id="users" class="" action="#" method="post">
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
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label><?= plang('البريد الالكتروني ', 'Email') ?></label>
                            <input name="email" value="<?= $_Login["email"] ?>" class="form-control required email" type="email" placeholder="<?= plang('البريد الالكتروني ', 'Email') ?>" value="" required="required">
                          </div>
                          <input id="mydata" type="hidden" value="<?= $_Login["id"] ?>" name="mydata">
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>الموبيل</label>
                            <input name="mobile" class="form-control required" type="text" value="<?= $_Login["mobile"] ?>">
                          </div>
                        </div>
                        <div class="col-sm-4 pull-rightt">
                          <div class="form-group">
                            <label><?= plang('الاسم الكامل', 'Full Name') ?></label>
                            <input name="username" value="<?= $_Login["username"] ?>" class="form-control" type="text" placeholder="<?= plang('الاسم الكامل', 'Full Name') ?>" required="required" value="">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="change_password2"><?= plang('تغيير كلمة المرور', 'Change Password') ?></label>
                            <input style="    display: inline-block;
    float: <?= plang("right", "left") ?>;
    margin-<?= plang("left", "right") ?>: 10px;" type="checkbox" name="change_password" id="change_password2" value="1" onclick="$('#change_password').toggleClass('hide');" title="تغيير كلمة المرور" class="checkbox">
                          </div>
                        </div>
                      </div>
                      <div class="row hide" id="change_password">
                        <div class="col-sm-6 pull-rightt">
                          <div class="form-group">
                            <label><?= plang('تأكيد كلمة المرور الجديدة', 'Confirm the new password') ?></label>
                            <input name="confirmation" value="" class="form-control" value="">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?= plang('كلمة مرور جديدة', 'New password') ?></label>
                            <input name="password" class="form-control required" type="text" value="">
                          </div>
                        </div>
                      </div>
                      <div class="form-groups" style="    text-align: <?= plang("left", "right") ?>;">
                        <button type="submit" name="btnSubmit" value="btnSubmit" class="btn btn-dark btn-info btn-theme-colored btn-flat mr-5" id="btn"><?= plang('حفظ البيانات', 'Save change') ?></button>
                      </div>
                    </div>
                  </div>
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
<?php
include "inc/footer.php";
?>