<div>
		<script type="text/javascript" src="/js/functions.js"></script>
		<script type="text/javascript" src="/js/mfupload.js"></script>
		<script type="text/javascript">
	$(document).ready(function() {
	//function AjaxUpload($posturl,fieldname,formname){
		var errors="";
		//alert($("div.uploadaction").html());
		$('#upload').mfupload({
			
			type		: '',	//all types
			maxsize		: 20,
			post_upload	: $("div.uploadaction").html(),
			folder		: "./",
			ini_text	: "<div class='halfmargin'></div><span>Click / Drag your logo file here</span>",
			over_text	: "<div class='halfmargin'></div><span class='drop'>Drop Here</span>",
			over_col	: 'white',
			over_bkcol	: 'green',
		
			init		: function(){		
				$("#uploaded").empty();
			},
			
			start		: function(result){		
				$("#uploaded").append("<div id='FILE"+result.fileno+"' class='files'>"+result.filename+"<div id='PRO"+result.fileno+"' class='progrez_img'><img src='/images/ajax-loader.gif' /></div></div>");	
			},
	
			loaded		: function(result){
				$("#PRO"+result.fileno).remove();
				$("#FILE"+result.fileno).html("<div class='smallpadding'>Uploaded: "+result.filename+" ("+result.size+")<input type='hidden' name='hdnfilename[]' value='"+result.filename+"' /></div>");				},
	
			progress	: function(result){
				$("#PRO"+result.fileno).css("width", result.perc+"%");
			},
	
			error		: function(error){
				errors += error.filename+": "+error.err_des+"\n";
			},
	
			completed	: function(){
				if (errors != "") {
					alert(errors);
					errors = "";
				}
			}
		});
		
	})
	</script>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'id'=>'tbl-sys-users-form',
	//'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>true,
        'validateOnType'=>true,     
     ),
    //'enableAjaxValidation'=>true,
	'type'=>'horizontal',
	'htmlOptions' => array("class"=>"form-horizontal"),
)); ?>


    <p class="help-block">Fields with <span class="required">*</span> are required.</p> 

    <?php //echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'Name',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'Nick',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'Email',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'PhoneNo',array('class'=>'span5','maxlength'=>255)); ?>
    
    
    <div class="control-group "><label class="control-label" for="TblSysUsers_PhoneNo">Report To</label>
	    <div class="controls">
	    	<?php echo TblSysUsers::model()->findByPk($model->ReportTo)->Name; ?>
	   </div>
    </div>
    
    <?php //echo TblSysUsers::model()->findByPk($model->ReportTo)->Name; ?>

    <?php //echo $form->fileFieldRow($model, 'Avatar'); ?>
    <div class="grid_10">
		<p class="headline2">Your Avatar</p>
		<div class="grid_6 alpha">
			<div class="file-upload">
				<div id="upload" class="boxSizing"></div>
				<div id="uploadaction" class="hidden uploadaction"><? echo '/user/upload';?></div>
				<div id="uploaded" class="boxSizing"></div>
			</div>
		</div>
		<div class="grid_4" style="text-align: center;">
			<? if(strlen($model['Avatar'])>0){$ulogo="/uploads/logo".Yii::app()->user->MId."/".$model['Avatar'];}else{$ulogo='http://placehold.it/200x80';}?>
			<img src="<?=$ulogo ?>" alt="" width="200px" height="80px"/>
			<? 
	
					//$settingmodel->config_logo = $settingDataModel['config_logo'];
	
					echo $form->hiddenField($model,'Avatar');?>
		</div>
	</div>
     
    <div class="form-actions"> 
        <?php $this->widget('bootstrap.widgets.TbButton', array( 
            'buttonType'=>'submit', 
            'type'=>'primary', 
            'label'=>$model->isNewRecord ? 'Create' : 'Save', 
        )); ?>
    </div> 

<?php $this->endWidget(); ?>
</div>