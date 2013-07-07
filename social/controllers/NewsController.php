<?php

class NewsController extends MemberController
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
        $model=new TblNewsRss;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['TblNewsRss']))
        {
        	$criteria = new CDbCriteria();
        	$criteria->condition = "UserId=".Yii::app()->user->Id;
        	$delete=TblNewsRss::model()->deleteAll($criteria);
        	
            $model->attributes=$_POST['TblNewsRss'];
            $model->PublishDate = $post['TblNewsRss']['PublishDate'];
            $model->CreatedBy = Yii::app()->user->Id;
            $model->CreatedOn = date("Y-m-d H:i:s");
            $model->MId = Yii::app()->user->MId;
            if($model->save())
               // $this->redirect(array('view','id'=>$model->RssId));
            	Yii::app()->user->setFlash('success', '<strong>Well done!</strong> successfully news added.');
            	$this->redirect("/wall");
        }

        $this->render('create',array(
            'model'=>$model,
        ));
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
    			Yii::app()->user->setFlash('success', '<strong>Well done!</strong> successfully news added.');
    				
    			$this->redirect("/wall");
    		}
    	}
    
    
    }

    
    public function actionEditableLimit()
    {
    	$model = TblNewsRss::model()->findByPk($_POST['pk']);
    	//print_r($_POST);
    	if($_POST['name']=='NumberOfNews'){
    		$model->NumberOfNews = $_POST['value'];
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
        // $this->performAjaxValidation($model);

        if(isset($_POST['TblNewsRss']))
        {
           $model->attributes=$_POST['TblNewsRss'];
		   $model->PublishDate = $_POST['TblNewsRss']['PublishDate'];
 		   $model->ModifiedOn = time();
 		   $model->ModifiedBy = Yii::app()->user->Id;
		   $model->MId = Yii::app()->user->MId;
            if($model->save())
               // $this->redirect(array('view','id'=>$model->RssId));
            	Yii::app()->user->setFlash('success', '<strong>Well done!</strong> successfully news added.');
            	$this->redirect("/wall");
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
        $dataProvider=new CActiveDataProvider('TblNewsRss');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new TblNewsRss('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['TblNewsRss']))
            $model->attributes=$_GET['TblNewsRss'];

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
        $model=TblNewsRss::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-news-rss-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}