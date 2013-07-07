<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'AnnouncementId',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'MId',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textAreaRow($model,'Title',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'Content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'Status',array('class'=>'span5','maxlength'=>9)); ?>

	<?php echo $form->textFieldRow($model,'PublishDate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EndDate',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'Sandbox',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'CreatedBy',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CreatedOn',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'LastViewedBy',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'LastViewedOn',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ModifiedBy',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ModifiedOn',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'IsDelete',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
