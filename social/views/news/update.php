<?php

$this->menu=array(
	array('label'=>'List TblNewsRss','url'=>array('index')),
	array('label'=>'Create TblNewsRss','url'=>array('create')),
	array('label'=>'View TblNewsRss','url'=>array('view','id'=>$model->RssId)),
	array('label'=>'Manage TblNewsRss','url'=>array('admin')),
);
?>

<h1>Update TblNewsRss <?php echo $model->RssId; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>