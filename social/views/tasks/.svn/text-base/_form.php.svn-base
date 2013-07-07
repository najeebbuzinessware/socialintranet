 <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'id'=>'tbl-tasks-form', 
	'action'=>$model->isNewRecord ? '/tasks/create' : '/tasks/update',	
	'type'=>'horizontal', 
    'enableAjaxValidation'=>true,
	'clientOptions' => array('validateOnSubmit' => true),
  	'htmlOptions' => array("class"=>"form-horizontal"),	 
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($taskmodel); ?>

	
	<?php echo $form->textFieldRow($model,'Description',array('class'=>'span8')); ?>

	 <?php echo $form->datepickerRow($model, 'DueDate',
        array('prepend'=>'<i class="icon-calendar"></i>')); ?>
        
    <?php echo $form->timepickerRow($model, 'DueTime', array('append'=>'<i class="icon-time" style="cursor:pointer"></i>'));?>
	   
	
	<?php 
	$selfarray = array();
	$selfarray[Yii::app()->user->Id] = 'Me';
	$listuser = TblSysUsers::model()->getUsersFromMId();
	echo $form->dropDownListRow($model,'AssignTo',$selfarray+$listuser,array('class'=>'span5')); ?>

	<?php echo $form->toggleButtonRow($model, 'ShowToAll'); ?>	
	
	<?php echo $form->dropDownListRow($model,'TagId',TblSysTags::model()->getTagsFromMId(),array('class'=>'span5')); ?>
	
	<?php 
	if(!$model->isNewRecord){ 
		echo $form->dropDownListRow($model,'Status',TblTasks::model()->getTaskStatus(),array('class'=>'span5'));
	}
	?>
		
	<div class="modal-footer">
		
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'label' => 'Close',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal'),
	)); ?>
    </div>

<?php $this->endWidget(); ?>