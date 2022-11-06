<?php

$pagg = 6;

include "inc.php";

$id =  isv("id");
if (!$id)
    $id =  isv("level");
$name = isv("name");

$prodpram = array();
if ($name)
    $prodpram = array("name" => $name);
if ($id)

    $prodpram = array("id" => $id);

$products = $core->getevents($prodpram);

?>



<!-- Our Latest Blog Area -->

<section class="latest-blog latest_blog_area blog-section blog-wrapper">

    <div class="container">

        <!-- Breadcrumbs -->
        <div class="block block-breadcrumbs clearfix" style="
    margin-bottom: 10px;">
            <ul>
                <li class="home">
                    <a href="<?= $core->getPageUrl("index") ?>"><?= $core->pageTitle ?></a>
                    <span></span>
                </li>
                <?php

                $loop[] = array("", $exTitle);
                if ($id)
                    $loop[] = array("", $products[0]["name" . $clang]);
                $index = 0;
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

        <div class="row latest_blog blog-grids clearfix new-sec">

            <?php

            if ($products != null)

                for ($i = 0; $i < count($products); $i++) {

                    $date = getDateTime($products[$i]["date"], $lang);

                    if (!$id) {
                        $link = $core->getBlogUrl(array($products[$i]["id"], $products[$i]["name"]), "news");

            ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="duoal">
                            <div class="blog_share_box">
                                <div class="bl_share_img">
                                    <img src="images/<?= $products[$i]["image"] ?>" alt="<?= $products[$i]["name" . $clang] ?>">
                                </div>
                                <div class="blog_share_details">
                                    <p class="blog_date"><i class="icon-clock-1"></i><span><?= $date[0] ?> <?= $date[1] ?> <?= $date[2] ?></span></p>
                                    <h1><a href="<?= $link ?>"><?= $products[$i]["name" . $clang] ?></a></h1>
                                    <a href="<?= $link ?>" class="more-sa"><?= plang("المزيد", "More") ?></a>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php } else { ?>

                    <div class="container">

                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 float-<?= plang("right", "left") ?>">
                            <img src="images/<?= $products[$i]["image"] ?>" style="width: 100%; height: auto;  max-height: 340px;" alt="SAS TRANS">
                            <div class="wpb_wrapper">
                                <p><strong><?= plang('تاريخ', 'Date') ?></strong>: <?= $date[0] ?> <?= $date[1] ?> <?= $date[2] ?></p>
                                <?= $products[$i]["description" . $clang] ?>
                                <?php if ($products[$i]["video"] != null) { ?>
                                    <p class="mt-3" style="text-align: center;">
                                        <iframe width="100%" height="100%" style="margin: auto; margin-right: 0%; border: 0px; min-height: 200px;" src="https://www.youtube.com/embed/<?

                                                                                                                                                                                        echo $products[$i]["video"];



                                                                                                                                                                                        ?>" allowfullscreen>



                                        </iframe>
                                    </p>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 float-<?= plang("right", "left") ?>">





                            <div class="vc_wp_custommenu wpb_content_element">
                                <div class="widget widget_nav_menu">
                                    <h2 class="widgettitle"><?= getTitle("news" . $plang) ?></h2>
                                    <div class="menu-our-services-container">
                                        <ul id="menu-our-services" class="menu">
                                            <?php $sproducts = $core->getevents(array("!level" => 1));  ?>
                                            <?php for ($i = 0; $i < count($sproducts); $i++) {  ?>
                                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1410"><a href="<?= $core->getblogUrl(array($sproducts[$i]['id'], $sproducts[$i]['name' . $clang]), "news") ?>"><?= $sproducts[$i]["name" . $clang] ?></a></li> <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div style="clear: both; display: block;"></div>

                        <?php

                        if ($pagg == 3) {

                            $videospaaaarm = array("product_id" => $products[0]["id"]);

                            $videos = $core->getproducts_images($videospaaaarm);
                        } else if ($pagg == 6) {

                            $videospaaaarm = array("event_id" => $products[0]["id"]);

                            $videos = $core->geteventimages($videospaaaarm);
                        } else {

                            $videospaaaarm = array("services_id" => $products[0]["id"]);

                            $videos = $core->getservices_images($videospaaaarm);
                        }

                        if ($videos) {

                        ?>

                            <div class="clear"></div>

                            <div class="row" style="text-align: center;">

                                <div class="tittle wow2 fadeInUp" style=" margin-bottom: 60px; ">

                                    <h2><?= getTitle("gallery" . $plang) ?></h2>



                                </div>

                                <div class="productSlider">






                                    <div class="clear"></div>
                                    <div class="row" style="text-align: center;">
                                        <div class="tittle wow2 fadeInUp" style="display: block;">
                                            <h2><?= getTitle("gallery" . $plang) ?></h2>

                                        </div>
                                        <?php
                                        for ($i = 0; $i < count($videos); $i++) { ?>
                                            <div class="col-md-2 col-sm-6 galley">
                                                <a href="images/<?= $videos[$i]["image"] ?>" class="image-popup-vertical-fit" data-lightbox="example-set" title="<?= $products[$i]["name" . $clang] ?>" data-rel="prettyPhoto[gallery]"><img src="images/<?= $videos[$i]["image"] ?>" alt="<?= $products[0]["name" . $clang] ?>"></a>
                                            </div>

                                        <?php } ?>
                                    </div>






                                </div>

                            </div>

                        <?php } ?>

                    </div>





            <?php }
                } ?>



        </div>

    </div>

</section>

<!-- End Our Latest Blog Area -->



<?php

include "inc/footer.php";

?>