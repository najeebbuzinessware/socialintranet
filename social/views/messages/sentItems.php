				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<h1>Sent Mails
<?php $this->renderPartial('application.views.messages._messageMenu') ?>
</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'sent-messages-grid',
	'dataProvider'=>$model,
	//'filter'=>$model,
	'columns'=>array(
		array(
		'name' => 'ToUserId',
		'value' => 'TblSysUsers::model()->findByPk($data->ToUserId)->Name'
		),		
		'Subject',
		array(
				'name' => 'Message',
				'header' => 'Message',
				'type' => 'html',				
		),
		array(
			'name' => 'CreatedOn',
			'value' => 'date("Y-m-d H:i",$data->CreatedOn)',
			'header' => 'Date',
		
		),		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}{delete}',
		),
	),
)); ?>


<div class="clearfix"></div>
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
