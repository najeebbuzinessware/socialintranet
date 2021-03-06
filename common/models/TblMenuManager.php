<?php

/**
 * This is the model class for table "tbl_MenuManager".
 *
 * The followings are the available columns in table 'tbl_MenuManager':
 * @property integer $MenuId
 * @property string $MenuTitle
 * @property string $MetaTagDescription
 * @property string $MetaTagKeywords
 * @property integer $Parent
 * @property string $MenuContent
 * @property string $PageUrl
 * @property integer $SortOrder
 * @property string $Status
 * @property integer $MId
 * @property integer $CreatedBy
 * @property string $CreatedOn
 * @property integer $ModifiedBy
 * @property string $ModifiedOn
 */
class TblMenuManager extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblMenuManager the static model class
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
        return 'tbl_MenuManager';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('MenuTitle, MetaTagDescription, MetaTagKeywords, MenuContent', 'required'),
            array('Parent, SortOrder, MId, CreatedBy, ModifiedBy', 'numerical', 'integerOnly'=>true),
            array('MenuTitle, MetaTagDescription, MetaTagKeywords, MenuContent, PageUrl', 'length', 'max'=>255),
            array('Status', 'length', 'max'=>8),
            array('CreatedOn, ModifiedOn', 'safe'),
        		
        		array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
        		array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
        		array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
        		array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
        		array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('MenuId, MenuTitle, MetaTagDescription, MetaTagKeywords, Parent, MenuContent, PageUrl, SortOrder, Status, MId, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn', 'safe', 'on'=>'search'),
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
            'MenuId' => 'Menu',
            'MenuTitle' => 'Menu Title',
            'MetaTagDescription' => 'Meta Tag Description',
            'MetaTagKeywords' => 'Meta Tag Keywords',
            'Parent' => 'Parent',
            'MenuContent' => 'Menu Content',
            'PageUrl' => 'Page Url',
            'SortOrder' => 'Sort Order',
            'Status' => 'Status',
            'MId' => 'Mid',
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

        $criteria->compare('MenuId',$this->MenuId);
        $criteria->compare('MenuTitle',$this->MenuTitle,true);
        $criteria->compare('MetaTagDescription',$this->MetaTagDescription,true);
        $criteria->compare('MetaTagKeywords',$this->MetaTagKeywords,true);
        $criteria->compare('Parent',$this->Parent);
        $criteria->compare('MenuContent',$this->MenuContent,true);
        $criteria->compare('PageUrl',$this->PageUrl,true);
        $criteria->compare('SortOrder',$this->SortOrder);
        $criteria->compare('Status',$this->Status,true);
        $criteria->compare('MId',$this->MId);
        $criteria->compare('CreatedBy',$this->CreatedBy);
        $criteria->compare('CreatedOn',$this->CreatedOn,true);
        $criteria->compare('ModifiedBy',$this->ModifiedBy);
        $criteria->compare('ModifiedOn',$this->ModifiedOn,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}