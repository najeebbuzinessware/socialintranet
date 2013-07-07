<?php

/**
 * This is the model class for table "tbl_sys_NewsTaskSettings".
 *
 * The followings are the available columns in table 'tbl_sys_NewsTaskSettings':
 * @property integer $SetId
 * @property integer $MId
 * @property integer $UserId
 * @property integer $RecordLimit
 * @property integer $FeedId
 * @property string $CType
 * @property integer $CreatedBy
 * @property integer $CreatedOn
 * @property integer $ModifiedBy
 * @property integer $ModifiedOn
 */
class TblSysNewsTaskSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblSysNewsTaskSettings the static model class
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
		return 'tbl_sys_NewsTaskSettings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RecordLimit, CType', 'required'),
			array('MId, UserId, RecordLimit, FeedId, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn', 'numerical', 'integerOnly'=>true),
			array('CType', 'length', 'max'=>255),
				array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
				array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
				array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
				array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
				array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SetId, MId, UserId, RecordLimit, FeedId, CType, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn', 'safe', 'on'=>'search'),
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
			'SetId' => 'Set',
			'MId' => 'Mid',
			'UserId' => 'User',
			'RecordLimit' => 'Record Limit',
			'FeedId' => 'Feed',
			'CType' => 'Ctype',
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

		$criteria->compare('SetId',$this->SetId);
		$criteria->compare('MId',$this->MId);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('RecordLimit',$this->RecordLimit);
		$criteria->compare('FeedId',$this->FeedId);
		$criteria->compare('CType',$this->CType,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}