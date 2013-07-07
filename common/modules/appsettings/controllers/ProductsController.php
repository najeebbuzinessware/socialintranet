<?php

class ProductsController extends MemberController
{
	
	public function actionIndex()
	{
		$this->_checkAuth();	
						
		$model = new TblProductCatalog;
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		if(isset($_POST['TblProductCatalog']))
		{
			$this->actionAddProduct($_POST);	
		}
		
		$criteria = new CDbCriteria;
		$criteria->select = " LEFT(Name, 1 ) AS PName";
		$criteria->condition = "MId = '".Yii::app()->user->MId."' AND CType = '".$_GET['type']."'";
		$criteria->order = "PName ASC";
		$criteria->group = "PName";
		$total = TblProductCatalog::model()->count($criteria);
		
		$pages = new CPagination($total);
		$pages->pageSize = 5;
		$pages->applyLimit($criteria);
		$productmodel = TblProductCatalog::model()->findAll($criteria);
		
		$alphacriteria = new CDbCriteria;
		$alphacriteria->select = " LEFT(Name, 1 ) AS PName";
		$alphacriteria->condition = "MId = '".Yii::app()->user->MId."' AND CType = '".$_GET['type']."'";
		$alphacriteria->group = "PName";
		$alphacriteria->order = "PName ASC";
		$alphasort = TblProductCatalog::model()->findAll($alphacriteria);
		
		$this->render('index',array("model"=>$model,"productmodel"=>$productmodel,"pages"=>$pages,"alphasort"=>$alphasort));
	}	
	
	public function actionAddProduct($post)
	{
		if(strlen($post['btnsave'])>0)
		{
			if(isset($post['TblProductCatalog']))
			{
				// if it is ajax validation request
				$model=new TblProductCatalog;
				//$model->attributes=$post['TblProductCatalog'];
				$model->Name=$_POST['TblProductCatalog']['Name'];
				$model->Gid=$_POST['TblProductCatalog']['Gid'];
				$model->Term=$_POST['TblProductCatalog']['Term'];
				$model->ProductHours=$_POST['TblProductCatalog']['ProductHours'];
				$model->Description=$_POST['TblProductCatalog']['Description'];
				$model->CType= $_GET['type'];
				$model->MId = Yii::app()->user->MId;
				$model->CreatedBy = Yii::app()->user->Id;
				$model->CreatedOn = time();

				// validate user input and redirect to the previous page if valid
				if($model->save())
				{
					Yii::app()->session['notice'] = Yii::t('translate','Product Created');
					Yii::app()->session['ntype'] = 'success';

				   //$this->redirect("/members/admin/products/index/type/".$_GET['type']);
					$this->redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
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
	
	public function actionEditProducts($id)
	{ 
		//Fetch Data from Accounts
		$this->_checkAuth();
		$model= TblProductCatalog::model()->findByPk($id);
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		if(strlen($_POST['btnsave'])>0)
		{
			if(isset($_POST['TblProductCatalog']))
			{
				// if it is ajax validation request
				$model->Name=$_POST['TblProductCatalog']['Name'];
				$model->Gid=$_POST['TblProductCatalog']['Gid'];
				$model->Term=$_POST['TblProductCatalog']['Term'];
				$model->ProductHours=$_POST['TblProductCatalog']['ProductHours'];
				$model->Description=$_POST['TblProductCatalog']['Description'];
				$model->MId = Yii::app()->user->MId;
				$model->CType= $_GET['type'];
				$model->ModifiedBy = Yii::app()->user->Id;
				$model->ModifiedOn = time();
		
				// validate user input and redirect to the previous page if valid
				if($model->save())
				{
					Yii::app()->session['notice'] = Yii::t('translate','Product Updated');
					Yii::app()->session['ntype'] = 'success';
								
					//$this->redirect("/members/admin/products/index/type/".$_GET['type']);
					$this->redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
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
		echo $this->renderpartial('appsettings.views.modals._editProducts',array("model"=>$model,),true,true);
		exit;
	}
	
	
	public function actionDeleteProducts($id)
	{
		$this->_checkAuth();
		$delete = TblProductCatalog::model()->deleteByPk($id);
		
		if($delete){
			$array = array("success"=>true);
			echo json_encode($array);
		}
		else{
			$array = array("success"=>false);
			echo json_encode($array);
		}
	}
	
	
}

?>