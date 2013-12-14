
var n = 2;
function selectAll() {
    if (document.getElementsByName("mcbox") != null) {
        if (n % 2 == 0) {
            for (var i = 0; i < document.getElementsByName("mcbox").length; i++) {
                document.getElementsByName("mcbox")[i].checked = true;
            }
            n += 1;
        } else {
            for (var i = 0; i < document.getElementsByName("mcbox").length; i++) {
                document.getElementsByName("mcbox")[i].checked = false;
            }
            n += 1;
        }
    }
}
function preview( id ){ 
var list = "";
    if (document.getElementsByName("mcbox") != null) {
        for (var i = 0; i < document.getElementsByName("mcbox").length; i++) {
            if (document.getElementsByName("mcbox")[i].checked == true) {
                if (list == "") {
                    list += document.getElementsByName("mcbox")[i].value;
                } else {
                    list += "," + document.getElementsByName("mcbox")[i].value;
                }
            }
        }
    }
    if (list != "") {
		
        window.open("/play/?song_id=" + encode(list));
    } 
	else {
    var dg = new J.dialog({ 
	id:id,
	title: '系统提示',
	resize:true,
	cover: true,
	btns: false,
	rang: true,
	drag: false,
	bgcolor:'#000',
	iconTitle:false,
	cancelBtnTxt:'确定',
	width: 350,
	loadingText:'正在加载请稍后...',
	height: 190,
	maxBtn:false,
	  html:'<div style="text-align:center;font-weight:bold;padding-left:20px;margin-top:50px;height:16px;">请至少选择一条可播放的音乐</div>' }); 
	dg.ShowDialog(); 
	}
	}







var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789*-=";
function encode(input) {
    var output = "";
    var chr1, chr2, chr3 = "";
    var enc1, enc2, enc3, enc4 = "";
    var i = 0;
    do {
        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);
        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;
        if (isNaN(chr2)) {
            enc3 = enc4 = 64;
        } else if (isNaN(chr3)) {
            enc4 = 64;
        }
        output = output +
            keyStr.charAt(enc1) +
            keyStr.charAt(enc2) +
            keyStr.charAt(enc3) +
            keyStr.charAt(enc4);
        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";
    } while (i < input.length);
    return output;
}











function FeedDel()
 {
	if(confirm("你确定删除该动态信息?"))
    	return true;
   	else
		return false;
 }
 $(function(){
        $('#arcticle').click(function() {
            $.ajax({
			  type: "GET",
			  url: "feed.php",
			  dataType: "json",
			  success : function(data){
			         $('#FeedText').empty();
					  var html = '<div class="newarticlelist"><span class="music_play"><input name="" type="button" onclick="selectAll()" value="" title="全/反选"  class="box"><input name="" type="button" onclick="preview()" value="" title="播放" class="playbtn"></span><ul>';
					  $.each( data  , function(commentIndex, comment) {
						  html += '<li><span>发表时间：' + comment['senddate'] + '</span><input type="checkbox" name="mcbox" value="'+ comment['id'] + '" class="play_checkbox"/><a href="' + comment['htmlurl'] + '" target="_blank">'+comment['title']+'</a></li>';
					  })
					 html +="</ul></div>";
					 $('#FeedText').html(html);
					 $("#arcticle").addClass("thisTab");
					 $("#myfeed").removeClass("thisTab");
					 $("#allfeed").removeClass("thisTab");
					 $("#score").removeClass("thisTab");
					 $("#mood").removeClass("thisTab");
			  }
			}); 
        });
   })
   $(function(){
        $('#allfeed').click(function() {
            $.ajax({
			  type: "GET",
			  url: "feed.php?type=allfeed",
			  dataType: "json",
			  success : function(data){
			         $('#FeedText').empty();
					  var html = '';
					  $.each( data  , function(commentIndex, comment) {
						  html += '<div class="feeds_title ico' + comment['type'] + '"><span><a href="/member/index.php?uid='+ comment['uname'] +'">'+ comment['uname'] +'</a>' + comment['title'] + ' <em>' + comment['dtime'] + '</em></span><p>' + comment['note'] + '</p></div>';
					  })
					 $('#FeedText').html(html);
					 $("#allfeed").addClass("thisTab");
					 $("#myfeed").removeClass("thisTab");
					 $("#arcticle").removeClass("thisTab");
					 $("#score").removeClass("thisTab");
					 $("#mood").removeClass("thisTab");
			  }
			}); 
        });
   })
   //
   $(function(){
        $('#myfeed').click(function() {
            $.ajax({
			  type: "GET",
			  url: "feed.php?type=myfeed",
			  dataType: "json",
			  success : function(data){
			         $('#FeedText').empty();
					  var html = '';
					  $.each( data  , function(commentIndex, comment) {
						  html += '<div class="feeds_title ico' + comment['type'] + '"><span><a href="index.php?uid='+ comment['uname'] +'&action=feeddel&fid=' + comment['fid'] + '" onclick="return FeedDel()" class="act">删除</a><a href="/member/index.php?uid='+ comment['uname'] +'">'+ comment['uname'] +'</a>' + comment['title'] + ' <em>' + comment['dtime'] + '</em></span><p>' + comment['note'] + '</p></div>';
					  })
					 $('#FeedText').html(html);
					 $("#myfeed").addClass("thisTab");
					 $("#allfeed").removeClass("thisTab");
					 $("#arcticle").removeClass("thisTab");
					 $("#score").removeClass("thisTab");
					 $("#mood").removeClass("thisTab");
			  }
			}); 
        });
   })
   //我的动态
  $(function(){
            $.ajax({
			  type: "GET",
			  url: "feed.php?type=myfeed",
			  dataType: "json",
			  success : function(data){
			         $('#FeedText').empty();
					  var html = '';
					  $.each( data  , function(commentIndex, comment) {
						 html += '<div class="feeds_title ico' + comment['type'] + '"><span><a href="index.php?uid='+ comment['uname'] +'&action=feeddel&fid=' + comment['fid'] + '" onclick="return FeedDel()" class="act">删除</a><a href="/member/index.php?uid='+ comment['uname'] +'">'+ comment['uname'] +'</a>' + comment['title'] + ' <em>' + comment['dtime'] + '</em></span><p>' + comment['note'] + '</p></div>';
					  })
					 $('#FeedText').html(html);
			  }
			}); 
   })
  