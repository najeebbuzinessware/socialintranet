<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div id="editUser" class="container_12">
  <?php $form=$this->beginWidget('CActiveForm', array("action"=>"",
'id'=>'users-form','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>
  <div class="grid_12">
    
    
    <h2 class="headline1-inner">
      <?=Yii::t('translate','Edit User') ?>
    </h2>
    <div class="clear"></div>
    <div class="s-lined"></div>
  </div>
    
  <div class="grid_6">
    <label>
    <p class="headline6"><?php echo $form->label($model,'Name'); ?></p>
    <?php echo $form->textField($model,'Name',array("class"=>"headline2 full")); ?> <?php echo $form->error($model,'Name'); ?>
    </label>
  </div>
  
  <div class="grid_6">
    <label>
    <p class="headline6"><?php echo $form->label($model,'Nick'); ?></p>
    <?php echo $form->textField($model,'Nick',array("class"=>"headline2 full")); ?> <?php echo $form->error($model,'Nick'); ?>
    </label>
  </div>
  <div class="clear"></div>
  
  <div class="grid_6">
    <label>
    <p class="headline6"><?php echo $form->label($model,'UserType'); ?></p>
    <?php echo $form->dropDownList($model,'UserType',array('Admin'=>"Admin",'User'=>"User"),array("prompt"=>"Select","class"=>"headline2 full")); ?> <?php echo $form->error($model,'UserType'); ?>
    </label>
  </div>
  
  <div class="grid_6">
    <label>
    <p class="headline6"><?php echo $form->label($model,'WeightageId'); ?></p>
    <?php 
	$criteria = new CDbCriteria();
	$criteria->condition = 'IsDelete=0';
	$criteria->order = 'WId DESC';	 	
	
	echo $form->dropDownList($model,'WeightageId',CHtml::listData(TblWeightage::model()->findAll($criteria),'WId','Title'),array("class"=>"headline2 full")); ?>
    <?php echo $form->error($model,'WeightageId'); ?>
    </label>
  </div>
  <div class="clear"></div>
  
  <div class="grid_6">
    <label>
    <p class="headline6"><?php echo $form->label($model,'Email'); ?></p>
    <?php echo $form->textField($model,'Email',array("class"=>"headline2 full")); ?> <?php echo $form->error($model,'Email'); ?>
    </label>
  </div>
  
  <div class="grid_6">
    <label>
    <p class="headline6"><?php echo $form->label($model,'Password'); ?></p>
    <?php echo $form->passwordField($model,'Password',array("class"=>"headline2 full")); ?> <?php echo $form->error($model,'Password'); ?>
    </label>
  </div>
  <div class="clear"></div>
  
  <div class="grid_6">
    <label>
    <p class="headline6"><?php echo $form->label($model,'ReportTo'); ?></p>
    <?php echo $form->dropDownList($model,'ReportTo',CHtml::listData(TblSysUsers::model()->findAllByAttributes(array('MId'=>Yii::app()->user->MId)),'Userid','Name'),array("prompt"=>"Select","class"=>"full headline2")); ?> <?php echo $form->error($model,'ReportTo'); ?>
    </label>
  </div>
  
  <div class="grid_6">
    <label>
    <p class="headline6"><?php echo $form->label($model,'Department'); ?></p>
    <?php echo $form->dropDownList($model,'Department',CHtml::listData(TblDepartments::model()->findAllByAttributes(array('MId'=>Yii::app()->user->MId,'IsDelete'=>0)),'DeptId','Department'),array("prompt"=>"Select","class"=>"headline2 full")); ?> <?php echo $form->error($model,'Department'); ?>
    </label>
  </div>
  <div class="clear"></div>
  
  <div class="grid_6">
    <label>
    <p class="headline6"><?php echo $form->label($model,'JobTitle'); ?></p>
    <?php echo $form->textField($model,'JobTitle',array("class"=>"headline2 full","placeHolder"=>Yii::t('translate','Job Title'))); ?> <?php echo $form->error($model,'JobTitle'); ?>
    </label>
  </div>
  
  <div class="grid_12 jSelect">
    <?php
	$this->widget('common.extensions.emultiselect.EMultiSelect',
	 array('sortable'=>false/true, 'searchable'=>false/true)
	);
	echo CHtml::dropDownList('groups[]',$groups,BWCFunctions::getGroupsfromMId(),array('multiple'=>'multiple','key'=>'trainings', 'class'=>'multiselect'));
	?>
  </div>
  <div class="clear"></div>
  <div class="margin"></div>
  
  <div class="grid_12"> <?php echo $form->hiddenField($model,'Userid');  ?>
    <?php
		if($model->isNewRecord){
		   echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnsave"));
		}else{
			   echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnsave"));
		}
	?>
  </div>
  <?php $this->endWidget(); ?>
</div>
</div>
