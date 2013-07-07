<div class="span9 mainFeeds">
								 	<div class="mfBox">

								 		<? $this->renderPartial('application.views.common._wallMenu'); ?>
<!-- /mfLinks -->

								 		<?php $this->widget('common.components.PostWidget',array("action"=>'/wall/wallpost'));  ?> <!-- /mfboxTop -->

									 	<!-- /postBtnbox -->

									 	<div class="row-fluid feedlistItems" >
									 		<div class="pull-right dropdown" >
									 			<a href="#" class="dropdown-toggle" data-toggle="dropdown" >Sort<i class="icon-chevron-down icon-grey" ></i></a>
									 			<ul class="dropdown-menu" >
									 				<li><a href="#" >Recent</a></li>
									 				<li><a href="#" >Oldest</a></li>
									 			</ul>
									 		</div>
                                            
                                            <?php 
			if(count($model)>0)
			{ 
				foreach($model as $key=>$val)
				{
				  	$usermodel = TblSysUsers::model()->findByPk($val['UserId']);
					$criteriaCom = new CDbCriteria();
					$criteriaCom->condition = 'MId='.Yii::app()->user->MId.' and WallId='.$val['WallId'].' and CType="Wall"';
					$criteriaCom->order = 'ComId DESC';
					$commentmod = TblCollComments::model()->findAll($criteriaCom); 
					
					/*if(empty($usermodel['Avatar'])){
						$img = "http://assets.bw.ae/bw/images/apps/avatar.png";
					}
					else{
						//$path = Yii::app()->params['documentPath'].Yii::app()->user->MId."/users/".$usermodel['Avatar'];
						//$img = Yii::app()->request->baseUrl.ImageHelper::thumb(70,70, $path, array('method' => 'resize'));
					}*/
					
					$attachments = BWColFunctions::funcGetAttachData('Wall',$val['WallId']);
					
					if(BWColFunctions::funcCheckUserLike($usermodel['Userid'],Yii::app()->user->Id,'user')>0){ $unfollowdisplay = ''; $followdisplay = 'style="display:none;"'; }
					else{ $unfollowdisplay = 'style="display:none;"'; $followdisplay = ''; }  
		?>

							 		  <div class="row-fluid clearfix feedItem" >
									 			<div class="span12" >
									 				<div class="row-fluid" >
									 					<div class="span12" >

									 						<table >
									 							<tr>
									 								<td>
									 									<img src="/images/photo.jpg" class="img-polaroid userimgbig pull-left" alt="" />
									 								</td>
									 								<td>


											 				<div class="feedItem_Content" >

											 					<div class="row-fluid feedItem_Content_MainUser" >
											 						<div class="span12" >
											 							<ul class="unstyled" >
											 								<li><span class="text_blue" ><a class="f-bold block" href="javascript:void(0);"><?=$usermodel['Name'] ?></a></li>
											 								<li><small class="text_grey" ><?php $posttime = BWDataFunction::humanTiming(strtotime($val['CreatedOn'])); if(strlen($posttime)>0){ echo $posttime; }else{ echo "2 second ago";} ?></small></li>
											 							</ul>
											 							
											 							<p><?php $parsed = parse_url($val['WallPost']); 
                            		$imagepath = explode(".",$parsed['path']);
                                if($parsed['host']=="www.youtube.com" || $parsed['host']=="youtu.be"){
                                	
								$this->beginWidget('common.extensions.prettyPhoto.PrettyPhoto', array('id'=>'pretty_photo',
		// prettyPhoto options
		'options'=>array(
				'opacity'=>0.60,
				'modal'=>true,
		),
));
									BWColFunctions::getYouTubeVideo($val['WallPost']);
									$this->endWidget('common.extensions.prettyPhoto.PrettyPhoto');
                                }elseif($parsed['host']!="youtu.be" && strlen($parsed['path'])>0 && (in_array("jpg",$imagepath) || in_array("png",$imagepath) || in_array("gif",$imagepath))){
                              $this->beginWidget('common.extensions.prettyPhoto.PrettyPhoto', array('id'=>'pretty_photo',
							  // prettyPhoto options
							  'options'=>array(
							    'opacity'=>0.60,
									'modal'=>true,
								),
								));	 	
				BWColFunctions::getYouTubeVideo($val['WallPost']);
							$this->endWidget('common.extensions.prettyPhoto.PrettyPhoto');
                                }else{ echo BWColFunctions::funcTextToLink($val['WallPost']); } ?></p>

											 							<div class="cmntlikeBox" >
											 								<ul class="inline pull-left" >
											 									<li><a href="" ><i class="icon-comment" ></i>Comments(<?=count($commentmod) ?>)</a></li>
											 									<li><a href="" ><i class="icon-thumbs-up" ></i><?php if(BWColFunctions::funcCheckUserLike($val['WallId'],Yii::app()->user->Id,'wall')>0){
				$likedisplay = 'hide'; 
				$unlikedisplay = '';
				
			}else{$likedisplay = ''; $unlikedisplay = 'hide';} ?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType' => 'ajaxSubmit',
				'id' => 'unlike_'.$val['WallId'],
				'type' => 'link',
				'label' => 'Unlike',
				'url' => Yii::app() -> createUrl('/wall/unlike/id/'.$val['WallId']),
				'ajaxOptions' => array('success' => 'function(data){ 
					 var obj = $.parseJSON(data);
					
					$("#likecount'.$val['WallId'].'").html("Like ("+obj.likecount+")");
					$("#unlike_'.$val['WallId'].'").hide(); 
					$("#like_'.$val['WallId'].'").show(); 
				}'
				),
				'htmlOptions' => array('class' =>$unlikedisplay),
				
		)); ?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType' => 'ajaxSubmit',
				'id' => 'like_'.$val['WallId'],
				'type' => 'link',
				'label' => 'Like',
				'url' => Yii::app() -> createUrl('/wall/like/id/'.$val['WallId']),
				'ajaxOptions' => array('success' => 'function(data){ 
					var obj = $.parseJSON(data);
					
					$("#likecount'.$val['WallId'].'").html("Like ("+obj.likecount+")");
					$("#like_'.$val['WallId'].'").hide(); 
					$("#unlike_'.$val['WallId'].'").show(); 
						
				}'
				),
				'htmlOptions' => array('class' =>$likedisplay),
				
		)); ?></a><span id="likecount<?=$val['WallId'] ?>">Like (<?=BWColFunctions::funcToalUserLike($val['WallId'],'wall') ?>)</span></li>
											 								
                                                                            
                                                                            </ul>

											 								<p class="pull-right text_grey" ><i class="icon-time icon-grey" ></i><?php $posttime = BWDataFunction::humanTiming(time()); if(strlen($posttime)>0){ echo $posttime; } ?></p>

											 								<div class="addCmntBox" >
											 									<input type="text" placeholder="Type your comment here" />
											 								</div>
										 							  </div>
											 						</div>
											 					</div> <!-- /feedItem_Content_MainUser -->
                                                                

											 					<div class="row-fluid feedItem_Comments" >
											 						<div class="span12" >
											 							<div class="cmntbox_top" >
											 								<img src="/images/cmntarrow.png" alt="" />
											 							</div>

											 							<div class="cmntbox_body border_grey_low" >


															 <?php 				
																	if(count($commentmod)>0)
																	{
																		foreach($commentmod as $keycom=>$valcom)
																		{
																	
																			$usercom = TblSysUsers::model()->findByPk($valcom['UserId']);
																			if(empty($usercom['Avatar'])){
																				$img = "http://assets.bw.ae/bw/images/apps/avatar.png";
																			}else{
																				$path = Yii::app()->params['documentPath'].Yii::app()->user->MId."/users/".$usercom['Avatar'];
																				
																			//	$img = Yii::app()->request->baseUrl.ImageHelper::thumb(220,220, $path, array('method' => 'resize'));
																			}
																			
																			$comattachments = BWColFunctions::funcGetAttachData('comment',$valcom['ComId']);
															 ?>

											 									<div class= "cmntusers" >
											 										<table>
											 											<tr>
											 												<td rowspan="2" ><img src="/images/cmntuser.jpg" class="img-polaroid pull-left" alt="" /></td>
											 												<td>														 								<ul class="inline pull-left" >
														 									<li class="text_blue" ><?=$usercom['Name'] ?></li>
														 									<li class="text_grey" ><i class="icon-time icon-grey" ></i><small><?=BWDataFunction::humanTiming(strtotime($valcom['CreatedOn'])); ?></small></li>
														 									<li class="text_grey" ><i class="icon-star icon-grey" ></i><small><?php $cmtlikedisplay = ''; 
							$cmtunlikedisplay = 'hide';
				 if(BWColFunctions::funcCheckUserLike($valcom['ComId'],Yii::app()->user->Id,'wall','comment')>0){
				$cmtlikedisplay = 'hide'; 
				$cmtunlikedisplay = '';
				
			}else{$likedisplay = ''; $unlikedisplay = 'hide';} ?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType' => 'ajaxSubmit',
				'id' => 'commentunlike_'.$valcom['ComId'],
				'type' => 'link',
				'label' => 'Unlike',
				'url' => Yii::app() -> createUrl('/wall/unlike/id/'.$valcom['ComId'].'/ftype/comment'),
				'ajaxOptions' => array('success' => 'function(data){ 
					 var obj = $.parseJSON(data);
					
					$("#commentlikecount'.$valcom['ComId'].'").html("("+obj.likecount+") Likes");
					$("#commentunlike_'.$valcom['ComId'].'").hide(); 
					$("#commentlike_'.$valcom['ComId'].'").show(); 
				}'
				),
				'htmlOptions' => array('class' =>$cmtunlikedisplay),
				
		)); ?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType' => 'ajaxSubmit',
				'id' => 'commentlike_'.$valcom['ComId'],
				'type' => 'link',
				'label' => 'Like',
				'url' => Yii::app() -> createUrl('/wall/like/id/'.$valcom['ComId'].'/ftype/comment'),
				'ajaxOptions' => array('success' => 'function(data){ 
					var obj = $.parseJSON(data);
					
					$("#commentlikecount'.$valcom['ComId'].'").html("("+obj.likecount+") Likes");
					$("#commentlike_'.$valcom['ComId'].'").hide(); 
					$("#commentunlike_'.$valcom['ComId'].'").show(); 
						
				}'
				),
				'htmlOptions' => array('class' =>$cmtlikedisplay),
				
		)); ?>
						<span id="commentlikecount<?=$valcom['ComId'] ?>">Like (<?=BWColFunctions::funcToalUserLike($valcom['ComId'],'wall','comment') ?>)</span></small></li>
														 								</ul>
														 							</td>
											 											</tr>
											 											<tr>
											 												<td><p class="pull-left cmnttxt" ><? $parsed = parse_url($valcom['Comment']); 
                                		$imagepath = explode(".",$parsed['path']);
                                if($parsed['host']=="www.youtube.com" || $parsed['host']=="youtu.be"){
                                	
								$this->beginWidget('common.extensions.prettyPhoto.PrettyPhoto', array('id'=>'pretty_photo',
		// prettyPhoto options
		'options'=>array(
				'opacity'=>0.60,
				'modal'=>true,
		),
));
									BWColFunctions::getYouTubeVideo($valcom['Comment']);
									$this->endWidget('common.extensions.prettyPhoto.PrettyPhoto');
                                }elseif($parsed['host']!="youtu.be" && strlen($parsed['path'])>0 && (in_array("jpg",$imagepath) || in_array("png",$imagepath) || in_array("gif",$imagepath))){
                              $this->beginWidget('common.extensions.prettyPhoto.PrettyPhoto', array('id'=>'pretty_photo',
							  // prettyPhoto options
							  'options'=>array(
							    'opacity'=>0.60,
									'modal'=>true,
								),
								));	 	
								BWColFunctions::getYouTubeVideo($valcom['Comment']);
								$this->endWidget('common.extensions.prettyPhoto.PrettyPhoto');
                            }else{ echo BWColFunctions::funcTextToLink($valcom['Comment']); } ?></p></td>
											 											</tr>
											 										</table>
	
											 									</div> <!-- /cmntusers -->

															<?php } } ?>											 									
											 									<div class="clearfix addCmntLink" >
											 										<p><a href="" ><i class="icon-plus-sign icon-green" ></i><small>Add Comment</small></a></p>
											 									</div>



											 							</div>
											 						</div>
											 					</div> <!-- /feedItem_Comments -->

											 				</div>

									 								</td>
									 							</tr>
									 						</table>

									 															 						



									 					</div>
									 				</div>


									 			</div>
									 		</div> <!-- /feedItem -->				

		<?php }} ?>



									 		


		
									 	</div>





								 </div> <!-- /mainFeeds -->
								</div>
                                
                                	<script type="application/javascript" language="javascript">
function checkForm(frm)
{
	var str = $('#comment_'+frm.id).val();
	if(/^\s*$/.test(str))
	{return false;}
	return true;
}
</script>