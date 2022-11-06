<? if (!isset($core)) include "../inc.php";
$cartlist = $core->Sion("cartlist");
$data2 = array();
if ($cartlist)
    $data2 = $core->getBlog(array("in" => $cartlist));
$_price = 0;
$_qt = 0;
for ($y = 0; $y < count($data2); $y++) {
    $price = $data2[$y]["price"];
    $qt = qty($data2[$y]["id"]);
    if ($data2[$y]["discount"])
        $price = $data2[$y]["discount"];
    $_qt =  $price * $qt;
    $_price +=  $_qt;
}
?>
<div class="my_cart_wrapper">
    <div class="my_cart_button">
        <a href="javascript:void(0)">
            <span class="my_cart_icon"><i class="fal fa-shopping-bag"></i><span><?= count($data2) ?></span></span>
            <span class="txt1"><?= getLang("cart") ?></span>
            <span class="txt2"><?= count($data2) ?> <?= plang('عنصر', 'item(s)') ?> - <span><?= plang('جنية', 'L.E') ?> <?= number_format($_price) ?></span></span>
        </a>
    </div>
    <div class="my_cart_popup">
        <?php if (!$cartlist) {   ?>
            <p class="cart-empty">
                <?= plang(' لا توجد لديك منتجات في عربة التسوق', "You have no products in your cart") ?> </p>
        <?php } else { ?>
            <?php
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
                    getValue("new" . $plang)            ?>
                <div class="my_cart_item clearfix" id="pc<?= $data2[$y]["id"] ?>">
                    <a href="#" onclick="addtocart('<?= $data2[$y]["id"] ?>',-1); return false;" class="my_cart_item_close"><i class="fa fa-times"></i></a>
                    <figure>
                        <img src="images/<?= $data2[$y]["image"] ?>" alt="" class="img-responsive">
                    </figure>
                    <div class="caption">
                        <div class="txt1">
                            <a href="<?= $core->getBlogUrl(array($data2[$y]["id"], $data2[$y]["name"]), "products") ?>" title="<?= $data2[$y]["name"] ?>"><?= $data2[$y]["name" . $clang] ?></a>
                        </div>
                        <div class="txt2"><?= $qt ?> x <?= plang('جنية', 'L.E') ?> <?= number_format($price) ?></div>
                    </div>
                </div>
            <? } ?>
            <div class="my_cart_subtotal clearfix">
                <div class="left"><?= plang('المجموع الفرعى', 'Subtotal') ?> </div>
                <div class="right"> <?= plang('جنية', 'L.E') ?> <?= number_format($_price) ?></div>
            </div>
            <a href="<?= $core->getPageUrl("cart") ?>" class="my_cart_view_cart"><?= plang('عرض سلة الشراء', 'View Cart') ?></a>
            <a href="<?= $core->getPageUrl("cart", "?out=1") ?>" class="my_cart_check_out"><?= plang('الدفع', 'Check Out') ?></a>
        <? } ?>
    </div>
</div>