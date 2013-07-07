<?php
class UserController extends MemberController
{

	public function actionProfile( )
	{
		$this->_checkAuth();
		// Fetch User Data
		$model = TblSysUsers::model()->findByPk( Yii::app()->user->Userid );
		if (isset( $_POST['TblSysUsers'] ))
		{
			Yii::app()->user->userAvatar = '';
			Yii::app()->user->setState('userAvatar', $_POST['TblSysUsers']['Avatar']);
			// if it is ajax validation request
			$model = TblSysUsers::model()->findByPk( Yii::app()->user->Id );
			$model->attributes = $_POST['TblSysUsers'];
			$model->Avatar = $_POST['TblSysUsers']['Avatar'];
			$model->PhoneNo = $_POST['TblSysUsers']['PhoneNo'];
			$model->Bio = $_POST['TblSysUsers']['Bio'];
			$model->Skills = $_POST['TblSysUsers']['Skills'];
			$model->Preferences = $_POST['TblSysUsers']['Preferences'];
			// validate user input and redirect to the previous page if valid
			if ($model->update())
			{
				
			} else
			{
				var_dump( $this->model->getErrors() );
			}
		}
		if (! is_null( $model ))
		{
			$this->render( 'profile', array( 'model' => $model ) );
		}
	}

	public function actionRecycle( )
	{
		$this->_checkAuth();
		$criteria = new CDbCriteria();
		$criteria->condition = "UserId =" . Yii::app()->user->Id . " and MId=" . Yii::app()->user->MId;
		$total = TblRecycleBin::model()->count( $criteria );
		$pages = new CPagination( $total );
		$pages->pageSize = Yii::app()->params['page_size'];
		$pages->applyLimit( $criteria );
		$model = TblRecycleBin::model()->findAll( $criteria );
		$alphacriteria = new CDbCriteria();
		$alphacriteria->select = "FieldName,TableName";
		$alphacriteria->condition = "UserID=" . Yii::app()->user->Id . " and MId = '" . Yii::app()->user->MId . "'";
		$alphacriteria->group = "TableName";
		$alphacriteria->order = "TableName ASC";
		$alphasort = TblRecycleBin::model()->findAll( $alphacriteria );
		$this->render( 'recycle', array( 'model' => $model, "pages" => $pages, "alphasort" => $alphasort ) );
	}

	public function actionPurge($id)
	{
		$this->_checkAuth();
		$delete = BWCFunctions::purgeRecordsByPk( $id );
		if ($delete)
		{
			$array = array( "success" => true );
			echo json_encode( $array );
		} else
		{
			$array = array( "success" => false );
			echo json_encode( $array );
		}
	}

	public function actionRestore($id)
	{
		$this->_checkAuth();
		$restore = BWCFunctions::restoreRecordsByPk( $id );
		if ($restore)
		{
			$array = array( "success" => true );
			echo json_encode( $array );
		} else
		{
			$array = array( "success" => false );
			echo json_encode( $array );
		}
	}

	public function actionFeedback( )
	{
		$this->_checkAuth();
		// Fetch Data from Accounts
		$usermodel = BWCFunctions::getRecordsByPk( "TblSysUsers", Yii::app()->user->Id );
		$model = new TblFeedback();
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'frm-add-feedback')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		if (strlen( $_POST['btnsave'] ) > 0)
		{
			if (isset( $_POST['TblFeedback'] ))
			{
				$model->attributes = $_POST['TblFeedback'];
				$model->CreatedBy = Yii::app()->user->Id;
				$model->CreatedDate = date( "Y-m-d H:i:s" );
				if ($model->save())
				{
					$message = new YiiMailMessage();
					$message->view = 'feedback';
					$message->setBody( array( 'model' => $model, "Name" => $_POST['TblFeedback']['Name'], "Email" => $_POST['TblFeedback']['Email'], "Comments" => $_POST['TblFeedback']['Comments'] ), 'text/html' );
					$message->subject = 'Intraware Feedback Mail';
					$message->addTo( "bugs@buzinessware.com" );
					$message->addCc( "anoop@bw.ae" );
					$message->from = Yii::app()->params['adminEmail'];
					Yii::app()->mail->send( $message );
					Yii::app()->session['notice'] = Yii::t( 'translate', 'Feedback Submitted' );
					Yii::app()->session['ntype'] = 'success';
					if (strlen( $_GET['rurl'] ) > 0)
					{
						$this->redirect( base64_decode( $_GET['rurl'] ) );
					} else
					{
						$this->redirect( "/members/user/profile" );
					}
					BWFunctions::bwRedirect( Yii::t( 'translate', 'Feedback Submitted' ), 'success' );
				} else
				{
					var_dump( $model->getErrors() );
					exit();
				}
			}
		}
	}

	public function actionUploadImage( )
	{
		Yii::import("common.extensions.EAjaxUpload.qqFileUploader");
		
		/*$folder = getenv("DOCUMENT_ROOT").'userData/uploads/'.Yii::app()->user->MId . "/users/"; // folder for uploaded files
		if (! file_exists( $folder ))
		{
			mkdir( $folder, 0777 );
		}*/

		if (!is_dir(getenv("DOCUMENT_ROOT").'/userData/'.Yii::app()->user->MId. '/users')) {
				mkdir(getenv("DOCUMENT_ROOT").'/userData/'.Yii::app()->user->MId. '/users');
			}
			
		$folder=getenv("DOCUMENT_ROOT").'/userData/'.Yii::app()->user->MId. '/users/';
			
		//Yii::import( "ext.EAjaxUpload.qqFileUploader" );
		$allowedExtensions = array( "jpg", "jpeg", "gif", "png" ); // array("jpg","jpeg","gif","exe","mov" and etc...
		$sizeLimit = 10 * 1024 * 1024; // maximum file size in bytes
		$uploader = new qqFileUploader( $allowedExtensions, $sizeLimit );
		$result = $uploader->handleUpload( $folder );
		$result = htmlspecialchars( json_encode( $result ), ENT_NOQUOTES );
		echo $result; // it's array
	}
}
?>