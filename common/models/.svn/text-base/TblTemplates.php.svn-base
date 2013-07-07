<?php

/**
 * This is the model class for table "tbl_Templates".
 *
 * The followings are the available columns in table 'tbl_Templates':
 * @property integer $TempId
 * @property string $TemplateSubject
 * @property string $Template
 * @property integer $MId
 * @property string $TemplateType
 * @property string $CreatedOn
 * @property integer $CreatedBy
 * @property string $ModifiedOn
 * @property integer $ModifiedBy
 * @property integer $IsDelete
 * @property string $TemplateName
 */
class TblTemplates extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblTemplates the static model class
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
        return 'tbl_Templates';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('TemplateSubject, TemplateName, senderMailId, senderName', 'required'),
			array('Template','TemplateCheck'),
			//array('senderMailId, carbonCopy', 'emailValidator'),
			array('senderMailId', 'email'),
			array('TemplateName', 'uniqueValidator'),
            array('MId, CreatedBy, ModifiedBy, IsDelete', 'numerical', 'integerOnly'=>true),
            array('TemplateType', 'length', 'max'=>5),
            array('TemplateName', 'length', 'max'=>255),
            array('CreatedOn, ModifiedOn', 'safe'),
			array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
			array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
        	array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
        	array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('TempId, TemplateSubject, Template, MId, TemplateType, CreatedOn, CreatedBy, ModifiedOn, ModifiedBy, IsDelete, TemplateName', 'safe', 'on'=>'search'),
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
			'moduleAccess' => array(self::HAS_MANY, 'TblSysModuleAccess', 'ModuleId'),
        );
    }

	public function TemplateCheck($object,$attribute)
	{
		if(strlen(trim($this->Template,' ')) <= 6)
		{
			$message = 'Template cannot be blank.';
			$this->addError('Template',$message);
		}
	}
	
	public function emailValidator($object,$attribute)
	{
		$explode = explode(',', $this->tomail);
		$error = array();
		if(count($explode)>0) 
		{		
			foreach($explode as $key=>$val)
			{
				$error[$key] = $this->is_valid_email($val);
			}
			if(in_array(false,$error))
			{
				echo $message = 'Please Enter Valid Email or Email maximum is 10 entries Allowed.';
				$this->addError($object,$message);
			}
		}
		else
		{
			$error[] = $this->is_valid_email($this->tomail);
		
			/*if(in_array(false,$error))
			{*/
			$message = 'Please Enter Valid Email or Email maximum is 10 entries Allowed.';
			$this->addError($object,$message);
			//}
		}
	}
	
	public function is_valid_email($email)
	{
		$result = TRUE;
		if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) 
		{
			$result = FALSE;
		}
		return $result;
	}



    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'TempId' => 'Temp',
            'TemplateSubject' => 'Template Subject',
            'Template' => 'Template',
            'MId' => 'Mid',
            'TemplateType' => 'Template Type',
            'CreatedOn' => 'Created On',
            'CreatedBy' => 'Created By',
            'ModifiedOn' => 'Modified On',
            'ModifiedBy' => 'Modified By',
            'IsDelete' => 'Is Delete',
            'TemplateName' => 'Template Name',
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

        $criteria->compare('TempId',$this->TempId);
        $criteria->compare('TemplateSubject',$this->TemplateSubject,true);
        $criteria->compare('Template',$this->Template,true);
        $criteria->compare('MId',$this->MId);
        $criteria->compare('TemplateType',$this->TemplateType,true);
        $criteria->compare('CreatedOn',$this->CreatedOn,true);
        $criteria->compare('CreatedBy',$this->CreatedBy);
        $criteria->compare('ModifiedOn',$this->ModifiedOn,true);
        $criteria->compare('ModifiedBy',$this->ModifiedBy);
        $criteria->compare('IsDelete',$this->IsDelete);
        $criteria->compare('TemplateName',$this->TemplateName,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
	
	public function uniqueValidator($object,$attribute)
	{
		if(strlen($this->TemplateName)>1 && $this->TempId<1)
		{
			$criteria = new CDbCriteria();
			$criteria->condition = 'IsDelete=0 and MId='.Yii::app()->user->MId.' and TemplateName="'.$this->TemplateName.'"';
			$result = TblTemplates::model()->findAll($criteria);
			if(count($result)>0)
			{
				$message = Yii::t('translate','Template Name "'.$this->TemplateName.'" has already been taken');
				$this->addError($object,$message);
			}
		}
	}
}