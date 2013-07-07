<?php
Yii::import('common.vendors.GsFileManager');

class FileManagerController extends MemberController
{
	public $controllerType = 'website';
	public $layout='common.views.layouts.column2_bkp';
	
/* 	public function filters( )
	{
		return array(
				array( 'common.filters.UserAuthFilter' )
		);
	}
	
	public function init()
	{
		$this->_checkAuth( 'viewWebsiteCMS' );
	} */
	
	public function actionIndex()
	{
		$this->render('fileManager');
	}
	
	public function actionFileManager()
	{
		set_time_limit(0);
		error_reporting(E_ALL);
		ini_set('display_errors', true);
		mb_internal_encoding("UTF-8");
		
		$options = array();
		$options['max_upload_filesize'] = '2000'; //(the size in Kbytes)
		
		if(!file_exists(getenv("DOCUMENT_ROOT").'/uploads'))
			mkdir(getenv("DOCUMENT_ROOT").'/uploads', 0777);
		
		if(!file_exists(getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId))
			mkdir(getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId, 0777);
		
		if(!file_exists(getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId.'/'.Yii::app()->user->Id))
			mkdir(getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId.'/'.Yii::app()->user->Id, 0777);	
			
			
		$options[GsFileManager::$root_param] = getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId.'/'.Yii::app()->user->Id;
		$manager = new GSFileManager(new GSFileSystemFileStorage(), $options);
		try {
			$result = $manager->process($_REQUEST);
		} catch (Exception $e) {
			$result = '{result: \'0\', gserror: \''.addslashes($e->getMessage()).'\', code: \''.$e->getCode().'\'}';
		}
		echo $result;
	}
	public function actionGetUserList()
	{
		$this->widget('common.components.UserListWidget');
	}
	
	public function actionShareFile()
	{
		if(isset($_POST)){
			$filenames = explode(',',$_POST['filename']);
			$ShareIds = explode(',',$_POST['ShareIds']);
			$curDir = $_POST['curDir'];
			if(!empty($filenames)){
				foreach($filenames as $filename){
					if(strlen($filename)>0 && !empty($ShareIds)){
					
						foreach($ShareIds as $ShareId){
							
							if(!file_exists(getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId.'/'.$ShareId)){
								mkdir(getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId.'/'.$ShareId, 0777);	
							}
							
							if(!file_exists(getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId.'/'.$ShareId.$curDir)){
								mkdir(getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId.'/'.$ShareId.$curDir, 0777);	
							}

							$target = getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId.'/'.Yii::app()->user->Id.$curDir.$filename;
							$link = getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId.'/'.$ShareId.$curDir.$filename;

							if(file_exists($target) && !file_exists($link)){
								
								$model = new TblFileShare;
								$model->Userid = Yii::app()->user->Id;
								$model->SharedWith = $ShareId;
								$model->fileName = $filename;
								$model->filePath = $curDir;
								$model->CreatedBy = Yii::app()->user->Id;
								$model->CreatedOn = time();
								$model->MId = Yii::app()->user->MId;
								$model->save();
																															
								symlink($target, $link);
							}//file_exists
						}//foreach
					}//if strlen
				}//foreach
		  }//is empty	
		}//is post
	}
	
	public function actionIsLink()
	{
			
		if(isset($_POST)){
			$target = getenv("DOCUMENT_ROOT").'/uploads/'.Yii::app()->user->MId.'/'.Yii::app()->user->Id.$_POST['filename'];
			if(is_link($target)){
				
				echo json_encode(array('status'=>'link','id'=>$_POST['id']));
			}else{
				echo json_encode(array('status'=>'file','id'=>$_POST['id']));
			}
		}
	}
	
	public function actionDeleteFile()
	{
		$modelCount = 0;
		$jsonArray = array();
		if(isset($_POST)){			
			$filenames = explode(',',$_POST['filename']);			
			$curDir = $_POST['dir'];
			if(!empty($filenames)){				
				foreach($filenames as $filename){
					if(strlen($filename)>0){
						$criteria = new CDbCriteria();
						$criteria->condition = 'MId = '.Yii::app()->user->MId.' AND fileName = "'.$filename.'"  AND filePath = "'.$curDir.'"  AND (Userid = '.Yii::app()->user->Id.' OR SharedWith = '.Yii::app()->user->Id.')';
						$modelCount = TblFileShare::model()->count($criteria);
						
						if($modelCount>0)
						{$jsonArray[] = array('error'=>true,'msg'=>'Cannot Delete Shared Files...!!!','filename'=>$filename);}
						else
						{$jsonArray[] = array('error'=>false,'filename'=>$filename);}						
					}//if strlen					
				}//foreach
		  	}//is empty
		}
		
		echo json_encode($jsonArray);
	}
}

