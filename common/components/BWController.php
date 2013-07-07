<?php
class BWController extends CController
{
	/*
	 * @var Global Variable for showing Notification Alert text, used by JS code done by Nikola. JS function name - notice
	 */
	public $bwNotice;
	/*
	 * @var Global Variable for showing Notification Alert Type, used by JS code done by Nikola. JS function name - notice
	 */
	public $bwnType;
	/**
	 *
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 *      meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = 'common.views.layouts.column2';
	/**
	 *
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();
	/**
	 *
	 * @var array the breadcrumbs of the current page. The value of this property will
	 *      be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 *      for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
	public $requestParam = array();
	
	public function init(){
		BWCFunctions::masterFrontSetting();
		//echo Yii::app()->params['FrontEndLogo']; exit;
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError( )
	{
		$this->layout = 'common.views.layouts.main';
		if ($error = Yii::app()->errorHandler->error)
		{
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render( 'error', $error );
		}
	}
}
?>