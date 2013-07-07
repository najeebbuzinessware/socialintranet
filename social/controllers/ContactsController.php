<?php

class ContactsController extends MemberController
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
		$model=new TblUserContacts;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['TblUserContacts']))
		{
			$model->attributes=$_POST['TblUserContacts'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ContactId));
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

		if(isset($_POST['TblUserContacts']))
		{
			$model->attributes=$_POST['TblUserContacts'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ContactId));
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
		/* $dataProvider=new CActiveDataProvider('TblUserContacts');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		)); */
		
		//print_r($_GET['TblTasks']);
		$model=new TblUserContacts('search');
		$model->unsetAttributes();  // clear any default values
		$where = "";
		$and=" and ";
		if(strlen($_GET['TblUserContacts']['TagId'])>0){ $where.=$and."TagId=".$_GET['TblUserContacts']['TagId']; $and=" and "; }
		if(strlen($_GET['TblUserContacts']['Name'])>0){ $where.=$and." Name like '%".$_GET['TblUserContacts']['Name']."%'"; $and=" and "; }
		if(strlen($_GET['TblUserContacts']['Company'])>0){ $where.=$and." Company like '%".$_GET['TblUserContacts']['Company']."%'"; $and=" and "; }
		if(strlen($_GET['TblUserContacts']['JobProfile'])>0){ $where.=$and." JobProfile like '%".$_GET['TblUserContacts']['JobProfile']."%'"; $and=" and "; }
		if(strlen($_GET['TblUserContacts']['Number'])>0){ $where.=$and." Number like '%".$_GET['TblUserContacts']['Number']."%'"; $and=" and "; }
		//echo $where;
		$dataProvider=new CActiveDataProvider('TblUserContacts',
				array('criteria'=>array(
						'condition'=>"CreatedBy=".Yii::app()->user->Id." and MId = '".Yii::app()->user->MId."'".$where,
						'order'=>"Name ASC",		
				))
		);
		
		
		$gridColumns = array(
				
				array(
						'name' => 'Name',
						'type' => 'html',
						'value' => '$data->Name." ".TblSysTags::model()->getTagNamefromId($data->TagId)."<br />".$data->JobProfile." ".$data->Company."<br />".$data->Email." ".$data->Number',
						'header'=>false,
				),
				
				array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=>'{update}{delete}',
						/* 'buttons'=>array(
								'update'=>array(
										'url'=>'#addContacts',									
									),
						), */
						
				),
		);
		
		$this->render('index',array(
				'dataProvider'=>$dataProvider,"gridColumns"=>$gridColumns,"model"=>$model
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TblUserContacts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblUserContacts']))
			$model->attributes=$_GET['TblUserContacts'];

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
		$model=TblUserContacts::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-user-contacts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
