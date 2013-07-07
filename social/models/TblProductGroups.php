<?php

/**
 * This is the model class for table "tbl_ProductGroups".
 *
 * The followings are the available columns in table 'tbl_ProductGroups':
 * @property integer $PGId
 * @property string $GroupName
 * @property string $Description
 * @property string $MId
 * @property string $Hidden
 * @property string $ExpiryDate
 * @property integer $DisplayOrder
 * @property integer $CreatedBy
 * @property integer $CreatedOn
 * @property integer $LastViewedBy
 * @property integer $LastViewedOn
 * @property integer $ModifiedBy
 * @property integer $ModifiedOn
 */
class TblProductGroups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblProductGroups the static model class
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
		return 'tbl_ProductGroups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GroupName, MId, ExpiryDate', 'required'),
			array('DisplayOrder, CreatedBy, CreatedOn, LastViewedBy, LastViewedOn, ModifiedBy, ModifiedOn', 'numerical', 'integerOnly'=>true),
			array('MId', 'length', 'max'=>11),
			array('Hidden', 'length', 'max'=>3),
			array('Description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PGId, GroupName, Description, MId, Hidden, ExpiryDate, DisplayOrder, CreatedBy, CreatedOn, LastViewedBy, LastViewedOn, ModifiedBy, ModifiedOn', 'safe', 'on'=>'search'),
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
			'PGId' => 'Pgid',
			'GroupName' => 'Group Name',
			'Description' => 'Description',
			'MId' => 'Mid',
			'Hidden' => 'Hidden',
			'ExpiryDate' => 'Expiry Date',
			'DisplayOrder' => 'Display Order',
			'CreatedBy' => 'Created By',
			'CreatedOn' => 'Created On',
			'LastViewedBy' => 'Last Viewed By',
			'LastViewedOn' => 'Last Viewed On',
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

		$criteria->compare('PGId',$this->PGId);
		$criteria->compare('GroupName',$this->GroupName,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('MId',$this->MId,true);
		$criteria->compare('Hidden',$this->Hidden,true);
		$criteria->compare('ExpiryDate',$this->ExpiryDate,true);
		$criteria->compare('DisplayOrder',$this->DisplayOrder);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn);
		$criteria->compare('LastViewedBy',$this->LastViewedBy);
		$criteria->compare('LastViewedOn',$this->LastViewedOn);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}