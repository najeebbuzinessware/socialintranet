<?php

class BWNotiticationFunctions {
	
	/*
	 * Function to handle redirect with Get Params encrypted
	 */
	public function getAllAssignModuleActionsFromMId($ctype='Backend')
	{
			
		$action = array();	
		if($ctype=='Frontend'){
			$actioncriteria = new CDbCriteria();
			$actioncriteria->condition = "CType='".$ctype."' and Label!='View'";
			$ActionList = TblModuleTask::model()->findAll($actioncriteria);
			if(count($ActionList)>0)
			{
				foreach($ActionList as $keyact=>$valact)
				{
					$action[$valact['ActiveRecord']."_".$valact['Label']."_".$valact['Task']] = ucfirst(preg_replace("/(?<=[a-zA-Z])(?=[A-Z])/", " ", $valact['Task']));
				}
			}
			
		}else{
			$criteria = new CDbCriteria();
			$criteria->join = "Join tbl_sys_ModuleAccess as ma on ma.ModuleId=t.ModuleId";
			$criteria->condition = "t.Parent = '0' AND t.Visible ='Yes' and ma.MId=".Yii::app()->user->MId;
			$module = TblModules::model()->findAll($criteria);

			if(count($module)>0)
			{
				foreach($module as $keymod=>$valmod)
				{
					$criteria = new CDbCriteria();
					$criteria->condition = "Parent = '".$valmod['ModuleId']."' AND Visible LIKE 'Yes'";
					$datamodel = TblModules::model()->findAll($criteria);
					
					if(count($datamodel)>0)
					{
						foreach($datamodel as $keytask=>$valtask)
						{
							$actioncriteria = new CDbCriteria();
							$actioncriteria->condition = "CType='".$ctype."' and Label!='View' and ModuleId=".$valtask['ModuleId'];
							$ActionList = TblModuleTask::model()->findAll($actioncriteria); 
							if(count($ActionList)>0)
							{
								foreach($ActionList as $keyact=>$valact)
								{
									$action[$valtask['Module']][$valact['ActiveRecord']."_".$valact['Label']."_".$valact['Task']] = ucfirst(preg_replace("/(?<=[a-zA-Z])(?=[A-Z])/", " ", $valact['Task']));
								}
							}
						}
					}
				}
			}

		}
		
		return $action;
	}
	
	public static function checkModulesHasFrontend()
	{
		$array = array('Careers','Events');
		return $array;
	}
	
	public static function getAssignModules()
	{
		$array = array();	
		$criteria = new CDbCriteria();
		$criteria->condition = 'MId='.Yii::app()->user->MId;
		$modaccess = TblModuleAccess::model()->findAll($criteria);
		
		if(count($modaccess)>0)
		{
			$accessmodule = "0";
			$comma=",";
			foreach($modaccess as $keyacc=>$valacc)
			{
				$accessmodule .=$comma.$valacc['ModuleId'];
				$comma=",";
			}
			
			$criteria = new CDbCriteria();
			$criteria->condition = "Visible ='Yes' and ModuleId in (".$accessmodule.")";
			$module = TblModules::model()->findAll($criteria);
			
			if(count($module)>0)
			{
				foreach($module as $key=>$val)
				{
					$array[$val['Module']] = $val['Module'];
				}
			}
		}
		return $array;
	}
	
}

?>