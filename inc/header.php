<?php
@ob_start();
@session_start();
$issingle = 0;
$engine = array();
$engines = $core->getEngines($engine);
$titlee = $core->getEngines(array("page" => "info" . $plang))[0];
$title = $titlee["title"];
$str = $titlee["title"];
$alt = $titlee["title"];
$alt_ar = "";
$description =  $titlee["description"];
$keywords = $titlee["keywords"];
$name = pathinfo(basename($_SERVER["PHP_SELF"]))["filename"];
$exname = pathinfo(basename($_SERVER["PHP_SELF"]))["extension"];
if (is_array(@$engines)) {
    foreach ($engines as $engine) {
        //if(basename($_SERVER["PHP_SELF"]).($_SERVER["QUERY_STRING"] ? "?" . $_SERVER["QUERY_STRING"] : "" ) == $engine["page"]) {
        if ($name . ".php" == $engine["page"]) {
            $exDescription = $engine["description"];
            $exKeywords = $engine["keywords"];
            $exTitle = $engine["title"];
            $pageTitle = $exTitle;
        }
    }
}
$id = isv("id");
$level = isv("level");
$image = false;
if ($id || $level)
    if (strpos($name, "products") !== false || strpos($name, "page") !== false || strpos($name, "video") !== false || strpos($name, "gallery") !== false) {
        if ($id || $level) {
            if (!$id)
                $id = $level;
            $array = array("id" => $id);
            if (strpos($name, "video") !== false) {
                $exTitle =  $core->getVideo($array)[0]["name" . $clang];
                $image = $core->getVideo($array)[0]["image"];
                $description = $image;
            } else if (strpos($name, "gallery") !== false) {
                $exTitle =  $core->getmGallery($array)[0]["name" . $clang];
                $image = $core->getmGallery($array)[0]["image"];
                $description = $image;
            } else if (strpos($name, "page") !== false) {
                $exTitle =  $core->getPages($array)[0]["name" . $clang];
                $image = $core->getPages($array)[0]["image"];
                $description = $core->getPages($array)[0]["description" . $clang];
                $description  = limit_str(strip_tags($description), 10, true);
            } else {
                $exTitle =  $core->getBlog($array)[0]["name" . $clang];
                $image = $core->getBlog($array)[0]["image"];
                $exKeywords = $core->getBlog($array)[0]["tags"];
                if ($exKeywords)
                    $exKeywords = $exKeywords . ",";
                $description = $core->getBlog($array)[0]["smoll_description"];
            }
        } else {
            $array = array("id" => $level);
            $exTitle =  $core->getCat($array)[0]["name" . $clang];
        }
    }
if ($_key) {
    if ($_key == "level") {
        $cat = $core->getCat(array("id" => isv("cat")))[0];
        $exTitle =   $cat["name" . $clang];
    } else if ($_key == "company") {
        $company = $core->getcompanies(array("id" => isv($_key)))[0];
        $exTitle =   $company["name" . $clang];
    } else if ($_key == "q") {
        $exTitle = plang("نتيجة البحث عن", "Search result for") . " : " . isv($_key);
    } else {
        $exTitle = getTitle($_key . ($_affiliate ? "_affiliate" : ""));
        if ($_affiliate && !$exTitle)
            $exTitle = getTitle($_key);
    }
}
if (@$exTitle) $title = $exTitle  . " | $str";
if (@$exDescription) $description = $exDescription . " | $description";
if (@$exKeywords) $keywords = $keywords . $exKeywords . $exTitle . "," . join(",", explode(" ", trim($exTitle)));
$keywords = trim($keywords);
$description = trim($description);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Description" content="<?= str_replace('"', "", $description) ?>" />
    <title><?= $title ?></title>
    <meta name="keywords" content="<?= str_replace('"', "", $keywords) ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta itemprop="image" content="<?= $PUr ?>/images/<?= str_replace(" ", "%20", ($image ? $image : "logo.png")) ?>">
    <meta property="og:image" content="<?= $PUr ?>/images/<?= str_replace(" ", "%20", ($image ? $image : "logo.png")) ?>" />
    <meta property="og:title" content="<?= $title ?>">
    <meta name="og:description" content="<?= $description ?>" />
    <link href="css/flexslider.css" rel="stylesheet">
    <link href="css/gflexslider.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/animate.min.css" />
    <link rel="stylesheet" href="css/fontawesome-all.css" />
    <link rel="stylesheet" href="css/mCustomScrollbar.min.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/slick.css" />
    <link rel="stylesheet" href="css/owl.css" />
    <link href="css/jquery.fancybox.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <link rel="stylesheet" href="css/default.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=61658e724564d200122a7ddf&product=sop' async='async'></script>
    <style type="text/css">
        /*------------------------------------
# .0 Latest Blog
------------------------------------*/


        .blog_share_area {
            background: #fff;
            padding: 50px 0;
        }


        .blog_share_box {
            -webkit-transition: .3s;
            -o-transition: .3s;
            transition: .3s;
            background: #f7f9fd;
        }

        .blog_share_box:hover {
            background-color: #ffffff;
            -webkit-box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
        }

        .blog_share_box .bl_share_img {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .blog_share_box .bl_share_img img {
            width: 100%;
            height: 230px;
            -webkit-transition: .5s;
            transition: .5s;
        }


        .blog_share_box:hover .bl_share_img img {


            -webkit-transform: rotate(8deg) scale(1.3);
            transform: rotate(8deg) scale(1.3);
        }


        .blog_date {
            font-size: 14px;
            margin-bottom: 10px;
            display: block;
            border-bottom: 1px solid #f1f1f1;
            padding-bottom: 10px;
            font-weight: normal;
            direction: <?= plang("rtl", "ltr") ?>;

        }


        .blog_date i {
            float: <?= plang("right", "left") ?>;

            line-height: 23px;

            margin-left: 8px;
        }

        .blog_share_details {
            padding: 12px;
            text-align: <?= plang("right", "left") ?>;
        }

        .blog_share_details .comment_author a {
            text-decoration: none;
        }

        .blog_share_details .comment_author a:hover {
            color: #38373c;
        }

        .blog_share_details .comment_author {
            display: block;
            color: #38adb6;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .blog_share_details h1 a {
            color: #38373c;
            font-size: 16px;
            font-weight: 400;
            line-height: 25px;
            display: block;
        }

        .blog_share_details h1 a:hover {
            color: #f8bc14;
            color: var(--thm-primary);
        }

        .blog_share_details h1 {
            height: 75px;
            overflow: hidden;
        }

        .blog_share_details p {
            font-size: 14px;
            font-weight: 400;
        }

        .default_widgets .wpb_content_element,

        .stm_sidebar .wpb_content_element {

            margin: 0 0 50px;

        }



        .default_widgets .wpb_content_element .widget,

        .stm_sidebar .wpb_content_element .widget {

            margin: 0;

        }



        .widget {

            margin: 0 0 20px;

        }



        .widget .widget_title {

            margin: 0 0 26px;

        }



        .widget.widget_categories,

        .widget.widget_archive,

        .widget.widget_pages,

        .widget.widget_meta,

        .widget.widget_recent_comments,

        .widget.widget_recent_entries,

        .widget.widget_rss,

        .widget.widget_nav_menu {

            padding: 10px;

            border: 1px solid #e6e6e6;


        }



        .widget.widget_categories ul,

        .widget.widget_archive ul,

        .widget.widget_pages ul,

        .widget.widget_meta ul,

        .widget.widget_recent_comments ul,

        .widget.widget_recent_entries ul,

        .widget.widget_rss ul,

        .widget.widget_nav_menu ul {

            list-style: none;

            padding: 0;

            margin: 0;

        }



        .widget.widget_categories ul li,

        .widget.widget_archive ul li,

        .widget.widget_pages ul li,

        .widget.widget_meta ul li,

        .widget.widget_recent_comments ul li,

        .widget.widget_recent_entries ul li,

        .widget.widget_rss ul li,

        .widget.widget_nav_menu ul li {

            position: relative;

            text-transform: uppercase;

            margin: 0 0 20px;

            padding: 0px 20px 0px 0;

            line-height: 20px;

        }



        .widget.widget_categories ul li:last-child,

        .widget.widget_archive ul li:last-child,

        .widget.widget_pages ul li:last-child,

        .widget.widget_meta ul li:last-child,

        .widget.widget_recent_comments ul li:last-child,

        .widget.widget_recent_entries ul li:last-child,

        .widget.widget_rss ul li:last-child,

        .widget.widget_nav_menu ul li:last-child {

            margin: 0;

        }



        .widget.widget_categories ul li::before,
        .widget.widget_archive ul li::before,
        .widget.widget_pages ul li::before,
        .widget.widget_meta ul li::before,
        .widget.widget_recent_comments ul li::before,
        .widget.widget_recent_entries ul li::before,
        .widget.widget_rss ul li::before,
        .widget.widget_nav_menu ul li::before {

            content: "›";

            position: absolute;

            left: 0px;

            top: -1px;

            font-weight: 700;

        }



        .widget.widget_categories ul li a,

        .widget.widget_archive ul li a,

        .widget.widget_pages ul li a,

        .widget.widget_meta ul li a,

        .widget.widget_recent_comments ul li a,

        .widget.widget_recent_entries ul li a,

        .widget.widget_rss ul li a,

        .widget.widget_nav_menu ul li a {

            color: #273242;
            font-size: 15px;
            text-transform: capitalize;

            z-index: 55555555555;

            position: relative;

            text-decoration: none !important;

            -webkit-transition: all 0.3s ease;

            -moz-transition: all 0.3s ease;

            -ms-transition: all 0.3s ease;

            -o-transition: all 0.3s ease;

            transition: all 0.3s ease;

        }



        .widget.widget_categories ul li a:hover,

        .widget.widget_archive ul li a:hover,

        .widget.widget_pages ul li a:hover,

        .widget.widget_meta ul li a:hover,

        .widget.widget_recent_comments ul li a:hover,

        .widget.widget_recent_entries ul li a:hover,

        .widget.widget_rss ul li a:hover,

        .widget.widget_nav_menu ul li a:hover {

            color: #e72e5d;

        }



        .widget.widget_categories ul li ul.children,

        .widget.widget_archive ul li ul.children,

        .widget.widget_pages ul li ul.children,

        .widget.widget_meta ul li ul.children,

        .widget.widget_recent_comments ul li ul.children,

        .widget.widget_recent_entries ul li ul.children,

        .widget.widget_rss ul li ul.children,

        .widget.widget_nav_menu ul li ul.children,

        .widget.widget_categories ul li ul.sub-menu,

        .widget.widget_archive ul li ul.sub-menu,

        .widget.widget_pages ul li ul.sub-menu,

        .widget.widget_meta ul li ul.sub-menu,

        .widget.widget_recent_comments ul li ul.sub-menu,

        .widget.widget_recent_entries ul li ul.sub-menu,

        .widget.widget_rss ul li ul.sub-menu,

        .widget.widget_nav_menu ul li ul.sub-menu {

            margin-top: 20px;

        }

        .widget.widget_categories ul li,
        .widget.widget_archive ul li,
        .widget.widget_pages ul li,
        .widget.widget_meta ul li,
        .widget.widget_recent_comments ul li,
        .widget.widget_recent_entries ul li,
        .widget.widget_rss ul li,
        .widget.widget_nav_menu ul li {

            position: relative;

            text-transform: uppercase;

            margin: 0 0 20px;

            padding: 0 0 0 20px;

            line-height: 20px;

        }

        .widgettitle {

            font-size: 18px;

            margin: 0 0 32px;

            margin-bottom: 32px;

            line-height: 25px;

            text-transform: capitalize;

            border-bottom: 1px solid #e6e6e6;

            width: auto;

            display: inline-block;

            padding-bottom: 7px;

            display: inline-block;

            width: 100%;

            margin-bottom: 12px;

        }

        .widget.widget_calendar .widget_title {

            margin-bottom: 25px;

        }



        .widget.widget_calendar #calendar_wrap table {

            width: 100%;

        }



        .widget.widget_calendar #calendar_wrap table caption {

            font-weight: 700;

            text-transform: uppercase;

            color: #273242;

            margin: 0 0 15px;

        }



        .widget.widget_calendar #calendar_wrap table td,

        .widget.widget_calendar #calendar_wrap table th {

            text-align: center;

            font-size: 14px;

            padding: 10px 5px;

        }



        .widget.widget_calendar #calendar_wrap table thead th {

            background: #e72e5d;

            color: #fff;

        }



        .widget.widget_calendar #calendar_wrap table tbody {

            border: 1px solid #e6e6e6;

        }



        .widget.widget_calendar #calendar_wrap table tfoot #prev {

            text-align: right;

        }



        .widget.widget_calendar #calendar_wrap table tfoot #right {

            text-align: left;

        }



        .widget.widget_tag_cloud .tagcloud {

            font-size: 0;

        }



        .widget.widget_tag_cloud .tagcloud a {

            display: inline-block;

            vertical-align: top;

            padding: 7px 12px 8px;

            font-size: 13px !important;

            color: #273242;

            border: 1px solid #e72e5d;

            -webkit-border-radius: 30px;

            -moz-border-radius: 30px;

            -ms-border-radius: 30px;

            border-radius: 30px;

            margin: 0 8px 10px 0;

            text-decoration: none !important;

            -webkit-transition: all 0.3s ease;

            -moz-transition: all 0.3s ease;

            -ms-transition: all 0.3s ease;

            -o-transition: all 0.3s ease;

            transition: all 0.3s ease;

        }



        .widget.widget_tag_cloud .tagcloud a:hover {

            background: #e72e5d;

            color: #fff;

        }



        .widget.widget_text .textwidget img {

            max-width: 100%;

            height: auto;

        }



        .widget.stm_widget_recent_entries ul {

            list-style: none;

            padding: 0;

            margin: 0;

        }



        .widget.stm_widget_recent_entries ul li {

            margin: 0 0 20px;

            padding: 0 0 20px;

            border-bottom: 1px solid #e6e6e6;

        }



        .widget.stm_widget_recent_entries ul li:after {

            content: "";

            display: table;

            clear: both;

        }



        .widget.stm_widget_recent_entries ul li:last-child {

            border: none;

            padding: 0;

            margin: 0;

        }



        .widget.stm_widget_recent_entries ul li .post_thumbnail {

            position: relative;

            float: right;

            width: 65px;

            height: 65px;

            margin: 0 15px 0 0;

        }



        .widget.stm_widget_recent_entries ul li .post_thumbnail img {

            display: block;

            width: 100%;

            height: auto;

        }



        .widget.stm_widget_recent_entries ul li .post_info {

            overflow: hidden;

        }



        .widget.stm_widget_recent_entries ul li .post_info .post-date {

            display: block;

            color: #bfbfbf;

            font-size: 11px;

            margin: 0 0 3px;

        }



        .widget.stm_widget_recent_entries ul li .post_info a {

            color: #273242;

            text-decoration: none !important;

            -webkit-transition: all 0.3s ease;

            -moz-transition: all 0.3s ease;

            -ms-transition: all 0.3s ease;

            -o-transition: all 0.3s ease;

            transition: all 0.3s ease;

            line-height: 20px;

            font-weight: 700;

            text-transform: uppercase;

        }

        .blog-section {
            background: unset;
        }

        .wpb_wrapper {
            padding-top: 20px;
        }

        .widget.stm_widget_recent_entries ul li .post_info a:hover {

            color: #e72e5d;

        }

        a {
            color: #434343;

        }

        .item .actions a.addtocart {
            font-size: 14px;
        }

        .menu-item-has-children:hover>.sub-menu {
            top: 0 !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        li.menu-item-has-children:hover>a,
        .menu-item-has-children:hover>a:after {
            color: #fff !important;
        }

        table,
        th,
        td {
            border: 0;
        }

        .large-image img {
            max-width: unset;
            height: auto;
            margin: 0 auto;
        }

        .owl-carousel .owl-item .product-thumbnail img {
            height: 130px;
        }

        .data-table {
            width: 100%;
            border: 0
        }

        .data-table thead tr {
            border: 1px solid #dcdcdc
        }

        .tab-container {
            position: relative;
        }

        .tab-container .tab-panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            opacity: 0;
            visibility: hidden;
        }

        .tab-container .active {
            opacity: 1;
            visibility: inherit;
            position: inherit;
            -vendor-animation-duration: 0.3s;
            -vendor-animation-delay: 1s;
            -vendor-animation-iteration-count: infinite;
        }

        a.stock {
            cursor: not-allowed;
            pointer-events: none;
            color: #fff;
            border-color: #a0a0a0;
            background-color: #a0a0a0;
        }

        .large-image {
            border: 1px solid #ddd;
            margin-top: 20px;
        }

        .large-image img {
            max-width: 100%;
            height: 400px;
            margin: 0 auto;
        }

        .previews-list {
            padding: 0;
            list-style-type: none;
            text-align: center;
        }

        .previews-list li {
            margin-right: 15px;
            padding: 0;
            float: none;
            display: inline-block;
        }

        .flexslider-thumb-vertical-outer {
            margin: 0 10px 15px 0;
            width: 76px;
            float: left;
            position: relative;
            z-index: 1;
        }

        .flexslider-thumb-vertical .flex-viewport {
            height: 300px !important;
        }

        .flexslider-thumb-vertical .slides {
            margin: -4px 0 0;
            padding: 0;
            list-style-type: none;
        }

        .flexslider-thumb-vertical .slides li {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .flexslider-thumb-vertical .slides li img {
            width: 100%;
            padding: 4px 0;
            cursor: pointer;
            -moz-user-select: none;
        }

        .flexslider-thumb {
            max-width: 455px;
            padding: 22px 62px;
            position: relative;
            border-top: 1px #e5e5e5 solid;
            direction: ltr;
        }

        @media (max-width: 479px) {
            .flexslider-thumb {
                padding: 22px 32px;
                border-bottom: 1px #e5e5e5 solid;
            }
        }

        @media (max-width: 767px) {
            .flexslider-thumb {
                padding: 22px 18px;
                border-bottom: 1px #e5e5e5 solid;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .flexslider-thumb {
                padding: 22px 35px;
                border-bottom: 1px #e5e5e5 solid;
            }
        }

        .product-view-area-compact .flexslider-thumb {
            margin: 17px auto 0;
        }

        .flexslider-thumb .flex-viewport {
            z-index: 10;
        }

        .flexslider-thumb .flex-direction-nav {
            top: 30%;
            left: 0;
            width: 100%;
            z-index: 1;
        }

        .flexslider-thumb .flex-prev {
            position: absolute;
            left: 20px;
            top: 8px;
            border: 1px #e5e5e5 solid;
            background: #fff;
            width: 32px;
            height: 32px;
            line-height: 28px;
            border-radius: 100%;
            text-align: center;
            font-size: 11px;
            transition: color 300ms ease-in-out 0s, background-color 300ms ease-in-out 0s, background-position 300ms ease-in-out 0s;
        }

        @media (max-width: 768px) {
            .flexslider-thumb .flex-prev {
                left: 0;
            }
        }

        .flexslider-thumb .flex-direction-nav a:hover {
            background-color: #a7d426;
            color: #fff;
            transition: color 300ms ease-in-out 0s, background-color 300ms ease-in-out 0s, background-position 300ms ease-in-out 0s;
        }

        .flexslider-thumb .flex-next {
            position: absolute;
            right: 20px;
            top: 8px;
            border: 1px #e5e5e5 solid;
            background: #fff;
            width: 32px;
            height: 32px;
            line-height: 28px;
            border-radius: 100%;
            text-align: center;
            font-size: 11px;
            transition: color 300ms ease-in-out 0s, background-color 300ms ease-in-out 0s, background-position 300ms ease-in-out 0s;
        }

        @media (max-width: 480px) {
            .flexslider-thumb .flex-next {
                right: 0;
            }
        }

        @media (max-width: 768px) {
            .flexslider-thumb .flex-next {
                right: 0px;
            }
        }

        .flexslider-thumb li img {
            cursor: pointer;
            -moz-user-select: none;
            border: 1px #e5e5e5 solid;
            padding: 2px;
        }

        .previews-list {
            padding: 0;
            list-style-type: none;
            text-align: center;
        }

        .previews-list li {
            margin-right: 15px;
            padding: 0;
            float: none;
            display: inline-block;
        }

        .flexslider-thumb-vertical-outer {
            margin: 0 10px 15px 0;
            width: 76px;
            float: left;
            position: relative;
            z-index: 1;
        }

        .flexslider-thumb-vertical .flex-viewport {
            height: 300px !important;
        }

        .flexslider-thumb-vertical .slides {
            margin: -4px 0 0;
            padding: 0;
            list-style-type: none;
        }

        .flexslider-thumb-vertical .slides li {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .flexslider-thumb-vertical .slides li img {
            width: 100%;
            padding: 4px 0;
            cursor: pointer;
            -moz-user-select: none;
        }

        /********** login page ***************/
        #dsl_google_button {
            background: #dd4b39;
        }

        #dsl_google_button:active {
            background: #be3e2e;
        }

        #dsl_facebook_button {
            background: #4864b4;
        }

        #dsl_google_button:active {
            background: #3a5192;
        }

        #dsl_twitter_button {
            background: #00aced;
        }

        #dsl_google_button:active {
            background: #00aced;
        }

        .abt-first h2 {
            text-align: center;
            margin: 20px 0;
            font-size: 22px;
            position: relative;
            padding-bottom: 20px;
        }

        #dsl_instagram_button {
            background: #c13584;
        }

        #dsl_google_button:active {
            background: #c13584;
        }

        #d_social_login .dsl-button {
            font-size: 16px;
            text-decoration: none;
            color: #fff;
            display: inline-block;
            box-sizing: border-box;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
            margin: 2px;
            margin-bottom: 10px;
            padding: 0px;
        }

        #d_social_login .dsl-button:hover {
            text-decoration: none;
            box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.2);
        }

        #d_social_login .dsl-button:active {
            box-shadow: inset 0 2px 0 rgba(0, 0, 0, 0.2);
        }

        #d_social_login .dsl-button.dsl-button-medium .l-side,
        #d_social_login .dsl-button .l-side {
            padding: 5px 5px 0px 5px;
            border-right: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            display: inline-block;
            font-size: 17px;
            vertical-align: middle;
            box-sizing: border-box;
            text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        #d_social_login .dsl-button.dsl-button-medium .r-side,
        #d_social_login .dsl-button .r-side {
            padding: 6px 10px 6px 10px;
            color: #fff;
            display: inline-block;
            font-size: 12px;
            vertical-align: middle;
            box-sizing: border-box;
            text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
        }

        #d_social_login .dsl-button.dsl-button-huge .l-side {
            font-size: 26px;
            padding: 8px 10px 0px 8px;
        }

        #d_social_login .dsl-button.dsl-button-huge .r-side {
            font-size: 15px;
            padding: 12px 20px 11px 20px;
        }

        #d_social_login .dsl-button.dsl-button-large .l-side {
            font-size: 20px;
            padding: 6px 6px 0px 6px;
        }

        #d_social_login .dsl-button.dsl-button-large .r-side {
            font-size: 13px;
            padding: 8px 16px 7px 16px;
        }

        #d_social_login .dsl-button.dsl-button-small .l-side {
            font-size: 14px;
            padding: 4px 4px 0px 4px;
        }

        #d_social_login .dsl-button.dsl-button-small .r-side {
            font-size: 10px;
            padding: 4px 5px 3px 5px;
        }

        #d_social_login .dsl-button.dsl-button-icons .l-side {
            font-size: 17px;
            padding: 5px 5px 0px 5px;
            border: none;
        }

        #d_social_login .dsl-button.dsl-button-icons .r-side {
            display: none;
        }

        a [class*="dsl-icon-"],
        [class*="dsl-icon-"],
        [class*="dsl-icon-"]:before {
            margin: 0px !important;
            background-image: none !important;
        }

        .dsl-label {
            display: none;
            vertical-align: middle;
        }

        .dsl-label-icons {
            display: inline-block;
        }

        .dsl-hide-icon {
            opacity: 0;
        }

        .page-title {
            margin-bottom: 30px;
            margin-top: 30px;
            float: none;
        }

        .page-title {
            margin-top: 30px;
            float: left;
            width: 100%;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 0;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .data-table tbody tr {
            border-right: 1px solid #dcdcdc;
            border-left: 1px solid #dcdcdc;
            background-color: #fff
        }

        .data-table td.last,
        .data-table th.last {
            border-left: 1px solid #dcdcdc
        }

        .box-border {
            border: 1px solid #eaeaea;
            padding: 20px;
            overflow: hidden;
            background: #f8f8f8;
            margin: 20px auto;
            display: block;
            width: 40%;
        }

        .im-4 {
            margin-bottom: 15px;
            text-align: center;
        }

        .im-p {
            font-size: 13px;
            color: #000;
            margin-bottom: 15px;
        }

        .box-border h4,
        .box-border label {
            font-weight: normal;
        }

        .box-border input[type="text"],
        .box-border input[type="email"],
        .box-border input[type="password"] {
            height: 34px;
            padding: 0 10px;
            border: 1px solid #eaeaea;
            width: 100%;
            display: block;
            max-width: 100%;
            background: #fff;
            font-size: 14px;
        }

        .box-border label {
            font-size: 15px;
        }

        .box-border .button:hover {
            opacity: 0.9;
            color: #fff;
        }

        .box-border .button {
            padding: 0 15px;
            display: inline-block;
            height: 34px;
            line-height: 34px;
            border: none;
            background: #595959;
            color: #fff;
        }

        .data-table th {
            padding: 15px 10px;
            font-weight: 700
        }

        .data-table td {
            padding: 15px 10px
        }

        .data-table h2,
        .data-table h3 {
            margin-top: 0;
            margin-bottom: 0;
            font-weight: 400
        }

        .data-table thead th {
            font-weight: 600;
            padding: 15px 10px;
            color: #777;
            white-space: nowrap;
            vertical-align: middle;
            font-size: 14px;
            text-transform: uppercase
        }

        .data-table thead th.wrap {
            white-space: normal
        }

        .data-table thead th a,
        .data-table thead th a:hover {
            color: #fff
        }

        .data-table thead th {
            background-color: #f6f6f6
        }

        .data-table thead th .tax-flag {
            font-size: 11px;
            white-space: nowrap
        }

        .data-table tfoot {
            border-bottom: 1px solid #d9dde3
        }

        .data-table tfoot tr.first td {
            border-right: 1px solid #dcdcdc
        }

        .data-table tfoot td {
            padding-top: 10px;
            padding-bottom: 10px;
            border-bottom: 0;
            border-left: 1px solid #dcdcdc;
            border-right: 1px solid #dcdcdc
        }

        .data-table tfoot strong {
            font-size: 16px
        }

        .data-table tbody th,
        .data-table tbody td {
            border-bottom: 1px solid #dcdcdc;
            border-left: 1px solid #dcdcdc;
            padding: 15px 10px;
            line-height: 1.3
        }

        .data-table tbody td .option-label {
            font-weight: 700;
            font-style: italic
        }

        .data-table tbody td .option-value {
            padding-right: 10px
        }

        .data-table p {
            margin-bottom: 0
        }

        .data-table .qty-holder,
        .data-table .add-to-cart-alt {
            position: relative;
            text-align: right;
            margin-left: 0
        }

        .data-table .add-to-cart-alt {
            margin: 10px 0;
            width: 93px
        }

        .data-table .edit-qty {
            margin-right: 5px
        }

        .data-table input.qty {
            color: #777;
            height: 30px;
            border-radius: 0;
            border-color: #ddd;
            margin: 0 -1px
        }

        .data-table .table_qty_inc,
        .data-table .table_qty_dec {
            display: inline-block;
            width: 30px;
            height: 30px;
            background: #f4f4f4;
            border: 1px solid #ccc;
            color: #777;
            line-height: 30px;
            border-radius: 0;
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            vertical-align: top
        }

        .data-table button.button>span {
            background: #fff;
            border: 1px solid #ccc;
            color: #777;
            line-height: 32px;
            padding: 0 12px
        }

        .data-table button.button:hover>span {
            background: #2f9c0a;
            border: 1px solid #2f9c0a;
            color: #fff
        }

        .data-table .product-name a {
            color: #2f9c0a
        }

        .data-table .cart-cell {
            margin-bottom: 10px
        }

        .data-table .cart-cell button.button span {
            font-size: 13px;
            line-height: 28px
        }

        .info-box {
            background: #fff 0 0 repeat-x;
            border: 1px solid #d0cbc1;
            padding: 12px 15px;
            margin: 0 0 15px
        }

        .info-box h2 {
            font-weight: 700;
            font-size: 13px
        }

        .info-table th {
            font-weight: 700;
            padding: 2px 15px 2px 0
        }

        .info-table td {
            padding: 2px 0
        }

        tr.summary-total {
            cursor: pointer
        }

        tr.summary-total .summary-collapse {
            float: left;
            text-align: left;
            padding-right: 20px;
            cursor: pointer
        }

        tr.summary-details td {
            font-size: 11px;
            background-color: #dae1e4;
            color: #626465
        }

        tr.summary-details-first td {
            border-top: 1px solid #d2d8db
        }

        tr.summary-details-excluded {
            font-style: italic
        }

        .cart-tax-info {
            display: block
        }

        .cart-tax-info,
        .cart-tax-info .cart-price {
            padding-left: 20px
        }

        .cart-tax-total {
            display: block;
            padding-left: 20px;
            cursor: pointer
        }

        .cart-tax-info .price,
        .cart-tax-total .price {
            display: inline !important;
            font-weight: 400 !important
        }

        .cart-tax-total-expanded {
            background-position: 100% -52px
        }

        .std {
            line-height: 1.4
        }

        .std .subtitle {
            padding: 0
        }

        .std ol.ol {
            list-style: decimal outside;
            padding-right: 1.5em
        }

        .std ul.disc {
            list-style: disc outside;
            padding-right: 18px;
            margin: 0 0 10px
        }

        .std dl dt {
            font-weight: 700
        }

        .std dl dd {
            margin: 0 0 10px
        }

        .std ul,
        .std ol,
        .std dl,
        .std address,
        .std blockquote {
            margin: 0;
            padding: 0
        }

        .std ul {
            list-style: disc outside;
            padding-right: 1.5em
        }

        .std ul li {
            line-height: 20px
        }

        .std ol {
            list-style: decimal outside;
            padding-right: 1.5em
        }

        .std ul ul {
            list-style-type: circle
        }

        .std ul ul,
        .std ol ol,
        .std ul ol,
        .std ol ul {
            margin: .5em 0
        }

        .std dt {
            font-weight: 700
        }

        .std dd {
            padding: 0 0 0 1.5em
        }

        .std blockquote {
            font-style: italic;
            padding: 0 0 0 1.5em
        }

        .std address {
            font-style: normal
        }

        .std b,
        .std strong {
            font-weight: 700
        }

        .std i,
        .std em {
            font-style: italic
        }

        .links li {
            display: inline
        }

        .link-wishlist {
            color: #ed4949;
            border-color: #f6a4a4
        }

        .link-wishlist:hover {
            color: #ed4949;
            border-color: #f6a4a4
        }

        .cart-table .link-wishlist,
        .cart-table .link-wishlist:hover {
            color: #2f9c0a
        }

        .link-compare {
            color: #52b9b5;
            border-color: #97d5d3
        }

        .link-compare:hover {
            color: #52b9b5;
            border-color: #97d5d3
        }

        .btn-remove {
            position: relative;
            display: block;
            width: 23px;
            height: 23px;
            text-indent: -9999px;
            overflow: hidden;
            padding: 5px 0;
            font-size: 13px;
            color: #2f9c0a;
            line-height: 1
        }

        .btn-remove:hover {
            color: #2f9c0a
        }

        .btn-remove:before {
            content: "\f00d";
            color: red;
            font: normal normal normal 16px/1 FontAwesome;
            display: block;
            position: absolute;
            right: 0;
            left: 0;
            text-indent: 0;
            text-align: left
        }

        .btn-previous {
            display: block;
            width: 11px;
            height: 11px;
            font-size: 0;
            line-height: 0;
            overflow: hidden
        }

        .btn-remove2 {
            display: inline-block;
            width: 34px;
            height: 34px;
            font-size: 18px;
            line-height: 22px;
            overflow: hidden
        }

        .btn-remove2:before {
            text-align: center
        }

        .btn-edit {
            display: block;
            width: 11px;
            height: 11px;
            font-size: 0;
            line-height: 0;
            overflow: hidden
        }

        .cards-list dt {
            margin: 5px 0 0
        }

        .cards-list .offset {
            padding: 2px 0 2px 20px
        }

        .cart .page-title {
            border-bottom: 0;
            margin: 0 0 12px
        }

        .cart .page-title h1 {
            margin: 0 0 20px
        }

        .cart .page-title .checkout-types li {
            margin: 0 0 5px
        }

        .cart .title-buttons .checkout-types {
            float: left
        }

        .cart .title-buttons .checkout-types li {
            float: right;
            margin: 0 0 5px 5px
        }

        .cart .checkout-types .paypal-or {
            margin: 0 8px;
            line-height: 2.3;
            vertical-align: top
        }

        .cart .checkout-types .bml_button {
            display: inline-table;
            width: 150px;
            margin: 0 0 5px
        }

        .cart .totals .checkout-types .paypal-or {
            clear: both;
            display: block;
            padding: 8px 55px 0 0;
            line-height: 1;
            font-size: 11px
        }

        .cart .cart-table-wrap {
            border: 1px solid #ececec;
            border-radius: 8px;
            background: #fff;
            display: block;
            padding: 30px;
            margin-bottom: 60px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.08)
        }

        .cart-table thead tr {
            border-width: 0 0 1px
        }

        .cart-table thead th {
            background-color: transparent;
            text-transform: none
        }

        .cart-table td {
            padding: 10px;
            vertical-align: middle;
            font-size: 14px
        }

        .cart-table tbody th,
        .cart-table tbody td {
            border-left-width: 0
        }

        .cart-table td.last,
        .cart-table th.last {
            border-left-width: 0
        }

        .cart-table tbody td.pr-img-td {
            text-align: center;
            border-left: 0
        }

        .cart-table tbody tr {
            border-right-width: 0 !important;
            border-left-width: 0 !important
        }

        .cart-table tfoot {
            border-bottom-width: 0
        }

        .cart-table tfoot tr.first td {
            border-width: 0
        }

        .cart-table td.product-name-td {
            color: #777;
            font-size: 14px
        }

        .cart-table td.product-name-td dl.item-options {
            margin: 0
        }

        .cart-table .product-name {
            margin: 0
        }

        .cart-table td.td-total .cart-price {
            color: #2f9c0a
        }

        .cart-table .item-msg {
            margin: 5px 0;
            font-size: 11px;
            font-weight: 700;
            color: #df280a
        }

        .cart-table tfoot td {
            padding: 15px 5px 0
        }

        .cart-table .btn-continue {
            float: right
        }

        .cart-table .btn-update,
        .cart-table .btn-empty {
            float: left
        }

        .cart-table .btn-update {
            margin-right: 10px
        }

        .cart-table .action-td {
            padding: 15px 0
        }

        .cart-table .qty-holder {
            width: 125px;
            white-space: nowrap
        }

        .cart .cart-collaterals {
            margin-bottom: 45px
        }

        .cart-collaterals>* {
            margin-bottom: 15px
        }

        .cart .cart-collaterals .col2-set {
            float: right;
            width: 605px
        }

        .cart .cart-collaterals .col2-set .col-2 {
            width: 294px
        }

        .cart .cart-collaterals h2 {
            padding: 10px 15px 10px 45px;
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            border: 1px solid #ddd;
            background-color: #f5f5f5;
            color: #000;
            position: relative;
            border-radius: 7px 7px 0 0;
        }

        .cart .crosssell h2 {
            font-size: 16px;
            color: #313131;
            font-weight: 700
        }

        .cart .crosssell .product-image {
            float: right;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 2px;
            width: 90px
        }

        .cart .crosssell .product-details {
            margin-right: 105px
        }

        .cart .crosssell .product-name {
            margin: 5px 0
        }

        .cart .crosssell li.item {
            margin: 12px 0
        }

        .cart .crosssell .link-compare {
            font-weight: 400
        }

        .cart .crosssell .price-box {
            margin: 5px 0 10px
        }

        .cart .crosssell button.button>span {
            border: 1px solid #ccc;
            background: #fff;
            padding: 0 12px
        }

        .cart .crosssell button.button:hover>span {
            border: 1px solid #2f9c0a;
            background: #2f9c0a
        }

        .cart .crosssell button.button span {
            color: #777;
            font-size: 12px;
            line-height: 25px;
            min-width: 0
        }

        .cart .crosssell button.button:hover span {
            color: #fff
        }

        .cart .crosssell .add-to-links {
            display: none
        }

        .cart .discount,
        .cart .shipping {
            margin-bottom: 15px
        }

        .cart .discount .input-box {
            font-size: 13px
        }

        .cart .discount h2.opened:before,
        .cart .shipping h2.opened:before {
            content: "\e80d"
        }

        .cart .discount h2:hover:before,
        .cart .shipping h2:hover:before {
            background: #2f9c0a;
            border-color: #2f9c0a;
            color: #fff
        }

        .cart .cart-collaterals h2+* {
            padding: 15px;
            font-size: 13px;
            border: 1px solid #ddd;
            border-top: 0;
            border-radius: 0 0 7px 7px;
            background-color: #fbfbfb
        }

        .discount-form input.input-text {
            height: 38px;
            border: 1px solid #ccc;
            padding: 0 20px;
            border-radius: 0;
        }

        .cart .discount p,
        .cart .shipping p {
            font-size: 14px
        }

        .cart .discount .buttons-set,
        .cart .shipping .buttons-set {
            margin: 10px 0 0;
            border: 0;
            padding: 0;
            text-align: right
        }

        .cart .discount .buttons-set button.button,
        .cart .shipping .buttons-set button.button {
            float: none;
            margin-right: 0;
            width: 100%
        }

        .cart .discount input.input-text {
            width: 100%
        }

        .cart .shipping .sp-methods {
            margin: 10px 0 0;
            padding: 5px 0 0
        }

        .cart .totals table {
            width: 100%
        }

        .cart .totals tr {
            border-bottom: 1px solid #dcdcdc
        }

        .cart .totals td {
            padding: 10px;
            line-height: 1.4;
            font-size: 13px;
            font-weight: 300;
            text-align: right !important;
        }

        .cart .totals .price {
            display: block;
            text-align: left;
            color: #000;
            font-size: 14px;
            font-weight: 600;
        }

        .cart .totals tfoot th {
            padding: 5px 15px 5px 7px
        }

        .cart .totals .checkout-types {
            font-size: 13px;
            text-align: center
        }

        .cart .totals .checkout-types li {
            clear: both;
            margin: 10px 0
        }

        .cart .totals tfoot tr {
            border-bottom-width: 0
        }

        .cart .totals button.button {
            width: 100%
        }

        .cart .totals tfoot th strong,
        .cart .totals tfoot td strong {
            font-weight: 300
        }

        .cart .totals tfoot .price {
            font-size: 17px
        }

        .qty-holder {
            display: inline-block;
            vertical-align: middle;
            margin-left: 7px;
            width: 104px;
            position: relative;
            text-align: center;
        }

        .add-to-cart .qty {
            display: inline-block;
            vertical-align: middle;
            height: 43px;
            width: 44px !important;
            font-size: 14px;
            font-weight: 400;
            text-align: center;
            color: #21293c;
            margin: 0;
            border-color: #dae2e6;
        }

        .qty-changer {
            display: block;
        }

        .qty-changer>a {
            position: absolute;
            top: 0;
            width: 30px;
            height: 43px;
            border: solid 1px #dae2e6;
            line-height: 41px;
            font-size: 11px;
            color: #8798a2;
        }

        .qty-changer .qty_inc {
            left: 1px;
        }

        .qty-changer .qty_inc i:before {
            content: '\e873';
        }

        .qty-changer .qty_dec {
            right: 1px;
        }

        .qty-changer .qty_dec i:before {
            content: '\e874';
        }

        .cart .page-title h1 {
            display: block;
            float: unset;
            text-align: center;
            font-weight: 700;
            margin-top: 10px;
            margin-bottom: 0;
        }

        .cart .title-buttons .checkout-types {
            float: left;
            margin-top: -40px;
            display: none;
        }

        .cart .shipping {
            display: none;
        }

        .cart-table .product-name a {
            font-size: 13px;
            color: #777;
            font-weight: 500;
        }

        .cart .totals button.button span {
            font-weight: 700;
            font-size: 13px;
            line-height: 44px;
            background: #777;
        }

        .cart .totals button.button span:hover {
            background: #0057a8;
        }

        .cart .totals button.button>span span:before {
            content: ">>";
            display: inline-block;
            margin-left: 5px;
            font-weight: 900;
            font-size: 12px;
        }

        .header-container.header-newskin .mini-cart .mini-products-list li a.btn-remove {
            color: #e6000d;
            background: transparent;
            box-shadow: none;
            top: initial;
            bottom: 28px;
            width: 25px;
            height: 25px;
            left: 3px;
        }

        .header-container.header-newskin .mini-cart .mini-products-list li a.btn-remove:before {
            text-align: center;
            font-size: 14px;
        }

        /*#endregion Cart Page*/
        /*#region Checkout Page*/
        .opc-menu {
            display: none;
        }

        a.checkout-login {
            height: 36px;
            line-height: 36px;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 0;
            padding-left: 5px;
            background: #0F6AB2;
            color: #fff;
            display: block;
            clear: right;
            float: right;
            width: 150px;
            padding: 0;
            text-align: center;
            margin-bottom: 25px;
            text-decoration: none;
            border-radius: 3px;
            transition: none;
            margin-left: 10px;
            margin-top: 5px;
        }

        .opc-wrapper-opc a.checkout-login:hover {
            background: #0c5188;
            color: #fff !important;
        }

        .checkout-or {
            display: block;
            text-align: right;
            margin-top: 5px;
            margin-bottom: 0;
            line-height: 36px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            color: #000 !important;
            position: relative;
            overflow: hidden;
            width: calc(100% - 160px);
            float: right;
        }

        .checkout-or:after {
            content: '';
            display: block;
            position: absolute;
            width: 85%;
            height: 1px;
            top: 50%;
            left: 0;
            margin-top: -0.5px;
            background: rgba(0, 0, 0, 0.15);
        }

        .opc-wrapper-opc h3 {
            clear: both;
        }

        /*Coupon*/
        body .opc-wrapper-opc .discount-block .button span>span {
            background-color: #0f6ab2 !important;
            border-radius: 3px;
            color: #fff !important;
            font-size: 13px !important;
            line-height: 33px !important;
        }

        body .opc-wrapper-opc .discount-block .button:hover span>span {
            background-color: #0f6ab2 !important;
            border-radius: 3px;
            color: #fff !important;
            font-size: 13px !important;
            line-height: 33px !important;
        }

        /*#endregion Checkout Page*/
        /*#region Success Page*/
        .checkout-onepage-success .col-right.sidebar {
            display: none;
        }

        .checkout-onepage-success .col-main.col-sm-9 {
            width: 80%;
            text-align: center;
            margin-right: 10%;
        }

        .checkout-onepage-success .col-main.col-sm-9 .buttons-set {
            text-align: center;
        }

        .checkout-onepage-success .col-main.col-sm-9 .buttons-set button.button {
            float: unset;
            margin: 0;
        }

        .checkout-onepage-success .col-main.col-sm-9 .order-id {
            font-size: 15px;
            font-weight: 700;
            color: #2778c5;
        }

        .checkout-onepage-success .col-main.col-sm-9 .fa-check {
            font-size: 28px;
            color: #135ea3;
        }

        .checkout-onepage-success .page-title {
            text-align: center;
            margin-top: 20px;
        }

        .checkout-onepage-success .page-title h1 {
            text-transform: uppercase;
            font-weight: 700;
            color: #333;
        }

        .checkout-onepage-success .form-wrap {
            border: 1px solid #ddd;
        }

        .product-images {
            float: right !important;
        }

        .block-breadcrumbs {}

        .block-breadcrumbs {
            font-size: 12px;
        }

        .block-breadcrumbs ul {
            padding: 0;
        }

        .block-breadcrumbs {
            margin-top: 30px;
            padding-left: 15px;
            padding-right: 15px;
            font-size: 12px;
        }

        ul.checkout-types {
            list-style: none;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .block-product-info .box-qty .quantity-minus,
        .block-product-info .box-qty .quantity-plus {
            width: 35px;
            height: 30px;
            border: 1px solid #eaeaea;
            display: inline-block;
            text-align: center;
            float: <?= plang("right", "left") ?>;
            font-size: 0;
        }

        .block-product-info td.table-value {
            min-width: 380px;
        }

        .quantity {
            position: relative;
            border: 1px solid #ebebeb;
            font-size: 14px;
            color: #000;
            line-height: 42px;
            padding: 0 30px;
            border-radius: 2px;
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
        }

        .block-product-info .box-qty input.quantity {
            border: 1px solid #eaeaea;
            height: 30px;
            width: 70px;
            float: <?= plang("right", "left") ?>;
            border-right: none;
            border-left: none;
            text-align: center;
        }

        .block-product-info .box-qty .quantity-minus {
            background-image: url(images/minus.png);
            background-repeat: no-repeat;
            background-position: center center;
        }

        .block-product-info .box-qty .quantity-plus {
            background-image: url(images/plus-square.png);
            background-repeat: no-repeat;
            background-position: center center;
        }

        div#carousel-reviews .owl-nav {
            display: none;
        }

        .block-product-info .desc {
            padding: 20px 0;
            border-bottom: 1px solid #eaeaea;
            color: #414141;
        }

        .old-price .price {
            color: #777777 !important;
            font-size: 14px;
            font-weight: normal;
            text-decoration: line-through;
            margin-left: 6px;
        }

        .block-product-info .variations-box {
            margin-top: 15px;
        }

        .product-extra-link {
            margin-top: -8px;
            float: right;
            margin-right: 15px;
        }

        .product-extra-link a span {
            display: none;
        }

        .product-extra-link a {
            border: 1px solid #e5e5e5;
            display: inline-block;
            background-color: #fff;
            height: 40px;
            position: relative;
            width: 40px;
            transition: all 0.3s ease-out 0s;
            -webkit-transition: all 0.3s ease-out 0s;
        }

        .product-extra-link a.wishlist-link::after {
            background-image: url(images/wishlist-icon2.png);
            width: 19px;
            height: 17px;
        }

        .product-extra-link a::after {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            content: "";
            background-repeat: no-repeat;
            background-position: top left;
            transition: all 0.3s ease-out 0s;
            -webkit-transition: all 0.3s ease-out 0s;
        }

        .button-radius {
            position: relative;
            border: 1px solid #eaeaea;
            padding: 1px;
            padding-right: 1px;
            padding-left: 1px;
            min-height: 34px;
            background: #fff;
            display: inline-block;
            width: auto;
            line-height: 30px;
            padding-left: 20px;
            padding-right: 40px;
            margin: 0;
            margin-top: 0px;
            margin-bottom: 0px;
            margin-left: 0px;
            color: #666666;
            -webkit-border-radius: 17px;
            -moz-border-radius: 17px;
            border-radius: 17px;
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            -o-transition: all 1s ease;
            -ms-transition: all 1s ease;
            transition: all 1s ease;
            margin-top: 10px;
            font-size: 14px;
        }

        .product-extra-link,
        .block-product-info .btn-add-cart {
            float: left;
            margin-left: 15px;
        }

        .block-product-info .btn-add-cart {
            margin-top: -2px;
            margin-right: 5px;
            float: right;
        }

        .old-price {
            display: inline;
            margin-right: 15px;
            line-height: 1;
            margin: 0;
        }

        .product-price ins {
            color: #1169b9;
            font-size: 18px;
            margin: 0 10px;
            text-decoration: none;
        }

        .product-price {

            font-weight: 500;
            color: #333e48;
        }

        .label {
            display: inline;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: bold;
            line-height: 1;
            color: #ffffff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }

        .product-info-stock-sku .stock .label {
            line-height: 25px;
            border-radius: 0;
            font-size: 15px;
            font-weight: normal;
            padding: 6px 5px 1px 5px;
        }

        .label-success {
            background-color: #5cb85c;
        }

        .block:not([class*=block-language]):not(ins) {
            background: #fff;
            -webkit-box-shadow: 2px 2px 3px rgb(0 0 0 / 10%);
            -moz-box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.1);
            box-shadow: 2px 2px 3px rgb(0 0 0 / 10%);
            border-top: 1px solid #eaeaea;
            border-left: 1px solid #eaeaea;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            /* float: left; */
            max-width: 100%;
            width: 100%;
        }

        .block-breadcrumbs ul li {
            display: inline;
            list-style: none;
            height: 40px;
            line-height: 40px;
            float: right;
            background: transparent;
            border: 0 none;
            font-weight: inherit;
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            vertical-align: top;
            font-size: 14px;
            color: #414141;
            overflow: hidden;
        }

        .block-breadcrumbs ul li a {
            float: right;
        }

        .block-breadcrumbs ul li span {
            float: right;
        }

        .block-breadcrumbs ul li span {
            position: relative;
            float: left;
            width: 30px;
            text-indent: -9999em;
            height: 100%;
            background: url("images/bg-breadcrumbs.png") no-repeat 0 0;
            padding: 12px 5px;
        }


        @media (max-width: 767px) {


            .block-breadcrumbs {
                padding: 0;
            }

            .block-breadcrumbs ul li {
                border-right: 1px solid #eee;
                width: 50%;
                padding-left: 8px;
                padding-right: 8px;
            }

            .block-breadcrumbs ul li span {
                display: none;
            }

            .block-breadcrumbs ul li:nth-child(even) {
                border-right: 0;
            }

        }


        .product-page .block-top-sellers {
            margin-top: 30px;
        }

        .block-product-info {
            margin-top: 30px;
            float: left;
            width: 100%;
        }

        .block-product-image {
            margin-top: 30px;
            padding: 10px;
            overflow: hidden;
            display: block;
        }

        .block-product-image .product-image {
            overflow: hidden;
        }

        .block-product-info .product-name {
            margin-top: 0;
            font-weight: normal;
            font-size: 20px;
        }

        .media-body {
            text-align: right;
        }



        @media (min-width: 992px) {

            .col-md-1,
            .col-md-10,
            .col-md-11,
            .col-md-12,
            .col-md-2,
            .col-md-3,
            .col-md-4,
            .col-md-5,
            .col-md-6,
            .col-md-7,
            .col-md-8,
            .col-md-9 {
                float: right;
            }

            .wprt-content-box.text-white.bg-about-1 {
                margin-right: 30px;
            }
        }

        .welcome-msg,
        .quick-li li {
            float: right;

        }

        .newsletter-area-two .newsletter-form button {
            border-left: 1px solid #fff3;
            border-right: unset;
        }

        .footer-social ul li:last-child {
            margin-right: 8px;
        }

        .text-end {
            text-align: left !important;
        }

        .header-search-wrap form button {
            border-radius: 22px 0px 0px 22px;
        }

        .flash-sale-item {
            direction: rtl;
        }

        .language-currency-wrapper,
        .headerlinkmenu .links,
        header .ft-content {
            float: left;
        }

        .mobile-menu .navigation li.menu-item-has-children .dropdown-btn {
            position: absolute;
            left: 15px;
            right: auto;
        }

        footer .ft-content {
            text-align: right;
        }

        .styled-icons a {
            color: #333333;
            font-size: 18px;
            height: 32px;
            line-height: 32px;
            width: 32px;
            float: left;
            margin: 5px 7px 5px 0;
            text-align: center;
            -webkit-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .styled-icons a:hover {
            color: #666666;
        }

        .styled-icons.icon-gray a {
            background-color: #eeeeee;
            color: #555555;
            display: block;
            font-size: 18px;
            height: 36px;
            line-height: 36px;
            width: 36px;
        }

        .styled-icons.icon-gray a:hover {
            color: #bbbbbb;
        }

        .styled-icons.icon-gray.icon-bordered a {
            background-color: transparent;
            border: 2px solid #eeeeee;
        }

        .styled-icons.icon-gray.icon-bordered a:hover {
            border: 2px solid #d5d5d5;
        }

        .styled-icons.icon-dark a {
            background-color: #333333;
            color: #eeeeee;
            display: block;
            font-size: 18px;
            height: 36px;
            line-height: 36px;
            width: 36px;
        }

        .styled-icons.icon-dark.icon-bordered a {
            background-color: transparent;
            border: 2px solid #111111;
            color: #111111;
        }

        .styled-icons.icon-dark.icon-bordered a:hover {
            background-color: #111111;
            border-color: #111111;
            color: #fff;
        }

        .styled-icons.icon-bordered a {
            border: 1px solid #777777;
        }

        .styled-icons.icon-bordered a:hover {
            background-color: #777777;
            color: #fff;
        }

        .styled-icons.icon-rounded a {
            border-radius: 3px;
        }

        .styled-icons.icon-circled a {
            border-radius: 50%;
        }

        .styled-icons.icon-sm a {
            font-size: 13px;
            height: 30px;
            line-height: 30px;
            margin: 2px 7px 2px 0;
            width: 30px;
        }

        .styled-icons.icon-md a {
            font-size: 24px;
            height: 50px;
            line-height: 50px;
            width: 50px;
        }

        .styled-icons.icon-lg a {
            font-size: 32px;
            height: 60px;
            line-height: 60px;
            width: 60px;
        }

        .styled-icons.icon-xl a {
            font-size: 60px;
            height: 120px;
            line-height: 120px;
            width: 120px;
        }

        .styled-icons li {
            display: inline-block;
            margin-bottom: 0;
            margin-top: 0;
        }

        .icon-box i {
            display: inline-block;
            font-size: 40px;
        }

        ul.styled-icons.icon-dark.icon-sm.icon-circled i {
            font-size: 17px;
        }

        a.media-left {
            margin-top: 11px;
            margin-right: 13px;
            float: left;
        }

        .media-right,
        .media>.pull-right {
            padding-left: 10px;
        }

        .clearfix:before,
        .clearfix:after,
        .dl-horizontal dd:before,
        .dl-horizontal dd:after,
        .container:before,
        .container:after,
        .container-fluid:before,
        .container-fluid:after,
        .row:before,
        .row:after,
        .form-horizontal .form-group:before,
        .form-horizontal .form-group:after,
        .btn-toolbar:before,
        .btn-toolbar:after,
        .btn-group-vertical>.btn-group:before,
        .btn-group-vertical>.btn-group:after,
        .nav:before,
        .nav:after,
        .navbar:before,
        .navbar:after,
        .navbar-header:before,
        .navbar-header:after,
        .navbar-collapse:before,
        .navbar-collapse:after,
        .pager:before,
        .pager:after,
        .panel-body:before,
        .panel-body:after,
        .modal-header:before,
        .modal-header:after,
        .modal-footer:before,
        .modal-footer:after {
            content: " ";
            display: table;
        }

        .clearfix:after,
        .dl-horizontal dd:after,
        .container:after,
        .container-fluid:after,
        .row:after,
        .form-horizontal .form-group:after,
        .btn-toolbar:after,
        .btn-group-vertical>.btn-group:after,
        .nav:after,
        .navbar:after,
        .navbar-header:after,
        .navbar-collapse:after,
        .pager:after,
        .panel-body:after,
        .modal-header:after,
        .modal-footer:after {
            clear: both;
        }

        .arabiccaptcha {
            text-align: left !important;
            float: right !important;
            margin-left: 10px !important;
            margin-top: 8px !important;
        }

        .embed-responsive-16by9 iframe {
            max-height: 200px;
            width: 50%;
            margin: unset !important;
            margin-right: auto !important;
        }

        .embed-responsive-16by9 {
            padding-bottom: 0;
            overflow: initial;
        }

        ul.styled-icons.icon-dark.icon-sm.icon-circled {
            display: inline-block;
        }

        .vgpc-post-readmoref {
            float: right;
        }

        span.date {
            display: inline-block;
            top: 10px;
            position: absolute;
            right: 13%;
        }

        .hide {
            display: none !important;
        }

        #text-3>div.footer-contact.address>div.ft-contact.fax>p,
        #text-3>div.footer-contact.address>div:nth-child(4)>p {
            direction: ltr;
            text-align: left;
        }

        .top-contact-info li {
            direction: ltr;
        }

        @media (min-width: 768px) {
            .image img {
                max-width: 300px;
                display: inherit;
            }

            .image {
                float: right;
                padding-right: 5px;
                text-align: center;
            }
        }

        @media (max-width: 767px) {
            .header_aera {
                background: #00578fcc;
            }

            .header_aera .navbar-collapse .navbar-nav.navbar-right li a {
                padding: 3px 16px;
            }

            a.nav_searchFrom {
                color: #f6f8f8;
            }

            .navbar-default .navbar-toggle .icon-bar {
                background-color: #f6f8f8;
            }
        }

        .image {
            text-align: center;
        }

        .col-md-2.col-sm-6.galley:hover img {
            -moz-transform: scale(2);
            -webkit-transform: scale(2);
            -o-transform: scale(2);
            -ms-transform: scale(2);
            transform: scale(2);
        }

        .header-nav .nav>li,
        .is-fixed .header-nav .nav>li {
            /*   padding: 0 15px;          */
        }

        .col-md-2.col-sm-6.galley img {
            height: 100%;
            display: block;
            margin: 0;
            width: 100%;
            height: 100%;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0);
            -webkit-box-shadow: 0 0 0 rgba(0, 0, 0, 0);
            -moz-box-shadow: 0 0 0 rgba(0, 0, 0, 0);
            transition: all 0.25s;
            -moz-transition: all 0.25s;
            -webkit-transition: all 0.25s;
            -o-transition: all 0.25s;
        }

        .col-md-2.col-sm-6.galley {
            display: inline-block;
            float: none;
            height: 150px;
            position: relative;
            overflow: hidden;
        }

        ul.styled-icons.icon-dark.icon-sm.icon-circled {
            display: inline-block;
            width: 100%;
        }

        body {
            overflow-x: hidden;
        }

        .clear {
            clear: both;
        }

        <?php if ($pagg != 1) { ?>.header_aera {
            position: initial;
        }

        .our_services_area:before {
            background: none;
        }

        .about_us_area {
            background: none;
        }

        .latest_blog_area {
            margin-bottom: 30px;
        }

        .subtittle,
        .tittle {
            position: relative;
            margin-bottom: 20px;
            border-bottom: 1px dashed #237A57;
            padding-bottom: 10px;
            margin-top: 18px !important;
        }

        .boxed_wrapper {
            position: relative;
            z-index: 1;
        }

        <?php } ?><?php if ($pagg  != 1) {
                    ?>.single-shop-product.col-lg-3.col-md-12 {
            padding: 0;
        }

        .testimonial-4:hover .testimonial-detail {
            margin-top: 0px;
        }

        .site-search-btn {
            color: #26a9df !important;
        }

        .site-header,
        .main-bar {
            position: relative;
        }

        .bg-primary {
            background-color: #ededed !important;
        }

        .tittle {
            /*  max-width: 90%;       */
            margin: auto;
        }

        .page-content {
            min-height: 300px;
        }

        .header-nav .nav>li>a {
            color: #0E3046 !important;
        }

        <?php } ?>.grecaptcha-badge {
            display: none !important;
        }

        .is-fixed .extra-nav {
            padding: 29px 0;
        }

        @media only screen and (max-width: 767px) {
            .col-md-3.col-sm-6.footer-t {
                clear: both;
            }

            .is-fixed .extra-nav {
                padding: 15px 0;
            }

            .main-menu .navbar-header .navbar-toggle {
                margin: 2px 20px 10px;
            }

            .outer-search-box {
                left: 2px;
                right: auto;
            }

            iframe {
                width: 90%;
            }

            .extra-nav {
                display: none;
            }

            i.fa.fa-chevron-down {
                display: none;
            }

            .bg-primary .navbar-toggle .icon-bar {
                background-color: #26a9df;
                color: #26a9df !important;
            }

            .widget.widget_services {
                padding-right: 0px !important;
            }

            a.button_all {
                float: none;
            }
        }

        .subtittle h2 {
            margin-bottom: 0px;
        }

        .wt-post-info.p-a30.p-b20.bg-white {
            padding: 30px;
        }

        .wt-img-effect.zoom-slow:hover img {
            -moz-transform: scale(2);
            -webkit-transform: scale(2);
            -o-transform: scale(2);
            -ms-transform: scale(2);
            transform: scale(2);
        }

        .wt-img-effect.zoom-slow img {
            transition: all 10s;
            -moz-transition: all 10s;
            -webkit-transition: all 10s;
            -o-transition: all 10s;
        }

        .wt-img-effect img {
            display: block;
            margin: 0;
            width: 100%;
            height: 300px;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0);
            -webkit-box-shadow: 0 0 0 rgba(0, 0, 0, 0);
            -moz-box-shadow: 0 0 0 rgba(0, 0, 0, 0);
            transition: all 0.25s;
            -moz-transition: all 0.25s;
            -webkit-transition: all 0.25s;
            -o-transition: all 0.25s;
        }

        .wt-img-effect {
            position: relative;
            overflow: hidden;
            display: block;
        }

        .overlay-s3 {
            background: #0000002b;
        }

        .homepage-gri {
            text-align: center;
        }

        .col-md-3.col-xs-12 {
            display: inline-block;
            float: none;
        }

        .news-section,
        .iq-our-clients,
        .professional_builder,
        .careplus-gallery-full {
            padding: 10px 0;
        }

        .about-company,
        .careplus-gallery-full,
        div#slides,
        section.our_services_area,
        .about_us_area {
            background: #fff;
            padding-top: 1px;
            padding-bottom: 10px;
        }

        .tittle h2 {
            font-size: 30px;
        }

        .subtittle:before,
        .tittle:before {
            position: absolute;
            content: '';
            left: 0;
            bottom: 50%;
            width: 100%;
            height: 4px;
            z-index: 1;
            background: #4f84f9;
            opacity: 1;
        }

        .subtittle h2,
        .tittle h2 {
            display: inline-block;
            padding-right: 5px;
            padding-left: 5px;
            position: relative;
            background: #fff;
            z-index: 9;
            margin-left: 30px;
            font-size: 30px;
            text-transform: capitalize;
            color: #30355d;
            font-weight: bold;
            margin-top: 0;
        }

        .subtittle,
        .tittle {
            border-bottom: none;
            padding-bottom: 0px;
            display: none;
        }

        .navig-img2 img {
            height: 200px;
            width: 100%;
            padding: 5px;
        }

        .navig-img2.row {
            margin-top: 11px;
        }

        .tittle.wow.fadeInUp {
            display: block;
            width: 100%;
            margin-bottom: 30px;
            display: none;
        }

        .button_all {
            display: inline-block;
            border: none;
            font-size: 14px;
            padding: 10px 15px;
            text-transform: uppercase;
            background: #144f3c;
            color: #fff;
            line-height: normal;
            cursor: pointer;
            text-align: center;
            background: #093028;
            background: -webkit-linear-gradient(to right, #237A57, #093028);
            background: linear-gradient(to right, #237A57, #093028);
        }

        #slides>div>div.serv_carosele.row>div>div.row {
            display: block;
        }

        .recent-item {
            transition: all 0.4s cubic-bezier(0.76, 0.1, 0.21, 0.9) 0s;
            width: 100%;
        }

        .recent-item .touching.medium .plus_overlay {
            border-bottom: 50px solid #25622b;
            border-left: 50px solid transparent;
            bottom: 0;
            height: 0;
            opacity: 0.95;
            position: absolute;
            right: 0;
            text-indent: -9999px;
            transition: all 0.2s cubic-bezier(0.63, 0.08, 0.35, 0.92) 0s;
            width: 0;
            z-index: 999;
        }

        .media-body a,
        a.media-left {
            color: #339be9;
        }

        .recent-item:hover .touching.medium .plus_overlay {
            border-bottom: 500px solid rgba(37, 99, 44, 0.69);
            border-left: none;
            height: 100%;
            width: 100%;
        }

        .recent-item:hover .touching.medium .plus_overlay_icon {
            display: none;
        }

        .recent-item .touching.medium .plus_overlay_icon {
            bottom: 10px;
            color: #fff;
            height: 15px;
            position: absolute;
            right: 8px;
            transition: all 0.2s cubic-bezier(0.63, 0.08, 0.35, 0.92) 0s;
            width: 13px;
            z-index: 999;
        }

        .recent-item:hover .item-description {
            display: block;
            left: 0;
            position: absolute;
            top: 35%;
            left: 0;
            width: 100%;
            z-index: 999;
        }

        .touching.medium {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .touching.medium img {
            width: 100%;
            position: relative;
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            -ms-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .recent-item .item-description {
            opacity: 0;
            position: absolute;
            top: 0;
            text-align: center;
        }

        .item-description h5 {
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            line-height: 40px;
            margin: 0;
            text-transform: uppercase;
        }

        .recent-item:hover .item-description {
            transform: scale(1);
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            opacity: 1;
            -webkit-transition: all 0.6s ease-in-out;
            -moz-transition: all 0.6s ease-in-out;
            -o-transition: all 0.6s ease-in-out;
            -ms-transition: all 0.6s ease-in-out;
            transition: all 0.6s ease-in-out;
        }

        .recent-item .item-description span {
            color: #fff;
            font-size: 20px;
            display: block;
            font-weight: 600;
            line-height: 14px;
        }

        .recent-item .option {
            position: absolute;
            text-align: center;
            top: 40%;
            left: 0;
            width: 100%;
            z-index: 9999;
        }

        .recent-item .option a {
            color: #25622b;
            background: #FFF;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-size: 21px;
            line-height: 43px;
            text-align: center;
            display: inline-block;
            zoom: 1;
            -moz-opacity: 0;
            opacity: 0;
            filter: alpha(opacity=0);
            border-radius: 50%;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            z-index: 100;
            transform: scale(0, 0) rotateX(360deg);
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            -ms-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }

        .recent-item .option a:hover {
            background: #25622b;
            color: #fff;
        }

        .recent-item:hover .option a {
            zoom: 1;
            -moz-opacity: 1;
            opacity: 1;
            filter: alpha(opacity=100);
            transform: scale(1, 1) rotateX(0deg);
        }

        .recent-item .option a.hover-zoom {
            margin-right: 1%;
        }

        .recent-item .option a.hover-link {
            margin-left: 1%;
        }

        .inner-page-header {
            background: url(images/back6.jpg) repeat;
            background-size: 100% 100%;
            padding: 40px 0;
            background-attachment: fixed;
            -webkit-transition: .4s;
            position: relative;
            -o-transition: .4s;
            transition: .4s;
            border-bottom: 3px solid #dcdbd7;
            position: relative;
            margin-bottom: 10px;
        }

        .inner-page-header .container {
            position: relative;
            z-index: 2;
        }

        .inner-page-header:after {
            content: "";
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: #092d63e0;
            position: absolute;
            z-index: 1;
        }

        .inner-page-header .header-page-title h2 {
            color: #ffffff;
            margin: 0;
            font-size: 36px;
        }

        .inner-page-header .header-page-locator ul {
            text-align: left;
        }

        .inner-page-header .header-page-locator ul li {
            display: inline-block;
            color: #339be9;
            font-size: 20px;
        }

        .inner-page-header .header-page-locator ul li a {
            color: #ffffff;
            transition: all 0.5s ease 0s;
        }

        .inner-page-header .header-page-locator ul li a:hover {
            color: #339be9;
        }

        @FONT-FACE {
            font-family: "DroidKufi-Regular";
            src: url("css/DroidKufi-Regular.ttf");
        }

        h5.mt-0 {
            margin-bottom: 15px;
        }

        .item .details-area .actions a.addtowishlist.iswish {
            color: #ed1c24;
        }

        button.close {
            float: left;
        }

        #checkout-review-table-wrapper {
            max-height: 420px;
            overflow-y: auto;
            padding-right: 5px;
            padding: 15px;
            border: 1px solid #ddd;
        }

        .opc-wrapper-opc #opc-review-block {
            margin-bottom: 20px;
        }

        .opc-wrapper-opc #opc-review-block h3.review-title {
            color: #404040;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
            line-height: 1;
            padding-bottom: 13px;
            padding-left: 9px;
        }

        .opc-wrapper-opc .opc-data-table tbody td h3 {
            text-align: right;
        }

        .opc-wrapper-opc .opc-data-table {
            width: 100%;
        }

        .opc-wrapper-opc .opc-data-table thead {
            display: none;
        }

        .opc-wrapper-opc .opc-data-table thead th {
            color: #1c1c1c;
            font-size: 13px;
            padding: 8px 0 9px;
            border-bottom: 1px solid #eaeaea;
            font-weight: 700;
        }

        .opc-wrapper-opc .opc-data-table thead th:last-child {
            text-align: right !important;
        }

        .opc-wrapper-opc .opc-data-table thead tr th:last-child {
            padding-right: 0
        }

        .opc-wrapper-opc .opc-data-table tbody td {
            padding: 14px 0;
            border-bottom: 1px solid #eaeaea;
            color: #676767;
            font-size: 12px;
            font-weight: 400;
        }

        .opc-wrapper-opc .opc-data-table tbody td:first-child {
            width: 70%;
            text-align: left;
        }

        .opc-wrapper-opc .opc-data-table tbody td:last-child {
            width: 15%;
            text-align: right;
        }

        .opc-wrapper-opc .opc-data-table tbody td.a-center {
            width: 15%;
            text-align: center;
        }

        .opc-wrapper-opc .opc-data-table td.last {
            padding-right: 0
        }

        .opc-wrapper-opc .opc-data-table tbody td .price {
            color: #676767;
            font-size: 12px;
        }

        .opc-wrapper-opc .opc-data-table tbody td h3 {
            color: #676767;
            font-size: 11px;
            font-weight: 500;
            border: none;
            margin: 0;
            padding: 0;
            line-height: 1.3;
            float: left;
            width: 73%;
            clear: initial;
            display: block;
            margin-left: 2%;
            margin-top: 5px;
        }

        img.checkout-cart-image {
            width: 25%;
            float: left;
            clear: initial;
            display: block;
        }

        .opc-wrapper-opc .opc-data-table tfoot td {
            padding: 14px 0 0;
            padding-right: 10px;
            line-height: 1.4;
            color: #777;
            font-size: 12px;
            font-weight: 500;
            vertical-align: middle;
        }

        .opc-wrapper-opc .opc-data-table tfoot td strong .price {
            color: #3f3f3f;
            font-size: 14px;
        }

        .opc-wrapper-opc .opc-data-table tfoot th {
            padding: 10px 0;
            border-bottom: 1px solid #eaeaea;
            color: #676767;
            font-size: 14px;
            font-weight: normal;
            vertical-align: middle;
        }

        .opc-wrapper-opc .opc-data-table tfoot th strong .price {
            color: #3f3f3f;
            font-size: 14px;
        }

        .opc-wrapper-opc .opc-data-table tfoot tr:last-child td {
            border-bottom: none
        }

        .opc-wrapper-opc .opc-data-table .item-options {
            font-size: 11px
        }

        .opc-wrapper-opc .opc-data-table .cell-label {
            display: none
        }

        .opc-wrapper-opc .opc-data-table .btn-remove img {
            margin-top: 5px;
            width: 10px;
        }

        .opc-wrapper-opc .opc-data-table tfoot tr.last {
            display: none
        }

        .opc-wrapper-opc .opc-data-table .btn-remove {
            display: none
        }

        .opc-wrapper-opc .opc-review-actions .checkout-agreements {
            padding: 0
        }

        .opc-wrapper-opc .opc-review-actions .checkout-agreements li {
            margin: 10px 0
        }

        .opc-wrapper-opc .opc-review-actions .view-agreement {
            text-decoration: none;
            color: #676767;
            font-size: 14px;
            cursor: pointer;
            font-weight: normal;
            padding-top: 5px;
            display: inline-block;
        }

        .opc-index-index .opc-wrapper-opc .opc-review-actions .view-agreement:hover {
            color: #2778c5 !important;
        }

        .opc-wrapper-opc .opc-review-actions .agreement-content {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .checkout-agreements .agree input.checkbox {
            margin-top: 8px !important;
            margin-left: 6px !important;
            display: inline-block;
        }

        .opc-wrapper-opc .opc-review-actions .checkout-agreements li {
            margin: 10px 0;
            list-style: none;
        }

        .opc-wrapper-opc .btn-checkout {
            display: block;
            width: 100%;
            height: 45px;
        }

        .opc-wrapper-opc button {
            background: none !important;
            border: none !important;
            padding: 0;
        }

        h5.grand_total .price {
            float: left;
            margin-right: 10px;
            margin-left: 0;
        }

        .opc-wrapper-opc .btn-checkout span {
            background: #2c9806;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            width: 100%;
            line-height: 46px;
            padding: 0 !important;
            height: 45px;
            padding: 0;
            display: block;
        }

        .block-breadcrumbs {
            float: none;
        }

        .checkout-agreements .agree {
            margin: 0;
            padding: 10px 0 10px 11px;
        }

        .rtl .opc-wrapper-opc .opc-review-actions .agree {
            text-align: right;
            margin-bottom: 6px;
        }

        span.cart-price1 .price {
            color: #e62723;
        }

        .product_img {
            position: relative;
            text-align: center;
        }

        .faq-content-box {
            position: relative;
            display: block;
            text-align: right;
        }

        .accordion-box {
            position: relative;
            display: block;
        }

        .accordion-box .accordion {
            position: relative;
            display: block;
            margin-bottom: 5px;
            border-radius: 0px;
        }

        .accordion-box .accordion .accord-btn {
            position: relative;
            display: block;
            cursor: pointer;
            padding-left: 30px;
            padding-right: 45px;
            padding-top: 12px;
            padding-bottom: 12px;
            transition: all 500ms ease;
            background: #f9f9f9;
            border-radius: 5px;
            box-shadow: inset 0px 4px 3px -2px rgba(0, 0, 0, .04);
            border: 1px solid #dedede80;
            border-color: rgba(0, 0, 0, .08);
        }

        .accordion-box .accordion .accord-content {
            position: relative;
            display: block;
            padding-top: 15px;
            padding-bottom: 10px;
            padding-left: 30px;
            padding-right: 30px;
            display: none;
            background: #fff;
            margin-bottom: 5px;
            border: 1px solid rgba(0, 0, 0, .08);
        }

        .accordion-box .accordion .accord-content p {
            color: #000;
            font-size: 14px;
            line-height: 34px;
            font-weight: 500;
            margin: 0;
        }

        .accordion-box .accordion .accord-btn:before {
            content: "";
            width: 49px;
            height: 100%;
            border-width: 0 1px 0 0;
            border-style: solid;
            position: absolute;
            top: 0;
            z-index: 1;
            border-color: rgba(0, 0, 0, .08);
        }

        .accordion-box .accordion .accord-btn::after {
            font-family: 'fontawesome';
            position: absolute;
            content: "\f067";
            top: 50%;
            right: 20px;
            color: #243d7b;
            font-size: 11px;
            line-height: 20px;
            font-weight: 600;
            text-align: center;
            transform: translateY(-50%);
            transition: all 500ms ease 0s;
            color: rgba(0, 0, 0, .25);
        }

        .accordion-box .accordion .accord-btn h4 {
            color: #333;
            font-size: 16px;
            line-height: 30px;
            font-weight: normal;
            transition: all 500ms ease;
            padding-right: 30px;
        }

        .accordion-box .accordion .accord-btn.active:after {
            content: "\f068";
            color: #0a5d8f;
        }

        .accordion-box .accordion .accord-content .anco {
            font-size: 15px;
            padding: 13px;
            border-radius: 0;
            float: left;
            clear: both;
        }

        /* .btn:not([data-toggle^="dropdown"]) {
            font-size: 15px;
            font-weight: 700;
            text-transform: uppercase;
            line-height: 1em;
            letter-spacing: 0px;
            fill: #13353F;
            color: #13353F;
            background-color: #E8F5F7;
            border-radius: 0;
            padding: 10px;
            transition: all 200ms linear;
            display: inline-block;
        } */

        button#btn {
            background-color: #8cb31a;
            color: #fff;
            margin: 0 10px;
        }

        <?php if (!$plang) {
        ?>.accordion-box .accordion .accord-content .anco {
            float: right;
        }

        .accordion-box .accordion .accord-btn::after {
            left: 20px;
            right: auto;
        }

        .accordion-box .accordion .accord-btn h4 {
            padding-left: 30px;
        }

        .accordion-box .accordion .accord-btn:before {
            left: 0;
        }

        .faq-content-box {
            text-align: left;
        }

        .heart-area,
        .cart-area {
            float: right;
        }

        .dropdown-menu-right,
        .sec-title:after,
        .adress-section .quick-li li:before,
        .service-section ul li:before {
            right: auto;
            left: 0;
        }

        .adress-section ul li {
            padding-left: 15px;
            float: left;
        }

        .service-section ul li {
            padding-left: 15px;
        }

        .slider-items .owl-nav {
            left: auto;
            right: 50px;
        }

        .sec-title h2 {
            margin: 0;
            margin-left: 30px;
        }

        .remove-cart,
        .footer-top .input-box button {
            left: auto;
            right: 0;
        }

        .mini-products-list .product-details {
            margin-left: 80px;
            margin-right: 0px;
            text-align: left;
        }

        .social {
            float: right;
        }

        .footer-t,
        .footer-top .input-box,
        .sec-title,
        .block-breadcrumbs ul li,
        .block-breadcrumbs ul li a {
            float: left;
        }

        h5.grand_total .price,
        .opc-wrapper-opc .opc-data-table tbody td h3 {
            float: right;
        }

        .product-images {
            float: left !important;
        }

        select.cate-dropdown {
            background-position: right 10px center;
        }

        .mini-products-list .product-image,
        .cate-dropdown,
        #search input,
        img.checkout-cart-image,
        .block-product-info .box-qty {
            float: left;
        }

        .top-cart-content .block-subtitle,
        .single-blog-style1 .text-holder .blog-title,
        .single-blog-style1 .text-holder .text,
        .top-subtotal,
        .media-body,
        .cart .totals td,
        .cart-table thead th,
        .opc-wrapper-opc .opc-data-table tbody td h3 {
            text-align: left !important;
        }

        .mini-cart .topCartContent {
            left: auto;
            right: -25px;
        }

        #search button {
            right: 0;
            left: auto;
        }

        .cart .totals button.button>span span:before {
            content: ">>";
            display: inline-block;
            margin-right: 5px;
        }

        .footer-top .input-box button span {
            border-radius: 0 21px 21px 0px;
        }

        button.close {
            float: right;
        }

        .follow-social {
            color: #fff;
            margin-left: 0px;
            margin-right: 15px;
        }

        .footer-top .input-box input {
            padding-left: 20px;
            padding-right: 105px;
        }

        @media screen and (min-width: 992px) {
            .site-header #navbar>ul>li {
                float: left;
                border-left: 0px solid #ffffff1a;
                border-right: 1px solid #ffffff1a;
            }

            .col-md-1,
            .col-md-10,
            .col-md-11,
            .col-md-12,
            .col-md-2,
            .col-md-3,
            .col-md-4,
            .col-md-5,
            .col-md-6,
            .col-md-7,
            .col-md-8,
            .col-md-9 {
                float: left;
            }





            .header-style-1 #navbar .navbar-nav,
            .header-style-2 #navbar .navbar-nav,
            .top-cart-content .product-name {
                text-align: left;
            }

            .site-header #navbar>ul .all-men {
                right: 138px;
            }

            .floe-men a:before {
                content: "\f105";
                float: right;
            }
        }

        @media (min-width: 768px) {
            .navbar-right {
                float: left !important;
                margin-left: -15px;
                margin-right: 0px;
            }
        }

        .cart-table thead th {
            text-align: left;
        }

        .product-extra-link,
        .block-product-info .btn-add-cart {
            float: left;
            margin-left: 15px;
        }

        form#login .text-left {
            text-align: right;
        }

        .top-cart-content .product-name {
            float: left;
            padding-left: 0;
        }

        .cart .cart-collaterals h2 {
            padding: 10px 15px 10px 10px;
        }

        <?php } ?>.bg-about {
            padding: 15px;
            background: #fcfcfc;
            box-shadow: 1px 2px 9px #0000001a;
        }

        <? if ($plang) { ?>@FONT-FACE {
            font-family: "rebuk";
            src: url("css/TAJAWAL-REGULAR.TTF");
        }

        @FONT-FACE {
            font-family: "number";
            src: url("css/TAJAWAL-REGULAR.TTF");
        }

        @FONT-FACE {
            font-family: "poppins";
            src: url("css/TAJAWAL-REGULAR.TTF");
        }

        .brand-area .nay-nav .owl-nav {
            top: -40px;
            right: auto;
            left: 0;
        }

        .more_slide_open>li>a>i,
        .header-category .category-menu>li>a i {
            font-size: 16px;
            margin-left: 10px;
            line-height: 0;
            margin-right: 0;
        }

        .more_slide_open .megamenu,
        .category-menu .megamenu,
        .sub-menu {

            right: 100%;
            left: auto;
            text-align: right;
        }

        .header-category>a i:last-child {
            margin-right: auto;
            margin-left: 0px;
        }

        .header-category>a i:first-child {
            margin-left: 18px;
            margin-right: 0px;
        }

        .header-search-wrap form input {

            border-radius: 0px 22px 22px 0px;

        }

        .header-action>ul li {
            position: relative;
            margin-right: 5px;
        }

        .more_slide_open>li.menu-item-has-children>a::after,
        .category-menu>li.menu-item-has-children>a::after {
            left: 18px;
            right: auto;
            content: "\f104";
        }

        body,
        .product,
        .slider-one__content,
        .shop-by-department .dropdown-toggle {
            text-align: right;
            direction: rtl;
        }

        .shop-by-department .dropdown-toggle i {
            left: 20px;
            right: auto;
        }

        .product-price {
            float: right;
        }

        .shop-by-department .dropdown-toggle {
            padding: 13px 20px 13px 20px;
        }

        .my_cart_subtotal .left {
            float: right;
        }

        .my_cart_subtotal .right {
            float: left;
        }

        .menu-item-container-text {
            float: right;
            padding-right: 40px;
            padding-left: 0px;
        }

        .drop-menu:after {
            content: "\f104";
            left: 0;
            right: auto;
        }

        .section-title h2:before,
        .section-title-s2 h2:before,
        .section-title-s3 h2:before,
        .section-title-s4 h2:before {
            left: auto;
            right: 0;
        }

        .shop-by-department .dropdown-menu a {
            padding: 12px 0px 12px 12px;
            text-align: right;
        }

        .shop-by-department .dropdown-menu li>ul {
            right: 101%;
            left: auto;
        }

        .owl-carousel {
            direction: ltr;
        }

        .title1 {
            padding-left: 0px;
            padding-right: 0px;
        }

        header,
        .navbar_ .nav>li,
        .product-offer-col {
            /* float: right; */
        }

        .ul0 li {
            padding-right: 20px;
            padding-left: 0;
        }

        .ul0 li:after {
            right: 0;
            left: auto;
            content: "\f104";
        }

        .navbar_ .nav>li:first-child {
            margin-left: 20px;
        }

        .my_cart_wrapper {
            float: left;
        }

        .my_cart_icon {
            right: 0;
            left: auto;
        }

        .my_cart_button a {
            padding-right: 70px;
            padding-left: 0px;
        }

        .cuctom-nav .owl-nav,
        .search-form-wrapper a,
        .newsletter-form-wrapper a {
            left: 0px;
            right: auto;
        }

        .product-price-old {
            float: left;
        }

        .search-form-wrapper a,
        .newsletter-form-wrapper a {
            border-radius: 25px 0px 0px 25px;
            -webkit-border-radius: 25px 0px 0px 25px;
        }

        .hello1 {
            float: right;
        }

        .settings1 {
            border-left: 1px solid #e1e1e1;
            border-right: unset;
        }

        .settings1 .dropdown-toggle .caret {
            margin-right: 10px;
            margin-left: 0;
        }

        .lang1 .dropdown-toggle:before {
            background: url(images/arabic.png) 0 0 no-repeat;
            margin-right: 0px;
            margin-left: 5px;
            width: 25px;
            height: 17px;
        }

        .lang1 .dropdown-toggle .caret {
            margin-right: 2px;
        }


        .social-wrapper {
            direction: ltr;
        }

        .social a {
            text-align: left;
        }

        .lang1 .dropdown-menu a.ge:before {
            background: url(images/flag_en.png) 0 0 no-repeat;
            margin-right: 0px;
            margin-left: 5px;
        }

        .top1_block_right {
            float: left;
        }

        .search-form-wrapper .form-control,
        .newsletter-form-wrapper .form-control {
            padding-right: 20px;
            padding-left: 110px;
        }

        @media screen and (min-width: 768px) {
            .site-header #navbar>ul>li {
                float: right;
                border-left: 0px solid #ffffff1a;
                border-right: 1px solid #ffffff1a;
            }

            .col-sm-1,
            .col-sm-2,
            .col-sm-3,
            .col-sm-4,
            .col-sm-5,
            .col-sm-6,
            .col-sm-7,
            .col-sm-8,
            .col-sm-9,
            .col-sm-10,
            .col-sm-11,
            .col-sm-12 .col-md-1,
            .col-md-10,
            .col-md-11,
            .col-md-12,
            .col-md-2,
            .col-md-3,
            .col-md-4,
            .col-md-5,
            .col-md-6,
            .col-md-7,
            .col-md-8,
            .col-md-9 {
                float: right;
            }
        }





        .fa,
        .fab,
        .fal,
        .far,
        .fas {
            line-height: inherit;
        }



        .service1 figure {

            float: right;
            margin-left: 15px;
            margin-right: 0;

        }

        .navbar_ .nav>li>a {
            text-align: right;
        }

        .navbar-default .sub-menu .sub-nav-toggler {
            right: auto;
            left: 15px;
        }

        .owl-carousel .owl-nav,
        .my_cart_popup {
            right: auto;
            left: 0;
        }

        .cli-sear {
            right: auto;
            left: 10px;
        }


        .block-product-info .variations-table td,
        .block-product-info .variations-table .table-label,
        .navbar_ .navbar-toggle {
            float: right;
        }


        .slider-one__content p {
            letter-spacing: 0;
        }

        .cards {
            text-align: right;
        }


        .magnifier {
            direction: ltr;
        }

        .cloudzoom-zoom {
            right: calc(100% + 15px) !important;
            left: auto !important;
        }



        @media (max-width: 767px) {
            .menu-item-container-text {

                float: none;
                width: auto;
                padding: 0;

            }

            .block-breadcrumbs ul li {
                border-left: 1px solid #eee;
                padding-left: 8px;
                padding-right: 8px;
                width: 50%;
            }

            .block-breadcrumbs ul li span {
                display: none;
            }

            .block-breadcrumbs ul li:nth-child(even) {
                border-left: 0;
            }

        }



        <?php } ?>select.cate-dropdown {
            padding-right: 18px;
        }

        .mini-products-list .product-details {
            direction: ltr;
        }

        input.input-text {
            min-width: auto;
            color: #000;
        }

        @media screen and (min-width: 992px) {

            .header-style-1 #navbar,
            .header-style-2 #navbar,
            .header-style-2 #navbar {
                position: unset
            }

            .site-header #navbar>ul .sub-menu {
                min-width: 660px;
                width: 100%;
                left: 0;
                right: 0;
                max-height: 370px;
                overflow: overlay;
                overflow: auto;
            }

            .site-header #navbar>ul>li>.sub-menu>.menu-item-has-children>a {
                color: #8cb31a;
                /*   font-weight: 600; */
                font-size: 13px;
            }

            .site-header #navbar>ul .sub-menu::-webkit-scrollbar {
                width: 3px;
            }

            .site-header #navbar>ul>li>.sub-menu .sub-menu {
                right: 0;
                height: 140px;
            }

            .site-header #navbar>ul .sub-menu::-webkit-scrollbar-track {
                /*    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
*/
                border-radius: 10px;
            }

            .site-header #navbar>ul .sub-menu::-webkit-scrollbar-thumb {
                border-radius: 10px;
                -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
            }

            .menu-ien {
                width: 24.333%;
            }
        }



        <? if ($pagg != 1) { ?>span.product-price.price_display {
            float: none;
        }

        .main-content-inner {
            padding-top: 0;
        }

        .product-price {
            float: none;
        }

        .product-info-stock-sku .stock .label {
            padding: 5px;
        }

        span.label.label-info {
            display: none;
        }

        .block-product-info .product-name {
            padding: 0px;
        }

        /*
        .product {

            height: 320px;
        }
*/

        <? } ?>.block-breadcrumbs {
            margin-top: 10px;
        }

        .large-image img {
            border: 1px solid #ddd;
        }

        .large-image {
            border: none;
        }

        p.agree {
            display: flex;
        }

        .checkout-agreements .agree input.checkbox {
            margin-left: unset !important;
            margin-<?= plang("left", "right") ?>: 6px !important;
        }

        span.label.label-warning {
            margin-<?= plang("right", "left") ?>: 10px;
        }

        .social li {
            text-align: unset;
        }

        .abt-first {
            padding: 0px 0;
        }

        button#btn {
            background-color: #fcca0d;
            color: #000;
            margin: 0 10px;
        }

        .cart-table-wrap {
            padding: 15px;
            background: #fcfcfc;
            box-shadow: 1px 2px 9px #0000001a;
        }

        .section-title h2:before,
        .section-title-s2 h2:before,
        .section-title-s3 h2:before,
        .section-title-s4 h2:before {
            background: #19549f;

        }

        .social a.nav5 {
            background: #4cd64e;
        }

        .social-wrapper {
            top: 5px;
        }

        #st-1 {
            z-index: 0 !important;
        }

        .form-group.pull-left4 {
            margin-top: 20px;
        }
    </style>
</head>

<body class="home-body">
    <!-- header-area -->
    <header>



        <div class="header-top">


            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-5  col-sm-6 hidden-xs welcome text-center">

                        <div class="welcome-msg "> <?= getValue('header_text', $lang) ?> <? if (!$_Login) { ?>
                                <a href="<?= $core->getPageUrl("login") ?>"><?= $core->pageTitle ?></a> <?= plang('او', 'or') ?> <a href="<?= $core->getPageUrl("register") ?>"><?= $core->pageTitle ?></a>
                            <? } ?>
                        </div>
                    </div>


                    <div class="headerlinkmenu col-lg-6 col-md-7 col-sm-6 col-xs-12 text-center">





                        <div class="language-currency-wrapper">


                            <div class="block block-language">
                                <a href="index<?= plang("", "arabic") ?>.php" title="Arabic"> <img src="images/<?= plang("english", "arabic") ?>.png" alt="flag" style="width: 17px;height: 17px;"> <span><?= plang("English", "Arabic") ?></span> </a>
                            </div>

                        </div>



                        <div class="links">
                            <div class="login">
                                <? if (!$_Login) { ?>
                                    <a href="<?= $core->getPageUrl("login") ?>" title="<?= $core->pageTitle ?>"><i class="fal fa-unlock"></i><span><?= $core->pageTitle ?></span></a>
                                <? } else { ?>
                                    <a href="<?= $core->getPageUrl("index", "?logout=1") ?>"><i class="fal fa-unlock"></i><span><?= getTitle("logout") ?></span></a>
                                <? } ?>

                            </div>
                            <? if ($_Login) { ?>


                                <div class="myaccount"><a title="My Account" href="<?= $core->getPageUrl("account") ?>"><i class="fal fa-user"></i><span><?= $core->pageTitle ?></span></a></div>
                            <? } ?>



                        </div>

                    </div>
                </div>
            </div>
        </div>



        <div class="header-search-area style-two">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-3">
                        <div class="logo">
                            <a href="<?= $core->getPageUrl("index") ?>"><img src="images/logo.png" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="d-block d-sm-flex align-items-center justify-content-end">
                            <div class="header-search-wrap deck-just">
                                <form method="post" action="<?= $core->getPageUrl("products") ?>">
                                    <input type="text" name="name" placeholder="<?= plang("ابحث هنا", "Search Here") ?>" />
                                    <select class="custom-select" name="cat">
                                        <option selected=""><?= plang('كل التصنيفات', 'All categories') ?></option>
                                        <?php
                                        $data = $core->getCat(array());
                                        if ($data)
                                            for ($i = 0; $i < count($data); $i++) {
                                                if ($data[$i]["level"]) {
                                                    continue;
                                                }
                                                $data2 = $core->getCat(array("level" => $data[$i]["id"]));
                                        ?>
                                            <option value="<?= $data[$i]["id"] ?>">
                                                <?= $data[$i]["name" . $clang] ?>
                                            </option>
                                        <? } ?>
                                    </select>
                                    <button type="submit"><i class="fal fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3">


                        <div class="ft-content">
                            <i class="fal fa-phone"></i>
                            <span><?= plang('الدعم', 'Support') ?></span>

                            <h4 class="number text-white"><a href="tel:<?= getValue('mobilepage') ?>"><?= getValue('mobilepage') ?></a></h4>

                        </div>



                    </div>
                </div>
            </div>
        </div>
        </div>
        <div id="sticky-header" class="menu-area style-two">
            <div class="container">
                <div class="row">
                    <div class="col-12">


                        <div class="mobile-nav-toggler"><i class="fal fa-bars"></i></div>



                        <div class="menu-wrap">
                            <nav class="menu-nav">
                                <div class="logo d-none">
                                    <a href="#"><img src="images/wlogo.png" alt="" /></a>
                                </div>
                                <div class="header-category">
                                    <a href="#" class="cat-toggle">
                                        <i class="fal fa-bars"></i>
                                        <?= plang('تصفح التصنيفات', 'Browse Categories') ?>
                                        <i class="fal fa-angle-down"></i>
                                    </a>
                                    <ul class="category-menu" style="<?= ($pagg != 1 ? 'display: none;' : "") ?>">
                                        <?php
                                        $data = $core->getCat(array());
                                        $index = 0;
                                        if ($data)
                                            for ($i = 0; $i < count($data); $i++) {
                                                if ($data[$i]["level"]) {
                                                    continue;
                                                }

                                                // if ($index >= 3)
                                                //     break;
                                                $data2 = $core->getCat(array("level" => $data[$i]["id"]));
                                        ?>
                                            <li class="<?= ($data2 ? "menu-item-has-children" : "") ?>">
                                                <a href="<?= $core->getPageUrl("products", "?cat=" . $data[$i]["id"]) ?>">
                                                    <i class="fal <?= $data[$i]["icon"] ?>"></i>
                                                    <?= $data[$i]["name" . $clang] ?>
                                                </a>
                                                <? if ($data2) { ?>
                                                    <ul class="megamenu">
                                                        <? for ($y = 0; $y < count($data2); $y++) {
                                                            $data3 = $core->getCat(array("level" => $data2[$y]["id"]));  ?>
                                                            <li class="<?= ($data3 ? "dropdown" : "") ?>">
                                                                <a href="<?= $core->getPageUrl("products", "?cat=" . $data2[$y]["id"]) ?>" target="_self">
                                                                    <?= $data2[$y]["name" . $clang] ?>
                                                                </a>
                                                                <? if ($data3) { ?>
                                                                    <ul class="list-inline sub-menu">
                                                                        <? foreach ($data3 as $k => $v) { ?>
                                                                            <li>
                                                                                <a href="<?= $core->getPageUrl("products", "?cat=" . $v["id"]) ?>" target="_self">
                                                                                    <?= $v["name" . $clang] ?>
                                                                                </a>
                                                                            </li>
                                                                        <? } ?>
                                                                    </ul>
                                                                <? } ?>
                                                            </li>
                                                        <? } ?>

                                                    </ul>
                                                <? } ?>
                                            </li>
                                        <? } ?>
                                    </ul>
                                </div>
                                <div class="navbar-wrap main-menu d-none d-lg-flex">
                                    <ul class="navigation">
                                        <li><a href="<?= $core->getPageUrl("index") ?>"><?= $core->pageTitle ?></a></li>
                                        <!-- <li class=""><a href="">About Us</a></li> -->



                                        <li class="menu-item-has-children"><a href="<?= $core->getPageUrl("products") ?>"><?= $core->pageTitle ?></a>



                                            <ul class="submenu">

                                                <?php
                                                $data = $core->getCat(array());
                                                $index = 0;
                                                if ($data)
                                                    for ($i = 0; $i < count($data); $i++) {
                                                        if ($data[$i]["level"]) {
                                                            continue;
                                                        }

                                                        // if ($index >= 3)
                                                        //     break;
                                                        $data2 = $core->getCat(array("level" => $data[$i]["id"]));
                                                ?>
                                                    <li class="<?= ($data2 ? "menu-item-has-children" : "") ?>">
                                                        <a href="<?= $core->getPageUrl("products", "?cat=" . $data[$i]["id"]) ?>">
                                                            <i class="fal <?= $data[$i]["icon"] ?>"></i>
                                                            <?= $data[$i]["name" . $clang] ?>
                                                        </a>
                                                        <? if ($data2) { ?>
                                                            <ul class="submenu">
                                                                <? for ($y = 0; $y < count($data2); $y++) {
                                                                    $data3 = $core->getCat(array("level" => $data2[$y]["id"]));  ?>
                                                                    <li class="<?= ($data3 ? "dropdown" : "") ?>">
                                                                        <a href="<?= $core->getPageUrl("products", "?cat=" . $data2[$y]["id"]) ?>" target="_self">
                                                                            <?= $data2[$y]["name" . $clang] ?>
                                                                        </a>
                                                                        <? if ($data3) { ?>
                                                                            <ul class="list-inline sub-menu">
                                                                                <? foreach ($data3 as $k => $v) { ?>
                                                                                    <li>
                                                                                        <a href="<?= $core->getPageUrl("products", "?cat=" . $v["id"]) ?>" target="_self">
                                                                                            <?= $v["name" . $clang] ?>
                                                                                        </a>
                                                                                    </li>
                                                                                <? } ?>
                                                                            </ul>
                                                                        <? } ?>
                                                                    </li>
                                                                <? } ?>

                                                            </ul>
                                                        <? } ?>
                                                    </li>
                                                <? $index++;
                                                    } ?>
                                            </ul>
                                        </li>

                                        <?php
                                        $data = $core->getPages(array());
                                        if ($data)
                                            for ($i = 0; $i < count($data); $i++) {
                                                if (!$data[$i]["menu"])
                                                    continue;
                                        ?>
                                            <li><a href="<?= $core->getBlogUrl(array($data[$i]["id"], $data[$i]["name"]), "page") ?>"><?= $data[$i]["name" . $clang] ?></a></li>
                                        <? } ?>
                                        <li><a href="<?= $core->getPageUrl("news") ?>"><?= $core->pageTitle ?></a></li>
                                        <li><a href="<?= $core->getPageUrl("contact") ?>"><?= $core->pageTitle ?></a></li>
                                        <!-- <li class=""><a href="">News</a></li>
                                        <li><a href="#">Careers</a></li>
                                        <li class=""><a href="">Contact us</a></li> -->
                                    </ul>
                                </div>



                                <div class="header-action">
                                    <ul>
                                        <li class="header-shop">
                                            <a href="<?= $core->getPageUrl("wishlist") ?>"><i class="fal fa-heart"></i></a>
                                        </li>
                                        <li id="cartlist" class="header-shop offcanvas-toggle">
                                            <?
                                            $on = 1;
                                            include "inc/cart.php";
                                            ?>
                                        </li>
                                        <!-- <li class="header-shop offcanvas-toggle">
                                            <a href="#offcanvas-cart">
                                                <i class="flaticon-shopping-bag"></i>
                                                <span class="cart-count">3</span>
                                            </a>
                                        </li> -->

                                    </ul>
                                </div>



                            </nav>
                        </div>
                        <!-- Mobile Menu  -->
                        <div class="mobile-menu">
                            <nav class="menu-box">
                                <div class="close-btn"><i class="fal fa-times"></i></div>




                                <div class="header-search-wrap mobile-search">
                                    <form method="post" action="<?= $core->getPageUrl("products") ?>">
                                        <input type="text" name="name" placeholder="<?= plang("ابحث هنا", "Search Here") ?>" />
                                        <select class="custom-select" name="cat">
                                            <option selected=""><?= plang('كل التصنيفات', 'All categories') ?></option>
                                            <?php
                                            $data = $core->getCat(array());
                                            if ($data)
                                                for ($i = 0; $i < count($data); $i++) {
                                                    if ($data[$i]["level"]) {
                                                        continue;
                                                    }
                                                    $data2 = $core->getCat(array("level" => $data[$i]["id"]));
                                            ?>
                                                <option value="<?= $data[$i]["id"] ?>">
                                                    <?= $data[$i]["name" . $clang] ?>
                                                </option>
                                            <? } ?>
                                        </select>
                                        <button><i class="fal fa-search"></i></button>
                                    </form>
                                </div>


                                <div class="nav-logo">
                                    <a href="#"><img src="images/logo.png" alt="" title="" /></a>
                                </div>

                                <div class="menu-outer">
                                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                </div>
                                <div class="social-links">
                                    <ul class="clearfix">
                                        <li>
                                            <a href="<?= getValue("twitter") ?>" target="_blank"><span class="fab fa-twitter"></span></a>
                                        </li>
                                        <li>
                                            <a href="<?= getValue("facebook") ?>" target="_blank"><span class="fab fa-facebook-f"></span></a>
                                        </li>
                                        <li>
                                            <a href="<?= getValue("pinterest") ?>" target="_blank"><span class="fab fa-pinterest-p"></span></a>
                                        </li>
                                        <li>
                                            <a href="<?= getValue("instagram") ?>" target="_blank"><span class="fab fa-instagram"></span></a>
                                        </li>
                                        <li>
                                            <a href="<?= getValue("youtube") ?>" target="_blank"><span class="fab fa-youtube"></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-backdrop"></div>
                        <!-- End Mobile Menu -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area-end -->


    <!-- OffCanvas Cart Start -->
    <span id="cartlist2">
        <?
        $on = 0;
        include "inc/cart.php";
        ?>
    </span>
    <!-- OffCanvas Cart End -->

    <div class="offcanvas-overlay"></div>

    <!-- main-area -->
    <main>
        <? if ($pagg == 1) include "inc/slider.php" ?>


        <!-- <? if ($pagg != 1 && $pagg != 4) {
                ?>
                <div id="content">
                    <?
                    if (!$id)
                        $id = 0;
                    $ads = $core->getData("ads", "where active=1 and (selection =2 || selection =$id ) ");
                    if ($ads) { ?>
                        <div class=" container">
                            <div class="banner banner1"><a href="<?= $ads[0]["link"] ?>"><img src="images/<?= $ads[0]["image"] ?>" alt="" class="img-responsive"></a></div>
                        </div>
                </div>
        <? }
                } ?> -->