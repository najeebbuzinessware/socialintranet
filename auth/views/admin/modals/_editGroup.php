<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
?>

<div id="editGroup" class="container_12">
  <?php $form=$this->beginWidget('CActiveForm', array("action"=>"",
'id'=>'groups-form','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>

    <h2 class="headline1-inner"><?=Yii::t('translate','Edit Group') ?></h2>
    <div class="clear"></div>
    <div class="s-lined"></div>
  
  <div class="grid_6">
    <label>
    <p class="headline6"><?php echo $form->label($model,'name'); ?></p>
    <?php echo $form->textField($model,'name',array("class"=>"headline2 full")); ?> <?php echo $form->error($model,'name'); ?>
    </label>
  </div>
  
  <div class="grid_3">
    <label>
    <p class="headline6"><?php echo $form->label($model,'ParentId'); ?></p>
    <?php echo $form->dropDownList($model,'ParentId',BWCFunctions::getGroupsfromMId('parentsId'),array("prompt"=>"Select","class"=>"headline2 full")); ?> <?php echo $form->error($model,'ParentId'); ?>
    </label>
  </div>
  <div class="clear"></div>
  
  <div class="grid_12">
    <label>
    <p class="headline6"><?php echo $form->label($model,'description'); ?></p>
    <?php echo $form->textArea($model,'description',array("class"=>"headline2 full")); ?> <?php echo $form->error($model,'description'); ?>
    </label>
  </div>
  <div class="clear"></div>
  <div class="margin"></div>
  
  <?php $model->type = 2; echo $form->hiddenField($model,'type');  ?>
  <div class="grid_12"> 
  	<?php echo $form->hiddenField($model,'AuthItemId');  ?>
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
