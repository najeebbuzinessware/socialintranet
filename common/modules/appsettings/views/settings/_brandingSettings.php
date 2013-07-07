  
            <?php $form=$this->beginWidget('CActiveForm', array('action'=>$this->mainUrl.'/appsettings/settings/saveLaunchSetting/type/'.$applicationType,
'id'=>'setting_form_branding','enableAjaxValidation'=>true,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),)); ?>
            
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
								<div id="uploadaction" class="hidden uploadaction"><? echo $this->mainUrl.'/appsettings/settings/uploadnew';?></div>
								<div id="uploaded" class="boxSizing"></div>
							</div>
						</div>
						<div class="grid_4" style="text-align: center;">
							<? if(strlen($settingDataModel['config_logo'])>0){$ulogo="/userData/uploads/logo".Yii::app()->user->MId."/".$settingDataModel['config_logo'];}else{$ulogo='http://placehold.it/200x80';}?>
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
	
							echo $form->textField($settingmodel,'config_link_color',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$lColor,'onChange'=>"$(this).next().css('background-color',$(this).val());")); ?>
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
			
										echo $form->textField($settingmodel,'config_border_color',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$bColor,'onChange'=>"$(this).next().css('background-color',$(this).val());")); ?>
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

							echo $form->textField($settingmodel,'config_grad_start',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$gsColor,'onChange'=>"$(this).next().css('background-color',$(this).val());"));?>
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

							echo $form->textField($settingmodel,'config_nav_color',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$nColor,'onChange'=>"$(this).next().css('background-color',$(this).val());"));?>
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

							echo $form->textField($settingmodel,'config_nav_hover',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$nhColor,'onChange'=>"$(this).next().css('background-color',$(this).val());"));?>
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

							echo $form->textField($settingmodel,'config_grad_end',array("class"=>"headline3 ac_input full","maxlength"=>"10","value"=>$geColor,'onChange'=>"$(this).next().css('background-color',$(this).val());"));?>
               <div class="colorPrev" style="background-color: <?=$geColor?>"></div>
               <? echo $form->error($settingmodel,'config_grad_end');?> </div>
          <div class="halfmargin"></div>
          <div class="grid_12 alpha omega">
                   <div class="grid_1 RIGHT halfpadding"> 
				   	<?php //echo CHtml::submitButton('Save Changes',array("class"=>"specialAction RIGHT","id"=>"update","name"=>"saveLaunchBtn"));?> 
                    <? //echo CHtml::hiddenField("ajax",'setting_form_launch');?>
                    <? echo $form->hiddenField($settingmodel,"saveBrandingBtn",array("value"=>'Save Branding Changes'));?>
                    <?php 
						 echo CHtml::ajaxSubmitButton('Save (Ctrl+S)',
						 Yii::app()->createUrl('/appsettings/settings/saveLaunchSetting/type/'.$applicationType),
						 array('type' => 'POST',
						 'dataType' => 'json',
						 'success' => 'js:function(data) {
								if(data.success==true)
								{
									$("[id^=\'SettingsFrontendForm_\']").parents("div").removeClass("error");
									noticeAjax("Branding Setting Saved Successfully...!","success");
								}
								else
								{
									//noticeAjax("Launch Setting Could Not Be Saved...!","failure");
									$("[id^=\'SettingsFrontendForm_\']").parents("div").removeClass("error");
									$.each(data, function(key, val) {
									$("#setting_form_branding #"+key).parent("div").addClass("error");
									});
								}
							 }'),array('name'=>'brandingbtnsave_ajax','class'=>'specialAction RIGHT'));
					?>
                   </div>
              </div>
				</div>
			</div>
            
			<?php $this->endWidget(); ?>
			<div class="halfmargin"></div>
            