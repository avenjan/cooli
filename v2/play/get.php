<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");

gettype($song_id);
if(is_numeric($song_id)||!empty($song_id)){
			$str=$song_id;
			$mids=explode(",",$str);
			foreach($mids as $id)
			{
			$sql2 = "select * from `#@__archives` t
			left join `#@__addonsoft` f on t.id=f.aid where id ='".$id."'";
			$r2 = $dsql->GetOne($sql2);
			if(!empty($r2['introduce'])){
				$info = $r2['introduce'];
			}else{ 
				$info = "该歌曲暂无简介";
			}
			
			//定义变量
			$music_url = $r2['music_url']; //音乐地址
			$title = $r2['title']; //歌曲名称
			$writer = $r2['writer']; //作者
			$pic = $r2['litpic'];	//图片
			$source = $r2['source'];//来源
			$click = $r2['click']; //人气、点击量
			$size = $r2['softsize'];//时长
			$type = $r2['softtype'];//类型
			$time = $r2['os'];//发行时间
			$language = $r2['language'];//语言
			}
			
			if(!empty($r2['title'])){
				$title = $r2['title'];			
			}else{
				echo "歌曲不存在！";
			}
}else{

echo "参数错误，无法为您提供相关内容！";
}
?>
<div class="play">
	<div class="play_l">
		<div class="music_title">
		<div class="newdigg" id="newdigg"></div>
			 <script language="javascript" type="text/javascript">getDigg(<?php echo $song_id ?>);</script>
			 <!-- Baidu Button BEGIN -->
			<script type="text/javascript" id="bdshare_js" data="type=button&amp;uid=139658" ></script>
			<script type="text/javascript" id="bdshell_js"></script>
			<script type="text/javascript">
				document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
			</script>
			<!-- Baidu Button END -->
		<p class="count" id="listen_count"><?php echo $click ;?>人听过</p>
		<h2><img src="/images/img3.jpg" />&nbsp;<?php echo $title ?><span style="font-size:16px"> - <?php echo $writer ?></span></h2>
		</div>
		<div class="music_player" style="width: 250px;">
		<div class="actbox">
			<ul>
				<li id="act-err"><a href="/plus/erraddsave.php?aid=<?php echo $song_id ?>&title=<?php echo $title ?>" target="_blank">报错</a></li>
				<li id="act-pus"><a href="/plus/recommend.php?aid=<?php echo $song_id ?>" target="_blank">推荐</a></li>
				<li id="act-pnt"><a href="#" onClick="window.print();">打印</a></li>
			</ul>
			
		</div><!-- /actbox -->
		<a href="/plus/stow.php?aid=<?php echo $song_id ?>&type=3&music_url=<?php echo $music_url ?>" title="收藏到我的播放列表" target="_blank"><div class="addto"></div></a>
		</div>
		<div class="music_info">
			<ul class="infolist">
					<li><small>演唱/演奏：</small><span><?php echo $writer ?></span></li>
					<li><small>类型：</small><span><?php echo $type ?></span></li>
					<li><small>语言：</small><span><?php echo $language ?></span></li>
					<li><small>时长：</small><span><?php echo $size ?></span></li>
					<li><small>推荐等级：</small><span><?php echo $r2['softrank'] ?>颗星</span></li>
					<li><small>发行时间：</small><span><?php echo $time ?></span></li>
				</ul><!-- /info -->
		</div>
	<div class="line02"></div>
	
	<div class="music_wiew">
		<div class="music_wiew_title">
			<h3>音乐信息</h3>
			<ul class="downurllist">
               <a href="/plus/feedback.php?aid=<?php echo $song_id ?>" target="_blank" class="post_btn">我要评论</a>
            </ul>
		</div>
		<div class="content"><?php echo $info ?></div>
		<div class="line02"></div>
		<!-- //AJAX评论区 -->
	</div>
	</div>
	<div class="play_r">
		<div class="music_img"><img src="<?php echo $pic ?>" /></div>
	</div>

</div>
