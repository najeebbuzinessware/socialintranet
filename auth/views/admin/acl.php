<div id="outer_container" class="custom_background">

<?php $this->renderpartial('application.views.admin._adminTopmenu'); ?>
<div class="container_12">
  <div class="grid_12 box shadowed_little">
    <div class="padding">     
                         <h2 class="headline1 noMargUp LEFT"><?=Yii::t("translate","Access Control List") ?></h2>                         			     
                    <div class="clear"></div>
		    <div class="s-lined"></div>
		    <div class="tinymargin"></div>
		    <p class="normaltxt1 noMargDown noMargUp"><?=Yii::t("translate","Control the permissions of different user groups.") ?></p>
    <div class="tinymargin"></div>
    
    
      <div class="bodyControls"> </div>
      <?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>'group-form',
						'enableClientValidation'=>true,
						'enableAjaxValidation'=>true,
						'clientOptions' => array('validateOnSubmit' => true,'validateOnType'=>false),
						)); ?>
      <table class="default" cellpadding="10" cellspacing="0" border="0">
        <?php  $this->widget('zii.widgets.CListView', array(
                            'dataProvider'=>$dataProvider,
                            'itemView'=>'_groupmodule',
                            'template'=>"{items}\n{pager}",
							'cssFile'=>false,
                        )); ?>
      </table>
      <?php $this->endWidget(); ?>
    </div>
  </div>
</div>
