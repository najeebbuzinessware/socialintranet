
<div class="view horizontal">
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DueDate')); ?>:</b>
	<?php echo CHtml::encode($data->DueDate)." ".CHtml::encode($data->DueTime); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('AssignTo')); ?>:</b>
	<?php echo CHtml::encode($data->AssignTo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TagId')); ?>:</b>
	<?php echo TblSysTags::model()->getTagNamefromId($data->TagId); ?>
		
	
	<br />
	<br />
	
</div>
