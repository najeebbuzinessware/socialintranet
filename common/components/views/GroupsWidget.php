  <ul class="nav nav-list groupCls">
                     <li class="nav-header"><?php echo Yii::t('translate','Groups'); ?><a class="pull-right" href="#addGroups" data-toggle="modal" ><i class="icon-plus icon-green" ></i></a></li>
                      <? 		$model = TblCollGroups::model()->getGroupsFromMId($settings['RecordLimit']);				
					if(count($model)>0)
					 { 					 	
						 $count="";
						 foreach($model as $keyt=>$valt)
						 {
							if(strlen($valt)>0)
							{ ?>
							<li><a href="/wall/groupwall/id/<?=$keyt ?>"><i class="icon-chevron-right icon-grey" ></i><?=$valt ?></a>
							<?php //echo CHtml::link($valt,array('/wall/groupwall/id/'.$keyt)); ?>
                            </li>																
						<?php $count+=1; 
							}
						 }
					}  ?>
					 <!-- <li><a href="#"><i class="icon-chevron-right icon-grey" ></i>Web Design</a></li>
					  <li><a href="#"><i class="icon-chevron-right icon-grey" ></i>Adobe Photoshop</a></li>
					  <li><a href="#"><i class="icon-chevron-right icon-grey" ></i>eCommerce</a></li>
					  <li><a href="#"><i class="icon-chevron-right icon-grey" ></i>Social Marketing</a></li>
					  <li><a href="#"><i class="icon-chevron-right icon-grey" ></i>Networking</a></li>-->
                      <li><?php echo CHtml::link(Yii::t("translate","View All"),"/groups/");?></li>
                     </ul>


<? /* <div class="borderedBox">
     <header>
          <h3>
               <i class="icon-bullhorn m-r-10"></i><?php echo Yii::t('translate','Groups'); ?>
             
              <a href="#groupSettings" data-toggle="modal"><i class="icon-cog righteditAction">&nbsp;</i></a>
              <a href="#addGroups" data-toggle="modal"><i class="iconAction">+</i></a>
          </h3>
     </header>
     <div class="news">
     
          <ul class="nav-list">
          <? 		$model = TblCollGroups::model()->getGroupsFromMId($settings['RecordLimit']);				
					if(count($model)>0)
					 { 					 	
						 $count="";
						 foreach($model as $keyt=>$valt)
						 {
							if(strlen($valt)>0)
							{ ?>
							<li><?php echo CHtml::link($valt,array('/wall/groupwall/id/'.$keyt)); ?></li>																
						<?php $count+=1; 
							}
						 }
					}  ?>

          </ul>
          <?php echo CHtml::link(Yii::t("translate","View All"),"/groups/");?>
     </div>
</div> */ ?>

