<?php
class SettingsController extends MemberController
{
	public $module = "";
	public $uriParam = array();
	public $mainUrl = "";
//	public $layout = 'common.views.layouts.column2';
	//public $layoutPath = Yii::getPathOfAlias('common.views.layouts');
	//public $layout = 'column2';	
	
	public function init()
	{
		$this->uriParam = explode('/',$_SERVER['REQUEST_URI']);
		$this->module = $this->uriParam[1];
		$this->mainUrl = BWCFunctions::getUrlProtocol().$_SERVER['HTTP_HOST'].'/'.$this->module;
	}
	
	public function actionIndex()
	{
		$applicationType = $_GET['type'];
		
		$criteria = new CDbCriteria;
		$criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND Application = '".$applicationType."'";
		
		$settingDataModel = TblSysFrontendSettings::model()->findAll($criteria);
		$settingDataModel = CHtml::listData($settingDataModel,'Key','Value');
		$criteria = new CDbCriteria;
		$criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND CType = '".$applicationType."'";
		$workflowmodel = TblSysWorkflow::model()->find($criteria);
		
		$settingmodel = new SettingsFrontendForm();
		$settinglaunchmodel = new SettingsFrontendFormLaunch();
		
		if(count($workflowmodel)==0)
			$workflowmodel = new TblSysWorkflow();
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='setting')
		{
			echo CActiveForm::validate(array($settingmodel,$workflowmodel));
			Yii::app()->end();
		}
		
		Yii::app()->session['limit'] = '';
		if(Yii::app()->request->isPostRequest)
		{
			if(isset($_POST['SettingsFrontendForm']))
			{
				$criteria = new CDbCriteria();
				$criteria->condition = 'MId = '.Yii::app()->user->MId.' AND Application = "'.$applicationType.'"';;
				$del = TblSysFrontendSettings::model()->deleteAll($criteria);
				
				if(strlen($_POST['hdnfilename'][0])>0)
				{$_POST['SettingsFrontendForm']['config_logo'] = $_POST['hdnfilename'][0];}
				
				foreach($_POST['SettingsFrontendForm'] as $key=>$val)
				{
					$settingmodel = new TblSysFrontendSettings();
					$settingmodel->MId = Yii::app()->user->MId;
					$settingmodel->Group = 'Config';
					$settingmodel->Key = $key;
					$settingmodel->Value = $val;
					$settingmodel->Application = $applicationType;
					$settingmodel->CType = $applicationType;
					$settingmodel->CreatedBy = Yii::app()->user->Id;
					$settingmodel->CreatedOn = date('Y-m-d');
					$settingmodel->IsActive = 'Yes';
					$settingmodel->IsDelete = 'No';
					$settingmodel->save();
				}
				
				if(strlen($_POST['hdntopbanners'])>0)
				{
					if($_POST['SettingsFrontendForm']['config_layout'] == 'top' || $_POST['SettingsFrontendForm']['config_layout'] == 'all' )
					{
						$criteria = new CDbCriteria();
						$criteria->condition = 'MId = '.Yii::app()->user->MId.' AND CType = "'.$applicationType.'"';
						$del = TblSysFrontendBanners::model()->deleteAll($criteria);
						
						$filetype = BWDataFunction::mime_content_type($_POST['hdntopbanners']);
						$filesize = filesize(getenv("DOCUMENT_ROOT")."/userData/".Yii::app()->user->MId."/assets/".$_POST['hdntopbanners']);
						
						$modelFBanner =new TblSysFrontendBanners;
						$modelFBanner->FileName=$_POST['hdntopbanners'];
						$modelFBanner->FileType=$filetype;
						$modelFBanner->FileSize=$filesize;
						$modelFBanner->Position='top';
						$modelFBanner->CType=$applicationType;
						$modelFBanner->MID=Yii::app()->user->MId;
						$modelFBanner->save();
					}
				}
				
				if(strlen($_POST['hdnrightbanners'])>0)
				{
					if($_POST['SettingsFrontendForm']['config_layout'] == 'right' || $_POST['SettingsFrontendForm']['config_layout'] == 'all' )
					{
						$filetype = BWDataFunction::mime_content_type($_POST['hdnrightbanners']);
						$filesize = filesize(getenv("DOCUMENT_ROOT")."/userData/".Yii::app()->user->MId."/assets/".$_POST['hdnrightbanners']);
						
						$modelFBanner =new TblSysFrontendBanners;
						$modelFBanner->FileName=$_POST['hdnrightbanners'];
						$modelFBanner->FileType=$filetype;
						$modelFBanner->FileSize=$filesize;
						$modelFBanner->Position='right';
						$modelFBanner->CType=$applicationType;
						$modelFBanner->MID=Yii::app()->user->MId;
						$modelFBanner->save();
					}
				}
				
				$this->actionAppsettings($_POST,$applicationType);
				
				Yii::app()->session['notice'] = Yii::t('translate','Settings Updated Successfully.');
				Yii::app()->session['ntype'] = 'success';
				$this->redirect("/appsettings/settings/index/type/".$applicationType);
			}
		}
		
		$criteria = new CDbCriteria;
		$criteria->select = " LEFT(MenuTitle, 1 ) AS Name";
		$criteria->condition = "MId = '".Yii::app()->user->MId."' AND CType = '".$applicationType."'";
		$criteria->order = "Name ASC";
		$criteria->group = "Name";

		$total = TblMenuManager::model()->count($criteria);
		$pages = new CPagination($total);
		$pages->pageSize = 5;
		$pages->applyLimit($criteria);
		$contentmodel = TblMenuManager::model()->findAll($criteria);
		
		$this->render('settings',array("contentmodel"=>$contentmodel,"settingmodel"=>$settingmodel,"settinglaunchmodel"=>$settinglaunchmodel,"settingDataModel"=>$settingDataModel,"workflowmodel"=>$workflowmodel,'masterDetails'=>$masterDetails));
	}

		
	public function actionSaveLaunchSetting()
	{
		$applicationType = $_GET['type'];
		$settingmodel = new SettingsFrontendForm();

		if(Yii::app()->request->isPostRequest)
		{
			$settingmodel->attributes=$_POST['SettingsFrontendForm'];
			$valid=$settingmodel->validate();
			
			if($valid)
			{
				foreach($_POST['SettingsFrontendForm'] as $key=>$val)
				{
					$criteria = new CDbCriteria();
					$criteria->condition = 'MId = '.Yii::app()->user->MId.' AND Application = "'.$applicationType.'" AND `Key` = "'.$key.'"';
					$del = TblSysFrontendSettings::model()->deleteAll($criteria);
					
					$settingmodel = new TblSysFrontendSettings();
					$settingmodel->MId = Yii::app()->user->MId;
					$settingmodel->Group = 'Config';
					$settingmodel->Key = $key;
					$settingmodel->Value = $val;
					$settingmodel->Application = $applicationType;
					$settingmodel->CType = $applicationType;
					$settingmodel->CreatedBy = Yii::app()->user->Id;
					$settingmodel->CreatedOn = date('Y-m-d');
					$settingmodel->IsActive = 'Yes';
					$settingmodel->IsDelete = 'No';
					$settingmodel->save();
				}
				
				/* $jsonarray = array('success'=>true);
				echo json_encode($jsonarray); */
				Yii::app()->session['notice'] = Yii::t('translate','Settings Updated Successfully.');
				Yii::app()->session['ntype'] = 'success';
				$this->redirect("/appsettings/settings/index/type/".$applicationType);
				Yii::app()->end();
			}
			else{
				$error = CActiveForm::validate($settingmodel);
				if($error!='[]')
					echo $error;
				Yii::app()->end();
			}
		}
		Yii::app()->end();
	}
	
	
	
	public function actionUploadLogo()
	{
		
		if(!file_exists(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId))
		{
			mkdir(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId, 0777);
		}
		
		if(!file_exists(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId."/assets"))
			mkdir(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId."/assets", 0777);
			
		if(!file_exists(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId."/careers"))
			mkdir(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId."/careers", 0777);
		
		
		$masterDetails = TblSysUsers::model()->findByPk(Yii::app()->user->Id);
			 
		$folder=getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId.'/assets/';// folder for uploaded files
		//if(!is_dir($folder)){mkdir($folder);}
		
		Yii::import("common.extensions.EAjaxUpload.qqFileUploader");
		$allowedExtensions = array("jpg","jpeg","gif","png"); //array("jpg","jpeg","gif","exe","mov" and etc...
		$sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($folder);
		$result['limit']= Yii::app()->session['limit'];
		$result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		echo $result;// it's array
	}
	
	public function actionUploadnew()
	{
		
		if(!file_exists(getenv("DOCUMENT_ROOT")."/uploads/logo".Yii::app()->user->MId))
		{
			mkdir(getenv("DOCUMENT_ROOT")."/uploads/logo".Yii::app()->user->MId, 0777);
		}
		
		$error = "";
		$fileElementName = $_POST['file_element'];  
		
		$folder = getenv("DOCUMENT_ROOT").'/uploads/logo'.Yii::app()->user->MId.'/'; 
		
		
		if(!empty($_FILES[$fileElementName]['error']))
		{
			switch($_FILES[$fileElementName]['error'])
			{
	
				case '1':
					$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
					break;
				case '2':
					$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
					break;
				case '3':
					$error = 'The uploaded file was only partially uploaded';
					break;
				case '4':
					$error = 'No file was uploaded.';
					break;
	
				case '6':
					$error = 'Missing a temporary folder';
					break;
				case '7':
					$error = 'Failed to write file to disk';
					break;
				case '8':
					$error = 'File upload stopped by extension';
					break;
				case '999':
				default:
					$error = 'No error code avaiable';
			}
		}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
		{
			$error = 'No file was uploaded..';
		}else 
		{
				
				$fnam = $_FILES[$fileElementName]['name'];
				$path = $folder;
				$size = @filesize($_FILES[$fileElementName]['tmp_name']);
				
				//for security reason, we force to remove uploaded file
				//Use move_uploaded_file($_FILES[$fileElementName]['tmp_name'], $destination) instead.
				move_uploaded_file($_FILES[$fileElementName]['tmp_name'], $folder.$fnam);
				@unlink($_FILES[$fileElementName]['tmp_name']);
							
		}
		
		$res = new stdClass();
					
		$res->error = $error;
		$res->filename = $fnam;
		$res->path = $path;
		$res->size = sprintf("%.2fMB", $size/1048576);
		$res->dt = date('Y-m-d H:i:s');
		echo json_encode($res);
	}
	
	public function actionUploadBackgroundImage()
	{
		$error = "";
		$fileElementName = $_POST['file_element'];   
		
		if(!file_exists(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId))
		{
			mkdir(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId, 0777);
		}
		
		if(!file_exists(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId."/assets"))
			mkdir(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId."/assets", 0777);
			
		if(!file_exists(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId."/careers"))
			mkdir(getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId."/careers", 0777);
		
		$folder=getenv("DOCUMENT_ROOT")."/uploads/".Yii::app()->user->MId."/assets/"; 
		
		
		if(!empty($_FILES[$fileElementName]['error']))
		{
			switch($_FILES[$fileElementName]['error'])
			{
	
				case '1':
					$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
					break;
				case '2':
					$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
					break;
				case '3':
					$error = 'The uploaded file was only partially uploaded';
					break;
				case '4':
					$error = 'No file was uploaded.';
					break;
	
				case '6':
					$error = 'Missing a temporary folder';
					break;
				case '7':
					$error = 'Failed to write file to disk';
					break;
				case '8':
					$error = 'File upload stopped by extension';
					break;
				case '999':
				default:
					$error = 'No error code avaiable';
			}
		}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
		{
			$error = 'No file was uploaded..';
		}else 
		{
				
				$fnam = $_FILES[$fileElementName]['name'];
				$path = $folder;
				$size = @filesize($_FILES[$fileElementName]['tmp_name']);
				
				//for security reason, we force to remove uploaded file
				//Use move_uploaded_file($_FILES[$fileElementName]['tmp_name'], $destination) instead.
				move_uploaded_file($_FILES[$fileElementName]['tmp_name'], $folder.$fnam);
				@unlink($_FILES[$fileElementName]['tmp_name']);
							
		}
		
		$res = new stdClass();
					
		$res->error = $error;
		$res->filename = $fnam;
		$res->path = $path;
		$res->size = sprintf("%.2fMB", $size/1048576);
		$res->dt = date('Y-m-d H:i:s');
		echo json_encode($res);
	}
	
	public function actionDelete()
	{
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
		}
		if(isset($_GET['fieldName']))
		{
			$fieldName = $_GET['fieldName'];
		}
		if(isset($_GET['tableName']))
		{
			$tableName = $_GET['tableName'];
		}
		
		if($id!='' && $fieldName!='' && $tableName!='')
		{
			$criteria = new CDbCriteria;
			$criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND ".$fieldName."=".$id;					
			$deletemodel = $tableName::model()->deleteAll($criteria);
			echo "Done";
		}
		
	}
	
	public function actionDeleteBanner($id)
	{
		$deletemodel = TblSysFrontendBanners::model()->deleteByPk($id);
		echo "Done";
	}
	
}
?>
