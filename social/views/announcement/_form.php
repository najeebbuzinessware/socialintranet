<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'id'=>'tbl-announcement-form', 
	'type'=>'horizontal',
    'enableAjaxValidation'=>false, 
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p> 

    <?php echo $form->errorSummary($model); ?>

    <?php //echo $form->textFieldRow($model,'Title',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textAreaRow($model,'Content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php //echo $form->textFieldRow($model,'PublishDate',array('class'=>'span5')); ?>
    <?php echo $form->dateRangeRow($model, 'PublishDate',
        array('hint'=>'Click inside! An even a date range field!.',
        'prepend'=>'<i class="icon-calendar"></i>',
        'options' => array('callback'=>'js:function(start, end){console.log(start.toString("MMMM d, yyyy") + " - " + end.toString("MMMM d, yyyy"));}')
        )); ?>

    <?php //echo $form->textFieldRow($model,'EndDate',array('class'=>'span5')); ?>

    <?php echo $form->dropDownListRow($model,'Status',array('Active'=>'Active','Draft'=>'Draft','Scheduled'=>'Scheduled'),array('class'=>'span5','maxlength'=>9)); ?>
    
    <div class="form-actions"> 
        <?php $this->widget('bootstrap.widgets.TbButton', array( 
            'buttonType'=>'submit', 
            'type'=>'primary', 
            'label'=>$model->isNewRecord ? 'Create' : 'Save', 
        )); ?>
    </div> 

<?php $this->endWidget(); ?>
