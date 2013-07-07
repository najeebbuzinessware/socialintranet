<?php if($_GET['type']=='leads'){$gtype="/sales";}else if($_GET['type']=='Projects'){$gtype="/projects";}else if($_GET['type']=='Careers'){$gtype="/careers-admin";} ?>
<tr id="templ_<?php echo $data['TempId']; ?>">
    <td><?=$data['TemplateName'] ?></td>
    <td><? if($data['ModifiedOn']!=''){echo date("h A, d M, Y",$data['ModifiedOn']);}else{echo date("h A, d M, Y",$data['CreatedOn']);}?></td>
    <td class="hasIcons">
        <a href="#" title="Delete Template" data-delID="<?=$data['TempId'] ?>" class="icon trashIcon tempTrash" id="delete<?=$data['TempId'] ?>"></a> 
        <a href="<?php echo $gtype ?>/appsettings/notifications/editTemplate/type/<?=$_GET['type']?>/id/<?=$data['TempId']?>" title="Edit Template" class="icon smallEditIcon" id="ed<?=$data['TempId'] ?>"></a>
    </td>
</tr>
