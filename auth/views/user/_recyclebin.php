<?
$recdata = BWCFunctions::getRecordsByPk( $data['TableName'], $data['RecordID'] );
if ($data['FieldName'] == "UserId")
{
	$Users = TblSysUsers::model()->findByPk( $recdata['UserId'] );
	$recordTitle = $Users['Name'];
} else
{
	$recordTitle = $recdata[$data['FieldName']];
}
if ($data['TableName'] == 'TblLead')
{
	$clientData = BWCFunctions::getRecordsByPk( 'TblContacts', $recdata['ContactId'] );
	$recordTitle = $clientData['FName'];
}
$deleteby = TblSysUsers::model()->findByPk( $data['UserID'] );
$jsid = $data['RecycleID'];
if (count( $recdata ) > 0)
{
	?>
<table class="ACL fixedLayout" cellpadding="10" cellspacing="0" border="0">
	<tr id="rec_<?=$jsid ?>" class="<?=$val['TableName'] ?>post">
		<td class="headline3"><?=$recordTitle ?></td>
		<td><?=BWCFunctions::get_day_name($data['DateTime'])?></td>
		<td><?=$deleteby['Name'] ?></td>
		<td class="hasIcons"><a href="#" title="Recover Item" class="icon recoverIcon" data-id="<?=$data['RecycleID']?>" jsid="<?=$jsid?>" id="restorelink<?=$data['RecycleID'] ?>" onclick="restoreItem(this)"></a> <?
	
echo CHtml::ajaxLink( '', array( '/user/purge/id/' . $data['RecycleID'] ), 
			array( 
				'type' => 'get', 
				'data' => '', 
				'success' => 'function(data) { if(data.success==true){
	 $("#rec_' . $jsid . '").hide(); noticeAjax("Record Deleted Successfully...!","success");
	 } }', 
				'dataType' => 'json', 
				'update' => 'test' ), array( 'confirm' => 'Are you sure, you want to delete this record ' . $recdata[$data['FieldName']] . ' permanantaly?', 'class' => 'icon trashIcon', "title" => "Delete Permanently" ) );
	?> 
    </td>
	</tr>
</table>
<?php } ?>
<script type="application/javascript" language="javascript">
	function restoreItem(obj)
	{
	  $.ajax({
			  type:'POST',
			  url: '/user/restore/id/'+$("#"+obj.id).attr('data-id'),
			  success: function(data) { 
			  var myObject = eval('(' + data + ')');
			  if(myObject.success==true){
				$("#rec_"+$("#"+obj.id).attr('jsid')).hide(); 
				noticeAjax("Record Restored Successfully...!","success");
			  stop();
			  }
		   } 
		 });
	}
</script>
