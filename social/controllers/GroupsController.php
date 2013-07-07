<?php

class GroupsController extends MemberController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='common.views.layouts.column2';


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TblCollGroups;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['TblCollGroups']))
		{
			$model->attributes=$_POST['TblCollGroups'];
			$model->Description =$_POST['TblCollGroups']['Description'];
			$model->UserId =Yii::app()->user->Id;
			if(strlen($_POST['hdnfilename'][0])>0){
				$model->Avatar = $_POST['hdnfilename'][0];
			}
			if($model->save())
				$this->redirect(array('view','id'=>$model->GrId));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['TblCollGroups']))
		{
			$model->attributes=$_POST['TblCollGroups'];
			$model->Description =$_POST['TblCollGroups']['Description'];
			$model->UserId =Yii::app()->user->Id;
			if(strlen($_POST['hdnfilename'][0])>0){
				$model->Avatar = $_POST['hdnfilename'][0];
			}
			if($model->save())
				$this->redirect(array('view','id'=>$model->GrId));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new TblCollGroups('search');
		$where = "";
		$and=" and ";
		if(strlen($_GET['TblCollGroups']['Description'])>0){ $where.=$and." Description like '%".$_GET['TblCollGroups']['Description']."%'"; $and=" and "; }
		if(strlen($_GET['TblCollGroups']['GroupName'])>0){ $where.=$and." GroupName like '%".$_GET['TblCollGroups']['GroupName']."%'"; $and=" and "; }
		
		/* $criteria = new CDbCriteria();
		$criteria->join = "LEFT JOIN tbl_Coll_Followers as Ass ON t.GrId = Ass.RecordId"; //"t.MId = '".Yii::app()->user->MId."'";
		$criteria->condition = "t.MId=".Yii::app()->user->MId." and ((t.UserId=".Yii::app()->user->Id.") or (Ass.FollowingBy=".Yii::app()->user->Id." and Ass.FollowingType='group'))";
		$criteria->group = 'Ass.RecordId'; */
		
		$dataProvider=new CActiveDataProvider('TblCollGroups',
				array('criteria'=>array(
						'join'=>"LEFT JOIN tbl_Coll_Followers as Ass ON t.GrId = Ass.RecordId",
						'condition'=>"t.MId=".Yii::app()->user->MId." and ((t.UserId=".Yii::app()->user->Id.") or 
							(Ass.FollowingBy=".Yii::app()->user->Id." and Ass.FollowingType='group'))".$where,
								
				))
		);		
						
		//$dataProvider=new CActiveDataProvider('TblCollGroups');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{		
		$model=new TblCollGroups('search');
		$where = "";
		$and=" and ";
		if(strlen($_GET['TblCollGroups']['Description'])>0){ $where.=$and." Description like '%".$_GET['TblCollGroups']['Description']."%'"; $and=" and "; }
		if(strlen($_GET['TblCollGroups']['GroupName'])>0){ $where.=$and." GroupName like '%".$_GET['TblCollGroups']['GroupName']."%'"; $and=" and "; }
		
		
		$dataProvider=new CActiveDataProvider('TblCollGroups',
				array('criteria'=>array(
						'condition'=>"MId=".Yii::app()->user->MId." and UserId=".Yii::app()->user->Id.$where,
		
				))
		);
		
		//if(isset($_GET['TblCollGroups']))
		//	$model->attributes=$_GET['TblCollGroups'];
		
		$this->render('admin',array(
			'dataProvider'=>$dataProvider,'model'=>$model
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TblCollGroups::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-coll-groups-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
