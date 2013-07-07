<?php
 	$model = TblSysNewsTaskSettings::model()->findByAttributes(array("CType"=>"News","UserId"=>Yii::app()->user->Id));
	if(count($model)<1){
		$model = new TblSysNewsTaskSettings();
		
	}	
?>

<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'NewsSetting')); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>News Settings</h4>
    </div>
 
    <div class="modal-body">
  <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'id'=>'tbl-sys-news-task-settings-form', 
	'action'=>'/NewsTaskSettings/Create/flg/1',
	'type'=>'horizontal', 
    'enableAjaxValidation'=>true,
	'clientOptions' => array('validateOnSubmit' => true),
  //	'htmlOptions' => array("class"=>"form-horizontal"),	 
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	
	<?php 
		$criteria = new CDbCriteria();
		$criteria->condition = "(UserId=".Yii::app()->user->Id." and MId=".Yii::app()->user->MId.") or (CType='system' and MId=".Yii::app()->user->MId.")";
		$newsarray = CHtml::listData(TblNewsRss::model()->findAll($criteria),"RssId",'ItemName');
		//print_r($newsarray);
	 ?>

	<?php echo $form->dropDownListRow($model,'FeedId',$newsarray,array('class'=>'span5',"prompt"=>"Select Feed")); ?>
	
    <?php echo $form->dropDownListRow($model,'RecordLimit',array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5"), array('append'=>'<i class="icon-time" style="cursor:pointer"></i>'));?>
	
	<?php $model->CType = "News";
		  echo $form->hiddenField($model,"CType"); ?>	
	 </div>	
	<div class="modal-footer">
		
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'label' => 'Close',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal'),
	)); ?>
    </div>

<?php $this->endWidget(); ?>
    
	<?php $this->endWidget(); ?>
					
				