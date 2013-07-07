<?php

class BWActiveRecord extends CActiveRecord
{

	protected function afterSave()
	{
		if($this->isNewRecord){
			//print_r($this->attributes); exit;
			$lastid = Yii::app()->db->getLastInsertId();
			// notification template code start
			$activerecord = $this->getModelName();
			$modelname = $this->getModelName()."_Add";
					
			$criteria = new CDbCriteria();
			$criteria->condition = 'IsDelete=0 AND ActiveRecord="'. $modelname . '" AND MId=' . Yii::app()->user->MId;
			$notificationRules = TblNotificationRules::model()->findAll( $criteria );
			
			if(count($notificationRules)>0)
			{
				foreach($notificationRules as $key=>$val)
				{
					if ($val['TemplateId'] > 0) // if(count($notificationRules) < 1)
					{
						$mailing = new WMailing();
						$mailing->SendEmail($val['TemplateId'],Yii::app()->user->Id,$lastid,$activerecord,$this->attributes);
						//echo ('created new.'); exit;
					}
				}
			}
		}/* else{
		
			$lastid = $this->primaryKey;
			
			// notification template code start
			$modelname = $this->getModelName()."_Edit";
			$activerecord = $this->getModelName();
			$criteria = new CDbCriteria();
			$criteria->condition = 'IsDelete=0 AND ActiveRecord="'. $modelname . '" AND MId=' . Yii::app()->user->MId;
			$notificationRules = TblNotificationRules::model()->find( $criteria );
			if ($notificationRules['TemplateId'] > 0) // if(count($notificationRules) < 1)
			{
				$mailing = new WMailing();
				$mailing->SendEmail($notificationRules['TemplateId'],Yii::app()->user->Id,$lastid,$activerecord);
				//echo ('updating.'); exit;
			}
			
		} */
		return true;
	}
	
	protected function afterUpdate()
	{
		$lastid = $this->primaryKey;
			
		// notification template code start
		$modelname = $this->getModelName()."_Edit";
		$activerecord = $this->getModelName();
		$criteria = new CDbCriteria();
		$criteria->condition = 'IsDelete=0 AND ActiveRecord="'. $modelname . '" AND MId=' . Yii::app()->user->MId;
		$notificationRules = TblNotificationRules::model()->findAll( $criteria );
	
			if(count($notificationRules)>0)
			{
				foreach($notificationRules as $key=>$val)
				{
					if ($val['TemplateId'] > 0) // if(count($notificationRules) < 1)
					{
						$mailing = new WMailing();
						$mailing->SendEmail($val['TemplateId'],Yii::app()->user->Id,$lastid,$activerecord,$this->attributes);
						//echo ('updating.'); exit;
					}
				}
			}
					
	}
	
	protected function afterDelete()
	{
		$modelname = $this->getModelName()."_Delete";
		$activerecord = $this->getModelName();
		$criteria = new CDbCriteria();
		$criteria->condition = 'IsDelete=0 AND ActiveRecord="'. $modelname . '" AND MId=' . Yii::app()->user->MId;
		$notificationRules = TblNotificationRules::model()->findAll( $criteria );
	
			if(count($notificationRules)>0)
			{
				foreach($notificationRules as $key=>$val)
				{
					if ($val['TemplateId'] > 0) // if(count($notificationRules) < 1)
					{
						$mailing = new WMailing();
						$mailing->SendEmail($val['TemplateId'],Yii::app()->user->Id,$lastid,$activerecord,$this->attributes);
						//echo ('created new.'); exit;
					}
				}
			}
	}
	
}

?>