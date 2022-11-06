<?php
if($cach){
// Cache the contents to a cache file
$cached = fopen($cachefile, 'w');
$html = ob_get_contents();
$html = sanitize_output($html);
//$html = TinyMinify::html(ob_get_contents());
fwrite($cached, $html);
//fwrite($cached,ob_get_contents());
fclose($cached);
ob_end_flush(); // Send the output to the browser
}
?>