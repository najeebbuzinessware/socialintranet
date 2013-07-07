<?php $this->renderpartial('common.views.common._common'); ?>
<div class="grid_9">
    <div class="halfmargin"></div>
  <?php if(Yii::app()->user->UserType == 'Admin') { ?>
  <p class="headline2 mainNav"> 
    	
      	
    	<a href="/admin/customization" <? if(Yii::app()->controller->action->id=="customization"){ ?> class="active" <? } ?>>
			<?=Yii::t('translate','Branding') ?>
      	</a>
      	
    	<a href="/admin/listDepartments" <? if(Yii::app()->controller->action->id=="listDepartments"){ ?> class="active" <? } ?>>
		  	<?=Yii::t('translate','Departments') ?>
      	</a>
      	<a href="/admin/listGroups" <? if(Yii::app()->controller->action->id=="listGroups"){ ?> class="active" <? } ?>>
		  	<?=Yii::t('translate','Groups') ?>
      	</a>
      	<a href="/admin/listUser" <? if(Yii::app()->controller->action->id=="listUser"){ ?> class="active" <? } ?>>
		  	<?=Yii::t('translate','Users') ?>
      	</a> 
      	<a href="/admin/acl" <? if(Yii::app()->controller->action->id=="acl"){ ?> class="active" <? } ?>>
		  	<?=Yii::t('translate','Permissions') ?>
      	</a>      	
      	
      </p>
  </div>
  <? } ?>
  
</div>
</div>
<div class="halfmargin"></div>