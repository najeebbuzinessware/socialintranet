
<div class="modal">
  <div id="addProducts" class="container_12">
    <?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'product-form','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>

    <div class="grid_12">
      <? if($model->PId>0){?>
      <p class="headline1-inner lined">
        <?=Yii::t('translate','Edit Products') ?>
      </p>
      <? }else{ ?>
      <p class="headline1-inner lined">
        <?=Yii::t('translate','Add a New Products') ?>
      </p>
      <? } ?>
    </div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?php echo $form->label($model,'Name'); ?></p>
      <? echo $form->textField($model,'Name',array("class"=>"headline2 full")); ?> <?php echo $form->error($model,'Name'); ?>
      </label>
    </div>
    
    <div class="grid_3">
      <label>
      <p class="headline6"><?=Yii::t('translate','Parent')?> <?php //echo $form->label($model,'Gid'); ?></p>
      <?php  /*$criteria = new CDbCriteria();
			 $criteria->condition = "Parent=0";*/
			 echo $form->dropDownList($model,'Gid',CHtml::listData(TblProductGroups::model()->findAll(),"PGId","GroupName"),array('class'=>'headline2 full','prompt'=>'Parent',));
	  ?>
      <?php echo $form->error($model,'Gid'); ?>
      </label>
    </div>
    
    <div class="grid_3">
      <label>
      <p class="headline6"><?php echo $form->label($model,'Term'); ?></p>
      <?php  echo $form->dropDownList($model,'Term',BWDataFunction::getProductsTerm(),array('class'=>'headline2 full','prompt'=>'Term',));?>
      <?php echo $form->error($model,'Term'); ?>
      </label>
    </div>
    <div class="halfmargin"></div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?=Yii::t('translate','Minutes')?><?php //echo $form->label($model,'ProductHours'); ?></p>
      <?php echo $form->textField($model,'ProductHours',array("class"=>"headline2 full")); ?> <?php echo $form->error($model,'ProductHours'); ?>
      </label>
    </div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?php echo $form->label($model,'Description'); ?></p>
      <?php echo $form->textArea($model,'Description',array("class"=>"headline2 full")); ?> <?php echo $form->error($model,'Description'); ?>
      </label>
    </div>
    <div class="halfmargin"></div>
    
    <? if($model->PId>0){ echo $form->hiddenField($model,"PId"); } ?>
    <div class="halfmargin"></div>
    <div class="specialAction RIGHT"><?php echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnsave")); ?></div>
    <div class="clear"></div>
  </div>
  <?php $this->endWidget(); ?>
</div>
</div>
