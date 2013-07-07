<?php
class MasterUrlFilter extends CFilter
{

	protected function preFilter($filterChain)
	{
		$app = Yii::app();
		$hostname = $_SERVER['HTTP_HOST'];
		$criteria = new CDbCriteria();
		$criteria->condition = "`Domain` like '%" . $hostname . "%'";
		$modelUrl = TblMaster::model()->find( $criteria );
		if (! is_null( $modelUrl ))
		{
			Yii::app()->params['appurl'] = $modelUrl->Domain;
			Yii::app()->params['MId'] = $modelUrl->MId;
		} else
		{
			$url = Yii::app()->params['appurl'] . 'error';
			$app->controller->redirect( $url );
		}
		return true;
	}

	protected function postFilter($filterChain)
	{
		return true;
	}
}
?>