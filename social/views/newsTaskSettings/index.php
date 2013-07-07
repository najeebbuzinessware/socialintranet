<?php

$this->menu=array(
	array('label'=>'Create TblSysNewsTaskSettings','url'=>array('create')),
	array('label'=>'Manage TblSysNewsTaskSettings','url'=>array('admin')),
);
?>

<h1>Tbl Sys News Task Settings</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
