				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">
<h1>View </h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'Name',
        'Nick',
        'Email',
        'PhoneNo',
        'TimeZone',
    	array("name"=>"Report To","value"=>TblSysUsers::model()->findByPk($model->ReportTo)->Name),	
      ),
)); ?>

<div class="clearfix"></div>
</div></div>
<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
