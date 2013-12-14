<?php
$song_id = $_GET['song_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>歌曲联播 - KUAI音乐</title>
<meta name="copyright" content="CopyRight (c) 2012 huamengnet.com. All Rights Reserved." />
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="/templets/default/style/dedecms.css" rel="stylesheet" media="screen" type="text/css" />
<link href="/templets/default/style/music.css" rel="stylesheet" media="screen" type="text/css" />

<link href="css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/cmp.js"></script>
<script type="text/javascript"> 
var cmpo;
function cmploaded(key) {
	cmpo = CMP.get("cmp");
	if (!cmpo) {
		showMsg("未能加载播放器");
		return;	
	}
	showMsg("播放器初始化完成");
	if(cmpo){
        document.title=cmpo.config("name");
        cmpo.addEventListener("model_start","cmp_model_start")
    }
	//播放器事件
	cmpo.addEventListener("model_start", "startHandler");
	cmpo.addEventListener("model_state", "stateHandler");
	cmpo.addEventListener("model_error", "errorHandler");
	cmpo.addEventListener("lrc_complete", "lrcHandler");
	cmpo.addEventListener("view_stop", "viewstopHandler");
}
function showCmp() {
	var vars = {
		api : "cmploaded",
		name : "歌曲联播-KUAI音乐",
		list_delete:"1",
		auto_play:"1",
		play_id:"1",
		plugins :"",
		skin_id:"1",
		php:5,
		lists:"list.php?song_id=<?php echo $song_id ;?>"
	};
	var htm = CMP.create("cmp", "100%", "100%", "player.swf",vars, {wmode:"transparent"});
	//,vars, true); 非透明
	$(".player").html(htm);
}
$(document).ready(function(){
	showCmp();
	//showMenu();
	$(".button div").hover(function(){
		$(this).addClass("button_item_hover");
	}, function(){
		$(this).removeClass("button_item_hover");
	});
}); 
function clearMusic() {
	if (cmpo) {
		//覆盖一个空列表
		cmpo.list_xml('<list></list>', false);
		//showWin("list");
		showMsg("已经清除列表内容");
	}
	else 
	{
		showMsg("播放器还未初始化", true);
	}
}
function loadMusic() 
{
	if (cmpo) 
	{
		//覆盖一个空列表
		cmpo.list_xml('<list></list>', false);
		//加载一个新列表
		cmpo.config("lists", "list.php?song_id=<?php echo $song_id ?>");
		
        cmpo.addEventListener("list_change", "cmp_list_change");
        cmpo.sendEvent("list_load");
       	showMsg("加载成功");
	}else 
	{
		showMsg("播放器还未初始化", true);
	}
}
function cmp_list_change() {
	if (cmpo) {
		cmpo.removeEventListener("list_change", "cmp_list_change");
		cmpo.sendEvent("view_play", 1);
	}
}
function showMsg(str, red)
 {
	if (str)
	{
		$(".loadinginfo").html(str);
		if (red) {
			$(".loadinginfo").addClass("red");
		} else {
			$(".loadinginfo").removeClass("red");
		}
	}
}
function cmp_model_start(data) 
{
  $("#commentform").hide();
  $("#mContent").html("<div class='content'>&nbsp;&nbsp;歌曲信息加载中...</div>");
  $("#aid").val(cmpo.item().aid);
  LoadCommets(1);
	var title = "正在播放：<a href=http://web.huamengnet.com/plus/view.php?aid="+cmpo.item().aid+" target='_blank' class=fa>"+cmpo.item("label")+"</a>";
	$(".mtitle").html(title);
	loadContent();
	$("#commentform").show();
}

function loadContent() {
    $.ajax({
        url:"get.php?song_id="+cmpo.item().aid,
        type:"get",
        success:function(data){
        $("#mContent").html(data);
        }
    });
}

function stateHandler(data) {
	//showMsg(data);
	if (data == "playing") parent.window.document.title = "正在播放 " + cmpo.item("label");
	//if (data == "playing") parent.window.document.title = "正在播放 " + cmpo.item("label")+ " - " + cmpo.config("name");
	if (data == "paused")  parent.window.document.title = "暂停播放 " + cmpo.item("label");
	if (data == "buffering") parent.window.document.title = "正在缓冲 " + cmpo.item("label");
}
//按停止播放时
function viewstopHandler(data) {
	parent.window.document.title = "停止播放 - " + cmpo.config("name");
}
</script>
</head>
<body>
<!--[if lte IE 6]>
<div id="ie6_warning">提示：您正在使用的浏览器版本太低，部分功能可能无法正常使用。请升级 <a href="/windows.microsoft.com/zh-CN/internet-explorer/downloads/ie">Internet Explorer</a> 或使用 <a href="/www.google.com/chrome/">Google Chrome</a> 浏览器。</div>
<![endif]-->
<div class="header_top">  
    <div class="w960 center">  
     <span id="time" class="time">KuAi音乐 - 爱生活，爱音乐！</span>
     <div class="toplinks">
	 <a href="/plus/heightsearch.php" target="_blank">高级搜索</a>|
	 <a href="/data/rssmap.html" target="_blank">网站地图</a>|
	 <a href="/tags.php">TAG标签</a>
	 <a href="/data/rssmap.html" class="rss">RSS订阅</a>
	 <span>
		 [<a href=""onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://i.huamengnet.com');">设为首页</a>]
		 [<a href="javascript:window.external.AddFavorite('http://i.huamengnet.com','KUAI音乐')">加入收藏</a>]
	 </span>
	 </div>
    </div> 
</div>

<div class="header">
	<div class="top w960 center">
      <div class="title">
        <h1><a href="http://i.huamengnet.com"><img src="/images/logo.png" height="60" width="220" alt="KUAI音乐"/></a> </h1>
      </div>
      <div class="banner">
		  <div class="search">
		  <form  name="formsearch" action="/plus/search.php">
			<div class="form" id="login_2">
			   <input type="hidden" name="kwtype" value="0" />
			   <div class="search-keyword">
			   <input name="q" type="text" class="" id="search-keyword" value="在这里搜索..." onfocus="if(this.value=='在这里搜索...'){this.value='';};hidekeyboard=true;login_2.className='form_on'"  onblur="if(this.value==''){this.value='在这里搜索...';};login_2.className='form'" />
			   </div>
			   <select name="searchtype" class="search-option" id="search-option">
				   <option value="title" selected='1'>检索标题</option>
				   <option value="titlekeyword">智能模糊</option>
			   </select>
			  <button type="submit" class="post_btn">搜索</button>
			</div>
			</form>
			<div class="tags">
			  <ul>
			  
				<li><a href='/tags.php?/%E5%93%81%E5%86%A0/' target="_blank">品冠</a></li>
			  
				<li><a href='/tags.php?/%E6%83%B3%E8%A7%81/' target="_blank">想见</a></li>
			  
				<li><a href='/tags.php?/%E7%AB%99%E5%9C%A8/' target="_blank">站在</a></li>
			  
				<li><a href='/tags.php?/%E7%BC%B1%E7%BB%BB/' target="_blank">缱绻</a></li>
			  
				<li><a href='/tags.php?/%E9%AB%98%E5%A4%84/' target="_blank">高处</a></li>
			  
				<li><a href='/tags.php?/%E6%9F%90%E4%B8%AA/' target="_blank">某个</a></li>
			  
				<li><a href='/tags.php?/%E5%BF%83%E5%A2%83/' target="_blank">心境</a></li>
			  
				<li><a href='/tags.php?/%E6%9A%97%E6%81%8B%E8%BF%87/' target="_blank">暗恋过</a></li>
			  
				<li><a href='/tags.php?/%E4%B8%8D%E7%BB%8F%E6%84%8F/' target="_blank">不经意</a></li>
			  
				<li><a href='/tags.php?/%E9%97%AE%E5%80%99/' target="_blank">问候</a></li>
			  
			  </ul>
			</div>
		</div><!-- //search -->
	</div>
      <div class="banner2">
         <a  href="/member/index.php" class="user_login"  target="_blank">用户登录</a>
         <a href="/member/index_do.php?fmdo=user&dopost=regnew" class="user_reg"  target="_blank">注册帐号</a>
		 <br/>
		 <a href="/member/index.php"  target="_blank">会员中心</a> | 
         <a href="/member/index_do.php?fmdo=login&dopost=exit">安全退出</a> 
	  </div>
	</div><!-- //top -->
	<!-- //菜单 -->
    	<!-- //如果不使用currentstyle，可以在channel标签加入 cacheid='channeltoplist' 属性提升性能 -->
		<div class="csc_top">
		  <ul  id="1" class="head_menu">	  	
			<li class="current">
			<a href='/'><span>主页</span></a>
			</li>
			<span class="sep">|</span>
			
			<li><a href='/html/music/'  rel='dropmenu1' target="_blank"><span>轻音乐</span></a><span class="sep">|</span></li>
			
			<li><a href='/html/lx/'  rel='dropmenu3' target="_blank"><span>流行</span></a><span class="sep">|</span></li>
			
			<li><a href='/html/mv/'  target="_blank"><span>MV</span></a><span class="sep">|</span></li>
			
			<li><a href='/special/'  target="_blank"><span>音乐专辑</span></a><span class="sep">|</span></li>
			
			<li><a href='/plus/guestbook.php'  target="_blank"><span>在线留言</span></a><span class="sep">|</span></li>
			
		 </ul><span class="rss"><a href="/data/rssmap.html" class="rss" target="_blank"><img src="/images/rssicons.png"  title="RSS订阅"/></a></span>
		</div>
</div><!-- //header -->

<div id="top"> 
	<div class="title">
		<h1>歌曲联播 - KUAI音乐</h1>
   </div>
</div>
<div class="index">
	<div class="index_top">
	<div class="cmpplayer">
    	<div class="player" id="player"></div>
		<div class="player_btn">
		<div class="mtitle" style="float:left"></div>
    	<a href="javascript:;" onclick="clearMusic()" class="post_btn">清空列表</a> 
    	<a href="javascript:;" onclick="loadMusic()" class="post_btn">重新加载列表</a>
		</div>
	</div>
	<div class="lianboad_r" style="float:right; width:550px"><img src="/ads/images/bannerVip.jpg" width"=550" height="250"></div>
	</div>
<div class="line01"></div>
<div id="mContent"></div>
</div>
<script language="javascript" type="text/javascript"> 
function LoadCommets(page)
{
    var aid = $("#aid").val();
}
</script>

<!-- //底部模板 -->
<div class="footer w960 center mt1 clear">
    <div class="footer_left"></div>
    <div class="footer_body">
	    <span style="position:fixed; right:15px; bottom:25px;"><a href="javascript:scroll(0,0)"><img src="/images/top.gif" alt="返回顶部" title="返回顶部"/></a></span>

	<p class="powered">    
		<div class="copyright">Copyright &copy; 2012 KUAI.CN. 桦盟网络 版权所有&nbsp;&nbsp;</div></p>        
<!-- /powered -->
   </div>
   <div class="footer_right"></div>
   <div class="tongji" style="margin:auto" align="center"><script src="http://s84.cnzz.com/stat.php?id=3483221&web_id=3483221&show=pic" language="JavaScript"></script>
</div>
</div>
</body>
</html>