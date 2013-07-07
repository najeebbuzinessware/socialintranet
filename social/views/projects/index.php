<?php
$this->breadcrumbs=array(
	'Tbl Projects',
);

$this->menu=array(
	array('label'=>'Add Projects','url'=>array('create')),
	array('label'=>'Manage TblProjects','url'=>array('admin')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tbl-projects-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>My Projects</h1>
<?php echo CHtml::link('Add Projects','create',array('class'=>'m-r-10 btn')); ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array('model'=>$model,)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'tbl-projects-grid',
	'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'template' => "{items}",
	'columns'=>array(		
		'ProjectName',		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}{update}{delete}',
		),
	),
)); ?>
