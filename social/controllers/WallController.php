<?php

class WallController extends MemberController
{
		
	public $layout = 'common.views.layouts.column2';
	
	public function actionIndex()
	{
		//$this->_checkAuth('viewCompanyWall');
		//Yii::app()->user->checkAccess('viewCompanyWall');
		//echo Yii::getVersion();
		
		$newModel = new TblCollWall;
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='frmwallpost')
		{
			echo CActiveForm::validate($newModel);
			Yii::app()->end();
		}
		
		$criteria = new CDbCriteria();
		$criteria->join = " left JOIN tbl_Coll_Share as Ass ON Ass.RecordId = t.WallId "; //"t.MId = '".Yii::app()->user->MId."'";
		$criteria->condition = 't.MId = "'.Yii::app()->user->MId.'" and Ass.CType="Wall" and t.CType="Wall" and (Ass.SharedWith="'.Yii::app()->user->Id.'" || t.UserId='.Yii::app()->user->Id.')';
		$criteria->order = "WallId DESC";
		$total = TblCollWall::model()->count($criteria);
		$criteria->group = "Ass.RecordId";
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		$model = TblCollWall::model()->findAll($criteria);
		

		$usermodel = TblSysUsers::model()->findByPk(Yii::app()->user->Id);
			
		$this->render('index',array('newModel'=>$newModel,'model'=>$model,"pages"=>$pages,"usermod"=>$usermodel));
	}
	
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	public function actionMywall()
	{
		//$this->_checkAuth('mywall');
		Yii::app()->user->checkAccess('mywall');
		$newModel = new TblCollWall();
		
		$newModelComment = new TblCollComments();	
		
		$criteria = new CDbCriteria();
		//$criteria->join = " left JOIN tbl_Coll_Share as Ass ON Ass.RecordId = t.WallId "; //"t.MId = '".Yii::app()->user->MId."'";
		//$criteria->condition = 't.MId = "'.Yii::app()->user->MId.'" and Ass.CType="Wall" and t.CType="Wall" and (Ass.SharedWith="'.Yii::app()->user->Id.'" || t.UserId='.Yii::app()->user->Id.')';
		$criteria->condition = 'MId='.Yii::app()->user->MId.' and UserId='.Yii::app()->user->Id;
		$criteria->order = "WallId DESC";
		$total = TblCollWall::model()->count($criteria);
		$criteria->group = "Ass.RecordId";
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		$model = TblCollWall::model()->findAll($criteria);
		
		$usermodel = TblSysUsers::model()->findByPk(Yii::app()->user->Id);
		
		$this->render('index',array('newModel'=>$newModel,'newModelComment'=>$newModelComment,'model'=>$model,"pages"=>$pages,"usermod"=>$usermodel));
	}

	public function actionGroupwall($id)
	{
		//$this->_checkAuth('groupwall');
		Yii::app()->user->checkAccess('groupwall');
		$newModel = new TblCollWall();
		
		$newModelComment = new TblCollComments();	
		
		
		$criteria = new CDbCriteria();
		$criteria->join = " left JOIN tbl_Coll_Share as Ass ON t.WallId = Ass.RecordId"; //"t.MId = '".Yii::app()->user->MId."'";
		$criteria->condition = 't.GroupId='.$id.' and t.MId = "'.Yii::app()->user->MId.'" and Ass.CType="Group" and t.CType="Group" and (Ass.SharedWith="'.Yii::app()->user->Id.'" || t.UserId='.Yii::app()->user->Id.')';	
		
		//$criteria->condition = 'MId='.Yii::app()->user->MId.' and CType="Group"';
		$criteria->order = "WallId DESC";
		$total = TblCollWall::model()->count($criteria);
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		$model = TblCollWall::model()->findAll($criteria);
		
		$groupmodel = TblCollGroups::model()->findByPk($id);
		$usermodel = TblSysUsers::model()->findByPk(Yii::app()->user->Id);
		
		$this->render('index',array('newModel'=>$newModel,'newModelComment'=>$newModelComment,'model'=>$model,"pages"=>$pages,"groupmodel"=>$groupmodel,"usermodel"=>$usermodel));
	}
	
	public function actionShare()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'MId='.Yii::app()->user->MId.' and WallId='.$_GET['id'];
		$getmodel = TblCollWall::model()->find($criteria);
		if(count($getmodel)>0)
		{
			$model = new TblCollWall();
			$model->MId = Yii::app()->user->MId;
			$model->UserId = Yii::app()->user->Id;
			$model->GroupId = $getmodel['GroupId'];
			$model->WallPost = $getmodel['WallPost'];
			$model->CType =  $getmodel['CType'];
			$model->CreatedBy = Yii::app()->user->Id;
			$model->SharedFrom = $getmodel['CreatedBy'];
			$model->CreatedOn = date("Y-m-d H:i:s");
			if($model->save())
			{
				$array = array("success"=>true);
				echo json_encode($array);
			}
		}
		
	}
	
	public function actionLike()
	{
		if(isset($_GET['ftype']) && $_GET['ftype']=='comment'){	$ftype = 'comment';	}else{	$ftype = 'wall'; }
		$ctype = 'wall';
		$likecount = BWColFunctions::funcLike($ftype,$_GET['id'],Yii::app()->user->Id,$ctype);
		$array = array("success"=>true,"likecount"=>$likecount);
		echo json_encode($array);
	}
	
	
	public function actionUnlike()
	{
		if(isset($_GET['ftype']) && $_GET['ftype']=='comment'){	$ftype = 'comment';	}else{	$ftype = 'wall'; }
		$ctype = 'wall';
		$likecount = BWColFunctions::funcUnLike($ftype,$_GET['id'],Yii::app()->user->Id,$ctype);
		$array = array("success"=>true,"likecount"=>$likecount);
		echo json_encode($array);
	}
	
	public function actionWallpost()
	{	
		$newModel = new TblCollWall();
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='frmwallpost')
		{
			echo CActiveForm::validate($newModel);
			Yii::app()->end();
		}
		
		//print_r($_POST); exit;
		 
		$CType = 'Wall'; 
		
				
		$model = new TblCollWall();
		$model->MId = Yii::app()->user->MId;
		$model->UserId = Yii::app()->user->Id;
		/* if($_GET['id']){
			$model->GroupId = $_GET['id'];
		} */
		$model->WallPost = nl2br($_POST['TblCollWall']['WallPost']);
		$model->CType = $CType; 
		$model->CreatedBy = Yii::app()->user->Id;
		$model->CreatedOn = date("Y-m-d H:i:s");
		if($model->save())
		{ 
			
			$lastid = Yii::app()->db->getLastInsertId();
		//	if(count($_POST['ShareId'])>0){
				BWColFunctions::funcMultiShareData($lastid,$CType,$_POST['ShareId']);
			//}
			
			//BWColFunctions::funcAttachData($lastid,$CType,$_POST);
			
			$this->redirect($_SERVER['HTTP_REFERER']);
		}else{
			$msg = "<h1>Error</h1>";
			$msg .= sprintf("Couldn't create model <b>%s</b>", $_GET['model']);
			$msg .= "<ul>";
			foreach($model->errors as $attribute=>$attr_errors)
			{
			$msg .= "<li>Attribute: $attribute</li>";
			$msg .= "<ul>";
			
			foreach($attr_errors as $attr_error)
			$msg .= "<li>$attr_error</li>";
			
			$msg .= "</ul>";
			}
			
			$msg .= "</ul>";
			$this->_sendResponse(500,$msg );
		}
	}
	
	public function actionPostcomment()
	{	
		$newModelComment = new TblCollComments();
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='frmcomment')
		{
			echo CActiveForm::validate($newModelComment);
			Yii::app()->end();
		}
		/* print_r($_POST);
		exit; */
		if(count($_POST['comment'])>0)
		{
			
			$CType = 'Wall';
			
			
			foreach($_POST['comment'] as $key=>$val)
			{				
				$commentmod = new TblCollComments(); 
				$commentmod->WallId = $key;
				$commentmod->MId = Yii::app()->user->MId;
				$commentmod->UserId = Yii::app()->user->Id;
				$commentmod->Comment = nl2br($val);
				$commentmod->CType = 'Wall';
				$commentmod->CreatedBy = Yii::app()->user->Id;
				$commentmod->CreatedOn = date("Y-m-d H:i:s");
				if($commentmod->save())
				{
					$lastid = Yii::app()->db->getLastInsertId();
						
					$likecount = BWColFunctions::funcLike('comment',$lastid,Yii::app()->user->Id,$CType);
				//	BWColFunctions::funcAttachData($lastid,'comment',$_POST);
					$this->redirect('/wall');
				}else {
					$msg = "<h1>Error</h1>";
					$msg .= sprintf("Couldn't create model <b>%s</b>", $_GET['model']);
					$msg .= "<ul>";
					foreach($model->errors as $attribute=>$attr_errors)
					{
					$msg .= "<li>Attribute: $attribute</li>";
					$msg .= "<ul>";
					
					foreach($attr_errors as $attr_error)
					$msg .= "<li>$attr_error</li>";
					
					$msg .= "</ul>";
					}
					
					$msg .= "</ul>";
					$this->_sendResponse(500,$msg );
				}
			}
		}
	}
	
	public function actionLoadVideo()
	{		
		BWColFunctions::getYouTubeVideo($_POST['title']);
	}
}