<?php

/**
 * This is the model class for table "tbl_Announcement".
 *
 * The followings are the available columns in table 'tbl_Announcement':
 * @property integer $AnnouncementId
 * @property string $MId
 * @property string $Title
 * @property string $Content
 * @property string $Status
 * @property string $PublishDate
 * @property string $Sandbox
 * @property integer $CreatedBy
 * @property integer $CreatedOn
 * @property integer $LastViewedBy
 * @property integer $LastViewedOn
 * @property integer $ModifiedBy
 * @property integer $ModifiedOn
 *
 * The followings are the available model relations:
 * @property TblSysMaster $m
 */
class TblAnnouncement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TblAnnouncement the static model class
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
		return 'tbl_Announcement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array( 
			array('Content, Status, PublishDate', 'required'),
			array('CreatedBy, CreatedOn, LastViewedBy, LastViewedOn, ModifiedBy, ModifiedOn', 'numerical', 'integerOnly'=>true),
			array('MId', 'length', 'max'=>11),
			array('Status', 'length', 'max'=>9),
			array('Sandbox', 'safe'),
				array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
				array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
				array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
				array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
				array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('AnnouncementId, MId, Title, Content, Status, PublishDate, Sandbox, CreatedBy, CreatedOn, LastViewedBy, LastViewedOn, ModifiedBy, ModifiedOn', 'safe', 'on'=>'search'),
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
			'm' => array(self::BELONGS_TO, 'TblSysMaster', 'MId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'AnnouncementId' => 'Announcement',
			'MId' => 'Mid',
			'Title' => 'Title',
			'Content' => 'Announcement',
			'Status' => 'Status',
			'PublishDate' => 'Publish Date',
			'Sandbox' => 'Sandbox',
			'CreatedBy' => 'Created By',
			'CreatedOn' => 'Created On',
			'LastViewedBy' => 'Last Viewed By',
			'LastViewedOn' => 'Last Viewed On',
			'ModifiedBy' => 'Modified By',
			'ModifiedOn' => 'Modified On',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($Mid)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('AnnouncementId',$this->AnnouncementId);
		$criteria->compare('MId',$Mid,true);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Content',$this->Content,true);
		$criteria->compare('Status',$this->Status,true);
		$criteria->compare('PublishDate',$this->PublishDate,true);
		$criteria->compare('Sandbox',$this->Sandbox,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn);
		$criteria->compare('LastViewedBy',$this->LastViewedBy);
		$criteria->compare('LastViewedOn',$this->LastViewedOn);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array(
							'defaultOrder' => 'AnnouncementId DESC',
					),
			 'pagination'=>array(
				'pageSize'=>10
			)
		));
	}
	
	public function getAnnouncementsFromMId()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "MId=".Yii::app()->user->MId;	
		$model = CHtml::listData(TblAnnouncement::model()->findAll($criteria),"AnnouncementId","Content");
		return $model;
	}
}