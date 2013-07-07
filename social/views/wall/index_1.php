<?php echo $this->renderPartial("common.views.common._rightColumn"); ?>
				
				<!-- Main Body -->
				<section id="content">
				
		<?php $this->widget('common.components.PostWidget',array("action"=>'/wall/wallpost'));  ?>

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
<article class="wallPost">
		
     <div class="firstPost">
			 <div class="firstPost-title">
				    <img src="http://placehold.it/65x65" alt="" class="posterImg">
				    <a class="f-bold block" href="javascript:void(0);"><?=$usermodel['Name'] ?></a>
				    <span class="postDate"><?php $posttime = BWDataFunction::humanTiming(strtotime($val['CreatedOn'])); if(strlen($posttime)>0){ echo $posttime; }else{ echo "2 second ago";} ?></span>
			 </div>
<!-- 			 <div class="postTitle">The opening of the company intranet portal</div> -->
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
			 <div class="commentHeader">
				    <div class="comment pull-left">
						  <i class="icon-comment m-r-5"></i>Comment(<?=count($commentmod) ?>)
				    </div>
				    <div class="like pull-left m-l-20">
						  <i class="icon-thumbs-up m-r-5"></i>
			<?php if(BWColFunctions::funcCheckUserLike($val['WallId'],Yii::app()->user->Id,'wall')>0){
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
				
		)); ?>
		
						  <span id="likecount<?=$val['WallId'] ?>">Like (<?=BWColFunctions::funcToalUserLike($val['WallId'],'wall') ?>)</span>
				    </div>
				    <div class="timing pull-right m-l-30">
						  <i class="icon-time m-r-5"></i><?php $posttime = BWDataFunction::humanTiming(strtotime($val['CreatedOn'])); if(strlen($posttime)>0){ echo $posttime; }else{ echo "2 second ago";} ?>
				    </div>
				    <div class="clearfix"></div>
			 </div>
			 
			 <!-- Commenting -->
			 
			 <ul class="commentList">
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
			 
				<li>
					<header class="m-b-5">
						<img src="http://placehold.it/40x40" class="posterImg" alt="">
						<a href="" class="f-bold m-r-20"><?=$usercom['Name'] ?></a>
						<span class="timing m-r-20"><i class="icon-time m-r-5"></i><?=BWDataFunction::humanTiming(strtotime($valcom['CreatedOn'])); ?></span>
						<span class="like"><i class="icon-thumbs-up m-r-5"></i>
						<?php $cmtlikedisplay = ''; 
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
						<span id="commentlikecount<?=$valcom['ComId'] ?>">Like (<?=BWColFunctions::funcToalUserLike($valcom['ComId'],'wall','comment') ?>)</span></span>
					</header>
					<p><? $parsed = parse_url($valcom['Comment']); 
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
                            }else{ echo BWColFunctions::funcTextToLink($valcom['Comment']); } ?></p>
				</li>
				
				<?php } } ?>
				
				<li class="p-5">
					<div class="t-center" id="commentbtn_<?=$val['WallId'] ?>">
						<a class="f-bold commentLink" href="javascript:void(0);" onclick="showcommentBox('commentLink','<?=$val['WallId'] ?>');" id="<?=$val['WallId'] ?>"><i class="icon-plus-sign"></i> Add Comment</a>
					</div> 
					 <form action="/wall/postcomment" method="post" name="frmcomment" id="<?=$val['WallId'] ?>"  onsubmit="javascript: return checkForm(this);">
					<div class="hBlock hide" id="commentdiv_<?=$val['WallId'] ?>">
<!-- 						<textarea class="span12 postText m-b-5" placeholder="..."></textarea> -->
						 <?php echo CHtml::textArea('comment['.$val['WallId'].']',"", array('rows'=>20,'cols'=>125,'class'=>'span12 postText m-b-5',
	'onblur'=> CHtml::ajax(array(
     'url'=>Yii::app()->createUrl('wall/loadVideo'),
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
						 <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>Yii::t('translate','Add'))); ?>
<!-- 						<button class="btn">Add</button> -->
						<button class="btn-link cancelComment" onclick="showcommentBox('commentbtn','<?=$val['WallId'] ?>');">Cancel</button>
					</div>
					</form>
				</li>
			 </ul>
			 
			 
	</div>
	</article>
	<?php }} ?>
	
	<div class="clearfix"></div>
<!-- </article> -->

<div class="clearfix"></div>
				</section>	
	
	<script type="application/javascript" language="javascript">
function checkForm(frm)
{
	var str = $('#comment_'+frm.id).val();
	if(/^\s*$/.test(str))
	{return false;}
	return true;
}
</script>