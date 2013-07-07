<?php

/**
 * This is the model class for table "tbl_sys_AuthItem".
 *
 * The followings are the available columns in table 'tbl_sys_AuthItem':
 * @property integer $AuthItemId
 * @property string $name
 * @property integer $type
 * @property integer $MId
 * @property string $description
 * @property string $bizrule
 * @property string $data
 */
class TblSysAuthItem extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return TtblSysAuthItem the static model class
     */
	
	public $groupname;
	
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
        return 'tbl_sys_AuthItem';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, type', 'required'),
			
			array('name','compare','compareValue'=>Yii::t('translate','Enter Group Name'),'operator'=>'!=','allowEmpty'=>false,'message'=>Yii::t('translate','Enter Group Name')),						
            array('type, MId, ParentId', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>64),
            array('description, bizrule, data', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('name, type, MId, description, bizrule, data,ParentId', 'safe', 'on'=>'search'),
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
            'name' => 'Group Name',
            'type' => 'Type',
            'MId' => 'Mid',
			'ParentId'=>'Parent Group',
            'description' => 'Description',
            'bizrule' => 'Bizrule',
            'data' => 'Data',
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

        $criteria->compare('name',$this->name,true);
        $criteria->compare('type',$this->type);
		$criteria->compare('ParentId',$this->ParentId);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('bizrule',$this->bizrule,true);
        $criteria->compare('data',$this->data,true);
        $criteria->compare('MId',Yii::app()->user->MId);

        return new CActiveDataProvider(get_class($this), array(
                 'criteria'=>$criteria,
                 'pagination'=>array(
                 'pageSize'=>10
         ),
        ));
    }
}
?>