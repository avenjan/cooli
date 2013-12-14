<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
 include $this->CompilerInclude("header.htm");
 ?>

<div id="side" class="left">
	<?php include $this->CompilerInclude("side_search.htm");
  include $this->CompilerInclude("side_class.htm");
  include $this->CompilerInclude("side_news.htm");
 ?>
</div>

<!--begin main-->
<div id="main" class="right">

<div class="box">
	<h2>联系我们</h2>
</div>
<div class="infobox">
<ul>
	<li><span>公司名称：</span><?php echo $GLOBALS['_vars']['company']; ?></li>
	<li><span>贸易种类：</span><?php echo $GLOBALS['_vars']['vocation']; ?></li>
	<li><span>主营产品：</span><?php echo $GLOBALS['_vars']['product']; ?></li>
	<li><span>公司规模：</span><?php echo $GLOBALS['_vars']['cosize']; ?></li>
	<li><span>所在地：</span><?php echo $GLOBALS['_vars']['place']; ?></li>
	<li><span>联系人：</span><?php echo $GLOBALS['_vars']['linkman']; ?></li>
	<li><span>电话：</span><?php echo $GLOBALS['_vars']['tel']; ?></li>
	<li><span>传真：</span><?php echo $GLOBALS['_vars']['fax']; ?></li>
	<li><span>网址：</span><?php echo $GLOBALS['_vars']['url']; ?></li>
	<li><span>Email：</span><a href="mailto:<?php echo $GLOBALS['_vars']['email']; ?>"><?php echo $GLOBALS['_vars']['email']; ?></a></li>
	<li><span>地址：</span><?php echo $GLOBALS['_vars']['address']; ?></li>
</ul>
</div>	

</div>
<!--end main-->

<?php include $this->CompilerInclude("footer.htm");
 ?>