<?php
$this->breadcrumbs=array(
	'Tbl Projects'=>array('index'),
	$model->ProjectId,
);

$this->menu=array(
	array('label'=>'List TblProjects','url'=>array('index')),
	array('label'=>'Create TblProjects','url'=>array('create')),
	array('label'=>'Update TblProjects','url'=>array('update','id'=>$model->ProjectId)),
	array('label'=>'Delete TblProjects','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ProjectId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblProjects','url'=>array('admin')),
);
?>

<h1>View TblProjects #<?php echo $model->ProjectId; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ProjectId',
		'MId',
		'ProjectName',
		'Description',
		'EstimatedTime',
		'ProductCId',
		'ProjectType',
		'PType',
		'StartDate',
		'Expiry',
		'TotalHours',
		'ConsumedHours',
		'TotalTimeInHours',
		'ConsumedTimeInHours',
		'CreatedBy',
		'CreatedOn',
		'LastViewedBy',
		'LastViewedOn',
		'ModifiedBy',
		'ModifiedOn',
		'IsActive',
		'IsDelete',
	),
)); ?>
