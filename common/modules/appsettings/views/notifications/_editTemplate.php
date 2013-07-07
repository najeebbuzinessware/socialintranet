<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
?>
<?php $form=$this->beginWidget('CActiveForm', array("action"=>"",
'id'=>'frmedittemplate','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>

    <div class="grid_12">
      <p class="headline1-inner lined">
        <?=Yii::t('translate','Edit Template') ?>
      </p>
    </div>
    
    <div class="grid_6">
      <label>
      <p class="headline6">
        <?=Yii::t('translate','Template Name') ?>
      </p>
      <? echo $form->textField($model,'TemplateName',array("class"=>"headline2 full")); ?><?php echo $form->error($model,'TemplateName'); ?>
      </label>
    </div>
    <div class="grid_6">
      <label>
      <p class="headline6">
        <?=Yii::t('translate','Action') ?>
      </p>
      <? echo $actionData['ActionName']; ?>
      </label>
    </div>
    
    <div class="grid_12">
      <label>
      <p class="headline6">
        <?=Yii::t('translate','Template Subject') ?>
      </p>
      <? echo $form->textField($model,'TemplateSubject',array("class"=>"headline2 full")); ?> <?php echo $form->error($model,'TemplateSubject'); ?>
      </label>
    </div>
    
    <div class="grid_12">
      <label>
      <p class="headline6">
        <?=Yii::t('translate','Template') ?>
      </p>
      <? echo $form->textArea($model,'Template',array("class"=>"full headline2","placeHolder"=>"Enter Template Content")) ?>
      <?php /* $this->widget('application.extensions.elrtef.elRTEText', array(
                            'model'=>$model,
                            'attribute'=>'Template',
                            'options' => array(
                                'lang'=>'en',
                                'height'=>200,
                                'toolbar'=>'maxi',
                                'styleWithCss'=>true,
                                'allowSource'=>true,
                            ))); */?>
      <?php echo $form->error($model,'Template'); ?>
      </label>
    </div>
        <div class="grid_12">
                <label>
                <p class="headline6"><?=Yii::t('translate','Email Template Variables') ?></p>
                 <?php //$this->renderpartial('_Variables'); ?> 
                
                    <!--<tr><td>Useremail</td><td>{$useremail}</td></tr>
                    <tr><td>ProductId</td><td>{$product_id}</td></tr>
                    <tr><td>Product Name</td><td>{$product_name}</td></tr>
                    <tr><td>Order Id</td><td>{$order_id}</td></tr>
                    <tr><td>Store Id</td><td>{$store_id}</td></tr>
                    <tr><td>Store Name</td><td>{$store_name}</td></tr>
                    <tr><td>Password</td><td>{$password}</td></tr>-->
                </label>
            </div>
    <?php $model->TemplateType = 'Html'; echo $form->hiddenField($model,'TemplateType');  ?>
    <div class="margin"></div>
    <div class="grid_12"> 
		<?php echo $form->hiddenField($model,'TempId');
			  echo $form->hiddenField($model,'PId');
		  ?>
     	<?php  echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btntempsave")); ?>
    </div>
    </div>
<?php $this->endWidget(); ?>
