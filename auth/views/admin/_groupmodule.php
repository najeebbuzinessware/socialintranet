<? 
$criteria = new CDbCriteria();
$criteria->condition = 'MId='.Yii::app()->user->MId;
$modaccess = TblModuleAccess::model()->findAll($criteria);

if(count($modaccess)>0)
{
	$accessmodule = "0";
	$comma=",";
	foreach($modaccess as $keyacc=>$valacc)
	{
		$accessmodule .=$comma.$valacc['ModuleId'];
		$comma=",";
	}

	$dataProvider=new CActiveDataProvider('TblModules', array(
        'criteria'=>array(
                'condition'=>"Parent = '0' AND Visible ='Yes' and ModuleId in (".$accessmodule.")",
        ),
		'pagination'=>false, 
	)); 
?>

<tr class="actionRow foldable">
  <td class="title">
  	<h4 class="headline2">
      <?=$data->name ?>
    </h4>
  </td>
  <td class="controls">
  	<? echo CHtml::hiddenField("groupname[]",$data->name); ?> 
    <a href="#" title="Show / Hide Options" class="icon foldIcon"></a> 
    <a href="#" title="Edit Group Name" class="icon editIcon"></a> 
    <a href="javascript:void(0);" onclick="document.forms['group-form'].submit();" title="Save" class="icon saveIcon"></a>
  </td>
</tr>
<tr>
  <td colspan="2" class="holder">
  	<div class="safeWrapper">
      <table class="ACL" cellpadding="10" cellspacing="0" border="0" width="98%">
        <tr class="trheader">
          <th><?php echo Yii::t('translate','Modules');?></th>
          <th><?php echo Yii::t('translate','Add');?> </th>
          <th><?php echo Yii::t('translate','Edit');?> </th>
          <th><?php echo Yii::t('translate','View');?> </th>
          <th><?php echo Yii::t('translate','Delete');?> </th>
          <th><?php echo Yii::t('translate','Settings');?> </th>
        </tr>
        <?php 
			$this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'viewData' => array( 'groupname' =>$data->name), 
				'itemView'=>'_groupmoduleaccess',
				'template'=>"{items}\n{pager}",
			)); ?>
        
      </table>
    </div>
  </td>
</tr>
<? } ?>
