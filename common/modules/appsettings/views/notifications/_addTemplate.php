<div class="modal">
  <div id="editRule" class="container_12">
    <div class="emptyModal"></div>
  </div>
</div>
<div id="outer_container" class="custom_background">
<?php BWDataFunction::getSectionMenuFromCtype($_GET['type']); ?>
<div class="container_12">
    <div class="grid_12"><?php $this->renderpartial('appsettings.views._notificationMenu'); ?></div>
    <div class="grid_12 box shadowed_little">
        <div class="padding">
            <h2 class="headline1-inner lined"><?=Yii::t('translate','Add a New Template') ?></h2>
            <p> </p>
			<?php $form=$this->beginWidget('CActiveForm', array("action"=>"",'id'=>'frmtmplate','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>
        
            <div class="grid_4">
                <label>
                    <p class="headline6"><?=Yii::t('translate','Template Name') ?></p>
                    <?php echo $form->textField($model,'TemplateName',array("class"=>"headline2 full","placeHolder"=>"Enter Template Name")); ?>
                    <?php echo $form->error($model,'TemplateName'); ?>
                </label>
            </div>
        
            <div class="grid_4">
                <label>
                    <p class="headline6"><?=Yii::t('translate','Template Subject') ?></p>
                    <?php echo $form->textField($model,'TemplateSubject',array("class"=>"headline2 full","placeHolder"=>"Enter Template Subject")); ?>
                    <?php echo $form->error($model,'TemplateSubject'); ?>
                </label>
            </div>
            
            <div class="grid_4">
                <label>
                    <p class="headline6"><?=Yii::t('translate','Sender Name') ?></p>
                    <?php $model->senderName = $usedGeneralData['notification_name'];?>
                    <?php echo $form->textField($model,'senderName',array("class"=>"headline2 full","placeHolder"=>"Enter Sender Name")); ?>
                    <?php echo $form->error($model,'senderName'); ?>
                </label>
            </div>
            
            <div class="grid_4">
                <label>
                    <p class="headline6"><?=Yii::t('translate','Sender Mail Id') ?></p>
                    <?php $model->senderMailId = $usedGeneralData['notification_mailid'];?>
                    <?php echo $form->textField($model,'senderMailId',array("class"=>"headline2 full","placeHolder"=>"Enter Sender Mail Id")); ?>
                    <?php echo $form->error($model,'senderMailId'); ?>
                </label>
            </div>
            
            <div class="grid_8">
                <label>
                    <p class="headline6"><?=Yii::t('translate','Copy To') ?></p>
                    <?php echo $form->textField($model,'carbonCopy',array("class"=>"headline2 full","placeHolder"=>"Enter Mail Ids with Comma Saperated..")); ?>
                    <?php echo $form->error($model,'carbonCopy'); ?>
                </label>
            </div>
        
            <div class="grid_12">
                <label>
                    <p class="headline6"><?=Yii::t('translate','Template') ?></p>
                    <?php $this->widget('common.extensions.elrtef.elRTEText', array(
                        'model' => $model, 'attribute' => 'Template',
                        'options' => array('lang'=>'en', 'height'=>200, 'toolbar'=>'maxi', 'styleWithCss'=>true, 'allowSource'=>true,)
                        )); 
                    ?>                    
                    <span style="color:#FF0000;"><?php echo $form->error($model,'Template',array('class'=>'error')); ?></span>
                </label>
            	
            </div>
            
            <div class="grid_12">
                <label>
                <p class="headline6"><?=Yii::t('translate','Email Template Variables') ?></p>
                 <?php $this->renderpartial('_Variables'); ?> 
                
                    <!--<tr><td>Useremail</td><td>{$useremail}</td></tr>
                    <tr><td>ProductId</td><td>{$product_id}</td></tr>
                    <tr><td>Product Name</td><td>{$product_name}</td></tr>
                    <tr><td>Order Id</td><td>{$order_id}</td></tr>
                    <tr><td>Store Id</td><td>{$store_id}</td></tr>
                    <tr><td>Store Name</td><td>{$store_name}</td></tr>
                    <tr><td>Password</td><td>{$password}</td></tr>-->
                </label>
            </div>
			<?php $model->TemplateType = 'Html'; echo $form->hiddenField($model,'TemplateType');?>
            <div class="margin"></div>
        
            <div class="grid_12"> 
                <?php echo $form->hiddenField($model,'TempId');  ?>
                <?php
                    if($model->isNewRecord){
                        echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btntempsave"));
                    }else{
                        echo CHtml::submitButton('Save (Ctrl+S)',array('class'=>'specialAction RIGHT','id'=>'btn_rec_save_button',"name"=>"btntempsave"));
                    }
                ?>
                <input type="hidden" name="redirect" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
                
            </div>
			<?php $this->endWidget(); ?>
            <div class="halfmargin"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
/*$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  //console.log(elem.attr('id'));	 
	  $.ajax({
			  type:'POST',
			  url: '/members/notifications/editTemplate/id/'+$(this).attr('data-ID'),
		      success: function(data){
			  $('#editTemplate').html(data);
			  $(this).colorbox.resize();
			  
		   } 
         });
	   
	   return false;

	}
}, 'a.smallEditIcon');*/

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  //console.log(elem.attr('id'));
	  var projid = $(this).attr('data-delID');
	  $.ajax({
			  type:'POST',
			  url: '/members/notifications/deleteTemplate/id/'+$(this).attr('data-delID'),
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
	  //console.log(elem.attr('id'));
	  $.ajax({
			  type:'POST',
			  url: '/members/notifications/editRules/id/'+$(this).attr('data-ID'),
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
			  url: '/members/notifications/deleteRule/id/'+$(this).attr('data-delID'),
		      success: function(data){

			  $("#rule_"+projid).hide(); 
			  noticeAjax("Notification Rule Deleted Successfully","success"); 
			  
		   } 
         });
	   
	   return false;

	}
}, 'a.deleteIcon');

</script>