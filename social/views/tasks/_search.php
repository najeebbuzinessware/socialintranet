<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->dropDownListRow($model,'TagId',TblSysTags::model()->getTagsFromMId(),array('class'=>'span5',"prompt"=>'Select Tags')); ?>

	<?php echo $form->dropDownListRow($model,'Status',TblTasks::model()->getTaskStatus(),array('class'=>'span5',"prompt"=>'Select Status')); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
