<?php
/**
 * FileDoc: 
 * View file for YiiFeedWidget.
 * This extension depends on both idna convert and Simple Pie php libraries
 *  
 * PHP version 5.3
 * 
 * @category Extensions
 * @package  YiiFeedWidget
 * @author   Richard Walker <richie@mediasuite.co.nz>
 * @license  BSD License http://www.opensource.org/licenses/bsd-license.php
 * @link     http://mediasuite.co.nz
 * @see      simplepie.org
 * @see      http://www.phpclasses.org/browse/file/5845.html
 * 
 */ 
?>
<!-- Publish necessary javascript -->
<?php $this->registerClientScript('yii-feeds-widget.js'); ?>
<!-- Publish necessary css -->
<?php $this->registerClientCSS('yii-feeds-widget.css'); ?>
<!-- Hidden fields for javascript -->
<?php echo CHtml::hiddenField('yii-feeds-widget-url2', $url); ?>
<?php echo CHtml::hiddenField('yii-feeds-widget-limit2', $limit); ?>
<?php 
echo CHtml::hiddenField(
    'yii-feeds-widget-action-url2',  
    Yii::app()->createUrl('YiiFeedWidget/getFeed2')
); 
?>
<!-- Container to hold feed items -->
<div id="yii-feed-container2">

    <?php echo CHtml::image($this->getSpinner()); ?>

</div>