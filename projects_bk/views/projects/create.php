<?php
$this->breadcrumbs=array(
	'Tbl Projects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblProjects','url'=>array('index')),
	array('label'=>'Manage TblProjects','url'=>array('admin')),
);
?>

<h1>Create TblProjects</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>