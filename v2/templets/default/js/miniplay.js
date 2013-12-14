// 酷站代码 http://www.5icool.org */

 var div_id = "miniplayer";
    var is_float = 1;
    var $popdiv = $("#"+div_id);
    $(document).ready(function(){
                        $("#foot_tab").tabs("foottab.play_r", { currentTab:0, isAutoPlay: true, switchingMode: 'o' });
                        $(".hd_tp > a").each(function(){
            $(this).bind("click",function(){
                if (window.GridsumWebDissector) {
                    var _gsTracker = GridsumWebDissector.getTracker("GWD-000409");
                }
            });
        });
	
        if (is_float)
        {
          
            {
                if($.browser.msie && $.browser.version == 6) {
                    Followdiv.follow();
                }
                if(footer_ad_pop._switch()){
                    $('.miniplayer').show(1000);                    
                    $('.miniplayer').animate({right:'0px'},"slow")
                }else{
                    $('.miniplayer').show(1000);
                    footer_ad_pop._hide();
                    $('.miniplayer').animate({right:'0px'},"slow")
                    
                }
			
            }
        }
    });
    var footer_ad_pop = {
        _time : 3600,
        pop_id : 'play_r',
        _show : function(){
           // $('.miniplayer').css('width','650px');
           $('.'+footer_ad_pop.pop_id).show();
            $('.'+footer_ad_pop.pop_id).animate({left:0},"slow",function(){
                $('.foot_msg_hide p:eq(0) img').attr('src','/templets/default/images/player_close.png')
				$('.play_r').css('visibility','visible');
				$('.play_r').css('height','105px');
				

            })
        },
        _hide : function(){
            $('.miniplayer').css('width','auto');
            $('.'+footer_ad_pop.pop_id).animate({left:642},"slow",function(){
                $('.foot_msg_hide p:eq(0) img').attr('src','/templets/default/images/footerNew_off2.jpg')
                $(this).hide();
                $popdiv.css('width','auto');
		  		  $('.play_r').css('visibility','hidden');
		  		  $('.play_r').css('height','0px');
		  		  $('.play_r').css('display','block');

//		  width:0px; height:0px; overflow:hidden;

            })     
            
        },
        _switch : function(){
            return true;
        }
        ,_init:function(){
            $('.foot_msg_hide p:eq(0) img').click(function(){
                var img = $(this).attr('src');
                if(/_off/.test(img)){
                    footer_ad_pop._show();
                }else{
                    footer_ad_pop._hide();
                }
            })
        }
    }
    footer_ad_pop._init();