<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="language" content="en"/>
	
		<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>
		
	
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<link href="/css/style.css" rel="stylesheet">
		<script type="text/javascript" src="/js/mfupload.js"></script>
		<script type="text/javascript" src="/js/functions.js"></script>
	</head>
	
	<body>
	
		<div class="container">
			<div class="row-fluid">
				<?php echo $this->renderPartial("common.views.common._common"); ?>
				
				<?php echo $this->renderPartial("common.views.common._leftcolumn"); ?>
				
				<?php //echo $this->renderPartial("common.views.common._rightColumn"); ?>
				
				<!-- Main Body -->
				<!-- <section id="content"> -->
		<?php /* $this->widget('bootstrap.widgets.TbAlert', array(
			    'block'=>true, // display a larger alert block?
			    'fade'=>true, // use transitions?
			    'closeText'=>'�', // close link text - if set to false, no close link is displayed
			    'alerts'=>array( // configurations per alert type
				    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'�'), // success, info, warning, error or danger
			    ),
			));  */
		?>
					<?php echo $content; ?>
					<!-- <div class="clearfix"></div>
				</section> -->
			
				<!-- Add News Modal -->
				<?php echo $this->renderPartial("common.views.common.modal._addFeedModal"); ?>
				
				<!-- Add News Settings Modal -->
				<?php echo $this->renderPartial("common.views.common.modal._newsSettings"); ?>
				
				<!-- Add Task Modal -->
				<?php echo $this->renderPartial("common.views.common.modal._addTask"); ?>
				
				<!-- Add Task Settings Modal -->
				<?php echo $this->renderPartial("common.views.common.modal._taskSettings"); ?>
				
				<!-- Add groups Settings Modal -->
				<?php echo $this->renderPartial("common.views.common.modal._groupSettings"); ?>
				
				<!-- Add groups Settings Modal -->
				<?php echo $this->renderPartial("common.views.common.modal._addGroup"); ?>
				
				<!-- Add contacts Modal -->
				<?php echo $this->renderPartial("common.views.common.modal._addContacts"); ?>
				
			</div>
		</div>
		
		<!-- Footer -->
		<footer id="footer">
			<div class="container">
				<?php echo Yii::app()->params['copyrights']; ?>
			</div>
		</footer>
	</body>
</html>
