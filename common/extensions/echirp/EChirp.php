<?php
/*
* Chirp Your Tweet (chirp.js) for Yii - Tweet on your website
* author : ary.wibowo@nucreativa.com
*/
class EChirp extends CWidget
{
	/*
	* @var options for chirp.js
	*/
	public $options = array();
	
	public function run()
	{
		$options=$this->options?CJavaScript::encode($this->options):'';
		$asset=Yii::app()->assetManager->publish(dirname(__FILE__).'/assets');
    	$cs=Yii::app()->clientScript;
    	$cs->registerScriptFile($asset.'/chirp.min.js');
    	$cs->registerScript('_chirp','Chirp('.$options.');',CClientScript::POS_END);
	}
}
?>