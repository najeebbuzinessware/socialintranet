<div class="row-fluid mfLinks">
								 			<div class="span12">
                                            		<?php
	 	
          $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'null',
				
				'htmlOptions' => array('class' => 'inline'),
                'items' => array(
					 array('label'=>'Conversation', 'url'=>'/wall/', 'active'=>(Yii::app()->controller->Id=="wall")? "true" : ""),
					 array('label'=>'Message', 'url'=>'/messages/', 'active'=>(Yii::app()->controller->Id=="messages")? "true" : ""),
					 array('label'=>'Announcement', 'url'=>'/announcements/', 'active'=>(Yii::app()->controller->Id=="announcements")? "true" : ""),
					 array('label'=>'Praise', 'url'=>'#', 'active'=>(Yii::app()->controller->Id=="praise")? "true" : ""),		
					 ),
				)
           ); 
      ?>
								 				<!--<ul class="inline">
								 					<li class="active"><a href="/">Conversation</a></li>
								 					<li><a href="/messages/">Message</a></li>
								 					<li><a href="/announcements/">Announcement</a></li>
								 					<li><a href="#">Praise</a></li>
								 				</ul>-->
								 			</div>
								 		</div>
