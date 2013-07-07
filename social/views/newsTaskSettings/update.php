<?php

$this->menu=array(
	array('label'=>'List TblSysNewsTaskSettings','url'=>array('index')),
	array('label'=>'Create TblSysNewsTaskSettings','url'=>array('create')),
	array('label'=>'View TblSysNewsTaskSettings','url'=>array('view','id'=>$model->SetId)),
	array('label'=>'Manage TblSysNewsTaskSettings','url'=>array('admin')),
);
?>

<h1>Update TblSysNewsTaskSettings <?php echo $model->SetId; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>