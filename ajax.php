<?php
@ob_start();
@session_start();
if (!isset($action)) {
    include "inc.php";
    $action =  $core->isv("action");
}
$id =  $core->isv("id");
$mydata = $core->isv("mydata");
$option = $core->isv("option");
$select = $core->isv("select");
$get = $core->isv("get");
if ($action == "upload" && !$get) {
    $temp = current($_FILES);
    $file_name = $temp['name'];
    // File extension
    $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = time();
    // Validate type of file
    if (move_uploaded_file($temp['tmp_name'], "../images/" . $file_name)) {
        if (in_array(strtolower($file_type), ['jpeg', 'jpg', 'png', 'gif'])) {
            $core->compress("../images/" . $file_name, "../images/" . $file_name, 70);
        }
        echo json_encode(array("st" => "ok", "file" => $file_name, 'location' => "" . $file_name, "msg" => "تم رفع الملف بنجاح"));
    } else
        echo json_encode(array("st" => "error", "msg" => 'حدث خطأ اثناء رفع الملف'));
    /*}
else {
    echo json_encode(array("st"=>"error","msg"=>'Error : Only JPEG, PNG & GIF allowed'));
}*/
} else if ($action == "inc_cart" && !$get) {
    if (isv("plang")) {
        $plang = isv("plang");
        $clang = ($plang ? "_arabic" : "");
    }
?>
    <?php $coupon_code = $core->Sion("_coupon_code");
    $sql = $core->Sel("coupons", "where coupon='" . $coupon_code . "' and active=1");
    $_code  = $sql->value;
    $_code_type  = $sql->coupon_type;
    // $msg = plang("تم اضافة الكوبون","Coupon added")." '".$coupon_code."' ".plang("بنجاح","Successfully");
    $msg = plang("تم اضافة الكوبون", "Coupon added") . " '" . $coupon_code . "' " . ($_code_type ? plang("لمصاريف الشحن", "for shipping expenses") : plang("للطلب", "for total order price"));
    $msg .= plang(" خصم ", " discount") . " " . $_code . "%";
    $cartlist = $core->Sion("cartlist");
    $data2 = array();
    if (!$cartlist) {
        alert(plang("لايوجد منتجات فى عربة التسوق", "There are no products in the shopping cart"), true);
    } else { ?>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="alert alert-success justify-content-center" role="alert" style="display: <?= ($coupon_code ? "block" : "none") ?>;"><?= $msg ?><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="cart-table-wrap">
                <form action="" method="post">
                    <fieldset>
                        <table id="shopping-cart-table" class="data-table cart-table">
                            <thead>
                                <tr class="first last">
                                    <th rowspan="1">&nbsp;</th>
                                    <th rowspan="1">&nbsp;</th>
                                    <th rowspan="1"><span class="nobr"><?= plang("اسم المنتج", "Product name") ?></span></th>
                                    <th colspan="1"><span class="nobr"><?= plang("سعر الوحدة", "Price per") ?></span></th>
                                    <th rowspan="1"><?= plang("الكمية", "Quantity") ?></th>
                                    <th class="last" colspan="1"><?= plang("المجموع الفرعي", "Subtotal") ?></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="first last">
                                    <td colspan="50" class="a-right last">
                                        <button type="button" title="الاستمرار بالتسوق" class="button btn-continue" onclick="location.replace('<?= $core->getPageUrl("index") ?>')"><span><span><?= plang("الاستمرار بالتسوق", "Keep shopping") ?></span></span></button>
                                        <button type="submit" name="update_cart_action" value="empty_cart" title="تفريغ عربة التسوق" class="button btn-empty" id="empty_cart_button" onclick="return  addtocart(-2);"><span><span><?= plang("تفريغ عربة التسوق", "Empty your cart") ?></span></span></button>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $data2 = $core->getBlog(array("in" => $cartlist));
                                if ($cartlist) {
                                    $_price = 0;
                                    $_wight = 0;
                                    $_qt = 0;
                                    $g_wight = getValue("wight");
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
                                            $_wight += ($wight);
                                            $_price +=  $_qt;
                                ?>
                                        <tr class="first last odd" id="pc2<?= $data2[$y]["id"] ?>">
                                            <td class="action-td"><a href="#" onclick="addtocart('<?= $data2[$y]["id"] ?>',-1); return false;" title="<?= $data2[$y]["name" . $clang] ?>" title="إالغاء المنتتج" class="btn-remove btn-remove2" onclick="return confirm('هل أنت متأكد من إزالة هذه السلعة من عربة التسوق؟');"></a></td>
                                            <td class="pr-img-td"><a href="<?= $core->getBlogUrl(array($data2[$y]["id"], $data2[$y]["name" . $clang]), "products") ?>" title="<?= $data2[$y]["name" . $clang] ?>" class="product-image"><img src="images/<?= $data2[$y]["image"] ?>" width="80" height="80" alt="<?= $data2[$y]["name" . $clang] ?>"></a></td>
                                            <td class="product-name-td">
                                                <h2 class="product-name">
                                                    <a href="<?= $core->getBlogUrl(array($data2[$y]["id"], $data2[$y]["name" . $clang]), "products") ?>"><?= $data2[$y]["name" . $clang] ?></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <span class="cart-price">
                                                    <span class="price"><?= $price ?>&nbsp;<?= plang("جنية", "Pounds") ?></span>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="qty-holder">
                                                    <a href="#" class="table_qty_dec" onclick="addtocart(<?= $data2[$y]["id"] ?>,-2);return false;">-</a><input name="qty[]" value="<?= $qt ?>" size="3" title="الكمية" class="input-text qty" maxlength="12" id="qty<?= $data2[$y]["id"] ?>"><a href="#" class="table_qty_inc" onclick="addtocart(<?= $data2[$y]["id"] ?>,-3);return false;">+</a>
                                                </div>
                                            </td>
                                            <td class="td-total last">
                                                <span class="cart-price">
                                                    <span class="price"><?= $_qt ?>&nbsp;<?= plang("جنية", "Pounds") ?></span>
                                                </span>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3">
            <div class="cart-collaterals">
                <form id="coupon_code" action="" method="post" data-ajax="inc_cart">
                    <div class="discount">
                        <h2><?= plang("كود الخصم", "Discount code") ?></h2>
                        <?php  ?>
                        <div class="discount-form">
                            <div class="input-box">
                                <label for="coupon_code"><?= ($coupon_code ? plang("تم ادخال الكوبون التالى", "The next coupon has been entered") : plang("إذا كنت تملك كوبونا فقم بإدخال الكود.", "If you have a coupon, enter the code.")) ?></label>
                                <input class="input-text" <?= (!$coupon_code ? "" : "disabled") ?> id="coupon_code" name="coupon_code<?= (!$coupon_code ? "" : "disabled") ?>" value="<?= $coupon_code ?>">
                            </div>
                            <div class="buttons-set">
                                <?php if ($coupon_code) { ?>
                                    <input name="coupon_code" value="<?= $coupon_code ?>" type="hidden" />
                                <?php } ?>
                                <input name="_coupon" value="<?= $coupon_code ?>" type="hidden" />
                                <button type="submit" class="button" value="coupon_code"><span><span><?= ($coupon_code ? plang("حذف الكوبون", 'Delete coupon') : plang("استخدام كوبون", "Use Coupon")) ?></span></span></button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="totals">
                    <h2><?= plang("إجمالي العربة", "Cart Total") ?></h2>
                    <div>
                        <table id="shopping-cart-totals-table">
                            <colgroup>
                                <col>
                                <col width="1">
                            </colgroup>
                            <?php
                            if ($coupon_code) {
                                $sql = $core->Sel("coupons", "where coupon='" . $coupon_code . "' and active=1");
                                if ($sql && !$sql->coupon_type)
                                    $_code  = $sql->value;
                            }
                            if ($coupon_code && $_code && !$sql->coupon_type) {   ?>
                                <tbody>
                                    <tr>
                                        <td style="" class="a-right" colspan="1">
                                            <?= plang("  المجموع  قبل الخصم ", "Total before discount") ?> </td>
                                        <td style="" class="a-right">
                                            <span class="price"><?= $_price ?>&nbsp;<?= plang("جنية", "Pounds") ?></span>
                                        </td>
                                    </tr>
                                </tbody><?php } ?><tfoot>
                                <tr>
                                    <td style="" class="a-right" colspan="1">
                                        <strong><?= plang("المجموع الكلي", "Total amount") ?></strong>
                                    </td>
                                    <td style="" class="a-right">
                                        <?php if ($coupon_code && $_code && !$sql->coupon_type) {
                                            $_price -= ceil(($_code * $_price) / 100);
                                        } ?>
                                        <strong><span class="price"><?= $_price ?>&nbsp;<?= plang("جنية", "Pounds") ?></span></strong>
                                    </td>
                                </tr>
                                <!-- <tr>
    <td style="" class="a-right" colspan="1">
        <strong><?= plang("مصاريف الشحن", "Shipping expenses") ?></strong>
    </td>
    <td style="" class="a-right">
                  <?php
                    $g_wight = getValue("wight");
                    $_wight = ($_wight / 1000);
                    $max_wight_count = getValue("max_wight_count");
                    $max_wight = getValue("max_wight");
                    if ($_wight >= $max_wight_count) {
                        $_wight = (($_wight - $max_wight_count) * $g_wight) + $max_wight;
                    } else
                        $_wight = $max_wight;
                    ?>
        <strong><span class="price"><?= $_wight ?>&nbsp;<?= plang("جنية", "Pounds") ?></span></strong>
    </td>
</tr>
 <tr>
    <td style="" class="a-right" colspan="1">
        <strong><?= plang("السعر النهائى", "The final price") ?></strong>
    </td>
    <td style="" class="a-right">
        <strong><span class="price"><?= ($_price) ?>&nbsp;<?= plang("جنية", "Pounds") ?></span></strong>
    </td>
</tr> -->
                            </tfoot>
                        </table>
                        <ul class="checkout-types">
                            <li> <button type="button" title="المواصلة لإنهاء الطلب" class="button btn-proceed-checkout btn-checkout" onclick="window.location='<?= $core->getPageUrl("cart", "?out=1") ?>';"><span><span><?= plang("الانتقال الى الخطوة التالية", "Move to the next step") ?></span></span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php
} else if ($action == "wight_price" && !$get) {
    $id = $core->isv("id");
    $_wight = $core->isv("wight");
    $_wight = preg_match('/\d+/', $_wight, $m) ? $m[0] : 0;
    $zon = $core->getData("zones", "where id=" . $id)[0];
    $g_wight = $zon["add"];
    $_wight = ($_wight / 1000);
    $_wight = ceil($_wight);
    // $_wight = 10;
    $max_wight_count = 2;
    $max_wight = $zon["up"];
    if ($_wight >= $max_wight_count) {
        //$_wight = (($_wight - $max_wight_count) * $g_wight) + $max_wight;
        //if($_wight >= 3)
        $_wight = (($_wight - $max_wight_count) * $g_wight) + $max_wight;
        //else
        //   $_wight = $g_wight + $max_wight;
    } else
        $_wight = $max_wight;
    echo json_encode(array("st" => "ok", "wight_price" => $_wight));
    die();
} else if ($action == "inc_zones" && !$get) {
    $plang = isv("plang");
    $clang = ($plang ? "_arabic" : "");
    $id = $core->isv("id");
    $regions = $core->getData("locations", "where region=" . $id);
    for ($i = 0; $i < count($regions); $i++) {
    ?>
        <option value="<?= $regions[$i]["text" . $clang] ?>" data-price="<?= $regions[$i]["price"] ?>"><?= $regions[$i]["text" . $clang] ?></option>
    <?php }
} else if ($action == "cart" && !$get) {
    $plang = isv("plang");
    if (isset($plag))
        $plang = $plag;
    $clang = ($plang ? "_arabic" : "");
    ?>
    <?php $cartlist = $core->Sion("cartlist");
    $data2 = array();
    if ($cartlist)
        $data2 = $core->getBlog(array("in" => $cartlist));
    ?>
    <div class="custom-block"></div>
    <div class="mini-cart" onmouseover="$(this).children('.topCartContent').fadeIn(200);
                   return false;" onmouseleave="$(this).children('.topCartContent').fadeOut(200);
                   return false;">
        <a href="javascript:void(0)" class="mybag-link">
            <span class="shopping-cart ti ti-shopping-cart"></span><span class="cart-info"><span class="cart-qty"><?= count($data2) ?></span></span>
        </a>
        <div class="topCartContent block-content theme-border-color">
            <div class="inner-wrapper">
                <?php if (!$cartlist) {   ?>
                    <p class="cart-empty">
                        <?= plang("لا توجد لديك منتجات في عربة التسوق  ", "You have no items in your shopping cart") ?> </p>
                <?php } else { ?>
                    <div>
                        <div class="top-cart-content">
                            <div class="block-subtitle hidden-xs"><?= plang("المنتجات المضافة", "Added products") ?></div>
                            <ul id="cart-sidebar" class="mini-products-list">
                                <?php if ($cartlist) {
                                    $_price = 0;
                                    $_qt = 0;
                                    if ($data2)
                                        for ($y = 0; $y < count($data2); $y++) {
                                            $price = $data2[$y]["price"];
                                            $qt = qty($data2[$y]["id"]);
                                            if ($data2[$y]["discount"])
                                                $price = $data2[$y]["discount"];
                                            $_qt =  $price * $qt;
                                            $_price +=  $_qt;
                                ?>
                                        <li class="item odd" id="pc<?= $data2[$y]["id"] ?>"> <a href="<?= $core->getBlogUrl(array($data2[$y]["id"], $data2[$y]["name" . $clang]), "products") ?>" title="<?= $data2[$y]["name"] ?>" class="product-image"><img src="images/<?= $data2[$y]["image"] ?>" alt="<?= $data2[$y]["name" . $clang] ?>" width="65"></a>
                                            <div class="product-details"> <a href="#" onclick="addtocart('<?= $data2[$y]["id"] ?>',-1); return false;" title="<?= $data2[$y]["name" . $clang] ?>" class="remove-cart"><i class="fa fa-times"></i></a>
                                                <p class="product-name"><a href="<?= $core->getBlogUrl(array($data2[$y]["id"], $data2[$y]["name"]), "products") ?>" title="<?= $data2[$y]["name" . $clang] ?>">
                                                        <?= $data2[$y]["name" . $clang] ?>
                                                    </a> </p>
                                                <span class="number"> <?= $price ?></span> <span> <?= plang("جنية", "Pounds") ?> </span>x
                                                <span class="number"><?= $qt ?> <?= plang("الكمية", "Quantity") ?></span>
                                            </div>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                            <div class="top-subtotal"><?= plang("مجموع الحساب", "Total Account") ?> : <span class="price"> <?= $_price ?> <?= plang("جنية", "Pounds") ?></span></div>
                            <div class="actions">
                                <a class="btn-checkout" href="<?= $core->getPageUrl("cart", "?out=1") ?>" title="#"><i class="fa fa-check"></i><span><?= plang("الدفع", "Pay") ?></span></a>
                                <a class="view-cart" href="<?= $core->getPageUrl("cart") ?>" title="#"><i class="fa fa-shopping-cart"></i> <span><?= plang("عرض السلة", "View cart") ?></span></a>
                            </div>
                        </div>
                    </div> <?php } ?>
            </div>
        </div>
    </div>
    <?php $c = 0;
    if ($core->Sion("wishlist"))
        $c = $core->getBlog(array("in" => $core->Sion("wishlist")));
    if ($c)
        $c = count($c);
    ?>
    <div class="heart-area">
        <div class="custom-block"></div>
        <a href="<?= $core->getPageUrl("products", "?wishlist=1") ?>" class="mybag-link">
            <span class="shopping-heart ti ti-heart"></span><span class="heart-info"><span class="heart-qty"><?= $c ?></span></span>
        </a>
    </div>
<?php
} else if ($action == "coupon_code" && !$get) {
    $coupon_code = $core->isv("coupon_code");
    $_coupon = $core->isv("_coupon");
    $msg = plang("المعلومات المدخلة غير صحيحة", "The information entered is incorrect.");
    if ($coupon_code) {
        //$msg = plang("تم اضافة الكوبون","Coupon added")." '".$coupon_code."' ".plang("بنجاح","Successfully");
        if ($_coupon) {
            $msg = plang("تم حذف الكوبون بنجاح", "Coupon has been removed successfully");
            $core->Sion("_coupon_code", "false");
        } else {
            $sql = $core->Sel("coupons", "where coupon='" . $coupon_code . "' and active=1");
            if ($sql) {
                if ($sql->expiry_date && DateTime::createFromFormat("Y-m-d", $sql->expiry_date)->getTimestamp() < time()) {
                    echo json_encode(array("st" => "error", "msg" => plang("عذرا انتهت صلاحية الكوبون", "Sorry, coupon has expired")));
                    die();
                }
                $msg = plang("تم اضافة الكوبون", "Coupon added") . " '" . $coupon_code . "' " . ($sql->coupon_type ? plang("لمصاريف الشحن", "for shipping expenses") : plang("للطلب", "for total order price"));
                $msg .= plang(" خصم ", " discount") . " " . $sql->value . "%";
                $core->Sion("_coupon_code", $coupon_code);
            } else {
                echo json_encode(array("st" => "error", "msg" => plang("عذرا الكود المدخل غير صحيح", "Sorry, the code you entered is incorrect.")));
                die();
            }
        }
        echo json_encode(array("st" => "ok", "msg" => $msg, "rd" => "ref"));
    } else
        echo json_encode(array("st" => "error", "msg" => plang("من فضلك قم بكتابة الكود اولا", "Please write the code first.")));
} else if ($action == "login" && !$get) {
    $username = $core->isv("username");
    $email = $core->isv("email");
    $code = $core->isv("code");
    $password = $core->isv("password");
    if ($email)
        $login = $core->getlogin(array("table" => "users", "email" => $email));
    elseif ($code)
        $login = $core->getlogin(array("table" => "users", "code" => $code));
    else if ($username && $password)
        $login = $core->getlogin(array("table" => "users", "email" => $username, "password" => $password));
    if ($login) {
        if (!$email) {
            if ($code)
                $core->UpDate("users", "password", $password, "where code='" . $code . "'");
            if ($login[0]["lev"])
                $core->Sion("admin_name", $login[0]["name"]);
            $core->Sion("user_name", $login[0]["username"]);
            $core->Sion("admin_id", $login[0]["id"]);
            $core->Sion("admin_lev", $login[0]["lev"]);
            echo json_encode(array("st" => "ok", "msg" => plang("تم تسجيل الدخول بنجاح", "Sign in successfully"), "rd" => "ref"));
            //echo json_encode(array("st"=>"error","msg"=>$core->DQuery));
        } else {
            $mail->AddAddress($email);
            $rand = md5($email) . rand(3333, 9999);
            $mail->IsHTML(true);
            $mail->Subject = "استعادة كلمة المرور الخاصه بك";
            $mail->Body = "<p style='text-align: right;direction: rtl;'>كود استعادة كلمة المور  هو  :</p><br>" . $rand . "<br><p style='text-align: right;direction: rtl;'> قم بالرجوع الى الموقع مرة اخرى وادخل الكود</p>";
            if (!$mail->Send()) {
                echo json_encode(array("st" => "error", "msg2" => $core->DQuery, "msg" => "تعذر ارسال الكود من فضلك حاول مره اخرى"));
            } else
                $core->UpDate("users", "code", $rand, "where email='" . $email . "'");
            echo json_encode(array("st" => "ok", "rd" => $core->getPageUrl("login", "?forgot=true"), "msg" => plang("تم ارسال كود تعيين كلمة المرور على البريد", "password has been sent to the email")));
        }
        die();
    }
    echo json_encode(array("st" => "error", "msg2" => $core->DQuery, "msg" => plang("المعلومات المدخلة غير صحيحة", "The information entered is incorrect.")));
} else if ($action == "users" && !$get && !$core->isv("admin") && $core->isv("backuppassword")) {
    unset($_POST["mydata"]);
    $_POST["password"] = $_POST["backuppassword"];
    if ($mydata) {
        $id = $mydata;
        $core->UpDate("users", $_POST, "", "where id=" . $id);
    } else
        $id =  $core->SqlIn("users", $_POST);
    echo json_encode(array("st" => "ok", "rd" => "ref", "id" => $id, "msg" => "تم الحفظ بنجاح"));
} else if (!$get) {
    unset($_POST["mydata"]);
    unset($_POST["admin"]);
    if (isset($_POST["password"]) && $core->isv("password"))
        $_POST["backuppassword"] = $core->isv("password");
    if (isset($_POST["password"]) && !$core->isv("password"))
        unset($_POST["password"]);
    unset($_POST["confirmation"]);
    $isNull = true;
    foreach ($_POST as $k => $v)
        if ($core->isv($k))
            $isNull = false;
    if (!$isNull)
        if ($mydata) {
            $id = $mydata;
            $core->UpDate($action, $_POST, "", "where id=" . $id);
        } else
            $id =  $core->SqlIn($action, $_POST);
    if ($isNull)
        echo json_encode(array("st" => "error", "id" => $id, "msg" => "الحقول مطلوبة "));
    else if ($id)
        echo json_encode(array("st" => "ok", "id" => $id, "msg" => "تم الحفظ بنجاح"));
    else
        echo json_encode(array("st" => "error", "msg2" => $core->DQuery, "msg" => "حدث خطأ ما <br>" . $core->DBgetError()));
}  ?>