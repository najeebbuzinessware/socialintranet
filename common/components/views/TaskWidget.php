<div class="rnBox" >
										<div class="rnbox_Title" >
											<p class="pull-left" ><?php echo Yii::t('translate','Upcoming Tasks'); ?></p>
											<ul class="inline pull-right" >
												<li><a href="#tasksSettings" data-toggle="modal" ><i class="icon-cog righteditAction" ></i></a></li>
												<li><a href="#addTasks" data-toggle="modal" ><i class="icon-plus icon-green" ></i></a></li>
											</ul>
										</div>
                                        
                   <? 		$taskmodel = TblTasks::model()->getUsersTasks($taskettings['RecordLimit']);				
					if(count($taskmodel)>0)
					 { 					 	
						 $count="";
						 foreach($taskmodel as $keyt=>$valt)
						 {
							if(strlen($valt['Description'])>0)
							{ ?>
                            <p class="text_blue" >
							<small class="text_grey" ><?php echo BWCFunctions::get_day_name(strtotime($valt['DueDate']))." @ ".$valt['DueTime']."<br />"; ?></small>
							<a href="#" class="text_blue" ><?php echo CHtml::link($valt['Description'],array('/tasks/'.$valt['TaskId'])); ?></a>
							</p>
			
						<?php $count+=1; 
							}
						 }
					}  ?>
										
		</div>
        <? /*
<div class="borderedBox">
     <header>
          <h3>
               <i class="icon-bullhorn m-r-10"></i><?php echo Yii::t('translate','Upcoming Tasks'); ?>
              <!-- <i class="righteditAction"> -->
              <a href="#tasksSettings" data-toggle="modal"><i class="icon-cog righteditAction">&nbsp;</i></a>
              <a href="#addTasks" data-toggle="modal"><i class="iconAction">+</i></a>
          </h3>
     </header>
     <div class="news">
     
          <ul class="nav-list">
          <? 		$taskmodel = TblTasks::model()->getUsersTasks($taskettings['RecordLimit']);				
					if(count($taskmodel)>0)
					 { 					 	
						 $count="";
						 foreach($taskmodel as $keyt=>$valt)
						 {
							if(strlen($valt['Description'])>0)
							{ ?>
							<li><?php echo BWCFunctions::get_day_name(strtotime($valt['DueDate']))." @ ".$valt['DueTime']."<br />";
							echo CHtml::link($valt['Description'],array('/tasks/'.$valt['TaskId'])); ?></li>																
						<?php $count+=1; 
							}
						 }
					}  ?>

          </ul>
     </div>
</div>
 */ ?>