				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<h1>View Tasks</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'Description',
		array('name' => 'TagId', 'type'=>'html','value'=>TblSysTags::model()->getTagNamefromId($model->TagId)),
		array('name' => 'AssignTo', 'value'=>TblSysUsers::model()->findByPk($model->AssignTo)->Name),
		
		'DueDate',
		),
)); ?>


<div class="clearfix"></div>
</div></div>
<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
