
var cmpo = parent.CMP.get("cmp") || top.CMP.get("cmp");
//alert(cmpo);
function $(id) { return document.getElementById(id); }
function highlight(o, c){
	o.style.backgroundColor = c;
	o.onmouseout = function(){ o.style.backgroundColor = ""; }
}
function checkAll(o){
	var cbs = document.getElementsByTagName("input");
	for (var i = 0; i < cbs.length; i ++) {
		var cb = cbs[i];
		if (cb.type == "checkbox" && cb.value) {
			cb.checked = o.checked;
		}
	}
}
function sendEvent(type, data) {
	cmpo.sendEvent(type, data);
}

function cmp_play(ids) {
	if (!cmpo) {
		return;
	}
	var config = cmpo.config();
	var play_id = cmpo.list().length + 1;
	if (config["state"] == "playing") {
		cmpo.sendEvent("view_stop");
	}
	var xml = makeListXml(ids);
	cmpo.list_xml(xml);
	cmpo.sendEvent("view_play", play_id);
}
function cmp_add(ids) {
	if (!cmpo) {
		return;
	}
	var xml = makeListXml(ids);
	cmpo.list_xml(xml);
}
function makeListXml(ids) {
	var xml = "<list>";
	for (var i = 0; i < ids.length; i ++) {
		xml += '<m label="'+arrName[ids[i]]+'" src="'+arrUrl[ids[i]]+'" bg_video="'+arrBgimg[ids[i]]+'" />';
	}
	xml += "</list>";
	return xml;
}
function play(id) {
	cmp_play([id]);
}
function add(id) {
	cmp_add([id]);
}
function playSelected() {
	var ids = getSelected();
	if (ids.length) {
		cmp_play(ids);
	} else {
		alert("请至少选择一个");	
	}
}
function addSelected() {
	var ids = getSelected();
	if (ids.length) {
		cmp_add(ids);
	} else {
		alert("请至少选择一个");	
	}
}
function getSelected() {
	var ids = [];
	var cbs = document.getElementsByTagName("input");
	for (var i = 0; i < cbs.length; i ++) {
		var cb = cbs[i];
		if (cb.type == "checkbox") {
			if (cb.checked && cb.value) {
				ids.push(cb.value);	
			}
		}
	}
	return ids;
}

function clearMusic() {
	if (cmpo) {
		//覆盖一个空列表
		cmpo.list_xml('<list></list>', false);
		//showWin("list");
		showMsg("已经清除列表内容");
	}
	else 
	{
		showMsg("播放器还未初始化", true);
	}
}
function cmp_loaded(key) {
	//cmp loaded
	cmpo = CMP.get("cmp");
	if (cmpo) {
		//cmp callback
		//alert(cmpo.config("version"));
		document.title = cmpo.config("name");
		cmpo.addEventListener("model_load", "cmp_model_load");
	}
}
function cmp_model_load(data) {
	document.getElementById("playnow").innerHTML = "正在播放："+cmpo.item("label");
}

/*
早期版本
var cmpo;
function $(id) { return document.getElementById(id); }
//播放器加载完成回调函数
function cmp_loaded(key) {
	cmpo = CMP.get("cmp");
	if (!cmpo) {
		return;
	}
	//侦听列表项删除事件
	cmpo.addEventListener("item_deleted", "itemDeleted");
	cmpo.addEventListener("item_opened", "itemOpened");
	cmpo.addEventListener("item_closed", "itemClosed");
	//输出事件类型列表
	var str = cmpo.cmp_api();
	//alert(str);
	var arr = str.match(/"\w+";/g);
	var en = $("event_name");
	for (var i = 0; i < arr.length; i ++) {
		var e = arr[i];
		e = e.replace(/"|;/g, "");
		en.options.add(new Option(e, e));
	}	
}
function itemDeleted(obj) {
	$("output").value = "item_deleted:\n" + obj2str(obj);	
}
function itemOpened(obj) {
	$("output").value = "item_opened:\n" + obj2str(obj);	
}
function itemClosed(obj) {
	$("output").value = "item_closed:\n" + obj2str(obj);	
}

function sendEvent(type, data) {
	cmpo.sendEvent(type, data);
}

function cmp_play(ids) {
	if (!cmpo) {
		return;
	}
	var config = cmpo.config();
	var play_id = cmpo.list().length + 1;
	if (config["state"] == "playing") {
		cmpo.sendEvent("view_stop");
	}
	var xml = makeListXml(ids);
	cmpo.list_xml(xml);
	cmpo.sendEvent("view_play", play_id);
}
function cmp_add(ids) {
	if (!cmpo) {
		return;
	}
	var xml = makeListXml(ids);
	cmpo.list_xml(xml);
}
function makeListXml(ids) {
	var xml = "<list>";
	for (var i = 0; i < ids.length; i ++) {
		xml += '<m label="'+arrName[ids[i]]+'" src="'+arrUrl[ids[i]]+'" bg_video="'+arrBgimg[ids[i]]+'" />';
	}
	xml += "</list>";
	return xml;
}
function play(id) {
	cmp_play([id]);
}
function add(id) {
	cmp_add([id]);
}
*/