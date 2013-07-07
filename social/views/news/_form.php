<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tbl-news-rss-form',
	'action'=>$model->isNewRecord ? '/news/create' : '/news/update',	
	'type'=>'horizontal', 
    'enableAjaxValidation'=>true,
	'clientOptions' => array('validateOnSubmit' => true),
  	'htmlOptions' => array("class"=>"form-horizontal"),	 
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'ItemName',array('class'=>'span4','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'RssLink',array('class'=>'span4','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'NumberOfNews',array('class'=>'span4')); ?>

	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
