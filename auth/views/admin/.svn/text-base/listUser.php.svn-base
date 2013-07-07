<div id="outer_container" class="custom_background">
<?php $this->renderpartial('application.views.admin._adminTopmenu'); ?>
<div class="container_12">
		<div class="grid_1">
			<div id="sideIcons">
				<a href="#addUser" title="Add Users" class="icon addUserIcon InlineModalTrigger"></a>
				<div class="halfmargin"></div>
    <?
				foreach ( range( 'A', 'Z' ) as $char )
				{
					foreach ( $alphasort as $keyalpha => $dataalpha )
					{
						if (strtoupper( strtolower( $dataalpha['username'] ) ) == $char)
						{
							?>
        <a href="#s<?=$char ?>" class="textScroller InlineScrollTrigger">
        <?=$char?>
        </a>
				<div class="halfmargin"></div>
    <? }}} ?>
    <a href="#" onClick="return: false;">&nbsp;</a>
			</div>
		</div>
		<div class="grid_11 box shadowed_little stick">
			<div class="padding">
				<h2 class="headline1 m-t-0 LEFT"><?=Yii::t("translate","Users") ?></h2>
				<div class="clear"></div>
				<div class="s-lined"></div>
				<div class="tinymargin"></div>
				<p class="normaltxt1 noMargDown noMargUp"><?=Yii::t("translate","Manage, add, delete and update user information.") ?></p>
				<div class="halfmargin"></div>
				<div class="bodyControls"></div>
				<table class="default" cellpadding="10" cellspacing="0" border="0" id="posts">
  <?
		
if (count( $usermodel ) > 0)
		{
			foreach ( $usermodel as $userkey => $userval )
			{
				$criteria = new CDbCriteria();
				$criteria->condition = "IsDelete=0 and LEFT(Name,1) IN ('" . $userval['username'] . "') AND MId = '" . Yii::app()->user->MId . "'";
				$criteria->order = "Name ASC";
				$users = TblSysUsers::model()->findAll( $criteria );
				?>
      <tr class="post">
						<td colspan="2" class="charHolder" id="<?php if(is_numeric($userval['username'])){ echo "sNumeric"; }else{ echo "s".$userval['username']; }?>"><?php if(is_numeric($userval['username'])) { echo "0 - 9"; }else { echo $userval['username']; }?></td>
					</tr>
      <?
				
foreach ( $users as $key => $val )
				{
					$jsid = $val['Userid'];
					?>
      <tr class="actionRow post" id="user_<?=$jsid ?>">
						<td class="title">
							<h4 class="headline2">
            	<?=$val['Name']?>
          	</h4>
						</td>
						<td class="controls"><a href="#editUser" title="Edit User" data-projID="<?=$val['Userid'] ?>" class="icon editIcon" id="el<?=$val['Userid'] ?>"></a> <a href="#" title="Delete User" data-delID="<?=$val['Userid'] ?>"
							class="icon deleteIcon hidden" id="delete<?=$val['Userid'] ?>"></a></td>
					</tr>
      <? } } } ?>
    </table>
    <?php
				
if (count( $usermodel ) > 0)
				{
					$this->widget( 'common.extensions.yiinfinite-scroll.YiinfiniteScroller', 
							array( 'contentSelector' => '#posts', 'itemSelector' => 'tr.post', 'loadingImg' => 'http://assets.bw.ae/bw/images/apps/ajax-loader.gif', 'loadingText' => '&nbsp;', 'donetext' => '&nbsp;', 'pages' => $pages ) );
				} else
				{
					echo "No Records Found";
				}
				?>
    <div class="margin"></div>
			</div>
		</div>
		<div class="modal" id="editDiv">
			<div id="editUser" class="container_12"></div>
		</div>

<?php $this->renderpartial('application.views.admin.modals._addUser',array("model"=>$model,"group"=>$group)); ?>

<script type="text/javascript">

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  console.log(elem.attr('id'));
	  $.ajax({
			  type:'POST',
			  url: '/admin/editUser/id/'+$(this).attr('data-projID'),
		      success: function(data){

			  $('#editUser').html(data)
			  elem.colorbox({ inline:true, open:true });
		   } 
         });
	   return false;
	}
}, 'a.editIcon');

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  console.log(elem.attr('id'));
	  var projid = $(this).attr('data-delID');
	  $.ajax({
			  type:'POST',
			  url: '/admin/deleteUser/id/'+$(this).attr('data-delID'),
		      success: function(data){

			  $("#user_"+projid).hide(); 
			  noticeAjax("User Deleted Successfully...!","success");
		   } 
         });
	   return false;
	}
}, 'a.deleteIcon');

</script>