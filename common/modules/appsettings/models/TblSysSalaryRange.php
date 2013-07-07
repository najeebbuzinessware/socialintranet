<?php

/**
 * This is the model class for table "tbl_Job_SalaryRange".
 *
 * The followings are the available columns in table 'tbl_Job_SalaryRange':
 * @property integer $SalaryId
 * @property integer $MID
 * @property string $SalaryRange
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $ModifiedBy
 * @property integer $ModifiedOn
 * @property string $IsActive
 * @property string $IsDelete
 */
class TblSysSalaryRange extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblJobSalaryRange the static model class
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
		return 'tbl_sys_SalaryRange';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MID, SalaryRange', 'required'),
			//array('MID, CreatedBy, ModifiedBy, ModifiedOn', 'numerical', 'integerOnly'=>true),
			//array('SalaryRange', 'length', 'max'=>255),
			///array('IsActive, IsDelete', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SalaryId, MID, SalaryRange, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn, IsActive, IsDelete', 'safe', 'on'=>'search'),
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
			'SalaryId' => 'Salary',
			'MID' => 'Mid',
			'SalaryRange' => 'Salary Range',
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

		$criteria->compare('SalaryId',$this->SalaryId);
		$criteria->compare('MID',$this->MID);
		$criteria->compare('SalaryRange',$this->SalaryRange,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn);
		$criteria->compare('IsActive',$this->IsActive,true);
		$criteria->compare('IsDelete',$this->IsDelete,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}