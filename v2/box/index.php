<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>酷爱音乐盒</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/templets/default/style/playerbox.css" rel="stylesheet" media="screen" type="text/css" />
<script language="javascript" type="text/javascript" src="/include/dedeajax2.js"></script>
<script language="javascript" type="text/javascript">
<!--
	$(function(){
		$("a[_for]").mouseover(function(){
			$(this).parents().children("a[_for]").removeClass("thisclass").parents().children("dd").hide();
			$(this).addClass("thisclass").blur();
			$("#"+$(this).attr("_for")).show();
		});
		$("a[_for=uc_member]").mouseover();
		$("a[_for=flink_1]").mouseover();
	});
	
	function CheckLogin(){
	  var taget_obj = document.getElementById('_userlogin');
	  myajax = new DedeAjax(taget_obj,false,false,'','','');
	  myajax.SendGet2("/member/ajax_loginsta.php");
	  DedeXHTTP = null;
	}
-->
</script>

<script type="text/javascript" src="/play/js/jquery.min.js"></script>

<script type="text/javascript" src="/play/cmp.js"></script>
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
		php:2,
		lists:""
	};
	var htm = CMP.create("cmp", "100%", "100%", "/play/player.swf",vars, {wmode:"transparent"});
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
		cmpo.config("lists", "/play/list.php?song_id=<?php echo $song_id ?>");
		
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


function selectAll(obj) {
	var form = obj.form;
	var eles = form.elements;
	for (var k in eles) {
		var item = eles[k];
		if (item && item.type == "checkbox" && item != obj) {
			item.checked = obj.checked;
		}
	}
}

function add2cmp(obj, autoplay) {
	var ids = [];
	if (typeof obj === "number") {
		ids.push(obj);
	} else {
		var form = obj.form;
		var eles = form.elements;
		for (var k in eles) {
			var item = form[k];
			if (item && item.type == "checkbox") {
				if (item.checked) {
					ids.push(item.value);
				}
			}
		}
	}
	if (ids.length) {
		if (cmpo) {
			//先读取之前列表长度备用
			var len = cmpo.list().length;
			//生成列表xml字符串
			var xml = '';
			for (var i = 0; i < ids.length; i ++) {
				var item = list[ids[i]];
				if (item) {
					if (item.added) {
						if (!confirm("【"+item.label+"】已经被添加到CMP列表中，是否继续添加？")) {
							break;
						}
					}
					xml += '<m ';
					for (var k in item) {
						if (k != "added") {
							xml += k + '="'+item[k]+'" ';
						}
					}
					xml += ' />';
					item.added = true;
				}
			}
			if (xml) {
				//发送到cmp
				var str = '<list>' + xml + '</list>';
				
				//alert(str)
				cmpo.list_xml(str);
				//是否自动播放刚刚添加的
				if (autoplay) {
					//取得最后一个id
					cmpo.sendEvent("view_play", len + 1);
				}
			}
			
		} else {
			alert("cmp还未初始化");
		}
	} else {
		alert("至少选择一个");	
	}
}

</script>

<body class="playerbox">
<script type="text/javascript">
var list = [
<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
gettype($song_id);
if(is_int($song_id)||!empty($song_id)){
        $str=base64_decode($song_id);
        $mids=explode(",",$str);
        foreach($mids as $id)
        {
        $sql2 = "select * from `#@__archives` t
			left join `#@__addonsoft` f on t.id=f.aid where id ='".$id."'";
        $r2 = $dsql->GetOne($sql2);
		$id = $r2['aid'];
		$music_url = $r2['music_url'];
		$label = $r2['title'];
		$url = $r2['music_url'];
		$pic = $r2['litpic'];
		$writer = $r2['writer'];

		 $tr=<<<tr
	{label:"$label", src:"$url",writer:"$writer",aid:"$id" },
tr;

        $ss1.=''.$tr.'';
        }
        $list.=$ss1; 
        echo $list;
}else{
	ShowMsg('参数错误，无法为您提供请求的内容！',"javascript:window.close();","0",5000);

}

?>
];
</script>
<div class="playerwind">
	<div class="player" id="player"></div>
</div>

<div class="head">
	<div class="searchbox">
	 <form  name="formsearch" action="/plus/search.php">
							 <div class="form" id="login_2">
								 <input type="hidden" name="kwtype" value="0" />
								 <input name="q" type="text" class="" id="search-keyword" value="在这里搜索..." onfocus="if(this.value=='在这里搜索...'){this.value='';};hidekeyboard=true;login_2.className='form_on'"  onblur="if(this.value==''){this.value='在这里搜索...';};login_2.className='form'" />
							   
							  <button type="submit" class="search">搜索</button>
							</div>
							</form>
							 <a href="/plus/heightsearch.php" target="_blank" style="float:right; margin-top:10px;">高级搜索</a>
		 </div>
<div id="page">
	<div class="chl-poster simple" id=header>
	<a href="http://i.huamengnet.com"><img src="/images/logo.png" height="35" width="175" alt="KUAI音乐"/ style="float:left; margin-left:5px;"></a> 

		<div id=site-nav>
			<UL class=quick-menu>
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
</div>
<!--/END head-->
<div class="left">
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

<div class="center">
  <div class="list">
    <form onsubmit="return false">
      <ul class="tablelist">
 		<li class="list_head">
		<div class="l_l">歌曲</div>
		<div class="l_c">歌手</div>
		<div class="l_r">歌曲</div>
		</li>
        
		<div class="lists">
        <script type="text/javascript">
		for (var i = 0; i < list.length; i ++) {
			var str = '<li onmouseover="highlight(this, \'#f5f5f5\');" class="art'+i%2+' list_cp">';
			
        	str += '<div class="l_l"><div class="l_box"><input type="checkbox" value="'+i+'" /></div>'+list[i].label+'</div>';
			str += '<div class="l_c">'+list[i].writer+'</div>';
			str += '<div class="l_r"><a href="javascript:void(0)" onclick="add2cmp('+i+', true)" class="btn_play" title="点击播放"></a><a class="btn_add" href="/plus/stow.php?aid='+list[i].aid+'&music_url='+list[i].src+'&type=3" title="加入我的播放列表" target="_blank"></a><a href="/plus/recommend.php?aid='+list[i].aid+'" title="推荐给好友" class="btn_tuijian" target="_blank"></a></div>';
        	str += '</li>';	
			document.write(str);
		}
		</script>
		</div>
		<li class="myfooter">
		<div style="float:left; width:250px;">
         <input type="checkbox" onclick="selectAll(this)"  class="all"/>全选
         <input type="submit" value="添加到列表" onclick="add2cmp(this)" class="add" />
         <input type="submit" value="添加并播放" onclick="add2cmp(this, true)" class="addplay add" />
		 </div>
		 <!--div class="mtitle" style=" width:200px; margin:auto; overflow:hidden"></div-->
		 <div style="float:right;">
		 <a href="javascript:;" onclick="clearMusic()" class="add">清空列表</a> 
    	<a href="javascript:;" onclick="loadMusic()" class="add">重新加载列表</a>
		</div>
			<span class="total">共 <script type="text/javascript"> document.write(i);</script>首</span>
		
        </li>
      </ul>
    </form>
  </div>
</div>  
 <div class="right">
 <div id="mContent"><span style=" color:#333; font-size:14px; margin-top:15px; font-weight:600">酷爱音乐 爱生活，爱音乐... http://i.huamengnet.com</span></div>

 </div>
<script language="javascript" type="text/javascript"> 

function LoadCommets(page)
{
    var aid = $("#aid").val();
}
</script>

<script language="javascript" type="text/javascript">CheckLogin();</script>

</body>
</html>
