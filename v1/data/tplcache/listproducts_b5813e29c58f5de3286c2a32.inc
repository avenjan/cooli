<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
 include $this->CompilerInclude("header.htm");
 ?>

<div id="side" class="left">
	<?php include $this->CompilerInclude("side_icon.htm");
  include $this->CompilerInclude("side_class.htm");
  include $this->CompilerInclude("side_search.htm");
 ?>
</div>

<!--begin main-->
<div id="main" class="right">
<div class="box">
	<h2>产品列表</h2>
	<!--begin-->
<div class="text">
	<table class="blog-content">
	<tr>
		<td>
		<div class="listPic listPic-albumn">
		<?php
$atts = array();
$atts['tagname'] = 'datalist';
$atts['titlelen'] = '20';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{
?>
		<dl>
			<dd><a href="<?php echo $fields['arcurl']; ?>"><img src='<?php echo $fields['litpic']; ?>'/></dd>
			<dt><a href="<?php echo $fields['arcurl']; ?>"><?php echo $fields['title']; ?></a></dt>
		</dl>
		<?php
}
}?>
		</div>
		<div class="c"></div>
		</td>
		</tr>
	</table>
</div>
<div class="big"><div class="pages"><?php
$atts = array();
$atts['tagname'] = 'pagelist';
 echo $this->refObj->GetPageList($atts,$this->refObj,$fields); 
?>
</div></a></span></div>
<!--end-->
	</div>
</div>
<!--end main-->

<?php include $this->CompilerInclude("footer.htm");
 ?>