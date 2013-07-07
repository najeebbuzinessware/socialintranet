<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tbl-sys-news-task-settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'MId',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'UserId',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'RecordLimit',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'FeedId',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CType',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'CreatedBy',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CreatedOn',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ModifiedBy',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ModifiedOn',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
