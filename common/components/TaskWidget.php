<?php

Yii::import('zii.widgets.CPortlet');
 
class TaskWidget extends CPortlet
{
    protected function renderContent()
    {
		Yii::import('common.models.*');
        $taskmodel = new TblTasks;
        
        $criteria = new CDbCriteria();
        $criteria->condition = "CType='Tasks' and UserId=".Yii::app()->user->Id." and MId=".Yii::app()->user->MId;
        $taskettings =TblSysNewsTaskSettings::model()->find($criteria);
        
        $this->render('TaskWidget', array('taskmodel'=>$taskmodel,"taskettings"=>$taskettings));
    }
}

?>