
				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<?php

$this->menu=array(
	array('label'=>'List TblUserContacts','url'=>array('index')),
	array('label'=>'Create TblUserContacts','url'=>array('create')),
	array('label'=>'Update TblUserContacts','url'=>array('update','id'=>$model->ContactId)),
	array('label'=>'Delete TblUserContacts','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ContactId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblUserContacts','url'=>array('admin')),
);
?>

<h1>View Contact</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'Name',
		'Number',
		'Email',
		'Company',
		'JobProfile',
		'TagId',
	),
)); ?>

<div class="clearfix"></div>
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
