<?php

/**
 * This is the model class for table "tbl_sys_Modules".
 *
 * The followings are the available columns in table 'tbl_sys_Modules':
 * @property integer $ModuleId
 * @property string $Module
 * @property string $Controller
 * @property string $Link
 * @property integer $Parent
 * @property string $Visible
 */
class TblSysModules extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TblSysModules the static model class
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
		return 'tbl_sys_Modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Module, Controller, Link, Parent', 'required'),
			array('Parent', 'numerical', 'integerOnly'=>true),
			array('Module, Controller, Link', 'length', 'max'=>255),
			array('Visible', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ModuleId, Module, Controller, Link, Parent, Visible', 'safe', 'on'=>'search'),
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
			'ModuleId' => 'Module',
			'Module' => 'Module',
			'Controller' => 'Controller',
			'Link' => 'Link',
			'Parent' => 'Parent',
			'Visible' => 'Visible',
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
		$criteria->compare('Module',$this->Module,true);
		$criteria->compare('Controller',$this->Controller,true);
		$criteria->compare('Link',$this->Link,true);
		$criteria->compare('Parent',$this->Parent);
		$criteria->compare('Visible',$this->Visible,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}