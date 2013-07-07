<?php $model = new TblUserContacts(); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'addContacts')); ?>

 <div class="modal-header">
     <a class="close" data-dismiss="modal">&times;</a>
     <h4>Add Contact</h4>
 </div>
 
<div class="modal-body">
  <?php $this->renderPartial("application.views.contacts._form",array("model"=>$model));?>
</div>  
<?php $this->endWidget(); ?>
					
				