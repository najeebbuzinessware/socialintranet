<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
				
<!-- Main Body -->
<section id="content">

<!-- <h1>Messages<?php //$this->renderPartial('application.views.messages._messageMenu') ?></h1>  -->

<?php 
$dataProvider=new CActiveDataProvider('TblMessages', array(
		'criteria'=>array(
				'condition'=>'ToUserId ='.Yii::app()->user->Id,

		),
));

$this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<div class="clearfix"></div>
</section>