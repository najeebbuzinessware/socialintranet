<?php

class AppSettingsModule extends CWebModule
{
  public $defaultController = 'settings';

 /*  public function init()
  {
    $this->setImport(array(
      'appsettings.components.*',
      'appsettings.models.*',
    ));

  } */
  
  public function init()
  {
  	// this method is called when the module is being created
  	// you may place code here to customize the module or the application
  
  	// import the module-level models and components
  	$this->setImport(array(
  	  'appsettings.components.*',
      'appsettings.models.*',
  	));
  	
  }
  
  public function beforeControllerAction($controller, $action)
  {
	  	if(parent::beforeControllerAction($controller, $action))
	  	{
	  		// this method is called before any module controller action is performed
	  		// you may place customized code here
	  		return true;
	  	}
	  	else
  			return false;
  }
}
