<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tbl-user-contacts-form',
	'action'=>$model->isNewRecord ? '/contacts/create' : '/contacts/update',	
	'type'=>'horizontal', 
    'enableAjaxValidation'=>true,
	'clientOptions' => array('validateOnSubmit' => true),
  	'htmlOptions' => array("class"=>"form-horizontal"),	 
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'Number',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'Company',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'JobProfile',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->dropDownListRow($model,'TagId',TblSysTags::model()->getTagsFromMId(),array('class'=>'span5',"prompt"=>'Select Tags')); ?>
		
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
