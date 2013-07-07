<?php
/**
 * Free Web File Manager is free software released under MIT License.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED 
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL 
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF 
 * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 
 * DEALINGS IN THE SOFTWARE. 
 * 
 * George Sarafov
 * http://freewebfilemanager.com
 */

class GSFileSystemFileStorage {

	public function is_dir($file) {
		return @is_dir($file);
	}

	public function file_exists($file) {
		return @file_exists($file);
	}

	public function scandir($file) {
		return @scandir($file);
	}

	public function filesize($file) {
		return @filesize($file);
	}

	public function deleteFile($file){
		return @unlink($file);
	}

	public function deleteDirectory($dirname){
		$files = scandir($dirname);
		if (count($files) > 2) {
			foreach( $files as $file ) {
				if ($file == '.' || $file == '..') {
					continue;
				}
				if (is_dir($dirname.'/'.$file)) {
					$this->deleteDirectory($dirname.'/'.$file);
				} else {
					@unlink($dirname.'/'.$file);
				}
			}
		}
		return rmdir($dirname);
	}

	public function makeDirectory($dirname){
		return @mkdir($dirname);
	}

	public function makeFile($filename){
		if ($handle = fopen($filename, 'w')) {
			fclose($handle);
			return true;
		}
		return false;
	}

	public function filemtime ($filename) {
		return @filemtime($filename);
	}

	public function copyFile ($from, $to) {
		return @copy($from, $to);
	}

	public function copyDir ($src, $dst) {
		$dir = opendir($src);
		$result = @mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					$this->copyDir($src . '/' . $file, $dst . '/' . $file);
				}
				else {
					copy($src . '/' . $file,$dst . '/' . $file);
				}
			}
		}
		closedir($dir);
		return $result;
	}

	public function renameItem ($from, $to) {
		return @rename($from, $to);
	}

	public function readFile($filename){
		return file_get_contents($filename);
	}

	public function writefile($filename, $content){
		return @file_put_contents($filename, $content);
	}

	public function move_uploaded_file ($from, $to) {
		return @move_uploaded_file($from, $to);
	}
	
    public function parseImage($ext,$img,$file = null){
		$result = false;
		switch($ext){
			case 'png':
				$result = imagepng($img,($file != null ? $file : ''));
			break;
			case 'jpeg':
				$result = imagejpeg($img,($file ? $file : ''),90);
			break;
			case 'jpg':
				$result = imagejpeg($img,($file ? $file : ''),90);
			break;
			case 'gif':
				$result = imagegif($img,($file ? $file : ''));
			break;
		}
		return $result;
	}
	
	 public function imagecreatefrompng($src) {
	     return imagecreatefrompng($src);	
	 }
	 
	 public function imagecreatefromjpeg($src){
		 return imagecreatefromjpeg($src);
	 }
	 
	 public function imagecreatefromgif($src){
	 	 return imagecreatefromgif($src);
	 }
}

class GSFileManager {

	private $options;
	private $opt_param = 'opt';
	public static $root_param = 'rootDir';
	private $fileStorage;
	private $setUtf8Header = true;
	private $functions;

	public function __construct($fileStorage, $options){
		$this->fileStorage = $fileStorage;
		$this->options = $options;
		$this->functions = array();
		$this->functions[1] = 'listDir';
		$this->functions[2] = 'makeFile';
		$this->functions[3] = 'makeDirectory';
		$this->functions[4] = 'deleteItem';
		$this->functions[5] = 'copyItem';
		$this->functions[6] = 'renameItem';
		$this->functions[7] = 'moveItems';
		$this->functions[8] = 'downloadItem';
		$this->functions[9] = 'readfile';
		$this->functions[10] = 'writefile';
		$this->functions[11] = 'uploadfile';
		$this->functions[12] = 'jCropImage';
		$this->functions[13] = 'imageResize';
		$this->functions[14] = 'copyAsFile';
		$this->functions[15] = 'serveImage';
		$this->functions[16] = 'zipItem';
		$this->functions[17] = 'unZipItem';
	}

	public function getOptionValue ($key, $default = null) {
		$result = null;
		if (isset($this->options[$key])) {
			$result = $this->options[$key];
		} else if ($default === null) {
			$result = $default;
		}
		return $result;
	}

	public function getRequestFunction($index){
		$result = null;
		if (isset($this->functions[$index])) {
			$result = $this->functions[$index];
		}
		return $result;
	}
	
	public function process($args){
		if (!isset($args[$this->opt_param])) {
			$args[$this->opt_param] = 1;
		}
		$root = $this->getOptionValue(self::$root_param);
		if ($root == null) {
			throw new Exception('ConfigurationException: root can NOT be null', 1);
		}
		if (!isset($args['dir']) || empty($args['dir'])) {
			throw new Exception('ILlegalArgumentException: dir can NOT be null', 4);
		} else {
			$args['dir'] = $this->fixString($args['dir']);
			$args['dir'] = urldecode($args['dir']);
			$args['dir'] = html_entity_decode($args['dir'], ENT_QUOTES);
		}
	    if (isset($args['filename'])) {
	    	$path_parts = explode('/', urldecode($args['filename']));
			$args['filename'] = end($path_parts);
			$args['filename'] = $this->fixString($args['filename']);
			$args['filename'] = html_entity_decode($args['filename'], ENT_QUOTES, 'UTF-8');
			$this->checkFileName($args['filename']);
		}
	    if (isset($args['newfilename'])) {
			$path_parts2 = explode('/', urldecode($args['newfilename']));
			$args['newfilename'] = end($path_parts2);
			$args['newfilename'] = $this->fixString($args['newfilename']);
			$args['newfilename'] = html_entity_decode($args['newfilename'], ENT_QUOTES);
			$this->checkFileName($args['newfilename']);
		}
	    if (strpos($args['dir'], '..') !== false) {
			throw new Exception('ILlegalArgumentException: dir can NOT go up', 13);
		}
		$responce = '';
		$functionName = $this->getRequestFunction($args[$this->opt_param]);
        if ($functionName != null) {
        	$responce = $this->$functionName($args);
        } else {
			throw new Exception('ILlegalArgumentException: Uknown action '.$args[$this->opt_param], 6);
				
		}
		if ($this->setUtf8Header) {
			header ("Content-Type: text/html; charset=utf-8");
		}
		return $responce;
	}
    
	public function unZipItem($args){
		$root = $this->getOptionValue(self::$root_param);
		if (isset($args['filename'])) {
			$filename = $args['filename'];
			$dir = $args['dir'];
		    $newFileName = 'unzipped_'.$filename;
			if (isset($args['newfilename'])) {
				$newFileName = $args['newfilename'];
			}
			if ($this->fileStorage->file_exists($root.$dir.$filename)) {
				if (!$this->fileStorage->file_exists($root.$dir.basename($newFileName))) {
					$archive = new ZipArchive();
					if ($archive->open($root.$dir.$filename)){
						$archive->extractTo($root.$dir.basename($newFileName));
						$archive->close();
						return '{result: \'1\'}';
					} else {
						return '{result: \'0\'}';
					}
				} else {
					throw new Exception('ILlegalArgumentException: Destination already exists', 8);
				}
			} else {
				throw new Exception('ILlegalArgumentException: Source does NOT exists '.$dir.$filename, 7);
			}
			
		} else {
			throw new Exception('ILlegalArgumentException: filename can NOT be null', 5);
		}
	}
	
    public function zipItem($args) {
		$root = $this->getOptionValue(self::$root_param);
		if (isset($args['filename'])) {
			$filename = $args['filename'];
			$dir = $args['dir'];
			$newFileName = $filename.'.zip';
			if (isset($args['newfilename'])) {
				$newFileName = $args['newfilename'];
			}
			if ($this->fileStorage->file_exists($root.$dir.$filename)) {
				if (!$this->fileStorage->file_exists($root.$dir.basename($newFileName))) {
					$archive = new ZipArchive();
					$archive->open($root.$dir.$newFileName, ZIPARCHIVE::CREATE);
					$this->addFolderToZip($dir.$filename, $archive, $root, $filename);
					if ($archive->close()) {
					    return '{result: \'1\'}';
					}
					return '{result: \'0\'}';
				} else {
					throw new Exception('ILlegalArgumentException: Destination already exists', 8);
				}
			} else {
				throw new Exception('ILlegalArgumentException: Source does NOT exists '.$dir.$filename, 7);
			}
		} else {
			throw new Exception('ILlegalArgumentException: filename can NOT be null', 5);
		}
	}
	
	private function addFolderToZip($dir, $zipArchive, $root, $base){
	    if ($this->fileStorage->is_dir($root.$dir)) {
            //$zipArchive->addEmptyDir(basename($root.$dir));
            $files = $this->fileStorage->scandir($root.$dir);
            foreach ($files as $file) {
                if ($this->fileStorage->is_dir($root.$dir.'/'.$file)){
                    if (($file !== ".") && ($file !== "..")){
                        $this->addFolderToZip($dir.'/'.$file, $zipArchive, $root, $base.'/'.$file);
                    }
                } else {
                    $zipArchive->addFile($root.$dir.'/'.$file, $base.'/'.$file);
                }
            }	       
	    } else {
		   $zipArchive->addFile($root.$dir, basename($dir));
		}
	}

	public function serveImage($args) {
		if (isset($args['filename'])) {
			$root = $this->getOptionValue(self::$root_param);
			$filename = $args['filename'];
			$dir = $args['dir'];
			if ($this->fileStorage->file_exists($root.$dir.$filename)) {
				$src = $root.$dir.$filename;
				$content = $this->fileStorage->readFile($root.$dir.$filename);
				$ext = strtolower(end(explode('.', $src)));
				$this->setUtf8Header = false;
				header('Content-Type: image/'.$ext);
				return $content;
			} else {
				throw new Exception('ILlegalArgumentException: Source does NOT exists', 7);
			}
		} else {
			throw new Exception('ILlegalArgumentException: filename can NOT be null', 5);
		}
	}
	
	public function imageResize($args) {
		if (!extension_loaded('gd')) {
			throw new Exception('ServerException: extention NOT loaded ', 12);
		}
		if (isset($args['filename'])) {
			$root = $this->getOptionValue(self::$root_param);
			$dir = $args['dir'];
			if ($this->fileStorage->file_exists($root.$dir.$args['filename'])) {
				$src = $root.$dir.$args['filename'];
				$image_info = getimagesize($src);
				$ext = strtolower(end(explode('.', $src)));
				$new_w = $args['new_x'];
				$new_h = $args['new_y'];
				$jpeg_quality = 90;
				$function = $this->returnCorrectFunction($ext);
			    if (empty($function)) {
					throw new Exception('ILlegalArgumentException: Image can not be recognized', 15);
				}
				$img_r = $this->fileStorage->$function($src);
				$new_image = imagecreatetruecolor($new_w, $new_h);
				imagecopyresampled($new_image, $img_r, 0, 0, 0, 0, $new_w, $new_h, $image_info[0], $image_info[1]);
			    $result = $this->fileStorage->parseImage($ext, $new_image, $src);
			    imagedestroy($new_image);
				if ($result) {
					return '{result: \'1\'}';
				} else {
					return '{result: \'0\'}';
				}
			} else {
				throw new Exception('ILlegalArgumentException: Source does NOT exists', 7);
			}
		} else {
			throw new Exception('ILlegalArgumentException: filename can NOT be null', 5);
		}
	}
	public function jCropImage($args) {
		if (!extension_loaded('gd')) {
			throw new Exception('ServerException: extention NOT loaded ', 12);
		}
		if (isset($args['filename'])) {
			$root = $this->getOptionValue(self::$root_param);
			$dir = $args['dir'];
			if ($this->fileStorage->file_exists($root.$dir.$args['filename'])) {				
				$src = $root.$dir.$args['filename'];
				$ext = strToLower(end(explode('.', $src)));
	
				$targ_w = $args['gs_jcrop_w'];
				$targ_h = $args['gs_jcrop_h'];
			
				$function = $this->returnCorrectFunction($ext);
				if (empty($function)) {
					throw new Exception('ILlegalArgumentException: Image can not be recognized', 15);
				}
				$img_r = $this->fileStorage->$function($src);
				$dst_r = imagecreatetruecolor( $targ_w, $targ_h );
			
				imagecopyresampled($dst_r,$img_r, 0, 0,$args['gs_jcrop_x'],$args['gs_jcrop_y'],
				$targ_w, $targ_h, $args['gs_jcrop_w'],$args['gs_jcrop_h']);
	
			    $result = $this->fileStorage->parseImage($ext,$dst_r, $src);
			    imagedestroy($dst_r);
				if ($result) {
					return '{result: \'1\'}';
				} else {
					return '{result: \'0\'}';
				}
			} else {
				throw new Exception('ILlegalArgumentException: Source does NOT exists', 7);
			}
		} else {
			throw new Exception('ILlegalArgumentException: filename can NOT be null', 5);
		}
	}

	public function returnCorrectFunction($ext){
		$function = '';
		switch($ext){
			case 'png':
				$function = 'imagecreatefrompng';
				break;
			case 'jpeg':
				$function = 'imagecreatefromjpeg';
				break;
			case 'jpg':
				$function = 'imagecreatefromjpeg';
				break;
			case 'gif':
				$function = 'imagecreatefromgif';
				break;
		}
		return $function;
	}

	public function uploadfile($args) {
		$root = $this->getOptionValue(self::$root_param);
		$dir = $args['dir'];
		if (empty($_FILES)) {
			throw new Exception('ILlegalArgumentException: no files for upload', 11);
		}
		$maxSize = $this->getOptionValue('max_upload_filesize', 0);
		$responce = '{result: \'0\'}';
		
		/*if (!is_writable($root.$dir)) 
		{
			$user_name = "root";
			chown($root.$dir, $user_name);
		}*/
		if (is_writable($root.$dir)) 
		{
			foreach ($_FILES as $file) {
				$updatedFileName = preg_replace('/[^A-Za-z0-9\.-]/', '_',str_replace(' ', '_', $file['name']));
				if (!$this->fileStorage->file_exists($root.$dir.$updatedFileName)) {
					if ($maxSize > 0 && $maxSize < intval($file['size']) / 1000) {
						throw new Exception('ILlegalArgumentException: File to large '.$updatedFileName, 14);
					}
					$this->checkFileName($updatedFileName);
					if ($this->fileStorage->move_uploaded_file($file['tmp_name'], $root.$dir.$updatedFileName)){
						$responce = '{result: \'1\'}';
					}
				} else {
					throw new Exception('ILlegalArgumentException: Destination already exists '.$updatedFileName, 8);
				}
			}
		}else {
			throw new Exception('ILlegalArgumentException: Destination directory is not writable '.$dir, 8);
		}
		return $responce;
	}
    
	public function copyAsFile($args){
		if (isset($args['filename'])) {
			$root = $this->getOptionValue(self::$root_param);
			$dir = $args['dir'];
			if ($this->fileStorage->file_exists($root.$dir.$args['filename'])) {
				$newFilename = 'copy of '.$args['filename'];
				if (isset($args['newfilename']) && strlen($args['newfilename']) > 0 ) {
					$newFilename = $args['newfilename'];
				}
				if (!$this->fileStorage->file_exists($root.$dir.$newFilename)) {
					$content = $this->fileStorage->readFile($root.$dir.$args['filename']);
					if ($this->fileStorage->writefile($root.$dir.$newFilename, $content) !== false){
						return '{result: \'1\'}';
					}
					return '{result: \'0\', gserror: \'Can NOT copy '.addslashes($dir.$newFilename).'\'}';
				}else {
				    throw new Exception('ILlegalArgumentException: Destination already exists '.$dir.$newFilename, 8);
			    }
			} else {
				throw new Exception('ILlegalArgumentException: Source does NOT exists', 7);
			}
		} else {
			throw new Exception('ILlegalArgumentException: filename can NOT be null', 5);
		}
	}
	
	public function writefile($args) {
		$root = $this->getOptionValue(self::$root_param);
		if (isset($args['filename'])) {
			$content = '';
			if (isset($args['filenContent'])) {
				$content = $args['filenContent'];
			}
			$filename = $args['filename'];
			$dir = $args['dir'];
			if ($this->fileStorage->file_exists($root.$dir.$filename)) {
				if($this->fileStorage->writefile($root.$dir.$filename, $this->fixString($content)) !== false){
					return '{result: \'1\'}';
				}
				return '{result: \'0\', gserror: \'Can NOT copy '.addslashes($dir.$filename).'\'}';
			} else {
				throw new Exception('ILlegalArgumentException: Source does NOT exists', 7);
			}
		} else {
			throw new Exception('ILlegalArgumentException: filename can NOT be null', 5);
		}
	}

	public function readfile($args) {
		$root = $this->getOptionValue(self::$root_param);
		if (isset($args['filename'])) {
			$filename = $args['filename'];
			$dir = $args['dir'];
			if ($this->fileStorage->file_exists($root.$dir.$filename)) {
				$content = $this->fileStorage->readFile($root.$dir.$filename);
				if (isset($args['base64_encode']) && $args['base64_encode'] == 1) {
					$content = base64_encode($content);
				}
				return $content;
			} else {
				throw new Exception('ILlegalArgumentException: Source does NOT exists '.$filename, 7);
			}
		} else {
			throw new Exception('ILlegalArgumentException: filename can NOT be null', 5);
		}
	}

	public function downloadItem($args) {
		$root = $this->getOptionValue(self::$root_param);
		if (isset($args['filename'])) {
			$filename = $args['filename'];
			$dir = $args['dir'];
			if ($this->fileStorage->file_exists($root.$dir.$filename)) {
				$content = $this->fileStorage->readFile($root.$dir.$filename);
				header('Content-Description: Download File: '.$filename);
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'.$filename.'"');
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . strlen($content));
				echo $content;
				exit;
			} else {
				throw new Exception('ILlegalArgumentException: Source does NOT exists', 7);
			}
		} else {
			throw new Exception('ILlegalArgumentException: filename can NOT be null', 5);
		}
	}

	public function moveItems($args) {
		$root = $this->getOptionValue(self::$root_param);
		if (isset($args['files'])) {
			$files = explode(',,,', urldecode($args['files']));
			$dir = $args['dir'];
			$responce = '{result: \'0\'}';
			foreach ($files as $filename) {
				$filename = urldecode($filename);
				$filename = html_entity_decode($filename, ENT_QUOTES);
				$filename = $this->fixString($filename);
			    if (strpos($filename, '..') !== false) {
					throw new Exception('ILlegalArgumentException: dir can NOT go up', 13);
				}
				$this->checkFileName($filename);
				if ($this->fileStorage->file_exists($root.$filename)) {
					if (!$this->fileStorage->file_exists($root.$dir.basename($filename))) {
						if ($this->fileStorage->renameItem($root.$filename, $root.$dir.basename($filename))) {
							$responce = '{result: \'1\'}';
						}
					} else {
						throw new Exception('ILlegalArgumentException: Destination already exists '.$filename, 8);
					}
				} else {
					throw new Exception('ILlegalArgumentException: Source does NOT exists '.$filename, 7);
				}
			}
			return $responce;
		} else {
			throw new Exception('ILlegalArgumentException: files can NOT be null', 5);
		}
	}

	public function renameItem($args) {
		$root = $this->getOptionValue(self::$root_param);
		if (isset($args['filename'])) {
			$filename = $args['filename'];
			$dir = $args['dir'];
			$newFileName = $filename;
			if (isset($args['newfilename'])) {
				$newFileName = $args['newfilename'];
			}
			$newFileName = $this->fixString($newFileName);
			if ($this->fileStorage->file_exists($root.$dir.$filename)) {
				if (!$this->fileStorage->file_exists($root.$dir.$newFileName)) {
					if ($this->fileStorage->renameItem($root.$dir.$filename, $root.$dir.$newFileName)) {
						return '{result: \'1\'}';
					}
					return '{result: \'0\' , gserror: \'can not rename item '.addslashes($dir.$filename).' to '.addslashes($dir.$newFileName).'\'}';
				} else {
					throw new Exception('ILlegalArgumentException: Destination already exists', 8);
				}
			} else {
				throw new Exception('ILlegalArgumentException: Source does NOT exists '.$dir.$filename, 7);
			}
		} else {
			throw new Exception('ILlegalArgumentException: files can NOT be null', 5);
		}
	}

	public function copyItem($args) {
		$root = $this->getOptionValue(self::$root_param);
		if (isset($args['files'])) {
			$files = explode(',,,', urldecode($args['files']));
			$dir = $args['dir'];
			$responce = '{result: \'0\'}';
			foreach ($files as $filename) {
			    $filename = urldecode($filename);
			    $filename = html_entity_decode($filename, ENT_QUOTES);
			    $filename = $this->fixString($filename);
				if (strpos($filename, '..') !== false) {
					throw new Exception('ILlegalArgumentException: dir can NOT go up', 13);
				}
				$this->checkFileName($filename);
				if ($this->fileStorage->file_exists($root.$filename)) {
					if (!$this->fileStorage->file_exists($root.$dir.basename($filename))) {
						if (!is_dir($root.$filename)) {
							if ($this->fileStorage->copyFile($root.$filename, $root.$dir.basename($filename))) {
								$responce = '{result: \'1\'}';
							}
						} else if ($this->fileStorage->copyDir($root.$filename, $root.$dir.basename($filename))){
							$responce = '{result: \'1\'}';
						}
					} else {
						throw new Exception('ILlegalArgumentException: Destination already exists '.$filename, 8);
					}
				} else {
					throw new Exception('ILlegalArgumentException: Source does NOT exists '.$filename, 7);
				}
			}
			return $responce;
		} else {
			throw new Exception('ILlegalArgumentException: filename can NOT be null', 5);
		}
	}

	public function deleteItem($args) {
		$root = $this->getOptionValue(self::$root_param);
		if (isset($args['files'])) {
			$files = explode(',,,', urldecode($args['files']));
			$dir = $args['dir'];
			$responce = '{result: \'1\'}';
			foreach ($files as $filename) {
				$path_parts2 = explode('/', $filename);
			    $filename = end($path_parts2);
				$filename = html_entity_decode($filename, ENT_QUOTES);
				$filename = $this->fixString($filename);
				$this->checkFileName($filename);
				if ($this->fileStorage->file_exists($root.$dir.$filename)) {
					if ($this->fileStorage->is_dir($root.$dir.$filename)) {
						if (!$this->fileStorage->deleteDirectory($root.$dir.$filename)) {
							throw new Exception('ServerException: can NOT delete dir '.$dir.$filename, 9);
						}
					} else {
						if (!$this->fileStorage->deleteFile($root.$dir.$filename)) {
							throw new Exception('ServerException: can NOT delete file '.$dir.$filename, 9);
						}
					}
				} else {
					throw new Exception('ILlegalArgumentException: Source does NOT exists '.$dir.$filename, 7);
				}
			}
			return $responce;
		} else {
			throw new Exception('ILlegalArgumentException: files can NOT be null', 5);
		}
	}

	public function makeFile($args) {
		$root = $this->getOptionValue(self::$root_param);
		$dir = $args['dir'];
		if (isset($args['filename'])) {
			$filename = $args['filename'];
		} else {
			$filename = 'newfile_'.time().'.txt';
		}
		if (!$this->fileStorage->file_exists($root.$dir.$filename)) {
			if ($this->fileStorage->makeFile($root.$dir.$filename)) {
				return '{result: \'1\'}';
			}
			return '{result: \'0\' , gserror: \'can not create item '.addslashes($dir.$filename).'\'}';
		} else {
			throw new Exception('ILlegalArgumentException: Destination already exists', 8);
		}
		return '{result: \'0\'}';
	}

	public function makeDirectory($args) {
		$root = $this->getOptionValue(self::$root_param);
		$dir = $args['dir'];
		if (isset($args['filename'])) {
			$filename = $args['filename'];
		} else {
			$filename = 'new folder_'.time();
		}
		if ($this->fileStorage->file_exists($root.$dir.$filename) || $this->fileStorage->makeDirectory($root.$dir.$filename)) {
			return '{result: \'1\'}';
		}
		return '{result: \'0\'}';
	}

	public function listDir($args) {
		$root = $this->getOptionValue(self::$root_param);
		$dir = $args['dir'];
		if( $this->fileStorage->file_exists($root.$dir) ) {
			$files = $this->fileStorage->scandir($root.$dir);
			natcasesort($files);
			$html = '';
			$html .= 'var gsdirs = new Array();';
			$html .= 'var gsfiles = new Array();';
			$dirs = array();
			if( count($files) > 2 ) { /* The 2 accounts for . and .. */
				foreach( $files as $file ) {
					if ($file == '.' || $file == '..' || $file == '.htaccess') {
						continue;
					}
					if( !$this->fileStorage->is_dir($root.$dir.$file) ) {
						$ext = preg_replace('/^.*\./', '', $file);
						if ($ext == $file) {
							$ext = 'unknown';
						}
						$html .= 'gsfiles.push(new gsItem("1", "'.htmlentities($file, ENT_QUOTES, 'UTF-8').'", "'.htmlentities($dir.$file, ENT_QUOTES, 'UTF-8').'", "'.$this->fileStorage->filesize($root.$dir.$file).'", "'.md5($dir.$file).'", "'.strtolower($ext).'", "'.date('Y-m-d H:i:s', $this->fileStorage->filemtime($root.$dir.$file)).'"));';
					} else if ( $file != '.' && $file != '..' ) {
						$html .= 'gsdirs.push(new gsItem("2", "'.htmlentities($file, ENT_QUOTES, 'UTF-8').'", "'.htmlentities($dir.$file, ENT_QUOTES, 'UTF-8').'", "0", "'.md5($dir.$file).'", "dir", "'.date('Y-m-d H:i:s', $this->fileStorage->filemtime($root.$dir.$file)).'"));';
					}
				}

			}
			return $html;
		} else {
			throw new Exception('ILlegalArgumentException: dir to list does NOT exists '.$dir, 3);
		}
	}
    
	public function checkFileName($filename){
		if ($filename == '.htaccess') {
			throw new Exception('ILlegalArgumentException: Source does NOT exists '.$filename, 7);
		}
	}
	
	function fixString($String){
		if (get_magic_quotes_gpc() or get_magic_quotes_runtime()) {
			return stripcslashes($String);
		}
		return $String;
	}
}

?>