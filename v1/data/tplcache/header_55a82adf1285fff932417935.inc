<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $GLOBALS['_vars']['spacename'];  echo $GLOBALS['_vars']['curtitle']; ?></title>
<link href="space/company/images/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="showmenu" style="z-index:100;display:none;"></div>
<div class="wrap1"><div class="wrap2"><div class="wrap3">
<div dargarea='yes' id="container">
  <!--begin header-->
  <div id="header">
	<div id="title">
	  <h1>
	  	<?php
	  	if(empty($_vars['spacelogo'])) {
	  	?>
	  	<a href="<?php echo $GLOBALS['_vars']['userurl']; ?>"><?php echo $GLOBALS['_vars']['spacename']; ?></a>
	  	<?php } else { ?>
	  	<a href="<?php echo $GLOBALS['_vars']['userurl']; ?>"><img src="<?php echo $GLOBALS['_vars']['spacelogo']; ?>" width="200" height="50" alt="<?php echo $GLOBALS['_vars']['spacename']; ?>" /></a>
	  	<?php } ?>
	  </h1>
	  <div class="fr tar" id="toolbar">
		<a href="<?php echo $GLOBALS['cfg_basehost']; ?>" target="_blank"><?php echo $GLOBALS['cfg_basehost']; ?></a><br />	
		<?php if($cfg_ml->IsLogin()){ ?>
		<a href="index.php?uid=<?php echo $GLOBALS['cfg_ml']->M_LoginID; ?>">我的主页</a>
		| &nbsp;
		<a href="index.php">会员中心</a>
		| &nbsp;<a href="edit_space_info.php" target="_blank">空间管理</a> | <a href="index_do.php?fmdo=login&dopost=exit">注销</a>
 		<?php
}
else{
?>
		<a href="login.php">登录</a> | <a href="index_do.php?fmdo=user&dopost=regnew">注册</a>
 		<?php } ?>
	  </div>
	</div>
	<div class="c"></div>
	<ul id="guide">
	  <li><a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>">首页</a></li>
		<li><a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>&action=introduce">公司简介</a></li>
		<li><a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>&action=article">新闻动态</a></li>
		<li><a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>&action=products">产品展示</a></li>
		<?php
		foreach($_vars['bloglinks'] as $k=>$v)
		{
			if($k==6) continue;
			if($k==2) {
				echo "		<li><a href=\"index.php?uid={$_vars['userid_e']}&action=album\">相册</a></li>\r\n";
			}
			else {
				echo "		<li><a href=\"index.php?uid={$_vars['userid_e']}&action=archives&channelid={$k}\">{$v}</a></li>\r\n";
			}
		}
		?>
	  <li><a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>&action=guestbook">在线留言</a></li>
	  <li><a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>&action=contact">联系我们</a></li>
	</ul>
  </div>
  <div class="c" ></div>