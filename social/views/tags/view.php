
				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<h1>View</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'Tags',
		array('name'=>'TagColor','type'=>'html','value'=>'TblSysTags::model()->getTagClasses($data->TagColor)'),		
	),
)); ?>

	
	<div class="clearfix"></div>
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>