<div class="span2 sideNav" >
					<!--<ul class="nav nav-list">
					  <li class="nav-header background_blue sideNavBtn dropdown">
					  		<a href="#" style="color: #fff !important;" class="dropdown-toggle" data-toggle="dropdown" >CREATE<i class="icon-chevron-down icon-white pull-right" ></i></a>
					  		<ul class="dropdown-menu" >
					  			<li><a href="" >Menu 01</a></li>
					  			<li><a href="" >Menu 02</a></li>
					  			<li><a href="" >Menu 03</a></li>
					  		</ul>
					  </li>

					  <li class="nav-header">Workspace</li>
					  <li class="active text_blue"><a href="#"><i class="icon-plane icon-blue" ></i>Activities</a></li>
					  <li><a href="#" ><i class="icon-calendar icon-grey" ></i>Tasks</a></li>
					  <li><a href="#" ><i class="icon-user icon-grey" ></i>Contacts</a></li>
					  <li><a href="#" ><i class="icon-file icon-grey" ></i>Files</a></li>
					  <li><a href="#" ><i class="icon-time icon-grey" ></i>Timesheets</a></li>
					</ul>-->
                  
                  		<?php
	 	
          $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
				
				'htmlOptions' => array('class' => 'nav nav-list createCls'),
                'items' => array(
					 array('label'=>'Create', 'url'=>'/wall/', 'icon'=>'', 'linkOptions'=>array("class"=>"nav-header background_blue sideNavBtn dropdown"),
							'items'=>array(
								
								array('label'=>'Menu 01', 'url'=>'#', 'active'=>(Yii::app()->controller->Id=="tasks")? "true" : ""),
								array('label'=>'Menu 02', 'url'=>'#', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="admin")? "true" : ""),
								array('label'=>'Menu 03', 'url'=>'#', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="create")? "true" : ""),
								
						 )
					 ),
				)
           )); 
      ?>
                  
					<?php
	 	
          $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
				
				'htmlOptions' => array('class' => 'nav nav-list workspaceCls'),
                'items' => array(
					/* array('label'=>'Create', 'url'=>'/wall/', 'icon'=>'icon-plane icon-blue', 'linkOptions'=>array("class"=>"nav-header background_blue sideNavBtn dropdown"),
							'items'=>array(
								
								array('label'=>'Menu 01', 'url'=>'#', 'active'=>(Yii::app()->controller->Id=="tasks")? "true" : ""),
								array('label'=>'Menu 02', 'url'=>'#', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="admin")? "true" : ""),
								array('label'=>'Menu 03', 'url'=>'#', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="create")? "true" : ""),
								
						 )
					 ),*/
					 array('label'=>'Workspace','class'=>"nav-header"),
                     array('label'=>'Activities', 'url'=>'/wall/', 'icon'=>'icon-plane icon-blue', 'active'=>(Yii::app()->controller->Id=="wall")? "true" : ""),
                     array('label'=>'Tasks', 'icon'=>'icon-calendar icon-grey', 'active'=>(Yii::app()->controller->Id=="tasks")? "true" : "",'items'=>array(
                     		
                     		array('label'=>'All Tasks', 'icon'=>'icon-calendar icon-grey', 'url'=>'/tasks/', 'active'=>(Yii::app()->controller->Id=="tasks")? "true" : ""),
                     		array('label'=>'My Tasks', 'icon'=>'icon-calendar icon-grey', 'url'=>'/tasks/admin', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="admin")? "true" : ""),
                     		array('label'=>'Create', 'icon'=>'icon-file-alt icon-grey', 'url'=>'/tasks/create', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="create")? "true" : ""),
                     		
                     )
                     		
                ),
                     array('label'=>'Contacts', 'icon'=>'icon-user icon-grey', 'url'=>'/contacts/', 'active'=>(Yii::app()->controller->Id=="contacts")? "true" : ""),
                     array('label'=>'Files', 'icon'=>'icon-file icon-grey', 'url'=>'/fileManager/', 'active'=>(Yii::app()->controller->Id=="fileManager")? "true" : ""),
                	array('label'=>'Timesheets', 'icon'=>'icon-time icon-grey', 'url'=>'#/timesheet/', 'active'=>(Yii::app()->controller->Id=="timesheet")? "true" : ""),

                )
           )); 
      ?>
                    
                  <?php $this->widget('common.components.GroupsWidget');  ?>
                     
                     <ul class="nav nav-list companyCls">
                      <li class="nav-header">Company</li>
					  <li><a href="#"><i class="icon-user icon-grey" ></i>Employees</a></li>
					  <li><a href="#"><i class="icon-info-sign icon-grey" ></i>Company Info</a></li>	
					</ul>
				</div>