<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>BW Website</title>
		
		
       <?php Yii::app()->clientScript->scriptMap['bootstrap.min.js'] = false; 
	   		// Yii::app()->clientScript->scriptMap['jquery.min.js'] = true;
	   ?>
		
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
               
		<link href="/css/bootstrap.min.css" rel="stylesheet" />
		<link href="/css/bootstrap-responsive.min.css" rel="stylesheet" />
        
        <link href="/css/style_v2.css" rel="stylesheet">
 
        

		
		<!-- HTML5 shim for IE backwards compatibility -->
			<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
	</head>
	<body>

		<div class="deviceDetector" style="width: 0; height: 0; display: block; overflow: hidden;" >
			<p class="visible-phone vPhone" >Phone</p>
			<p class="visible-tablet vTablet" >Tablet</p>
			<p class="visible-desktop vDesktop" >Desktop</p>
		</div>
	
		<? $this->renderPartial('common.views.common._header'); ?>
        <!-- /header -->


		 <!-- newsSlider -->

		<div class="container mainBody">
			<div class="row">
            	<? $this->renderPartial('common.views.common._leftcolumn');?>
				 <!-- /sideNav -->

				<div class="span10 bodyContent">
						
					<div class="row">
						<div class="span10">
							<div class="row-fluid">

								 <?=$content ?>


								<? //$this->renderPartial('common.views.common._rightColumn');?>

							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>	

		<div class="container-fluid footer" >
			<div class="row-fluid" >
				<div class="span12" >
					<p><?php echo Yii::app()->params['copyrights']; ?></p>
				</div>
			</div>
		</div>			

<div class="modelBoxHolder" >
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
	
	<script src="/js/jquery_offline.min.js"></script>
	<script src="/js/bootstrap.min.js" ></script>	
	<script src="/js/custom.js" ></script>
	<script src="/js/jquery.tagsinput.jss" ></script>
	</body>
</html>