<?php 
	$ModuleName = TblModules::model()->findByPk($data->ModuleId); 
	$ActionList = TblModuleTask::model()->findAllByAttributes(array("ModuleId"=>$data->ModuleId)); 
	if(count($ActionList)>0)
	{
?>
    <tr>
      <td class="headline3"><?php echo $ModuleName->Module; ?></td>
      <? 
	  	$colspan = (4-count($ActionList));
        foreach($ActionList as $key=>$value)
		{
			if($colspan){ $colsp = "colspan='".($colspan+1)."'";}
			$optionselected = '';
			$AuthChild = TblSysAuthItemChild::model()->findByAttributes(array('child'=>$value->Task,'MId'=>Yii::app()->user->MId,'parent'=>$groupname));
			
			if(count($AuthChild)>0)
			{
				$optionselected = 'checked="checked"';
			}
    ?>
      <td <?=$colsp ?> align="left">
      	<input type="checkbox" name="configoption[<?=$groupname ?>][<?=$value->Task ?>]" value="Yes"  class="checkbox" <?=$optionselected ?>  />
      </td>
      <?  $count++; } ?>
    </tr>
<? } ?>
