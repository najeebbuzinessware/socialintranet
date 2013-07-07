<?php

/**
 * This is the model class for table "tbl_File_Share".
 *
 * The followings are the available columns in table 'tbl_File_Share':
 * @property integer $ShareId
 * @property integer $MId
 * @property integer $Userid
 * @property integer $SharedWith
 * @property string $fileName
 * @property string $filePath
 * @property integer $CreatedBy
 * @property integer $CreatedOn
 * @property integer $ModifiedBy
 * @property integer $ModifiedOn
 */
class TblFileShare extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblFileShare the static model class
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
		return 'tbl_File_Share';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MId, fileName, filePath', 'required'),
			array('MId, Userid, SharedWith, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn', 'numerical', 'integerOnly'=>true),
			array('fileName, filePath', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ShareId, MId, Userid, SharedWith, fileName, filePath, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn', 'safe', 'on'=>'search'),
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
			'ShareId' => 'Share',
			'MId' => 'Mid',
			'Userid' => 'Userid',
			'SharedWith' => 'Shared With',
			'fileName' => 'File Name',
			'filePath' => 'File Path',
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

		$criteria->compare('ShareId',$this->ShareId);
		$criteria->compare('MId',$this->MId);
		$criteria->compare('Userid',$this->Userid);
		$criteria->compare('SharedWith',$this->SharedWith);
		$criteria->compare('fileName',$this->fileName,true);
		$criteria->compare('filePath',$this->filePath,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}