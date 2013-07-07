<?php

/**
 * This is the model class for table "tbl_Projects".
 *
 * The followings are the available columns in table 'tbl_Projects':
 * @property integer $ProjectId
 * @property string $MId
 * @property string $ProjectName
 * @property string $Description
 * @property integer $EstimatedTime
 * @property integer $ProductCId
 * @property string $ProjectType
 * @property string $PType
 * @property string $StartDate
 * @property string $Expiry
 * @property integer $TotalHours
 * @property integer $ConsumedHours
 * @property double $TotalTimeInHours
 * @property double $ConsumedTimeInHours
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $LastViewedBy
 * @property string $LastViewedOn
 * @property integer $ModifiedBy
 * @property string $ModifiedOn
 * @property string $IsActive
 * @property integer $IsDelete
 */
class TblProjects extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblProjects the static model class
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
		return 'tbl_Projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
			array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
			array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
			array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
			array('IsDelete','default','value'=>'0','setOnEmpty'=>false,'on'=>'insert'),
			array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
				
			array('ProjectName, EstimatedTime, ProductCId', 'required'),
			array('EstimatedTime, ProductCId, TotalHours, ConsumedHours, CreatedBy, LastViewedBy, ModifiedBy, IsDelete', 'numerical', 'integerOnly'=>true),
			array('TotalTimeInHours, ConsumedTimeInHours', 'numerical'),
			array('MId', 'length', 'max'=>11),
			array('ProjectName', 'length', 'max'=>250),
			array('ProjectType', 'length', 'max'=>9),
			array('PType', 'length', 'max'=>8),
			array('CreatedOn, LastViewedOn, ModifiedOn', 'length', 'max'=>20),
			array('IsActive', 'length', 'max'=>255),
			array('StartDate, Expiry', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ProjectId, MId, ProjectName, Description, EstimatedTime, ProductCId, ProjectType, PType, StartDate, Expiry, TotalHours, ConsumedHours, TotalTimeInHours, ConsumedTimeInHours, CreatedBy, CreatedOn, LastViewedBy, LastViewedOn, ModifiedBy, ModifiedOn, IsActive, IsDelete', 'safe', 'on'=>'search'),
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
			'ProjectId' => 'Project',
			'MId' => 'Mid',
			'ProjectName' => 'Project Name',
			'Description' => 'Description',
			'EstimatedTime' => 'Estimated Time',
			'ProductCId' => 'Product Cid',
			'ProjectType' => 'Project Type',
			'PType' => 'Ptype',
			'StartDate' => 'Start Date',
			'Expiry' => 'Expiry',
			'TotalHours' => 'Total Hours',
			'ConsumedHours' => 'Consumed Hours',
			'TotalTimeInHours' => 'Total Time In Hours',
			'ConsumedTimeInHours' => 'Consumed Time In Hours',
			'CreatedBy' => 'Created By',
			'CreatedOn' => 'Created On',
			'LastViewedBy' => 'Last Viewed By',
			'LastViewedOn' => 'Last Viewed On',
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

		$criteria->compare('ProjectId',$this->ProjectId);
		$criteria->compare('MId',$this->MId,true);
		$criteria->compare('ProjectName',$this->ProjectName,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('EstimatedTime',$this->EstimatedTime);
		$criteria->compare('ProductCId',$this->ProductCId);
		$criteria->compare('ProjectType',$this->ProjectType,true);
		$criteria->compare('PType',$this->PType,true);
		$criteria->compare('StartDate',$this->StartDate,true);
		$criteria->compare('Expiry',$this->Expiry,true);
		$criteria->compare('TotalHours',$this->TotalHours);
		$criteria->compare('ConsumedHours',$this->ConsumedHours);
		$criteria->compare('TotalTimeInHours',$this->TotalTimeInHours);
		$criteria->compare('ConsumedTimeInHours',$this->ConsumedTimeInHours);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn,true);
		$criteria->compare('LastViewedBy',$this->LastViewedBy);
		$criteria->compare('LastViewedOn',$this->LastViewedOn,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn,true);
		$criteria->compare('IsActive',$this->IsActive,true);
		$criteria->compare('IsDelete',$this->IsDelete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}