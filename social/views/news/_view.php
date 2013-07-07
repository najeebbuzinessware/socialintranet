<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RssId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RssId),array('view','id'=>$data->RssId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ItemName')); ?>:</b>
	<?php echo CHtml::encode($data->ItemName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RssLink')); ?>:</b>
	<?php echo CHtml::encode($data->RssLink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NumberOfNews')); ?>:</b>
	<?php echo CHtml::encode($data->NumberOfNews); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserId')); ?>:</b>
	<?php echo CHtml::encode($data->UserId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MId')); ?>:</b>
	<?php echo CHtml::encode($data->MId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->CreateDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatedBy')); ?>:</b>
	<?php echo CHtml::encode($data->CreatedBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ModifiedDate')); ?>:</b>
	<?php echo CHtml::encode($data->ModifiedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ModifiedBy')); ?>:</b>
	<?php echo CHtml::encode($data->ModifiedBy); ?>
	<br />

	*/ ?>

</div>