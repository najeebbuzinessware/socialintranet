  <?php $form=$this->beginWidget('CActiveForm', array('action'=>$this->mainUrl.'/appsettings/settings/saveLaunchSetting/type/'.$applicationType,
'id'=>'setting_form_launch','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),)); ?>
			<div class="grid_12 box shadowed_little stick" id="launchSettingDiv">
				<div class="padding">
					<div class="lined">
						<div class="grid_12 alpha">
							<h2 class="headline1 noMargUp noMargDown LEFT">Launch</h2>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="halfmargin"></div>

					<div class="grid_2">
						<div class="micromargin"></div>
						<p class="headline2 m-t-0 m-b-0">Show Frontend</p>
					</div>

					<div class="grid_2 rdbl">
						<div class="tinymargin"></div>
						<?php 
							$dataArray = array('Yes'=>'Yes','No'=>'No');
							$settingmodel->config_show_frontend = $settingDataModel['config_show_frontend'];
							echo $form->radioButtonList($settingmodel, 'config_show_frontend',$dataArray,array('separator'=>'','onclick'=>'showFrontEndPanel(this);'));
						?>
					</div>
					
					<div class="grid_8">
						<?php 
							$settingmodel->config_frontend_url = $settingDataModel['config_frontend_url'];
							echo $form->textField($settingmodel,'config_frontend_url',array("class"=>"uniBlock","placeholder"=>"Front End URL"));
						?>
					</div>
							
					<?php 
						if($settingDataModel['config_show_frontend'] == 'Yes'){$yes = "block"; $no = "none";}
						elseif($settingDataModel['config_show_frontend'] == 'No'){$yes = "none"; $no = "block";}
						else{$yes = "none"; $no = "none";}
					?>
          
					<div id="frontendYes" style="display:<?=$yes?>;">
						<div id="frontendYesDate" style="display:<?=$yes?>;">
						
							<div class="halfmargin"></div>
							
							<div class="grid_2">
								<div class="tinymargin"></div>
								<p class="headline2 m-t-0 m-b-0">Front End Type</p>
							</div>
							
							<div class="grid_4 rdbl">
								<div class="tinymargin"></div><div class="micromargin"></div>
								<?php 
									  $dataArray = array('Private'=>'Private','Public'=>'Public','Both'=>'Both');
									  $settingmodel->config_frontend_type = $settingDataModel['config_frontend_type'];
									  echo $form->radioButtonList($settingmodel, 'config_frontend_type',$dataArray,array('separator'=>'','onclick'=>'showFrontEndPanel(this);'));
								   ?>
								<?php echo $form->error($settingmodel,'config_frontend_type');?>
							</div>
							<div class="tinymargin"></div>
							<div class="grid_4">
								<?php 
								$settingmodel->config_frontend_startdate = $settingDataModel['config_frontend_startdate'];
								Yii::import('common.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
									$this->widget('CJuiDateTimePicker',array(
										'htmlOptions'=>array("class"=>"full uniBlock","placeholder"=>"Start Date"),
										'model'=>$settingmodel, //Model object
										'attribute'=>'config_frontend_startdate', //attribute name
										'language'=>'',
										'mode'=>'date', //use "time","date" or "datetime" (default)
										'options'=>array(
											"minDate"=>0,
											"dateFormat"=>"yy-mm-dd",
											//"timeFormat"=>"hh:mm",
											"stepMinute"=>"5",
											"hour"=>date('h',strtotime($settingmodel->config_frontend_startdate)),
											"minute"=>date('i',strtotime($settingmodel->config_frontend_startdate)),
										) // jquery plugin options
									));
								?>
								<?php echo $form->error($settingmodel,'config_frontend_startdate');?>
							</div>
							<div class="grid_2">
                            	<?php 
									$settingmodel->config_frontend_starttime = $settingDataModel['config_frontend_starttime'];
									echo $form->dropDownList($settingmodel,'config_frontend_starttime',BWSettingFunctions::getTotHours(),array("prompt"=>"Hours","class"=>"full uniBlock")); 
								?>
							</div>
							
                            <div class="grid_4">
								<?php 
								$settingmodel->config_frontend_enddate = $settingDataModel['config_frontend_enddate'];
								Yii::import('common.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
									$this->widget('CJuiDateTimePicker',array(
										'htmlOptions'=>array("class"=>"full uniBlock","placeholder"=>"End Date"),
										'model'=>$settingmodel, //Model object
										'attribute'=>'config_frontend_enddate', //attribute name
										'language'=>'',
										'mode'=>'date', //use "time","date" or "datetime" (default)
										'options'=>array(
											"minDate"=>0,
											"dateFormat"=>"yy-mm-dd",
											//"timeFormat"=>"hh:mm",
											"stepMinute"=>"5",
											"hour"=>date('h',strtotime($settingmodel->config_frontend_enddate)),
											"minute"=>date('i',strtotime($settingmodel->config_frontend_enddate)),
										) // jquery plugin options
									));
								?>
								<?php echo $form->error($settingmodel,'config_frontend_enddate');?>
							</div>
                            
							<div class="grid_2">
                            
                            	<?php 
									$settingmodel->config_frontend_endtime = $settingDataModel['config_frontend_endtime'];
									echo $form->dropDownList($settingmodel,'config_frontend_endtime',BWSettingFunctions::getTotHours(),array("prompt"=>"Hours","class"=>"full uniBlock")); 
								?>
							</div>
							
						</div>
				
						<?php 
							if($settingDataModel['config_frontend_type'] == 'Private'){$private = "block"; $public = "none";}
							elseif($settingDataModel['config_frontend_type'] == 'Public'){$private = "none"; $public = "block";}
							elseif($settingDataModel['config_frontend_type'] == 'Both'){$private = "block"; $public = "block";}
							else{$private = "none"; $public = "none";}
						?>
							
						<div id="frontendPrivate" style="display:<?=$private?>;">
							<div class="halfmargin"></div>

							<div class="grid_4">
								<?php 
								$settingmodel->config_frontend_username = $settingDataModel['config_frontend_username'];
								echo $form->textField($settingmodel,'config_frontend_username',array("class"=>"full uniBlock","placeholder"=>"User Name","maxlength"=>"250","autocomplete"=>"off"));?> <?php echo $form->error($settingmodel,'config_frontend_username');?>
							</div>
								
							<div class="grid_4">
								<?php 
								$settingmodel->config_frontend_password = $settingDataModel['config_frontend_password'];
								echo $form->textField($settingmodel,'config_frontend_password',array("class"=>"full uniBlock","placeholder"=>"Password"));?> <?php echo $form->error($settingmodel,'config_frontend_password');?>
							</div>
						</div>
	
						<div class="halfmargin"></div>
					</div>
          
					<div>
						<div class="halfmargin"></div>
									
						<div class="grid_4">
							<?php
								$settingmodel->config_frontend_offline_msg = $settingDataModel['config_frontend_offline_msg'];
								echo $form->textarea($settingmodel,'config_frontend_offline_msg',array("class"=>"full uniBlock","placeholder"=>"Offline Message","maxlength"=>"250","autocomplete"=>"off"));?> <?php echo $form->error($settingmodel,'config_frontend_offline_msg');
							?>
						</div>
					</div>

					<div class="grid_4">
						<?php 
							$settingmodel->config_backlink_url = $settingDataModel['config_backlink_url'];
							echo $form->textField($settingmodel,'config_backlink_url',array("class"=>"uniBlock","placeholder"=>"Back Link URL"));
							echo $form->error($settingmodel,'config_backlink_url');
						?>
					</div>
                    
                    <div class="grid_4">
						<?php 
							$displayTypes = array('general'=>'General','weekdays'=>'Group By Weekdays');
							$settingmodel->config_display_list_type = $settingDataModel['config_display_list_type'];
							echo $form->dropDownList($settingmodel,'config_display_list_type',$displayTypes,array("class"=>"uniBlock","prompt"=>"Display Type")); ?>
					</div>

					<!--<div class="grid_4">
						<?php 
							$settingmodel->config_listlimit = $settingDataModel['config_listlimit'];
							echo $form->textField($settingmodel,'config_listlimit',array("class"=>"uniBlock","placeholder"=>"No of records to show in home List")); ?>
					</div>-->
				</div>
				<div class="micromargin"></div>
				<div class="halfmargin"></div>
                
                <div class="grid_12 alpha omega">
                   <div class="grid_1 RIGHT halfpadding"> 
				   	<?php //echo CHtml::submitButton('Save Changes',array("class"=>"specialAction RIGHT","id"=>"update","name"=>"saveLaunchBtn"));?> 
                    <? //echo CHtml::hiddenField("ajax",'setting_form_launch');?>
                    <? echo $form->hiddenField($settingmodel,"saveLaunchBtn",array("value"=>'Save Launch Changes'));?>
                    <?php 
						 echo CHtml::ajaxSubmitButton('Save (Ctrl+S)',
						 Yii::app()->createUrl('/appsettings/settings/saveLaunchSetting/type/'.$applicationType),
						 array('type' => 'POST',
						 'dataType' => 'json',
						 'success' => 'js:function(data) {
								if(data.success==true)
								{
									$("[id^=\'SettingsFrontendForm_\']").parents("div").removeClass("error");
									noticeAjax("Launch Setting Saved Successfully...!","success");
								}
								else
								{
									//noticeAjax("Launch Setting Could Not Be Saved...!","failure");
									$("[id^=\'SettingsFrontendForm_\']").parents("div").removeClass("error");
									$.each(data, function(key, val) {
									$("#launchSettingDiv #"+key).parent("div").addClass("error");
									});
								}
							 }'),array('name'=>'launchbtnsave_ajax','class'=>'specialAction RIGHT'));
					?>
                   </div>
              </div>
			</div>
			<?php $this->endWidget(); ?>
			<div class="halfmargin"></div>