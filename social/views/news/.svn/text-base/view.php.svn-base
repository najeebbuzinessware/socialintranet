<?php

$this->menu=array(
	array('label'=>'List TblNewsRss','url'=>array('index')),
	array('label'=>'Create TblNewsRss','url'=>array('create')),
	array('label'=>'Update TblNewsRss','url'=>array('update','id'=>$model->RssId)),
	array('label'=>'Delete TblNewsRss','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->RssId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblNewsRss','url'=>array('admin')),
);
?>

<h1>View News</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'RssId',
		'ItemName',
		'RssLink',
		'NumberOfNews',
		'UserId',
		'MId',
		'CreateDate',
		'CreatedBy',
		'ModifiedDate',
		'ModifiedBy',
	),
)); ?>
