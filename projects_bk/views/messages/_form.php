<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tbl-messages-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php //echo $form->textFieldRow($model,'ToUserId',array('class'=>'span5','maxlength'=>255)); ?>
	<?php //print_r(BWCFunctions::getMIdUsers());
	if($_GET['id']>0 && Yii::app()->controller->action->Id=='reply'){
	 	$model->ToUserId = $model->FromUserId;
	 }
	 
	 echo $form->select2Row($model, 'ToUserId',array('asDropDownList' => true, 
		'data'=>array(""=>"Send To")+BWCFunctions::getMIdUsers(),
		'options' => array(
		'width' => '30%',
		'tokenSeparators' => array(',', ' ')
        ),
		
)); ?>

	<?php echo $form->textFieldRow($model,'Subject',array('class'=>'span5','maxlength'=>255)); ?>
	
	<?php //echo $form->textAreaRow($model,'Message',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	<?php echo $form->ckEditorRow($model, 'Message', array('options'=>array('fullpage'=>'js:true', 'width'=>'500', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));?>
	

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
