<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'RssId',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ItemName',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'RssLink',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'NumberOfNews',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'UserId',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'MId',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CreateDate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CreatedBy',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ModifiedDate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ModifiedBy',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
