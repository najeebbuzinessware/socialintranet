<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tbl-sys-tags-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Tags',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->dropDownListRow($model,'TagColor',TblSysTags::model()->getTagClasses(),array('class'=>'span5','maxlength'=>255)); ?>
	
	
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>
	
	<section id="labels-badges">
   
    <h3>Colors Samples</h3>
    <table class="table table-bordered table-striped">
      
        <tbody>
         <tr>
            <td>
                <span class="label">Default</span>
            </td>
            <td>
                 <span class="label label-success">Success</span>
            </td>
            <td>
                <span class="label label-warning">Warning</span>
            </td>
        </tr>
        <tr>
             <td>
                <span class="label label-important">Important</span>
            </td>
            <td>
                <span class="label label-info">Info</span>
            </td>
             <td>
                <span class="label label-inverse">Inverse</span>
            </td>
        </tr>
       
        </tbody>
    </table>
</section>

<?php $this->endWidget(); ?>
