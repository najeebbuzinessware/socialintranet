<?php

/**
 * This is the model class for table "tbl_NotificationActions".
 *
 * The followings are the available columns in table 'tbl_NotificationActions':
 * @property integer $ActId
 * @property string $ActionName
 * @property string $Action
 * @property integer $ParentId
 * @property string $CreatedOn
 * @property integer $CreatedBy
 * @property string $ModifiedOn
 * @property integer $ModifiedBy
 * @property integer $IsDelete
 */
class TblNotificationActions extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblNotificationActions the static model class
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
        return 'tbl_NotificationActions';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ActionName, Action', 'required'),
            array('ParentId, CreatedBy, ModifiedBy, IsDelete', 'numerical', 'integerOnly'=>true),
            array('ActionName, Action', 'length', 'max'=>255),
            array('ModifiedOn', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ActId, ActionName, Action, ParentId, CreatedOn, CreatedBy, ModifiedOn, ModifiedBy, IsDelete', 'safe', 'on'=>'search'),
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
            'ActId' => 'Act',
            'ActionName' => 'Action Name',
            'Action' => 'Action',
            'ParentId' => 'Parent',
            'CreatedOn' => 'Created On',
            'CreatedBy' => 'Created By',
            'ModifiedOn' => 'Modified On',
            'ModifiedBy' => 'Modified By',
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

        $criteria->compare('ActId',$this->ActId);
        $criteria->compare('ActionName',$this->ActionName,true);
        $criteria->compare('Action',$this->Action,true);
        $criteria->compare('ParentId',$this->ParentId);
        $criteria->compare('CreatedOn',$this->CreatedOn,true);
        $criteria->compare('CreatedBy',$this->CreatedBy);
        $criteria->compare('ModifiedOn',$this->ModifiedOn,true);
        $criteria->compare('ModifiedBy',$this->ModifiedBy);
        $criteria->compare('IsDelete',$this->IsDelete);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}