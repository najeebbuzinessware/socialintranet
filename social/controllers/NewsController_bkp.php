<?php

class NewsController extends MemberController
{
 //Select the Layout
   public $layout = 'common.views.layouts.column2';

	public function actionIndex()
	{
			$model=new TblNews();
			 if(isset($_POST['ajax']) && $_POST['ajax']==='addNews-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
		
			if(isset($_POST['TblNews']))
			{
				$this->actionAddNews($_POST);	
			}
			
					
			$criteria = new CDbCriteria;
			$criteria->select = " LEFT( Title, 1 ) AS Name";
			$criteria->condition = "IsDelete=0 and MId = '".Yii::app()->user->MId."'";
			$criteria->order = "Name ASC";
			$criteria->group = "Name";
			//var_dump($criteria); exit;
	
			$total = TblNews::model()->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize = 5;
			$pages->applyLimit($criteria);
			$newsmodel = TblNews::model()->findAll($criteria);
			
		    //$usermodel= TblSysUsers::model()->findAll($criteria);
			
			$alphacriteria = new CDbCriteria;
			$alphacriteria->select = " LEFT( Title, 1 ) AS Name";
			$alphacriteria->condition = "IsDelete=0 and MId = '".Yii::app()->user->MId."'";
			$alphacriteria->group = "Name";
			$alphacriteria->order = "Name ASC";
			$alphasort = TblNews::model()->findAll($alphacriteria);
		 
		$this->render('index',array('newsmodel'=>$newsmodel,"alphasort"=>$alphasort,"model"=>$model,"pages"=>$pages,"rssmodel"=>$rssmodel));
		
	}
	
	public function actionAddNews($post)
	{ 
        $this->_checkAuth();
		//Fetch Data from Accounts

		$model=new TblNews;
				
		if(isset($post['ajax']) && $post['ajax']==='addNews-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}		
		
		if(isset($post['TblNews']))
		{	
		 	$model->attributes=$post['TblNews'];
			$model->PublishDate = $post['TblNews']['PublishDate'];
			$model->CreatedBy = Yii::app()->user->Id;
			$model->CreatedOn = date("Y-m-d H:i:s");
			$model->MId = Yii::app()->user->MId;
				 
					
				if($model->save())
				{
					 Yii::app()->session['notice'] = Yii::t('translate','News Saved');
			   	  	 Yii::app()->session['ntype'] = 'success';
				  
					$this->redirect("/members/news");
				}
			
		}
				
	}

	
	public function actionAddRss()
	{ 
        $this->_checkAuth();
		//Fetch Data from Accounts

		$model=new TblNewsRss;
				
		if(isset($_POST['ajax']) && $_POST['ajax']==='addRss-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}		
		
			
		if(count($_POST['TblNewsRss'])>0)
		{
			$criteria = new CDbCriteria();
			$criteria->condition = "UserId=".Yii::app()->user->Id;
			$delete=TblNewsRss::model()->deleteAll($criteria);
						
				$model=new TblNewsRss;
				$model->RssLink = $_POST['TblNewsRss']['RssLink'];
				$model->NumberOfNews = $_POST['TblNewsRss']['NumberOfNews'];
				$model->UserId = Yii::app()->user->Id;
				$model->CreatedBy = Yii::app()->user->Id;
				$model->CreateDate = date("Y-m-d H:i:s");
				$model->MId = Yii::app()->user->MId;
				$model->save();
				$lastid =Yii::app()->db->getLastInsertID(); 
			
			
			if($lastid>0){
				 Yii::app()->session['notice'] = Yii::t('translate','Rss News Saved');
				 Yii::app()->session['ntype'] = 'success';
				 
				$this->redirect("/wall");
			}
		}
		
				
	}


		public function actionDeleteNews($id)
		{
			
			$delete = BWCFunctions::deleteRecordsByPk('TblNews',$id,"Title");
			if($delete)
			{
				 Yii::app()->session['notice'] = Yii::t('translate','News Deleted');
			   	  	 Yii::app()->session['ntype'] = 'success';
			}else{
			   		 Yii::app()->session['notice'] = Yii::t('translate','News Delete Fail');
			   	  	 Yii::app()->session['ntype'] = 'failure';
			}
		}
		
		public function actionEditNews($id=NULL)
		{
			$this->_checkAuth();
			$model=TblNews::model()->findByPk($id);
			
			if(isset($_POST['ajax']) && $_POST['ajax']==='addNews-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}	
			
			if(isset($_POST['TblNews']))
			{ 
				// if it is ajax validation request
				
				$model->attributes=$_POST['TblNews'];
				$model->PublishDate = $_POST['TblNews']['PublishDate'];
 				$model->ModifiedOn = time();
 				$model->ModifiedBy = Yii::app()->user->Id;
				 
				$model->MId = Yii::app()->user->MId;
 				if($model->save())
				{
					 Yii::app()->session['notice'] = Yii::t('translate','News Updated');
			   	  	 Yii::app()->session['ntype'] = 'success';
					 
					$this->redirect("/members/news");
				}
			 
			}
			
			echo $this->renderpartial('application.views.common.modals._editNews',array("model"=>$model,));
		exit;
	}
	
	public function actionViewNews($id=NULL)
		{
			$this->_checkAuth();
			$model=TblNews::model()->findByPk($id);
			
			echo $this->renderpartial('application.views.common.modals._viewNews',array("model"=>$model,),true,true);
		exit;
	}
}