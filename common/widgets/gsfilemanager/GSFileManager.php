<?php
class GSFileManager extends CWidget {
 	
	public $containerId;
	public function init()
    {
		$cs=Yii::app()->clientScript;

		$cs->registerCssFile('/css/gsFileManager.css');
		$cs->registerCssFile('/css/jquery.Jcrop.css');

		$cs->registerScriptFile('/js/gsFileManager.js');
		$cs->registerScriptFile('/js/jquery.form.js');
		$cs->registerScriptFile('/js/jquery.Jcrop.js');
		$cs->registerScriptFile('/js/ckeditor.js');
    }
	
    public function run() {
        $this->render('fileManager');
    }
 
}
?>