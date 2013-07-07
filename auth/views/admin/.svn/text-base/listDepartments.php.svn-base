<div id="outer_container" class="custom_background">
<?php $this->renderpartial('application.views.admin._adminTopmenu'); ?>
<div class="container_12">

<div class="grid_1">
  <div id="sideIcons"> <a href="#addDepartment" title="<?=Yii::t("translate","Add Departments") ?>" class="icon addIcon InlineModalTrigger"></a>
    <div class="halfmargin"></div>
    <? 
	foreach (range('A', 'Z') as $char) 
	{ 
		foreach($alphasort as $keyalpha=>$dataalpha)
		{
			if(strtoupper(strtolower($dataalpha['Name']))==$char)
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
    <h2 class="headline1-inner m-t-0">
      <?=Yii::t("translate","Departments List") ?>
    </h2>
    <div class="s-lined"></div>
    <div class="halfmargin"></div>
    <div class="bodyControls"> </div>
    <table class="default" cellpadding="10" cellspacing="0" border="0" id="posts">
      <? 	if(count($departmodel)>0)
	  		{
			 	foreach($departmodel as $userkey=>$userval)
				{
					$criteria = new CDbCriteria;
					$criteria->condition = "IsDelete=0 and LEFT(Department,1) IN ('".$userval['Name']."') AND MId = '".Yii::app()->user->MId."'";
					$criteria->order = "Department ASC";
					$deaprtments = TblDepartments::model()->findAll($criteria);
	?>
      <tr class="post">
        <td colspan="2" class="charHolder" id="<?php if(is_numeric($userval['Name'])){ echo "sNumeric"; }else{ echo "s".$userval['Name']; }?>"><?php if(is_numeric($userval['Name'])) { echo "0 - 9"; }else { echo $userval['Name']; }?></td>
      </tr>
      <? 	foreach($deaprtments as $key=>$val)
	  		{
				$jsid = $val['DeptId'];
		?>
      <tr class="actionRow post" id="user_<?=$jsid ?>">
        <td class="title">
        	<h4 class="headline2">
            	<?=$val['Department'] ?>
          	</h4>
        </td>
        <td class="controls">
        	<a href="#editDepartment" title="Edit Departments" data-projID="<?=$val['DeptId'] ?>" class="icon editIcon" id="el<?=$val['DeptId'] ?>"></a> 
            <a href="#" title="Delete Department" data-delID="<?=$val['DeptId'] ?>" class="icon deleteIcon hidden" id="delete<?=$val['DeptId'] ?>"></a> 
        </td>
      </tr>
      <? } } } ?>
    </table>
    <?php 	if(count($departmodel)>0)
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
			else
			{ echo "No Records Found"; } ?>
    <div class="margin"></div>
  </div>
</div>

<div class="modal" id="editDiv">
  <div id="editDepartment" class="container_12 w400"></div>
</div>

<?php $this->renderpartial('application.views.admin.modals._addDepartment',array("model"=>$model)); ?>
<script type="text/javascript">

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  console.log(elem.attr('id'));
	  $.ajax({
			  type:'POST',
			  url: '/admin/editDepartment/id/'+$(this).attr('data-projID'),
		      success: function(data){

			  $('#editDepartment').html(data)
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
			  url: '/admin/deleteDepartment/id/'+$(this).attr('data-delID'),
		      success: function(data){

			  $("#user_"+projid).hide(); 
			  noticeAjax("Department Deleted Successfully...!","success");
		   } 
         });
	   return false;
	}
}, 'a.deleteIcon');

</script>
