<?php
/**
 * Image helper functions
 * 
 * @author Chris
 * @link http://con.cept.me
 */
class ImageHelper {

    /**
     * Directory to store thumbnails
     * @var string 
     */
    const THUMB_DIR = '.tmb';

    /**
     * Create a thumbnail of an image and returns relative path in webroot
     * the options array is an associative array which can take the values
     * quality (jpg quality) and method (the method for resizing)
     *
     * @param int $width
     * @param int $height
     * @param string $img
     * @param array $options
     * @return string $path
     */
    public static function thumb($width, $height, $img, $options = null)
    {
        if(!file_exists($img)){
            $img = str_replace('\\', '/', Yii::app()->params['filepath'].$img);
            if(!file_exists($img)){
                $img = str_replace('\\', '/', YiiBase::getPathOfAlias('webroot').'/'.Yii::app()->params['defaultavatarimage']);
            }
            if(!file_exists($img)){
            	return true;
            }
        }
        // Jpeg quality
        $quality = 99;
        // Method for resizing
        //$method = 'adaptiveResize';
        $method = 'resizePercent';

        if($options){
            extract($options, EXTR_IF_EXISTS);
        }

        $pathinfo = pathinfo($img);
        $thumb_name = "thumb_".$pathinfo['filename'].'_'.$method.'_'.$width.'_'.$height.'.'.$pathinfo['extension'];
        $thumb_path = $pathinfo['dirname'].'/'.self::THUMB_DIR.'/';
        if(!file_exists($thumb_path)){
            mkdir($thumb_path);
        }
        
        if(!file_exists($thumb_path.$thumb_name) || filemtime($thumb_path.$thumb_name) < filemtime($img)){
            
            Yii::import('common.extensions.phpThumb.PhpThumbFactory');
            $options = array('jpegQuality' => $quality);
            $thumb = PhpThumbFactory::create($img, $options);
            if($method == "resize"){
            $thumb->{$method}($width, $height);
            }else{
            $thumb->resizePercent(70);
            }
            $thumb->save($thumb_path.$thumb_name);            
        }
        /*echo YiiBase::getPathOfAlias('root');
        echo "---------------";
		echo YiiBase::getPathOfAlias('webroot');
        exit;*/
        $path = "/home/appsdev/public_html";
        $relative_path = str_replace($path, '', $thumb_path.$thumb_name); //str_replace(YiiBase::getPathOfAlias('webroot'), '', $thumb_path.$thumb_name);
        return $relative_path;
    }
    
   
}