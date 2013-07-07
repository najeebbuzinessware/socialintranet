<?php

/**
 * This is the model class for table "tbl_ProductCatalog".
 *
 * The followings are the available columns in table 'tbl_ProductCatalog':
 * @property integer $PId
 * @property string $Type
 * @property integer $Gid
 * @property string $MId
 * @property string $Term
 * @property string $Name
 * @property string $Description
 * @property integer $ProductHours
 * @property string $Hidden
 * @property integer $WelcomeEmail
 * @property string $StockControl
 * @property integer $Qty
 * @property string $ProrataBilling
 * @property integer $ProrataDate
 * @property integer $ProrataChargeNextMonth
 * @property string $PayType
 * @property integer $AutoTerminateDays
 * @property string $AutoTerminateEmail
 * @property string $UpgradePackages
 * @property string $ConfigOptionsUpgrade
 * @property string $BillingCycleUpgrade
 * @property string $UpgradeEmail
 * @property string $ExpiryDate
 * @property integer $GlobalForm
 * @property integer $DisplayOrder
 * @property string $ProductType
 * @property string $CType
 * @property integer $CreatedBy
 * @property integer $CreatedOn
 * @property integer $LastViewedBy
 * @property integer $LastViewedOn
 * @property integer $ModifiedBy
 * @property integer $ModifiedOn
 */
class TblProductCatalog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblProductCatalog the static model class
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
		return 'tbl_ProductCatalog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Gid, MId, Name, Description, ProductHours, Hidden, ExpiryDate, ProductType', 'required'),
			array('Gid, ProductHours, WelcomeEmail, Qty, ProrataDate, ProrataChargeNextMonth, AutoTerminateDays, GlobalForm, DisplayOrder, CreatedBy, CreatedOn, LastViewedBy, LastViewedOn, ModifiedBy, ModifiedOn', 'numerical', 'integerOnly'=>true),
			array('MId', 'length', 'max'=>10),
			array('Term, CType', 'length', 'max'=>255),
			array('ProductType', 'length', 'max'=>9),
			array('Type, StockControl, ProrataBilling, PayType, AutoTerminateEmail, UpgradePackages, ConfigOptionsUpgrade, BillingCycleUpgrade, UpgradeEmail', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PId, Type, Gid, MId, Term, Name, Description, ProductHours, Hidden, WelcomeEmail, StockControl, Qty, ProrataBilling, ProrataDate, ProrataChargeNextMonth, PayType, AutoTerminateDays, AutoTerminateEmail, UpgradePackages, ConfigOptionsUpgrade, BillingCycleUpgrade, UpgradeEmail, ExpiryDate, GlobalForm, DisplayOrder, ProductType, CType, CreatedBy, CreatedOn, LastViewedBy, LastViewedOn, ModifiedBy, ModifiedOn', 'safe', 'on'=>'search'),
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
			'PId' => 'Pid',
			'Type' => 'Type',
			'Gid' => 'Gid',
			'MId' => 'Mid',
			'Term' => 'Term',
			'Name' => 'Name',
			'Description' => 'Description',
			'ProductHours' => 'Product Hours',
			'Hidden' => 'Hidden',
			'WelcomeEmail' => 'Welcome Email',
			'StockControl' => 'Stock Control',
			'Qty' => 'Qty',
			'ProrataBilling' => 'Prorata Billing',
			'ProrataDate' => 'Prorata Date',
			'ProrataChargeNextMonth' => 'Prorata Charge Next Month',
			'PayType' => 'Pay Type',
			'AutoTerminateDays' => 'Auto Terminate Days',
			'AutoTerminateEmail' => 'Auto Terminate Email',
			'UpgradePackages' => 'Upgrade Packages',
			'ConfigOptionsUpgrade' => 'Config Options Upgrade',
			'BillingCycleUpgrade' => 'Billing Cycle Upgrade',
			'UpgradeEmail' => 'Upgrade Email',
			'ExpiryDate' => 'Expiry Date',
			'GlobalForm' => 'Global Form',
			'DisplayOrder' => 'Display Order',
			'ProductType' => 'Product Type',
			'CType' => 'Ctype',
			'CreatedBy' => 'Created By',
			'CreatedOn' => 'Created On',
			'LastViewedBy' => 'Last Viewed By',
			'LastViewedOn' => 'Last Viewed On',
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

		$criteria->compare('PId',$this->PId);
		$criteria->compare('Type',$this->Type,true);
		$criteria->compare('Gid',$this->Gid);
		$criteria->compare('MId',$this->MId,true);
		$criteria->compare('Term',$this->Term,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('ProductHours',$this->ProductHours);
		$criteria->compare('Hidden',$this->Hidden,true);
		$criteria->compare('WelcomeEmail',$this->WelcomeEmail);
		$criteria->compare('StockControl',$this->StockControl,true);
		$criteria->compare('Qty',$this->Qty);
		$criteria->compare('ProrataBilling',$this->ProrataBilling,true);
		$criteria->compare('ProrataDate',$this->ProrataDate);
		$criteria->compare('ProrataChargeNextMonth',$this->ProrataChargeNextMonth);
		$criteria->compare('PayType',$this->PayType,true);
		$criteria->compare('AutoTerminateDays',$this->AutoTerminateDays);
		$criteria->compare('AutoTerminateEmail',$this->AutoTerminateEmail,true);
		$criteria->compare('UpgradePackages',$this->UpgradePackages,true);
		$criteria->compare('ConfigOptionsUpgrade',$this->ConfigOptionsUpgrade,true);
		$criteria->compare('BillingCycleUpgrade',$this->BillingCycleUpgrade,true);
		$criteria->compare('UpgradeEmail',$this->UpgradeEmail,true);
		$criteria->compare('ExpiryDate',$this->ExpiryDate,true);
		$criteria->compare('GlobalForm',$this->GlobalForm);
		$criteria->compare('DisplayOrder',$this->DisplayOrder);
		$criteria->compare('ProductType',$this->ProductType,true);
		$criteria->compare('CType',$this->CType,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('CreatedOn',$this->CreatedOn);
		$criteria->compare('LastViewedBy',$this->LastViewedBy);
		$criteria->compare('LastViewedOn',$this->LastViewedOn);
		$criteria->compare('ModifiedBy',$this->ModifiedBy);
		$criteria->compare('ModifiedOn',$this->ModifiedOn);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}