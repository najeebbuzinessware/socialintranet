<?php

/**
 * This is the model class for table "tbl_Coll_Groups".
 *
 * The followings are the available columns in table 'tbl_Coll_Groups':
 * @property integer $GrId
 * @property string $GroupName
 * @property integer $UserId
 * @property string $Description
 * @property integer $MId
 * @property string $DType
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $ModifiedBy
 * @property string $ModifiedOn
 */
class TblCollGroups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblCollGroups the static model class
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
		return 'tbl_Coll_Groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GroupName,DType', 'required'),
			array('UserId, MId, CreatedBy, ModifiedBy', 'numerical', 'integerOnly'=>true),
			array('GroupName', 'length', 'max'=>255),
			array('DType', 'length', 'max'=>7),
			array('CreatedOn, ModifiedOn', 'safe'),
				array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
				array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
				array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
				array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
				array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('GrId, GroupName, UserId, Description, MId, DType, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn', 'safe', 'on'=>'search'),
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
			'GrId' => 'Group Id',
			'GroupName' => 'Group Name',
			'UserId' => 'User',
			'Description' => 'Description',
			'MId' => 'Mid',
			'DType' => 'Group Type',
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

		$criteria->compare('GrId',$this->GrId);
		$criteria->compare('GroupName',$this->GroupName,true);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('MId',$this->MId);
		$criteria->compare('DType',$this->DType,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getGroupsFromMId($limit=10)
	{
		if($limit<1){$limit=5;}
		$criteria = new CDbCriteria();
		$criteria->condition = "MId=".Yii::app()->user->MId;
		$criteria->limit = $limit;
		$model = CHtml::listData(TblCollGroups::model()->findAll($criteria),"GrId","GroupName");
		return $model;
	}
}