<?php
$z[0]=Array("global","",236,264);
$z[0][4]['name']="cfg_soft_lang";
$z[1]=Array("field","",277,296);
$z[1][4]['name']="title";
$z[2]=Array("global","",297,323);
$z[2][4]['name']="cfg_webname";
$z[3]=Array("field","",364,393);
$z[3][4]['name']="keywords";
$z[4]=Array("field","",433,491);
$z[4][4]['name']="description";
$z[4][4]['function']="html2text(@me)";
$z[5]=Array("global","",509,541);
$z[5][4]['name']="cfg_templets_skin";
$z[6]=Array("global","",625,657);
$z[6][4]['name']="cfg_templets_skin";
$z[7]=Array("include","",894,929);
$z[7][4]['filename']="head.htm";
$z[8]=Array("field","",992,1021);
$z[8][4]['name']="position";
$z[9]=Array("field","",1180,1209);
$z[9][4]['name']="typename";
$z[10]=Array("list","\r\n				<li class=\"show_data\" onmouseover=\"this.className='show_play'\" onmouseout=\"this.className='show_data'\">\r\n					<!--input type=\"checkbox\" name=\"mcbox\" value=\"[field:id /]\"/--> \r\n					<a href=\"[field:arcurl/]\" class=\"title\" target=\"_blank\">[field:title/]</a>\r\n					<div class=\"list_cp\">\r\n						<span class=\"data\">\r\n						<small>更新：</small>[field:pubdate function=\"GetDateTimeMK(@me)\"/]\r\n						<small>推荐：</small>[field:softrank function='GetRankStar(@me)'/]\r\n						<small>人气：</small>[field:click/]\r\n						</span>\r\n						<a href=\"[field:arcurl/]\"  class=\"btn_play\" title=\"播放\" target=\"_blank\">播放</a>\r\n						<a class=\"btn_add\" href=\"/plus/stow.php?aid=[field:id/]&music_url=[field:music_url/]&type=3\" title=\"加入我的播放列表\" target=\"_blank\"></a>\r\n					   <a href=\"/plus/recommend.php?aid=[field:id/]\" title=\"推荐给好友\" class=\"btn_tuijian\" target=\"_blank\">推荐</a>\r\n					</div>\r\n				</li>\r\n	",1499,2468);
$z[10][4]['pagesize']="10";
$z[11]=Array("pagelist","",2564,2635);
$z[11][4]['listitem']="info,index,end,pre,next,pageno";
$z[11][4]['listsize']="5";
$z[12]=Array("channel","\r\n		<li><a href='[field:typeurl/]'>[field:typename/]</a></li>",2876,3055);
$z[12][4]['type']="son";
$z[12][4]['currentstyle']="<li><a href='~typelink~' class='thisclass'>~typename~</a></li>";
$z[13]=Array("arclist","\r\n						<li>\r\n							<a href=\"[field:arcurl/]\">[field:title/]</a>\r\n							<span><small>好评:</small>[field:scores/]</span>\r\n							<span><small>人气:</small>[field:click/]</span>\r\n						</li>\r\n                    ",3251,3524);
$z[13][4]['flag']="c";
$z[13][4]['titlelen']="42";
$z[13][4]['row']="8";
$z[14]=Array("arclist","\r\n                    	<li><a href=\"[field:arcurl/]\">[field:title/]</a></li>\r\n                    ",3735,3883);
$z[14][4]['row']="10";
$z[14][4]['orderby']="click";
$z[15]=Array("myad","",4009,4035);
$z[15][4]['name']="footer";
$z[16]=Array("include","",4043,4080);
$z[16][4]['filename']="footer.htm";

?>