<!-- $Id: shop_config.htm 16865 2009-12-10 06:05:32Z sxc_shop $ -->
<!-- 修改 by www.68ecshop.com 百度编辑器 begin -->
<?php echo $this->fetch('pageheader_bd.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,selectzone_bd.js,validator.js')); ?>
<!-- 修改 by www.68ecshop.com 百度编辑器 end -->
<link href="styles/jquery.bigcolorpicker.css" rel="stylesheet" type="text/css" />
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,../js/region.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery-1.6.1.js,jquery.bigcolorpicker.js')); ?>

<script type="text/javascript"></script>
<script type="text/javascript">
		$(function(){
			$("#demo1Text").bigColorpicker();
			
		})
	</script>

  <!-- tab bar -->
  <!-- tab body -->
  <div id="tabbody-div">
    <form enctype="multipart/form-data" name="theForm" action="?act=post" method="post">
    <table width="90%" id="detail-table">
	  <tr>
	    <td>定义颜色：</td><td><input name="shop_header_color" type="text" value="<?php echo $this->_var['color']; ?>" id="demo1Text" size="40" /></td>
	  </tr>
	  	<tr>
	  <td>定义头部：</td><td><input type="file" name="goods_img"  value="选择" />（建议图片宽度：1210px，高度不限）</td>
	  </tr>
	</table>
	<?php if ($this->_var['picture'] != " � � � � � �� � logo� � �banner " || ""): ?>
  <div  style="margin: 0 auto; padding: 15px 0; text-align: center;">  <img src="../<?php echo $this->_var['picture']; ?>" width="900px" height="100px;"/> </div>
  <?php endif; ?>
    <div class="button-div">
      <input name="submit" type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
      <input name="reset" type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
    </div>
    </form>
  </div>

<?php echo $this->smarty_insert_scripts(array('files'=>'tab.js,validator.js')); ?>

<script language="JavaScript">


region.isAdmin = true;
onload = function()
{
    // 开始检查订单
    startCheckOrder();
}
var ReWriteSelected = null;
var ReWriteRadiobox = document.getElementsByName("value[209]");

for (var i=0; i<ReWriteRadiobox.length; i++)
{
  if (ReWriteRadiobox[i].checked)
  {
    ReWriteSelected = ReWriteRadiobox[i];
  }
}

function ReWriterConfirm(sender)
{
  if (sender == ReWriteSelected) return true;
  var res = true;
  if (sender != ReWriteRadiobox[0]) {
    var res = confirm('<?php echo $this->_var['rewrite_confirm']; ?>');
  }

  if (res==false)
  {
      ReWriteSelected.checked = true;
  }
  else
  {
    ReWriteSelected = sender;
  }
  return res;
}
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>