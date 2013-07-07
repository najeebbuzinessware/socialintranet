<?php

/**
 * This is the model class for table "tbl_Job_Location".
 *
 * The followings are the available columns in table 'tbl_Job_Location':
 * @property integer $LocId
 * @property integer $MID
 * @property integer $Country
 * @property string $CityName
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $ModifiedBy
 * @property string $ModifiedOn
 * @property string $IsActive
 * @property string $IsDelete
 */
class TblSysLocation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblJobLocation the static model class
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
		return 'tbl_sys_Location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CityName', 'required'),
			/*array('MID, Country, CreatedBy, ModifiedBy', 'numerical', 'integerOnly'=>true),
			array('CityName', 'length', 'max'=>255),*/
			array('IsActive, IsDelete', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('LocId, MID, Country, CityName, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn, IsActive, IsDelete', 'safe', 'on'=>'search'),
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
			'LocId' => 'Loc',
			'MID' => 'Mid',
			'Country' => 'Country',
			'CityName' => 'City Name',
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

		$criteria->compare('LocId',$this->LocId);
		$criteria->compare('MID',$this->MID);
		$criteria->compare('Country',$this->Country);
		$criteria->compare('CityName',$this->CityName,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn,true);
		$criteria->compare('IsActive',$this->IsActive,true);
		$criteria->compare('IsDelete',$this->IsDelete,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}