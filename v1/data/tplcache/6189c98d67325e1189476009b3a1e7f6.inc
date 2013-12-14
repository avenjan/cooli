<li class="show_data" onmouseover="this.className='show_play'" onmouseout="this.className='show_data'">
			  <input type="checkbox" name="jtbox" value="[field:id /]" class="play_checkbox"/>
			  <a href="[field:arcurl /]">[field:title /]</a>
			  <div class="list_cp" >
				<span class="data">播放[field:click /]次</span>
			   <a href="[field:arcurl /]" title="播放" class="btn_play" target="_blank">播放</a>
			   <a href="/plus/stow.php?aid=[field:id/]&type=3&music_url=[field:music_url/]" title="收藏到我的播放列表" class="btn_add" target="_blank">添加</a>
			   <a href="/plus/stow.php?aid=[field:id/]" class="btn_fav " target="_blank">收藏</a>
				<!--a href="/plus/recommend.php?aid=[field:id/]" title="推荐给好友" class="btn_tuijian" target="_blank">推荐</a-->
				</div>
			  </li>