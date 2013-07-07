<?php

/**
 * This is the model class for table "tbl_App_Club_EventType".
 *
 * The followings are the available columns in table 'tbl_App_Club_EventType':
 * @property integer $CETId
 * @property integer $MId
 * @property string $EventType
 * @property integer $SortOrder
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $ModifiedBy
 * @property string $ModifiedOn
 * @property string $IsActive
 * @property string $IsDelete
 */
class TblAppClubEventType extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblAppClubEventType the static model class
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
        return 'tbl_App_Club_EventType';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('MId, EventType, SortOrder', 'required'),
            //array('CETId, MId, SortOrder, CreatedBy, ModifiedBy', 'numerical', 'integerOnly'=>true),
            //array('EventType', 'length', 'max'=>255),
            //array('IsActive, IsDelete', 'length', 'max'=>3),
			
			array('CreatedOn','default','value'=>date("Y-m-d H:i:s"),'setOnEmpty'=>false,'on'=>'insert'),
        	array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
			array('ModifiedOn','default','value'=>date("Y-m-d H:i:s"),'setOnEmpty'=>false,'on'=>'update'),
			array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
			array('IsActive','default','value'=>'Yes','setOnEmpty'=>false,'on'=>'insert'),
			array('IsDelete','default','value'=>'No','setOnEmpty'=>false,'on'=>'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('CETId, MId, EventType, SortOrder, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn, IsActive, IsDelete', 'safe', 'on'=>'search'),
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
            'CETId' => 'Cetid',
            'MId' => 'Mid',
            'EventType' => 'Event Type',
            'SortOrder' => 'Sort Order',
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

        $criteria->compare('CETId',$this->CETId);
        $criteria->compare('MId',$this->MId);
        $criteria->compare('EventType',$this->EventType,true);
        $criteria->compare('SortOrder',$this->SortOrder);
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