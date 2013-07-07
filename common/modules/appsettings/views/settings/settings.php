<style>
/* File upload drag n drop */
.file-upload { border:3px dashed #b9b9b9; width: 100%; float: left; }
.file-upload:hover { background: #f6f6f6; }
#upload_backimage { width:100%; height:80px; padding:10px; }
#upload_backimage input[type="file"] { padding: 0; margin: 0; }
#uploaded_backimage { width:100%; background: #eee; }
.progrez { background: #34A216; height: 10px; }
#upload_backimage .mf_upload_m { height: 100% !important; }
#upload_backimage span { font-size: 17px; font-weight: bold; color: #939393; }
.drop { font-size: 15px; color: #ffffff !important; }
.rImg { max-width: 150px; max-height: 150px; background: #F7F7F7; padding: 10px; }

</style>

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
<!-- Main Body -->
<section id="content">


<div id="outer_container" class="custom_background">
	<?php 
		//BWDataFunction::getSectionMenuFromCtype($_GET['type']); 
		//$this->renderpartial('application.views.common._eventmenu'); 
		$applicationType = $_GET['type'];
	?>
		<div class="container_12">
        	  <div class="grid_12">
         <?php //$this->renderpartial('appsettings.views._notificationMenu'); ?>
         
    </div>
          
 
 <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'setting_form_branding',
    'action'=>'/appsettings/settings/saveLaunchSetting/type/'.$applicationType,
    'type'=>'horizontal',        		
    'htmlOptions'=>array('class'=>'well'),
)); ?>
             <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Branding',
	'headerIcon' => 'icon-th-list',
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>
			<div class="grid_12 box shadowed_little stick">
				<div class="padding">
					<div class="lined">
						<div class="grid_12 alpha">
							<h2 class="headline1 noMargUp noMargDown LEFT">Branding</h2>
							<p class="normaltxt1 noMargDown noMargUp">Personalize the visual elements of the frontend.</p>
						</div>
						<div class="clear"></div>
					</div>
					<div class="halfmargin"></div>
					<div class="grid_12">
						<p class="headline2">Your Company Logo</p>
						<div class="grid_8 alpha">
							<div class="file-upload">
								<div id="upload" class="boxSizing"></div>
								<div id="uploadaction" class="hidden uploadaction"><? echo '/appsettings/settings/uploadnew';?></div>
								<div id="uploaded" class="boxSizing"></div>
							</div>
						</div>
						<div class="grid_4" style="text-align: center;">
							<? if(strlen($settingDataModel['config_logo'])>0){$ulogo="/uploads/logo".Yii::app()->user->MId."/".$settingDataModel['config_logo'];}else{$ulogo='http://placehold.it/200x80';}?>
							<img src="<?=$ulogo ?>" alt="" width="200px" height="80px"/>
							<? 
			
									$settingmodel->config_logo = $settingDataModel['config_logo'];
			
									echo $form->hiddenField($settingmodel,'config_logo');?>
						</div>
					</div>
					<div class="halfmargin"></div>
					<div class="halfmargin"></div>
					<div class="grid_2">
						<p class="headline2">Link Color</p>
					</div>
					<div class="grid_2">
						<div class="tinymargin"></div>
							<?php 

							if(strlen($settingDataModel['config_link_color'])>0)
	
								$lColor = $settingDataModel['config_link_color'];
	
							else
	
								$lColor = '#f45000';
	
							echo $form->textFieldRow($settingmodel,'config_link_color',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$lColor,'onChange'=>"$(this).next().css('background-color',$(this).val());",'labelOptions' => array('label' => false))); ?>
						<div class="colorPrev" style="background-color: <?=$lColor?>"></div>
						<? echo $form->error($settingmodel,'config_link_color');?>
					</div>
					<div class="grid_2">
						<p class="headline2">Button bg Color</p>
					</div>
					<div class="grid_2">
						<div class="tinymargin"></div>
						
						<?php 
			
										if(strlen($settingDataModel['config_border_color'])>0)
			
											$bColor = $settingDataModel['config_border_color'];
			
										else
			
											$bColor = '#f45000';
			
										echo $form->textFieldRow($settingmodel,'config_border_color',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$bColor,'onChange'=>"$(this).next().css('background-color',$(this).val());",'labelOptions' => array('label' => false))); ?>
						<div class="colorPrev" style="background-color: <?=$bColor?>"></div>
						<? echo $form->error($settingmodel,'config_border_color'); ?>
					</div>
					<div class="grid_2">
						<p class="headline2">Link active Color</p>
					</div>
          
		<div class="grid_2">
               <div class="tinymargin"></div>
               
               <!--<input class="headline3 ac_input full" type="text" value="#e88554" onChange="$(this).next().css('background-color',$(this).val());">

                        <div class="colorPrev" style="background-color: #e88554"></div>-->
               
               <?php 

							if(strlen($settingDataModel['config_grad_start'])>0)

								$gsColor = $settingDataModel['config_grad_start'];

							else

								$gsColor = '#e88554';

							echo $form->textFieldRow($settingmodel,'config_grad_start',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$gsColor,'onChange'=>"$(this).next().css('background-color',$(this).val());",'labelOptions' => array('label' => false)));?>
               <div class="colorPrev" style="background-color: <?=$gsColor?>"></div>
               <? echo $form->error($settingmodel,'config_grad_start');?> </div>
          <div class="clear"></div>
          <div class="grid_2">
               <p class="headline2">Menu bg color</p>
          </div>
          <div class="grid_2">
               <div class="tinymargin"></div>
               <?php 

							if(strlen($settingDataModel['config_nav_color'])>0)

								$nColor = $settingDataModel['config_nav_color'];

							else

								$nColor = '#7a7a7a';

							echo $form->textFieldRow($settingmodel,'config_nav_color',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$nColor,'onChange'=>"$(this).next().css('background-color',$(this).val());",'labelOptions' => array('label' => false)));?>
               <div class="colorPrev" style="background-color: <?=$nColor?>"></div>
               <? echo $form->error($settingmodel,'config_nav_color');?> </div>
          <div class="grid_2">
               <p class="headline2">Navigation Hover</p>
          </div>
          <div class="grid_2">
               <div class="tinymargin"></div>
               <?php 

							if(strlen($settingDataModel['config_nav_hover'])>0)

								$nhColor = $settingDataModel['config_nav_hover'];

							else

								$nhColor = 'white';

							echo $form->textFieldRow($settingmodel,'config_nav_hover',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$nhColor,'onChange'=>"$(this).next().css('background-color',$(this).val());",'labelOptions' => array('label' => false)));?>
               <div class="colorPrev" style="background-color: <?=$nhColor?>"></div>
               <? echo $form->error($settingmodel,'config_nav_hover');?> </div>
          <div class="grid_2">
               <p class="headline2">Hover link color</p>
          </div>
          <div class="grid_2">
               <div class="tinymargin"></div>
               <?php 

							if(strlen($settingDataModel['config_grad_end'])>0)

								$geColor = $settingDataModel['config_grad_end'];

							else

								$geColor = '#ab4c1d';

							echo $form->textFieldRow($settingmodel,'config_grad_end',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$geColor,'onChange'=>"$(this).next().css('background-color',$(this).val());",'labelOptions' => array('label' => false)));?>
               <div class="colorPrev" style="background-color: <?=$geColor?>"></div>
               <? echo $form->error($settingmodel,'config_grad_end');?> </div>
          <div class="halfmargin"></div>
            <div class="grid_2">
               <p class="headline2">Twitter Widget</p>
          </div>
          <div class="grid_2">
               <div class="tinymargin"></div>
    <?php 
    if(strlen($settingDataModel['config_twitter_widget'])>0)
    		
    	$settingmodel->config_twitter_widget = $settingDataModel['config_twitter_widget'];
    	
    else
    		
    	$settingmodel->config_twitter_widget =  '';
    echo $form->textAreaRow($settingmodel,'config_twitter_widget',array("class"=>"headline3 ac_input full",'labelOptions' => array('label' => false)));?>
    <? echo $form->error($settingmodel,'config_twitter_widget');?> </div>
          <div class="halfmargin"></div>
          <div class="grid_12 alpha omega">
                   <div class="grid_1 RIGHT halfpadding"> 
				   	<?php //echo CHtml::submitButton('Save Changes',array("class"=>"specialAction RIGHT","id"=>"update","name"=>"saveLaunchBtn"));?> 
                    <? //echo CHtml::hiddenField("ajax",'setting_form_launch');?>
                    <? echo $form->hiddenField($settingmodel,"saveBrandingBtn",array("value"=>'Save Branding Changes'));?>
                   
						<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Save (Ctrl+S)')); ?>
					
                   </div>
              </div>
				</div>
			</div>
            <?php $this->endWidget(); ?>
			<?php $this->endWidget(); ?>
			<div class="halfmargin"></div>
            
		
		<div class="halfmargin"></div>
<div class="clearfix"></div>
</section>		
         
<script type="application/javascript" language="javascript">

function appendFile(field,fileName)
{
	$('#'+field).val(fileName);
}

function selectBox(id)
{
	var newFiles = '';

	if ($('#'+id+':checked').val() !== undefined)
	{
		var comma = "";
		var widgetIds_arr = new Array();
		var widgetIds = $('#SettingsFrontendForm_config_widgets').val();
		if(widgetIds!='')
		{
			comma = ",";
		}
		newFiles = widgetIds+comma+id;

		$('#SettingsFrontendForm_config_widgets').val(newFiles);
	}
	else
	{
		var widgetIds = $('#SettingsFrontendForm_config_widgets').val();

		var widgetIds_arr = widgetIds.split(",");

		var newWidgetIds_arr = new Array();

		for(var i=0;i<widgetIds_arr.length;i++)
		{
			if(id!=widgetIds_arr[i])
				newWidgetIds_arr.push(widgetIds_arr[i]);
		}
		newFiles = newWidgetIds_arr.toString();
		$('#SettingsFrontendForm_config_widgets').val(newFiles);
	}
}

$(document).on({
	click:
	function (e) {
		$("#logofile :input").trigger('click');
	}
}, '#logofile');

$(document).on({
	click:
	function (e) {
		$("#bannerfile :input").trigger('click');
	}
}, '#bannerfile');

</script> 
<script type="text/javascript">
	 	$(document).on({
		click:
		function(e) {
			e.stopPropagation();
			e.preventDefault();
			var fileid = $(this).attr('data-copyID');

				if(confirm("Do you really want to delete file?"))
				{
					$.ajax({

					type:'POST',

					data: { id:fileid },

					url: '/members/recruitment/job/deleteFile',

					success: function(data){

					$("#File_"+fileid).hide();

					noticeAjax("File Deleted Successfully","success");

					}
					});
				}
			}
		}, 'a.deleteFiles');



     function showBannerFilePanel(obj)
	 {
	 	if(obj.value == 'right')
		{
			$('#bannerImages').show();
			$('#topBanner').hide();
			$('#rightBanner').show();
		}
		else if(obj.value == 'top')
		{
			$('#bannerImages').show();
			$('#topBanner').show();
			$('#rightBanner').hide();
		}
		else if(obj.value == 'all')
		{
			$('#bannerImages').show();
			$('#topBanner').show();
			$('#rightBanner').show();
		}
		else
		{
			$('#bannerImages').hide();
			$('#topBanner').hide();
			$('#rightBanner').hide();
		}
	 }
     

	 function showFrontEndPanel(obj)
	 {
	 	if(obj.value == 'Yes')
		{
			$('#frontendYes').show();
			$('#frontendYesDate').show();
			//$('#frontendNo').hide();
			//$('#SettingsFrontendForm_config_frontend_offline_msg').val('');
		}
		else if(obj.value == 'No')
		{
			$('#frontendYes').hide();
			$('#frontendYesDate').hide();

			//$('#frontendNo').show();
			//$('[id^="SettingsFrontendForm_config_frontend_type"]').prop('checked', false);
			$('#SettingsFrontendForm_config_frontend_startdate').val('');
			$('#SettingsFrontendForm_config_frontend_enddate').val('');
			$('#SettingsFrontendForm_config_frontend_starttime').val('');
			$('#SettingsFrontendForm_config_frontend_endtime').val('');
			$('#SettingsFrontendForm_config_frontend_username').val('');
			$('#SettingsFrontendForm_config_frontend_password').val('');
		}
		else if(obj.value == 'Private')
		{
			$('#frontendPrivate').show();
			$('#frontendPublic').hide();
		}

		else if(obj.value == 'Public')
		{
			$('#frontendPrivate').hide();
			$('#frontendPublic').show();
			$('#SettingsFrontendForm_config_frontend_username').val('');
			$('#SettingsFrontendForm_config_frontend_password').val('');
		}

		else if(obj.value == 'Both')
		{
			$('#frontendPrivate').show();
			$('#frontendPublic').show();
		}
	 }
	 

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  console.log(elem.attr('id'));
	  window.open('<?=BWCFunctions::getAppUrl()?>/<?=$this->module?>/CMSContent/default/editContent/type/<?=$applicationType ?>/id/'+$(this).attr('data-projID'), '_blank');
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
			  url: '<?=BWCFunctions::getAppUrl()?>/<?=$this->module?>/CMSContent/default/deleteMenu/id/'+$(this).attr('data-delID'),
		      success: function(data){
			  $("#user_"+projid).hide(); 
			  noticeAjax("Menu Deleted Successfully...!","success");
		   } 
         });
	   return false;
	}
}, 'a.deleteIcon');

</script>

<script type="text/javascript">
	
	function deleteUploadedBkImage()
	{
		$('#uploaded_backimage').html('');
		$('#SettingsFrontendForm_config_background_image').val('');
		$('#background_image').attr('src','http://placehold.it/200x80');
		$('#RemoveBackgroundImageBtn').addClass("hidden");
	}
	
	
	function removeBackgroundImage()
	{
		if(confirm("Do you really want to remove background image?"))
		{
			$('#SettingsFrontendForm_config_background_image').val('');
			$('#background_image').attr('src','http://placehold.it/200x80');
			$('#RemoveBackgroundImageBtn').addClass("hidden");
			$('#layoutsbtnsave_ajax').click();
			noticeAjax("Layout Setting Saved Successfully...!","success");
		}
	}
	
	function removeBannerImage(bannerId,side)
	{
		if(confirm("Do you really want to remove banner image?"))
		{
			$.ajax({
				  type:'POST',
				  url: '<?=BWCFunctions::getAppUrl()?>/<?=$this->module?>/appsettings/settings/deleteBanner/id/'+bannerId,
				  success: function(data){
				  //$("#RemoveBannerImageBtn").hide();
				  $("#"+side).hide(); 
				  noticeAjax("Banner Removed Successfully...!","success");
			   } 
			 });
		}
	}
	
	</script>
