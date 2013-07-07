  <table class="ACL">
                    <?php $criteria = new CDbCriteria();
                    $criteria->condition = "(CType='".$_GET['type']."' or CType='') and MId=".Yii::app()->user->MId;
                    $moddata = TblNotificationTemplateVariables::model()->findAll($criteria);
                    	if(count($moddata)>0){
                    	foreach($moddata as $key=>$val){?>
                    <tr><td>%%<?php echo $val['TVariables'];?>%%</td><td width="20%"><?php echo $val['Description'];?></td></tr>
                    <?php }}?>
                      <tr><td>%%Signature%%</td><td>Signature</td></tr>
                    </table>