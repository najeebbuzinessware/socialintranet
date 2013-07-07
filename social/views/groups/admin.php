
				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tbl-coll-groups-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Groups</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'tbl-coll-groups-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		'GroupName',
		'Description',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>



<div class="clearfix"></div>
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
