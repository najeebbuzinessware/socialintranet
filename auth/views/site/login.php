<div id="outer_container" class="custom_background">
  <div class="top_menu"></div>
  <div class="login_box_container">
    <center>
      <? //$logo =  BWCFunctions::getLoginpageLogofromHostName(); ?>
      <a href="http://buzinessware.com" target="_blank"> 
      	<img alt="" border="0" src="<? //=$logo ?>" /> 
      </a>
    </center>
    
    <div class="margin"></div>
    <?php $form=$this->beginWidget('CActiveForm', array(	'id'=>'login-form',	 'enableClientValidation'=>true)); ?>
    <div class="box login_box shadowed padding">
      <h1 class="headline1 smallLockIcon"><?php echo Yii::t('translate','Welcome'); ?></h1>
      <p class="normaltxt2"><?php echo Yii::t('translate','Client Login Area.'); ?></p>
      <div class="halfmargin"></div>
      
      <?php if(strlen($username)>0){ $model->username= $username;}else{ $username_translate = Yii::t('translate','Your username here...'); }
               echo $form->textField($model,'username',array("autocomplete"=>"off", "class"=>"headline2 full","placeHolder"=>$username_translate)); ?>
      <?php echo $form->error($model,'username'); ?>
      <div class="halfmargin"></div>
      
      <?php if(strlen($username)>0){ $model->password= $password;}else{ $password_translate = Yii::t('translate','Your password here...'); }
               echo $form->passwordField($model,'password',array("autocomplete"=>"off", "class"=>"headline2 full", "placeHolder"=>$password_translate)); ?>
      <?php echo $form->error($model,'password'); ?>
      <div class="halfmargin"></div>
      
      <?php echo CHtml::submitbutton(Yii::t('translate','SIGN IN'),array("submit"=>"/site/login","class"=>"CTA_gray"));?>
      <div class="clear"></div>
      <p>
        <label>
        <?php if(strlen($username)>0 && strlen($password)>0){$model->rememberMe="1"; }
						 echo $form->checkBox($model,'rememberMe',array('class'=>'checkbox')); ?>
        <?php echo Yii::t('translate','Remember'); ?></label>
        | <a href="#"><?php echo Yii::t('translate','Help'); ?></a></p>
    </div>
    <?php $this->endWidget(); ?>
  </div>
  <div class="clear"></div>
</div>
