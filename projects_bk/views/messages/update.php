<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
				
<!-- Main Body -->
<section id="content">

<h1>Update Messages <?php $this->renderPartial('application.views.messages._messageMenu') ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>


<div class="clearfix"></div>
</section>