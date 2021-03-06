<?php

/**
 * This is the model class for table "tbl_Coll_Comments".
 *
 * The followings are the available columns in table 'tbl_Coll_Comments':
 * @property integer $ComId
 * @property integer $WallId
 * @property integer $MId
 * @property integer $UserId
 * @property string $Comment
 * @property string $CType
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $ModifiedBy
 * @property string $ModifiedOn
 * @property string $IsDispaly
 */
class TblCollComments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblCollComments the static model class
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
		return 'tbl_Coll_Comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('Comment', 'required'),
			array('WallId, MId, UserId, CreatedBy, ModifiedBy', 'numerical', 'integerOnly'=>true),
			array('CType', 'length', 'max'=>15),
			array('IsDispaly', 'length', 'max'=>4),
				
				array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
				array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
				array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
				array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
				array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
			//array('CreatedOn, ModifiedOn', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ComId, WallId, MId, UserId, Comment, CType, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn, IsDispaly', 'safe', 'on'=>'search'),
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
			'ComId' => 'Com',
			'WallId' => 'Wall',
			'MId' => 'Mid',
			'UserId' => 'User',
			'Comment' => 'Comment',
			'CType' => 'Ctype',
			'CreatedBy' => 'Created By',
			'CreatedOn' => 'Created On',
			'ModifiedBy' => 'Modified By',
			'ModifiedOn' => 'Modified On',
			'IsDispaly' => 'Is Dispaly',
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

		$criteria->compare('ComId',$this->ComId);
		$criteria->compare('WallId',$this->WallId);
		$criteria->compare('MId',$this->MId);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('Comment',$this->Comment,true);
		$criteria->compare('CType',$this->CType,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn,true);
		$criteria->compare('IsDispaly',$this->IsDispaly,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}