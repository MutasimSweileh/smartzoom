<? if (!isset($core)) include "../inc.php";
if (!isset($on))
    $on = $core->isv("on");
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
if ($on) {
?>
    <a href="#offcanvas-cart">
        <i class="flaticon-shopping-bag"></i>
        <span class="cart-count"><?= count($data2) ?></span>
    </a>


<? } else { ?>
    <div id="offcanvas-cart" class="offcanvas offcanvas-cart">
        <div class="inner">
            <div class="head">
                <span class="title"><?= getLang("cart") ?></span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll">
                <ul class="minicart-product-list">
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
                        <li id="pc<?= $data2[$y]["id"] ?>">
                            <a href="#" class="image"><img src="images/<?= $data2[$y]["image"] ?>" alt="Cart product Image" /></a>
                            <div class="content">
                                <a href="<?= $core->getBlogUrl(array($data2[$y]["id"], $data2[$y]["name"]), "products") ?>" class="title"><?= $data2[$y]["name" . $clang] ?></a>
                                <span class="quantity-price"><?= $qt ?> x <span class="amount"><?= plang('جنية', 'L.E') ?> <?= number_format($price) ?></span></span>
                                <a href="#" onclick="addtocart('<?= $data2[$y]["id"] ?>',-1); return false;" class="remove">×</a>
                            </div>
                        </li>
                    <? } ?>
                </ul>
            </div>
            <div class="foot">
                <div class="sub-total">
                    <strong><?= plang('المجموع الفرعى', 'Subtotal') ?> :</strong>
                    <span class="amount"><?= plang('جنية', 'L.E') ?> <?= number_format($_price) ?></span>
                </div>
                <div class="buttons">
                    <a href="<?= $core->getPageUrl("cart") ?>" class="btn btn-dark btn-hover-primary mb-30px"><?= plang('عرض سلة الشراء', 'View Cart') ?></a>
                    <a href="<?= $core->getPageUrl("cart", "?out=1") ?>" class="btn btn-outline-dark current-btn"><?= plang('الدفع', 'Check Out') ?></a>
                </div>
            </div>
        </div>
    </div>
<? } ?>