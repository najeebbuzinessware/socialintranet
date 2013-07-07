<?php

Yii::import('zii.widgets.CPortlet');
 
class GroupsWidget extends CPortlet
{
    protected function renderContent()
    {
		Yii::import('common.models.*');
		
        $criteria = new CDbCriteria();
		$criteria->join = "LEFT JOIN tbl_Coll_Followers as Ass ON t.GrId = Ass.RecordId"; //"t.MId = '".Yii::app()->user->MId."'";
		$criteria->condition = "t.MId=".Yii::app()->user->MId." and ((t.UserId=".Yii::app()->user->Id.") or (Ass.FollowingBy=".Yii::app()->user->Id." and Ass.FollowingType='group'))";
		$criteria->group = 'Ass.RecordId';
		$model = TblCollGroups::model()->findAll($criteria);
		
        $criteria = new CDbCriteria();
        $criteria->condition = "CType='Groups' and UserId=".Yii::app()->user->Id." and MId=".Yii::app()->user->MId;
        $settings =TblSysNewsTaskSettings::model()->find($criteria);
        
        $this->render('GroupsWidget', array('model'=>$model,"settings"=>$settings));
    }
}

?>