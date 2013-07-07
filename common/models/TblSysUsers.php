<?php

/**
 * This is the model class for table "tbl_sys_Users".
 *
 * The followings are the available columns in table 'tbl_sys_Users':
 * @property integer $Userid
 * @property string $MId
 * @property string $Name
 * @property string $Nick
 * @property string $Email
 * @property string $Password
 * @property string $Avatar
 * @property string $TimeZone
 * @property string $Zoom
 * @property string $Language
 * @property string $UserInterface
 * @property integer $LastLogin
 * @property string $UserType
 * @property integer $WeightageId
 * @property integer $ReportTo
 * @property integer $CreatedOn
 * @property integer $CreatedBy
 * @property integer $ModifiedOn
 * @property integer $ModifiedBy
 * @property integer $DeleteOn
 * @property integer $DeleteBy
 * @property integer $LastViewedBy
 * @property integer $LastViewedOn
 *
 * The followings are the available model relations:
 * @property TblProjectAssignees[] $tblProjectAssignees
 * @property TblSysUserCache[] $tblSysUserCaches
 * @property TblSysMaster $m
 */
class TblSysUsers extends BWActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblSysUsers the static model class
     */
	public $username; 
	 
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function getModelName()
    {
    	return __CLASS__;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_sys_Users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name, Email, Password, ReportTo', 'required'),
			
			array('Name','compare','compareValue'=>Yii::t('translate','Your Full Name'),'operator'=>'!=','allowEmpty'=>false,'message'=>Yii::t('translate','Your Full Name')),
			array('Email','compare','compareValue'=>Yii::t('translate','Your Valid EmailID'),'operator'=>'!=','allowEmpty'=>false,'message'=>Yii::t('translate','Your Valid EmailID')),		
			 array('Email', 'email'),
			
			array('Password','compare','compareValue'=>Yii::t('translate','Enter Password'),'operator'=>'!=','allowEmpty'=>false,'message'=>Yii::t('translate','Enter Password')),	
			array('Nick','compare','compareValue'=>Yii::t('translate','Your Nick Name'),'operator'=>'!=','allowEmpty'=>false,'message'=>Yii::t('translate','Your Nick Name')),	
									
            array('Department, LastLogin, ReportTo, CreatedOn, CreatedBy, ModifiedOn, ModifiedBy, DeleteOn, DeleteBy, LastViewedBy, LastViewedOn', 'numerical', 'integerOnly'=>true),
            array('MId, UserInterface', 'length', 'max'=>10),
        	//array('Avatar', 'file', 'types'=>'jpg, gif, png'),
            array('Name, Nick, Email, Password, JobTitle, TimeZone', 'length', 'max'=>255),
			array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
			array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
        	array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
        	array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
            array('Zoom', 'length', 'max'=>25),
            array('Language', 'length', 'max'=>2),
            array('UserType', 'length', 'max'=>5),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Userid, MId, Name, Nick, Email, Password, Avatar, Department, JobTitle, TimeZone, Zoom, PhoneNo, Bio, Preferences, Language, UserInterface, LastLogin, UserType, ReportTo, CreatedOn, CreatedBy, ModifiedOn, ModifiedBy, DeleteOn, DeleteBy, LastViewedBy, LastViewedOn', 'safe', 'on'=>'search'),
            array('Userid, MId, Name, Nick, Email, Password, Avatar, Department, JobTitle, TimeZone, Zoom, PhoneNo, Bio, Preferences, Language, UserInterface, LastLogin, UserType, ReportTo, CreatedOn, CreatedBy, ModifiedOn, ModifiedBy, DeleteOn, DeleteBy, LastViewedBy, LastViewedOn', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tblProjectAssignees' => array(self::HAS_MANY, 'TblProjectAssignees', 'UserId'),
            'tblSysUserCaches' => array(self::HAS_MANY, 'TblSysUserCache', 'UserId'),
            'm' => array(self::BELONGS_TO, 'TblSysMaster', 'MId'),
			'tblTimesheet' => array(self::HAS_MANY, 'TblTimeSheet', 'CreatedBy'),
        	'tbldepartments' => array(self::BELONGS_TO, 'TblDepartments', 'Department'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'Userid' => 'Userid',
            'MId' => 'Mid',
            'Name' => 'Name',
            'Nick' => 'Nick',
            'Email' => 'Email',
            'Password' => 'Password',
            'Avatar' => 'Avatar',
			'Department' => 'Department',
            'JobTitle' => 'Job Title',
            'TimeZone' => 'Time Zone',
            'Zoom' => 'Zoom',
			'Preferences' => 'Preferences',
            'Language' => 'Language',
            'UserInterface' => 'User Interface',
            'LastLogin' => 'Last Login',
            'UserType' => 'User Type',
			'WeightageId' => 'Weightage',
            'ReportTo' => 'Report To',
            'CreatedOn' => 'Created On',
            'CreatedBy' => 'Created By',
            'ModifiedOn' => 'Modified On',
            'ModifiedBy' => 'Modified By',
            'DeleteOn' => 'Delete On',
            'DeleteBy' => 'Delete By',
            'LastViewedBy' => 'Last Viewed By',
            'LastViewedOn' => 'Last Viewed On',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('Userid',$this->Userid);
        $criteria->compare('MId',$this->MId,true);
        $criteria->compare('Name',$this->Name,true);
        $criteria->compare('Nick',$this->Nick,true);
        $criteria->compare('Email',$this->Email,true);
        $criteria->compare('Password',$this->Password,true);
        $criteria->compare('Avatar',$this->Avatar,true);
		$criteria->compare('Department',$this->Department);
		$criteria->compare('PhoneNo',$this->PhoneNo,true);
		$criteria->compare('Bio',$this->Bio);
        $criteria->compare('JobTitle',$this->JobTitle,true);
        $criteria->compare('TimeZone',$this->TimeZone,true);
        $criteria->compare('Zoom',$this->Zoom,true);
		 $criteria->compare('Preferences',$this->Preferences,true);
        $criteria->compare('Language',$this->Language,true);
        $criteria->compare('UserInterface',$this->UserInterface,true);
        $criteria->compare('LastLogin',$this->LastLogin);
        $criteria->compare('UserType',$this->UserType,true);
		$criteria->compare('WeightageId',$this->WeightageId);
        $criteria->compare('ReportTo',$this->ReportTo);
        $criteria->compare('CreatedOn',$this->CreatedOn);
        $criteria->compare('CreatedBy',$this->CreatedBy);
        $criteria->compare('ModifiedOn',$this->ModifiedOn);
        $criteria->compare('ModifiedBy',$this->ModifiedBy);
        $criteria->compare('DeleteOn',$this->DeleteOn);
        $criteria->compare('DeleteBy',$this->DeleteBy);
        $criteria->compare('LastViewedBy',$this->LastViewedBy);
        $criteria->compare('LastViewedOn',$this->LastViewedOn);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function getUsersFromMId()
    {
    	$criteria = new CDbCriteria;
    	$criteria->condition = "MId = '".Yii::app()->user->MId."'";
    	$model = CHtml::listData(TblSysUsers::model()->findAll($criteria),"Userid","Name");
    	return $model;
    }
}