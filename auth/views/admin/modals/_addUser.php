
<div class="modal">
  <div id="addUser" class="container_12">
    <?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'users-form',
			'enableAjaxValidation'=>true,
			'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
			)); ?>
    <div class="grid_12">
      <p class="headline1-inner lined">
        <?=Yii::t('translate','Add a New User') ?>
      </p>
    </div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?php echo $form->label($model,'Name'); ?></p>
      <?php echo $form->textField($model,'Name',array("class"=>"headline2 full","onfocus"=>"if(this.value == '".Yii::t('translate','Your Full Name')."') this.value ='';","onblur"=>"if(this.value=='') this.value='".Yii::t('translate','Your Full Name')."';","value"=>Yii::t('translate','Your Full Name'))); ?> <?php echo $form->error($model,'Name'); ?>
      </label>
    </div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?php echo $form->label($model,'Nick'); ?></p>
      <?php echo $form->textField($model,'Nick',array("class"=>"headline2 full","onfocus"=>"if(this.value == '".Yii::t('translate','Your Nick Name')."') this.value ='';","onblur"=>"if(this.value=='') this.value='".Yii::t('translate','Your Nick Name')."';","value"=>Yii::t('translate','Your Nick Name'))); ?> <?php echo $form->error($model,'Nick'); ?>
      </label>
    </div>
    <div class="clear"></div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?php echo $form->label($model,'UserType'); ?></p>
      <?php echo $form->dropDownList($model,'UserType',array('Admin'=>"Admin",'User'=>"User"),array("prompt"=>"Select","class"=>"headline2 full")); ?> <?php echo $form->error($model,'UserType'); ?>
      </label>
    </div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?php echo $form->label($model,'WeightageId'); ?></p>
      <?php 
			$criteria = new CDbCriteria();
			$criteria->condition = 'IsDelete=0';
			$criteria->order = 'WId DESC';	 	
			
			echo $form->dropDownList($model,'WeightageId',CHtml::listData(TblWeightage::model()->findAll($criteria),'WId','Title'),array("class"=>"headline2 full")); ?>
      <?php echo $form->error($model,'WeightageId'); ?>
      </label>
    </div>
    <div class="clear"></div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?php echo $form->label($model,'Email'); ?></p>
      <?php echo $form->textField($model,'Email',array("class"=>"headline2 full","onfocus"=>"if(this.value == '".Yii::t('translate','Your Valid EmailID')."') this.value ='';","onblur"=>"if(this.value=='') this.value='".Yii::t('translate','Your Valid EmailID')."';","value"=>Yii::t('translate','Your Valid EmailID'))); ?> <?php echo $form->error($model,'Email'); ?>
      </label>
    </div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?php echo $form->label($model,'Password'); ?></p>
      <?php echo $form->passwordField($model,'Password',array("class"=>"headline2 full","onfocus"=>"if(this.value == '".Yii::t('translate','Enter Password')."') this.value ='';","onblur"=>"if(this.value=='') this.value='".Yii::t('translate','Enter Password')."';","value"=>Yii::t('translate','Enter Password'))); ?> <?php echo $form->error($model,'Password'); ?>
      </label>
    </div>
    <div class="clear"></div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?php echo $form->label($model,'ReportTo'); ?></p>
      <?php echo $form->dropDownList($model,'ReportTo',CHtml::listData(TblSysUsers::model()->findAllByAttributes(array('MId'=>Yii::app()->user->MId)),'Userid','Name'),array("prompt"=>"Select","class"=>"full headline2")); ?>
      <?php echo $form->error($model,'ReportTo'); ?>
      </label>
    </div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?php echo $form->label($model,'Department'); ?></p>
      <?php echo $form->dropDownList($model,'Department',CHtml::listData(TblDepartments::model()->findAllByAttributes(array('MId'=>Yii::app()->user->MId,'IsDelete'=>0)),'DeptId','Department'),array("prompt"=>"Select","class"=>"headline2 full")); ?> <?php echo $form->error($model,'Department'); ?>
      </label>
    </div>
    
    <div class="grid_6">
      <label>
      <p class="headline6"><?php echo $form->label($model,'JobTitle'); ?></p>
      <?php echo $form->textField($model,'JobTitle',array("class"=>"headline2 full","placeHolder"=>Yii::t('translate','Job Title'))); ?> <?php echo $form->error($model,'JobTitle'); ?>
      </label>
    </div>
    <div class="clear"></div>
    
    <div class="grid_12 jSelect">
      <?php
			$this->widget('common.extensions.emultiselect.EMultiSelect',
			 array('sortable'=>false/true, 'searchable'=>false/true)
			); //$group
			echo CHtml::dropDownList('groups[]',$groups,BWCFunctions::getGroupsfromMId(),array('multiple'=>'multiple','key'=>'trainings', 'class'=>'multiselect'));
		?>
		<div class="clear"></div>

    </div>
    <div class="clear"></div>
    <div class="margin"></div>
    
    <div class="grid_12"> <?php echo $form->hiddenField($model,'Userid');  ?>
      <?php
		if($model->isNewRecord){
		   echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnsave"));
		}else{
			echo CHtml::hiddenField('oldparent',$this->parentname);
			echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnsave"));
		}
		?>
		
    </div>
    <?php $this->endWidget(); ?>
  </div>
</div>
</div>

<style type="text/css">
  .jSelect { min-height: 190px; margin-top: -1px; background: #F7F7F7; }
  .jSelect .selected, .jSelect .available { width: 49% !important; float: left; }
  .jSelect  div.available { margin-left: 2%; }
  .jSelect .ui-widget-header { padding: 5px; }
  .jSelect .ui-multiselect { box-sizing: border-box; padding: 0; border: 0; }
  .jSelect .selected .ui-widget-header a { float: right; }
  .jSelect li { width: 346px; padding: 5px; box-sizing: border-box;}
  .jSelect a.action { float: right; }
</style>

<script type="text/javascript">
  $(document).ready(function(){
    var v = $('.jSelect .available').width();
    $('.jSelect li').width(v-2);  
  });
</script>
