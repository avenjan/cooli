<li class="show_data" onmouseover="this.className='show_play'" onmouseout="this.className='show_data'">
					<!--input type="checkbox" name="mcbox" value="[field:id /]"/--> 
					<a href="[field:arcurl/]" class="title" target="_blank">[field:title/]</a>
					<div class="list_cp">
						<span class="data">
						<small>更新：</small>[field:pubdate function="GetDateTimeMK(@me)"/]
						<small>推荐：</small>[field:softrank function='GetRankStar(@me)'/]
						<small>人气：</small>[field:click/]
						</span>
						<a href="[field:arcurl/]"  class="btn_play" title="播放" target="_blank">播放</a>
						<a class="btn_add" href="/plus/stow.php?aid=[field:id/]&music_url=[field:music_url/]&type=3" title="加入我的播放列表" target="_blank"></a>
					   <a href="/plus/recommend.php?aid=[field:id/]" title="推荐给好友" class="btn_tuijian" target="_blank">推荐</a>
					</div>
				</li>