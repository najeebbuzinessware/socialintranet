<?php $gtype=BWDataFunction::getSectionNameFromCtype($_GET['type']); ?>
<div class="modal">
  <div id="editTemplate" class="container_12">
    <div class="emptyModal"></div>
  </div>
</div>
<div class="modal">
  <div id="editRule" class="container_10">
    <div class="emptyModal"></div>
  </div>
</div>

<?php //$this->renderpartial('application.views.common.modals._addGeneral',array("modelGeneral"=>$modelGeneral,"usedGeneralData"=>$usedGeneralData)); ?>
<div id="outer_container" class="custom_background">
<?php BWDataFunction::getSectionMenuFromCtype($_GET['type']); ?>
<div class="container_12">
    <div class="grid_1">
        <div id="sideIcons">
            <?php /*?><a href="#addRule" title="<?=Yii::t('translate','Add Mail Id') ?>" class="icon addruleIcon InlineModalTrigger"></a>
            <div class="halfmargin"></div>
            <a href="#rulesAnchor" title="<?=Yii::t('translate','Defined Rules') ?>" class="icon notifIcon InlineScrollTrigger"></a>     
            <div class="halfmargin"></div>
            <a href="#" onClick="return: false;">&nbsp;</a><?php */?> 
        </div>
    </div>
    <div class="grid_12">
         <?php $this->renderpartial('appsettings.views._notificationMenu'); ?>
    </div>
    <div class="grid_12 box shadowed_little">
        <div class="padding">
            <h2 class="headline1-inner lined"><?=Yii::t('translate','Default Values') ?></h2>
	    
	    <?php $form=$this->beginWidget('CActiveForm', array("action"=>"",'id'=>'frmrules','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>true),'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>
	    <div class="halfmargin"></div>
	    
            <div class="grid_6">
	      <h2><?=Yii::t('translate','Name') ?></h2>
	      <div class="tinymargin"></div>
	      <?php $modelGeneral->notification_name = $usedGeneralData['notification_name'];?>
              <?php echo $form->textField($modelGeneral,'notification_name',array("class"=>"headline2 full","placeHolder"=>"Enter Sender Mail Id")); ?>
              <?php echo $form->error($modelGeneral,'notification_name'); ?>			
	    </div>
	    
	    <div class="grid_6">
	      <h2><?=Yii::t('translate','Mail Id') ?></h2>
	      <div class="tinymargin"></div>
	      <?php $modelGeneral->notification_mailid = $usedGeneralData['notification_mailid'];?>
              <?php echo $form->textField($modelGeneral,'notification_mailid',array("class"=>"headline2 full","placeHolder"=>"Enter Sender Mail Id")); ?>
              <?php echo $form->error($modelGeneral,'notification_mailid'); ?>
	    </div>
	    
	    <div class="halfmargin"></div>
            
	    <div class="grid_6 RIGHT">
	      <?php
                  if($model->isNewRecord){
                    echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnrulesave"));
                  }else{
                    echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btnrulesave"));
                  }
              ?>
	    </div>
	    <?php $this->endWidget(); ?>          
      <div class="halfmargin"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  //console.log(elem.attr('id'));	 
	  $.ajax({
			  type:'POST',
			  url: '<?php echo $gtype; ?>/appsettings/notifications/editTemplate/id/'+$(this).attr('data-ID'),
		      success: function(data){
			  $('#editTemplate').html(data);
			  $(this).colorbox.resize();
			  
		   } 
         });
	   
	   return false;

	}
}, 'a.smallEditIcon');

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  //console.log(elem.attr('id'));
	  var projid = $(this).attr('data-delID');
	  $.ajax({
			  type:'POST',
			  url: '<?php echo $gtype; ?>/appsettings/notifications/deleteTemplate/id/'+$(this).attr('data-delID'),
		      success: function(data){

			  $("#templ_"+projid).hide(); 
			  noticeAjax("Template Deleted Successfully","success"); 
			  
		   } 
         });
	   
	   return false;

	}
}, 'a.trashIcon');


$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  console.log(elem.attr('id'));
	  $.ajax({type:'POST',
			  url: '<?php echo $gtype; ?>/appsettings/notifications/editRules/id/'+$(this).attr('data-ruleID'),
		      success: function(data){
			  $('#editRule').html(data);
			  $(this).colorbox.resize();
			 } 
         });
	   
	   return false;

	}
}, 'a.editIcon');

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  console.log(elem.attr('id'));
	  var projid = $(this).attr('data-delID');
	  $.ajax({
			  type:'POST',
			  url: '<?php echo $gtype; ?>/appsettings/notifications/deleteRule/id/'+$(this).attr('data-delID'),
		      success: function(data){

			  $("#rules_"+projid).hide(); 
			  noticeAjax("Notification Rule Deleted Successfully","success"); 
			  
		   } 
         });
	   
	   return false;

	}
}, 'a.deleteIcon');
</script>
