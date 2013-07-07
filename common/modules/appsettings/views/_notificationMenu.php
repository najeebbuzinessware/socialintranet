        <?php //print_r(BWNotiticationFunctions::checkModulesHasFrontend());echo "<br>";print_r(BWNotiticationFunctions::getAssignModules());?>
        <?php if($_GET['type']=='leads'){$gtype="/sales";}else if($_GET['type']=='Projects'){$gtype="/projects";}else if($_GET['type']=='Careers'){$gtype="/careers-admin";} ?>
        <ul class="tabs hoverEffect stick">        
        <li> 
        	<a href="<?php echo $gtype ?>/appsettings/notifications/general/type/<?=$_GET['type'];?>"  <? if(Yii::app()->controller->action->id=="general"){ ?> class="active" <? } ?>>
			<?php echo Yii::t('translate','General'); ?>
            </a>
        </li>
        <li>
        	<a href="<?php echo $gtype ?>/appsettings/notifications/index/type/<?=$_GET['type'];?>" <? if((Yii::app()->controller->id=="notifications" && Yii::app()->controller->action->id=="index")||(Yii::app()->controller->id=="notifications" && Yii::app()->controller->action->id=="addTemplate")||(Yii::app()->controller->id=="notifications" && Yii::app()->controller->action->id=="editTemplate")){ ?> class="active" <? } ?>>
			<?php echo Yii::t('translate','Rules & Notifications'); ?>
           	</a>
        </li>        
        <?php 
			$modules = BWNotiticationFunctions::checkModulesHasFrontend();
			$show = "";
			foreach($modules as $key=>$val)
			{
				if(!in_array($val,BWNotiticationFunctions::getAssignModules()))
				{ 
					$show = "style='display:none'";
				}
			}
		?>
        <li <?=$show ?>>
        	<a href="/appsettings/settings/index/type/<?=$_GET['type']?>" <? if(Yii::app()->controller->id=="settings"){ ?> class="active" <? } ?>><?php echo Yii::t('translate','Frontend'); ?></a>
        </li>
      
        <li>
        	<a href="<?php echo $gtype ?>/appsettings/products/index/type/<?=$_GET['type']?>" <? if(Yii::app()->controller->id=="products"){ ?> class="active" <? } ?>>
			<?php echo Yii::t('translate','Catalogue'); ?>
            </a>
        </li>
        <!--    <li><a href="/members/settings/appsettings/type/<?=$_GET['type'];?>"><?php echo Yii::t('translate','App Setting'); ?></a></li>-->
        </ul>