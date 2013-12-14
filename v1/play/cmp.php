<?php
if($_GET['id'] == 1)
{
echo '
<cmp 
	name = "T2音狮·驾驭我的音乐时尚！" 
	link = "http://t2.huamengnet.com" 
	description = "T2音狮·驾驭我的音乐时尚！ - http://t2.huamengnet.com/"
	logo = ""
	
	skins = "skins/skin.swf"
	plugins = "plugins/qiyi.swf,plugins/tudou.swf,plugins/announce.swf,plugins/krc.swf"
	bgcolor = "#FFFFFF"
	lists = ""
	
	src_handler = "" 
	lrc_handler = "krc.php?title={label}"

	skin_id = "1"

	play_id = ""
	auto_play = "1"
	play_mode = "repeat"
	list_delete = ""
	context_menu = "0"
	bg_video="{src:t2logo.png,xywh:[0C,,0C,300,60]}"
	sound_sample = "true"
	mixer_displace = "true"
	mixer_filter = "true"
	
	announce_content = "---"
announce_xywh = "0,0,100P,20"
announce_speed = "1"
	
	counter = ""
	server="http://uu.xuanlvzhu.com/uploads/userup/"
	tudou_url = "http://v2.tudou.com/v2/cdn?id="
	qiyi_url = "http://cache.video.qiyi.com/v/"

/>';        
}elseif($_GET['id'] == 2)
{
echo '
<cmp 
	name = "T2音狮·驾驭我的音乐时尚！" 
	link = "http://t2.huamengnet.com" 
	description = "T2音狮·驾驭我的音乐时尚！ - http://t2.huamengnet.com/"
	logo = ""
	
	skins = "skins/beveled.swf"
	plugins = "plugins/qiyi.swf,plugins/tudou.swf,plugins/krc.swf"
	bgcolor = "#FFFFFF"
	lists = ""
	
	src_handler = "" 
	lrc_handler = "krc.php?type={type}&title={label}&rd={rd}"

	skin_id = "1"

	play_id = ""
	auto_play = "1"
	play_mode = "repeat"
	list_delete = ""
	context_menu = "0"
	bg_video="{src:t2logo.png,xywh:[0C,,0C,300,60]}"
	sound_sample = "true"
	mixer_displace = "true"
	mixer_filter = "true"
	
	announce_content = " "
announce_xywh = "0,0,100P,20"
announce_speed = "1"
	
	counter = ""
	server="http://uu.xuanlvzhu.com/uploads/userup/"
	tudou_url = "http://v2.tudou.com/v2/cdn?id="
	qiyi_url = "http://cache.video.qiyi.com/v/"

/>';        
}elseif($_GET['id'] == 3)
{
echo '
<cmp 
	name = "T2音狮·驾驭我的音乐时尚！" 
	link = "http://t2.huamengnet.com" 
	description = "T2音狮·驾驭我的音乐时尚！ - http://t2.huamengnet.com/"
	logo = ""
	
	skins = "skins/mv.swf"
	plugins = "plugins/qiyi.swf,plugins/tudou.swf,plugins/krc.swf"
	bgcolor = "#FFFFFF"
	lists = ""
	
	src_handler = "" 
	lrc_handler = "krc.php?type={type}&title={label}&rd={rd}"

	skin_id = "1"

	play_id = ""
	auto_play = "1"
	play_mode = "repeat"
	list_delete = ""
	context_menu = "0"
	bg_video="{src:t2logo.png,xywh:[0C,,0C,300,60]}"
	sound_sample = "true"
	mixer_displace = "true"
	mixer_filter = "true"
	
	announce_content = " "
announce_xywh = "0,0,100P,20"
announce_speed = "1"
	
	counter = ""
	server="http://uu.xuanlvzhu.com/uploads/userup/"
	tudou_url = "http://v2.tudou.com/v2/cdn?id="
	qiyi_url = "http://cache.video.qiyi.com/v/"

/>';        
}elseif($_GET['id'] == 5)
{//会员列表
echo '
<cmp 
	name = "T2音狮·驾驭我的音乐时尚！" 
	link = "http://t2.huamengnet.com" 
	description = "T2音狮·驾驭我的音乐时尚！ - http://t2.huamengnet.com/"
	logo = ""
	
	skins = "skins/beveled.swf"
	plugins = "plugins/qiyi.swf,plugins/tudou.swf,plugins/announce.swf,plugins/krc.swf"
	bgcolor = "#FFFFFF"
	lists = ""
	
	src_handler = "" 
	lrc_handler = "krc.php?type={type}&title={label}&rd={rd}"

	skin_id = "1"

	play_id = ""
	auto_play = "0"
	play_mode = "0"
	list_delete = "1"
	context_menu = "0"
	bg_video="{src:t2logo.png,xywh:[0C,,0C,300,60]}"
	sound_sample = "true"
	mixer_displace = "true"
	mixer_filter = "true"
	
	announce_content = "暂无公告"
	announce_xywh = "0,0,100P,20"
	announce_speed = "1"
	
	counter = ""
	server="http://uu.xuanlvzhu.com/uploads/userup/"
	tudou_url = "http://v2.tudou.com/v2/cdn?id="
	qiyi_url = "http://cache.video.qiyi.com/v/"
	src_url = "http://web.huamengnet.com/play/member_list.php?song_id="

/>';        
}

else
{
echo "<html>
<head>
<meta http-equiv='refresh' content='3;url=http://web.huameng.net/'>
<title></title>
</head>
<body style='text-align:center'>
<h1>404:您访问的页面不存在，正在为您转入首页...</h1>
</body>
</html>";
}
?>
