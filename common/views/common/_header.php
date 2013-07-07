<div class="container header" >
			<div class="row" >
				
				<div class="span12" >
						 <?php $this->widget('bootstrap.widgets.TbNavbar', array(
				
					'type' => 'null', // null or 'inverse'
					'brand' => '<img src="'.Yii::app()->params['FrontEndLogo'].'" alt="" />',
					'brandUrl' => '/',
					'fixed' => 'false',
					'collapse' => true, // requires bootstrap-responsive.css
					'items' => array(
						array(
							'class' => 'bootstrap.widgets.TbMenu',
							'items' => array(
				
							),
						),
						
						'<form class="navbar-search pull-left" action=""><input type="text" class="search-query" placeholder="Search for People, Groups, Files...  "><button class="btn pull-right" type="button"><i class="icon-search icon-white"></i></button></form>',
						(!Yii::app()->user->isGuest) ? '<p class="navbar-text pull-right nav"><a href="#">
							<img src="/images/chat-icon.png" />'.TblMessages::getMessagesCount().'</a></p>' : '',
						array(
							'class' => 'bootstrap.widgets.TbMenu',
							'type' => 'null',
							'htmlOptions' => array('class' => 'pull-right'),
							'items' => array(
								array('label' => 'Home', 'url' => '/wall/','active'=>(Yii::app()->controller->Id=="wall")? "true" : ""),
								array('label' => 'Sales', 'url' => '#','active'=>(Yii::app()->controller->Id=="sales")? "true" : ""),
								array('label' => 'Projects', 'url' => '/projects/','active'=>(Yii::app()->controller->Id=="projects")? "true" : ""),
								array('label' => 'Service', 'url' => '#','active'=>(Yii::app()->controller->Id=="service")? "true" : ""),
							//	array('label' => '<img src="/images/chat-icon.png" />','url' => '#'),
								array('label' =>Yii::app()->user->Name, 'url' => '#', 'items' => array(
								array('label' => Yii::t('translate','Profile'), 'url' => '/user/update'),
								array('label' => 'Messages', 'url' => '/messages/'),
								array('label' => 'AppSettings','visible'=>(Yii::app()->user->UserType == 'Admin')? true : false, 'url' => '/appsettings/settings/index/type/social'),
								array('label' => 'Tags','visible'=>(Yii::app()->user->UserType == 'Admin')? true : false, 'url' => '/tags/admin/'),
								//(if(Yii::app()->user->UserType == 'Admin'))
									array('label' => 'Get Out', 'url' => '/site/logout')
								)),
								
							),
							
						),
					),
					
				)); ?>
				</div>
			</div>
		</div>
        
        <div class="container newsSlider" >
			<div class="row-fluid" >
				<div class="span12 border_grey_low" >
					<p class="icon-bullhorn pull-left" ></p>

					<div id="newsSliderHolder" class="carousel slide pull-left">
						  <!-- Carousel items -->
						  <div class="carousel-inner text_grey">
                          <? if(count(TblAnnouncement::model()->getAnnouncementsFromMId())>0){ 
						  		$count=0;
						  		foreach(TblAnnouncement::model()->getAnnouncementsFromMId() as $key=>$val){
						  ?>
							    <div class="item <? if($count==0){echo "active";}?>"><?=$val ?></div>							   
                           <? $count++;} } ?>
						  </div>
					</div>

			  <div class="nsControls pull-right" >
						<!-- Carousel nav -->
						<a class="carousel-control left" href="#newsSliderHolder" data-slide="prev"><i class="icon-chevron-left icon-green" ></i></a>
						<a class="carousel-control right" href="#newsSliderHolder" data-slide="next"><i class="icon-chevron-right icon-green" ></i></a>					</div>						
			  </div>
			</div>
		</div>