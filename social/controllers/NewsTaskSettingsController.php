<?php

class NewsTaskSettingsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	 public $layout = 'common.views.layouts.column2';

	/**
	 * @return array action filters
	 */
	
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
		$model=new TblSysNewsTaskSettings;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['TblSysNewsTaskSettings']))
		{
			$criteria = new CDbCriteria();
        	$criteria->condition = "CType='".$_POST['TblSysNewsTaskSettings']['CType']."' and UserId=".Yii::app()->user->Id." and MId=".Yii::app()->user->MId;
        	$delete=TblSysNewsTaskSettings::model()->deleteAll($criteria);
			
			$model->attributes=$_POST['TblSysNewsTaskSettings'];
			$model->UserId = Yii::app()->user->Id;
			$model->MId = Yii::app()->user->MId;
			$model->CreatedBy = Yii::app()->user->Id;
			$model->CreatedOn=time();
			
			if($model->save())
			{
				if($_GET['flg']=="1"){
					$this->redirect(Yii::app()->request->urlReferrer);
				}else{
					$this->redirect(array('view','id'=>$model->SetId));					
				}
			}
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblSysNewsTaskSettings']))
		{
			$model->attributes=$_POST['TblSysNewsTaskSettings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->SetId));
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
		$dataProvider=new CActiveDataProvider('TblSysNewsTaskSettings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TblSysNewsTaskSettings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblSysNewsTaskSettings']))
			$model->attributes=$_GET['TblSysNewsTaskSettings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TblSysNewsTaskSettings::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-sys-news-task-settings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
