<div class="borderedBox">
     <header>
          <h3><i class="icon-bullhorn m-r-10"></i>Twitter</h3>
     </header>
     <div class="news">
     <?php //$this->widget('common.extensions.echirp.EChirp',array('options'=>array('user'=>'sameer@bw.ae','max'=>10,'target'=>'tweet'))); ?>
<!-- <a class="twitter-timeline" height="145" avators="false" data-chrome="nofooter noheader transparent" href="<?php echo Yii::app()->params['twitterappurl'] ?>" data-widget-id="280945897024651264">Tweets by @<?php //echo Yii::app()->params['twitterappname'] ?></a>
	 <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
-->
     <?php echo Yii::app()->params['twitter_widget']; ?>
		
		</div>
</div>