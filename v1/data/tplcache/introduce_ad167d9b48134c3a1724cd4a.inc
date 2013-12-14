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
	<h2>公司简介</h2>
</div>
<div class="infobox">
	<div class="introduce">
		<img src="<?php echo $GLOBALS['_vars']['comface']; ?>" alt="<?php echo $GLOBALS['_vars']['company']; ?>照片" />
		<?php echo $GLOBALS['_vars']['introduce']; ?>
	</div>
	<ul>
		<li><span>公司名称：</span><?php echo $GLOBALS['_vars']['company']; ?></li>
		<li><span>贸易种类：</span><?php echo $GLOBALS['_vars']['vocation']; ?></li>
		<li><span>主营产品：</span><?php echo $GLOBALS['_vars']['product']; ?></li>
		<li><span>公司规模：</span><?php echo $GLOBALS['_vars']['cosize']; ?></li>
		<li><span>所在地：</span><?php echo $GLOBALS['_vars']['place']; ?></li>
	</ul>
</div>

<div class="box">
	<h2>联系方式</h2>
</div>
<div class="infobox">
<ul>
	<li>联系人：<?php echo $GLOBALS['_vars']['linkman']; ?></li>
	<li>电话：<?php echo $GLOBALS['_vars']['tel']; ?></li>
	<li>传真：<?php echo $GLOBALS['_vars']['fax']; ?></li>
	<li>网址： <?php echo $GLOBALS['_vars']['url']; ?></li>
	<li>Email： <?php echo $GLOBALS['_vars']['email']; ?></li>
	<li>地址：<?php echo $GLOBALS['_vars']['address']; ?></li>
</ul>
</div>	

</div>
<!--end main-->

<?php include $this->CompilerInclude("footer.htm");
 ?>