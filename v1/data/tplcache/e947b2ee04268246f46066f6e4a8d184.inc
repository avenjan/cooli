<li class="show_data" onmouseover="this.className='show_play'" onmouseout="this.className='show_data'">
	  <input type="checkbox" name="jtbox" value="[field:id /]" class="play_checkbox"/>
	  <a href="[field:arcurl /]">[field:title /]</a>
	  <div class="list_cp" >
		<span class="data">[field:pubdate function=MyDate('m-d',@me)/]</span>
			<a href="[field:arcurl/]"  class="btn_play" title="播放" target="_blank">播放</a>
			<!--a href="" class="btn_add" title="添加"  target="_blank">添加</a-->
			<a class="btn_add" href="/plus/stow.php?aid=[field:id/]&music_url=[field:music_url/]&type=3" title="加入我的播放列表" target="_blank"></a>
			<a href="/plus/recommend.php?aid=[field:id/]" title="推荐给好友" class="btn_tuijian" target="_blank">推荐</a>
         </div>
	  </li>