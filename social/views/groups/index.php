
				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<h1>Groups</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 

/* $this->widget('bootstrap.widgets.TbExtendedGridView', array(
		//'filter'=>$person,
		'type'=>'striped bordered',
		'dataProvider' => $dataProvider,
		'template' => "{items}",
		'columns' => array_merge(array(array('class'=>'bootstrap.widgets.TbImageColumn')),$gridColumns),
)); */

?>


<div class="clearfix"></div>
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>