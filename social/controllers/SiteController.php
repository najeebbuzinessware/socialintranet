<?php

class SiteController extends BWController
{
	public $layout='common.views.layouts.main';   

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	
	public function filters( )
	{
		return array(
				array( 'common.filters.MasterUrlFilter' )
		);
	}
	
	
	
	public function actionIndex()
	{ 			
		$username ="";
		$password ="";
		if(!Yii::app()->user->isGuest)
		{			
          Yii::app()->controller->redirect('/wall/');
		}
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{			
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
               
				if (! is_null( Yii::app()->user->Preferences))
				{
					$typelink = Yii::app()->user->Preferences;
				} else
				{
					$typelink = "/wall/";
				}
				Yii::app()->controller->redirect( $typelink );
                //Yii::app()->controller->redirect('/wall/');
            }	
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}