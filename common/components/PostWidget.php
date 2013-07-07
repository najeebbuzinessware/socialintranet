<?php

Yii::import('zii.widgets.CPortlet');
 
class PostWidget extends CPortlet
{
	public $action;
	
    protected function renderContent()
    {
		Yii::import('common.models.*');
		
        $model = new TblCollWall;
        
        $this->render('PostWidget', array('model'=>$model,"action"=>$this->action));
    }
}

?>