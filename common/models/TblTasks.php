<?php

/**
 * This is the model class for table "tbl_Tasks".
 *
 * The followings are the available columns in table 'tbl_Tasks':
 * @property integer $TaskId
 * @property integer $MId
 * @property string $Description
 * @property integer $TagId
 * @property integer $AssignTo
 * @property string $DueDate
 * @property string $ShowToAll
 * @property string $Status
 * @property string $CreateDate
 * @property integer $CreatedBy
 * @property string $ModifiedDate
 * @property integer $ModifiedBy
 * @property integer $IsDelete
 */ 
class TblTasks extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblTasks the static model class
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
        return 'tbl_Tasks';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Description, DueDate', 'required'),
            array('MId, TagId, ShowToAll, AssignTo, CreatedBy, ModifiedBy, IsDelete', 'numerical', 'integerOnly'=>true),
            //array('ShowToAll', 'length', 'max'=>3),
            array('Status', 'length', 'max'=>11),
            array('DueDate, CreateDate, ModifiedDate', 'safe'),
        		
        		array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
        		array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
        		array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
        		array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
        		array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
        		
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('TaskId, MId, Description, TagId, AssignTo, DueDate, DueTime, ShowToAll, Status, CreateDate, CreatedBy, ModifiedDate, ModifiedBy, IsDelete', 'safe', 'on'=>'search'),
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
            'TaskId' => 'Task',
            'MId' => 'Mid',
            'Description' => 'Add a task',
            'TagId' => 'Choose a Tags',
            'AssignTo' => 'Who\'s responsible?',
            'DueDate' => 'When\'s it due?',
        	'DueTime' => 'Time',
            'ShowToAll' => 'Let everyone see this task',
            'Status' => 'Status',
            'CreateDate' => 'Create Date',
            'CreatedBy' => 'Created By',
            'ModifiedDate' => 'Modified Date',
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

        $criteria->compare('TaskId',$this->TaskId);
        $criteria->compare('MId',$this->MId);
        $criteria->compare('Description',$this->Description,true);
        $criteria->compare('TagId',$this->TagId);
        $criteria->compare('AssignTo',$this->AssignTo);
        $criteria->compare('DueDate',$this->DueDate,true);
        $criteria->compare('DueTime',$this->DueTime,true);
        $criteria->compare('ShowToAll',$this->ShowToAll);
        $criteria->compare('Status',$this->Status,true);
        $criteria->compare('CreateDate',$this->CreateDate,true);
        $criteria->compare('CreatedBy',$this->CreatedBy);
        $criteria->compare('ModifiedDate',$this->ModifiedDate,true);
        $criteria->compare('ModifiedBy',$this->ModifiedBy);
        $criteria->compare('IsDelete',$this->IsDelete);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    
    public function getUsersTasks($limit=10)
    {
    	$taskcriteria = new CDbCriteria;
		$taskcriteria->condition = "(AssignTo=".Yii::app()->user->Id." or CreatedBy=".Yii::app()->user->Id." or ShowToAll=1) and MId = '".Yii::app()->user->MId."'";
		$taskcriteria->order = "DueDate ASC";
		$taskcriteria->limit = $limit;
		$taskmodel = TblTasks::model()->findAll($taskcriteria);
    	return $taskmodel;
    }
    
    public function getVisibilityoption($key)
    {
    	$options = array("0"=>"No","1"=>"Yes");
    	return $options[$key];
    }
    
    public function getTaskStatus($key=NULL)
    {
    	$options = array('Pending'=>'Pending','Completed'=>'Completed','Cancelled'=>'Cancelled','In Progress'=>'In Progress');
    	if(strlen($key)>0){
    		return $options[$key];
    	}else{
    		return $options;
    	}
    }
}