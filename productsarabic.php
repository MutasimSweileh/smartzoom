<?php
$pagg = 2;
include "inc.php";
$id = isv("id");
$oid = isv("oid");
if (!$id)
    $id = isv("level");
if ($id)
    $ar = array("id" => $id);
else
    $ar = [];
if ($_key == "q")
    $ar['name'] = isv($_key);
else if ($_key == "wishlist")
    $ar['in'] = $core->Sion("wishlist");
else  if ($_key == "myorders") {
    if (!$_Login) {
        $msg = plang("قم بتسجيل الدخول اولا حتى تتمكن من المتابعه او قم بتسجيل حساب جديد .", "Log in first to be able to continue or register a new account.");
        header("Location: " . $core->getPageUrl("login", "?msg=" . base64_encode($msg) . "&er=1" . ($_affiliate ? "&affiliate=1" : ""), true));
        die();
    }
    if ($_affiliate && $_Login["coupon_code"]) {
        $ar["coupon_code"] = $_Login["coupon_code"];
    } else {
        $myorders = isv("myorders");
        if ($myorders == "true")
            $myorders = $_Login["id"];
        $ar["user_id"] = $myorders;
    }
    if ($oid)
        $ar["id"] = $oid;
    $myorders = $core->getorder($ar);
    $order_ar = [];
    $_order_products = [];
    $_wight = "";
    foreach ($myorders as $v) {
        $o_wight = $v["shipping_price"];
        $order_products = $core->getData("order_products", "where order_id=" . $v["id"]);
        foreach ($order_products as $o) {
            $o["date"] = $v["date"];
            $o["done"] = $v["done"];
            $_order_products[] =  $o;
            $order_ar[] = $o["product_id"];
        }
    }
    $ar['in'] = join(",", $order_ar);
} else if ($_key)
    $ar['where'] = getKey(true);
$data = $core->getBlog($ar);
/*
$lang : get form  inc.php  = arabic || english;
$plang : get form  inc.php for  php file name  = arabic || "";
$clang : get form  inc.php for column name  =  _arabic || "" ;
*/
function getSubCat($id)
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
$loop = [];
if (!$_affiliate)
    $loop[] = array($core->getPageUrl("products"), getTitle("products"));
if ($id) {
    $company = $core->getcompanies(array("id" => $data[0]["company"]))[0];
    $cat = $core->getCat(array("id" => $data[0]["level"]))[0];
    $loop[] = array($core->getPageUrl("products", "?company=" . $company["id"]), $company["name" . $clang]);
    //$loop[] = array($core->getPageUrl("products","?cat=".$cat["id"]),$cat["name"]);
    $loop = getSubCat($cat["id"]);
    $loop[] = array("", $data[0]["name" . $clang]);
}
if ($_key) {
    if ($_key == "level") {
        $cat = $core->getCat(array("id" => isv("cat")))[0];
        $loop = getSubCat($cat["id"]);
    } else if ($_key == "company") {
        $company = $core->getcompanies(array("id" => isv($_key)))[0];
        $loop[] = array($core->getPageUrl("companies"), getTitle("companies"));
        $loop[] = array($core->getPageUrl("products", "?company=" . $company["id"]), $company["name" . $clang]);
    } else if ($_key == "q") {
        $loop[] = array("", plang("نتيجة البحث عن", "Search result for") . " : " . isv($_key));
    } else if ($oid) {
        $loop[] = array($core->getPageUrl("orders", ($_affiliate ? "?affiliate=1" : "")), $exTitle);
        $loop[] = array("", plang("الطلب", "Order") . " #" . $oid);
    } else {
        $loop[] = array("", $exTitle);
    }
}
$msg = "";
if ($_Login["vip"] >= getValue("vip")) {
    $msg = base64_encode(getValue("vip_txt", $lang));
}
?>
<div id="pageContent">
    <div class="container" style=" padding-bottom: 30px;">
        <div class="col-xs-12 col-sm-12 col-md-12" id="content">
            <div class="row">
                <div id="notification"></div>
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
                <?php if ($_key == "myorders") {
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
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="cart-table-wrap">
                            <form action="" method="post">
                                <?php if ($msg) {  ?>
                                    <div class="alert alert-success justify-content-center" role="alert"><?= base64_decode($msg) ?></div>
                                    <?php }
                                if (!$_order_products) {
                                    alert($_key);
                                } else {
                                    if (!$oid) {
                                    ?>
                                        <fieldset>
                                            <table id="shopping-cart-table" class="data-table cart-table">
                                                <thead>
                                                    <tr class="first last">
                                                        <th rowspan="1"><?= plang("رقم الطلب", "Order number") ?></th>
                                                        <th rowspan="1"><?= plang("تاريخ الشراء", "Date of purchase") ?></th>
                                                        <th class="last" colspan="1"><?= plang("السعر", "Price") ?></th>
                                                        <th class="last" colspan="1"><?= plang("الحالة", "Status") ?></th>
                                                        <th class="last" colspan="1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $data2 = $myorders;
                                                    if ($data2) {
                                                        $_price = 0;
                                                        $_wight = 0;
                                                        $_qt = 0;
                                                        // $g_wight = getValue("wight");
                                                        if ($data2)
                                                            for ($y = 0; $y < count($data2); $y++) {
                                                                if (!$data2[$y]["active"])
                                                                    continue;
                                                                $price   = $data2[$y]["total"];
                                                                $wight = $data2[$y]["wight"];
                                                                $_price +=  $price;
                                                                $_wight += ($wight * $g_wight);
                                                                //    $_wight += $data2[$y]["shipping_price"];
                                                    ?>
                                                            <tr class="first last odd" id="pc2<?= $data2[$y]["id"] ?>">
                                                                <td class="pr-img-td"><?= $data2[$y]["id"] ?></td>
                                                                <td class="action-td"><?= $core->cptime($data2[$y]["date"]) ?></td>
                                                                <td class="td-total last">
                                                                    <span class="cart-price">
                                                                        <span class="price"><?= $price ?>&nbsp;<?= plang("جنية", "Pounds") ?></span>
                                                                    </span>
                                                                </td>
                                                                <td class="td-total last">
                                                                    <span class="cart-price<?= !$data2[$y]["done"] ?>">
                                                                        <span class="price"><?= ($data2[$y]["done"] ? plang("تم التسليم", "Delivery was done") : plang("فى انتظار التسليم", "Waiting for delivery")) ?></span>
                                                                    </span>
                                                                </td>
                                                                <td class="td-total last">
                                                                    <a href="<?= $core->getPageUrl("orders", "?oid=" . $data2[$y]["id"] . ($_affiliate ? "&affiliate=1" : "")) ?>"><?= plang("عرض المنتجات", "View products") ?></a>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="first last">
                                                        <td colspan="50" class="a-right last" style="text-align: left;">
                                                            <span class="cart-price">
                                                                <span class="price"><?= plang("مجموع الحساب", "Total Account") ?> : <?= $_price ?>&nbsp;<?= plang("جنية", "Pounds") ?></span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </fieldset>
                                    <?php } else { ?>
                                        <fieldset>
                                            <table id="shopping-cart-table" class="data-table cart-table">
                                                <thead>
                                                    <tr class="first last">
                                                        <th rowspan="1">&nbsp;</th>
                                                        <th rowspan="1"><?= plang("تاريخ الشراء", "Date of purchase") ?></th>
                                                        <th rowspan="1"><span class="nobr"><?= plang("اسم المنتج", "Product name") ?></span></th>
                                                        <th rowspan="1"><?= plang("الكمية", "Quantity") ?></th>
                                                        <th class="last" colspan="1"><?= plang("السعر", "Price") ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $data2 = $_order_products;
                                                    if ($_order_products) {
                                                        $_price = 0;
                                                        $_wight = 0;
                                                        $_qt = 0;
                                                        //$g_wight = getValue("wight");
                                                        $_wight = $core->getData("order", "where id=" . isv("oid"))[0]["shipping_price"];
                                                        if ($data2)
                                                            for ($y = 0; $y < count($data2); $y++) {
                                                                if (!$data2[$y]["active"])
                                                                    continue;
                                                                $data = $core->getBlog(array("id" => $data2[$y]["product_id"]))[0];
                                                                $data2[$y]["name"] = $data["name" . $clang];
                                                                $data2[$y]["image"] = $data["image"];
                                                                $wight = $data["wight"];
                                                                $data2[$y]["id"] = $data["id"];
                                                                $price   = $data2[$y]["price"];
                                                                $qt = $data2[$y]["quantity"];
                                                                $_price +=  $price;
                                                                // $_wight += ($wight * $g_wight);
                                                    ?>
                                                            <tr class="first last odd" id="pc2<?= $data2[$y]["id"] ?>">
                                                                <td class="pr-img-td"><a href="<?= $core->getBlogUrl(array($data2[$y]["id"], $data2[$y]["name"]), "products") ?>" title="<?= $data2[$y]["name"] ?>" class="product-image"><img src="images/<?= $data2[$y]["image"] ?>" width="80" height="80" alt="<?= $data2[$y]["name"] ?>"></a></td>
                                                                <td class="action-td"><?= $core->cptime($data2[$y]["date"]) ?></td>
                                                                <td class="product-name-td">
                                                                    <h2 class="product-name">
                                                                        <a href="<?= $core->getBlogUrl(array($data2[$y]["id"], $data2[$y]["name"]), "products") ?>"><?= $data2[$y]["name"] ?></a>
                                                                    </h2>
                                                                </td>
                                                                <td>
                                                                    <div class="qty-holder">
                                                                        <input name="qty[]" style="border: none;" value="<?= $qt ?>" disabled="disabled" size="3" title="<?= plang("الكمية", "Quantity") ?>" class="input-text qty" maxlength="12" id="qty<?= $data2[$y]["id"] ?>">
                                                                    </div>
                                                                </td>
                                                                <td class="td-total last">
                                                                    <span class="cart-price">
                                                                        <span class="price"><?= $price ?>&nbsp;<?= plang("جنية", "Pounds") ?></span>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="first last">
                                                        <td colspan="50" class="a-right last" style="text-align: left;">
                                                            <span class="cart-price">
                                                                <span class="price"><?= plang("مجموع الحساب", "Total Account") ?> : <?= $_price ?>&nbsp;<?= plang("جنية", "Pounds") ?> + <?= plang("مصاريف الشحن", "Shipping expenses") ?> : <?= $_wight ?> &nbsp;<?= plang("جنية", "Pounds") ?> = <?= ($_price + $_wight) ?>&nbsp;<?= plang("جنية", "Pounds") ?></span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </fieldset> <?php }
                                            } ?>
                            </form>
                        </div>
                    </div>
                <?php
                } else if ($_key || !$id && !$_key) {  ?>
                    <style type="text/css">
                        .block.block-breadcrumbs.clearfix {
                            margin-bottom: 15px;
                            margin-top: 5px;
                        }

                        .alert.alert-danger.justify-content-center {
                            text-align: center;
                        }
                    </style>
                    <div class="filter-products">
                        <div class="products">
                            <?php
                            if (!$data) {
                                alert($_key);
                            } else
                                for ($y = 0; $y < count($data); $y++) {
                                    if (!$data[$y]["id"]) continue;
                                    $i = $y;
                                    $cat = $core->getData("categories", "where id=" . $data[$i]["level"])[0];
                                    $price = $data[$i]["price"];
                                    $expiry_date = expiry_date($data[$y], "stock", true);
                            ?>
                                <div class="col-lg-3 col-md-12" id="p<?= $data[$y]["id"] ?><?= ($_key == "wishlist" ? "" : "no") ?>">
                                    <div class="it-com">
                                        <div class="flash-sale-item">
                                            <div class="fs-thumb">
                                                <? if ($data[$i]["deal"]) { ?>
                                                    <span class="sale"><?= plang('تخفيض', 'sale') ?></span>
                                                <? } else { ?>
                                                    <span class="new"><?= plang('جديد', 'New') ?></span>
                                                <? } ?>
                                                <a href="<?= $core->getBlogUrl(array($data[$i]["id"], $data[$i]["name" . $clang]), "products") ?>"><img src="images/<?= $data[$i]["image"] ?>" alt="img" /></a>
                                            </div>
                                            <div class="fs-content">
                                                <a href="#" class="tag"><?= $cat["name" . $clang] ?></a>
                                                <h4 class="title"><a href="<?= $core->getBlogUrl(array($data[$i]["id"], $data[$i]["name" . $clang]), "products") ?>"><?= $data[$i]["name" . $clang] ?></a></h4>
                                                <div class="rating">

                                                    <? $variable = $data[$i]["rating"];
                                                    for ($iy = 0; $iy < $variable; $iy++) {
                                                        # code...
                                                    ?>
                                                        <i class="fa fa-star"></i>
                                                    <? } ?>

                                                </div>

                                                <div class="content-bottom">
                                                    <?php $price = $data[$i]["price"];
                                                    if ($data[$i]["discount"] &&  !$expiry_date[0]) { ?>

                                                    <?php $price = $data[$i]["discount"];
                                                    } ?>
                                                    <h4 class="price"><?= plang("جنية", "L.E") ?> <?= $price ?></h4>
                                                </div>
                                                <div class="add-to-link">
                                                    <ul>
                                                        <li class="cart">
                                                            <a title="Add to cart" href="#" class="add_to_wishlist wishlist <?= expiry_date($data[$i]) ?> <?= $data[$i]["stock"] ? "" : "stock" ?> addtocart<?= $data[$i]["id"] ?>" onclick="addtocart('<?= $data[$i]["id"] ?>'); return false;" data-id="<?= $data[$i]["id"] ?>"><i class="flaticon-shopping-bag"></i></a>
                                                        </li>
                                                        <li>
                                                            <a title="Add to wishlist" href="#" class="add_to_wishlist wishlist <?= iswish($data[$i]["id"]) ?>" onclick="addToWishList(this,'<?= $data[$i]["id"] ?>'); return false;" data-id="<?= $data[$i]["id"] ?>"><i class="fal fa-heart"></i></a>
                                                        </li>
                                                        <li>
                                                            <a title="view" href="images/<?= $data[$i]["image"] ?>" class="lightbox-image" data-fancybox="gallery"><i class="fal fa-search"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else {
                    $expiry_date = expiry_date($data[0], "stock", true); ?>
                    <div class="row">
                        <div class="product-big-image col-xs-12 col-sm-4 col-lg-4 col-md-4 product-images">
                            <div class="large-image"> <a href="images/<?= $data[0]["image"] ?>" title="Optimax Inverter" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20" style="position: relative; display: block;"> <img class="zoom-img" src="images/<?= $data[0]["image"] ?>" alt="Loreal" style="display: block; visibility: visible;"> </a> </div>
                            <?php $images = $core->getproductimages(array("product" => $id));
                            if ($images) { ?>
                                <div class="flexslider flexslider-thumb">
                                    <ul class="previews-list slides">
                                        <?php foreach ($images as $img) { ?>
                                            <li style="max-width: 160px;"><a href="images/<?= $img["image"] ?>" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: 'images/<?= $img["image"] ?>' "><img style="height: 100px; width: 130px;" src="images/<?= $img["image"] ?>" alt="Loreal"></a></li>
                                        <?php } ?>
                                    </ul>
                                </div><?php } ?>
                        </div>
                        <div class="col-sm-8 col-xs-12">
                            <div class="block-product-info">
                                <h2 class="product-name">
                                    <?= $data[0]["name" . $clang] ?>
                                </h2>
                                <div class="price-box product-price" style="margin-bottom: 10px;">
                                    <?php $price = $data[0]["price"];
                                    if ($data[0]["discount"] && !$expiry_date[0]) { ?>
                                        <p class="old-price">
                                            <span class="price" id="old-price-9698">
                                                <?= $price ?> &nbsp;<?= plang("جنية", "Pounds") ?> </span>
                                        </p><?php $price = $data[0]["discount"];
                                        } ?>
                                    <ins><span class="product-price price_display"> <?= $price ?> <?= plang("جنية", "Pounds") ?> </span></ins>
                                    <br />
                                </div>
                                <div class="product-info-stock-sku">
                                    <div class="stock available">
                                        <?php if ($data[0]["stock"]) { ?>
                                            <span class=" label label-success">
                                                <?= plang("حالة المنتج : متوفر", "Product Status: Available") ?>
                                            </span> <?php } else { ?>
                                            <span class=" label label-danger">
                                                <?= plang("حالة المنتج : غير متوفر ", "Product Status: Not available") ?>
                                            </span>
                                        <?php } ?>
                                        <?php if ($data[0]["expiry_date"] && $data[0]["deal"] && !$expiry_date[0]) { ?>
                                            <span class=" label label-warning">
                                                <?= plang("تاريخ الانتهاء", "Expiry date") ?> : <?= $data[0]["expiry_date"] ?>
                                            </span> <?php } ?>
                                    </div>
                                </div>
                                <div class="desc">
                                    <?= $data[0]["description" . $clang] ?>
                                </div>
                                <div class="product-add-form variations-box">
                                    <table class="variations-table">
                                        <tr>
                                            <?php if ($data[0]["stock"]) {  ?>
                                                <td class="table-label"> <?= plang("الكمية", "Quantity") ?>: </td> <?php } ?>
                                            <td class="table-value">
                                                <?php if ($data[0]["stock"]) {  ?>
                                                    <div class="box-qty">
                                                        <a class="quantity-minus" onclick="addtocart('<?= $data[0]["id"] ?>',-2);">-</a>
                                                        <input type="text" class="form-control qty qty-val input-qty quantity" name="quantity" id="qty<?= $data[0]["id"] ?>" name="qty" value="1" maxlength="12" minlength="1" min="1">
                                                        <a class="quantity-plus" onclick="addtocart('<?= $data[0]["id"] ?>',-3);">+</a>
                                                    </div>
                                                    <button type="button" onclick="addtocart('<?= $data[0]["id"] ?>',$('#qty<?= $data[0]["id"] ?>').val()); return false;" class="button-radius btn-add-cart action btn-cart <?= expiry_date($data[0]) ?> addtocart<?= $data[0]["id"] ?>" id="button-cart"><?= plang("اضف للعربة", "Add to cart") ?>
                                                        <span class="icon"></span>
                                                    </button>
                                                <?php } ?>
                                                <div class="product-extra-link">
                                                    <a href="#" class="wishlist-link" onclick="addToWishList(this,'<?= $data[0]["id"] ?>',$('#qty<?= $data[0]["id"] ?>').val()); return false;"><span>إضافة لرغباتي</span></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- sales booster -->
                                    <!-- end sales booster -->
                                </div>
                                <div class="social2" style="display: flex;    margin-top: 20px;">
                                    <p style="   
    margin-bottom: 0;
    margin-top: 4px;
  margin-<?= plang("left", "right") ?>: 10px;"><?= plang('شارك :', 'Share :') ?></p>
                                    <div class="sharethis-inline-share-buttons"></div>
                                </div>
                            </div>
                        </div>

                        <? include "inc/reviews.php";  ?>

                        <div class="col-lg-12 col-xs-12" style="margin-top: 35px;">
                            <div class="title1"><?= getTitle("best") ?></div>
                            <div class="owl-carousel owl-carousel-normal2 cuctom-nav2 special-slider5" data-ride="carousel">
                                <?php
                                $data = $core->getData("products", "where active=1 and best=1");
                                // print_r($data);
                                if ($data)
                                    for ($i = 0; $i < count($data); $i++) {
                                        //echo $data[$i]["name" . $clang];
                                        //const
                                        $cat = $core->getData("categories", "where id=" . $data[$i]["level"])[0];
                                        $price = $data[$i]["price"];
                                ?>
                                    <div class="item">
                                        <div class="it-com">
                                            <div class="flash-sale-item">
                                                <div class="fs-thumb">
                                                    <? if ($data[$i]["deal"]) { ?>
                                                        <span class="sale"><?= plang('تخفيض', 'sale') ?></span>
                                                    <? } else { ?>
                                                        <span class="new"><?= plang('جديد', 'New') ?></span>
                                                    <? } ?>
                                                    <a href="<?= $core->getBlogUrl(array($data[$i]["id"], $data[$i]["name" . $clang]), "products") ?>"><img src="images/<?= $data[$i]["image"] ?>" alt="img" /></a>
                                                </div>
                                                <div class="fs-content">
                                                    <a href="#" class="tag"><?= $cat["name" . $clang] ?></a>
                                                    <h4 class="title"><a href="<?= $core->getBlogUrl(array($data[$i]["id"], $data[$i]["name" . $clang]), "products") ?>"><?= $data[$i]["name" . $clang] ?></a></h4>
                                                    <div class="rating">

                                                        <? $variable = $data[$i]["rating"];
                                                        for ($iy = 0; $iy < $variable; $iy++) {
                                                            # code...
                                                        ?>
                                                            <i class="fa fa-star"></i>
                                                        <? } ?>

                                                    </div>

                                                    <div class="content-bottom">
                                                        <?php $price = $data[$i]["price"];
                                                        if ($data[$i]["discount"] &&  !$expiry_date[0]) { ?>

                                                        <?php $price = $data[$i]["discount"];
                                                        } ?>
                                                        <h4 class="price"><?= plang("جنية", "L.E") ?> <?= $price ?></h4>
                                                    </div>
                                                    <div class="add-to-link">
                                                        <ul>
                                                            <li class="cart">
                                                                <a title="Add to cart" href="#" class="add_to_wishlist wishlist <?= expiry_date($data[$i]) ?> <?= $data[$i]["stock"] ? "" : "stock" ?> addtocart<?= $data[$i]["id"] ?>" onclick="addtocart('<?= $data[$i]["id"] ?>'); return false;" data-id="<?= $data[$i]["id"] ?>"><i class="flaticon-shopping-bag"></i></a>
                                                            </li>
                                                            <li>
                                                                <a title="Add to wishlist" href="#" class="add_to_wishlist wishlist <?= iswish($data[$i]["id"]) ?>" onclick="addToWishList(this,'<?= $data[$i]["id"] ?>'); return false;" data-id="<?= $data[$i]["id"] ?>"><i class="fal fa-heart"></i></a>
                                                            </li>
                                                            <li>
                                                                <a title="view" href="images/<?= $data[$i]["image"] ?>" class="lightbox-image" data-fancybox="gallery"><i class="fal fa-search"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <? }
                                ?>
                            </div>
                            <? if ($ads && count($ads) > 1) { ?>
                                <div class="banner banner1"><a href="<?= $ads[1]["link"] ?>"><img src="images/<?= $ads[1]["image"] ?>" alt="" class="img-responsive"></a></div>
                        </div>
                <?php }
                        } ?>
                    </div>
            </div>
        </div>
    </div>
    <!-- Add2Any -->
    <script async src="https://static.addtoany.com/menu/page.js"></script>
    <script type="text/javascript" src="js/easyzoom.js"></script>
</div>
<div class="col-xs-12 col-sm-4 col-md-3 rtl-left">
</div>
</div>
</div>
<?php
include "inc/footer.php";
?>