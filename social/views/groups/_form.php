<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tbl-coll-groups-form',
	'action'=>$model->isNewRecord ? '/groups/create' : '/groups/update',	
	'type'=>'horizontal', 
    'enableAjaxValidation'=>true,
	'clientOptions' => array('validateOnSubmit' => true),
  	'htmlOptions' => array("class"=>"form-horizontal"),	 
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'GroupName',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php //echo $form->textFieldRow($model,'Avatar',array('class'=>'span5','maxlength'=>255)); ?>
	
	    <div class="grid_10">
		<p class="headline2">Your Avatar</p>
		<div class="grid_6 alpha">
			<div class="file-upload">
				<div id="upload" class="boxSizing"></div>
				<div id="uploadaction" class="hidden uploadaction"><? echo '/user/upload';?></div>
				<div id="uploaded" class="boxSizing"></div>
			</div>
		</div>
		<div class="grid_4" style="text-align: center;">
			<? if(strlen($model['Avatar'])>0){$ulogo="/uploads/logo".Yii::app()->user->MId."/".$model['Avatar'];}else{$ulogo='http://placehold.it/200x80';}?>
			<img src="<?=$ulogo ?>" alt="" width="200px" height="80px"/>
			<? 	echo $form->hiddenField($model,'Avatar'); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
