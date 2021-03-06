<?php
class AdminController extends MemberController
{
	/*
	 * Filter for the validation to check Admin user type
	 */
	public function filters( )
	{
		return array( array( 'common.filters.AdminUserAuthFilter' ) );
	}

	public function actionListUser( )
	{
		//$this->_checkAuth();
		$model = new TblSysUsers();
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'users-form')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		if (strlen( $_POST['btnsave'] ) > 0)
		{
			if (isset( $_POST['TblSysUsers'] ))
			{
				// if it is ajax validation request
				$model = new TblSysUsers();
				$model->attributes = $_POST['TblSysUsers'];
				$model->MId = Yii::app()->user->MId;
				$model->WeightageId = $_POST['TblSysUsers']['WeightageId'];
				// validate user input and redirect to the previous page if valid
				if ($model->save())
				{
					// Update TblAuth Assignment
					if (count( $_POST['groups'] ) > 0)
					{
						foreach ( $_POST['groups'] as $key => $value )
						{
							$moduleaccess = new TblSysAuthAssignment();
							$moduleaccess->itemname = $value;
							$moduleaccess->MId = Yii::app()->user->MId;
							$moduleaccess->userid = $model->Userid;
							$moduleaccess->save();
						}
						// Update User Menu Cache
						//$this->UserModuleCache( $model->Userid, Yii::app()->user->MId );
					}
					Yii::app()->session['notice'] = Yii::t( 'translate', 'User Created' );
					Yii::app()->session['ntype'] = 'success';
					$this->redirect( "/admin/listUser" );
				} else
				{
					$msg = "<h1>Error</h1>";
					$msg .= sprintf( "Couldn't create model <b>%s</b>", $_GET['model'] );
					$msg .= "<ul>";
					foreach ( $model->errors as $attribute => $attr_errors )
					{
						$msg .= "<li>Attribute: $attribute</li>";
						$msg .= "<ul>";
						foreach ( $attr_errors as $attr_error )
							$msg .= "<li>$attr_error</li>";
						$msg .= "</ul>";
					}
					$msg .= "</ul>";
					$this->_sendResponse( 500, $msg );
				}
			}
		}
		$groupdata = TblSysAuthItem::model()->findAllByAttributes( array( 'MId' => Yii::app()->user->MId, 'type' => '2' ) );
		if (count( $groupdata ) > 0)
		{
			foreach ( $groupdata as $key => $value )
			{
				$group[$value['name']] = $value['name'];
			}
		}
		$criteria = new CDbCriteria();
		$criteria->select = " LEFT( Name, 1 ) AS username";
		$criteria->condition = "IsDelete=0 and MId = '" . Yii::app()->user->MId . "'";
		$criteria->order = "username ASC";
		$criteria->group = "username";
		$total = TblSysUsers::model()->count( $criteria );
		$pages = new CPagination( $total );
		$pages->pageSize = 5;
		$pages->applyLimit( $criteria );
		$usermodel = TblSysUsers::model()->findAll( $criteria );
		$alphacriteria = new CDbCriteria();
		$alphacriteria->select = " LEFT(Name, 1 ) AS username";
		$alphacriteria->condition = "IsDelete=0 and MId = '" . Yii::app()->user->MId . "'";
		$alphacriteria->group = "username";
		$alphacriteria->order = "username ASC";
		$alphasort = TblSysUsers::model()->findAll( $alphacriteria );
		$this->render( 'listUser', array( "model" => $model, "usermodel" => $usermodel, 'group' => $group, "pages" => $pages, "alphasort" => $alphasort ) );
	}

	public function actionCreateuser( )
	{
		$this->_checkAuth();
		// collect user input data
		$model = new TblSysUsers();
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'users-form')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		if (strlen( $_POST['btnsave'] ) > 0)
		{
			if (isset( $_POST['TblSysUsers'] ))
			{
				// if it is ajax validation request
				$model = new TblSysUsers();
				$model->attributes = $_POST['TblSysUsers'];
				$model->MId = Yii::app()->user->MId;
				// validate user input and redirect to the previous page if valid
				if ($model->save())
				{
					// Update TblAuth Assignment
					if (count( $_POST['groups'] ) > 0)
					{
						foreach ( $_POST['groups'] as $key => $value )
						{
							$moduleaccess = new TblSysAuthAssignment();
							$moduleaccess->itemname = $value;
							$moduleaccess->MId = Yii::app()->user->MId;
							$moduleaccess->userid = $model->Userid;
							$moduleaccess->save();
						}
						// Update User Menu Cache
						//$this->UserModuleCache( $model->Userid, Yii::app()->user->MId );
					}
					Yii::app()->session['notice'] = Yii::t( 'translate', 'User Created' );
					Yii::app()->session['ntype'] = 'success';
					$this->redirect( "/admin/listUser" );
				} else
				{
					$msg = "<h1>Error</h1>";
					$msg .= sprintf( "Couldn't create model <b>%s</b>", $_GET['model'] );
					$msg .= "<ul>";
					foreach ( $model->errors as $attribute => $attr_errors )
					{
						$msg .= "<li>Attribute: $attribute</li>";
						$msg .= "<ul>";
						foreach ( $attr_errors as $attr_error )
							$msg .= "<li>$attr_error</li>";
						$msg .= "</ul>";
					}
					$msg .= "</ul>";
					$this->_sendResponse( 500, $msg );
				}
			}
		}
		$groupdata = TblSysAuthItem::model()->findAllByAttributes( array( 'MId' => Yii::app()->user->MId, 'type' => '2' ) );
		foreach ( $groupdata as $key => $value )
		{
			$group[$value['name']] = $value['name'];
		}
		// $this->render("_createuser",array("model"=>$model,'group'=>$group));
	}

	public function actionUpdateuser($id = NULL)
	{
		$this->_checkAuth();
		if ($id == "")
		{
			$id = $_POST['TblSysUsers']['Userid'];
		}
		$criteria = new CDbCriteria( array( 'condition' => 'UserId = ' . $id . ' AND MId = ' . Yii::app()->user->MId ) );
		$model = TblSysUsers::model()->find( $criteria );
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'users-form')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		if (strlen( $_POST['btnsave'] ) > 0)
		{
			if (isset( $_POST['TblSysUsers'] ))
			{
				// if it is ajax validation request
				$model = TblSysUsers::model()->findByPk( $_POST['TblSysUsers']['Userid'] );
				$model->attributes = $_POST['TblSysUsers'];
				$model->ModifiedOn = time();
				$model->MId = Yii::app()->user->MId;
				// validate user input and redirect to the previous page if valid
				if ($model->save())
				{
					TblSysAuthAssignment::model()->deleteAllByAttributes( array( 'MId' => Yii::app()->user->MId, 'userid' => $_POST['TblUsers']['Userid'] ) );
					if (count( $_POST['groups'] ) > 0)
					{
						// Update TblAuth Assignment
						foreach ( $_POST['groups'] as $key => $value )
						{
							$moduleaccess = new TblSysAuthAssignment();
							$moduleaccess->itemname = $value;
							$moduleaccess->MId = Yii::app()->user->MId;
							$moduleaccess->userid = $model->Userid;
							$moduleaccess->save();
						}
						// Update User Menu Cache
						//$this->UserModuleCache( $_POST['TblUsers']['Userid'], Yii::app()->user->MId );
					}
					Yii::app()->session['notice'] = Yii::t( 'translate', 'User Updated' );
					Yii::app()->session['ntype'] = 'success';
					$this->redirect( "/admin/listUser" );
				}
			}
		}
		$groupdata = TblSysAuthItem::model()->findAllByAttributes( array( 'MId' => Yii::app()->user->MId, 'type' => '2' ) );
		foreach ( $groupdata as $key => $value )
		{
			$group[$value['name']] = $value['name'];
		}
		// Get User Assigned Group List
		$GroupList = TblSysAuthAssignment::model()->findAllByAttributes( array( 'MId' => Yii::app()->user->MId, 'userid' => $id ) );
		foreach ( $GroupList as $key => $value )
		{
			$AssignGroup[] = $value['itemname'];
		}
		$this->render( "_createuser", array( "model" => $model, 'group' => $group, 'groups' => $AssignGroup ) );
	}

	public function actionUpload( )
	{
		Yii::import( "common.extensions.EAjaxUpload.qqFileUploader" );
		//$folder = 'userData/uploads/'; // folder for uploaded files
		$folder=Yii::app()->params['filepath'].Yii::app()->user->MId."/";
		$allowedExtensions = array( "jpg", "jpeg", "gif", "png" ); // array("jpg","jpeg","gif","exe","mov" and etc...
		$sizeLimit =  10*1024*1024; // maximum file size in bytes
		$uploader = new qqFileUploader( $allowedExtensions, $sizeLimit );
		$result = $uploader->handleUpload( $folder, true );
		$result = htmlspecialchars( json_encode( $result ), ENT_NOQUOTES );
		echo $result; // it's array
	}

	public function UserModuleCache($userId , $MId)
	{
		$this->_checkAuth();
		// Get All Roles Assigned to a user
		$RolesData = TblSysAuthAssignment::model()->findAllByAttributes( array( 'userid' => $userId, 'MId' => $MId ) );
		if (count( $RolesData ) > 0)
		{
			foreach ( $RolesData as $x => $y )
			{
				// Get All Tasks Assigned against the Role
				$Sql = "Select * from tbl_sys_AuthItemChild Where parent = '" . $y->itemname . "' AND MId ='" . $MId . "' GROUP BY ModuleId";
				$TaskList = TblSysAuthItemChild::model()->findAllBySql( $Sql );
				foreach ( $TaskList as $key => $value )
				{
					$SubModule[] = $value->ModuleId;
				}
			}
		}
		// Generate SubModule Data
		if (count( $SubModule ) > 0)
		{
			foreach ( $SubModule as $x => $y )
			{
				$masterdata = TblSysMasterModules::model()->findByAttributes( array( 'ModuleId' => $y, 'MId' => $MId ) );
				$mdata = TblModules::model()->findByPk( $y );
				if (is_null( $masterdata ))
				{
					$modulename = $mdata->Module;
				} else
				{
					$modulename = $masterdata->Module;
				}
				$items[] = array( 'label' => $modulename, 'url' => array( '/' . $mdata->Link ), 'task' => $mdata->Task );
				$ParentModule[] = $mdata->Parent;
			}
		}
		if (! is_null( $items ))
		{
			$serialize = serialize( $items );
			$Model = TblSysUserCache::model()->findByAttributes( array( 'UserId' => $userId, 'CacheName' => 'SubMenu' ) );
			if (is_null( ($Model) ))
			{
				// Store the Data in Module Cache
				$Model = new TblSysUserCache();
			}
			// Storing the Data in ModuleCache Table
			$Model->Cache = $serialize;
			$Model->UserId = $userId;
			$Model->MId = $MId;
			$Model->CacheName = 'SubMenu';
			$Model->save();
		}
		// Get Main Module Against the Tasks
		$itemsTop = array();
		if (count( $ParentModule ) > 0)
		{
			foreach ( array_unique( $ParentModule ) as $key => $value )
			{
				$masterdata = TblSysMasterModules::model()->findByAttributes( array( 'ModuleId' => $value, 'MId' => $MId ) );
				$mdata = TblModules::model()->findByAttributes( array( 'ModuleId' => $value, 'Visible' => 'Yes' ) );
				if (is_null( $masterdata ))
				{
					$modulename = $mdata->Module;
				} else
				{
					$modulename = $masterdata->Module;
				}
				$itemsTop[] = array( 'label' => $modulename, 'url' => array( '//' . $mdata->Controller ), 'task' => $mdata->Task );
			}
		}
		if (! is_null( $itemsTop ))
		{
			$serial = serialize( $itemsTop );
			// Search if The Menu already avaialble
			$Model = TblSysUserCache::model()->findByAttributes( array( 'UserId' => $userId, 'CacheName' => 'TopMenu' ) );
			if (is_null( ($Model) ))
			{
				// Store the Data in Module Cache
				$Model = new TblSysUserCache();
			}
			// Storing the Data in ModuleCache Table
			$Model->Cache = $serial;
			$Model->UserId = $userId;
			$Model->MId = $MId;
			$Model->CacheName = 'TopMenu';
			$Model->save();
		}
		return true;
	}

	public function actionEditUser($id)
	{
		// Fetch Data from Accounts
		$this->_checkAuth();
		$model = TblSysUsers::model()->findByPk( $id );
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'users-form')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		if (strlen( $_POST['btnsave'] ) > 0)
		{
			if (isset( $_POST['TblSysUsers'] ))
			{
				// if it is ajax validation request
				$model->attributes = $_POST['TblSysUsers'];
				$model->MId = Yii::app()->user->MId;
				$model->WeightageId = $_POST['TblSysUsers']['WeightageId'];
				// validate user input and redirect to the previous page if valid
				if ($model->save())
				{
					// Update TblAuth Assignment
					if (count( $_POST['groups'] ) > 0)
					{
						TblSysAuthAssignment::model()->deleteAllByAttributes( array( 'MId' => Yii::app()->user->MId, 'userid' => $_POST['TblSysUsers']['Userid'] ) );
						foreach ( $_POST['groups'] as $key => $value )
						{
							$moduleaccess = new TblSysAuthAssignment();
							$moduleaccess->itemname = $value;
							$moduleaccess->MId = Yii::app()->user->MId;
							$moduleaccess->userid = $model->Userid;
							$moduleaccess->save();
						}
						// Update User Menu Cache
						//$this->UserModuleCache( $model->Userid, Yii::app()->user->MId );
					}
					Yii::app()->session['notice'] = Yii::t( 'translate', 'User Updated' );
					Yii::app()->session['ntype'] = 'success';
					$this->redirect( "/admin/listUser" );
				} else
				{
					$msg = "<h1>Error</h1>";
					$msg .= sprintf( "Couldn't create model <b>%s</b>", $_GET['model'] );
					$msg .= "<ul>";
					foreach ( $model->errors as $attribute => $attr_errors )
					{
						$msg .= "<li>Attribute: $attribute</li>";
						$msg .= "<ul>";
						foreach ( $attr_errors as $attr_error )
							$msg .= "<li>$attr_error</li>";
						$msg .= "</ul>";
					}
					$msg .= "</ul>";
					$this->_sendResponse( 500, $msg );
				}
			}
		}
		$groupdata = TblSysAuthItem::model()->findAllByAttributes( array( 'MId' => Yii::app()->user->MId, 'type' => '2' ) );
		foreach ( $groupdata as $key => $value )
		{
			$group[$value['name']] = $value['name'];
		}
		$GroupList = TblSysAuthAssignment::model()->findAllByAttributes( array( 'MId' => Yii::app()->user->MId, 'userid' => $id ) );
		foreach ( $GroupList as $key => $value )
		{
			$AssignGroup[] = $value['itemname'];
		}
		echo $this->renderpartial( 'application.views.admin.modals._editUser', array( "model" => $model, "group" => $group, "groups" => $AssignGroup ), true, true );
		exit();
	}

	public function actionListGroups( )
	{
		$this->_checkAuth();
		$model = new TblSysAuthItem();
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'groups-form')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		if (strlen( $_POST['btnsave'] ) > 0)
		{
			if (isset( $_POST['TblSysAuthItem'] ))
			{
				// if it is ajax validation request
				$model = new TblSysAuthItem();
				$model->attributes = $_POST['TblSysAuthItem'];
				$model->type = "2";
				$model->MId = Yii::app()->user->MId;
				// validate user input and redirect to the previous page if valid
				if ($model->save())
				{
					Yii::app()->session['notice'] = Yii::t( 'translate', 'Group Created' );
					Yii::app()->session['ntype'] = 'success';
					$this->redirect( "/admin/acl" );
				} else
				{
					$msg = "<h1>Error</h1>";
					$msg .= sprintf( "Couldn't create model <b>%s</b>", $_GET['model'] );
					$msg .= "<ul>";
					foreach ( $model->errors as $attribute => $attr_errors )
					{
						$msg .= "<li>Attribute: $attribute</li>";
						$msg .= "<ul>";
						foreach ( $attr_errors as $attr_error )
							$msg .= "<li>$attr_error</li>";
						$msg .= "</ul>";
					}
					$msg .= "</ul>";
					$this->_sendResponse( 500, $msg );
				}
			}
		}
		$criteria = new CDbCriteria();
		$criteria->select = " LEFT( name, 1 ) AS groupname";
		$criteria->condition = "type=2 and IsDelete=0 and MId = '" . Yii::app()->user->MId . "'";
		$criteria->order = "groupname ASC";
		$criteria->group = "groupname";
		$total = TblSysAuthItem::model()->count( $criteria );
		$pages = new CPagination( $total );
		$pages->pageSize = 5;
		$pages->applyLimit( $criteria );
		$groupmodel = TblSysAuthItem::model()->findAll( $criteria );
		$alphacriteria = new CDbCriteria();
		$alphacriteria->select = " LEFT( `name`, 1 ) AS `groupname`";
		$alphacriteria->condition = "IsDelete=0 and type=2 and MId='" . Yii::app()->user->MId . "'";
		$alphacriteria->group = "`groupname`";
		$alphacriteria->order = "`groupname` ASC";
		$alphasort = TblSysAuthItem::model()->findAll( $alphacriteria );
		$this->render( 'listGroups', array( "groupmodel" => $groupmodel, "model" => $model, "pages" => $pages, "alphasort" => $alphasort ) );
	}

	public function actionEditGroup($id)
	{
		// Fetch Data from Accounts
		$this->_checkAuth();
		$model = TblSysAuthItem::model()->findByPk( $id );
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'groups-form')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		if (strlen( $_POST['btnsave'] ) > 0)
		{
			if (isset( $_POST['TblSysAuthItem'] ))
			{
				// if it is ajax validation request
				$model->name = $_POST['TblSysAuthItem']['name'];
				$model->description = $_POST['TblSysAuthItem']['description'];
				$model->type = 2;
				$model->MId = Yii::app()->user->MId;
				// validate user input and redirect to the previous page if valid
				if ($model->save())
				{
					Yii::app()->session['notice'] = Yii::t( 'translate', 'Group Updated' );
					Yii::app()->session['ntype'] = 'success';
					$this->redirect( "/admin/listGroups" );
				} else
				{
					$msg = "<h1>Error</h1>";
					$msg .= sprintf( "Couldn't create model <b>%s</b>", $_GET['model'] );
					$msg .= "<ul>";
					foreach ( $model->errors as $attribute => $attr_errors )
					{
						$msg .= "<li>Attribute: $attribute</li>";
						$msg .= "<ul>";
						foreach ( $attr_errors as $attr_error )
							$msg .= "<li>$attr_error</li>";
						$msg .= "</ul>";
					}
					$msg .= "</ul>";
					$this->_sendResponse( 500, $msg );
				}
			}
		}
		echo $this->renderpartial( 'application.views.admin.modals._editGroup', array( "model" => $model ), true, true );
		exit();
	}

	public function actionDeleteUser($id)
	{
		$this->_checkAuth();
		$delete = BWCFunctions::deleteRecordsByPk( 'TblSysUsers', $id, 'Name' );
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

	public function actionDeleteGroup($id)
	{
		$this->_checkAuth();
		$delete = BWCFunctions::deleteRecordsByPk( 'TblSysAuthItem', $id, "name" );
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

	public function actionAcl( )
	{
		$this->_checkAuth();
		if (count( $_POST['groupname'] ) > 0)
		{
			foreach ( $_POST['configoption'] as $key => $valgroup )
			{
				TblSysAuthItemChild::model()->deleteAllByAttributes( array( 'parent' => $key, 'MId' => Yii::app()->user->MId ) );
				foreach ( $valgroup as $keygrp => $val )
				{
					// Add to tbl_sys_AuthItemChild
					if ($val == "Yes")
					{
						// Get ModuleId
						$Module = TblModuleTask::model()->findByAttributes( array( 'Task' => $keygrp ) );
						$child = new TblSysAuthItemChild();
						$child->parent = $key;
						$child->child = $keygrp;
						$child->ModuleId = $Module->ModuleId;
						$child->MId = Yii::app()->user->MId;
						$child->save();
						
						//Check if task listed in tbl_sys_AuthItem Table
						$AuthItem = TblSysAuthItem::model()->findByAttributes(array('name'=>$keygrp, 'MId' => Yii::app()->user->MId));
						if(is_null($AuthItem))
						{
							$AuthItem = new TblSysAuthItem();
							$AuthItem->name = $keygrp;
							$AuthItem->MId = Yii::app()->user->MId;
							$AuthItem->type = 0;
							$AuthItem->save();
						}
					}
				}
			}
		}
		$dataProvider = new CActiveDataProvider( 'TblSysAuthItem', array( 'criteria' => array( 'condition' => 'type=2 and IsDelete=0 and MId = ' . Yii::app()->user->MId ) ) );
		$this->render( "acl", array( "model" => $model, "dataProvider" => $dataProvider ) );
	}

	public function actionCustomization( )
	{
		$model = TblMaster::model()->findByPk( Yii::app()->user->MId );
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'frm-add-master')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		if (isset( $_POST['TblMaster'] ))
		{
			$model = TblMaster::model()->findByPk( Yii::app()->user->MId );
			$model->Company = $_POST['TblMaster']['Company'];
			$model->ContactNumber = $_POST['TblMaster']['ContactNumber'];
			$model->Background = $_POST['TblMaster']['Background'];
			$model->ZoomLevel = $_POST['TblMaster']['ZoomLevel'];
			if($_POST['TblMaster']['FrontendLogo']){
				$model->FrontendLogo = $_POST['TblMaster']['FrontendLogo'];
			}
			
			$file = CUploadedFile::getInstance( $model, 'FrontendLogo' );
			if (! is_null( $file ))
			{
				$model->FrontendLogo = CUploadedFile::getInstance( $model, 'FrontendLogo' );
				$filename = $model->FrontendLogo->getName();
			}
			if ($model->update())
			{
				
				if (! is_null( $file ))
				{
					$filename = $model->FrontendLogo->getName();
					$path = Yii::app()->params['documentPath'] . "uploads/" . $filename;
					$model->FrontendLogo->saveAs( $path );
				}
				$Master = TblMaster::model()->findByPk( $record->MId );
				if (strlen( $filename ) > 0)
				{
					Yii::app()->user->Logo = $filename;
				}
				Yii::app()->session['notice'] = Yii::t( 'translate', 'Customization Updated' );
				Yii::app()->session['ntype'] = 'success';
				$this->redirect( "/admin/customization" );
			}
		}
		$this->render( "customization", array( "model" => $model ) );
	}

	public function actionListDepartments( )
	{
		$this->_checkAuth();
		$model = new TblDepartments();
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'department-form')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		if (strlen( $_POST['btnsave'] ) > 0)
		{
			if (isset( $_POST['TblDepartments'] ))
			{
				// if it is ajax validation request
				$model = new TblDepartments();
				$model->attributes = $_POST['TblDepartments'];
				$model->MId = Yii::app()->user->MId;
				// validate user input and redirect to the previous page if valid
				if ($model->save())
				{
					Yii::app()->session['notice'] = Yii::t( 'translate', 'Department Created' );
					Yii::app()->session['ntype'] = 'success';
					$this->redirect( "/admin/listDepartments" );
				} else
				{
					$msg = "<h1>Error</h1>";
					$msg .= sprintf( "Couldn't create model <b>%s</b>", $_GET['model'] );
					$msg .= "<ul>";
					foreach ( $model->errors as $attribute => $attr_errors )
					{
						$msg .= "<li>Attribute: $attribute</li>";
						$msg .= "<ul>";
						foreach ( $attr_errors as $attr_error )
							$msg .= "<li>$attr_error</li>";
						$msg .= "</ul>";
					}
					$msg .= "</ul>";
					$this->_sendResponse( 500, $msg );
				}
			}
		}
		$criteria = new CDbCriteria();
		$criteria->select = " LEFT( Department, 1 ) AS Name";
		$criteria->condition = "IsDelete=0 and MId = '" . Yii::app()->user->MId . "'";
		$criteria->order = "Name ASC";
		$criteria->group = "Name";
		$total = TblDepartments::model()->count( $criteria );
		$pages = new CPagination( $total );
		$pages->pageSize = 5;
		$pages->applyLimit( $criteria );
		$departmodel = TblDepartments::model()->findAll( $criteria );
		$alphacriteria = new CDbCriteria();
		$alphacriteria->select = " LEFT(Department, 1 ) AS Name";
		$alphacriteria->condition = "IsDelete=0 and MId = '" . Yii::app()->user->MId . "'";
		$alphacriteria->group = "Name";
		$alphacriteria->order = "Name ASC";
		$alphasort = TblDepartments::model()->findAll( $alphacriteria );
		$this->render( 'listDepartments', array( "model" => $model, "departmodel" => $departmodel, 'group' => $group, "pages" => $pages, "alphasort" => $alphasort ) );
	}

	public function actionEditDepartment($id)
	{
		$this->_checkAuth();
		$model = TblDepartments::model()->findByPk( $id );
		if (isset( $_POST['ajax'] ) && $_POST['ajax'] === 'department-form')
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		if (strlen( $_POST['btnsave'] ) > 0)
		{
			if (isset( $_POST['TblDepartments'] ))
			{
				// if it is ajax validation request
				$model->attributes = $_POST['TblDepartments'];
				$model->MId = Yii::app()->user->MId;
				// validate user input and redirect to the previous page if valid
				if ($model->save())
				{
					Yii::app()->session['notice'] = Yii::t( 'translate', 'Department Updated' );
					Yii::app()->session['ntype'] = 'success';
					$this->redirect( "/admin/listDepartments" );
				} else
				{
					$msg = "<h1>Error</h1>";
					$msg .= sprintf( "Couldn't create model <b>%s</b>", $_GET['model'] );
					$msg .= "<ul>";
					foreach ( $model->errors as $attribute => $attr_errors )
					{
						$msg .= "<li>Attribute: $attribute</li>";
						$msg .= "<ul>";
						foreach ( $attr_errors as $attr_error )
							$msg .= "<li>$attr_error</li>";
						$msg .= "</ul>";
					}
					$msg .= "</ul>";
					$this->_sendResponse( 500, $msg );
				}
			}
		}
		echo $this->renderpartial( 'application.views.admin.modals._editDepartment', array( "model" => $model ), true, true );
		exit();
	}

	public function actionDeleteDepartment($id)
	{
		$this->_checkAuth();
		$delete = BWCFunctions::deleteRecordsByPk( 'TblDepartments', $id, 'Department' );
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
}
?>