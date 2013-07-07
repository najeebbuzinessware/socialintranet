
<div class="modal">
  <div id="addRule" class="container_12">
    <?php $form=$this->beginWidget('CActiveForm', array("action"=>"",
'id'=>'frmrules','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>

    <div class="grid_12">
      <p class="headline1-inner lined">
        <?=Yii::t('translate','Add a New Rule') ?>
      </p>
    </div>
    
    <div class="grid_4">
      <label>
      <p class="headline6">
        <?=Yii::t('translate','Please Select an Action') ?>
      </p>
      <?php
          $criteria = new CDbCriteria;
          $criteria->order = 'ActionName ASC';  
		  $criteria->condition = 'ParentId=0 and ActionName!=""'; 
		 
          echo $form->dropDownList($model,'Action',CHtml::listData(TblNotificationActions::model()->findAll($criteria),'ActId','ActionName'),array('class'=>'formList',
		  				'prompt'=>'Select Action',
                        'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('/members/notifications/dynamicResponse'),
						//'update' =>'#'.CHtml::activeId($model,'CityID')
						'success'=>'updateFields',        
                        'dataType' => 'json',
						),
					)
          );
    	?>
      <? echo $form->error($model,"Action");?>
      </label>
    </div>
    
    <div class="grid_4">
      <label>
      <p class="headline6">
        <?=Yii::t('translate','How To Response?') ?>
      </p>
      <? 
			  $criteria = new CDbCriteria;
              $criteria->order = 'ActionName ASC';  
		      $criteria->condition = 'ParentId>0 and ActionName!=""'; 
			  echo $form->dropDownList($model,'Response',CHtml::listData(TblNotificationActions::model()->findAll($criteria),'ActId','ActionName'),array('class'=>'formList',"prompt"=>"Select Response")); ?>
      <? echo $form->error($model,"Response");?>
      </label>
    </div>
    
    <div class="grid_4">
      <label>
      <p class="headline6">
        <?=Yii::t('translate','Use Template?') ?>
      </p>
      <?php echo $form->dropDownList($model,'TemplateId',CHtml::listData(TblTemplates::model()->findAllByAttributes(array('MId'=>Yii::app()->user->MId,"IsDelete"=>"0")),'TempId','TemplateName'),array("class"=>"full headline2","prompt"=>"Select Template")); ?><? echo $form->error($model,"TemplateId");?>
      </label>
    </div>
    
    <div class="grid_6">
        <label>
            <p class="headline6"><?=Yii::t('translate','Sender Mail Id') ?></p>
            <?php echo $form->textField($model,'senderMailId',array("class"=>"headline2 full","placeHolder"=>"Enter Sender Mail Id")); ?>
            <?php echo $form->error($model,'senderMailId'); ?>
        </label>
    </div>
    
    <div class="grid_6">
        <label>
            <p class="headline6"><?=Yii::t('translate','Sender Name') ?></p>
            <?php echo $form->textField($model,'senderName',array("class"=>"headline2 full","placeHolder"=>"Enter Sender Name")); ?>
            <?php echo $form->error($model,'senderName'); ?>
        </label>
    </div>
    <div class="margin"></div>
    
    <div class="grid_12">
      <?php if($model->isNewRecord){
			   echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnrulesave"));
			}else{
				   echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnrulesave"));
			}
		?>
    </div>
  </div>
  <?php $this->endWidget(); ?>
  
<script type="text/javascript">	
	function updateFields(data)
	{
	   jQuery('#TblNotificationRules_Response').children().remove().end().append(data.cityoptions);
	}
</script>
</div>
</div>
