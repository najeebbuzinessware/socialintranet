	<?php $this->widget('bootstrap.widgets.TbNavbar', array(
				
					'type' => '', // null or 'inverse'
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
						
						'<form class="navbar-search pull-left" action=""><input type="text" class="search-query" placeholder="Search for People, Groups, Files...  "></form>',
						(!Yii::app()->user->isGuest) ? '<p class="navbar-text pull-right nav"><a href="#">
							<img src="/images/chat-icon.png" />'.TblMessages::getMessagesCount().'</a></p>' : '',
						array(
							'class' => 'bootstrap.widgets.TbMenu',
							'htmlOptions' => array('class' => 'pull-right'),
							'items' => array(
								array('label' => 'Home', 'url' => '/wall/'),
								array('label' => 'Sales', 'url' => '#'),
								array('label' => 'Projects', 'url' => '#'),
								array('label' => 'Service', 'url' => '#'),
							//	array('label' => '<img src="/images/chat-icon.png" />','url' => '#'),
								array('label' =>Yii::app()->user->Name, 'url' => '#', 'items' => array(
								array('label' => Yii::t('translate','Profile'), 'url' => '/user/update'),
								array('label' => 'Messages', 'url' => '/messages/'),
								array('label' => 'AppSettings','visible'=>(Yii::app()->user->UserType == 'Admin')? true : false, 'url' => '/appsettings/settings/index/type/social'),
								array('label' => 'Tags','visible'=>(Yii::app()->user->UserType == 'Admin')? true : false, 'url' => '/tags/admin/'),
							/*		'---',
									array('label' => 'Separated link', 'url' => '#'), */
									//(if(Yii::app()->user->UserType == 'Admin'))
									array('label' => 'Get Out', 'url' => '/site/logout')
								)),
								
							),
							
						),
					),
					
				)); ?>
				
				<?php 
			/* if(!Yii::app()->user->isGuest){
				$this->widget('bootstrap.widgets.TbButton', array(
				'label'=>'Messages',
				'type'=>'success',
				'htmlOptions'=>array('data-title'=>'A Title','data-placement'=>'bottom', 
				'data-content'=>$this->renderPartial('application.views.messages.index',array(),true), 'rel'=>'popover'),
				)); 
			}  */
		?>
				<!-- mainmenu -->
				
				<!-- announcement -->
				<section id="announcement">
					<?php
						$this->widget('bootstrap.widgets.TbBox', array(
							'title' => 'Nullo solum meis pontus regna montes levius. Vis meis pace. Calidis inter ora hunc undas. Levitate aberant congestaque',
							'headerIcon' => 'icon-bullhorn',
							'content' => null,
						));
					?>
					
				</section>
				
				<!-- Breadcrumb -->
				<section id="breadcrumb">
					<?php if (isset($this->breadcrumbs)): ?>
						<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
						'links' => $this->breadcrumbs,
					)); ?>
					<?php endif?>
				</section>