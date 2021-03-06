
				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">


<h1>Tasks</h1>
<?php

Yii::app()->clientScript->registerScript('search', " 
$('.search-button').click(function(){ 
    $('.search-form').toggle(); 
    return false; 
}); 
$('.search-form form').submit(function(){ 
    $.fn.yiiGridView.update('tbl-tasks-grid', { 
        data: $(this).serialize() 
    }); 
    return false; 
}); 
"); 
?> 

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?> 
<div class="search-form" style="display:none"> 
<?php $this->renderPartial('_search',array( 
    'model'=>$model, 
)); ?>
</div><!-- search-form --> 
<?php /* $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */ ?>
<?php 
$groupGridColumns = $gridColumns;
$groupGridColumns[] = array(
    'name' => 'firstLetter',
    'value' => 'BWCFunctions::get_day_name(strtotime($data->DueDate))',//'substr($data->Description, 0, 1)',
    'headerHtmlOptions' => array('style'=>'display:none'),
    'htmlOptions' =>array('style'=>'display:none')
);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
	//'filter'=>$dataProvider,
	'id'=>'tbl-tasks-grid',
	'type'=>'striped bordered',
	'dataProvider' => $dataProvider,
	'template' => "{items}",
	'extraRowColumns'=> array('firstLetter'),
	'extraRowExpression' => '"<b style=\"font-size: 1.3em; color: #333;\">".BWCFunctions::get_day_name(strtotime($data->DueDate))."</b>"',
	'extraRowHtmlOptions' => array('style'=>'padding:10px'),
	'columns' => $groupGridColumns
)); 

?>

<div class="clearfix"></div>
</div></div>	


<script language="javascript" type="text/javascript">
function updateStatus(object)
{
	var status = 'Pending';
	
	if($("#"+object.id).is(':checked'))
	{status = 'Completed';}
	
	$.ajax({
			  type:'POST',
			  url: '/tasks/updateStatus/taskId/'+object.value+'/status/'+status,
		      success: function(data){
			  var obj = JSON.parse(data);
			  if(obj.Success)
			  {alert("Status Updated Successfully...!!");}
			  //noticeAjax("Application Status Updated Successfully ..!!","success");}
		   } 
         });
}
</script>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>