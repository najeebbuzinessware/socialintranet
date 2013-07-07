<?php

/**
 * This is the model class for table "tbl_sys_Tags".
 *
 * The followings are the available columns in table 'tbl_sys_Tags':
 * @property integer $TagId
 * @property integer $MId
 * @property string $Tags
 * @property string $TagColor
 * @property string $CType
 * @property integer $TagCount
 * @property integer $CreatedBy
 * @property integer $CreatedOn
 */
class TblSysTags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblSysTags the static model class
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
		return 'tbl_sys_Tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Tags, TagColor', 'required'),
			array('MId, TagCount, CreatedBy, CreatedOn', 'numerical', 'integerOnly'=>true),
			array('Tags, TagColor, CType', 'length', 'max'=>255),
			
				array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
				array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
				array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TagId, MId, Tags, TagColor, CType, TagCount, CreatedBy, CreatedOn', 'safe', 'on'=>'search'),
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
			'TagId' => 'Tag',
			'MId' => 'Mid',
			'Tags' => 'Tags',
			'TagColor' => 'Tag Color',
			'CType' => 'Ctype',
			'TagCount' => 'Tag Count',
			'CreatedBy' => 'Created By',
			'CreatedOn' => 'Created On',
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

		$criteria->compare('TagId',$this->TagId);
		$criteria->compare('MId',$this->MId);
		$criteria->compare('Tags',$this->Tags,true);
		$criteria->compare('TagColor',$this->TagColor,true);
		$criteria->compare('CType',$this->CType,true);
		$criteria->compare('TagCount',$this->TagCount);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function getTagsFromMId()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'MId='.Yii::app()->user->Id;
		$model = CHtml::listData(TblSysTags::model()->findAll($criteria),"TagId","Tags");
		return $model;
	
	}
	
	public function getTagNamefromId($id)
	{
		$model = TblSysTags::model()->findByPk($id);
			$tagwithcolor = '<span class="label '.$model->TagColor.'">'.$model->Tags.'</span>';
		return $tagwithcolor;
	}
	
	public function getTagClasses($key=NULL)
	{
		$options = array('label-default'=>"Default","label-success"=>"Success","label-warning"=>"Warning","label-important"=>"Important","label-info"=>"Info","label-inverse"=>"Inverse");
		if(strlen($key)>0){
			$tagwithcolor = '<span class="label '.$key.'">'.$options[$key].'</span>';
			return $tagwithcolor;
		}else{
			return $options;
		}
		
	}
	
	
}