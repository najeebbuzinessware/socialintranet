<?php
class UserAuthFilter extends CFilter
{

	protected function preFilter($filterChain)
	{
		$app = Yii::app();
		if ($app->user->isGuest)
		{
			$session = new CHttpSession();
			$session->open();
			$username = !is_null($session['username']) ? $session['username'] : Yii::app()->request->cookies['appusername']->value;
			$password = !is_null($session['password']) ? $session['password'] : Yii::app()->request->cookies['appasswd']->value;
			if (empty( $username ) & empty( $password ))
			{ 
				$app->controller->redirect( Yii::app()->params['appurl'] );
			} else
			{ 
				//Get MId
				$MId = BWCFunctions::getMIdfromHostName();
				if(!is_null($MId))
				{
					Yii::app()->params['MId'] = $MId->MId;
				}else{
					$url = Yii::app()->params['appurl'] . 'error';
					$app->controller->redirect( $url );					
				}
				$identity = new UserIdentity( $username, $password );
				if ($identity->authenticate())
				{
					Yii::app()->user->login( $identity );
					Yii::app()->params['MId'] = empty( Yii::app()->params['MId'] ) ? Yii::app()->user->MId : Yii::app()->params['MId'];
					Yii::app()->params['UserId'] = empty( Yii::app()->params['Userid'] ) ? Yii::app()->user->Userid : Yii::app()->params['UserId'];
					Yii::app()->params['UserType'] = empty( Yii::app()->params['UserType'] ) ? Yii::app()->user->UserType : Yii::app()->params['UserType'];
					Yii::app()->params['appurl'] = empty( Yii::app()->user->Domain ) ? Yii::app()->params['appurl'] : Yii::app()->user->Domain;
					Yii::app()->controller->redirect( Yii::app()->user->returnUrl );
				} else
				{
					$app->controller->redirect( Yii::app()->params['appurl'] );
				}
			}
		} else
		{
			Yii::app()->params['MId'] = empty( Yii::app()->params['MId'] ) ? Yii::app()->user->MId : Yii::app()->params['MId'];
			Yii::app()->params['UserId'] = empty( Yii::app()->params['Userid'] ) ? Yii::app()->user->Userid : Yii::app()->params['UserId'];
			Yii::app()->params['UserType'] = empty( Yii::app()->params['UserType'] ) ? Yii::app()->user->UserType : Yii::app()->params['UserType'];
			Yii::app()->params['appurl'] = empty( Yii::app()->user->Domain ) ? Yii::app()->params['appurl'] : Yii::app()->user->Domain;
			return true;
		}
	}

	protected function postFilter($filterChain)
	{
		//Yii::app()->controller->redirect( Yii::app()->user->returnUrl );
		return true;
	}
}


