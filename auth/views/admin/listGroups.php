<div id="outer_container" class="custom_background">
<?php $this->renderpartial('application.views.admin._adminTopmenu'); ?>
<div class="container_12">
<div class="grid_1">
  <div id="sideIcons"> <a href="#addGroup" title="Add Groups" class="icon groupIcon InlineModalTrigger"></a>
    <div class="halfmargin"></div>
    <? 
	foreach (range('A', 'Z') as $char) 
	{ 
		foreach($alphasort as $keyalpha=>$dataalpha)
		{
			if(strtoupper(strtolower($dataalpha['groupname']))==$char)
			{
	?>
        <a href="#s<?=$char ?>" class="textScroller InlineScrollTrigger">
			<?=$char ?>
        </a>
        <div class="halfmargin"></div>
    <? }}} ?>
    <a href="#" onClick="return: false;">&nbsp;</a> </div>
</div>
<div class="grid_11 box shadowed_little stick">
  <div class="padding">

                         <h2 class="headline1 noMargUp LEFT"><?=Yii::t("translate","Groups") ?></h2>
			 <div class="clear"></div>
			 <div class="s-lined"></div>
			 <div class="tinymargin"></div>
                         <p class="normaltxt1 noMargDown noMargUp"><?=Yii::t("translate","Manage, add, delete and update groups.") ?></p>

                    

    
    
    
    <div class="halfmargin"></div>
    <div class="bodyControls"> </div>
    <table class="default" cellpadding="10" cellspacing="0" border="0" id="posts">
      <?  
	  	if(count($groupmodel)>0)
		{
			foreach($groupmodel as $key=>$val)
			{
				  $criteria = new CDbCriteria;
				  $criteria->condition = "type=2 and IsDelete=0 and LEFT(name,1) IN ('".$val['groupname']."') AND MId = '".Yii::app()->user->MId."'";
				  $criteria->order = "name ASC";
				  $groups = TblSysAuthItem::model()->findAll($criteria);
		?>
      <tr class="post">
        <td colspan="2" class="charHolder" id="<?php if(is_numeric($val['groupname'])){ echo "sNumeric"; }else{ echo "s".$val['groupname']; }?>"><?php if(is_numeric($val['groupname'])) { echo "0 - 9"; }else { echo $val['groupname']; }?></td>
      </tr>
      <? 	foreach($groups as $keygrp=>$valgrp)
			{ 
				$jsid = $valgrp['AuthItemId'];
						 ?>
      <tr class="actionRow post" id="grp_<?=$jsid ?>">
        <td class="title">
        	<h4 class="headline2">
            	<?=$valgrp['name'] ?>
          	</h4>
        </td>
        <td class="controls">
          <a href="#editGroup" title="Edit Group" data-projID="<?=$valgrp['AuthItemId'] ?>" class="icon editIcon" id="el<?=$valgrp['AuthItemId'] ?>"></a>
          <a href="#" title="Delete Group" data-delID="<?=$valgrp['AuthItemId'] ?>" class="icon deleteIcon hidden" id="delete<?=$valgrp['AuthItemId'] ?>"></a>
        </td>
      </tr>
      <? } } } ?>
    </table>
    <?php 
			if(count($groupmodel)>0)
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
  <div id="editGroup" class="container_12"></div>
</div>

<?php $this->renderpartial('application.views.admin.modals._addGroup',array("model"=>$model)); ?>

<script type="text/javascript">
$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  console.log(elem.attr('id'));
	  $.ajax({
			  type:'POST',
			  url: '/admin/editGroup/id/'+$(this).attr('data-projID'),
		      success: function(data){

			  $('#editGroup').html(data)
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
			  url: '/admin/deleteGroup/id/'+$(this).attr('data-delID'),
		      success: function(data){

			  $("#grp_"+projid).hide(); 
			  noticeAjax("Group Deleted Successfully...!","success");
		   } 
         });
	   return false;
	}
}, 'a.deleteIcon');

</script>
