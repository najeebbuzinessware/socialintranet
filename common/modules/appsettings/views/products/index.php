<?php $gtype=BWDataFunction::getSectionNameFromCtype($_GET['type']); ?>
<div id="outer_container" class="custom_background">
<?php BWDataFunction::getSectionMenuFromCtype($_GET['type']); ?>
<div class="container_12">

<div class="grid_1">
  <div id="sideIcons"> 
  	<a href="#addProducts" title="<?=Yii::t("translate","Add Products") ?>" class="icon addIcon InlineModalTrigger"></a>
    <div class="halfmargin"></div>
    <? 
		foreach (range('A', 'Z') as $char) 
		{ 
			foreach($alphasort as $keyalpha=>$dataalpha)
			{
				if(strtoupper(strtolower($dataalpha['PName']))==$char)
				{
	?>
        <a href="#s<?=$char ?>" class="textScroller InlineScrollTrigger">
			<?=$char ?>
        </a>
        <div class="halfmargin"></div>
    <? }}} ?>
    <a href="#" onClick="return: false;">&nbsp;</a>
  </div>
</div>
  <div class="grid_11">
         <?php $this->renderpartial('appsettings.views._notificationMenu'); ?>
    </div>
<div class="grid_11 box shadowed_little stick">
  <div class="padding">
    <h2 class="headline1-inner smallLockIcon lined">
      <?=Yii::t("translate","Products List") ?>
    </h2>
    <div class="halfmargin"></div>
    <div class="bodyControls"> </div>
    <table class="default" cellpadding="10" cellspacing="0" border="0" id="posts">
      <?	if(count($productmodel)>0)
	  		{
			 	foreach($productmodel as $keycon=>$valcon)
				{
					$criteria = new CDbCriteria;
					$criteria->condition = "LEFT(Name,1) IN ('".$valcon['PName']."') AND MId = '".Yii::app()->user->MId."' AND CType = '".$_GET['type']."'";
					$criteria->order = "Name ASC";
					$content = TblProductCatalog::model()->findAll($criteria);
	?>
      <tr class="post">
        <td colspan="2" class="charHolder" id="<?php if(is_numeric($valcon['PName'])){ echo "sNumeric"; }else{ echo "s".$valcon['PName']; }?>">
			<?php if(is_numeric($valcon['PName'])) { echo "0 - 9"; }else { echo $valcon['PName']; }?>
        </td>
      </tr>
		<?	foreach($content as $key=>$val)
	  		{
				$jsid = $val['PId'];
		?>
      <tr class="actionRow post" id="user_<?=$jsid ?>">
        <td class="title">
        	<h4 class="headline4">
            	<?=$val['Name'] ?>
        	</h4>
        </td>
        <td class="controls">
        	<a href="#editProducts" title="<?=Yii::t("translate","Edit Product") ?>" data-projID="<?=$val['PId'] ?>" class="icon editIcon" id="el<?=$val['PId'] ?>"></a>					
            <a href="#" title="<?=Yii::t("translate","Delete Product") ?>" data-delID="<?=$val['PId'] ?>" class="icon deleteIcon hidden" id="delete<?=$val['PId'] ?>"></a> 
        </td>
      </tr>
      <? } } } ?>
    </table>
    <?php 
			if(count($productmodel)>0)
			{
				$this->widget('common.extensions.yiinfinite-scroll.YiinfiniteScroller', array(
					'contentSelector' => '#posts',
					'itemSelector' => 'tr.post',
					'loadingImg' => 'http://assets.bw.ae/bw/images/apps/ajax-loader.gif',
					'loadingText' => '&nbsp;',
					'donetext' => '&nbsp;',
					'pages' => $pages
			));
			}
			else{ echo "No Records Found"; } ?>
    <div class="margin"></div>
  </div>
</div>

<div class="modal" id="editDiv">
  <div id="editProducts" class="container_12"></div>
</div>

<?php $this->renderpartial('appsettings.views.modals._addProducts',array("model"=>$model)); ?>

<script type="text/javascript">

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  console.log(elem.attr('id'));
	  $.ajax({
			  type:'POST',
			  url: '<?php echo $gtype?>/appsettings/products/editProducts/type/<?=$_GET['type']?>/id/'+$(this).attr('data-projID'),
		      success: function(data){

			  $('#editProducts').html(data)
			  elem.colorbox({ inline:true, open:true });
		   } 
         });
	   return false;
	}
}, 'a.editIcon');

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  console.log(elem.attr('id'));
	  var projid = $(this).attr('data-delID');
	  $.ajax({
			  type:'POST',
			  url: '<?php echo $gtype?>/appsettings/products/deleteProducts/type/<?=$_GET['type']?>/id/'+$(this).attr('data-delID'),
		      success: function(data){

			  $("#user_"+projid).hide(); 
			  noticeAjax("Product Deleted Successfully...!","success");
		   } 
         });
	   return false;
	}
}, 'a.deleteIcon');

</script>
