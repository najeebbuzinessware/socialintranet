<script type="text/javascript">
	$(document).ready(function(){
			
			$('.d-img').hover(function(){
				$(this).parent().find('.img-logo').css('display','block'); 
				
			}, function(){
				$(this).parent().find('.img-logo').css('display','none'); 
			});
	});

</script>

<script type="text/javascript">

	$(document).ready(function(){

		

		$('table.add-item .enableIcon').click(function(){

			var inputcity = $(this).closest('table.add-item').find('input[type="text"]');

			//var inputcountry = $(this).closest('table.add-item selectBox').find('input[type="text"]');
			var inputcountry = $('#coutnry option:selected');

			if (!inputcity.val()) {

				alert('Input feilds can not be empty');

			}

			else {

				var city = inputcity.val();

				var btnid = $(this).attr('btnid');

				

				//var country = inputcountry.val();
				var country = inputcountry.text();

				if($(this).closest('.add-item').hasClass('location')){

					var appenditem = '<tr class="actionRow"><td class="title"><div class="grid_6"><input type="text" class="full" name="Input[cityName][]" value="'+ city +'"/></div><div class="grid_6"><input type="text" name="Input[country][]" class="full" value="'+ country +'"/></div><div class="grid_3"><input type="text" name="Input[cityName][SortOrder][]" class="full" /></div></td><td class="controls"><a href="#" title="Update" class="icon enableIcon"></a><a href="#" title="Delete" class="icon deleteIcon"></a></td></tr>';

				}

				else {

					var appenditem = '<tr class="actionRow"><td class="title"><div class="grid_8"><input type="text" class="full" name="Input['+ btnid +'][]"  value="'+ city +'"/></div><div class="grid_3"><input type="text" name="Input['+ btnid +'][SortOrder][]" class="full" /></div></td><td class="controls"><a href="#" title="Add" class="icon enableIcon"></a><a href="#" title="Edit" class="icon editIcon"></a></td></tr>';

				}

				

				

				$(this).closest('ul.tab-parent').find('table.list-item').prepend(appenditem);
//$('#setting').prepend(appenditem);
				inputcity.val("");

				$('.list-wrap').css('height', 'auto');

			}	

		});	

	});

</script>

<div class="o-tabs">
     <ul class="nav">
          <li><a href="#location" class="current">
               <?= Yii::t('translate','Location') ?>
               </a></li>
          <li><a href="#roles">
               <?= Yii::t('translate','Roles') ?>
               </a></li>
          <li><a href="#employement-types"><!--Employement-->
               <?= Yii::t('translate','Job Types') ?>
               </a></li>
          <li><a href="#salary-range">
               <?= Yii::t('translate','Salary Ranges') ?>
               </a></li>
          <li><a href="#career-level">
               <?= Yii::t('translate','Career Level') ?>
               </a></li>
          <li><a href="#year-exp">
               <?= Yii::t('translate','Years of Exp.') ?>
               </a></li>
          <li><a href="#education">
               <?= Yii::t('translate','Education') ?>
               </a></li>
          
          <!--<li><a href="#nationality"><?= Yii::t('translate','Nationality') ?></a></li>-->
          
          <li><a href="#sector">
               <?= Yii::t('translate','Sector') ?>
               </a></li>
          <li><a href="#company">
               <?= Yii::t('translate','Company') ?>
               </a></li>
     </ul>
     <div class="list-wrap">
          <div class="micromargin"></div>
          <ul id="location" class="tab-parent">
               
               <!-- Add Item -->
               
               <table class="default add-item location" cellpadding="10" cellspacing="0" border="0">
                    <tr class="highlight">
                         <td class="title"><div class="grid_6"> <?php echo CHtml::textField('cityName','',array('placeholder'=>'Enter City Name','class'=>'full'));?> </div>
                              <div class="grid_6">
                                   <?php $countryList = CHtml::listData(TblCountries::model()->findAll(array('order'=>'Country')),'Id','Country');?>
                                   <?php echo CHtml::dropDownList('coutnry','', $countryList, array('empty'=>'Select Country','class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void()" title="Add" btnid="location" class="icon enableIcon"></a></td>
                    </tr>
               </table>
               <div class="margin"></div>
               
               <!-- listing -->
               
               <table class="default list-item" cellpadding="10" cellspacing="0" border="0" >
                    <tr>
                         <td class="title">
                                   <div class="grid_3"><?= Yii::t('translate','City') ?></div>
                            
                                   <div class="grid_6"><?= Yii::t('translate','Country') ?></div>
                         
                                   <div class="grid_1 LEFT"><?= Yii::t('translate','Order') ?></div>
                         </td>
                         <td class="RIGHT"><?= Yii::t('translate','Actions') ?></td>
                    </tr>
                    <?php

					$criteria = new CDbCriteria;
	
					$criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND CType = '".$_GET['type']."'";
	
					$criteria->order = 'SortOrder ASC';	
	
					$locmodel = TblSysLocation::model()->findAll($criteria);
	
				?>
                    <?php foreach($locmodel as $key=>$value){?>
                    <tr class="actionRow" id="loc<?=$value['LocId']?>">
                         <td class="title">
						<div class="grid_3"> <?php echo CHtml::textField("Edit[cityName][".$value['LocId']."]",$value['CityName'],array('class'=>'full'));?> </div>
						
                              <div class="grid_6">
                                   <?php $countryList = CHtml::listData(TblCountries::model()->findAll(array('order'=>'Country')),'Id','Country');?>
                                   <?php echo CHtml::dropDownList('Edit[country]['.$value['LocId'].']',$value['Country'], $countryList, array('empty'=>'Select Country','class'=>'full'));?>
						</div>
						<div class="grid_1 LEFT"> <?php echo CHtml::textField('Edit[citySortOrder]['.$value['LocId'].']',$value['SortOrder'],array('class'=>'full'));?> </div>
					</td>
					
                         <td class="controls"><a href="javascript:void(0)" title="Update" class="icon enableIcon" data-locID="<?=$value['LocId']?>"></a> <a href="javascript:void(0)" title="Delete" class="icon deleteIcon locdel" data-locdelID="<?=$value['LocId']?>"></a></td>
                    </tr>
                    <?php }?>
               </table>
          </ul>
          <ul id="roles" class="hide tab-parent">
               
               <!-- Add Item -->
               
               <table class="default add-item" cellpadding="10" cellspacing="0" border="0">
                    <tr class="highlight">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField('role','',array('placeholder'=>'Enter Job Role','class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void()" title="Add" btnid="role" class="icon enableIcon"></a></td>
                    </tr>
               </table>
               <div class="margin"></div>
               
               <!-- listing -->
               
               <table class="default list-item" cellpadding="10" cellspacing="0" border="0" >
                    <tr>
                         <td class="title"><div class="grid_8">
                                   <?= Yii::t('translate','Role') ?>
                              </div>
                              <div class="grid_3">
                                   <?= Yii::t('translate','Order') ?>
                              </div></td>
                         <td class="RIGHT"><?= Yii::t('translate','Actions') ?></td>
                    </tr>
                    <?php

                    $criteria = new CDbCriteria;

                    $criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND CType = '".$_GET['type']."'";

						$criteria->order = 'SortOrder ASC';	

                    $rolemodel = TblSysRole::model()->findAll($criteria);

                ?>
                    <?php foreach($rolemodel as $key=>$value){?>
                    <tr class="actionRow" id="role<?=$value['RoleId']?>">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField("Edit[role][".$value['RoleId']."]",$value['JobRole']);?> </div>
                              <div class="grid_3"> <?php echo CHtml::textField('Edit[roleSortOrder]['.$value['RoleId'].']',$value['SortOrder'],array('class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void(0)" title="Delete" class="icon deleteIcon roledel" data-roledelID="<?=$value['RoleId']?>"></a> <a href="#" title="Update" class="icon enableIcon roleedit" data-roleID="Edit_role_<?=$value['RoleId']?>"></a></td>
                    </tr>
                    <?php }?>
               </table>
          </ul>
          <ul id="employement-types" class="hide tab-parent">
               
               <!-- Add Item -->
               
               <table class="default add-item" cellpadding="10" cellspacing="0" border="0">
                    <tr class="highlight">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField('jobType','',array('placeholder'=>'Enter Employement Type','class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void()" title="Add" btnid="jobType" class="icon enableIcon"></a></td>
                    </tr>
               </table>
               <div class="margin"></div>
               <?php

                    $criteria = new CDbCriteria;

                    $criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND CType = '".$_GET['type']."'";

						$criteria->order = 'SortOrder ASC';	

                    $jobTypemodel = TblSysJobType::model()->findAll($criteria);

                ?>
               
               <!-- listing -->
               
               <table class="default list-item" cellpadding="10" cellspacing="0" border="0" >
                    <tr>
                         <td class="title"><div class="grid_8">
                                   <?= Yii::t('translate','Type') ?>
                              </div>
                              <div class="grid_3">
                                   <?= Yii::t('translate','Order') ?>
                              </div></td>
                         <td class="RIGHT"><?= Yii::t('translate','Actions') ?></td>
                    </tr>
                    <?php foreach($jobTypemodel as $key=>$value){?>
                    <tr class="actionRow" id="type<?=$value['TypeId']?>">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField("Edit[jobType][".$value['TypeId']."]",$value['JobType']);?> </div>
                              <div class="grid_3"> <?php echo CHtml::textField('Edit[jobTypeSortOrder]['.$value['TypeId'].']',$value['SortOrder'],array('class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void(0)" title="Delete" class="icon deleteIcon typedel" data-typedelID="<?=$value['TypeId']?>"></a> <a href="#" title="Update" class="icon enableIcon typeedit" data-jobTypeID="Edit_jobType_<?=$value['TypeId']?>"></a></td>
                    </tr>
                    <?php }?>
               </table>
          </ul>
          <ul id="salary-range" class="hide tab-parent">
               
               <!-- Add Item -->
               
               <table class="default add-item" cellpadding="10" cellspacing="0" border="0">
                    <tr class="highlight">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField('salaryRange','',array('placeholder'=>'Enter Salary Range','class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void()" title="Add" btnid="salaryRange" class="icon enableIcon"></a></td>
                    </tr>
               </table>
               <div class="margin"></div>
               <?php

                    $criteria = new CDbCriteria;

                    $criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND CType = '".$_GET['type']."'";

						$criteria->order = 'SortOrder ASC';	

                    $jobsalaryRangemodel = TblSysSalaryRange::model()->findAll($criteria);

                ?>
               
               <!-- listing -->
               
               <table class="default list-item" cellpadding="10" cellspacing="0" border="0" >
                    <tr>
                         <td class="title"><div class="grid_8">
                                   <?= Yii::t('translate','Salary Range') ?>
                              </div>
                              <div class="grid_3">
                                   <?= Yii::t('translate','Order') ?>
                              </div></td>
                         <td class="RIGHT"><?= Yii::t('translate','Actions') ?></td>
                    </tr>
                    <?php foreach($jobsalaryRangemodel as $key=>$value){?>
                    <tr class="actionRow" id="sal<?=$value['SalaryId']?>">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField("Edit[salaryRange][".$value['SalaryId']."]",$value['SalaryRange']);?> </div>
                              <div class="grid_3"> <?php echo CHtml::textField('Edit[salaryRangeSortOrder]['.$value['SalaryId'].']',$value['SortOrder'],array('class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void(0)" title="Delete" class="icon deleteIcon salarydel" data-salarydelID="<?=$value['SalaryId']?>"></a> <a href="javascript:void(0)" title="Update" class="icon enableIcon salaryedit" data-salaryID="Edit_salaryRange_<?=$value['SalaryId']?>"></a></td>
                    </tr>
                    <?php }?>
               </table>
          </ul>
          <ul id="career-level" class="hide tab-parent">
               
               <!-- Add Item -->
               
               <table class="default add-item" cellpadding="10" cellspacing="0" border="0">
                    <tr class="highlight">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField('careerLevel','',array('placeholder'=>'Enter Career Level','class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void()" title="Add" btnid="careerLevel" class="icon enableIcon"></a></td>
                    </tr>
               </table>
               <div class="margin"></div>
               <?php

                    $criteria = new CDbCriteria;

                    $criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND CType = '".$_GET['type']."'";

						$criteria->order = 'SortOrder ASC';	

                    $jobcareerLevelmodel = TblSysCareerLevel::model()->findAll($criteria);

                ?>
               
               <!-- listing -->
               
               <table class="default list-item" cellpadding="10" cellspacing="0" border="0" >
                    <tr>
                         <td class="title"><div class="grid_8">
                                   <?= Yii::t('translate','Level') ?>
                              </div>
                              <div class="grid_3">
                                   <?= Yii::t('translate','Order') ?>
                              </div></td>
                         <td class="RIGHT"><?= Yii::t('translate','Actions') ?></td>
                    </tr>
                    <?php foreach($jobcareerLevelmodel as $key=>$value){?>
                    <tr class="actionRow" id="level<?=$value['LevelId']?>">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField("Edit[careerLevel][".$value['LevelId']."]",$value['CareerLevel']);?> </div>
                              <div class="grid_3"> <?php echo CHtml::textField('Edit[careerLevelSortOrder]['.$value['LevelId'].']',$value['SortOrder'],array('class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void(0)" title="Delete" class="icon deleteIcon careerdel" data-careerdelID="<?=$value['LevelId']?>"></a> <a href="javascript:void(0)" title="Update" class="icon enableIcon careeredit" data-careerID="Edit_careerLevel_<?=$value['LevelId']?>"></a></td>
                    </tr>
                    <?php }?>
               </table>
          </ul>
          <ul id="year-exp" class="hide tab-parent">
               
               <!-- Add Item -->
               
               <table class="default add-item" cellpadding="10" cellspacing="0" border="0">
                    <tr class="highlight">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField('Iexperiance','',array('placeholder'=>'Enter Minimum Experiance','class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void()" title="Add" btnid="experiance" class="icon enableIcon"></a></td>
                    </tr>
               </table>
               <div class="margin"></div>
               <?php

                    $criteria = new CDbCriteria;

                    $criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND CType = '".$_GET['type']."'";

						$criteria->order = 'SortOrder ASC';	

                    $maxExperiancemodel = TblSysExperiance::model()->findAll($criteria);

                ?>
               
               <!-- listing -->
               
               <table class="default list-item" cellpadding="10" cellspacing="0" border="0" >
                    <tr>
                         <td class="title"><div class="grid_8">
                                   <?= Yii::t('translate','Experience') ?>
                              </div>
                              <div class="grid_3">
                                   <?= Yii::t('translate','Order') ?>
                              </div></td>
                         <td class="RIGHT"><?= Yii::t('translate','Actions') ?></td>
                    </tr>
                    <?php  foreach($maxExperiancemodel as $key=>$value){?>
                    <tr class="actionRow" id="exp<?=$value['MaxExperianceId']?>">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField("Edit[experiance][".$value['MaxExperianceId']."]",$value['Experiance']);?> </div>
                              <div class="grid_3"> <?php echo CHtml::textField('Edit[experianceSortOrder]['.$value['MaxExperianceId'].']',$value['SortOrder'],array('class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void(0)" title="Delete" class="icon deleteIcon expdel" data-expdelID="<?=$value['MaxExperianceId']?>"></a> <a href="javascript:void(0)" title="Update" class="icon enableIcon expedit" data-expID="Edit_experiance_<?=$value['MaxExperianceId']?>"></a></td>
                    </tr>
                    <?php }?>
               </table>
          </ul>
          <ul id="education" class="hide tab-parent">
               
               <!-- Add Item -->
               
               <table class="default add-item" cellpadding="10" cellspacing="0" border="0">
                    <tr class="highlight">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField('qualification','',array('placeholder'=>'Enter Qualification','class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void()" title="Add"  btnid="qualification"  class="icon enableIcon"></a></td>
                    </tr>
               </table>
               <div class="margin"></div>
               <?php

										$criteria = new CDbCriteria;

										$criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND CType = '".$_GET['type']."'";

											$criteria->order = 'SortOrder ASC';	

										$qualificationmodel = TblSysEduQualification::model()->findAll($criteria);

									?>
               
               <!-- listing -->
               
               <table class="default list-item" cellpadding="10" cellspacing="0" border="0" >
                    <tr>
                         <td class="title"><div class="grid_8">
                                   <?= Yii::t('translate','Qualification') ?>
                              </div>
                              <div class="grid_3">
                                   <?= Yii::t('translate','Order') ?>
                              </div></td>
                         <td class="RIGHT"><?= Yii::t('translate','Actions') ?></td>
                    </tr>
                    <?php foreach($qualificationmodel as $key=>$value){?>
                    <tr class="actionRow" id="edu<?=$value['EducationId']?>">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField("Edit[qualification][".$value['EducationId']."]",$value['Qualification']);?> </div>
                              <div class="grid_3"> <?php echo CHtml::textField('Edit[qualificationSortOrder]['.$value['EducationId'].']',$value['SortOrder'],array('class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void(0)" title="Delete" class="icon deleteIcon edudel" data-edudelID="<?=$value['EducationId']?>"></a> <a href="javascript:void(0)" title="Update" class="icon enableIcon eduedit" data-eduID="Edit_qualification_<?=$value['EducationId']?>"></a></td>
                    </tr>
                    <?php }?>
               </table>
          </ul>
          <ul id="sector" class="hide tab-parent">
               
               <!-- Add Item -->
               
               <table class="default add-item" cellpadding="10" cellspacing="0" border="0">
                    <tr class="highlight">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField('sector','',array('placeholder'=>'Enter Sector Name','class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void()" title="Add" btnid="sector" class="icon enableIcon"></a></td>
                    </tr>
               </table>
               <div class="margin"></div>
               <?php

                    $criteria = new CDbCriteria;

                    $criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND CType = '".$_GET['type']."'";

						$criteria->order = 'SortOrder ASC';	

                    $sectormodel = TblSysSector::model()->findAll($criteria);

                ?>
               
               <!-- listing -->
               
               <table class="default list-item" cellpadding="10" cellspacing="0" border="0" >
                    <tr>
                         <td class="title"><div class="grid_8">
                                   <?= Yii::t('translate','Sector') ?>
                              </div>
                              <div class="grid_3">
                                   <?= Yii::t('translate','Order') ?>
                              </div></td>
                         <td class="RIGHT"><?= Yii::t('translate','Actions') ?></td>
                    </tr>
                    <?php foreach($sectormodel as $key=>$value){?>
                    <tr class="actionRow" id="sector<?=$value['SectorId']?>">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField("Edit[sector][".$value['SectorId']."]",$value['Sector']);?> </div>
                              <div class="grid_3"> <?php echo CHtml::textField('Edit[sectorSortOrder]['.$value['SectorId'].']',$value['SortOrder'],array('class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void(0)" title="Delete" class="icon deleteIcon sectordel" data-sectordelID="<?=$value['SectorId']?>"></a> <a href="javascript:void(0)" title="Update" class="icon enableIcon sectoredit" data-sectorID="Edit_sector_<?=$value['SectorId']?>"></a></td>
                    </tr>
                    <?php }?>
               </table>
          </ul>
          <ul id="company" class="hide tab-parent">
               
               <!-- Add Item -->
               
               <table class="default add-item" cellpadding="10" cellspacing="0" border="0">
                    <tr class="highlight">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField('company','',array('placeholder'=>'Enter Company Name','class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void()" title="Add" btnid="company" class="icon enableIcon"></a></td>
                    </tr>
               </table>
               <div class="margin"></div>
               <?php

											$criteria = new CDbCriteria;

											$criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND CType = '".$_GET['type']."'";

												$criteria->order = 'SortOrder ASC';	

											$companymodel = TblSysCompany::model()->findAll($criteria);/*TblSysCompany::model()->findAll($criteria);*/

										?>
               
               <!-- listing -->
               
               <table class="default list-item" cellpadding="10" cellspacing="0" border="0" >
                    <tr>
                         <td class="title" width="200"><?= Yii::t('translate','Company') ?></td>
                         <td width="50"><?= Yii::t('translate','Order') ?></td>
                         <td>&nbsp;</td>
                         <td>Logo</td>
                         <td>Link</td>
                         <td class="RIGHT" width="100"><?= Yii::t('translate','Actions') ?></td>
                    </tr>
                    <?php foreach($companymodel as $key=>$value){?>
                    <tr id="company<?=$value['CompanyId']?>">
                         <td class="title" width="200"><?php echo CHtml::textField("Edit[company][".$value['CompanyId']."]",$value['Company'],array('class'=>'full'));?></td>
					<td width="30"><?php echo CHtml::textField('Edit[companySortOrder]['.$value['CompanyId'].']',$value['SortOrder'],array('class'=>'full'));?></td>
                         <td class="title" width="100">
						<div style="position: relative; top: 9px;">
							<?php

                                                        $this->widget('ext.EAjaxUpload.EAjaxUpload',array('id'=>'companyLogo'.$value['CompanyId'],

                                                        'config'=>array('action'=>$this->mainUrl.'/appsettings/settings/UploadLogo',

                                                        'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...

                                                        'sizeLimit'=>10*1024*1024,// maximum file size in bytes

                                                        //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes

                                                        'onComplete'=>"js:function(id, fileName, responseJSON){ $('#Edit_companyLogo_'+".$value['CompanyId'].").val(fileName);$('#images .qq-upload-drop-area').css('display','none');

                                                        }",

                        

                                                        //'messages'=>array(

                                                        //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",

                                                        //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",

                                                        //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",

                                                        //                  'emptyError'=>"{file} is empty, please select files again without it.",

                                                        //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."

                                                        //                 ),

                                                        //'showMessage'=>"js:function(message){ alert(message); }"

                                                        )

                                                        ));

														?>
							</div>	
                              </td>
                         
					<td>
						<?php if(strlen($value['Logo']) > 0) { ?>
                              <div class="company-img">
							<div class="company-img-preview">
								<img class="img-logo" src="/userData/<?=Yii::app()->user->MId?>/assets/<?=$value['Logo']?>" border="0">
								<img class="d-img" src="http://assets.bw.ae/bw/images/apps/img.png" alt="">
							</div>
							
						</div>
                              <? } ?>
                              <? echo CHtml::hiddenField("Edit[companyLogo][".$value['CompanyId']."]",$value['Logo']);?>
					</td>
					
					<td><?php echo CHtml::textField("Edit[companyLink][".$value['CompanyId']."]",$value['Link'],array('class'=>'full'));?></td>
					
					
					<td class="controls"><a href="javascript:void(0)" title="Delete" class="icon deleteIcon companydel" data-companydelID="<?=$value['CompanyId']?>"></a> <a href="javascript:void(0)" title="Update" class="icon enableIcon companyedit" data-companyID="Edit_company_<?=$value['CompanyId']?>"></a></td>
                    </tr>
                    <?php }?>
               </table>
          </ul>
     </div>
</div>
<script language="javascript" type="application/javascript">

$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-locID');

	document.getElementById('Edit_cityName_'+projid).disabled = false;

	document.getElementById('d_country_'+projid).style.display = 'block';

	document.getElementById('t_country_'+projid).style.display = 'none';

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.locedit');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-roleID');

	document.getElementById(projid).disabled = false;	

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.roleedit');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-jobTypeID');

	document.getElementById(projid).disabled = false;

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.typeedit');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-salaryID');

	document.getElementById(projid).disabled = false;

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.salaryedit');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-careerID');

	document.getElementById(projid).disabled = false;

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.careeredit');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-expID');

	document.getElementById(projid).disabled = false;

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.expedit');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-eduID');

	document.getElementById(projid).disabled = false;

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.eduedit');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-nationalityID');

	document.getElementById('Edit_countryName_'+projid).disabled = false;

	document.getElementById('Edit_nationality_'+projid).disabled = false;

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.nationalityedit');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-sectorID');

	document.getElementById(projid).disabled = false;

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.sectoredit');



$(document).on({

	click:

	function(e){

	var projid = $(this).attr('data-companyID');

	document.getElementById(projid).disabled = false;

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.companyedit');



/*Deleting Process*/



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-locdelID');

	e.stopPropagation();

	if(confirm("Do you want to Delete the location ?"))

	{

		$.ajax({

			  type:'POST',

			  url: '<?=$this->mainUrl?>/appsettings/settings/delete/id/'+projid+'/fieldName/LocId/tableName/TblSysLocation',

			  success: function(data){$('#loc'+projid).attr('style','display: none');

			  		noticeAjax("Location Deleted Successfully...!","success");

			  } 

		 });
e.stopPropagation();
	 }

   	return false;

	e.preventDefault();

	}

}, 'a.locdel');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-roledelID');	

	e.stopPropagation();

	if(confirm("Do you want to Delete the Role ?"))

	{

		$.ajax({

			  type:'POST',

			  url: '<?=$this->mainUrl?>/appsettings/settings/delete/id/'+projid+'/fieldName/RoleId/tableName/TblSysRole',

			  success: function(data){$('#role'+projid).attr('style','display: none');

			  		noticeAjax("Role Deleted Successfully...!","success");

			  } 

		 });

	}

   	return false;

	e.preventDefault();

	}

}, 'a.roledel');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-typedelID');

	e.stopPropagation();

	if(confirm("Do you want to Delete the type ?"))

	{

		$.ajax({

			  type:'POST',

			  url: '<?=$this->mainUrl?>/appsettings/settings/delete/id/'+projid+'/fieldName/TypeId/tableName/TblSysJobType',

			  success: function(data){$('#type'+projid).attr('style','display: none');

			  		noticeAjax("Type Deleted Successfully...!","success");

			  } 

		 });

	}

   	return false;

	e.preventDefault();

	}

}, 'a.typedel');



$(document).on({

	click:



	function(e) {

	var projid = $(this).attr('data-salarydelID');

	e.stopPropagation();

	if(confirm("Do you want to Delete the salary range?"))

	{

		$.ajax({

			  type:'POST',

			  url: '<?=$this->mainUrl?>/appsettings/settings/delete/id/'+projid+'/fieldName/SalaryId/tableName/TblSysSalaryRange',

			  success: function(data){$('#sal'+projid).attr('style','display: none');

			  		noticeAjax("Salary Range Deleted Successfully...!","success");

			  } 

		 });

	}

   	return false;

	e.preventDefault();

	}

}, 'a.salarydel');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-careerdelID');	

	e.stopPropagation();

	if(confirm("Do you want to Delete the career level ?"))

	{

		$.ajax({

			  type:'POST',

			  url: '<?=$this->mainUrl?>/appsettings/settings/delete/id/'+projid+'/fieldName/LevelId/tableName/TblSysCareerLevel',

			  success: function(data){$('#level'+projid).attr('style','display: none');

			  		noticeAjax("Career Level Deleted Successfully...!","success");

			  } 

		 });

	}

   	return false;

	e.preventDefault();

	}

}, 'a.careerdel');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-expdelID');	

	e.stopPropagation();

	if(confirm("Do you want to Delete the experience ?"))

	{

		$.ajax({

			  type:'POST',

			  url: '<?=$this->mainUrl?>/appsettings/settings/delete/id/'+projid+'/fieldName/MaxExperianceId/tableName/TblSysExperiance',

			  success: function(data){$('#exp'+projid).attr('style','display: none');

			  		noticeAjax("Experience Deleted Successfully...!","success");

			  } 

		 });

	}

   	return false;

	e.preventDefault();

	}

}, 'a.expdel');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-edudelID');

	e.stopPropagation();

	if(confirm("Do you want to Delete the qualification ?"))

	{

		$.ajax({

			  type:'POST',

			  url: '<?=$this->mainUrl?>/appsettings/settings/delete/id/'+projid+'/fieldName/EducationId/tableName/TblSysEduQualification',

			  success: function(data){$('#edu'+projid).attr('style','display: none');

			  		noticeAjax("Qualification Deleted Successfully...!","success");

			  } 

		 });

	}

   	return false;

	e.preventDefault();

	}

}, 'a.edudel');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-nationalitydelID');

	e.stopPropagation();

	if(confirm("Do you want to Delete the nationality ?"))

	{

		$.ajax({

			  type:'POST',

			  url: '<?=$this->mainUrl?>/appsettings/settings/delete/id/'+projid+'/fieldName/NationalityId/tableName/TblSysNationality',

			  success: function(data){$('#nat'+projid).attr('style','display: none');

			  		noticeAjax("Nationality Deleted Successfully...!","success");

			  } 

		 });

	}

   	return false;

	e.preventDefault();

	}

}, 'a.nationalitydel');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-sectordelID');

	e.stopPropagation();

	if(confirm("Do you want to Delete the sector ?"))

	{

		$.ajax({

			  type:'POST',

			  url: '<?=$this->mainUrl?>/appsettings/settings/delete/id/'+projid+'/fieldName/SectorId/tableName/TblSysSector',

			  success: function(data){$('#sector'+projid).attr('style','display: none');

			  	noticeAjax("Sector Deleted Successfully...!","success");

			  } 

		 });

	}

   	return false;

	e.preventDefault();

	}

}, 'a.sectordel');



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-companydelID');	

	e.stopPropagation();

	if(confirm("Do you want to Delete the company ?"))

	{

		$.ajax({

			  type:'POST',

			  url: '<?=$this->mainUrl?>/appsettings/settings/delete/id/'+projid+'/fieldName/CompanyId/tableName/TblSysCompany',

			  success: function(data){$('#company'+projid).attr('style','display: none');

				  noticeAjax("Company Deleted Successfully...!","success");

			  } 

		 });

	}

   	return false;

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.companydel'); 



$(document).on({

	click:

	function(e) {return false;}

}, 'a.noIcon'); 



</script>