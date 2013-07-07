<?php
/**
 * SiteController.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class SiteController extends BWController
{
	public $layout = 'common.views.layouts.main';

	public function filters( )
	{
		return array(
				array( 'common.filters.MasterUrlFilter' )
		);
	}	
	/**
	 * Displays the login page
	 */
	public function actionIndex( )
	{
		$username = "";
		$password = "";
		$model = new LoginForm();
		//Check if Cookie is valid
		/*if(isset(Yii::app()->user->username))
		{ 
			//Fetch the Id from Database;
			$UserData = TblSysUsers::model()->findByAttributes(array('Email'=>Yii::app()->user->username));
			if(!is_null($UserData))
			{				
				if(Yii::app()->user->stateKeyPrefix == $UserData->Token)
				{ 
					$identity = $this->restoreFromCookie();
					//$identity = new UserIdentity( $username, $password );
					if ($identity->authenticate())
					{
						Yii::app()->user->login( $identity );
						echo "1"; exit;
						if (! is_null( Yii::app()->user->Preferences ))
						{
							$typelink = Yii::app()->params['appurl'] . Yii::app()->user->Preferences;
						} else
						{
							$typelink = "/user/profile";
						}
						Yii::app()->controller->redirect( $typelink );
					}					
				}
			}
		}*/
		
		if (isset( Yii::app()->request->cookies['appusername']->value ) && isset( Yii::app()->request->cookies['appasswd']->value ))
		{
			$username = Yii::app()->request->cookies['appusername']->value;
			$password = Yii::app()->request->cookies['appasswd']->value;
		}
		// if it is ajax validation request
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		//echo Yii::app()->user->username; exit;
		if (!isset(Yii::app()->user->username))
		{
			// collect user input data
			if (isset( $_POST['LoginForm'] ))
			{
				$model->attributes = $_POST['LoginForm'];
				// validate user input and redirect to the previous page if alid
				if ($model->validate() && $model->login())
				{
					if (! is_null( Yii::app()->user->Preferences ))
					{
						$typelink = Yii::app()->params['appurl'] . Yii::app()->user->Preferences;
					} else
					{
						$typelink = "/social/site";
					}
					Yii::app()->controller->redirect( $typelink );
				}
			}
			// display the login form
			$this->render( 'login', array( 'model' => $model, "username" => $username, "password" => $password ) );
		} else
		{
			$typelink = "/social/site";
			Yii::app()->controller->redirect( $typelink );
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError( )
	{
		if ($error = Yii::app()->errorHandler->error)
		{
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render( 'error', $error );
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin( )
	{
		$username = "";
		$password = "";
		$model = new LoginForm();
		if (isset( Yii::app()->request->cookies['appusername']->value ) && isset( Yii::app()->request->cookies['appasswd']->value ))
		{
			$username = Yii::app()->request->cookies['appusername']->value;
			$password = Yii::app()->request->cookies['appasswd']->value;
		}
		// if it is ajax validation request
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		// collect user input data
		if (isset( $_POST['LoginForm'] ))
		{
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
			{
				if (isset( $_POST['LoginForm']['rememberMe'] ))
				{
					Yii::app()->request->cookies['appusername'] = new CHttpCookie( 'appusername', $_POST['LoginForm']['username'] );
					Yii::app()->request->cookies['appasswd'] = new CHttpCookie( 'appasswd', $_POST['LoginForm']['password'] );
				}
				if (! is_null( Yii::app()->user->Preferences ) && isset(Yii::app()->user->Preferences))
				{
					$typelink = Yii::app()->params['appurl'] . Yii::app()->user->Preferences;
				} else
				{
					$typelink = "/social/site";
				}
			$this->redirect($typelink);
			}
		}
		// display the login form
		$this->render( 'login', array( 'model' => $model, "username" => $username, "password" => $password ) );
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout( )
	{
		$url = Yii::app()->params['appurl'];
		
		unset(Yii::app()->request->cookies['appusername']);
		unset(Yii::app()->request->cookies['appasswd']);
		Yii::app()->user->logout();
		$this->redirect( $url );
	}
}