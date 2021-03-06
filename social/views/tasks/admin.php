				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<!-- <h1>Manage Tasks</h1> -->
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

<h1>Manage Tasks</h1> 

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?> 
<div class="search-form" style="display:none"> 
<?php $this->renderPartial('_search',array( 
    'model'=>$model, 
)); ?>
</div><!-- search-form --> 

<?php $this->widget('bootstrap.widgets.TbExtendedGridView',array(
	'id'=>'tbl-tasks-grid',
	'dataProvider'=>$model->search(),
 	'filter'=>$model,
	'columns'=>array(
			
			array(
					'name' => 'Description',
					'header' => 'Task',
					'class' => 'bootstrap.widgets.TbEditableColumn',
					//'headerHtmlOptions' => array('style' => 'width:80px'),
					'editable' => array(
							'type' => 'text',
							'url' => $this->createUrl('tasks/updateTask'),
			
					)
			),
			array(
					'name'=>'TagId',
					'value' => 'TblSysTags::model()->findByPk($data->TagId)->Tags',
					//'value' => 'TblCategories::model()->findByPk($data->CategoryId)->Category',
					'header' => 'Tags',
					'class' => 'bootstrap.widgets.TbEditableColumn',
					//'headerHtmlOptions' => array('style' => 'width:80px'),
					'editable' => array(
							'type' => 'select',
							'url' => $this->createUrl('tasks/updateTask'),
							'source' => TblSysTags::model()->getTagsFromMId(),
								
					)
			),
			array(
					'name' => 'AssignTo',
					'value' => 'TblSysUsers::model()->findByPk($data->AssignTo)->Name',
					'header' => 'Responsible',
					'class' => 'bootstrap.widgets.TbEditableColumn',
					//'headerHtmlOptions' => array('style' => 'width:80px'),
					'editable' => array(
							'type' => 'select',
							'url' => $this->createUrl('tasks/updateTask'),
							'source' => TblSysUsers::model()->getUsersFromMId(),
			
					)
			),
			array(
					'name' => 'DueDate',
					'header' => 'Due Date',
					'value' => '$data->DueDate',
					
			),
			
			array(
					'name' => 'ShowToAll',
					'value' => 'TblTasks::model()->getVisibilityoption($data->ShowToAll)',
					'header' => 'Show To All',
					
			),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>


<div class="clearfix"></div>
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>

