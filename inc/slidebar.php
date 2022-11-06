<div class="col-md-3 col-xs-12 lazy" data-loader="customLoaderName">
  <div class="col2-xs-12">
    <h2 class="comp_1_header sna_section_title_1"> <a href="#" class="sna_section_title_1_text" title=""> إعلانات </a> </h2>
    <div class="owl-carousel ads-carousel lazy" data-loader="customLoaderName">
      <?php
      $data = $core->getAds(array("selection" => 2));
      if ($data)
        for ($i = 0; $i < count($data); $i++) {
      ?>
        <div class="relase">
          <a href="<?= $data[$i]["link"] ?>"><img src="images/<?= $data[$i]["image"] ?>" alt="" /></a>
        </div>
      <?php } ?>
    </div>
  </div>
  <?php
  if (strpos($pname, "video") !== false) {
  ?>
    <div class="col2-md-3 col2-xs-12">
      <h2 class="comp_1_header sna_section_title_1"> <a href="#" class="sna_section_title_1_text" title=""> إعلانات </a> </h2>
      <div class="owl-carousel ads-carousel lazy" data-loader="customLoaderName">
        <?php
        $data = $core->getAds(array("selection" => 3));
        if ($data)
          for ($i = 0; $i < count($data); $i++) {
        ?>
          <div class="relase2">
            <a href="<?= $data[$i]["link"] ?>"><img src="images/<?= $data[$i]["image"] ?>" alt="" /></a>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php
  } else {
    $data = $core->getBlog(array(), "order by `view` desc");
  ?>
    <div class="col2-xs-12">
      <h2 class="comp_1_header sna_section_title_1"> <a href="#" class="sna_section_title_1_text" title=""> أكثر قراءة </a> </h2>
      <div class="more-boxs">
        <?php for ($i = 0; $i < 3; $i++) {
          $data2 = $core->getCat(array("id" => $data[$i]["level"]));
        ?>
          <div class="xs-box">
            <div class="img-xs"> <img class="lazy" data-src="images/<?= $data[$i]["image"] ?>"> </div>
            <div class="tit-xs"> <span><?= $data2[0]["name"] ?></span> <a href="<?= $core->getBlogUrl($data[$i]["id"]) ?>" title="<?= $data[$i]["name"] ?>" class="hy-xs">
                <?= $data[$i]["name"] ?>
              </a> </div>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
</div>