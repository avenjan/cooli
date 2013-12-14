<?php
/*
 * ����׼����sogou�ĸ�� Ҳ���ϺϽ���
 * ���ز��Զ������  �ϴ������ϳ���
 * �����ļ�ⷢ���� SOgou�ᵯ����֤��ҳ
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
	$lrc = "[ti:��Ǹ��δ���������]";
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
		//���ƥ�䵽����ID ��ִ�� ���򷵻�ʧ��
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
		//������ֲ�Ϊ�� ����ðٶ�����LRC
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
	// �滻����
	$str = preg_replace("@\[by:\s?([^\]]+)\]@U", '[by:�ᰮ����]', $str);
	//�滻���������
	$str = preg_replace("@(\d+){5,11}@", '943271422', $str);
	//�滻5λ���ϵ�����ΪQQ
	$str = preg_replace("@�༭\s?��?:?\s?([^\[]+)\[@", '�༭���ᰮ����[', $str);
	//�滻�༭��
	return $str;
}
?>

