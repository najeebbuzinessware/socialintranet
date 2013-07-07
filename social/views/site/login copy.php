<div id="outer_container" class="custom_background">
     <div class="top_menu"></div>
     <div class="login_box_container">
<!--           <center> -->
          	<? $logo =  Yii::app()->params['FrontEndLogo'];//BWCFunctions::getLoginpageLogofromHostName(); ?>
               <a href="http://buzinessware.com" target="_blank"> <img alt="" border="0" src="<?=$logo ?>" /> </a>
<!--           </center> -->
          <div class="margin"></div>
          <?php //$form=$this->beginWidget('CActiveForm', array(	'id'=>'login-form',	 'enableClientValidation'=>true)); ?>
          <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form', 'enableClientValidation'=>true,'htmlOptions'=>array('class'=>''))); ?>
          <div class="box login_box shadowed padding">
               <h1 class="headline1 smallLockIcon"><?php echo Yii::t('translate','Welcome'); ?></h1>
               <p class="normaltxt2"><?php echo Yii::t('translate','Client Login Area.'); ?></p>
               <div class="halfmargin"></div>
               <?php 
               $username_translate = Yii::t('translate','Your username here...');
               echo $form->textFieldRow($model,'username',array('class'=>'btn-block btn-block-prepend', 'prepend'=>'<i class="icon-user"></i>', 'style'=>'height:30px; width:280px;', "prompt"=>"$username_translate")); ?>
               <?php //echo $form->error($model,'username'); ?>
               <div class="halfmargin"></div>
               <?php 
               $password_translate = Yii::t('translate','Your password here...');
               echo $form->passwordFieldRow($model,'password',array('class'=>'btn-block btn-block-appended', 'prepend'=>'<i class="icon-key"></i>', 'style'=>'height:30px;width:280px !important;',"prompt"=>"$password_translate")); ?>
               <?php //echo $form->error($model,'password'); ?>
               <div class="halfmargin"></div>
               <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>Yii::t('translate','SIGN IN'))); ?>
               <?php //echo CHtml::submitbutton(Yii::t('translate','SIGN IN'),array("submit"=>"/site/login","class"=>"btn"));?>
               <div class="clear"></div>
               <p>
                    <label>
                         <?php echo $form->checkBoxRow($model,'rememberMe',array('class'=>'checkbox')); ?>
                         <?php echo Yii::t('translate','Remember'); ?></label> | <a href="#"><?php echo Yii::t('translate','Help'); ?></a></p>
          </div>
          <?php $this->endWidget(); ?>
     </div>
     <div class="clear"></div>
</div>

