<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="language" content="en"/>
	
		<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>
		
	
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		 <link href="/css/style_v2.css" rel="stylesheet">
		<script type="text/javascript" src="js/functions.js"></script>
	</head>
	
	<body>
	
		<div class="container">
			<?php echo $content; ?>
		</div>
		
		<!-- Footer -->
		<footer id="footer">
			<div class="container">
				<?php echo Yii::app()->params['copyrights']; ?>
			</div>
		</footer>
	</body>
</html>
