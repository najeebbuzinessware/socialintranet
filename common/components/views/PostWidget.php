<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'frmwallpost',
'action'=>$action,
'enableAjaxValidation'=>true,
'type'=>'horizontal',
'clientOptions' => array('validateOnSubmit' => true),
)); ?> 
<div class="row-fluid mfboxTop">

<div class="span12">
    <div class="txtboxHolder">
        <p class="postBoxEfxBtn01 text_grey" >Type here</p>
         <?php echo $form->textAreaRow($model, 'WallPost', array('class'=>'',
	'onblur'=> CHtml::ajax(array(
     'url'=>Yii::app()->createUrl('/wall/loadVideo'),
     'type'=>'post',                                                        
     //'dataType'=>'json',
     'data'=>array('title' => 'js:this.value'),
     'success' => "js:function(data)
                {
					$('#wallpostVideo').show();
					$('#wallpostVideo').html(data);
                   //alert(data);
                }",
     'error' => "function(data, status){ $('#wallpostVideo').hide(); }",
 )),'placeholder'=>'Start a Conversation ...','labelOptions' => array('label' => false)));  ?>
    </div>
    <div class="row-fluid mfboxControls"> 
        <div class="span12"> 
            <div class="mfControls_Holder"> 
                <ul class="inline">
                    <li><a href=""><img src="/images/uploadicon.png" alt="" /></a></li>
                    <li><a href=""><img src="/images/linkicon.png" alt="" /></a></li>
                    <li><a href=""><img src="/images/movieicon.png" alt="" /></a></li>
                </ul>
            </div> 
        </div> 
    </div>   	
</div> 


</div>   


<div class="row-fluid postBtnbox">
<div class="span12" >
    <p class="pull-left" ><i class="icon-arrow-right icon-blue" ></i>To:</p>
    
    <div class="tagInput pull-left" >
        <?php
               /*$this->widget('bootstrap.widgets.TbSelect2', array(
                    'name' => 'ShareId[]',
					'data' => BWCFunctions::getMIdUsers(),
					'options'=>array(
					'placeholder'=>'Share to...',
					'allowClear'=>true,
					),
                    'htmlOptions'=>array(
						'multiple'=>'multiple',	
						'class'=>"span10",					
					),
				));	*/
          ?>
    </div> 
<!-- /tagInput -->

	
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','htmlOptions'=>array('class'=>"btn pull-left"),'type'=>'primary', 'label'=>Yii::t('translate','Post'))); ?>
<?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset','htmlOptions'=>array('class'=>"pull-left postBoxEfxBtn02"),'type'=>'primary', 'label'=>Yii::t('translate','Cancel'))); ?>   
<!--<button class="btn pull-left" >Post</button>-->
<p class="pull-left postBoxEfxBtn02" >Cancel</p>
</div>
<p class="clearfix" ></p>

</div> 

<?php $this->endWidget(); ?>

<!-- Psoting -->
	<?php /*$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'frmwallpost',
'action'=>$action,
'enableAjaxValidation'=>true,
'type'=>'horizontal',
'clientOptions' => array('validateOnSubmit' => true),
)); ?>
<div class="postArea">
  <?php echo $this->render('application.views.common._wallMenu',array("model"=>$model));?>

	 <?php echo $form->textAreaRow($model, 'WallPost', array('class'=>'span12 postText',
	'onblur'=> CHtml::ajax(array(
     'url'=>Yii::app()->createUrl('/wall/loadVideo'),
     'type'=>'post',                                                        
     //'dataType'=>'json',
     'data'=>array('title' => 'js:this.value'),
     'success' => "js:function(data)
                {
					$('#wallpostVideo').show();
					$('#wallpostVideo').html(data);
                   //alert(data);
                }",
     'error' => "function(data, status){ $('#wallpostVideo').hide(); }",
 )),'placeholder'=>'Start a Conversation ...','labelOptions' => array('label' => false)));  ?>
<!--      <textarea class="span12 postText"></textarea> -->
      <div id="wallpostVideo" class="hidden"></div> 
     <div class="postOptions">
          <ul class="postMenu">
               <li>
				<a data-placement="bottom" data-toggle="tooltip" data-original-title="Picture" class="m-t-5 ttips" href="">
					<i class="icon-picture"></i>
				</a>
			</li>
               <li><a data-placement="bottom" data-toggle="tooltip" data-original-title="Video" class="m-t-5 ttips" href=""><i class="icon-film"></i></a></li>
               <li><a data-placement="bottom" data-toggle="tooltip" data-original-title="Event" class="m-t-5 ttips" href=""><i class="icon-calendar"></i></a></li>
               <li><a data-placement="bottom" data-toggle="tooltip" data-original-title="File" class="m-t-5 ttips" href=""><i class="icon-file-alt"></i></a></li>
          </ul>
     </div>
     
     <div class="shareTo span12 m-t-20 m-l-0">
          <span class="s-To">To:</span>
          <?php
               $this->widget('bootstrap.widgets.TbSelect2', array(
                    'name' => 'ShareId[]',
					'data' => BWCFunctions::getMIdUsers(),
					'options'=>array(
					'placeholder'=>'Share to...',
					'allowClear'=>true,
					),
                    'htmlOptions'=>array(
						'multiple'=>'multiple',
					),
				));	
          ?>
          <span class="s-Post">
          <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>Yii::t('translate','Post'))); ?>
			<!--<button class="btn shareButton">Post</button>-->
          </span> 
     </div>
</div>
<?php $this->endWidget(); */ ?>
<!-- Wall Posts -->