<?php
	$modelTemplateName = TblTemplates::model()->findByPk($data['TemplateId']);
	$modelTemplateAction = TblNotificationActions::model()->findByPk($data['Action']);
?>
<tr id="rules_<?php echo $data['RuleId']; ?>">
    <td><?=ucfirst(preg_replace("/(?<=[a-zA-Z])(?=[A-Z])/", " ", $data['Action']));//$modelTemplateAction['ActionName'] ?></td>
    <td><?=$modelTemplateName['TemplateSubject'] ?></td>
    <td><? if($data['ModifiedOn']!=''){echo date("h A, d M, Y",$data['ModifiedOn']);}else{echo date("h A, d M, Y",$data['CreatedOn']);}?></td>
    <td class="hasIcons">
        <a href="#" title="Delete Rule" data-RuleID="<?=$data['RuleId'] ?>" class="icon trashIcon ruleTrash" id="delete<?=$data['RuleId'] ?>"></a>
        <a href="#editRule" title="Edit Rule" data-ruleID="<?=$data['RuleId'] ?>" class="icon editIcon InlineModalTrigger" id="edrule<?=$data['RuleId'] ?>"></a>
    </td>
</tr>
