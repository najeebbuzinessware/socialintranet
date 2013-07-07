<?php

/**
 * This is the model class for table "tbl_NewsRss".
 *
 * The followings are the available columns in table 'tbl_NewsRss':
 * @property integer $RssId
 * @property string $ItemName
 * @property string $RssLink
 * @property integer $UserId
 * @property integer $MId
 * @property string $CreateDate
 * @property integer $CreatedBy
 * @property string $ModifiedDate
 * @property integer $ModifiedBy
 */
class TblNewsRss extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblNewsRss the static model class
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
        return 'tbl_NewsRss';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('RssLink', 'required'),
            array('UserId, NumberOfNews, MId, CreatedBy, ModifiedBy', 'numerical', 'integerOnly'=>true),
            array('ItemName, RssLink', 'length', 'max'=>255),
            array('CreateDate, ModifiedDate', 'safe'),
        		array('ModifiedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'update'),
        		array('ModifiedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'update'),
        		array('CreatedOn','default','value'=>time(),'setOnEmpty'=>false,'on'=>'insert'),
        		array('CreatedBy','default','value'=>Yii::app()->user->Id,'setOnEmpty'=>false,'on'=>'insert'),
        		array('MId','default','value'=>Yii::app()->user->MId,'setOnEmpty'=>false,'on'=>'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('RssId, ItemName, RssLink, UserId, MId, NumberOfNews, CreateDate, CreatedBy, ModifiedDate, ModifiedBy', 'safe', 'on'=>'search'),
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
            'RssId' => 'Rss',
            'ItemName' => 'Item Name',
            'RssLink' => 'Feed URL',
            'UserId' => 'User',
        	'NumberOfNews' =>'Number of News',
            'MId' => 'Mid',
            'CreateDate' => 'Create Date',
            'CreatedBy' => 'Created By',
            'ModifiedDate' => 'Modified Date',
            'ModifiedBy' => 'Modified By',
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

        $criteria->compare('RssId',$this->RssId);
        $criteria->compare('ItemName',$this->ItemName,true);
        $criteria->compare('RssLink',$this->RssLink,true);
        $criteria->compare('UserId',$this->UserId);
        $criteria->compare('MId',$this->MId);
        $criteria->compare('CreateDate',$this->CreateDate,true);
        $criteria->compare('CreatedBy',$this->CreatedBy);
        $criteria->compare('ModifiedDate',$this->ModifiedDate,true);
        $criteria->compare('ModifiedBy',$this->ModifiedBy);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function getRssFeed()
    {
    	$feedcriteria = new CDbCriteria;
    	$feedcriteria->condition = "UserId=".Yii::app()->user->Id." and MId = '".Yii::app()->user->MId."'";
    	$feedcriteria->group = "ItemName";
    	$feedmodel = TblNewsRss::model()->findAll($feedcriteria);
    		
    	if(count($feedmodel)>0)
    	{
    		$count="";
    		foreach($feedmodel as $keyrss=>$valrss)
    		{
    			if(strlen($valrss['RssLink'])>0)
    			{
    				if($valrss['NumberOfNews']>0){$limit=$valrss['NumberOfNews'];}else{$limit=3;}
    				$this->widget('application.extensions.yii-feed-widget.YiiFeedWidget'.$count,array('url'=>$valrss['RssLink'],'limit'=>$limit));
    				$count+=1;
    			}
    		}
    	}
    	
    }
}