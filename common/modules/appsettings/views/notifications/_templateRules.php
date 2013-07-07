<? 
	$actionarray = BWDataFunction::getActionForNotifications(); 
	$responseArray = BWDataFunction::getResponsesForNotifications(); 
	$template = BWCFunctions::getRecordsByPk("TblTemplates",$data['TemplateId']);
?>

<tr id="rule_<?=$data['RuleId'] ?>">
  <td class="cornGreen"><?=$actionarray[$data['Action']]; ?></td>
  <td><?=$responseArray[$data['Action']]; ?></td>
  <td><?=$template['TemplateName'] ?></td>
  <td><?=BWCFunctions::get_day_name(strtotime($data['CreatedOn'])); ?></td>
  <td class="hasIcons"><a href="#" title="Delete Rule" data-delID="<?=$data['RuleId'] ?>" class="icon deleteIcon" id="delete<?=$data['RuleId'] ?>"></a> <a href="#editRule" title="Edit Rule" data-ID="<?=$data['RuleId'] ?>" class="icon editIcon InlineModalTrigger" id="ed<?=$data['RuleId'] ?>"></a> </td>
</tr>
