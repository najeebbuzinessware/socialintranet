				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">



<h1>Manage Announcements
<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
	'type' => 'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	'htmlOptions' => array('class'=>'pull-right'),
	'buttons' => array(
		array('label' => 'Action', 'url' => '#'), // this makes it split :)
		array('items' => array(
			array('label' => 'Inbox', 'url' =>array('index')),
			array('label' => 'Compose', 'url' =>array('create')),
			array('label' => 'Sent', 'url' =>array('sentItems')),
		)),
	),
)); ?>
</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'tbl-announcement-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
					'name' => 'Content',
					'header' => 'Annoucements',
					'class' => 'bootstrap.widgets.TbEditableColumn',
					//'headerHtmlOptions' => array('style' => 'width:80px'),
					'editable' => array(
							'type' => 'text',
							'url' => $this->createUrl('announcement/updateAnnoucement'),
								
					)
			),
		array(
				'name'=>'Status',
				'header' => 'Status',
				'class' => 'bootstrap.widgets.TbEditableColumn',
				//'headerHtmlOptions' => array('style' => 'width:80px'),
				'editable' => array(
						'type' => 'select',
						'url' => $this->createUrl('announcement/updateAnnoucement'),
						'source' =>array('Active'=>'Active','Draft'=>'Draft','Scheduled'=>'Scheduled'),
		
				)
		),
		'PublishDate',
		'EndDate',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			
		),
	),
)); ?>



<div class="clearfix"></div>
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
