				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<h1>Update <?php //echo $model->Userid; ?></h1>
<?php
$this->widget('bootstrap.widgets.TbTabs', array(
	'type'=>'tabs', // 'tabs' or 'pills'
	'tabs'=>array(
		array('label'=>'Profile', 'content'=>$this->renderPartial('_form',array('model'=>$model),true), 'active'=>true),
		array('label'=>'Settings', 'content'=>$this->renderPartial('_settingsform',array('model'=>$model),true)),
	),
)); 

?>

<?php //echo $this->renderPartial('_form',array('model'=>$model)); ?>

<div class="clearfix"></div>
</div></div>
<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
