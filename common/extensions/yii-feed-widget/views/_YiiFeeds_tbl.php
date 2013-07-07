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
<tr> 
  <td><?php  preg_match_all('/<img[^>]+>/i',$item->get_description(), $result);
echo($result[0][0]); ?>
    &nbsp;
    </td><td>
     <a href="<?php echo $item->get_permalink(); ?>" target="_blank"><?php echo strip_tags(preg_replace("/<img[^>]+\>/i", " ", $item->get_title())); ?></a>   
     <br />Posted on <?php echo $item->get_date('j F Y | g:i a'); ?>
     <br /><?php echo substr(strip_tags(preg_replace("/<img[^>]+\>/i", " ", $item->get_description())),0,250); ?>
	</td></tr>
   
<?php endforeach; ?>