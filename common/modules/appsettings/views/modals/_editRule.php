<?php
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
?>

  <?php $form=$this->beginWidget('CActiveForm', array("action"=>"",
'id'=>'frmrules','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>

  <div class="grid_12">
    <p class="headline1-inner lined">
      <?=Yii::t('translate','Edit Rule') ?>
    </p>
  </div>
  
  <div class="grid_4">
    <label>
    <p class="headline6">
      <?=Yii::t('translate','Please Select an Action') ?>
    </p>
    <?php //echo $form->dropDownList($model,'Action',CHtml::listData(TblNotificationActions::model()->findAll(),'ActId','ActionName'),array("class"=>"full headline2","prompt"=>"Select Action")); 
	$actionSelected = array();
	
	if(strlen($model['Action'])>0){$actionSelected = explode(",",$model['Action']);}
		Yii::import('common.extensions.widgets.EchMultiSelect');
			$this->widget('EchMultiSelect', array(
				'name'=>'Action[]',
				'data'=>BWNotiticationFunctions::getAllAssignModuleActionsFromMId(),
				'cssFile'=>false,
				'value'=>$actionSelected,
				'dropDownHtmlOptions'=> array('class'=>'full headline2','id'=>'AssignToAction','onChange'=>'getSelectCount(1)',),
			));
			
		//echo $form->hiddenField($model,'Action');
	
	?>
	<?php echo $form->error($model,"Action");?>
    </label>
  </div>
  
 <!-- <div class="grid_4">
    <label>
    <p class="headline6">
      <? /*=Yii::t('translate','How To Response?') ?>
    </p>
    <?php echo $form->dropDownList($model,'Response',BWDataFunction::getResponsesForNotifications(),array("class"=>"full headline2","prompt"=>"Select Response")); ?> 
	<?php echo $form->error($model,"Response");*/ ?>
    </label>
  </div>-->
  
  <div class="grid_4">
    <label>
    <p class="headline6">
      <?=Yii::t('translate','Use Template?') ?>
    </p>
    <?php echo $form->dropDownList($model,'TemplateId',CHtml::listData(TblTemplates::model()->findAllByAttributes(array('MId'=>Yii::app()->user->MId,"IsDelete"=>"0")),'TempId','TemplateName'),array("class"=>"full headline2","prompt"=>"Select Template")); ?><? echo $form->error($model,"TemplateId");?>
    </label>
  </div>
  
  <div class="clear"></div>  
    
   <?php /*?> <div class="grid_4">
        <label>
            <p class="headline6"><?=Yii::t('translate','Sender Mail Id') ?></p>
            <?php echo $form->textField($model,'senderMailId',array("placeHolder"=>"Enter Sender Mail Id")); ?>
            <?php echo $form->error($model,'senderMailId'); ?>
        </label>
    </div>    
    
    <div class="grid_4">
        <label>
            <p class="headline6"><?=Yii::t('translate','Sender Name') ?></p>
            <?php echo $form->textField($model,'senderName',array("placeHolder"=>"Enter Sender Name")); ?>
            <?php echo $form->error($model,'senderName'); ?>
        </label>
    </div><?php */?>
    
    <div class="margin"></div>
    <div class="grid_4">
    <?php	if($model->isNewRecord){
			   echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnrulesave"));
			}else{
				   echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnrulesave"));
			}
	?>
  </div>
 
<?php $this->endWidget(); ?>
</div>
<!--

<script language="javascript" type="application/javascript">
function getSelectCount(id)
{
	alert(id);
}
</script>
-->