<?php

/**
 * This is the model class for table "tbl_Master".
 *
 * The followings are the available columns in table 'tbl_Master':
 * @property string $MId
 * @property string $Company
 * @property string $APIKey
 *
 * The followings are the available model relations:
 * @property TblAccounts[] $tblAccounts
 * @property TblSource[] $tblSources
 * @property TblStage[] $tblStages
 * @property TblUsers $tblUsers
 */
class TblMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TblMaster the static model class
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
		return 'tbl_sys_Master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Company', 'required'),
			array('Company', 'length', 'max'=>255),
			array('APIKey', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('MId, Company, APIKey', 'safe', 'on'=>'search'),
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
			'tblAccounts' => array(self::HAS_MANY, 'TblAccounts', 'MId'),
			'tblSources' => array(self::HAS_MANY, 'TblSource', 'MId'),
			'tblStages' => array(self::HAS_MANY, 'TblStage', 'MId'),
			'tblUsers' => array(self::HAS_ONE, 'TblUsers', 'MId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'MId' => 'Mid',
			'Company' => 'Company',
			'APIKey' => 'API Key',
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

		$criteria->compare('MId',$this->MId,true);
		$criteria->compare('Company',$this->Company,true);
		$criteria->compare('APIKey',$this->APIKey,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			 'pagination'=>array(
            'pageSize'=>10
        ),
		));
	}
}