<?php

/**
 * This is the model class for table "tbl_Job_Workflow".
 *
 * The followings are the available columns in table 'tbl_Job_Workflow':
 * @property integer $WorkflowId
 * @property integer $MID
 * @property string $Name
 * @property string $Email
 * @property string $Contact
 * @property string $MailSetting
 * @property integer $CreatedBy
 * @property integer $CreatedOn
 * @property integer $ModifiedBy
 * @property integer $ModifiedOn
 * @property string $IsActive
 * @property string $IsDelete
 */
class TblSysWorkflow extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblJobWorkflow the static model class
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
		return 'tbl_sys_Workflow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MID, Name, Email, Contact, MailSetting', 'required'),
			array('MID, CreatedBy, ModifiedBy', 'numerical', 'integerOnly'=>true),
			array('Name, Email, Contact', 'length', 'max'=>250),
			array('MailSetting', 'length', 'max'=>13),
			array('IsActive, IsDelete', 'length', 'max'=>6),
			array('Email', 'email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('WorkflowId, MID, Name, Email, Contact, MailSetting, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn, IsActive, IsDelete', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'WorkflowId' => 'Workflow',
			'MID' => 'Mid',
			'Name' => 'Name',
			'Email' => 'Email',
			'Contact' => 'Contact',
			'MailSetting' => 'Mail Setting',
			'CreatedBy' => 'Created By',
			'CreatedOn' => 'Created On',
			'ModifiedBy' => 'Modified By',
			'ModifiedOn' => 'Modified On',
			'IsActive' => 'Is Active',
			'IsDelete' => 'Is Delete',
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

		$criteria->compare('WorkflowId',$this->WorkflowId);
		$criteria->compare('MID',$this->MID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Contact',$this->Contact,true);
		$criteria->compare('MailSetting',$this->MailSetting,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn);
		$criteria->compare('IsActive',$this->IsActive,true);
		$criteria->compare('IsDelete',$this->IsDelete,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}