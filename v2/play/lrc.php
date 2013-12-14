<?php
/*
 * 本来准备将sogou的歌词 也整合合进来
 * 本地测试都完成了  上传到网上出错
 * 慢慢的检测发现是 SOgou会弹出验证码页
 */
error_reporting(0);
$title = urldecode($_REQUEST[title]);
$name = explode('-', $title);
$size = sizeof($name);
$lrc = baidu_lrc($name[0], $name[1]);
if (!$lrc) {
	$lrc = qq_lrc($title);
}
if (!$lrc) {
	$lrc = "[ti:抱歉，未检索到歌词]";
}
echo $lrc;
function file_data($url) {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$ch = curl_init();
	$reff = 'http://box.zhangmen.baidu.com/';
	$timeout = 8;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, $reff);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

function qq_lrc($name) {
	$url = 'http://portalcgi.music.qq.com/fcgi-bin/music_mini_portal/cgi_mini_portal_search_json.fcg?search_input=' . urlencode($name) . '&start=1&return_num=20&utf8=0&outputtype=1';
	$str = file_data($url);
	if (preg_match('|songID":([0-9]+),"|U', $str, $lrcid)) {
		//如果匹配到歌曲ID 则执行 否则返回失败
		$lrcurl = 'http://portalcgi.music.qq.com/fcgi-bin/music_download/fcg_get_lyric.fcg?id=' . $lrcid[1];
		$lrcstr = file_data($lrcurl);
		if (strlen($lrcstr) < 100) {
			return;
		} else {
			return lrc_th($lrcstr);
		}
	} else {
		return;
	}
}
function baidu_lrc($songname, $singername) {
	if (!empty ($singername)) {
		//如果歌手不为空 则调用百度掌门LRC
		$lrcurl = 'http://box.baidu.com/x?op=12&count=1&mtype=1&title=' . urlencode($songname) . '$$' . urlencode($singername) . '$$$$&f=zmpage&.r=' . rand();
		$lrcstr = file_data($lrcurl);
		preg_match('|<lrcid>([0-9]+)<|', $lrcstr, $lrcid);
		$iid = substr($lrcid[1], 0, -2);
		$lrc = 'http://box.baidu.com/bdlrc/' . $iid . '/' . $lrcid[1] . '.lrc';
		$str = file_data($lrc);
	} else {
		return;
	}
	if (empty ($str)) {
		return;
	} else {
		return lrc_th($str);
	}

}
function lrc_th($str) {
	$str = preg_replace("@(\w+)?\.?(\w+)\.(com|org|info|net|cn|biz|cc|uk|tk|jp|la|ru|us|ws)@U", 'i.huamengnet.com', $str);
	// 替换域名
	$str = preg_replace("@\[by:\s?([^\]]+)\]@U", '[by:酷爱音乐]', $str);
	//替换歌词制作者
	$str = preg_replace("@(\d+){5,11}@", '943271422', $str);
	//替换5位以上的数字为QQ
	$str = preg_replace("@编辑\s?：?:?\s?([^\[]+)\[@", '编辑：酷爱音乐[', $str);
	//替换编辑者
	return $str;
}
?>

