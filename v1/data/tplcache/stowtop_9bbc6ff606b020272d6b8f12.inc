<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cfg_soft_lang; ?>" />
<title>我的播放器 - 会员中心 - <?php echo $cfg_webname; ?></title>
<link href="templets/style/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templets/js/j.js"></script>
<script type="text/javascript" src="templets/js/load.js"></script>
<script type="text/javascript" src="templets/js/leftmenu.js"></script>
<script type="text/javascript">
  function viewArc(aid){
	  window.open("<?php echo $GLOBALS['cfg_phpurl']; ?>/view.php?aid="+aid);
  }
  function editArc(aid,channelid){
	  location = "archives_do.php?dopost=edit&channelid="+channelid+"&aid="+aid;
  }
  function delArc(aid){
	  if(window.confirm('你确定要删除这首歌曲吗?'))  location = "archives_do.php?dopost=delStow&type=3&aid="+aid+"";
  }
</script>

</head>
<body>
<div id="main">
  <?php include(DEDEMEMBER."/templets/head.htm"); ?>
  <div id="content" class="w960 clearfix">
    <?php include(DEDEMEMBER."/templets/menu.php"); ?>
    <div id="mcpmain">
      <div id="appTab">
        <ul>
          <li><a href="mystow.php">我的播放器</a></li>
          <li class="thisTab"><a href="mystow.php?type=top20">随便听听</a></li>
        </ul>
        <div class="tabOther"> </div>
      </div>
       <ul class="tabSub" id="myplayer">
       <!--<?php
         foreach($rows as $row)
         {
        ?>
        <li <?php if($type==$row['stowname']) echo 'class="thisTab"';?> ><a href="mystow.php?rank=top&type=<?php echo $row['stowname'];?>"><span><?php echo $row['indexname'];?></span></a></li>
        <?php }?>-->
			<div id="cmp_area" style="width:355px;height:205px;margin:0px auto; float:left"> 
			<script type="text/javascript" src="../play/cmp.js"></script> 
			<script type="text/javascript">
			//将cmp放在一个固定容器里，便于后面设置位置
			CMP.write("cmp", "100%", "100%", "../play/player.swf?php=5", "skin=skins/beveled.swf&list_delete=1&api=cmp_loaded&lists=");
			</script> 
		</div>

      </ul>
      <div id="mainCp">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listStyle2">
          <thead>
          </thead>
          <tbody>
		  <span class="music_play">
		  <input type="checkbox" onclick="checkAll(this);" class="addall" title="全选" value=""/>
		  <button onclick="addSelected();" class="box" title="加入列表"></button>
		  <button onclick="playSelected();" class="playbtn" title="播放"></button>
		</span>
		<script>
			var arrName = new Array();
			var arrUrl = new Array();
		</script>
          <?php
$atts = array();
$atts['tagname'] = 'datalist';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{
?>
		  <tr  class="show_data" onmouseover="this.className='show_play'" onmouseout="this.className='show_data'">
            <td colspan="5" class="tabTitle">
			<?php if($fields["stowname"]!='sys') {?>
			<input type="checkbox" value="<?php echo $fields['aid']; ?>" />		
              <a href="javascript:viewArc(<?php echo $fields['aid']; ?>);"><?php echo $fields['title']; ?></a>
              <?php }else{ ?>
              <a href='archives_do.php?dopost=viewArchives&aid=<?php echo $fields['aid']; ?>' target='_blank'><?php echo $fields['title']; ?></a>
              <?php } ?>
			  </td>
			  <script>
			  var id = "<?php echo $fields['aid']; ?>";
			  var name = "<?php echo $fields['title']; ?>";
			  var url = "<?php echo $fields['music_url']; ?>";
			  arrName[id] = name;
			  arrUrl[id] = url;
			  </script>
			<td class="play_bott"><a href="javascript:void(0)" class="btn_play" title="播放" onclick="play('<?php echo $fields['aid']; ?>');">试听</a></td>
			<td class="play_bott"><a href="javascript:void(0)"  class="btn_add" title="加入播放列表" onclick="add('<?php echo $fields['aid']; ?>');">加入</a></td>
			<td class="play_bott">
			<a class="btn_tuijian" title="推荐给好友" href="../plus/recommend.php?type=<?php echo $fields['type']; ?>&aid=<?php echo $fields['aid']; ?>" target="_blank">荐</a>
			</td>
			<!--td class="play_bott"><a class="btn_del" title="从我的播放列表删除" href="javascript:delArc(<?php echo $fields['aid']?>);">删</a></td-->
             <td colspan="6" class="tabTitle tbBtm">加入时间: <?php echo MyDate('m-d H:i', $fields['addtime']); ?></td>
          </tr>
          <?php
}
}?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6"><div class="pageList"> <?php
$atts = array();
$atts['tagname'] = 'pagelist';
$atts['listsize'] = '5';
 echo $this->refObj->GetPageList($atts,$this->refObj,$fields); 
?>
</div></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <!--主操作区域 -->
    </div>
  </div>
 <!--加载播放器-->
<script type="text/javascript">
var cmpo = parent.CMP.get("cmp") || top.CMP.get("cmp");
//alert(cmpo);
function $(id) { return document.getElementById(id); }
function highlight(o, c){
	o.style.backgroundColor = c;
	o.onmouseout = function(){ o.style.backgroundColor = ""; }
}
function checkAll(o){
	var cbs = document.getElementsByTagName("input");
	for (var i = 0; i < cbs.length; i ++) {
		var cb = cbs[i];
		if (cb.type == "checkbox" && cb.value) {
			cb.checked = o.checked;
		}
	}
}
function cmp_play(ids) {
	if (!cmpo) {
		return;
	}
	var config = cmpo.config();
	var play_id = cmpo.list().length + 1;
	if (config["state"] == "playing") {
		cmpo.sendEvent("view_stop");
	}
	var xml = makeListXml(ids);
	cmpo.list_xml(xml);
	cmpo.sendEvent("view_play", play_id);
}
function cmp_add(ids) {
	if (!cmpo) {
		return;
	}
	var xml = makeListXml(ids);
	cmpo.list_xml(xml);
}
function makeListXml(ids) {
	var xml = "<list>";
	for (var i = 0; i < ids.length; i ++) {
		xml += '<m label="'+arrName[ids[i]]+'" src="'+arrUrl[ids[i]]+'" />';
	}
	xml += "</list>";
	return xml;
}
function play(id) {
	cmp_play([id]);
}
function add(id) {
	cmp_add([id]);
}
function playSelected() {
	var ids = getSelected();
	if (ids.length) {
		cmp_play(ids);
	} else {
		alert("请至少选择一个");	
	}
}
function addSelected() {
	var ids = getSelected();
	if (ids.length) {
		cmp_add(ids);
	} else {
		alert("请至少选择一个");	
	}
}
function getSelected() {
	var ids = [];
	var cbs = document.getElementsByTagName("input");
	for (var i = 0; i < cbs.length; i ++) {
		var cb = cbs[i];
		if (cb.type == "checkbox") {
			if (cb.checked && cb.value) {
				ids.push(cb.value);	
			}
		}
	}
	return ids;
}
document.writeln("<?php echo$haha ?>");

</script>

<?php include(DEDEMEMBER."/templets/foot.htm"); ?>
</div>
</body>
</html>