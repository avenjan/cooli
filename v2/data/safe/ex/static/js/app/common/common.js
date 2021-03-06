var Main = {};
Main.Common = {
	filetype : {
		'music'	: ['mp3','wma','wav','mid','aac'],
		'movie'	: ['avi','flv','f4v','wmv','3gp','rmvb','mp4'],
		'image'	: ['jpg','jpeg','png','bmp','gif','ico'],
		'code'	: ['html','htm','js','css','less','scss','sass','py','php','rb','erl','lua','pl',
				   'c','cpp','m','h','java','jsp','cs','asp','sql','as','go','lsp',
				   'yml','json','tpl','xml',
				   'cmd','reg','bat','vbs','sh'],
		'text'	: ['txt','ini','inf','conf','oexe','md','htaccess','csv','log'],
		'bindary':['zip','rar','exe','dll','dat','chm','pdf','doc','docx',
					'xls','xlsx','ppt','pptx','class','psd','ttf','class']
	},
	// setting 对话框
	setting:function(setting){
		if (setting == undefined) setting = '';
		if (window.top.frames["Opensetting_mode"] == undefined) {
			$.dialog.open('?setting#'+setting,{
				id:'setting_mode',
				fixed:true,
				resize:true,
				title:'系统设置',
				width:880,
				height:550
			});
		}else{
			FrameCall.doTopFunction('Opensetting_mode','setGoto','"'+setting+'"');
			$('.setting_mode').css('visibility','visible');
		}
	},
	//头部导航栏动作
	bindEvent:function(){
		$('.top_right').click(function(e){
			var _this = $(this);
			if (_this.hasClass('this')) {
				_this.removeClass('this').find('.dropmenu').hide();
			}else{
				_this.addClass('this').find('.dropmenu').show();
			}
			e.stopPropagation();
		});
		$(document).click(function(){
			var _this = $('.top_right');
			if (_this.hasClass('this')) {
				_this.removeClass('this').find('.dropmenu').hide();
			}
		});	
	},
	// tips 
	tips:{
		loading:function(msg){
			$('.messageBox').stop(true,true);//停止正在运行的动画，从新开始动画
			if (msg == undefined) msg = '操作中...';
			$('.messageBox .content').html(msg+"&nbsp;&nbsp;  <img src='./static/images/loading.gif'/>");
			$('.messageBox')
			.css({'display':'block','left':-$('.messageBox').width()})
			.animate({opacity:0.7,left:0},300);
		},
		close:function(msg,time){
			var timeout = 0;		
			if (msg != undefined){
				timeout = 1000;
				$('.messageBox .content').html(msg);
			}
			if (time != undefined) timeout=time;
			$('.messageBox').delay(timeout).animate({opacity:0,left:'-=50'},500,0,function(){
				$(this).css('display','none');
			});	
		},
		tips:function(msg,icon){
			$('.messageBox').stop(true,true);//停止正在运行的动画，从新开始动画
			$('.messageBox .content').html(msg);
			$('.messageBox')
			.css({'display':'block','left':-$('.messageBox').width()})
			.animate({opacity:0.7,left:0},300,0)
			.delay(1000)
			.animate({opacity:0,left:'-=50'},500,0,function(){
				$(this).css('display','none');
			});
		}
	}
}

$(document).ready(function() {
	Main.Common.bindEvent();
});