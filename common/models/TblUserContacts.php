<?php

/**
 * This is the model class for table "tbl_UserContacts".
 *
 * The followings are the available columns in table 'tbl_UserContacts':
 * @property integer $ContactId
 * @property integer $MId
 * @property integer $UserId
 * @property string $Name
 * @property integer $Number
 * @property string $Email
 * @property string $Company
 * @property string $JobProfile
 * @property integer $TagId
 * @property integer $CreatedBy
 * @property integer $CreatedOn
 * @property integer $ModifiedBy
 * @property integer $ModifiedOn
 *
 * The followings are the available model relations:
 * @property TblSysUsers $user
 */
class TblUserContacts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblUserContacts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_UserContacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Email', 'required'),
			array('Email', 'email'),
			array('MId, UserId, Number, TagId, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn', 'numerical', 'integerOnly'=>true),
			array('Name, Email, Company, JobProfile', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			
				array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
				array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
				array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
				array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
				array('UserId','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
				array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
				
			array('ContactId, MId, UserId, Name, Number, Email, Company, JobProfile, TagId, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'TblSysUsers', 'UserId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ContactId' => 'Contact',
			'MId' => 'Mid',
			'UserId' => 'User',
			'Name' => 'Name',
			'Number' => 'Number',
			'Email' => 'Email',
			'Company' => 'Company',
			'JobProfile' => 'Job Profile',
			'TagId' => 'Tag',
			'CreatedBy' => 'Created By',
			'CreatedOn' => 'Created On',
			'ModifiedBy' => 'Modified By',
			'ModifiedOn' => 'Modified On',
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

		$criteria->compare('ContactId',$this->ContactId);
		$criteria->compare('MId',$this->MId);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Number',$this->Number);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Company',$this->Company,true);
		$criteria->compare('JobProfile',$this->JobProfile,true);
		$criteria->compare('TagId',$this->TagId);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}