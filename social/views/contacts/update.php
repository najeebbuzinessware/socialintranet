
				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<?php

$this->menu=array(
	array('label'=>'List TblUserContacts','url'=>array('index')),
	array('label'=>'Create TblUserContacts','url'=>array('create')),
	array('label'=>'View TblUserContacts','url'=>array('view','id'=>$model->ContactId)),
	array('label'=>'Manage TblUserContacts','url'=>array('admin')),
);
?>

<h1>Update</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

<div class="clearfix"></div>
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>