<section class="co-area">
        <div class="container">
                <div class="row">

                        <div class="col-md-3 col-12 hidden-xs">
                        </div>

                        <div class="col-md-9 col-12 padd-left-none">


                                <div class="slider_area banner-carousel owl-carousel">


                                        <?php
                                        $data = $core->getslider(array());
                                        if ($data)
                                                for ($i = 0; $i < count($data); $i++) {
                                        ?>

                                                <div class="single_slider" style="background:url(images/<?= $data[$i]["image"] ?>)">
                                                        <div class="slider_content">
                                                                <h2><?= $data[$i]["name" . $clang] ?></h2>

                                                                <h1><?= $data[$i]["description" . $clang] ?></h1>

                                                                <a class="btn" href="<?= $data[$i]["link"] ?>"><?= plang('اطلب الان', 'Order Now') ?></a>

                                                        </div>

                                                </div>
                                        <? } ?>






                                </div>



                        </div>
                </div>
        </div>
</section>