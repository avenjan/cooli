<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
 include $this->CompilerInclude("header.htm");
 ?>

<div id="side" class="left">
	<?php include $this->CompilerInclude("side_icon.htm");
  include $this->CompilerInclude("side_class.htm");
  include $this->CompilerInclude("side_visitor.htm");
  include $this->CompilerInclude("side_search.htm");
 ?>
</div>

 <!--begin main-->
<div id="main" class="right">
<div class="box">
<h2>公司新闻列表
<img src="space/lxvista/images/write.gif"><a href="article_add.php" class="noul"><span class="gray fn">添加新闻</span></a>
</h2>
<!--begin-->
<?php
$atts = array();
$atts['tagname'] = 'datalist';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{
?>
	  <div class="text">
		<div class="gray"><?php echo MyDate('y-m-d h:i',$fields['pubdate']); ?></div>
		<h3>
			<a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>&action=viewarchives&aid=<?php echo $fields['id']; ?>" class="noul"><?php echo $fields['title']; ?></a>
		</h3>
		<table class="blog-content">
		  <tr>
			<td>
			  <p>
			  	<?php if(!preg_match("#defaultpic#",$fields['litpic'])){ ?>
							<img src='<?php echo $fields['litpic']; ?>' />
					<?php }  echo cn_substr($fields['body'], 500);; ?>
				</p>
        <p><a href='index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>&action=viewarchives&aid=<?php echo $fields['id']; ?>'>&lt;&lt;详细内容</a>
			</td>
		  </tr>
		</table>
		<div class="bb">
		  <div>
		  类别：
		  <?php if($fields['mtypename']==''){ ?>
		  	<a href="#">无分类</a> | 
      <?php
}
else{
?>
        <a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>&action=archives&mtype=<?php echo $mty['mtypeid']; ?>"><?php echo $fields['mtypename']; ?></a> | 
			<?php } ?>
			  <a href="<?php echo $fields['arcurl']; ?>" target="_blank" title="<?php echo $fields['title']; ?>">浏览全文</a>(<?php echo $fields['click']; ?>) | 
        <a href="<?php echo $GLOBALS['cfg_phpurl']; ?>/feedback.php?aid=<?php echo $fields['id']; ?>" target="_blank">好评度</a>(<?php echo $fields['scores']; ?>)
		  </div>
		  <div class="c"></div>
		</div>
		</div>
<?php
}
}?>
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