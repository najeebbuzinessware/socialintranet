
				
<!-- Main Body -->
<div class="span9 mainFeeds">
								 	<div class="mfBox">

<h1>Compose Mail<?php $this->renderPartial('application.views.messages._messageMenu') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<div class="clearfix"></div>
</div></div>

<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>