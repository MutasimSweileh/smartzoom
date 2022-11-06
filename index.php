<?php
$pagg = 1;
include "inc.php";
/*
$lang : get form  inc.php  = arabic || english;
$plang : get form  inc.php for  php file name  = arabic || "";
$clang : get form  inc.php for column name  =  _arabic || "" ;
*/
?>
<section class="shipping_area">
    <div class="container">


        <div class="shipping_inner">

            <? $variable = $core->getData('about_item', 'where active=1');
            foreach ($variable as $k => $v) { ?>
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="images/<?= $v["image"] ?>" alt="<?= $v["title" . $clang] ?>">
                    </div>
                    <div class="shipping_content">
                        <h2><?= $v["title" . $clang] ?></h2>
                        <p><?= $v["text" . $clang] ?></p>
                    </div>
                </div>
            <? } ?>


        </div>
    </div>
</section>


<!-- release-area -->
<section class="release-product-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="flash-sale-product mb-20">
                    <h2 class="title"><span><?= plang('منتجات جديده', 'New Products!') ?></span></h2>
                    <div class="owl-carousel special-slider custom-nav">
                        <?php
                        $data = $core->getData("products", "where active=1 and new=1");
                        if ($data)
                            for ($i = 0; $i < count($data); $i++) {
                                $expiry_date = expiry_date($data[$i], "stock", true);
                                $cat = $core->getData("categories", "where id=" . $data[$i]["level"])[0];
                                $price = $data[$i]["price"];
                        ?>
                            <div class="it-com">
                                <div class="flash-sale-item">
                                    <div class="fs-thumb">
                                        <a href="<?= $core->getBlogUrl(array($data[$i]["id"], $data[$i]["name" . $clang]), "products") ?>"><img src="images/<?= $data[$i]["image"] ?>" alt="img" /></a>
                                        <? if ($data[$i]["deal"]) { ?>
                                            <span class="sale"><?= plang('تخفيض', 'sale') ?></span>
                                        <? } else { ?>
                                            <span class="new"><?= plang('جديد', 'New') ?></span>
                                        <? } ?>
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
                        <?  } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="flash-sale-product appliance-product mb-20">
                    <h2 class="title"><span><?= plang('منتجات خاصة', 'Special Products') ?></span></h2>
                    <div class="owl-carousel special-slider custom-nav">
                        <?php
                        $data = $core->getData("products", "where active=1 and special=1");
                        if ($data)
                            for ($i = 0; $i < count($data); $i++) {
                                $expiry_date = expiry_date($data[$i], "stock", true);
                                $cat = $core->getData("categories", "where id=" . $data[$i]["level"])[0];
                                $price = $data[$i]["price"];
                        ?>
                            <div class="it-com">
                                <div class="flash-sale-item">
                                    <div class="fs-thumb">
                                        <a href="<?= $core->getBlogUrl(array($data[$i]["id"], $data[$i]["name" . $clang]), "products") ?>"><img src="images/<?= $data[$i]["image"] ?>" alt="img" /></a>
                                        <? if ($data[$i]["deal"]) { ?>
                                            <span class="sale"><?= plang('تخفيض', 'sale') ?></span>
                                        <? } else { ?>
                                            <span class="new"><?= plang('جديد', 'New') ?></span>
                                        <? } ?>
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
                                    <? if ($data[$i]["deal"]) { ?>
                                        <div class="coming-time" data-countdown="<?= $data[$i]["expiry_date"] ?>"></div>
                                    <? } ?>
                                </div>
                            </div>
                        <?  } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- release-area-ens -->

<section class="features-area-three">
    <div class="container">
        <div class="row justify-content-center">

            <? $ads = $core->getData("ads", "where active=1 and selection =1 ");
            foreach ($ads as $k => $v) { ?>
                <div class="col-md-6 col-12">
                    <div class="features-item">
                        <a href="<?= $v["link"] ?>" target="_blank" rel="noopener noreferrer">
                            <div class="features-thumb">
                                <img src="images/<?= $v["image"] ?>" alt="" />
                            </div>
                        </a>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</section>
<!-- arrivals-product-area -->
<section class="arrivals-product-area">
    <div class="container">
        <div class="row custom justify-content-center">
            <div class="col-md-3 col-xs-12">
                <div class="section-title white-text">
                    <h2 class="title"><?= plang('عروض يومية', 'Daily Deals') ?></h2>
                </div>

                <div class="arrivals-item-wrap daily">
                    <div class="owl-carousel one-slider nay-nav">

                        <?php
                        $data = $core->getData("products", "where active=1 and deal=1");
                        if ($data)
                            for ($i = 0; $i < count($data); $i++) {
                                $expiry_date = expiry_date($data[$i], "stock", true);
                                $cat = $core->getData("categories", "where id=" . $data[$i]["level"])[0];
                                $price = $data[$i]["price"];
                        ?>
                            <div class="it-com">
                                <div class="flash-sale-item">
                                    <div class="fs-thumb">
                                        <a href="<?= $core->getBlogUrl(array($data[$i]["id"], $data[$i]["name" . $clang]), "products") ?>"><img src="images/<?= $data[$i]["image"] ?>" alt="img" /></a>
                                        <? if ($data[$i]["deal"]) { ?>
                                            <span class="sale"><?= plang('تخفيض', 'sale') ?></span>
                                        <? } else { ?>
                                            <span class="new"><?= plang('جديد', 'New') ?></span>
                                        <? } ?>
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
                                    <div class="coming-time" data-countdown="<?= $data[$i]["expiry_date"] ?>"></div>
                                </div>
                            </div>
                        <?  } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-xs-12">
                <div class="section-title">
                    <h2 class="title"><?= getTitle("products" . $plang) ?></h2>
                </div>

                <div class="arrivals-item-wrap last-iti">
                    <div class="owl-carousel arrive-slider nay-nav">
                        <?php
                        $data = $core->getData("products", "where active=1");
                        if ($data)
                            for ($i = 0; $i < count($data); $i++) {
                                $expiry_date = expiry_date($data[$i], "stock", true);
                                $cat = $core->getData("categories", "where id=" . $data[$i]["level"])[0];
                                $price = $data[$i]["price"];
                        ?>

                            <div class="it-com">
                                <div class="flash-sale-item">
                                    <div class="fs-thumb">
                                        <a href="<?= $core->getBlogUrl(array($data[$i]["id"], $data[$i]["name" . $clang]), "products") ?>"><img src="images/<?= $data[$i]["image"] ?>" alt="img" /></a>
                                        <? if ($data[$i]["deal"]) { ?>
                                            <span class="sale"><?= plang('تخفيض', 'sale') ?></span>
                                        <? } else { ?>
                                            <span class="new"><?= plang('جديد', 'New') ?></span>
                                        <? } ?>
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
                        <? } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- brand-area -->
<div class="brand-area">
    <div class="container">
        <div class="section-title">
            <h2 class="title"><?= plang('علاماتنا التجارية', 'Our Brands') ?></h2>
        </div>

        <div class="owl-carousel brand-slider nay-nav">
            <? $variable = $core->getData('companies', 'where active=1');
            foreach ($variable as $k => $v) { ?>
                <div class="brand-item">
                    <img src="images/<?= $v["image"] ?>" alt="img" />
                </div>
            <?  } ?>
        </div>
    </div>
</div>
<!-- brand-area-end -->

<?php
include "inc/footer.php";
?>