<?php

$this->menu=array(
	array('label'=>'List TblSysNewsTaskSettings','url'=>array('index')),
	array('label'=>'Create TblSysNewsTaskSettings','url'=>array('create')),
	array('label'=>'Update TblSysNewsTaskSettings','url'=>array('update','id'=>$model->SetId)),
	array('label'=>'Delete TblSysNewsTaskSettings','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->SetId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblSysNewsTaskSettings','url'=>array('admin')),
);
?>

<h1>View TblSysNewsTaskSettings #<?php echo $model->SetId; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'SetId',
		'MId',
		'UserId',
		'RecordLimit',
		'FeedId',
		'CType',
		'CreatedBy',
		'CreatedOn',
		'ModifiedBy',
		'ModifiedOn',
	),
)); ?>
