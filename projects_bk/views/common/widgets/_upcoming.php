<div class="borderedBox">
     <header>
          <h3>
               <i class="icon-bullhorn m-r-10"></i><?php echo Yii::t('Upcoming Tasks')?>
              <!-- <i class="righteditAction"> -->
              <a href="#addTasks" data-toggle="modal"><i class="iconAction">+</i></a>
          </h3>
     </header>
     <div class="news">
     
          <ul class="nav-list">
          <? 		$taskmodel = TblTasks::model()->getUsersTasks();				
					if(count($taskmodel)>0)
					 { 					 	
						 $count="";
						 foreach($taskmodel as $keyt=>$valt)
						 {
							if(strlen($valt['Description'])>0)
							{ ?>
							<li><?php echo CHtml::link($valt['Description'],array('/tasks/'.$valt['TaskId'])); ?></li>																
						<?php $count+=1; 
							}
						 }
					}  ?>

          </ul>
     </div>
</div>

<!-- Add Task Modal -->
<?php echo $this->renderPartial("common.views.common.modal._addTask"); ?>