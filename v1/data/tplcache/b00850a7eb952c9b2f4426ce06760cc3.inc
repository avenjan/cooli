<li class="song_box">
			<script type="text/javascript">
			  var id = "[field:id/]";
			  var name = "[field:title/]";
			  var url = "[field:music_url/]";
			  var bgimg = "[field:litpic /]"
			  arrName[id] = name;
			  arrUrl[id] = url;
			  arrBgimg[id] = bgimg;
			  </script>
			<div class="pic pause" onmouseover="this.className+=' hover'" onmouseout="this.className=this.className.replace(/\shover/,'')" href="javascript:;" onclick="playboxSong(this, true)" title="[field:title /]" hidefocus="true">
			<img src="[field:litpic/]" width="210" height="215" alt="[field:title /]" />
			<b></b>
			<a href="javascript:void(0)" onclick="play('[field:id /]');" title="立即播放"><i></i></a>
			<a href="javascript:void(0)" onclick="add('[field:id /]');" title="加入播放列表"><em></em></a>
			</div>
			<a class="title" href="javascript:;" onclick="playboxSong(before(this), true)" title="[field:title /]" hidefocus="true"><i></i>[field:title /]</a>
			<p class="text">演奏/演唱：[field:writer/]<br/>类型：[field:typename/]<br/>播放[field:click /]次</p>
			</li>