<?php
$this->breadcrumbs=array(
	'Tbl Projects'=>array('index'),
	$model->ProjectId=>array('view','id'=>$model->ProjectId),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblProjects','url'=>array('index')),
	array('label'=>'Create TblProjects','url'=>array('create')),
	array('label'=>'View TblProjects','url'=>array('view','id'=>$model->ProjectId)),
	array('label'=>'Manage TblProjects','url'=>array('admin')),
);
?>

<h1>Update Project <?php echo $model->ProjectId; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'product'=>$product,'PType'=>$PType,'isActive'=>$isActive)); ?>