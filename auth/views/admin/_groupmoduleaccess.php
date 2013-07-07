<?php
$criteria = new CDbCriteria();
$criteria->condition = "Parent = '" . $data->ModuleId . "' AND Visible LIKE 'Yes'";
$datamodel = TblModules::model()->findAll( $criteria );
$columnArray = array( "Add", "Edit", "View", "Delete", "Settings" );
if (count( $datamodel ) > 0)
{
	foreach ( $datamodel as $key => $val )
	{
		$ModuleName = TblModules::model()->findByPk( $val['ModuleId'] );
		$ParentModule = TblModules::model()->findByAttributes( array( 'ModuleId' => $ModuleName->Parent ) );
?>
<tr>
	<td class="headline3"><?php echo $ParentModule->Module."-".$ModuleName->Module; ?></td>
          <?
			for($x=0;$x<=count($columnArray)-1;$x++)
			{
				$actioncriteria = new CDbCriteria();
				$actioncriteria->condition = "ModuleId=" . $val['ModuleId']." AND Label='". $columnArray[$x]."'";
				$ActionList = TblModuleTask::model()->find( $actioncriteria );
				$Found = 'No';
				if(!is_null($ActionList))
				{
					$Found = 'Yes';
				}
			$optionselected = '';
			$AuthChild = TblSysAuthItemChild::model()->findByAttributes( array( 'child' => $ActionList->Task, 'MId' => Yii::app()->user->MId, 'parent' => $groupname ) );
			$classGreen = "";
			if (count( $AuthChild ) > 0)
			{
				$optionselected = 'checked="checked"';
				$classGreen = 'class="backGREEN"';
			}
			?>
	          		<?php if($Found == 'Yes'){ ?>
	          			<td <?=$classGreen ?>><input type="checkbox" name="configoption[<?=$groupname ?>][<?=$ActionList->Task ?>]" value="Yes" class="checkbox" <?=$optionselected ?> /></td>
					<?php }else{	?>
          				<td>-</td>
          			<?php } ?>
	         <?php } ?>          			
        </tr>
<?php } }  ?>