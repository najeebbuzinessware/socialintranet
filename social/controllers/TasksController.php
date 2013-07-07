<?php

class TasksController extends MemberController
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
		$model=new TblTasks;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['TblTasks']))
		{
			$model->attributes=$_POST['TblTasks'];
			$model->CreatedBy = Yii::app()->user->Id;
			$model->CreateDate = date("Y-m-d H:i:s");
			$model->MId = Yii::app()->user->MId;
			if($model->save())
				$this->redirect(array('view','id'=>$model->TaskId));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionAddTask()
	{
		
		$model=new TblTasks;
	
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-tasks-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	
			
		if(count($_POST['TblTasks'])>0)
		{	
			//print_r($_POST); exit;
			
			$model=new TblTasks;
			$model->Description = $_POST['TblTasks']['Description'];
			$model->TagId = $_POST['TblTasks']['TagId'];
			$model->AssignTo = $_POST['TblTasks']['AssignTo'];
			$model->DueDate = date("Y-m-d",strtotime($_POST['TblTasks']['DueDate']));
			$model->DueTime = $_POST['TblTasks']['DueTime'];
			$model->ShowToAll = $_POST['TblTasks']['ShowToAll'];;
			$model->CreatedBy = Yii::app()->user->Id;
			$model->CreateDate = date("Y-m-d H:i:s");
			$model->MId = Yii::app()->user->MId;
			$model->save();
			
			$lastid =Yii::app()->db->getLastInsertID();
								
			if($lastid>0){
				Yii::app()->user->setFlash('success', '<strong>Well done!</strong> successfully task added.');
    				
    			$this->redirect("/wall");
			}
		}
	
	
	}
	

	public function actionUpdateTask()
	{
		$model = TblTasks::model()->findByPk($_POST['pk']);
		//print_r($_POST);
		if($_POST['name']=='Description'){
			$model->Description = $_POST['value'];
		}
		
		if($_POST['name']=='TagId'){
			$model->TagId = $_POST['value'];
		}
		
		if($_POST['name']=='AssignTo'){
			$model->AssignTo = $_POST['value'];
		}
	
		if($model->update()){
			echo json_encode('success');
		}
		
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

		if(isset($_POST['TblTasks']))
		{
			$model->attributes=$_POST['TblTasks'];
			$model->CreatedBy = Yii::app()->user->Id;
			$model->CreateDate = date("Y-m-d H:i:s");
			$model->MId = Yii::app()->user->MId;
			if($model->save())
				$this->redirect(array('view','id'=>$model->TaskId));
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
		//print_r($_GET['TblTasks']);
		$model=new TblTasks('search');
		$where = "";
		$and=" and ";
		if(strlen($_GET['TblTasks']['TagId'])>0){ $where.=$and."TagId=".$_GET['TblTasks']['TagId']; $and=" and "; }
		if(strlen($_GET['TblTasks']['Description'])>0){ $where.=$and." Description like '%".$_GET['TblTasks']['Description']."%'"; $and=" and "; }
		if(strlen($_GET['TblTasks']['Status'])>0){ $where.=$and." Status='".$_GET['TblTasks']['Status']."'"; $and=" and "; }
		
		$dataProvider=new CActiveDataProvider('TblTasks',
				array('criteria'=>array(
					'condition'=>"(AssignTo=".Yii::app()->user->Id." or CreatedBy=".Yii::app()->user->Id." or ShowToAll=1) and MId = '".Yii::app()->user->MId."'".$where,					
					'order'=>"DueDate ASC",
						
				))
		);
		
		
		$gridColumns = array(
				array(
					'name'=>'TaskId',
					'type'=>'raw',
					'value'=>array($this,'gridTaskCheckBox')
				),
				array(
						'name' => 'TagId',
						'type' => 'html',
						'value' => 'TblSysTags::model()->getTagNamefromId($data->TagId)',
						'header'=>false,
				),
			array(
					'name' => 'Description',
					'type' => 'html',	
					'header'=>false,
			),
			//'DueDate',	
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=>'{update}{delete}',
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
		$model=new TblTasks('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblTasks']))
			$model->attributes=$_GET['TblTasks'];

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
		$model=TblTasks::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-tasks-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	protected function gridTaskCheckBox($data)
	{
		$status = false;
		$model = TblTasks::model()->findByPk($data->TaskId);
		if($model['Status']=='Completed')
		{$status = true;}
		
		$checkBox = CHtml::checkBox("TaskId[]",$status,array("id"=>"Task_$data->TaskId","value"=>"$data->TaskId","onclick"=>"updateStatus(this);"));
		return $checkBox;
	}
	
	public function actionUpdateStatus($taskId,$status)
	{
		$update = TblTasks::model()->updateByPk($taskId,array('Status'=>$status,));
		
		if($update)
		{$jsonarray = array('Success'=>true);}
		else
		{$jsonarray = array('Success'=>false);}
				
		echo json_encode($jsonarray);
	}
}
