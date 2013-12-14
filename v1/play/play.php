<?php 
require_once("../include/common.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>酷爱音乐</title>
<style type="text/css">
html,body{ margin:0; padding:0; text-align:center}
#player{width:600px; height:400px; background:#333333; margin:0 auto; padding:0}
</style>

<script type="text/javascript" src="cmp.js"></script>
</head>
<body>
<div id="player">
<script type="text/javascript">
var cmpo;
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
	document.title = cmpo.item("label");
}
var flashvars = {
	api : "cmp_loaded"
};
//id, width, height, swf_url, flashvars, params, attrs
var htm = CMP.create("cmp", "100%", "100%", "player.swf?skins=&php=2&lists=play_list.php?song_id=<?php echo $song_id ?>", flashvars);
document.getElementById("player").innerHTML = htm;
</script>

</div>

</body>
</html>
