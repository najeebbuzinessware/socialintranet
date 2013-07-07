<?php 
 	$taskmodel = new TblTasks();?>

<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'addTasks')); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Add Tasks</h4>
    </div>
 
    <div class="modal-body">
  
    <?php $this->renderPartial("application.views.tasks._form",array("model"=>$taskmodel));?>
  
  </div>
    
	<?php $this->endWidget(); ?>
					
				