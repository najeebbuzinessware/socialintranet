<?php

Yii::import('zii.widgets.CPortlet');
 
class NewsWidget extends CPortlet
{
    protected function renderContent()
    {
		Yii::import('common.models.*');
        $newsmodel = new TblNewsRss;
        
        $criteria = new CDbCriteria();
        $criteria->condition = "CType='News' and UserId=".Yii::app()->user->Id." and MId=".Yii::app()->user->MId;
        $newsettings =TblSysNewsTaskSettings::model()->find($criteria);
        
        $this->render('NewsWidget', array('newsmodel'=>$newsmodel,"newsettings"=>$newsettings));
    }
}

?>