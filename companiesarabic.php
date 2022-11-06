<?php
$pagg = 2;
include "inc.php";
$loop[] = array("", $exTitle);
?>
<style type="text/css">
    .block.block-breadcrumbs.clearfix {
        margin-bottom: 15px;
    }

    .services-block-two.col-md-12.col-lg-3.smollblockproduct {
        margin-bottom: 15px;
    }
</style>
<div class="container">
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
</div>
<div class="abt-first">
    <div class="container">
        <?php $companies = $core->getcompanies(array());
        foreach ($companies as $company) {
        ?>
            <div class="services-block-two col-md-12 col-lg-3 smollblockproduct">
                <div class="inner-box " style="border: 1px solid #E7E7E7;text-align: center;">
                    <div class="imagee" style="height: 140px;

display: grid;

align-items: center;">
                        <a href="<?= $core->getPageUrl("products", "?company=" . $company["id"]) ?>"><img src="images/<?= $company["image"] ?>" style="max-height: 110px; padding: 10px;" alt="<?= $company["name" . $clang] ?>"></a>
                    </div>
                    <div class="prod-0 lower-content text-center" style="background-color: #f5f5f5; padding: 9px 20px 10px;
border: 1px solid #EEE;
font-weight: lighter;">
                        <a style="font-weight: lighter;" href="<?= $core->getPageUrl("products", "?company=" . $company["id"]) ?>"><?= $company["name" . $clang] ?></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php
include "inc/footer.php";
?>
