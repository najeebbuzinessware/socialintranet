<?php

class UserController extends MemberController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'common.views.layouts.column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            //'accessControl', // perform access control for CRUD operations
        );
    }

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
        $model=new TblSysUsers;

        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

        if(isset($_POST['TblSysUsers']))
        {
            $model->attributes=$_POST['TblSysUsers'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->Userid));
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
    public function actionUpdate()
    {
        $model=$this->loadModel(Yii::app()->user->Id);

        if(isset($_POST['TblSysUsers']))
        {
        	//print_r($_POST); exit;
        	//$rnd = rand(0,9999);
            $model->attributes=$_POST['TblSysUsers'];
            if(strlen($_POST['hdnfilename'][0])>0){
            	$model->Avatar = $_POST['hdnfilename'][0];
            }
           /*  $uploadedFile=CUploadedFile::getInstance($model,'Avatar');
            $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            $model->Avatar = $fileName; */
           
            if($model->save()) 
               	$this->redirect('/user/view/id/'.$model->Userid);
           
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
        $dataProvider=new CActiveDataProvider('TblSysUsers');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new TblSysUsers('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['TblSysUsers']))
            $model->attributes=$_GET['TblSysUsers'];

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
    	if($id<1){$id=Yii::app()->user->Id;}
        $model=TblSysUsers::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-sys-users-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionUpload()
    {
    
    	if(!file_exists(getenv("DOCUMENT_ROOT")."/uploads/logo".Yii::app()->user->MId))
    	{
    		mkdir(getenv("DOCUMENT_ROOT")."/uploads/logo".Yii::app()->user->MId, 0777);
    	}
    
    	$error = "";
    	$fileElementName = $_POST['file_element'];
    
    	$folder = getenv("DOCUMENT_ROOT").'/uploads/logo'.Yii::app()->user->MId.'/';
    
    
    	if(!empty($_FILES[$fileElementName]['error']))
    	{
    		switch($_FILES[$fileElementName]['error'])
    		{
    
    			case '1':
    				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
    				break;
    			case '2':
    				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
    				break;
    			case '3':
    				$error = 'The uploaded file was only partially uploaded';
    				break;
    			case '4':
    				$error = 'No file was uploaded.';
    				break;
    
    			case '6':
    				$error = 'Missing a temporary folder';
    				break;
    			case '7':
    				$error = 'Failed to write file to disk';
    				break;
    			case '8':
    				$error = 'File upload stopped by extension';
    				break;
    			case '999':
    			default:
    				$error = 'No error code avaiable';
    		}
    	}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
    	{
    		$error = 'No file was uploaded..';
    	}else
    	{
    		$rnd = rand(0,9999);
    		$fnam = $rnd."-".$_FILES[$fileElementName]['name'];
    		$path = $folder;
    		$size = @filesize($_FILES[$fileElementName]['tmp_name']);
    
    		//for security reason, we force to remove uploaded file
    		//Use move_uploaded_file($_FILES[$fileElementName]['tmp_name'], $destination) instead.
    		move_uploaded_file($_FILES[$fileElementName]['tmp_name'], $folder.$fnam);
    		@unlink($_FILES[$fileElementName]['tmp_name']);
    			
    	}
    
    	$res = new stdClass();
    		
    	$res->error = $error;
    	$res->filename = $fnam;
    	$res->path = $path;
    	$res->size = sprintf("%.2fMB", $size/1048576);
    	$res->dt = date('Y-m-d H:i:s');
    	echo json_encode($res);
    }
}