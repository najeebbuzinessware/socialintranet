<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
				
<!-- Main Body -->
<section id="content">

<h1>View Announcement </h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'Content',
		'Status',
		'PublishDate',
		'EndDate',
	),
)); ?>


<div class="clearfix"></div>
</section>