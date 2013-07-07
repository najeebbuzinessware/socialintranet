
<div id="editRule" class="container_10">
  <?php $form=$this->beginWidget('CActiveForm', array("action"=>"",
'id'=>'frmrules','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>

  <div class="grid_12">
    <p class="headline1-inner lined">
      <?=Yii::t('translate','Edit Rule') ?>
    </p>
  </div>
  
  <div class="rdbl" style="width: 240px;">
	 <?php echo CHtml::radioButtonList('menuType','Backend',array('Backend'=>'Backend','Frontend'=>'Frontend'), array('separator' => "  ",'onchange' => 'showselectedTask(this.value);')); ?>
	</div>
	<div class="halfmargin"></div>
     <div style="width:300px">
          <label>
          <p class="headline6">
               <?=Yii::t('translate','Please Select an Action') ?>
          </p>
      <div id="Backendtask" class="visible">    
		<?php echo $model->action;
		Yii::import('common.extensions.widgets.EchMultiSelect');

			$this->widget('EchMultiSelect', array(

				'name'=>'Action[]',

				'data'=>BWNotiticationFunctions::getAllAssignModuleActionsFromMId(),

				'cssFile'=>false,

				'value'=>$groupSelected,

				'dropDownHtmlOptions'=> array(

				'class'=>'grid_12 headline2',

				'id'=>'edtAssignToAction',

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

				'id'=>'edtAssignTofrontAction',

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
  
  <div class="grid_4">
    <label>
    <p class="headline6">
      <?=Yii::t('translate','Use Template?') ?>
    </p>
    <?php echo $form->dropDownList($model,'TemplateId',CHtml::listData(TblTemplates::model()->findAllByAttributes(array('MId'=>Yii::app()->user->MId,"IsDelete"=>"0")),'TempId','TemplateName'),array("class"=>"full headline2","prompt"=>"Select Template")); ?><? echo $form->error($model,"TemplateId");?>
    </label>
  </div>
  <div class="margin"></div>
  
  <div class="grid_12">
    <?php	if($model->isNewRecord){
			   echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnrulesave"));
			}else{
				   echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnrulesave"));
			}
	?>
  </div>

<?php $this->endWidget(); ?>
</div>
