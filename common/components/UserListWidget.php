<?php

Yii::import('zii.widgets.CPortlet');
 
class UserListWidget extends CPortlet
{
	public $action;
	
    protected function renderContent()
    {        
        $this->render('UserList');
    }
}

?>