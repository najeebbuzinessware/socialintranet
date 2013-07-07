<?php $model = new TblCollGroups(); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'addGroups')); ?>

 <div class="modal-header">
     <a class="close" data-dismiss="modal">&times;</a>
     <h4>Add Group</h4>
 </div>
 
<div class="modal-body">

  <?php $this->renderPartial("application.views.groups._form",array("model"=>$model));?>
</div>
<?php //$this->endWidget(); ?>
    
	<?php $this->endWidget(); ?>
					
				