<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
				
<!-- Main Body -->
<section id="content">

<?php

$this->menu=array(
	array('label'=>'List TblUserContacts','url'=>array('index')),
	array('label'=>'Manage TblUserContacts','url'=>array('admin')),
);
?>

<h1>Create </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<div class="clearfix"></div>
</section>