<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tbl-projects-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'MId',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'ProjectName',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'EstimatedTime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ProductCId',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ProjectType',array('class'=>'span5','maxlength'=>9)); ?>

	<?php echo $form->textFieldRow($model,'PType',array('class'=>'span5','maxlength'=>8)); ?>

	<?php echo $form->textFieldRow($model,'StartDate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Expiry',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TotalHours',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ConsumedHours',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TotalTimeInHours',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ConsumedTimeInHours',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CreatedBy',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CreatedOn',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'LastViewedBy',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'LastViewedOn',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'ModifiedBy',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ModifiedOn',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'IsActive',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'IsDelete',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
