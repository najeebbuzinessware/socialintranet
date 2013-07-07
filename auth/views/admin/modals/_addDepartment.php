
<div class="modal">
  <div id="addDepartment" class="container_12 w400">
    <?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'department-form',
			//'enableClientValidation'=>true,
			'enableAjaxValidation'=>true,
			'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
			)); ?>
            

      <h2 class="headline1-inner">
        <?=Yii::t('translate','Add a New Department') ?>
      </h2>
      <div class="s-lined"></div>
    
    <div class="grid_12">
      <label>
      <p class="headline6"><?php echo $form->label($model,'Department'); ?></p>
      <?php echo $form->textField($model,'Department',array("class"=>"headline2 full","placeHolder"=>Yii::t('translate','Department Name'))); ?> <?php echo $form->error($model,'Department'); ?>
      </label>
    </div>
    <div class="clear"></div>
    <div class="margin"></div>
    
    <div class="grid_12"> 
	<?php echo $form->hiddenField($model,'DeptId');  ?>
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
</div>
