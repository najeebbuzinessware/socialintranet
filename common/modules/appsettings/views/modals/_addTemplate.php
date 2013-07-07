
<div class="modal">
  <div id="addTemplate" class="container_12">
    <?php $form=$this->beginWidget('CActiveForm', array("action"=>"",
'id'=>'frmtmplate','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>

    <div class="grid_12">
      <p class="headline1-inner lined">
        <?=Yii::t('translate','Add a New Template') ?>
      </p>
    </div>
    
    <div class="grid_6">
      <label>
      <p class="headline6">
        <?=Yii::t('translate','Template Name') ?>
      </p>
      <? echo $form->textField($model,'TemplateName',array("class"=>"headline2 full","placeHolder"=>"Enter Template Name")); ?><?php echo $form->error($model,'TemplateName'); ?>
      </label>
    </div>
    
    <div class="grid_12">
      <label>
      <p class="headline6">
        <?=Yii::t('translate','Template Subject') ?>
      </p>
      <? echo $form->textField($model,'TemplateSubject',array("class"=>"headline2 full","placeHolder"=>"Enter Template Subject")); ?> <?php echo $form->error($model,'TemplateSubject'); ?>
      </label>
    </div>
    
    <div class="grid_12">
      <label>
      <p class="headline6">
        <?=Yii::t('translate','Template') ?>
      </p>
      <? echo $form->textArea($model,'Template',array("class"=>"full headline2","placeHolder"=>"Enter Template Content")) ?>
      <?php /*$this->widget('application.extensions.elrtef.elRTEText', array(
                            'model'=>$model,
                            'attribute'=>'Template',
                            'options' => array(
                                'lang'=>'en',
                                'height'=>200,
                                'toolbar'=>'maxi',
                                'styleWithCss'=>true,
                                'allowSource'=>true,
                            )));*/ ?>
      <?php echo $form->error($model,'Template'); ?>
      </label>
    </div>
    <?php $model->TemplateType = 'Email'; echo $form->hiddenField($model,'TemplateType');  ?>
    <div class="margin"></div>
    
    <div class="grid_12"> 
		<?php echo $form->hiddenField($model,'TempId');  ?>
		<?php
			if($model->isNewRecord){
			   echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btntempsave"));
			}else{
				   echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btntempsave"));
			}
		?>
    </div>
  </div>
  <?php $this->endWidget(); ?>
</div>
</div>
