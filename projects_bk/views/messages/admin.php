<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
				
<!-- Main Body -->
<section id="content">

<h1>Inbox
<?php $this->renderPartial('application.views.messages._messageMenu') ?>
</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'tbl-messages-grid',
	'dataProvider'=>$model,
	//'filter'=>$model,
	'columns'=>array(
		array(
		'name' => 'FromUserId',
		'value' => 'TblSysUsers::model()->findByPk($data->FromUserId)->Name'
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
</section>
