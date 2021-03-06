<?php

/**
 * This is the model class for table "tbl_Coll_Attachments".
 *
 * The followings are the available columns in table 'tbl_Coll_Attachments':
 * @property integer $AttachId
 * @property string $ItemName
 * @property integer $ItemId
 * @property integer $RecordId
 * @property string $CType
 * @property string $ShareType
 * @property integer $MId
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $ModifiedBy
 * @property string $ModifiedOn
 */
class TblCollAttachments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblCollAttachments the static model class
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
		return 'tbl_Coll_Attachments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('ItemName, ItemId, RecordId, CType, ShareType, MId', 'required'),
			array('ItemId, RecordId, MId, CreatedBy, ModifiedBy', 'numerical', 'integerOnly'=>true),
			array('ItemName, CType, ShareType', 'length', 'max'=>255),
			array('CreatedOn, ModifiedOn', 'safe'),*/
				array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
				array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
				array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
				array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
				array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('AttachId, ItemName, ItemId, RecordId, CType, ShareType, MId, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn', 'safe', 'on'=>'search'),
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
			'AttachId' => 'Attach',
			'ItemName' => 'Item Name',
			'ItemId' => 'Item',
			'RecordId' => 'Record',
			'CType' => 'Ctype',
			'ShareType' => 'Share Type',
			'MId' => 'Mid',
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

		$criteria->compare('AttachId',$this->AttachId);
		$criteria->compare('ItemName',$this->ItemName,true);
		$criteria->compare('ItemId',$this->ItemId);
		$criteria->compare('RecordId',$this->RecordId);
		$criteria->compare('CType',$this->CType,true);
		$criteria->compare('ShareType',$this->ShareType,true);
		$criteria->compare('MId',$this->MId);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}