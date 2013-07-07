<?php
/**
 * FileDoc: 
 * View Partial for YiiFeedWidget.
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
 
foreach ($items as $item):
$explode = explode("-",$item->get_title());
$postime = $item->get_date('j F Y g:i a');
?>
<p class="text_blue" >
		<small class="text_grey" ><?php echo $explode[1]." - ".BWDataFunction::humanTiming(strtotime($postime)); ?></small>
	 <a href="<?php echo $item->get_permalink(); ?>" class="text_blue" target="_blank"><?php echo strip_tags(preg_replace("/<img[^>]+\>/i", " ", $explode[0])); ?></a> 
</p>   
<?php endforeach; ?>
