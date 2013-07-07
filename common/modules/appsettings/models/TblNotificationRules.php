<?php

/**
 * This is the model class for table "tbl_NotificationRules".
 *
 * The followings are the available columns in table 'tbl_NotificationRules':
 * @property integer $RuleId
 * @property integer $MId
 * @property string $Module
 * @property string $Action
 * @property integer $TemplateId
 * @property string $Response
 * @property string $CreatedOn
 * @property integer $CreatedBy
 * @property string $ModifiedOn
 * @property integer $ModifiedBy
 * @property integer $IsDelete
 */
class TblNotificationRules extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblNotificationRules the static model class
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
        return 'tbl_NotificationRules';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
          //  array('MId, Action, TemplateId', 'required'),
            array('MId, TemplateId, CreatedBy, ModifiedBy, IsDelete', 'numerical', 'integerOnly'=>true),
			array('Module, Action, Response', 'length', 'max'=>255),
			
			array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
			array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
        	array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
        	array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('RuleId, MId, Module, Action, TemplateId, Response, CreatedOn, CreatedBy, ModifiedOn, ModifiedBy, IsDelete', 'safe', 'on'=>'search'),
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
            'RuleId' => 'Rule',
            'MId' => 'Mid',
            'Module' => 'Module',
            'Action' => 'Action',
            'TemplateId' => 'Template',
            'Response' => 'Response',
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

        $criteria->compare('RuleId',$this->RuleId);
        $criteria->compare('MId',$this->MId);
        $criteria->compare('Module',$this->Module,true);
        $criteria->compare('Action',$this->Action,true);
        $criteria->compare('TemplateId',$this->TemplateId);
        $criteria->compare('Response',$this->Response,true);
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