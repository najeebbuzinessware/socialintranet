	
	<div id="outer_container" class="custom_background">
    	<?php BWDataFunction::getSectionMenuFromCtype($_GET['type']); ?>
		<?php //$this->renderpartial('application.views.common._recruitmentmenu'); ?>
		
		<div class="container_12">    
        
        	<?php //$this->renderpartial('application.views.common._jobfrontendmenu'); ?>
        
			<div class="grid_12 box shadowed_little stick">
				<div class="padding">
				  <div class="halfmargin"></div>
				<?php
					$form=$this->beginWidget('CActiveForm', array('id'=>'setting',
					'enableAjaxValidation'=>true,
					'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
					'htmlOptions' => array('enctype'=>'multipart/form-data')));
				?>
				<div class="halfmargin"></div>				
                   
                    <div class="lined">
                    	<div class="grid_12 alpha"><h2 class="headline1 noMargUp noMargDown LEFT">Workflow and Notifications</h2></div>
                    	<div class="clear"></div>
                    </div>
                                                    
                    <div class="halfmargin"></div>
                    
                    <div class="grid_2"><p class="headline2">Email Settings</p></div>                                
                    <div class="grid_10 boxSizing" style="border-left: 3px solid #ccc;">
                    	<?php
							$checked = '';
							if($workflowmodel->MailSetting=='' || $workflowmodel->MailSetting=='nomail')
							{
								$checked = 'checked';
							}
						?>
                        <div class="tinymargin"></div>
                        <div class="grid_1">
                        	<?php echo $form->radioButton($workflowmodel, 'MailSetting', array('value'=>'nomail','uncheckValue'=>null,'checked'=>$checked));?>
                        </div>
                        <div class="grid_11">
                            <span class="headline2">Do not email me</span><br/>
                            (No notifications will be emailed to you regarding job applications. You will check admin panel for new applicants)
                        </div>
                        
                        <div class="halfmargin"></div>
                        
                        <div class="grid_1">
							<?php echo $form->radioButton($workflowmodel, 'MailSetting', array('value'=>'dailycounts','uncheckValue'=>null));?>
                        </div>

                        <div class="grid_11">
                            <span class="headline2">Email me the daily counts of applications</span><br/>
                            (The total number of new applicants for each day will be emailed toy you on daily basis. You can also check admin panel for new applicants)
                        </div>
                        
                        <div class="halfmargin"></div>
                        
                        <div class="grid_1">
							<?php echo $form->radioButton($workflowmodel, 'MailSetting', array('value'=>'newappl','uncheckValue'=>null));?>
                        </div>

                        <div class="grid_11">
                            <span class="headline2">Email me CVs for new applicants</span><br/>
                            (Each applicant's CV will be emailed directly to you as they apply. You can also check admin panel for new applicants)
                        </div>
                    </div>
                                
                    <div class="halfmargin"></div>
                    
                    <div class="grid_2"><p class="headline2">Notification Contact</p></div>
                    <div class="grid_10 boxSizing" style="border-left: 3px solid #ccc;">
                        <div class="grid_4">
                            <div class="tinymargin"></div>
                            <?php echo $form->textField($workflowmodel,'Name',array("class"=>"full","placeholder"=>"Name","maxlength"=>"250","autocomplete"=>"off"));?>
                            <?php echo $form->error($workflowmodel,'Name');?>
                        </div>
                        <div class="grid_4">
                            <div class="tinymargin"></div>
                            <?php echo $form->textField($workflowmodel,'Email',array("class"=>"full","placeholder"=>"Email Address","maxlength"=>"250","autocomplete"=>"off"));?>
                            <?php echo $form->error($workflowmodel,'Email');?>
                            
                        </div>
                        <div class="grid_4">
                            <div class="tinymargin"></div>
                            <?php echo $form->textField($workflowmodel,'Contact',array("class"=>"full","placeholder"=>"Contact Address","maxlength"=>"250","autocomplete"=>"off"));?>
                            <?php echo $form->error($workflowmodel,'Contact');?>
                        </div>
                        <div class="tinymargin"></div>
                    </div>
                                                    
                    <div class="margin"></div>
                    
                    <div class="lined">
                        <div class="grid_12 alpha"><h2 class="headline1 noMargUp noMargDown LEFT">Dropdown Values</h2></div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="halfmargin"></div>
                                
                    <div class="grid_12 alpha omega">
                    
                    	<?php $this->renderPartial("_tabbers");?>
                        
                    	<div class="halfmargin"></div>
                        <div class="grid_1 RIGHT halfpadding">
                        	<?php echo CHtml::submitButton('Save Changes',array("class"=>"specialAction RIGHT","id"=>"update","name"=>"update"));?>
                        </div>
                        <div class="halfmargin"></div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
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
		var widgetIds = $('#TblJobSettings_Widgets').val();
		if(widgetIds!='')
		{
			comma = ",";
		}
		newFiles = widgetIds+comma+id;
		$('#TblJobSettings_Widgets').val(newFiles);
	}
	else
	{
		var widgetIds = $('#TblJobSettings_Widgets').val();
		var widgetIds_arr = widgetIds.split(",");
		var newWidgetIds_arr = new Array();
		for(var i=0;i<widgetIds_arr.length;i++)
		{
			if(id!=widgetIds_arr[i])
				newWidgetIds_arr.push(widgetIds_arr[i]);
		}
		newFiles = newWidgetIds_arr.toString();
		$('#TblJobSettings_Widgets').val(newFiles);
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

     
     
     </script>