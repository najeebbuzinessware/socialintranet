<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tbl-projects-form',
	'enableAjaxValidation'=>true,
	'clientOptions' => array('validateOnSubmit' => true),
  	'htmlOptions' => array("class"=>"form-horizontal"),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'ProjectName',array('placeholder'=>'Project Name','class'=>'span5','maxlength'=>250,)); ?>		
	
	<?php echo $form->dropDownListRow($model, 'ProductCId', $product, array('empty'=>'Products','class'=>'span5')); ?>	

	<?php echo $form->textFieldRow($model,'EstimatedTime',array('placeholder'=>'Estimated Time','class'=>'span5')); ?>	
	
	<?php echo $form->datepickerRow($model, 'StartDate',array('placeholder'=>'Start Date','prepend'=>'<i class="icon-calendar"></i>','options'=>array('format'=>'yyyy-mm-dd'))); ?>

	<?php echo $form->datepickerRow($model, 'Expiry',array('placeholder'=>'Expiry Date','prepend'=>'<i class="icon-calendar"></i>','options'=>array('format'=>'yyyy-mm-dd'))); ?>
	
	<?php echo $form->dropDownListRow($model, 'PType', BWDataFunction::TypeData(), array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model, 'IsActive', BWDataFunction::projectstatusData(), array('class'=>'span5')); ?>
	
	<?php echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); 
//print_r($product);
//$productC = BWCFunctions::getProductCatalog( 'Projects' );
?>