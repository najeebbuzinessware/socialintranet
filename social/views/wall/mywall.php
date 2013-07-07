<div id="outer_container" class="custom_background">
    <?php $this->renderpartial('intranet.views._collaborationmenu'); ?>
    <div class="container_12">
        <div class="grid_1">
        	<div id="sideIcons">
                <a href="/intranet/Files" class="icon fileIconE"><span>Files</span></a>
                <div class="margin"></div>
             
                <a href="/intranet/bookmarks" class="icon weblinkIconE"><span>Weblinks</span></a>
                <div class="margin"></div>
             
                <a href="#" onClick="return: false;">&nbsp;</a>
            </div>
        </div>
        <div class="grid_11 box shadowed_little stick">
        	<div class="padding profile">               
                <div class="lined">                
                    <div class="grid_8 alpha">
                        <h2 class="headline1 noMargUp noMargDown LEFT"><?=Yii::t('translate','My Wall') ?></h2>
                        <p class="normaltxt1 noMargDown noMargUp"><?=Yii::t('translate','Your own playground') ?></p>
                    </div>
                   <?php $this->renderpartial('intranet.views._WallTopDropdownlist',array("getid"=>"MyWall"));?>                  
                   
            		<div class="clear"></div>
                </div>
                <div class="halfmargin"></div>
                <?php 
					if(empty($usermod['Avatar'])){
						$logimg = "http://assets.bw.ae/bw/images/apps/avatar.png";
						$comlogimg = "http://assets.bw.ae/bw/images/apps/avatar.png";
					}
					else{
						$path = Yii::app()->params['documentPath'].Yii::app()->user->MId."/users/".$usermod['Avatar'];
						$logimg = Yii::app()->request->baseUrl.ImageHelper::thumb(220,220, $path, array('method' => 'resize'));
						$comlogimg = Yii::app()->request->baseUrl.ImageHelper::thumb(46,46, $path, array('method' => 'resize'));
					}
					if($usermod['Department']>0)
					{
						$departmod = TblDepartments::model()->findByPk($usermod['Department']);
						$department = $departmod['Department'];
					}else{
						$department = "-";
					}
					
					if(strlen($usermod['JobTitle'])>0)
					{
						$position = $usermod['JobTitle'];
					}else{
						$position = "-";
					}
									
				?>
                <div class="grid_1 alpha profilePic medium"> <a href="#"><img src="<?php echo BWCFunctions::getAvatar('Big') ?>" border="0" alt="" /></a> </div>
                          
                <div class="grid_11 omega RIGHT"> 
                	<p class="headline2 noMargUp hidden-mobile">
			    <a href="#" class="BLACK">
				<b><?=$usermod['Name'] ?></b>
			    </a>
			    
			    <span class="spacer"></span>
			    
			   <span class="star empty"></span> 
			</p>
              
			<div class="clear"></div>
			
			
			
			
		    <div class="grid_4 alpha hidden-mobile">
			<div class="grid_6 alpha BLACK normaltxt1"><?=Yii::t('translate','Position')?></div>
			<div class="grid_6 normaltxt1"><?=$position ?></div>
			<div class="micromargin"></div>
			<div class="grid_6 alpha BLACK normaltxt1"><?=Yii::t('translate','Department')?></div>
			<div class="grid_6 normaltxt1"><?=$department ?></div>
			<div class="micromargin"></div>
			<div class="grid_6 alpha BLACK normaltxt1"><?=Yii::t('translate','Email')?></div>
			<div class="grid_6 normaltxt1"><?=$usermod['Email'] ?></div>
			<div class="micromargin"></div>
			<div class="grid_6 alpha BLACK normaltxt1"><?=Yii::t('translate','Phone')?></div>
			<div class="grid_6 normaltxt1"><?=$usermod['PhoneNo'] ?></div>
			<div class="halfmargin"></div>
		    </div>
		    
		    <div class="grid_6 alpha">
			    <p class="normaltxt1 BLACK noMargUp"><?=Yii::t('translate','Skills') ?></p>
			    <?php
							$skillArr = explode(',',$usermod['Skills']);
							foreach($skillArr as $key=>$val){
						?>
						<span class="tag"><?=$val?></span>
						<?php }?>                    
			</div>
			
				<?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'frmwallpost',
                        'action'=>'/intranet/site/wallpost',
                        'method'=>'post',
                        'enableAjaxValidation'=>true,
                        'clientOptions' => array(
                            'validateOnSubmit'=>true,
                            'validateOnChange'=>true,
                            'validateOnType'=>false,
				),)); ?>                
                <div class="grid_12 alpha omega">
                    <div class="comBlock">
                    	<div id="wallpostText">
							<?php echo $form->textArea($newModel, 'WallPost', array('rows'=>20,'cols'=>125,'class'=>'uniBlock',
	'onblur'=> CHtml::ajax(array(
     'url'=>Yii::app()->createUrl('site/loadVideo'),
     'type'=>'post',                                                        
     //'dataType'=>'json',
     'data'=>array('title' => 'js:this.value'),
     'success' => "js:function(data)
                {
					$('#wallpostVideo').show();
					$('#wallpostVideo').html(data);
                   //alert(data);
                }",
     'error' => "function(data, status){ $('#wallpostVideo').hide(); }",
 )),'placeholder'=>'Start a Conversation ...'));?>
                            <?php echo $form->error($newModel,'WallPost');?>
                        </div>
                        <div id="wallpostVideo" class="hidden"></div>                   
                        <div class="tinymargin"></div>                    
                        <div class="grid_1 alpha omega hidden-mobile">
                        	<a class="icon addUserIconS"></a>  
                        </div>
                        <div class="grid_6 hidden-mobile"><?php $this->renderpartial('common.views.common.modals._commonShare'); ?></div>
                        <div class="grid_3 hidden-mobile">
                            <div class="grid_ alpha">
                                <div class="micromargin"></div>
                                <div class="LEFT">
                                <?php //$this->widget('common.extensions.Yiitube', array('v' => 'JhKQz2TwSAE')); ?>
                                    <?php $this->renderpartial('common.views.common.modals._commonAttach',array("filedivid"=>"fleattachPost","wlinkdivid"=>"wlinkattachPost"));?>
                                </div>
                                <div class="tinymargin"></div>
                                <div id="fleattachPost"></div>
                                <div id="lblfleattachPost"></div>
                                <div class="tinymargin"></div>
                                <div id="wlinkattachPost"></div>
                                <div id="lblwlinkattachPost"></div>
                            </div>
                    	</div>                    
                    	<button class="btntag RIGHT" style="margin: 6px 0 0 2px;">Post</button>
                    </div>
                </div>
                <!--</form>-->
		
		    </div>
		
                <?php $this->endWidget(); ?>            
            	<div class="clear"></div>
            </div>               
            <div class="halfmargin"></div>  
            <div id="doposts">
            <?php 
				if(count($model)>0){
					foreach($model as $key=>$val){					
						$usermodel = TblSysUsers::model()->findByPk($val['UserId']);
						$criteriaCom = new CDbCriteria();
						$criteriaCom->condition = 'MId='.Yii::app()->user->MId.' and WallId='.$val['WallId'].' and CType="Wall"';
						$commentmod = TblCollComments::model()->findAll($criteriaCom);
						
						if(empty($usermodel['Avatar'])){$img = "http://assets.bw.ae/bw/images/apps/avatar.png";}
						else{
							$path = Yii::app()->params['documentPath'].Yii::app()->user->MId."/users/".$usermodel['Avatar'];
							$img = Yii::app()->request->baseUrl.ImageHelper::thumb(70,70, $path, array('method' => 'resize'));
						}
						
						$attachments = BWColFunctions::funcGetAttachData('Wall',$val['WallId']);
						
						if(BWColFunctions::funcCheckUserLike($usermodel['Userid'],Yii::app()->user->Id,'user')>0){ 
							$unfollowdisplay = ''; 
							$followdisplay = 'style="display:none;"'; 
						}else{ 
							$unfollowdisplay = 'style="display:none;"'; 
							$followdisplay = ''; 
						}  
			?>

               <div class="padding" id="postcontent">  <!-- Start of container of each post -->

                    <div class="grid_1 alpha profilePic medium"> <a href="#"><img src="<?=BWCFunctions::getAvatar('Big',$usermodel['Avatar']) ?>" border="0" alt="" /></a> </div>
                    
                    <div class="grid_11 omega wall">
                        <div class="pointer"></div>
                            <div class="uniBlock">
                                <p class="normaltxt1 noMargUp noMargDown">
                                    <a href="#" class="BLACK"><b><?=$usermodel['Name'] ?></b></a>
                                    <span class="spacer"></span>
                                    
                                    <span id="unfollow<?=$usermodel['Userid'] ?>" <?=$unfollowdisplay ?>>
                                    <?php 
                                        echo CHtml::ajaxLink('',array('/site/unlike/wtype/user/ltype/user/id/'.$usermodel['Userid']),array('type'=>'get','data'=>'','success'=>'function(data){$("#unfollow'.$usermodel['Userid'].'").hide(); $("#follow'.$usermodel['Userid'].'").show(); noticeAjax("Successfully Unfollow  Done...!", "success");}','dataType'=>'json','update'=>'test'),array('class'=>'star full',"title"=>"Unfollow"));  
                                    ?>
                                    </span>
                                    
                                    <span id="follow<?=$usermodel['Userid'] ?>" <?=$followdisplay ?>>
                                    <?php 
                                        echo CHtml::ajaxLink('',array('/site/like/wtype/user/ltype/user/id/'.$usermodel['Userid']),array('type'=>'get','data'=>'', 'success'=>'function(data){$("#follow'.$usermodel['Userid'].'").hide(); $("#unfollow'.$usermodel['Userid'].'").show(); noticeAjax("Following Now...!","success"); }','dataType'=>'json','update'=>'test'),array('class'=>'star empty',"title"=>"Follow")); 
                                    ?>
                                    </span>
                                    
                                    <span class="spacer"></span>
                                    <?php 
                                        $posttime = BWDataFunction::humanTiming(strtotime($val['CreatedOn'])); 
                                        if(strlen($posttime)>0){ echo $posttime; }else{ echo "2 second ago";} 
                                    ?>
                                </p>
                                
                                <p class="normaltxt1"><? $parsed = parse_url($val['WallPost']); 
                                		$imagepath = explode(".",$parsed['path']);
                                if($parsed['host']=="www.youtube.com" || $parsed['host']=="youtu.be"){
                                	
								$this->beginWidget('common.extensions.prettyPhoto.PrettyPhoto', array('id'=>'pretty_photo',
		// prettyPhoto options
		'options'=>array(
				'opacity'=>0.60,
				'modal'=>true,
'overlay_gallery'=>false,
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
'overlay_gallery'=>false,
								),
								));	 	
				BWColFunctions::getYouTubeVideo($val['WallPost']);
							$this->endWidget('common.extensions.prettyPhoto.PrettyPhoto');
                                }else{ echo BWColFunctions::funcTextToLink($val['WallPost']); } ?></p>
                                
                                <?php if(count($attachments)>0){ ?>
                                <p class="normaltxt1">
									<?php foreach($attachments as $keyattach=>$valattach)
										{
											$attachimg = "";
											 $attachfile = "";
											
                                            if($valattach['ShareType']=='file')
											{	
												//echo Yii::app()->params['documentPath']."uploads/".$valattach['ItemName'];									
                                                $filext = strtoupper(BWDataFunction::file_extension($valattach['ItemName']));
                                                if(in_array($filext,BWDataFunction::getImageExtentionsArray())){
                                                //$path = Yii::app()->params['documentPath']."uploads/".$valattach['ItemName'];
                                               // $attachimg = Yii::app()->request->baseUrl.ImageHelper::thumb(220,220, $path, array('method' => 'resize'));
												$attachimg = BWCFunctions::getWallPostImage('Small',$valattach['ItemName']);	
												
                                            }else{
												 $attachfile = $valattach['ItemName'];
											}
                   						 ?>
                        <span>	
                            <a title="Download" href="javascript:void(0);" onclick="location.href='/intranet/Files/default/download/id/<?=$valattach['ItemId'] ?>';">
                            <? if(strlen($attachimg)>0) {?>
                                        <img src="<?php echo $attachimg ?>" title="<?php echo $valattach['ItemName']; ?>" border="0" alt="" />
                                        <? }else if(strlen($attachfile)>0){ echo $attachfile; } ?><? //=$valattach['ItemName'] ?></a>
                        </span>
                                    
                                    <span class="spacer"></span>
									<?php 
                                        }else if($valattach['ShareType']=='wlink'){ 
                                            $linkData = BWCFunctions::getRecordsByPk('TblBookMarks',$valattach['ItemId']);
                                    ?>
                                    <div class="tinymargin"></div>
                                    <span>	
                                    	<a title="<?=$valattach['ItemName'] ?>" href="<?=$linkData['Link'] ?>" target="<?=$linkData['Target'] ?>" ><?=$valattach['ItemName'] ?></a>
                                    </span>
                                    <span class="spacer"></span>
									<?php } } ?>
                                </p>
								<?php } ?>
                            </div>
                            
                            <?php 
								if(BWColFunctions::funcCheckUserLike($val['WallId'],Yii::app()->user->Id,'wall')>0){ 
								$unfollowdisplay = ''; $followdisplay = 'style="display:none;"'; 
								}else{ $unfollowdisplay = 'style="display:none;"'; $followdisplay = ''; }
							?>
                            
                            <div class="uniBlock">
                                <p class="normaltxt1 noMargUp noMargDown LEFT">
                                    <a href="#" class="BLACK"><b>Comment (<?=count($commentmod) ?>)</b></a>
                                    <span class="spacer">-</span>
                                    <b>
                                        <span id="unlike<?=$val['WallId'] ?>" <?=$unfollowdisplay ?>>
                                        <?php 
                                            echo CHtml::ajaxLink('',array('/site/unlike/wtype/wall/ltype/wall/id/'.$val['WallId']),array('type'=>'get','data'=>'','success'=>'function(data) { $("#likecount'.$val['WallId'].'").html("Like ("+data.likecount+")");  $("#unlike'.$val['WallId'].'").hide(); $("#like'.$val['WallId'].'").show(); }','dataType'=>'json','update'=>'test'),array('class'=>'star full',"title"=>"Unlike"));
                                        ?>
                                        </span>
                                        
                                        <span id="like<?=$val['WallId'] ?>" <?=$followdisplay ?>>
                                        <?php 
                                            echo CHtml::ajaxLink('',array('/site/like/wtype/wall/ltype/wall/id/'.$val['WallId']),array('type'=>'get','data'=>'','success'=>'function(data) { $("#likecount'.$val['WallId'].'").html("Like ("+data.likecount+")"); $("#like'.$val['WallId'].'").hide(); $("#unlike'.$val['WallId'].'").show(); }','dataType'=>'json','update'=>'test'),array('class'=>'star empty',"title"=>"Like")); 
                                        ?>
                                        </span>
                                        <div class="BLACK LEFT" id="likecount<?=$val['WallId'] ?>">Like (<?=BWColFunctions::funcToalUserLike($val['WallId'],'wall') ?>)</div>
                                    </b>
                                    <span class="spacer">-</span>
                                    <b>
                                        <?php 
                                            echo CHtml::ajaxLink('Share',array('/site/share/id/'.$val['WallId']),array('type'=>'get','data'=>'','success'=>'function(data) { noticeAjax("Successfully Shared on Your Wall...!","success");}','dataType'=>'json','update'=>'test'),array('class'=>'BLACK',"title"=>"Share"));
                                        ?>
                                    </b>
                                </p>
                            </div>                            
                            <?php 
								if(count($commentmod)>0){
									foreach($commentmod as $keycom=>$valcom){
										$usercom = TblSysUsers::model()->findByPk($valcom['UserId']);
										if(empty($usercom['Avatar'])){
											$img = "http://assets.bw.ae/bw/images/apps/avatar.png";
										}else{
											$path = Yii::app()->params['documentPath'].Yii::app()->user->MId."/users/".$usercom['Avatar'];
											$img = Yii::app()->request->baseUrl.ImageHelper::thumb(46,46, $path, array('method' => 'resize'));
										}
										
										$comattachments = BWColFunctions::funcGetAttachData('comment',$valcom['ComId']);
							?>
                            <div class="uniBlock gray">
                            <!--<div class="grid_12"><a href="#" class="BLACK SMALL">View older comments ...</a><div class="halfmargin"></div></div>-->

                                <div class="grid_1 alpha profilePic small"> <a href="#"><img src="<?=BWCFunctions::getAvatar('Small',$usercom['Avatar']); ?>" border="0" alt="" /></a> </div>                    
                                <div class="grid_11">
                                    <p class="normaltxt1 noMargUp">
                                        <a href="#" class="BLACK"><b><?=$usercom['Name'] ?></b></a>
                                        <span class="spacer"></span>
                                        <?=BWDataFunction::humanTiming(strtotime($valcom['CreatedOn'])); ?>
                                    </p>
                                    <p class="normaltxt1"><? $parsed = parse_url($valcom['Comment']); 
                                		$imagepath = explode(".",$parsed['path']);
                                if($parsed['host']=="www.youtube.com" || $parsed['host']=="youtu.be"){
                                	
								$this->beginWidget('common.extensions.prettyPhoto.PrettyPhoto', array('id'=>'pretty_photo',
		// prettyPhoto options
		'options'=>array(
				'opacity'=>0.60,
				'modal'=>true,
'overlay_gallery'=>false,
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
'overlay_gallery'=>false,
								),
								));	 	
				BWColFunctions::getYouTubeVideo($valcom['Comment']);
							$this->endWidget('common.extensions.prettyPhoto.PrettyPhoto');
                                }else{ echo BWColFunctions::funcTextToLink($valcom['Comment']); } ?></p>
									<?php if(count($comattachments)>0){ ?>
                                    <p class="normaltxt1">
										<?php foreach($comattachments as $keyattach=>$valattach){
											$attachimg = "";
											 $attachfile = "";
											
                                            if($valattach['ShareType']=='file')
											{	
												//echo Yii::app()->params['documentPath']."uploads/".$valattach['ItemName'];									
                                                $filext = strtoupper(BWDataFunction::file_extension($valattach['ItemName']));
                                                if(in_array($filext,BWDataFunction::getImageExtentionsArray())){
                                                //$path = Yii::app()->params['documentPath']."uploads/".$valattach['ItemName'];
                                               // $attachimg = Yii::app()->request->baseUrl.ImageHelper::thumb(220,220, $path, array('method' => 'resize'));
												$attachimg = BWCFunctions::getWallPostImage('Small',$valattach['ItemName']);	
												
                                            }else{
												 $attachfile = $valattach['ItemName'];
											}
                 						 ?>
                        <span>	
                            <a title="Download" href="javascript:void(0);" onclick="location.href='/intranet/Files/default/download/id/<?=$valattach['ItemId'] ?>';">
                            <? if(strlen($attachimg)>0) {?>
                                        <img src="<?php echo $attachimg ?>" title="<?php echo $valattach['ItemName']; ?>" border="0" alt="" />
                                        <? }else if(strlen($attachfile)>0){ echo $attachfile; } ?><? //=$valattach['ItemName'] ?></a>
                        </span>
                                        
                                        <span class="spacer"></span>
                                        <?php }else if($valattach['ShareType']=='wlink'){
                                                    $linkData = BWCFunctions::getRecordsByPk('TblBookMarks',$valattach['ItemId']);
                                        ?>
                                        <div class="tinymargin"></div>
                                        
                                        <span>
                                            <a title="<?=$valattach['ItemName'] ?>" href="<?=$linkData['Link'] ?>" target="<?=$linkData['Target'] ?>" ><?=$valattach['ItemName'] ?></a>
                                        </span>
                                        <span class="spacer"></span>
                                        <?php } } ?>
                                    </p>
									<?php } ?>
                                </div>
                            	<div class="clear"></div>
                            </div>
							<?php } } ?>                            
                            <form action="/intranet/site/postcomment" method="post" name="frmcomment" id="<?=$val['WallId'] ?>" onsubmit="javascript: return checkForm(this);" >
                            <div class="uniBlock gray">
                                <div class="grid_1 alpha profilePic small"> <a href="#"><img src="<?=BWCFunctions::getAvatar('Small'); ?>" border="0" alt="" /></a></div>
                                <div class="grid_11 RIGHT">
					
					     <?php echo CHtml::textArea('comment['.$val['WallId'].']',"", array('rows'=>20,'cols'=>125,'class'=>'uniBlock',
	'onblur'=> CHtml::ajax(array(
     'url'=>Yii::app()->createUrl('site/loadVideo'),
     'type'=>'post',                                                        
     //'dataType'=>'json',
     'data'=>array('title' => 'js:this.value'),
     'success' => "js:function(data)
                {
					$('#postcommentVideo".$val['WallId']."').show();
					$('#postcommentVideo".$val['WallId']."').html(data);
                   //alert(data);
                }",
     'error' => "function(data, status){ $('#postcommentVideo').hide(); }",
 )),'placeholder'=>'Type a comment ...','id'=>"comment_".$val['WallId']));?>
				    <?php //echo $form->error($newModel,'WallPost');?>
				    <div id="postcommentVideo<?php echo $val['WallId'] ?>" class="hidden"></div> 
				    
				</div>
				<div class="grid_11 RIGHT">
                                <div class="tinymargin"></div>
                                <button class="btntag" style="margin: -5px 0 0 1px;">Post</button>
				
				<?php $this->renderpartial('common.views.common.modals._commonAttach',array("filedivid"=>"fleattachPost_".$val['WallId'],"wlinkdivid"=>"wlinkattachPost_".$val['WallId'])); ?>
                                
				<div class="tinymargin"></div>
                                <div id="fleattachPost_<?=$val['WallId'] ?>"></div>
                                <div id="lblfleattachPost_<?=$val['WallId'] ?>"></div>
                                <div class="tinymargin"></div>
                                <div id="wlinkattachPost_<?=$val['WallId'] ?>"></div>
                                <div id="lblwlinkattachPost_<?=$val['WallId'] ?>"></div>
                            </div>
                            <div class="clear"></div>
                            </form> 
                    	</div>
                    </div>
 
                </div> <!-- End of each container --> 				              
            	<div class="halfmargin"></div>
            <?php } } ?>
            </div>
            <!-- End of each container -->
            <div class="halfmargin"></div>
        </div>
        <?php if(count($model)>0){ $this->widget('common.extensions.yiinfinite-scroll.YiinfiniteScroller', array(
													'contentSelector' => '#doposts',
													'itemSelector' => 'div #postcontent',
													'loadingImg' => 'http://assets.bw.ae/bw/images/apps/ajax-loader.gif',
													'loadingText' => '&nbsp;',
													'donetext' => '&nbsp;',
													'pages' => $pages
				)); }/*else{ echo "No Records Found"; }*/
		?>
   
    <?php $this->renderPartial('intranet.views.modals._JsSubmitCode'); ?>
    <?php $this->renderpartial('intranet.views.modals._filesList'); ?>
    <?php $this->renderpartial('intranet.views.modals._weblinkList'); ?>

<script type="application/javascript" language="javascript">
function checkForm(frm)
{
	var str = $('#comment_'+frm.id).val();
	if(/^\s*$/.test(str))
	{return false;}
	return true;
}

</script>