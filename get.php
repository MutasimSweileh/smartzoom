<?php
@ob_start();
@session_start();
include('inc/TinyMinify.php');
include('inc/top-cache.php');
include_once ("classes/core.php");
$core = new core;
$grep = new DoMDocument();
@$grep->loadHTMLFile("sheet001.htm");
$tr = $grep->getElementsByTagName('tr');
//echo $tr->length;
$last_id = 0;
for ($i = 4; $i < $tr->length; $i++) {
 $td =  $tr[$i]->getElementsByTagName('td');
 $t = trim($td[1]->textContent);
 $t = str_replace(array("&nbsp;"," "),"",$t);
 if($t){
     $name = (trim(str_replace(array("&nbsp;"," "),"",$td[3]->textContent))?$td[3]->textContent:$td[4]->textContent);
    $name = trim(str_replace(array("&nbsp;"," "),"",$name));
     $img = $td[2]->getElementsByTagName("img");
     if($img && $img->length > 0)
     $img = $img[0]->getAttribute("src");
     else
     $img = "";
     $data = array();
     $data["id"] = $t;
     $data["name"] = (trim($name)?(trim($name)):$t);
     $data["name_arabic"] = (trim($name)?(trim($name)):$t);
     $data["active"] = 1;
     if(trim($name)){
     $data["level"] = $last_id;
     $data["image"] = $img;
     $data["price"] = 20;
     $data["hot_water"] = (strpos($td[6]->textContent,"√") !== false?1:0);
     $data["fridge"] = (strpos($td[5]->textContent,"√") !== false?1:0);
     $data["package_type"] = $td[7]->textContent;
     $data["wight"] = $td[8]->textContent;
     $data["height"] = $td[9]->textContent;
     $data["width"] = $td[10]->textContent;
     $sql =  $core->SqlIn("products",$data);
     }else{
     $sql =  $core->SqlIn("categories",$data);
     $last_id =  $sql;  }
 }else continue;
}
