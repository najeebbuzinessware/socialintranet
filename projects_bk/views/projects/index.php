<?php
$this->breadcrumbs=array(
	'Tbl Projects',
);

$this->menu=array(
	array('label'=>'Create TblProjects','url'=>array('create')),
	array('label'=>'Manage TblProjects','url'=>array('admin')),
);
?>

<h1>Tbl Projects</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
