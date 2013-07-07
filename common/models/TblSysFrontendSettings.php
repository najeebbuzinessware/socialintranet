<?php

/**
 * This is the model class for table "tbl_sys_FrontendSettings".
 *
 * The followings are the available columns in table 'tbl_sys_FrontendSettings':
 * @property integer $FSId
 * @property integer $MId
 * @property string $Group
 * @property string $Key
 * @property string $Value
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $IsSerialized
 * @property string $IsActive
 * @property string $IsDelete
 */
class TblSysFrontendSettings extends CActiveRecord
{
	public $config_logo;
	public $config_frontend_url;
	public $config_backlink_url;
	public $config_listlimit;
	public $config_link_color;
	public $config_border_color;
	public $config_nav_color;
	public $config_nav_hover;
	public $config_grad_start;
	public $config_grad_end;
	public $config_widgets;
	public $config_introtext;
	public $config_layout;
	public $config_show_frontend;
	
	
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblJobSettingsFrontend the static model class
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
        return 'tbl_sys_FrontendSettings';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('MId', 'required'),
            //array('MId, CreatedBy, IsSerialized', 'numerical', 'integerOnly'=>true),
            //array('Group, Key, Value', 'length', 'max'=>255),
            //array('IsActive, IsDelete', 'length', 'max'=>3),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('FSId, MId, Group, Key, Value, CreatedBy, CreatedOn, IsSerialized, IsActive, IsDelete', 'safe', 'on'=>'search'),
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
            'FSId' => 'Fsid',
            'MId' => 'Mid',
            'Group' => 'Group',
            'Key' => 'Key',
            'Value' => 'Value',
            'CreatedBy' => 'Created By',
            'CreatedOn' => 'Created On',
            'IsSerialized' => 'Is Serialized',
            'IsActive' => 'Is Active',
            'IsDelete' => 'Is Delete',
			'config_logo' => 'Your Company Logo',
			'config_frontend_url' => 'Value',
			'config_backlink_url' => 'Value',
			'config_listlimit' => 'Value',
			'config_link_color' => 'Value',
			'config_border_color' => 'Value',
			'config_nav_color' => 'Value',
			'config_nav_hover' => 'Value',
			'config_grad_start' => 'Value',
			'config_grad_end' => 'Value',
			'config_widgets' => 'Value',
			'config_introtext' => 'Value',
			'config_layout' => 'Value',
			'config_show_frontend' => 'Value',
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

        $criteria->compare('FSId',$this->FSId);
        $criteria->compare('MId',$this->MId);
        $criteria->compare('Group',$this->Group,true);
        $criteria->compare('Key',$this->Key,true);
        $criteria->compare('Value',$this->Value,true);
        $criteria->compare('CreatedBy',$this->CreatedBy);
        $criteria->compare('CreatedOn',$this->CreatedOn,true);
        $criteria->compare('IsSerialized',$this->IsSerialized);
        $criteria->compare('IsActive',$this->IsActive,true);
        $criteria->compare('IsDelete',$this->IsDelete,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}