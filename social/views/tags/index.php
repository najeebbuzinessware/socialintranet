				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<h1>Tags</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>



<div class="clearfix"></div>
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
