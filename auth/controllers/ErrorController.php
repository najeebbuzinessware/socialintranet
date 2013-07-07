<?php

class ErrorController extends BWController
{
	public $layout = 'common.views.layouts.intraware-layout-public';
	
	public function actionIndex()
	{
		$this->render('error');
	}
}
?>