<?php $this->renderpartial('common.views.common._common'); ?>
<div class="grid_9">
  <div class="halfmargin"></div>
  <p class="headline2 mainNav">
		<a href="<?php echo Yii::app()->params['appurl']?>user/profile" <? if(Yii::app()->controller->action->id=="profile"){ ?> class="active" <? } ?>>
			<?=Yii::t('translate','My Profile')?>
      	</a> <a href="<?php echo Yii::app()->params['appurl']?>user/recycle" <? if(Yii::app()->controller->action->id=="recycle"){ ?> class="active" <? } ?>>
			<?=Yii::t('translate','Recycle Bin')?>
      	</a>
	</p>
</div>
</div>
</div>
<div class="halfmargin"></div>

