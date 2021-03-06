<?php

/**
 * This is the model class for table "tbl_Departments".
 *
 * The followings are the available columns in table 'tbl_Departments':
 * @property integer $DeptId
 * @property string $Department
 * @property string $Description
 * @property integer $MId
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $ModifiedBy
 * @property string $ModifiedOn
 * @property integer $IsDelete
 */
class TblDepartments extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblDepartments the static model class
     */
	 
	public $Name; 
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
        return 'tbl_Departments';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Department, MId', 'required'),
            array('MId, CreatedBy, ModifiedBy, IsDelete', 'numerical', 'integerOnly'=>true),
            array('Department', 'length', 'max'=>255),
            array('Description, CreatedOn, ModifiedOn', 'safe'),
        		array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
        		array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
        		array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
        		array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
        		array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('DeptId, Department, Description, MId, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn, IsDelete', 'safe', 'on'=>'search'),
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
            'DeptId' => 'Dept',
            'Department' => 'Department',
            'Description' => 'Description',
            'MId' => 'Mid',
            'CreatedBy' => 'Created By',
            'CreatedOn' => 'Created On',
            'ModifiedBy' => 'Modified By',
            'ModifiedOn' => 'Modified On',
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

        $criteria->compare('DeptId',$this->DeptId);
        $criteria->compare('Department',$this->Department,true);
        $criteria->compare('Description',$this->Description,true);
        $criteria->compare('MId',$this->MId);
        $criteria->compare('CreatedBy',$this->CreatedBy);
        $criteria->compare('CreatedOn',$this->CreatedOn,true);
        $criteria->compare('ModifiedBy',$this->ModifiedBy);
        $criteria->compare('ModifiedOn',$this->ModifiedOn,true);
        $criteria->compare('IsDelete',$this->IsDelete);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}