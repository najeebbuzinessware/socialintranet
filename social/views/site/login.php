<div id="outer_container" class="custom_background">
     <div class="top_menu"></div>
     <div class="login_box_container">



<div class="container loginpage">

     <div class="row-fluid" >
          <div class="span5" >
               <div class="box box01" >
               <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form', 'enableClientValidation'=>true,'htmlOptions'=>array('class'=>''))); ?>
                    	<? $logo =  Yii::app()->params['FrontEndLogo'];//BWCFunctions::getLoginpageLogofromHostName(); ?>
              
                  <h2 class="form-signin-heading logo"> <a href="http://buzinessware.com" target="_blank"> <img alt="" border="0" src="<?=$logo ?>" /> </a></h2>
                          
                          <div class="row-fluid" >
                              <div class="input-prepend span11">
                               <?php 
               $username_translate = Yii::t('translate','Your username here...');
               echo $form->textFieldRow($model,'username',array('class'=>'btn-block btn-block-prepend', 'prepend'=>'<i class="icon-user icon-dark"></i>', "placeholder"=>"$username_translate",'labelOptions'=>array('label'=>false))); ?>
<!--                                    <span class="add-on"><i class="icon-user icon-dark"></i></span> -->
<!--                                    <input type="text" class="input-block-level" placeholder="User Name"> -->
                              </div>
                         </div>    

                          <div class="row-fluid" >
                               <div class="input-prepend span11">
                                <?php 
               $password_translate = Yii::t('translate','Your password here...');
               echo $form->passwordFieldRow($model,'password',array('class'=>'btn-block btn-block-appended', 'prepend'=>'<i class="icon-lock icon-dark"></i>',"placeholder"=>"$password_translate",'labelOptions'=>array('label'=>false))); ?>
<!--                                    <span class="add-on"><i class="icon-lock icon-dark"></i></span> -->
<!--                                    <input type="password" class="input-block-level" placeholder="Password"> -->
                              </div>
                         </div>

                 
                  <ul class="inline" >
                       <li>
                          <?php echo $form->checkBoxRow($model,'rememberMe',array('class'=>'checkbox')); ?>
                         
                       </li>
                       <li><a href="" ><small>Forgot password?</small></a></li> 
                   </ul>    
                   <p class="clearfix" ></p>
                  <div class="btnHolder clearfix" >
 <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>Yii::t('translate','SIGN IN'),'htmlOptions' => array(
		'class'=>'btn btn-large btn-block btn-info'))); ?>
<!--                     <button class="btn btn-large btn-block btn-info" type="submit">Login</button> -->
                  </div>
                <?php $this->endWidget(); ?>
              </div> <!-- /Box 01 -->
          </div>

          <div class="span7" >
              <div class="box box02" >
               <div class="adPlaceHolder" >
                    <img src="images/login/ad.jpg" alt="" />
               </div>
              </div>
          </div>

     </div>

</div> <!-- /container -->      


     </div>
     <div class="clear"></div>
</div>

