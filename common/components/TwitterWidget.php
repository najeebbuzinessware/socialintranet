<?php

Yii::import('zii.widgets.CPortlet');
 
class TwitterWidget extends CPortlet
{
    protected function renderContent()
    {
		Yii::import('common.models.*');     
		
		
        $this->render('twitterWidget');
    }
}

?>