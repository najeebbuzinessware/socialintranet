<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' =>CHtml::encode($data->GroupName),
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>

<div class="view">


	<b><?php echo CHtml::encode($data->getAttributeLabel('GroupName')); ?>:</b>
	<?php echo CHtml::encode($data->GroupName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Avatar')); ?>:</b>
	<?php echo CHtml::encode($data->Avatar); ?>
	<br />


</div>

<?php $this->endWidget();?>