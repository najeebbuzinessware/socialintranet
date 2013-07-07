<?php

/**
 * This is the model class for table "tbl_ModuleAccess".
 *
 * The followings are the available columns in table 'tbl_ModuleAccess':
 * @property integer $ModuleId
 * @property string $MId
 *
 * The followings are the available model relations:
 * @property TblMaster $m
 * @property TblModules $module
 */
class TblModuleAccess extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TblModuleAccess the static model class
	 */
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
		return 'tbl_sys_ModuleAccess';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ModuleId, MId', 'required'),
			array('ModuleId', 'numerical', 'integerOnly'=>true),
			array('MId', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ModuleId, MId', 'safe', 'on'=>'search'),
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
			'm' => array(self::BELONGS_TO, 'TblMaster', 'MId'),
			'module' => array(self::HAS_MANY, 'TblModules', 'ModuleId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ModuleId' => 'Module',
			'MId' => 'Mid',
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

		$criteria->compare('ModuleId',$this->ModuleId);
		$criteria->compare('MId',$this->MId,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}