<?php
 	$rssmodel = TblNewsRss::model()->findByAttributes(array("UserId"=>Yii::app()->user->Id));
	if(count($rssmodel)<1){
		$rssmodel = new TblNewsRss();
		
	}	
?>

<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'addNews')); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Add News</h4>
    </div>
 
<!--     <div class="modal-body"> -->
     <?php $this->renderPartial("application.views.news._form",array("model"=>$rssmodel));?>
<!-- 	  </div> -->
 	
	<?php $this->endWidget(); ?>
					
				