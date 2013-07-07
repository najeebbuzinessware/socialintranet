				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<h3>Contacts  
<!-- 	<a href="#tasksSettings" data-toggle="modal"><i class="icon-cog righteditAction">&nbsp;</i></a> -->
    <a href="#addContacts" data-toggle="modal" class="btn">Add</a>
</h3>
<?php

$this->menu=array(
	array('label'=>'List TblUserContacts','url'=>array('index')),
	array('label'=>'Create TblUserContacts','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tbl-user-contacts-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php /* $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */ ?>
<?php 
$groupGridColumns = $gridColumns;
$groupGridColumns[] = array(
    'name' => 'firstLetter',
    'value' => 'substr($data->Name, 0, 1)',
    'headerHtmlOptions' => array('style'=>'display:none'),
    'htmlOptions' =>array('style'=>'display:none')
);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
	//'filter'=>$dataProvider,
	'id'=>'tbl-user-contacts-grid',
	'type'=>'striped bordered',
	'dataProvider' => $dataProvider,
	'template' => "{items}",
	'extraRowColumns'=> array('firstLetter'),
	'extraRowExpression' => '"<b style=\"font-size: 1.3em; color: #333;\">".substr($data->Name, 0, 1)."</b>"',
	'extraRowHtmlOptions' => array('style'=>'padding:10px'),
	'columns' => $groupGridColumns
)); 

?>


<div class="clearfix"></div>
</div></div>	

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
