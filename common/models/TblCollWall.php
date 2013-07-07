<?php

/**
 * This is the model class for table "tbl_Coll_Wall".
 *
 * The followings are the available columns in table 'tbl_Coll_Wall':
 * @property integer $WallId
 * @property integer $MId
 * @property integer $UserId
 * @property string $WallPost
 * @property string $CType
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $ModifiedBy
 * @property string $ModifiedOn
 */
class TblCollWall extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblCollWall the static model class
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
		return 'tbl_Coll_Wall';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('WallPost', 'required'),
			array('MId, UserId, CreatedBy, ModifiedBy', 'numerical', 'integerOnly'=>true),
			array('CType', 'length', 'max'=>15),
				array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
				array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
				array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
				array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
				array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
			//array('WallPost, CreatedOn, ModifiedOn', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('WallId, MId, UserId, WallPost, CType, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn', 'safe', 'on'=>'search'),
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
			'WallId' => 'Wall',
			'MId' => 'Mid',
			'UserId' => 'User',
			'WallPost' => 'Wall Post',
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

		$criteria->compare('WallId',$this->WallId);
		$criteria->compare('MId',$this->MId);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('WallPost',$this->WallPost,true);
		$criteria->compare('CType',$this->CType,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getUserGroups()
	{
		
		$criteria = new CDbCriteria();
		$criteria->join = "LEFT JOIN tbl_Coll_Followers as Ass ON t.GrId = Ass.RecordId"; //"t.MId = '".Yii::app()->user->MId."'";
		$criteria->condition = "t.MId=".Yii::app()->user->MId." and ((t.UserId=".Yii::app()->user->Id.") or (Ass.FollowingBy=".Yii::app()->user->Id." and Ass.FollowingType='group'))";
		$criteria->group = 'Ass.RecordId';
		$mygroups = TblCollGroups::model()->findAll($criteria);
		//$wallarray = array("CWall"=>"Company Wall","MyWall"=>"My Wall");
		
		$groupoption = CHtml::listData($mygroups,"GrId","GroupName");
		
		return $groupoption;
		
	}
}