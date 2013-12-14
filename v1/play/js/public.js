
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


var n = 2;
function selectjtAll() {
    if (document.getElementsByName("jtbox") != null) {
        if (n % 2 == 0) {
            for (var i = 0; i < document.getElementsByName("jtbox").length; i++) {
                document.getElementsByName("jtbox")[i].checked = true;
            }
            n += 1;
        } else {
            for (var i = 0; i < document.getElementsByName("jtbox").length; i++) {
                document.getElementsByName("jtbox")[i].checked = false;
            }
            n += 1;
        }
    }
}
function previewjt( id ){ 
var list = "";
    if (document.getElementsByName("jtbox") != null) {
        for (var i = 0; i < document.getElementsByName("jtbox").length; i++) {
            if (document.getElementsByName("jtbox")[i].checked == true) {
                if (list == "") {
                    list += document.getElementsByName("jtbox")[i].value;
                } else {
                    list += "," + document.getElementsByName("jtbox")[i].value;
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


var n = 2;
function selectyyAll() {
    if (document.getElementsByName("yybox") != null) {
        if (n % 2 == 0) {
            for (var i = 0; i < document.getElementsByName("yybox").length; i++) {
                document.getElementsByName("yybox")[i].checked = true;
            }
            n += 1;
        } else {
            for (var i = 0; i < document.getElementsByName("yybox").length; i++) {
                document.getElementsByName("yybox")[i].checked = false;
            }
            n += 1;
        }
    }
}
function previewqt() {
    var list = "";
    if (document.getElementsByName("yybox") != null) {
        for (var i = 0; i < document.getElementsByName("yybox").length; i++) {
            if (document.getElementsByName("yybox")[i].checked == true) {
                if (list == "") {
                    list += document.getElementsByName("yybox")[i].value;
                } else {
                    list += "," + document.getElementsByName("yybox")[i].value;
                }
            }
        }
    }
    if (list != "") {
		
        window.open("/play/?song_id=" + encode(list));
    } else {
        alert("请选择您要连续播放的心情音乐!");
    }
}

var n = 2;
function selectqtAll() {
    if (document.getElementsByName("qtbox") != null) {
        if (n % 2 == 0) {
            for (var i = 0; i < document.getElementsByName("qtbox").length; i++) {
                document.getElementsByName("qtbox")[i].checked = true;
            }
            n += 1;
        } else {
            for (var i = 0; i < document.getElementsByName("qtbox").length; i++) {
                document.getElementsByName("qtbox")[i].checked = false;
            }
            n += 1;
        }
    }
}
function previewqt() {
    var list = "";
    if (document.getElementsByName("qtbox") != null) {
        for (var i = 0; i < document.getElementsByName("qtbox").length; i++) {
            if (document.getElementsByName("qtbox")[i].checked == true) {
                if (list == "") {
                    list += document.getElementsByName("qtbox")[i].value;
                } else {
                    list += "," + document.getElementsByName("qtbox")[i].value;
                }
            }
        }
    }
    if (list != "") {
		
        window.open("/play/?song_id=" + encode(list));
    } else {
        alert("请选择您要连续播放的心情音乐!");
    }
}