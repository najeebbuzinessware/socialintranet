<div id="outer_container" class="custom_background">

<?php $this->renderpartial('application.views.user._userTopmenu'); ?>
<div class="container_12">	
	
	<?php $form=$this->beginWidget('CActiveForm', array('id'=>'profile-form','enableClientValidation'=>true,'enableAjaxValidation'=>false,'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),'htmlOptions' => array('enctype' => 'multipart/form-data'))); ?>
    <div class="grid_12 box shadowed_little">
			<div class="padding profile">
				<h2 class="headline1 noMargUp"><?php echo Yii::t('translate','Your Current Profile');?></h2>
				<div class="s-lined"></div>
				<p class="normaltxt1"><?php echo Yii::t('translate','This is how you currently appear to others in the system.');?></p>
				<div class="halfmargin"></div>
				<div class="grid_1 alpha profilePic large">
            <?php 
            //echo BWCFunctions::getAvatar('Big',$model->Avatar);
            	if (empty( $model->Avatar ))
												{
													$img = "http://assets.bw.ae/bw/images/apps/avatar.png";
												} else
												{
													
													$path = Yii::app()->params['filepath'] . Yii::app()->user->MId . "/users/" . $model->Avatar;
													$img = BWCFunctions::getAvatar('Big',$model->Avatar);
													
												}  
												?>
            <a href="#"><img id="prfImage" alt="" border="0" src="<?php echo $img; ?>" /></a>
				</div>
				<div class="grid_9 omega RIGHT">
					<p class="headline2 noMargUp">
						<a href="#" class="BLACK"><b><?=$model['Name']?></b></a><span class="spacer"></span><span class="star empty"></span>
					</p>
				</div>
				<div class="grid_5 omega RIGHT">
					<p class="normaltxt1 BLACK noMargUp">Skills</p>
                <?php
																$skillArr = explode( ',', $model['Skills'] );
																foreach ( $skillArr as $key => $val )
																{
																	?>
                <span class="tag"><?=$val?></span>
                <?php }?>                
            </div>
				<div class="grid_4 alpha RIGHT">
            	<?php $department = TblDepartments::model()->findByPk($model['Department']);?>
                <div class="grid_6 alpha BLACK normaltxt1">Position</div>
					<div class="grid_6 normaltxt1"><?=$model['JobTitle']?></div>
					<div class="micromargin"></div>
					<div class="grid_6 alpha BLACK normaltxt1">Department</div>
					<div class="grid_6 normaltxt1"><?=$department['Department']?></div>
					<div class="micromargin"></div>
					<div class="grid_6 alpha BLACK normaltxt1">Email</div>
					<div class="grid_6 normaltxt1"><?=$model['Email']?></div>
					<div class="micromargin"></div>
					<div class="grid_6 alpha BLACK normaltxt1">Phone</div>
					<div class="grid_6 normaltxt1"><?=$model['PhoneNo']?></div>
				</div>
				<div class="grid_9 omega RIGHT">
					<div class="halfmargin"></div>
					<!-- <?php echo $form->fileField($model, 'Avatar', array("class"=>"full")); ?> 
					<?php echo $form->error($model, 'Avatar'); ?> 
					<?php echo CHtml::hiddenField('Avatarimage',$model->Avatar);?> -->
					<div class="uploadFile">
						<p class="headline2 BLUE middle"><?php echo Yii::t('translate','Upload a New Photo to Replace:');?></p>
						<p class="normaltxt1 middle"><?php echo Yii::t('translate','or drag files here to upload');?></p>
                    <?php
																				$this->widget( 'common.extensions.EAjaxUpload.EAjaxUpload', 
																						array( 
																							'id' => 'images', 
																							'config' => array( 
																											'action' => '/user/uploadImage', 
																											'allowedExtensions' => array( "jpg", "jpeg", "gif", "png" ), 
																											//'sizeLimit' => Yii::app()->params['maxfilesize'], 
																											'sizeLimit' => 10*1024*1024,// maximum file size in bytes
																											'onComplete' => "js:function(id, fileName, responseJSON)
																{	var file = responseJSON.filename;
																	$('#prfImage').attr('src','/userData/" . Yii::app()->user->MId . "/users/'+file);
																	$('#TblSysUsers_Avatar').val(file);
																	$('#images .qq-upload-drop-area').css('display','none');
																}" ) ) );
																				echo $form->hiddenField( $model, 'Avatar' );
																				?>
                    
                    
                </div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="padding">
				<div class="lined">
					<div class="grid_12 alpha">
						<h2 class="headline1 noMargUp noMargDown LEFT"><?php echo Yii::t('translate','Update Profile');?></h2>
						<p class="normaltxt1 noMargDown noMargUp"><?php echo Yii::t('translate','Manage your global profile and others see you.'); ?></p>
					</div>
					<div class="clear"></div>
				</div>
				<div class="halfmargin"></div>
				<div class="grid_4">
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Time Zone')?>  </p>
                    <?php  echo $form->dropDownList($model,'TimeZone',BWDataFunction::timeZoneData(),array("class"=>"headline2 full")); ?>
                    <?php echo $form->error($model,'TimeZone'); ?>
                
                </label>
					<div class="clear"></div>
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Language')?> </p>
                    <?php  echo $form->dropDownList($model,'Language',BWDataFunction::languageData(),array("class"=>"headline2 full")); ?>
                    <?php echo $form->error($model,'Language'); ?>
                </label>
					<div class="clear"></div>
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Bio')?> </p>
                    <?php  echo $form->textField($model,'Bio',array("class"=>"headline2 full")); ?>
                </label>
					<div class="clear"></div>
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Skills')?> <span class="SMALL RIGHT"><?php echo Yii::t('translate','seperate by a comma');?></span>
						</p>
                    <?php  echo $form->textField($model,'Skills',array("class"=>"headline2 full")); ?>
                </label>
				</div>
				<div class="grid_4">
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Name')?> </p>
                    <?php  echo $form->textField($model,'Name',array("value"=>"$model->Name","class"=>"headline2 full")); ?>
                    <?php echo $form->error($model,'Name'); ?>
                </label>
					<div class="clear"></div>
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Nickname')?> </p>
                    <?php  echo $form->textField($model,'Nick',array("value"=>"$model->Nick","class"=>"headline2 full")); ?>
                    <?php echo $form->error($model,'Nick'); ?>
                </label>
					<div class="clear"></div>
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Department')?></p>
                    <?php echo $form->dropDownList($model,'Department',CHtml::listData(TblDepartments::model()->findAll(array('order' => 'Department')),'DeptId','Department'),array("class"=>"headline2 full"));?>
                    <?php echo $form->error($model,'Nick'); ?>
                </label>
					<div class="clear"></div>
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Position')?></p>
                    <?php  echo $form->textField($model,'JobTitle',array("class"=>"headline2 full")); ?>
                    <?php echo $form->error($model,'JobTitle'); ?>
                </label>
					<div class="clear"></div>
				</div>
				<div class="grid_4">
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Email')?> </p>
                    <?php  echo $form->textField($model,'Email',array("value"=>"$model->Email","class"=>"headline2 full")); ?>
                    <?php echo $form->error($model,'Email'); ?>
                </label>
					<div class="clear"></div>
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Password')?>  </p>
                    <?php  echo $form->passwordField($model,'Password',array("value"=>"$model->Password","class"=>"headline2 full")); ?>
                    <?php echo $form->error($model,'Password'); ?>
                </label>
					<div class="clear"></div>
					<label>
						<p class="headline2">Phone</p>
					<?php  echo $form->textField($model,'PhoneNo',array("class"=>"headline2 full")); ?>
					<?php echo $form->error($model,'PhoneNo'); ?>
                </label>
					<div class="clear"></div>
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Zoom Level')?> </p>
                    <?php  echo $form->dropDownList($model,'Zoom',BWDataFunction::zoomLevelData(),array("class"=>"headline2 full")); ?>
                    <?php echo $form->error($model,'Zoom'); ?>
                </label>
					<div class="clear"></div>
					<label>
						<p class="headline2"><?php echo Yii::t('translate','Preferences')?> </p>
                    <?php
						$modulesser = BWCFunctions::getMIdModules( Yii::app()->user->MId, "1" );
						$prompt = array( "class" => "headline2 full" );
						if (count( $modulesser ) > 1 && strlen( $model->Preferences ) < 1)
						{
							$prompt = array( "class" => "headline2 full", 'prompt' => 'Landing Page Preference' );
						}
						echo $form->dropDownList( $model, 'Preferences', $modulesser, $prompt );
						?>
                    <?php echo $form->error($model,'Preferences'); ?>
                </label>
				</div>
				<div class="halfmargin"></div>
				<div class="grid_12">
            	<?php echo CHtml::submitButton(Yii::t('translate','Save (Ctrl+S)'),array("submit"=>Yii::app()->params['appurl']."user/profile","class"=>"specialAction RIGHT"));?>
            </div>
				<div class="halfmargin"></div>
            <?php $this->endWidget(); ?>
    	</div>
		</div>
	</div>