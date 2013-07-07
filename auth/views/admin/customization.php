<div id="outer_container" class="custom_background">
<?php $this->renderpartial('application.views.admin._adminTopmenu'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'frm-add-master','enableAjaxValidation'=>true,
		'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),)); ?>
<div class="container_12">
  <div class="box shadowed_little">
    <div class="padding">

                         <h2 class="headline1 noMargUp LEFT"><? echo Yii::t('translate',"Branding"); ?></h2>
			 <div class="clear"></div>
		<div class="s-lined"></div>
		<div class="tinymargin"></div>
		                         <p class="normaltxt1 noMargDown noMargUp"><?=Yii::t("translate","Personalize the visual elements of your app.") ?></p>
    
    
     
      
      <div class="halfmargin"></div>
      <div class="grid_3">
        <p class="headline2"><? echo Yii::t('translate',"Your Company Logo"); ?></p>
       </div> 
        
         <div class="grid_4">
      	
      <div class="uploadFile">
						<p class="headline2 BLUE middle"><?php echo Yii::t('translate','Click to select a file');?></p>
						<p class="normaltxt1 middle"><?php echo Yii::t('translate','or drag files here to upload');?></p>
                    <?php
							$this->widget( 'common.extensions.EAjaxUpload.EAjaxUpload', 
									array( 
										'id' => 'images', 
										'config' => array( 
														'action' => '/admin/upload', 
														'allowedExtensions' => array( "jpg", "jpeg", "gif", "png" ), 
														'sizeLimit' => Yii::app()->params['maxfilesize'], 
														'onComplete' => "js:function(id, fileName, responseJSON)
			{	var file = responseJSON.filename;
				$('#frontendlogo').attr('src','/userData/uploads/'+file);
				$('#TblMaster_FrontendLogo').val(file);
				$('#images .qq-upload-drop-area').css('display','none');
			}" ) ) );
							echo $form->hiddenField( $model, 'FrontendLogo' );
							?>
                    
                    
                </div>
      </div>
      
        <div class="grid_2 padding round">
     
            <? if(strlen($model->FrontendLogo)>0){ $path = '/userData/uploads/'.$model->FrontendLogo; }else{ $path='http://assets.bw.ae/bw/images/apps/demo.png';} ?>
            <img class="padding" align="middle" id="frontendlogo" src="<?=$path ?>" alt="" border="0" />

       </div>

      
      <!-- 
       <div class="grid_4">
        <label>
        <p class="headline2"><? echo Yii::t('translate',"Your Corporate Name"); ?></p>
        <?php if(strlen($model->Company)<1){ $model->Company = Yii::t('translate','Corporate Name'); }
echo $form->textField($model,'Company',array("class"=>"headline2 full","placeholder"=>Yii::t('translate','Corporate Name'))); ?>
        <?php echo $form->error($model,'Company'); ?>
        </label>
      </div>
      
      <div class="grid_4">
        <label>
        <p class="headline2"><? echo Yii::t('translate',"Corporate's Contact Number"); ?></p>
        <?php if(strlen($model->ContactNumber)<1){ $model->ContactNumber = Yii::t('translate',"Corporate's Contact Number"); }
echo $form->textField($model,'ContactNumber',array("class"=>"headline2 full","placeholder"=>Yii::t('translate',"Corporate's Contact Number"))); ?>
        <?php echo $form->error($model,'ContactNumber'); ?>
        </label>
      </div>
      
      <div class="grid_4">
        <label>
        <p class="headline2"><?=Yii::t("translate","From Address") ?></p>
        <input class="headline2 full" placeholder="" type="text" >
        </label>
      </div>
      
      <div class="grid_4">
        <label>
        <p class="headline2"><?=Yii::t("translate","To Address") ?></p>
        <input class="headline2 full" placeholder="" type="text" >
        </label>
      </div>
      -->
     
      <!--
        <p class="normaltxt1"><? echo Yii::t('translate',"Drag 'n Drop A New Logo File Here to Replace"); ?></p>
        <?php echo $form->fileField($model, 'FrontendLogo', array("class"=>"full")); ?> </div>
       -->
      
      
      
    
      <div class="halfmargin"></div>
      
      <div class="grid_3">
        <p class="headline2"><? echo Yii::t('translate',"Select Background"); ?></p>
      </div>
      
      <div class="grid_8">
        <div class="color_pattern white" data-color="white" onClick="$('#TblMaster_Background').val('white');"></div>
        <div class="color_pattern green" data-color="green" onClick="$('#TblMaster_Background').val('green');"></div>
        <div class="color_pattern sky" data-color="sky" onClick="$('#TblMaster_Background').val('sky');"></div>
        <div class="color_pattern navy" data-color="navy" onClick="$('#TblMaster_Background').val('navy');"></div>
        <div class="color_pattern warm" data-color="warm" onClick="$('#TblMaster_Background').val('warm');"></div>
        <div class="color_pattern pink" data-color="pink" onClick="$('#TblMaster_Background').val('pink');"></div>
      </div>
      <div class="halfmargin"></div>
      
      <div class="grid_3">
        <p class="headline2"><? echo Yii::t('translate',"Select Zoom Level"); ?></p>
      </div>
      
      <div class="grid_8 zoomLevels">
        <div data-zoomValue="100%" data-zoomClass="moz-zoom100" onClick="$('#TblMaster_ZoomLevel').val('Default');"><? echo Yii::t('translate',"Default"); ?></div>
        <div data-zoomValue="160%" data-zoomClass="moz-zoom160" onClick="$('#TblMaster_ZoomLevel').val('Tablets');"><? echo Yii::t('translate',"Tablets"); ?></div>
        <div data-zoomValue="120%" data-zoomClass="moz-zoom120" onClick="$('#TblMaster_ZoomLevel').val('Cozy');"><? echo Yii::t('translate',"Cozy"); ?></div>
        <div data-zoomValue="110%" data-zoomClass="moz-zoom110" onClick="$('#TblMaster_ZoomLevel').val('Comfortable');"><? echo Yii::t('translate',"Comfortable"); ?></div>
        
        <div data-zoomValue="90%" data-zoomClass="moz-zoom90" onClick="$('#TblMaster_ZoomLevel').val('Compact');"><? echo Yii::t('translate',"Compact"); ?></div>
        <div data-zoomValue="80%" data-zoomClass="moz-zoom80" onClick="$('#TblMaster_ZoomLevel').val('Tiny');"><? echo Yii::t('translate',"Tiny"); ?></div>
      </div>
      <!--
      <div class="grid_12">
      <?php echo CHtml::submitButton(' ',array('class'=>'specialAction RIGHT icon saveIconGreen','id'=>'btn_rec_save_button','value'=>'Save')); ?> 
      </div>
      -->
      <div class="grid_12"> <input class="specialAction RIGHT" type="submit" name="yt0" value="Save (Ctrl+S)" id="yt0"> </div>
      
      <div class="clear"></div>
    </div>
  </div>
</div>
<? echo $form->hiddenField($model,"Background"); ?> <? echo $form->hiddenField($model,"ZoomLevel"); ?>
<?php $this->endWidget(); ?>
