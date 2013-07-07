<div>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'id'=>'tbl-set-users-form',
//	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>true,
        'validateOnType'=>true,     
     ),
	'type'=>'horizontal',
		
)); ?>
    <p class="help-block">Fields with <span class="required">*</span> are required.</p> 

    <?php //echo $form->errorSummary($model); ?>

	 <?php
		$modulesser = BWCFunctions::getMIdModules( Yii::app()->user->MId, "1" );
		$prompt = array( "class" => "span5" );
		if (count( $modulesser ) > 1 && strlen( $model->Preferences ) < 1)
		{
			$prompt = array( "class" => "span5", 'prompt' => 'Landing Page Preference' );
		}
		echo $form->dropDownListRow( $model, 'Preferences', $modulesser, $prompt );
	 ?>
		
	 <?php  echo $form->dropDownListRow($model,'TimeZone',BWDataFunction::timeZoneData(),array('class'=>'span5')); ?>
    
    <?php echo $form->passwordFieldRow($model,'Password',array('class'=>'span5','maxlength'=>255)); ?>

        
    <div class="form-actions"> 
        <?php $this->widget('bootstrap.widgets.TbButton', array( 
            'buttonType'=>'submit', 
            'type'=>'primary', 
            'label'=>$model->isNewRecord ? 'Create' : 'Save', 
        )); ?>
    </div> 

<?php $this->endWidget(); ?>
</div>