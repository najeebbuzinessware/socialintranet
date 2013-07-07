<div class="view">
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('Tags')); ?>:</b>
	<?php echo CHtml::encode($data->Tags); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TagColor')); ?>:</b>
	 <span class="label <?php echo $data->TagColor; ?>"><?php echo CHtml::encode($data->Tags); ?></span>
	<br />

</div>