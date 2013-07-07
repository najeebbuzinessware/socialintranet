<?php

/**
 * This is the model class for table "tbl_Coll_Followers".
 *
 * The followings are the available columns in table 'tbl_Coll_Followers':
 * @property integer $FollId
 * @property integer $RecordId
 * @property integer $MId
 * @property integer $FollowingBy
 * @property string $CType
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $ModifiedBy
 * @property string $ModifiedOn
 */
class TblCollFollowers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblCollFollowers the static model class
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
		return 'tbl_Coll_Followers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RecordId, MId, FollowingBy, CreatedBy, ModifiedBy', 'numerical', 'integerOnly'=>true),
			array('CType', 'length', 'max'=>255),
			array('CreatedOn, ModifiedOn', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FollId, RecordId, MId, FollowingBy, CType, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn', 'safe', 'on'=>'search'),
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
			'FollId' => 'Foll',
			'RecordId' => 'Record',
			'MId' => 'Mid',
			'FollowingBy' => 'Following By',
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

		$criteria->compare('FollId',$this->FollId);
		$criteria->compare('RecordId',$this->RecordId);
		$criteria->compare('MId',$this->MId);
		$criteria->compare('FollowingBy',$this->FollowingBy);
		$criteria->compare('CType',$this->CType,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}