
				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

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
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>