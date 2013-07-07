
				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>

<div class="clearfix"></div>
</div></div>
<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>