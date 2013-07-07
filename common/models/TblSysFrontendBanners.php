<?php

/**
 * This is the model class for table "tbl_sys_FrontendBanners".
 *
 * The followings are the available columns in table 'tbl_sys_FrontendBanners':
 * @property integer $FBId
 * @property integer $MID
 * @property string $FileName
 * @property string $FileType
 * @property string $FileSize
 * @property string $Position
 * @property string $CType
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $ModifiedBy
 * @property string $ModifiedOn
 * @property string $IsActive
 * @property string $IsDelete
 */
class TblSysFrontendBanners extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblSysFrontendBanners the static model class
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
        return 'tbl_sys_FrontendBanners';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('MID, FileName, FileType, Position', 'required'),
            //array('MID, CreatedBy, ModifiedBy', 'numerical', 'integerOnly'=>true),
            //array('FileName, FileType, Position', 'length', 'max'=>250),
            //array('CType', 'length', 'max'=>255),
            //array('IsActive, IsDelete', 'length', 'max'=>3),
            ///array('CreatedOn, ModifiedOn', 'safe'),
			array('CreatedOn','default','value'=>date("Y-m-d H:i:s"),'setOnEmpty'=>false,'on'=>'insert'),
        	array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
			array('ModifiedOn','default','value'=>date("Y-m-d H:i:s"),'setOnEmpty'=>false,'on'=>'update'),
			array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
			array('IsActive','default','value'=>'Yes','setOnEmpty'=>false,'on'=>'insert'),
			array('IsDelete','default','value'=>'No','setOnEmpty'=>false,'on'=>'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('FBId, MID, FileName, FileType, FileSize, Position, CType, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn, IsActive, IsDelete', 'safe', 'on'=>'search'),
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
            'FBId' => 'Fbid',
            'MID' => 'Mid',
            'FileName' => 'File Name',
            'FileType' => 'File Type',
			'FileSize' => 'File Size',
            'Position' => 'Position',
            'CType' => 'Ctype',
            'CreatedBy' => 'Created By',
            'CreatedOn' => 'Created On',
            'ModifiedBy' => 'Modified By',
            'ModifiedOn' => 'Modified On',
            'IsActive' => 'Is Active',
            'IsDelete' => 'Is Delete',
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

        $criteria->compare('FBId',$this->FBId);
        $criteria->compare('MID',$this->MID);
        $criteria->compare('FileName',$this->FileName,true);
        $criteria->compare('FileType',$this->FileType,true);
		$criteria->compare('FileSize',$this->FileSize,true);
        $criteria->compare('Position',$this->Position,true);
        $criteria->compare('CType',$this->CType,true);
        $criteria->compare('CreatedBy',$this->CreatedBy);
        $criteria->compare('CreatedOn',$this->CreatedOn,true);
        $criteria->compare('ModifiedBy',$this->ModifiedBy);
        $criteria->compare('ModifiedOn',$this->ModifiedOn,true);
        $criteria->compare('IsActive',$this->IsActive,true);
        $criteria->compare('IsDelete',$this->IsDelete,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}