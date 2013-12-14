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
<link href="/templets/default/style/style.css" rel="stylesheet" media="screen" type="text/css" />
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
<a name="gotop">&nbsp;</a>
<div id="page">
	<div class="chl-poster simple" id=header>
	<a href="http://i.huamengnet.com"><img src="/images/logo.png" height="35" width="175" alt="KUAI音乐"/ style="float:left; margin-left:5px;"></a> 
		<div id=site-nav>
			<UL class=quick-menu>
			  <LI class="mytaobao menu-item">
				  <div class=menu>
					  <A class=menu-hd href="#" target=_top rel=nofollow>我的酷爱<B></B></A> 
					  <div class=menu-bd>
					       <div id="_userlogin">
						  <div class="userlogin">
						   <form name="userlogin" action="/member/index_do.php" method="post">
							<input type="hidden" name="fmdo" value="login" />
							<input type="hidden" name="dopost" value="login" />
							<input type="hidden" name="keeptime" value="604800" />
							<div class="fb"><span>用户名:</span>
							 <input type="text" name="userid" size="20" class="ipt-txt" />
							</div>
							<div class="fb"><span>密码:</span>
							 <input type="password" name="pwd" size="20" class="ipt-txt" />
							</div>
							
							<div class="fb"><span>验证码:</span>
							 <input type="text" name="vdcode" size="8" class="ipt-txt" />
							 <img id="vdimgck" align="middle" onclick="this.src=this.src+'?'" style="cursor:pointer;margin-left:0px;text-transform:uppercase;" alt="看不清？点击更换" src="/include/vdimgck.php"/></div>
							
							<div class="submit">
							 <button type="submit" class="btn-1">登录</button>
							 <a href="/member/index_do.php?fmdo=user&dopost=regnew" >注册帐号</a> <a href="/member/resetpassword.php">忘记密码?</a> </div>
						   </form>
						  </div>
						 </div>
						 <!-- /userlogin -->
					  </div>
				  </div>
			  </LI>
			  <LI class="search menu-item">
				  <div class=menu><SPAN class=menu-hd><S></S>搜索<B></B></SPAN> 
					  <div class=menu-bd>
						  <div class=menu-bd-panel>
							 <form  name="formsearch" action="/plus/search.php">
							 <div class="form" id="login_2">
								 <input type="hidden" name="kwtype" value="0" />
								 <input name="q" type="text" class="" id="search-keyword" value="在这里搜索..." onfocus="if(this.value=='在这里搜索...'){this.value='';};hidekeyboard=true;login_2.className='form_on'"  onblur="if(this.value==''){this.value='在这里搜索...';};login_2.className='form'" />
							   <select name="searchtype" class="search-option" id="search-option">
							   <option value="title" selected="selected">检索标题</option>
							   <option value="titlekeyword">智能模糊</option>
							  </select>
							  <button type="submit" class="post_btn">搜索</button>
							</div>
							</form>
							 <a href="/plus/heightsearch.php" target="_blank" style="float:right; margin-top:10px;">高级搜索</a>
						  </div>
					  </div>
				  </div>
			  </LI>
			  <LI class="services menu-item last">
				  <div class=menu>
					  <A class=menu-hd href="#" target=_top>网站导航<B></B></A> 
					  <div class=menu-bd style="WIDTH: 210px;  _width: 202px">
						  <div class=menu-bd-panel>
							  <DL>
								<DT>分类
								<DD>
							
							<a href='/plus/list.php?tid=3'  rel='dropmenu3' target="_blank"><span>流行</span></a><span class="sep">&nbsp;&nbsp;</span>
							
							<a href='/plus/list.php?tid=1'  rel='dropmenu1' target="_blank"><span>轻音乐</span></a><span class="sep">&nbsp;&nbsp;</span>
							
							<a href='/plus/list.php?tid=8'  target="_blank"><span>MV</span></a><span class="sep">&nbsp;&nbsp;</span>
							
							<a href='/plus/list.php?tid=6'  target="_blank"><span>音乐专辑</span></a><span class="sep">&nbsp;&nbsp;</span>
							
							<a href='/plus/guestbook.php'  target="_blank"><span>在线留言</span></a><span class="sep">&nbsp;&nbsp;</span>
							
								</DD>
							</DL>
							  <DL>
								<DT>快速导航 
								<DD>			
								 <a href="/data/rssmap.html" target="_blank">网站地图</a>|
								<a href="/tags.php">TAG标签</a>
								<a href="/data/rssmap.html" class="rss">RSS订阅</a>
								</DD>
							</DL>
								
							  <DL>
								<DT>热门搜索 
								<DD>
								<div class="tags">
							  
								<a href='/tags.php?/%E4%BA%BA/' target="_blank">人</a>
							  
								<a href='/tags.php?/away/' target="_blank">away</a>
							  
								<a href='/tags.php?/Run/' target="_blank">Run</a>
							  
								<a href='/tags.php?/%E6%9A%97%E6%81%8B%E8%BF%87/' target="_blank">暗恋过</a>
							  
								<a href='/tags.php?/%E9%AB%98%E5%A4%84/' target="_blank">高处</a>
							  
								<a href='/tags.php?/%E6%9F%90%E4%B8%AA/' target="_blank">某个</a>
							  
								<a href='/tags.php?/%E7%BB%93%E5%B1%80%E5%91%A2%3F/' target="_blank">结局呢?</a>
							  
								<a href='/tags.php?/%E7%8E%B0%E5%9C%A8/' target="_blank">现在</a>
							  
								<a href='/tags.php?/%E4%B8%8D%E7%BB%8F%E6%84%8F/' target="_blank">不经意</a>
							  
								<a href='/tags.php?/%E7%AB%99%E5%9C%A8/' target="_blank">站在</a>
							  
								</DD></DL>
							  <DL class=last>
								<DD><STRONG style="FONT-WEIGHT: bold"><A href="/data/rssmap.html">更多内容</A></STRONG></DD>
							  </DL>
						  </div>
					  </div>
				  </div>
			  </LI>
			  
		    </UL>
		</div>
	<div id="playnow" style="color:#fff"><span></span>爱生活，爱音乐...</div>
	</div>
</div>
<div class="clear"></div>




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
	<div class="lianboad_r" style="float:right; width:550px"><a href="http://sell.huamengnet.com" target="_blank"><img src="/ads/images/bannerVip.jpg" width"=550" height="250"></a></div>
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
<div class="footer w960 center mt1 clear" style="height: 100%; text-align:center">
    <div class="footer_body">
		<div class="copyright">Copyright &copy; 2012 KUAI.CN. 桦盟网络 版权所有  新ICP备12002580号  </div>      
<!-- /powered -->
   </div>
   <p class="w3c">
    <a href="http://validator.w3.org/check?uri=referer" target="_blank">
	<img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" height="31" width="88" />
	</a>
	 <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
        <img style="border:0;" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" />
    </a>
	<a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
    <img style="border:0;" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" />
	</a>
  </p>
   <div class="tongji" style="margin:auto" align="center">
   <script src="http://s84.cnzz.com/stat.php?id=3483221&web_id=3483221&show=pic" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fbd8e9c876f8adaf70538c0492cafdcd6' type='text/javascript'%3E%3C/script%3E"));
</script>
	</div>
	
	<a name="gobottom">&nbsp;</a>
<div class="go">
	<a title="返回顶部" class="top" href="#gotop"></a>
	<a title="如果您有意见，请反馈给我们！" class="feedback" href="/plus/guestbook.php" target="_blank"></a>
	<a title="返回底部" class="bottom" href="#gobottom"></a>
</div>
 <div class="clear"></div>

</div>
<script language="javascript" type="text/javascript">CheckLogin();</script>

</body>
</html>