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
?>
<div class="halfmargin"></div>
			<div class="news">
				<div class="grid2">
					<?php  preg_match_all('/<img[^>]+>/i',$item->get_description(), $result);
					if(strlen($result[0][0])>0){ echo($result[0][0]); } ?>
				</div>
				<div class="grid_10">
					
						<p class="title"> <a href="<?php echo $item->get_permalink(); ?>" target="_blank"><?php echo strip_tags(preg_replace("/<img[^>]+\>/i", " ", $item->get_title())); ?></a>  </p>
						<p class="source">Posted on <?php echo $item->get_date('j F Y | g:i a'); ?></p>
						<p><?php echo substr(strip_tags(preg_replace("/<img[^>]+\>/i", " ", $item->get_description())),0,250); ?>...</p>
					
				</div>
			</div>

   
<?php endforeach; ?>
