<?php
$pagg = 6;
include "inc.php";
$do_submit = $core->isv("do_submit");
$out = $core->isv("out");
$agreement = $core->isv("agreement");
$er = 1;
$coupon_code = $core->Sion("_coupon_code");
$cartlist = $core->Sion("cartlist");
$total = $core->isv("total");
$msg = "";
if ($do_submit) {
  if ($agreement) {
    $_product = $core->isv("_product");
    $_product2 = $core->isv("_product2");
    $wight_price = $_POST["shipping_price"];
    $discount_price = $_POST["discount_price"];
    $val = $core->getData("coupons", "where coupon='" . $_POST["coupon_code"] . "'")[0];
    unset($_POST["do_submit"]);
    //unset($_POST["shipping_price"]);
    unset($_POST["discount_price"]);
    unset($_POST["_product"]);
    unset($_POST["_product2"]);
    $_POST["date"] = time();
    if (!$val["expiry_date"] || DateTime::createFromFormat("Y-m-d", $val["expiry_date"])->getTimestamp() < time())
      $core->UpDate("coupons", "active", 0, "where coupon='" . $coupon_code . "'");
    if ($val["count"]) {
      $val["count"]--;
      if (!$val["count"])
        $core->UpDate("coupons", "active", 0, "where coupon='" . $coupon_code . "'");
      else {
        $core->UpDate("coupons", "count", $val["count"], "where coupon='" . $coupon_code . "'");
      }
    }
    $core->Sion("_coupon_code", null);
    $sql = $core->SqlIn("order", $_POST);
    if ($sql) {
      $order_id = $sql;
      foreach ($_product as $p) {
        $p_ep = explode("-", $p);
        $sql = $core->SqlIn("order_products", array("product_id" => $p_ep[0], "order_id" => $order_id, "price" => $p_ep[2], "quantity" => $p_ep[1]));
      }
      if ($sql) {
        $titlee = $core->getEngines(array("page" => "info"))[0];
        $alt = $titlee["title"];
        $text = "I have sent the following message to you through a form on the ";
        $text .= '<a href="' . $PUr . '">' . $alt . '</a> website<br><br>';
        $text .= '<strong style="    color: blue;">Order information</strong><br>';
        $text .= '<strong>Order S/N</strong> : ' . $order_id . '<br>';
        //$_POST["orderID"] = $sql;
        unset($_POST["date"]);
        unset($_POST["agreement"]);
        $_POST["Delivery Note"] = $_POST["message"];
        $total = $_POST["total"];
        unset($_POST["message"]);
        unset($_POST["total"]);
        unset($_POST["shipping_price"]);
        $array2 = array("user_id", "name", "city", "zone", "address", "mobile", "email", "Delivery Note", "wight");
        $orderedArray = array();
        foreach ($array2 as $key) {
          $orderedArray[$key] = $_POST[$key];
        }
        foreach ($orderedArray as $k => $v)
          $text .= ($k == "Delivery Note" ? "<br>" : "") . "<strong>" . ucfirst($k) . "</strong> : " . $v . '<br>';
        $text .= '<br><strong>Products</strong> : <br>';
        $text .= '<style>td, th {
    border: 1px solid;
        padding: 5px;
}</style><table style="width: 100%">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Total</th>
    </tr>
';
        $t = 0;
        foreach ($_product2 as $x => $v) {
          $s = explode("-", $v);
          $text .= '<tr>
        <td>' . ($x + 1) . '</td>
        <td>' . $s[0] . '</td>
        <td>' . $s[1] . '</td>
        <td>' . $s[2] . '</td>
        <td>' . ($s[1] * $s[2]) . '</td>
    </tr>';
          $t += ($s[1] * $s[2]);
        }
        $text .= '</table><strong>Total</strong> : ' . $t . ' LE<br>';
        $text .= '<strong>Delivery</strong> : ' . $wight_price . ' LE<br>';
        if ($discount_price) {
          // $msg = plang("تم اضافة الكوبون","Coupon added")." '".$coupon_code."' ".($_code_type?plang("لمصاريف الشحن","for shipping expenses"):plang("للطلب","for total order price"));
          // $msg .= plang(" خصم "," discount")." ".$_code."%";  
          //$text .='<strong>Coupon code</strong> : '.$_POST["coupon_code"].'<br>';
          $text .= '<strong>Coupon code</strong> : ' . ($val["coupon_type"] ? "shipping expenses discount " : "total order price discount ") . $val["value"] . ' %<br>';
          $text .= '<strong>Total before discount</strong> : ' . $discount_price . ' LE<br>';
        }
        $text .= '<strong>Grand Total</strong> : ' . $total . ' LE<br>';
        $text .= "<br>Thank you.";
        $mail->FromName = $alt . " - " . $_Login["username"];
        $info_media["code"] = "email";
        $contents = $core->getinfo_media($info_media);
        $emaills = $contents[0]["link"];
        $mail->AddAddress($emaills);
        //$mail->AddReplyTo("mail@mail.com");
        $mail->IsHTML(true);
        $mail->Subject = $alt . " - Order";
        $mail->Body = $text;
        $mail->Send();
        $cartClear = true;
        $msg = plang("تم ارسال طلبك بنجاح ستواصل معك احد المسؤلين  قريبا شكرا لك .", "Your request has been successfully sent. An official will contact you shortly. Thank you.");
        $er = 0;
      } else {
        $msg = $core->DBgetError();
      }
    } else {
      $msg = $core->DBgetError();
    }
  } else
    $msg = plang("برجاء الموافقه علي الشروط والأحكام وسياسات البيع .", "Please agree to the terms and conditions and sales policies.");
}
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
            <div class="row" id="inc_cart">
              <?php if ($out) {
                if (!$_Login) {
                  $msg = plang("قم بتسجيل الدخول اولا حتى تتمكن من المتابعه او قم بتسجيل حساب جديد .", "Log in first to be able to continue or register a new account.");
                  header("Location: " . $core->getPageUrl("login", "?msg=" . base64_encode($msg) . "&rd=out", true));
                  die();
                }
                if (!$cartlist) {
                  header("Location: " . $core->getPageUrl("cart", '', true));
                  die();
                }
              ?>
                <form id="contact_form" name="contact_form" class="" action="#" method="post">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="alert alert-<?= (!$er ? "success" : "danger") ?> justify-content-center" role="alert" style="display: <?= ($msg ? "block" : "none") ?>;"><?= $msg ?><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></div>
                  </div>
                  <?php if ($core->Sion("cartlist") && !$cartClear) { ?>
                    <div class="col-md-12 col-lg-8 cart-table-wrap">
                      <div class="wprt-content-box">
                        <div class="inner">
                          <!-- Contact Form -->
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label><?= plang("البريد الالكتروني ", "E-mail") ?></label>
                                <input name="email" value="<?= $_Login["email"] ?>" class="form-control required email" type="email" value="" required="required">
                              </div>
                            </div>
                            <div class="col-sm-6 pull-rightt">
                              <div class="form-group">
                                <label><?= plang("الاسم", "Full Name") ?></label>
                                <input name="name" value="<?= $_Login["name"] ?>" class="form-control" type="text" required="required" value="">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-6 pull-rightt">
                              <div class="form-group">
                                <label><?= plang("المحافظة", "Governorate") ?></label>
                                <select class="form-control required" name="city" style="width: 100%;">
                                  <?php //include "country.php"; 
                                  ?>
                                  <?php
                                  $regions = $core->getData("regions");
                                  for ($i = 0; $i < count($regions); $i++) {
                                  ?>
                                    <option value="<?= $regions[$i]["text" . $clang] ?>" data-id="<?= $regions[$i]["id"] ?>"><?= $regions[$i]["text" . $clang] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label><?= plang("المنطقه", "Region") ?></label>
                                <select class="form-control required" name="zone" style="width: 100%;">
                                  <?php //include "country.php"; 
                                  ?>
                                  <?php
                                  $regions = $core->getData("locations");
                                  for ($i = 0; $i < count($regions); $i++) {
                                  ?>
                                    <option value="<?= $regions[$i]["zone"] ?>"><?= $regions[$i]["text" . $clang] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-lg-6">
                              <div class="form-group">
                                <label><?= plang("الموبيل", "Mobile") ?></label>
                                <input name="mobile" class="form-control" type="text" value="">
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label><?= plang("العنوان", "Address") ?></label>
                                <input name="address" class="form-control required" type="text" value="">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label><?= plang("المزيد من التفاصيل", "More details") ?></label>
                            <textarea name="message" class="form-control required" rows="5"></textarea>
                          </div>
                        </div>
                      </div>
                    </div><!-- /.col-md-6 -->
                    <div class="opc-wrapper-opc">
                      <div class="col-md-12 col-lg-4">
                        <div class="" id="opc-review-block">
                          <div id="checkout-review-table-wrapper">
                            <h3 class="review-title"><?= plang("راجع طلبك", "Review your request") ?></h3>
                            <table class="opc-data-table" id="checkout-review-table">
                              <?php         ?>
                              <colgroup>
                                <col>
                                <col width="1">
                                <col width="1">
                                <col width="1">
                              </colgroup>
                              <thead>
                                <tr class="first last">
                                  <th rowspan="1"><?= plang("اسم المنتج", "product name") ?></th>
                                  <th rowspan="1" class="a-center"><?= plang("الكمية", "Quantity") ?></th>
                                  <th colspan="1" class="a-center"><?= plang("المجموع الفرعي", "Subtotal") ?></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $data2 = $core->getBlog(array("in" => $cartlist));
                                if ($cartlist) {
                                  $_price = 0;
                                  $_wight = 0;
                                  $_qt = 0;
                                  $g_wight = 0;
                                  if ($data2)
                                    for ($y = 0; $y < count($data2); $y++) {
                                      $price = $data2[$y]["price"];
                                      $wight = $data2[$y]["wight"];
                                      $expiry_date = expiry_date($data2[$y], "stock", true);
                                      $qt = qty($data2[$y]["id"]);
                                      if ($data2[$y]["discount"] && !$expiry_date[0])
                                        $price = $data2[$y]["discount"];
                                      //$price =  $price * $qt;
                                      $_qt =  $price * $qt;
                                      $wight = preg_match('/\d+/', $wight, $m) ? $m[0] : 0;
                                      //  $_wight += ($wight * $qt);
                                      $_price +=  $_qt;
                                ?>
                                    <tr class="first odd">
                                      <td>
                                        <h3 class="product-name"><?= $data2[$y]["name" . $clang] ?></h3>
                                        <img src="images/<?= $data2[$y]["image"] ?>" alt="<?= $data2[$y]["name"] ?>" class="checkout-cart-image">
                                      </td>
                                      <td class="a-center"><?= $qt ?></td>
                                      <!-- sub total starts here -->
                                      <td class="a-right last">
                                        <span class="cart-price">
                                          <input type="hidden" name="_product[]" value="<?= $data2[$y]["id"] ?>-<?= $qt ?>-<?= $price ?>">
                                          <input type="hidden" name="_product2[]" value="<?= str_replace('"', "'", $data2[$y]["name"]) ?>-<?= $qt ?>-<?= $price ?>">
                                          <span class="price"><?= $_qt ?> &nbsp;<?= plang("جنية", "Pounds") ?></span>
                                        </span>
                                      </td>
                                    </tr> <?php }
                                    } ?>
                              </tbody>
                              <tfoot>
                                <tr class="first">
                                  <td style="" class="a-right" colspan="2">
                                    <?= plang("المجموع الكلي", "Total amount") ?> </td>
                                  <td style="" class="a-right last">
                                    <span class="price"><?= $_price ?> &nbsp;<?= plang("جنية", "Pounds") ?></span>
                                  </td>
                                </tr>
                                <tr class="first">
                                  <td style="" class="a-right" colspan="2">
                                    <?= plang("مصاريف الشحن", "Shipping expenses") ?> </td>
                                  <td style="" class="a-right last">
                                    <span class="price"><span id="Shipping_price"><?= $_wight ?></span> &nbsp;<?= plang("جنية", "Pounds") ?></span>
                                  </td>
                                </tr>
                                <?php if ($coupon_code) {   ?>
                                  <tr>
                                    <td style="" class="a-right" colspan="2">
                                      <?= plang("المجموع  قبل الخصم ", "Total before discount") ?> </td>
                                    <td style="" class="a-right last">
                                      <span class="price"><span id="discount_price"><?= $_price ?></span>&nbsp;<?= plang("جنية", "Pounds") ?></span>
                                    </td>
                                  </tr>
                                  <?php
                                  $sql = $core->Sel("coupons", "where coupon='" . $coupon_code . "' and active=1");
                                  $_code  = $sql->value;
                                  $_code_type  = $sql->coupon_type;
                                  /*
       if($coupon_code){
                        }
    if($coupon_code && $_code){           $_price -= (($_code*$_price)/100);
        }*/ ?>
                                  <tr>
                                    <td colspan="3">
                                      <?php
                                      $msg = plang("تم اضافة الكوبون", "Coupon added") . " '" . $coupon_code . "' " . ($_code_type ? plang("لمصاريف الشحن", "for shipping expenses") : plang("للطلب", "for total order price"));
                                      $msg .= plang(" خصم ", " discount") . " " . $_code . "%";
                                      ?>
                                      <span class="price2" style="color: #2c9806;"><span><?= $msg ?></span>
                                    </td>
                                  </tr>
                                <?php } ?>
                                <tr class="last">
                                  <td style="" class="a-right" colspan="2">
                                    <strong><?= plang("المجموع الكلي", "Total amount") ?></strong>
                                  </td>
                                  <td style="" class="a-right last">
                                    <strong><span class="price"><?= $_price ?> &nbsp;<?= plang("جنية", "Pounds") ?></span></strong>
                                  </td>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                        </div>
                        <div class="opc-review-actions" id="checkout-review-submit">
                          <h5 class="grand_total"><?= plang("السعر النهائي", "The final price") ?><span class="price"><span class="price"><span id="final_price"><?= ($_price + $_wight) ?></span> &nbsp;<?= plang("جنية", "Pounds") ?></span></span></h5>
                          <p style="    font-size: 13px;"><?= plang("الأسعار المعلنة للمنتجات المعروضة شاملة ضريبة القيمة المضافة وفقًا لقانون ضريبة القيمة المضافة في مصر.
", "The advertised prices for products displayed are inclusive of all VAT in accordance with the Egypt VAT law
") ?></p>
                          <input type="hidden" name="shipping_price" data-price="<?= $_price ?>" value="<?= $_wight ?>">
                          <input type="hidden" name="total" value="<?= ($_price + $_wight) ?>">
                          <input type="hidden" name="user_id" value="<?= $_Login["id"] ?>">
                          <?php if ($coupon_code) { ?>
                            <input name="discount_price" value="<?= $coupon_code ?>" type="hidden" />
                            <input name="coupon_code" value="<?= $coupon_code ?>" data-val="<?= $_code ?>" data-type="<?= $_code_type ?>" type="hidden" />
                          <?php } ?>
                          <div action="" id="checkout-agreements">
                            <ol class="checkout-agreements">
                              <li>
                                <div id="agreement-block-3" class="agreement-content hidden">
                                  <?= plang("موافق علي الشروط والأحكام وسياسات البيع", "I agree to the terms and conditions and policies of Alia") ?> </div>
                                <p class="agree">
                                  <input type="checkbox" id="agreement-3" name="agreement" value="1" title="موافق علي الشروط والأحكام وسياسات البيع" class="checkbox">
                                  <a class="view-agreement" for="agreement-3" data-id="3"><?= plang("موافق علي الشروط والأحكام وسياسات اليع", "I agree to the terms and conditions and policies of Alia") ?></a>
                                </p>
                              </li>
                            </ol>
                          </div>
                          <!-- add validate function to the button -->
                          <button name="do_submit" value="do_submit" type="submit" title="تنفيذ الطلب الآن" class="button btn-checkout opc-btn-checkout">
                            <span><span><?= plang("تنفيذ الطلب الآن", "Execute the order now") ?></span></span>
                          </button>
                        </div>
                      </div><!-- /.col-md-6 -->
                    </div> <?php } ?>
                </form>
              <?php } else {
                $action = "inc_cart";
                include "ajax.php";
              } ?>
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