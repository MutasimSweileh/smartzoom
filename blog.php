<?php

$pagg = 7;

include "inc.php";

$id =  isv("id");

$level =  isv("level");

$name = isv("name");

$prodpram = array();



if($id)

$prodpram = array("id"=>$id);

if($name)

$prodpram = array("name"=>$name);

$prodpram["limit"] = $wher;

$data = $core->getBlog($prodpram);

$data2 = $core->getCat(array("id"=>$data[0]["level"]));

$title = $data[0]["name"];

if($name)

$title = "نتيجة البحث عن ".$name;



if($level){

$prodpram = array("id"=>$level);

$data = $core->getCat($prodpram);

$title = $data[0]["name"];

}else if($id){

$core->UpDate("blog","view",($data[0]["view"]+1),"where  id=".$id);

//$core->isView($id);
//$views =  $core->isView($id,true);
}

?>

    <section class="top-news  center-news sec-padding">

            <div class="container-sa">

                <div class="row">

                                                         <div class="col-md-12 col-xs-12 fl-right">

                                               <div class="owl-carousel ads-carousel">

                                                            <?php

                                $dataads = $core->getAds(array("selection"=>1));

                                if($dataads)

                                    for ($i = 0; $i < count($dataads); $i++) {

                                ?>

                                                <div class="relase3">

                                                 <a href="<?= $dataads[$i]["link"] ?>"><img src="images/<?= $dataads[$i]["image"] ?>" alt="" /></a>

                                                </div>

                                                <?php } ?>

                                                </div>



                    </div>

                    <div class="clear"></div>

                                        <div class="col-md-9 col-xs-12 fl-arabic">



                           <?php if(!$id){ ?>

                        <h2 class="comp_1_header sna_section_title_1"> <a href="" class="sna_section_title_1_text"  >



                       <?=$title?>

                        </a> </h2>



                    <div class="block news-list">

                    <div class="cont">

                          <?php

           $pid =  $data[0]["id"];

            $ar =   array("level"=>$data[0]["id"]);

            $ar["limit"] = $wher;

            if(!$name)

              $data = $core->getBlog($ar);

            //print_r($data);

        if($data)

        for($i=0;$i<count($data);$i++){





        	?>

                    <div class="item-li lg ">

                        <a href="<?= $core->getBlogUrl($data[$i]["id"])?>">

                           <div class="img-cont">



                              <img class="lazy" data-src="images/<?= $data[$i]["image"] ?>" alt="<?= $data[$i]["name"] ?>">

                           </div>

                           <div class="txt-cont">



                                 <h2>   <?= $data[$i]["name"] ?>

                                 </h2>

                                                              <div class="time"><span class="fa fa-clock-o"></span> <?= $core->cptime($data[$i]["date"]) ?></div>



                                 <p>

<?= $data[$i]["smoll_description"] ?>

                                 </p>





                              </div>





                                  </a>

                           </div>

                           <?php } ?>

                           </div>

                           </div>

                           <nav class=" text-center ">

                               <ul class="pagination">
                                   <?php if(isv("start") && isv("start") != 1){ ?>
 <li><a  href="<?= $core->getBlogUrl($pid,true,isv("start")-1)?>"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
</a></li> <?php } ?>
  <?php



                                    //echo count($data);

                                    //echo ceil((count($data)/$limit));

    $ar =   array("level"=>$pid);

    if($name)

    $ar = array("name"=>$name);

    $data = $core->getBlog($ar);

    $count = ceil((count($data)/$limit));
    $index = ((isv("start")?isv("start")-1:0));
    if($count <=8)
    $index = 0;
    $next = ((isv("start")?isv("start"):1)+1);
    if($count > 1)
    for($i=$index;$i<8+$index;$i++){

 if(($i+1) > $count)
continue;

  ?>

   <?php if($i+1 == isv("start") ||  !isv("start") &&  ($i+1) == 1){ ?>

    <li><a class="active" href="#"><?=$i+1?></a></li>

    <?php }else{  ?>

    <!-- <li><a  href="?start=<?=$i+1?><?=$ndex?>"><?=$i+1?></a></li>-->
     <li><a  href="<?= $core->getBlogUrl($pid,true,$i+1)?>"><?=$i+1?></a></li>

    <?php } } if($count > 8){ ?>
<?php }  ?>
<?php if($next< $count){ ?>
 <li><a  href="<?= $core->getBlogUrl($pid,true,$next)?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
</a></li>
<?php } ?>
</ul>

</nav>

                             <?php }else{ ?>



                             <div class="block   post">



    <div class="title">



        <a href="<?= $core->getBlogUrl($data2[0]["id"],true)?>">

            <h3> <?=$data2[0]["name"]?>  </h3> </a>



    </div>





    <div class="show-title">

        <div class="txt-block">



            <h1><?=$data[0]["name"]?></h1>







        </div>

    </div>



    <div class="mainImg">

          <div class="mtime"> <span class="fa fa-clock-o"></span> <?= $core->cptime($data[0]["date"]) ?></div>

        <img class="lazy" data-src="images/<?=$data[0]["image"]?>" alt="<?=$data[0]["name"]?>">

        <div class="caption">



        </div>

    </div>



    <div class="post-option">



        <div class="post-writer">

            <span class="fa fa-pencil"></span> <?=$data[0]["author"]?>

        </div>


<?/*

            <div class="post-views">
     عدد المشاهدات : <?= $views ?>
      </div>
*/?>

        <div class="share">

              <div class="NEwShare_Icons">

                                    <div class="NEwShare_Icons_DIV">

                                        <div class="pull-right Les_ST_Comments">

                                            <div class="NewShareBtn">

                                                <?/*<span class="SharesVG"></span>*/?>

                                                <p class="selectionShareable">مشاركة</p>

                                            </div>

                                            <!--Share Icon-->

                                           <sna-share manual-print="true" share-url="article.Surl" share-summary="article.Ssummary" short-url="article.shortUrl" share-headline="article.Sheadline" url="'/web/article/' + article.id" share-main-media-url="" share-email-url="article.shareEmailUrl" class="ng-isolate-scope">

                <div class="share-social-container noprint">

                    <!-- ngIf: !previewMode -->

                    <ul data-ng-if="!previewMode" class="social-icon-list ng-scope">

                        <li class="share_li facebook">

                            <a class="facebook-icon share_svg_cont" title="Facebook" target="_blank"  href="https://www.facebook.com/dialog/share?app_id=244590942255207&amp;display=page&amp;href=<?=$FUr?>">

                                <svg class="hoverStateMenuSocialIcon social-icon-svg">

                                    <use xlink:href="images/social_icon_sprite.svg#facebook"></use>

                                </svg>

                            </a>

                        </li>

                        <li class="share_li twitter">

                            <a class="twitter-icon share_svg_cont " title="Twitter" target="_blank"  href="https://twitter.com/intent/tweet?text=<?=$data[0]["name"]?>&amp;url=<?=$FUr?>&amp;via=<?=$alt?>">

                                <svg class="hoverStateMenuSocialIcon social-icon-svg">

                                    <use xlink:href="images/social_icon_sprite.svg#twitter"></use>

                                </svg>

                            </a>

                        </li>

                        <li class="share_li whatsapp">

                            <a  target="_blank" title="Whatsapp" class="whatsapp-icon share_svg_cont " href="https://web.whatsapp.com://send?text=<?=$data[0]["name"]?> : <?=$FUr?>">

                                <svg class="hoverStateMenuSocialIcon social-icon-svg">

                                    <use xlink:href="images/social_icon_sprite.svg#whatsapp"></use>

                                </svg>

                            </a>

                        </li>

                        <li class="share_li email"><a data-ng-click="$event.stopPropagation()" title="Email" class="email-icon share_svg_cont " href="mailto:?subject=<?=$data[0]["name"]?> : <?=$FUr?>"> <svg class="emailInactive hoverStateMenuSocialIcon social-icon-svg"> <use xlink:href="images/social_icon_sprite.svg#email"></use> </svg> </a></li>

                    </ul>

                    <!-- end ngIf: !previewMode -->

                    <!-- ngIf: previewMode -->

                </div>

            </sna-share>

                                        </div>

                                        <div class="pull-right">

                                            <span class="CommentVG"></span>

                                            <div class="BGCommentSBar">

                                                <a href="#comments" ><span class="AdDCommenTNeW">اضف تعليقاً واقرأ تعليقات القراء</span></a>

                                            </div>

                                        </div>

                                        <div class="clearfix"></div>

                                    </div>

                                </div>

        </div>

        <div class="share" style="display: none;">





        </div>





    </div>



    <div class="post-cont">



        <div class="show-parags" id="start" style="display:block;float:none">



            <div style="float:left;margin-right:10px;margin-bottom:10px"></div>



            <div class="ni-content">

                   <?=str_replace(array("font"),"",$data[0]["description"])?>

            </div>



        </div>







    </div>



    <!-- Speakol will render the widget here -->



    <div class="block2">

        <!--section-header-->

        <div class="post-tags" style="    clear: both;">

            <span class="cic-ta"><i></i></span>

            <ul style="width:100%">

                 <?php

               $tdata = explode(",",$data[0]["tags"]);

                 if($tdata && $data[0]["tags"])

        for($i=0;$i<count($tdata);$i++){ ?>

                <li > <a href="" target="_blank"><?= $tdata[$i] ?></a></li>

               <?php } ?>

            </ul>

        </div>

    </div>



    <div class="foot-share">

        <!-- Go to www.addthis.com/dashboard to customize your tools -->





    </div>



</div>
<div class="clear"></div>
<?php  $gdata = $core->getgallery(array("category"=>$data[0]["id"])); if($gdata){ ?>
    <section id="gallery" class=" lazy" data-loader="customLoaderName">



            <div class="container-sad">

<h2 class="comp_1_header sna_section_title_1" style="    margin-bottom: 5px;"> <a href="#" class="sna_section_title_1_text" title=""> البوم الصور</a> </h2>



                <div class="owl-carousel gallery-carousel fxSoftScale" style="direction: ltr;">

                    <?php



                                if($gdata)

                                    for ($i = 0; $i < count($gdata); $i++) {

                                ?>

                    <a href="images/<?=$gdata[$i]["image"]?>" class="venobox" data-gall="gallery-carousel">

                        <img class="lazy2" src="images/<?=$gdata[$i]["image"]?>" data-src="images/<?=$gdata[$i]["image"]?>" alt="<?=$gdata[$i]["name"]?>"></a>

                    <?php } ?>



                </div>



            </div>

        </section>
        <?php } ?>
<div class="clear"></div>

<?php if(getValue("comments")  == "1"){ ?>

      <div class="block" id="comments">

             <h2 style="    margin-bottom: 0;" class="comp_1_header sna_section_title_1"> <a href="" class="sna_section_title_1_text"  >

                        أضف تعليق



                        </a> </h2>

                        <div class="clear"></div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="  margin-bottom: 10px;  background: #fff;

    padding: 0px;" >

                <div class="single-footer-widget clearfix">



                    <form class="appointment-form" method="post" >

<input type="hidden" name="health" value="1646">



                        <div class="input-box col-lg-6 col-md-12" >

                                            <div class="field-label" style="margin-bottom: 5px;">الاسم</div>

                            <input type="text" name="cname" class="texxxtform" value="" required="required">



                        </div>

                        <div class="input-box col-lg-6 col-md-12" >

                                            <div class="field-label" style="margin-bottom: 5px;">البريد الالكترونى</div>

                            <input type="text" name="cemail" class="texxxtform" value="" required="required">



                        </div>

                        <div class="clear"></div>

                        <div class="input-box col-md-12" style="width: 100%;">

                                            <div class="field-label" style="margin-bottom: 5px;">التعليق</div>

                            <textarea name="comment" class="texxxtform" required="required" aria-required="true"></textarea>

                        </div>

                        <button type="submit" name="submitcomment" value="submitcomment" class="bttn" style="font-size: 13px;

    float: left;

    width: 111px;

    border-radius: 7%;margin-top: 10px;">أضف تعليق</button>

                    </form>

                </div>



            <div class="clear"></div>

            <div class="comments col-lg-12 col-md-12 col-sm-12 col-xs-12" >

                <style type="text/css">

                   .comment {

    border-top: 1px solid #dedede;

        padding: 15px;

}

.comments {

    margin-top: 10px;

}

.author p {

    font-size: 10px;

}

.author{

        color: #41688b;

        font-size: 19px;

}



                </style>

            <?php  $cdata =  $core->getcomments(array("pid"=>$data[0]["id"])); for ($i = 0; $i < count($cdata); $i++) { ?>

           <div class="comment" >

                   <div  class="author"><?= $cdata[$i]["name"] ?><p><?=$core->cptime($cdata[$i]["date"]) ?></p></div>

                   <div><?= $cdata[$i]["comment"] ?></div>



           </div>

            <?php } ?>

    </div>

    </div>

    </div>

     <?php } ?>

    <div class="clear"></div>

                             <?php } if($id){ ?>

   <h2 class="comp_1_header sna_section_title_1"> <a href="" class="sna_section_title_1_text"  >

                        موضوعات متعلقة

                        </a> </h2>

                        <div class="row">

                            <?php
                  $count = 6;
                  $related = $data[0]["related"];
                  if($related){
                  $data = $core->getBlog(array("in"=>$related));
                  $count = count($data);
                  }else
                  $data = $core->getBlog(array("level"=>$data[0]["level"]));

                  $index = 0;

        if($data)

        for($i=0;$i<$count;$i++){

               $data2 = $core->getCat(array("id"=>$data[$i]["level"]));

                  // echo time();

                  if(in_array($data[$i]["id"],$mydata) || $data[$i]["id"] == $id)

                  continue;

                  if($index == 6)

                  break;

        	?>

                            <div class="col-md-4 col-xs-6 fourth">

                                <div class="outer" href="<?= $core->getBlogUrl($data[$i]["id"])?>" >

                                    <div class="block-sa">

                                        <div class="img-cl">

                                          <!--  <a href="blog.php?level=<?= $data2[0]["id"] ?>" > <div class="content_from_title"> <?= $data2[0]["name"] ?></div>  </a>                -->

                                             <a class="outer2" href="<?= $core->getBlogUrl($data[$i]["id"])?>" >

                                            <img class="lazy" data-src="images/<?= $data[$i]["image"] ?>" alt="<?= $data[$i]["name"] ?>">

                                        </a>

                                        </div>

                                         <a class="outer2" href="<?= $core->getBlogUrl($data[$i]["id"])?>" >

                                        <div class="contemt-cl">

                                            <div class="item-date">

                                                <i class="icon icon-Timer"></i>

                                                <span class="content_list_item_date"><?= $core->cptime($data[$i]["date"]) ?></span>

                                            </div>

                                            <div class="item-det">

                                                <h3><?= $data[$i]["name"] ?></h3>

                                            </div>

                                        </div>

                                          </a>

                                    </div>

                                </div>

                            </div>

                              <?php } ?>





                        </div>

                                   <?php } ?>



           </div>

            <?php include "inc/slidebar.php"; ?>

           </div>

           </div>

    </section>







<?php

include "inc/footer.php";

?>
