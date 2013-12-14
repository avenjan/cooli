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
<div class="music_img"><img src="<?php echo $pic ?>" /></div>
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
