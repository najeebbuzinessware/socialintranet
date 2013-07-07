<?php
class NotificationsController extends MemberController
{
	
	public function actionIndex()
	{ 
		$templatemodel=new TblTemplates;
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='frmtmplate')
		{
			echo CActiveForm::validate($templatemodel);
			Yii::app()->end();
		}
		
		if(strlen($_POST['btntempsave'])>0)
		{
			$this->actionAddTemplate($_POST);
		}
		
		$rulesmodel=new TblNotificationRules;
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='frmrules')
		{
			echo CActiveForm::validate($rulesmodel);
			Yii::app()->end();
		}
		
		if(strlen($_POST['btnrulesave'])>0)
		{
			$this->actionAddRules($_POST);
		}
		
		$allowedModules = BWCFunctions::getMIdModules(Yii::app()->user->MId);
		array_push($allowedModules,0);
			
		$allowedModules = join(',',$allowedModules);
		
		/*$criteria = new CDbCriteria();
		$criteria->condition = 't.PId = 0';
		$defaultTemplateData = TblTemplates::model()->findAll($criteria);
		
		$defaultTempIds = CHtml::listData($defaultTemplateData,'TempId','TempId');
		$defaultTemplates = join(',',$defaultTempIds);*/
		
		$criteria = new CDbCriteria();
		$criteria->condition = 't.MId ='.Yii::app()->user->MId.' AND PId != 0 AND IsDelete = 0';
		$usedTemplateData = TblTemplates::model()->findAll($criteria);
		$usedTempIds = CHtml::listData($usedTemplateData,'PId','PId');
		$usedTemplates = join(',',$usedTempIds);
		
		$RuledataProvider=new CActiveDataProvider('TblNotificationRules', array('criteria'=>array('condition'=>'IsDelete=0 and MId ='.Yii::app()->user->MId.' and CType="'.$_GET['type'].'"',),'pagination'=>array('pageSize'=>10,),));
		
		if(strlen($usedTemplates) > 0)
			$usedTemplatesCond = ' AND t.TempId NOT IN ('.$usedTemplates.') ';
		
		$dataProvider=new CActiveDataProvider('TblTemplates', array('criteria'=>array('condition'=>'IsDelete=0 AND ( t.MId ='.Yii::app()->user->MId.' OR t.MId =0 ) '.$usedTemplatesCond.' AND t.ModuleId IN ('.$allowedModules.') AND t.ctype="'.$_GET['type'].'"','with'=>array('moduleAccess'),),'pagination'=>array('pageSize'=>10,),));
		
		
		$this->render("index",array("templatemodel"=>$templatemodel,"rulesmodel"=>$rulesmodel,"dataProvider"=>$dataProvider,"RuledataProvider"=>$RuledataProvider,));
	}
	
	public function actionGeneral()
	{ 
		$modelGeneral=new SettingsDefaultForm;
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='frmrules')
		{
			echo CActiveForm::validate($modelGeneral);
			Yii::app()->end();
		}
		
		if(strlen($_POST['btnrulesave'])>0)
		{
			$this->actionAddGeneral($_POST);
		}
		
		/*$criteria = new CDbCriteria();
		$criteria->condition = 't.PId = 0';
		$defaultTemplateData = TblTemplates::model()->findAll($criteria);
		
		$defaultTempIds = CHtml::listData($defaultTemplateData,'TempId','TempId');
		$defaultTemplates = join(',',$defaultTempIds);*/
		
		$criteria = new CDbCriteria();
		$criteria = new CDbCriteria;
		$criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No' AND Application = 'Notification' AND CType='".$_GET['type']."' AND (`Key`='notification_mailid' OR `Key`='notification_name')";
		//$criteria->condition = 'MId ='.Yii::app()->user->MId.' AND (Key = notification_mailid || Key = notification_adminname)';
		$usedGeneralData = TblSysFrontendSettings::model()->findAll($criteria);
		$usedGeneralData = CHtml::listData($usedGeneralData,'Key','Value');
		
		$this->render("general",array("modelGeneral"=>$modelGeneral,"usedGeneralData"=>$usedGeneralData));
	}
	
	public function actionAddGeneral($post)
	{
		if(isset($_POST['SettingsDefaultForm']))
		{
			$criteria = new CDbCriteria();
			$criteria->condition = "MId = ".Yii::app()->user->MId." AND Application = 'Notification' AND CType='".$_GET['type']."' AND (`Key`='notification_mailid' OR `Key`='notification_name')";
			$del = TblSysFrontendSettings::model()->deleteAll($criteria);
			
			foreach($_POST['SettingsDefaultForm'] as $key=>$val)
			{
				$settingmodel = new TblSysFrontendSettings();
				$settingmodel->MId = Yii::app()->user->MId;
				$settingmodel->Group = 'Config';
				$settingmodel->Key = $key;
				$settingmodel->Value = $val;
				$settingmodel->Application = 'Notification';
				$settingmodel->CType = $_GET['type'];
				$settingmodel->CreatedBy = Yii::app()->user->Id;
				$settingmodel->CreatedOn = date('Y-m-d');
				$settingmodel->IsActive = 'Yes';
				$settingmodel->IsDelete = 'No';
				$settingmodel->save();
				
				$lastid = Yii::app()->db->getLastInsertID();
			}
			if($lastid>0)
			{
				Yii::app()->session['notice'] = Yii::t('translate','Data Updated');
				Yii::app()->session['ntype'] = 'success';
			}
			//$this->redirect("/members/notifications/general/type/".$_GET['type']);
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	public function actionAddTemplate($type)
	{
		 
        $model=new TblTemplates;
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='frmtmplate')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	
		if(isset($_POST['TblTemplates']))
		{
			$model->TemplateName =$_POST['TblTemplates']['TemplateName'];
			$model->TemplateSubject =$_POST['TblTemplates']['TemplateSubject'];
			$model->Template = $_POST['TblTemplates']['Template'];
			$model->senderMailId =$_POST['TblTemplates']['senderMailId'];
			$model->senderName =$_POST['TblTemplates']['senderName'];
			$model->carbonCopy =$_POST['TblTemplates']['carbonCopy'];
			$model->attachment =$_POST['TblTemplates']['attachment'];
			$model->TemplateType =$_POST['TblTemplates']['TemplateType'];
			$model->CType = $type;
			$model->CreatedOn = date("Y-m-d H:i:s");
			$model->CreatedBy = Yii::app()->user->Id;
			$model->MId = Yii::app()->user->MId;
			
			// validate user input and redirect to the previous page if valid
			if($model->save())
			{	
				Yii::app()->session['notice'] = Yii::t('translate','Template Added');
			    Yii::app()->session['ntype'] = 'success';
				
				//$this->redirect("/appsettings/notifications/index/type/".$_GET['type']);
				$this->redirect($_POST['redirect']);
			}
			else
			{
				$msg = "<h1>Error</h1>";
				$msg .= sprintf("Couldn't create model <b>%s</b>", $_GET['model']);
				$msg .= "<ul>";
				foreach($model->errors as $attribute=>$attr_errors)
				{
					$msg .= "<li>Attribute: $attribute</li>";
					$msg .= "<ul>";
					foreach($attr_errors as $attr_error)
								$msg .= "<li>$attr_error</li>";
					
					$msg .= "</ul>";
				}
				$msg .= "</ul>";
				$this->_sendResponse(500,$msg );
			}
		}
		
		$criteria = new CDbCriteria();
		$criteria = new CDbCriteria;
		$criteria->condition = "MId = ".Yii::app()->user->MId." AND Application = 'Notification' AND CType='".$_GET['type']."' AND (`Key`='notification_mailid' OR `Key`='notification_name')";		
		$usedGeneralData = TblSysFrontendSettings::model()->findAll($criteria);
		$usedGeneralData = CHtml::listData($usedGeneralData,'Key','Value');
		
		$this->render("_addTemplate",array("model"=>$model,"rulesmodel"=>$rulesmodel,"usedGeneralData"=>$usedGeneralData));
	}
	
	public function actionEditTemplate($type)
	{ 
		//$this->_checkAuth();
		
		$rulesmodel=new TblNotificationRules;
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='frmrules')
		{
			echo CActiveForm::validate($rulesmodel);
			Yii::app()->end();
		}
		
		if(strlen($_POST['btnrulesave'])>0)
		{
			$this->actionAddRules($_POST);
		}
			
		$model = TblTemplates::model()->findByPk($_GET['id']);
		$origModel = $model;
				
		if(isset($_POST['ajax']) && $_POST['ajax']==='frmtmplate')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
				
		if(strlen($_POST['btntempsave'])>0)
		{
			if(isset($_POST['TblTemplates']))
			{ 
				// if it is ajax validation request
				$id = $_GET['id'];
				
				//if($_POST['TblTemplates']['PId'] == 0)
					//$model = new TblTemplates;
				
				$model->attributes=$_POST['TblTemplates'];
				$model->TemplateName =$_POST['TblTemplates']['TemplateName'];
				$model->TemplateSubject =$_POST['TblTemplates']['TemplateSubject'];
				$model->Template = $_POST['TblTemplates']['Template'];
				$model->senderMailId =$_POST['TblTemplates']['senderMailId'];
				$model->senderName =$_POST['TblTemplates']['senderName'];
				$model->carbonCopy =$_POST['TblTemplates']['carbonCopy'];
				$model->attachment =$_POST['TblTemplates']['attachment'];
				$model->TemplateType =$_POST['TblTemplates']['TemplateType'];
				
				/*if($_POST['TblTemplates']['PId'] == 0)
				{
					$model->PId =$origModel['TempId'];
					$model->ModuleId =$origModel['ModuleId'];
				}*/
				
				$model->MId = Yii::app()->user->MId;
				if($model->save())
				{
					$insertedTemplate = Yii::app()->db->getLastInsertID();
					
					$criteria = new CDbCriteria();
					$criteria->condition = 'IsDelete=0 AND TemplateId='.$origModel['TempId'].' AND MId=0';
					$defualtRule = TblNotificationRules::model()->find($criteria);
					
					$modelRule = new TblNotificationRules;
					$modelRule->MId =Yii::app()->user->MId;
					$modelRule->Module = $defualtRule['Module'];
					$modelRule->Action = $defualtRule['Action'];
					$modelRule->TemplateId = $insertedTemplate;
					$modelRule->save();
				}
				else
				{
					var_dump($model->getErrors()); exit;
				}
				
				Yii::app()->session['notice'] = Yii::t('translate','Template Updated');
				Yii::app()->session['ntype'] = 'success';
				//$this->redirect("/members/notifications/index/type/".$_GET['type']);
				$this->redirect($_POST['redirect']);
			}
		}
		
		$templatesId = $_GET['id'];
		$criteria = new CDbCriteria();
		$criteria->condition = 'IsDelete=0 AND TemplateId = '.$templatesId.' AND MId='.Yii::app()->user->MId;
		$notificationRules=TblNotificationRules::model()->find($criteria);
		
		if(count($notificationRules) < 1)
		{
			$criteria = new CDbCriteria();
			$criteria->condition = 'IsDelete = 0 AND TemplateId = '.$templatesId.' AND MId = 0';
			$notificationRules=TblNotificationRules::model()->find($criteria);
		}
		
		$actionData = BWCFunctions::getRecordsByPk("TblNotificationActions",$notificationRules['Action']);
		
		$criteria = new CDbCriteria();
		$criteria = new CDbCriteria;
		$criteria->condition = "MId = ".Yii::app()->user->MId." AND Application = 'Notification' AND CType='".$_GET['type']."' AND (`Key`='notification_mailid' OR `Key`='notification_name')";		
		$usedGeneralData = TblSysFrontendSettings::model()->findAll($criteria);
		$usedGeneralData = CHtml::listData($usedGeneralData,'Key','Value');
		
		//echo $this->renderpartial('application.views.common.modals._editTemplate',array("model"=>$model,'actionData'=>$actionData),true,true);
		$this->render("_addTemplate",array("model"=>$model,'actionData'=>$actionData,"rulesmodel"=>$rulesmodel,"usedGeneralData"=>$usedGeneralData));
	}
	
	public function actionDeleteTemplate($id)
	{
		$this->_checkAuth();
		
		$delete = BWCFunctions::deleteRecordsByPk('TblTemplates',$id,"TemplateName");
		Yii::app()->session['notice'] = Yii::t('translate','Template Deleted');
		Yii::app()->session['ntype'] = 'success';
		//$this->redirect("/members/notifications/index/type/".$_GET['type']);
		$this->redirect($_SERVER['HTTP_REFERER']);
		if($delete){
			$array = array("success"=>true);
			echo json_encode($array);
		}else{
			$array = array("success"=>false);
			echo json_encode($array);
		} 
	}
	
	public function actionAddRules($post)
	{
		
	
		if(isset($post['TblNotificationRules']))
		{	 
			if(count($post['Action'])>0)
			{	//print_r($post['Action']);
				foreach($post['Action'] as $keyact=>$valact)
				{
					
					$modaction = explode("_",$valact);
					
					$model=new TblNotificationRules();
					$model->Module =$post['TblNotificationRules']['Module'];
					$model->ActiveRecord = $modaction[0]."_".$modaction[1];
					$model->Action = $modaction[2];
					$model->TemplateId = $post['TblNotificationRules']['TemplateId'];
					$model->Response =$post['TblNotificationRules']['Response'];
					$model->CType = $_GET['type'];
					$model->CreatedOn = date("Y-m-d H:i:s");
					$model->CreatedBy = Yii::app()->user->Id;
					$model->MId = Yii::app()->user->MId;
					$model->save();
					$lastid = Yii::app()->db->getLastInsertId();
				}
				
				if($lastid)
				{
					Yii::app()->session['notice'] = Yii::t('translate','Notification Rule Added');
					Yii::app()->session['ntype'] = 'success';
						
					//$this->redirect('/members/notifications/index/type/'.$_GET['type']);
					$this->redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					$msg = "<h1>Error</h1>";
					$msg .= sprintf("Couldn't create model <b>%s</b>", $_GET['model']);
					$msg .= "<ul>";
					foreach($model->errors as $attribute=>$attr_errors)
					{
						$msg .= "<li>Attribute: $attribute</li>";
						$msg .= "<ul>";
						foreach($attr_errors as $attr_error)
							$msg .= "<li>$attr_error</li>";
						$msg .= "</ul>";
					}
					$msg .= "</ul>";
					$this->_sendResponse(500,$msg );
				}
			}
			// validate user input and redirect to the previous page if valid
			
		}
	}
	
	public function actionEditRules()
	{ 
       //$this->_checkAuth();
	   		
		$model= TblNotificationRules::model()->findByPk($_GET['id']);
				
		if(isset($_POST['ajax']) && $_POST['ajax']==='frmrules')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
				
		if(strlen($_POST['btnrulesave'])>0)
		{
			if(isset($_POST['TblNotificationRules']))
			{ 
				// if it is ajax validation request
				$id = $_GET['id'];	
							
				//$model->attributes=$_POST['TblNotificationRules'];
				$model->Module =$_POST['TblNotificationRules']['Module'];
				$model->Action = join(",",$_POST['Action']);
				$model->TemplateId = $_POST['TblNotificationRules']['TemplateId'];
				/*$model->senderMailId = $_POST['TblNotificationRules']['senderMailId'];
				$model->senderName = $_POST['TblNotificationRules']['senderName'];*/
				$model->Response =$_POST['TblNotificationRules']['Response'];
				$model->CType = $_GET['type'];
				$model->ModifiedOn = date("Y-m-d");
				$model->ModifiedBy = Yii::app()->user->Id;
				$model->MId = Yii::app()->user->MId;
				if($model->save())
				{
					Yii::app()->session['notice'] = Yii::t('translate','Notification Rule Updated');
					Yii::app()->session['ntype'] = 'success';
					//$this->redirect("/members/notifications/index/type/".$_GET['type']);
					$this->redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					var_dump($model->getErrors()); exit;
				}
			}
		}
		
		echo $this->renderpartial('appsettings.views.modals._editRule',array("model"=>$model),true,true);
	}
	
	public function actionDeleteRule($id)
	{
		$this->_checkAuth();
		
		$delete = BWCFunctions::deleteRecordsByPk('TblNotificationRules',$id,"Response");
		Yii::app()->session['notice'] = Yii::t('translate','Notification Rule Deleted');
		Yii::app()->session['ntype'] = 'success';
		//$this->redirect("/members/notifications/index/type/".$_GET['type']);
		$this->redirect($_SERVER['HTTP_REFERER']);
		if($delete){
			$array = array("success"=>true);
			echo json_encode($array);
		}
		else{
			$array = array("success"=>false);
			echo json_encode($array);
		} 
	}
	
	
	public function actionDynamicResponse()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "ParentId='".$_POST['TblNotificationRules']['Action']."'";
		$result = TblNotificationActions::model()->findAll($criteria);
		
		$data = CHtml::listData($result,'Action','ActionName');
		echo CHtml::tag('option',array('value'=>''),CHtml::encode('Select Response'),true);
		
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
		}
	}
	
}