
				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<h1>View Message<?php if(Yii::app()->user->Id==$model->ToUserId){
	$this->widget('bootstrap.widgets.TbButtonGroup', array(
			'type' => 'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'htmlOptions' => array('class'=>'pull-right'),
			'buttons' => array(
					array('label' => 'Reply', 'url' => '/messages/reply/id/'.$_GET['id']), // this makes it split :)
			),
	));
	$this->widget('bootstrap.widgets.TbButtonGroup', array(
			'type' => 'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'htmlOptions' => array('class'=>'pull-right'),
			'buttons' => array(
					array('label' => 'Forward', 'url' => '/messages/forward/id/'.$_GET['id']), // this makes it split :)
			),
	));
}else{
$this->renderPartial('application.views.messages._messageMenu'); } ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array('name' => 'FromUserId', 'value'=> TblSysUsers::model()->findByPk($model->FromUserId)->Name),
		array('name' => 'ToUserId', 'value'=> TblSysUsers::model()->findByPk($model->ToUserId)->Name),		
		'Subject',
		array("name"=>'Message','type' => 'html', 'value'=>$model->Message)
	),
)); ?>


<div class="clearfix"></div>
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>