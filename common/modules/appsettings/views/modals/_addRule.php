
<div class="modal">
<div id="addRule" class="container_10">
     <?php $form=$this->beginWidget('CActiveForm', array("action"=>"",

'id'=>'frmrules','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),

'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>
     <div class="headline1-inner lined">
               <?=Yii::t('translate','Add a New Rule') ?>
     </div>
	
	<div class="halfmargin"></div>
	<div class="rdbl" style="width: 240px;">
	 <?php echo CHtml::radioButtonList('menuType','Backend',array('Backend'=>'Backend','Frontend'=>'Frontend'), array('separator' => "  ",'onchange' => 'showselectedTask(this.value);')); ?>
	</div>
	<div class="halfmargin"></div>
     <div style="width:300px">
          <label>
          <p class="headline6">
               <?=Yii::t('translate','Please Select an Action') ?>
          </p>
      <div id="Backendtask">    
		<?php
		Yii::import('common.extensions.widgets.EchMultiSelect');

			$this->widget('EchMultiSelect', array(

				'name'=>'Action[]',

				'data'=>BWNotiticationFunctions::getAllAssignModuleActionsFromMId(),

				'cssFile'=>false,

				'value'=>$groupSelected,

				'dropDownHtmlOptions'=> array(

				'class'=>'grid_12 headline2',

				'id'=>'AssignToAction',

				'onChange'=>'getSelectCount(this)',
				
			)
		));
 ?>
 </div>
       <div id="Frontendtask" class="hidden">    
		<?php
		Yii::import('common.extensions.widgets.EchMultiSelect');

			$this->widget('EchMultiSelect', array(

				'name'=>'Action[]',

				'data'=>BWNotiticationFunctions::getAllAssignModuleActionsFromMId('Frontend'),

				'cssFile'=>false,

				'value'=>$groupSelected,

				'dropDownHtmlOptions'=> array(

				'class'=>'grid_12 headline2',

				'id'=>'AssignTofrontAction',

				'onChange'=>'getSelectCount(this)',
				
			)
		));
 ?>
 </div>
 <?php echo $form->hiddenField($model,'Action'); ?>
          <span style="color:#FF0000;"><?php echo $form->error($model,'Action',array('class'=>'error')); ?></span>
          <? //echo $form->error($model,"Action",);?>
          </label>
     </div>
     <div class="full">
          <label>
          <p class="headline6">
               <?=Yii::t('translate','Use Template?') ?>
          </p>
          <?php echo $form->dropDownList($model,'TemplateId',CHtml::listData(TblTemplates::model()->findAllByAttributes(array('MId'=>Yii::app()->user->MId,"IsDelete"=>"0")),'TempId','TemplateName'),array("class"=>"full headline2","prompt"=>"Select Template")); ?><? echo $form->error($model,"TemplateId");?>
          </label>
     </div>
     <div class="clear"></div>
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
function getSelectCount(var_id)
{
var getVal = $(var_id).val();

if(getVal=='null')
{
$('#TblNotificationRules_Action').val('');
}
else
{ alert(getVal);
$('#TblNotificationRules_Action').val(getVal);
}
}

function showselectedTask(val)
{
	if(val=='Frontend'){
		$("#Backendtask").hide();
		$("#Frontendtask").show();
	}else if(val=='Backend'){
		$("#Frontendtask").hide();
		$("#Backendtask").show();
	}
}
</script>

