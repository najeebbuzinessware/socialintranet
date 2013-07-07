
<div class="modal">
  <div id="editTemplate" class="container_12">
    <div class="emptyModal"></div>
  </div>
</div>
<div class="modal">
  <div id="editRule" class="container_12">
    <div class="emptyModal"></div>
  </div>
</div>

<?php $this->renderpartial('application.views.common.modals._addRule',array("model"=>$rulesmodel)); ?>
<?php //$this->renderpartial('application.views.common.modals._addTemplate',array("model"=>$templatemodel)); ?>
<div id="outer_container" class="custom_background">
<?php 
	if($_GET['type']=='Projects'){ $this->renderpartial('application.views.common._projectmenu'); }
	else if($_GET['type']=='leads'){ $this->renderpartial('application.views.common._salescommon');}//else if($_GET['type']=='collaboration')
	else { $this->renderpartial('application.views.common._collaborationmenu'); } 
?>
<div class="container_12">
  <div class="grid_1">
    <div id="sideIcons"> <!----><a href="#addRule" title="<?=Yii::t('translate','Add a New Rule') ?>" class="icon addruleIcon InlineModalTrigger"></a>
      <div class="halfmargin"></div>
      <a href="#rulesAnchor" title="<?=Yii::t('translate','Defined Rules') ?>" class="icon notifIcon InlineScrollTrigger"></a>
      <div class="margin"></div>
      <div class="halfmargin"></div>
      <a href="#" onClick="return: false;">&nbsp;</a> </div>
  </div>
    <div class="grid_11">
         <?php $this->renderpartial('application.views.common._notificationMenu'); ?>
    </div>
  <div class="grid_11 box shadowed_little">
    <div class="padding">
      <h2 class="headline1-inner lined">
        <?=Yii::t('translate','Rules') ?>
      </h2>
      <p> </p>
      <table class="default" cellpadding="10" cellspacing="0" border="0">
        <tr class="actionRow foldable">
          <td class="title"><h4 class="headline4" id="rulesAnchor">
              <?=Yii::t('translate','Defined Notification Rules') ?>
            </h4></td>
          <td class="controls">
          	<a href="#" title="Show / Hide Options" class="icon foldIcon"></a> 
            <a href="#" title="Print This View" class="icon printIcon hidden"></a> 
            <a href="#" title="Export to Excel" class="icon excelIcon hidden"></a> 
            <a href="#" title="Search in View" class="icon searchIcon hidden"></a>
	    
            <div class="actionBtn_drop">
              <ul>
                <li>
                  <input class="full" type="text" value="<?php echo Yii::t('translate','Search in title ...'); ?>" placeholder="<?php echo Yii::t('translate','Search in title ...'); ?>" />
                </li>
                <li>
                  <div class="LEFT" style="margin-right: 17px;">
                    <input class="half" type="text" value="<?php echo Yii::t('translate','Start Date'); ?>" placeholder="<?php echo Yii::t('translate','Start Date'); ?>" />
                    <br/>
                  </div>
                  <div class="LEFT">
                    <input class="half" type="text" value="<?php echo Yii::t('translate','End Date'); ?>"  placeholder="<?php echo Yii::t('translate','End Date'); ?>" />
                  </div>
                </li>
                <li><?php echo Yii::t('translate','Status'); ?>
                  <select>
                    <option selected="selected" value="Active">
                    <?=Yii::t('translate','Active') ?>
                    </option>
                    <option value="Inactive">
                    <?=Yii::t('translate','Inactive') ?>
                    </option>
                  </select>
                </li>
                <li>
                  <input type="submit" class="submit" />
                </li>
              </ul>
            </div>
	  </td>
        </tr>

        <tr class="actionRow">

        </tr>
        <tr>
          <td colspan="2" class="holder"><div class="safeWrapper">
              <table class="ACL" cellpadding="10" cellspacing="0" border="0" width="100%">
                <tr class="trheader">
                  <th width="33%"><?=Yii::t('translate','Actiodsdsdn Name') ?></th>
                  <th width="33%"><?=Yii::t('translate','Tempedsdlate Name') ?></th>
                  <th width="33%"><?=Yii::t('translate','Timestamp') ?></th>
                  <th width="33%"><?=Yii::t('translate','Operations') ?></th>
                </tr>
                <?          
					$this->widget('zii.widgets.CListView', array(
							'dataProvider'=>$dataProvider,
							'itemView'=>'_rulesresult',
							'template'=>"{items}\n\n{pager}",
							'pager'=>array(
									'header' => '',
									'nextPageLabel' => '>>',
									'prevPageLabel'=>'<<',
									'maxButtonCount'=>'0',
									'cssFile'=>'false'
									
							),
					)); ?>
              </table>
            </div></td>
        </tr>
        
      </table>
      <div class="halfmargin"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  //console.log(elem.attr('id'));	 
	  $.ajax({
			  type:'POST',
			  url: '/members/notifications/editTemplate/id/'+$(this).attr('data-ID'),
		      success: function(data){
			  $('#editTemplate').html(data);
			  $(this).colorbox.resize();
			  
		   } 
         });
	   
	   return false;

	}
}, 'a.smallEditIcon');

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  //console.log(elem.attr('id'));
	  var projid = $(this).attr('data-delID');
	  $.ajax({
			  type:'POST',
			  url: '/members/notifications/deleteTemplate/id/'+$(this).attr('data-delID'),
		      success: function(data){

			  $("#templ_"+projid).hide(); 
			  noticeAjax("Template Deleted Successfully","success"); 
			  
		   } 
         });
	   
	   return false;

	}
}, 'a.trashIcon');


$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  console.log(elem.attr('id'));
	  $.ajax({type:'POST',
			  url: '/members/notifications/editRules/id/'+$(this).attr('data-ruleID'),
		      success: function(data){
			  $('#editRule').html(data);
			  $(this).colorbox.resize();
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
			  url: '/members/notifications/deleteRule/id/'+$(this).attr('data-delID'),
		      success: function(data){

			  $("#rules_"+projid).hide(); 
			  noticeAjax("Notification Rule Deleted Successfully","success"); 
			  
		   } 
         });
	   
	   return false;

	}
}, 'a.deleteIcon');

</script>
