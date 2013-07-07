<?php
class BWCFunctions
{
	public static function getAvatar($type="Small",$userAvatar=NULL)
	{ //echo $userAvatar;
	if($type == "Big")
	{
		$ImageTypeWidth = 240;
		$ImageTypeHeight = 240;
		$ImageOption = "resizepercent";
	}else{
		$ImageTypeWidth = 90;
		$ImageTypeHeight = 90;
		$ImageOption = "resize";
	}
	
	
	if($userAvatar == '' && empty($userAvatar))
	{
		$path = Yii::app()->params['filepath'] . Yii::app()->params['defaultavatarimageurl'];
	}else
	{
		$path = Yii::app()->params['filepath'] . Yii::app()->user->MId . "/".Yii::app()->user->Id."/" . $userAvatar;
	}
	if(!file_exists($path))
	{
		$path = Yii::app()->params['filepath'] . Yii::app()->params['defaultavatarimageurl'];
	}
	
	$img = Yii::app()->params['appurl'] . ImageHelper::thumb( $ImageTypeWidth, $ImageTypeHeight, $path, array('method'=>$ImageOption));
	return $img;
	}
	
	public static function getGroupAvatar($type="Small",$groupAvatar)
	{
		if($type == "Big")
		{
			$ImageTypeWidth = 240;
			$ImageTypeHeight = 240;
			$ImageOption = "resizepercent";
		}else{
			$ImageTypeWidth = 90;
			$ImageTypeHeight = 90;
			$ImageOption = "resize";
		}
		if($groupAvatar == '' || empty($groupAvatar))
		{
			$path = Yii::app()->params['filepath'] . Yii::app()->params['defaultavatarimageurl'];
		}else
		{
			$path = Yii::app()->params['filepath'] . Yii::app()->user->MId . "/groups/" . $groupAvatar;
		}
		if(!file_exists($path))
		{
			$path = Yii::app()->params['filepath'] . Yii::app()->params['defaultavatarimageurl'];
		}
	
		$img = Yii::app()->params['appurl'] . ImageHelper::thumb( $ImageTypeWidth, $ImageTypeHeight, $path, array('method'=>$ImageOption));
		return $img;
	}
	
	public static function getMIdUsers()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'Userid!='.Yii::app()->user->Id.' and MId='.Yii::app()->user->MId;
		$usermodel = TblSysUsers::model()->findAll($criteria);
		$userarray = array();
		if (count( $usermodel ) > 0)
		{
			$usermodel = CHtml::listData( $usermodel, 'Userid', 'Name' );
			foreach ( $usermodel as $key => $val )
			{
				$userarray[$key] = $val;
			}
		}
		return $userarray;
	}
	
	function getUrlProtocol()
	{
		$protocolURL = 'http';
		if ($_SERVER["HTTPS"] == "on")
		{
			$protocolURL .= "s";
		}
		$protocolURL .= "://";
	
		return $protocolURL;
	}
	
	public function getAppUrl()
	{
		$uriParam = explode('/',$_SERVER['REQUEST_URI']);
		//$module = $uriParam[1];
		$mainUrl = BWCFunctions::getUrlProtocol().$_SERVER['HTTP_HOST'];//.'/'.$module;
	
		return $mainUrl;
	}
	
	public function getMIdModules($mId , $flg = NULL)
	{
		$criteria = new CDbCriteria();
		if ($flg == 1)
		{
			$criteria->join = " JOIN tbl_sys_ModuleAccess as Ass ON t.ModuleId = Ass.ModuleId"; // "t.MId = '".Yii::app()->user->MId."'";
			$criteria->condition = 't.Parent=0 and Ass.MId=' . $mId;
			$criteria->order = 'Module ASC';
			$moduleData = TblSysModules::model()->findAll( $criteria );
			$modules = CHtml::listData( $moduleData, 'Link', 'Module' );
		} else
		{
			$criteria->condition = 'MId=' . $mId;
			$moduleData = TblSysModuleAccess::model()->findAll( $criteria );
			$modules = CHtml::listData( $moduleData, 'ModuleId', 'ModuleId' );
		}
		return $modules;
	}
	
	public function getLoginpageLogofromHostName( )
	{
		$hostname = $_SERVER['HTTP_HOST'];
		$criteria = new CDbCriteria();
		$criteria->condition = "`Key` = 'config_frontend_url' AND IsActive='Yes' AND IsDelete='No' and `Value` like '%".$hostname."%' and Application='Social'";
		$modelurl = TblSysFrontendSettings::model()->find($criteria);
		$logo = "/images/appware.png";
		//print_r($modelurl);
		if(!is_null($modelurl))
		{
			$criteria = new CDbCriteria;
			$criteria->condition = "`Key` = 'config_logo' IsActive='Yes' AND IsDelete='No' AND Application = 'Social' AND MId = ".$modelUrl['MId'];
			$model = TblSysFrontendSettings::model()->find($criteria);
			
			if (strlen( $model[0]['config_logo']) > 0)
			{
				$logo = '/uploads/logo'.$modelurl['MId'] .'/'. $model['config_logo'];
			}
		}
		return $logo;
	}
	
	public function getFrontSettings($MId)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "MId = '".$MId."' AND Application = 'Social' AND IsActive='Yes' AND IsDelete='No'";
	
		$model = TblSysFrontendSettings::model()->findAll($criteria);
		$sysFrontSetting = CHtml::listData($model,'Key','Value');
	
		return $sysFrontSetting;
	}
	
	public function masterFrontSetting()
	{
		$app = Yii::app();
		$uriParam = explode('/',$_SERVER['REQUEST_URI']);
		$hostname = $_SERVER['HTTP_HOST'];
		$criteria = new CDbCriteria;
		$criteria->condition = "`Key` = 'config_frontend_url' AND IsActive='Yes' AND IsDelete='No' and `Value` like '%".$hostname."%'";
		$modelUrl = TblSysFrontendSettings::model()->find($criteria);
		$app->Params['FrontEndLogo'] = "/images/appware.png";
		 
		if(!is_null($modelUrl))
		{
			$criteria = new CDbCriteria;
			$criteria->condition = "IsActive='Yes' AND IsDelete='No' AND Application = 'Social' AND MId = ".$modelUrl['MId'];
			$model = TblSysFrontendSettings::model()->findAll($criteria);
	
			$systemFrontendSettings = BWCFunctions::getFrontSettings($modelUrl['MId']);
			
			//print_r($systemFrontendSettings); exit;
			
				/* if(!Yii::app()->user->isGuest)
				{ */
					$app->Params['MId'] = $modelUrl['MId'];
					$app->Params['FrontEndLogo'] = "/uploads/logo".$modelUrl['MId']."/".$systemFrontendSettings['config_logo'];
					$app->Params['link_color'] = $systemFrontendSettings['config_link_color'];
					$app->Params['border_color'] =$systemFrontendSettings['config_border_color'];
					$app->Params['grad_start'] = $systemFrontendSettings['config_grad_start'];
					$app->Params['nav_color'] = $systemFrontendSettings['config_nav_color'];
					$app->Params['nav_hover'] = $systemFrontendSettings['config_nav_hover'];
					$app->Params['grad_end'] = $systemFrontendSettings['config_grad_end'];
					$app->Params['twitter_widget'] = $systemFrontendSettings['config_twitter_widget'];
					$app->Params['saveBrandingBtn'] = $systemFrontendSettings['saveBrandingBtn'];
					$app->Params['AdminEmail'] = "anoop@bw.ae";
				/* }
				else
				{
					$app->Params['FrontEndLogo'] = $systemFrontendSettings['config_logo']; 
					//Yii::app()->user->setState('BackUrl', BWCFunctions::curPageURL());
					Yii::app()->request->redirect('/site/login');
				}*/
			
		}
	}
	
	public function get_day_name($timestamp)
	{
		$date = date( 'd/m/Y', $timestamp );
		if ($date == date( 'd/m/Y' ))
		{
			$day_name = 'Today';
		} else if ($date == date( 'd/m/Y', strtotime( "-1 day" ) ))
		{
			$day_name = 'Yesterday';
		} 
		else if ($date == date( 'd/m/Y', strtotime( "+1 day" ) ))
		{
			$day_name = 'Tomorrow';
		}else if ($date == date( 'd/m/Y', strtotime( "+7 day" ) ))
		{
			$day_name = 'Next Week';
		}
		else if ($date == date( 'd/m/Y', strtotime( "-2 day" ) ))
		{
			$day_name = 'Last ' . date( 'l', strtotime( "-2 day" ) );
		} else if ($date == date( 'd/m/Y', strtotime( "-3 day" ) ))
		{
			$day_name = 'Last ' . date( 'l', strtotime( "-3 day" ) );
		} else if ($date == date( 'd/m/Y', strtotime( "-4 day" ) ))
		{
			$day_name = 'Last ' . date( 'l', strtotime( "-4 day" ) );
		} else if ($date == date( 'd/m/Y', strtotime( "-5 day" ) ))
		{
			$day_name = 'Last ' . date( 'l', strtotime( "-5 day" ) );
		} else if ($date == date( 'd/m/Y', strtotime( "-6 day" ) ))
		{
			$day_name = 'Last ' . date( 'l', strtotime( "-6 day" ) );
		} else if ($date == date( 'd/m/Y', strtotime( "-7 day" ) ))
		{
			$day_name = 'Last ' . date( 'l', strtotime( "-7 day" ) );
		} else if (date( 'Y', $timestamp ) != date( 'Y' ))
		{
			$day_name = date( "F d Y", $timestamp );
		} else
		{
			$day_name = date( "F d Y", $timestamp );
		}
		return $day_name;
	}
	
	public function getProductCatalog($ctype = 'Projects')
	{
		$productC = array();
		$procriteria = new CDbcriteria();
		$procriteria->condition = "MId=" . Yii::app()->user->MId;
		$prodctG = CHtml::listData( TblProductGroups::model()->findAll( $procriteria ), 'PGId', 'GroupName' );
		if (count( $prodctG ) > 0)
		{
			foreach ( $prodctG as $key => $value )
			{
				$criteria = new CDbCriteria();
				$criteria->condition = "Gid = " . $key . " and MId = " . Yii::app()->user->MId . " AND ctype = '" . $ctype . "'";
				$productC[$value] = CHtml::listData( TblProductCatalog::model()->findAll( $criteria ), 'PId', 'Name' );
			}
		}
		return $productC;
	}
}