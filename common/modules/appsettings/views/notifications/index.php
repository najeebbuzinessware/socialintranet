<div id="outer_container" class="custom_background">
<?php $gtype=BWDataFunction::getSectionNameFromCtype($_GET['type']); ?>
<?php BWDataFunction::getSectionMenuFromCtype($_GET['type']); ?>
<div class="container_12">
    <div class="grid_1">
        <div id="sideIcons"> 
            <a href="#addRule" title="<?=Yii::t('translate','Add a New Rule') ?>" class="icon addruleIcon InlineModalTrigger"></a>
            <div class="halfmargin"></div>
            <a href="#rulesAnchor" title="<?=Yii::t('translate','Defined Rules') ?>" class="icon notifIcon InlineScrollTrigger"></a>
            <div class="margin"></div>
            <a href="<?php echo $gtype; ?>/appsettings/notifications/addTemplate/type/<?=$_GET['type']?>" title="<?=Yii::t('translate','Add a New Template') ?>" class="icon addtemplateIcon"></a>
            <div class="halfmargin"></div>
            <a href="#templatesAnchor" title="<?=Yii::t('translate','Notification Templates') ?>" class="icon emailIcon InlineScrollTrigger"></a>
            <div class="halfmargin"></div>
            <a href="#" onClick="return: false;">&nbsp;</a>
        </div>
    </div>
    
    <div class="grid_11"><?php $this->renderpartial('appsettings.views._notificationMenu'); ?></div>
    
    <div class="grid_11 box shadowed_little">
        <div class="padding">
            <h2 class="headline1-inner lined"><?=Yii::t('translate','Rules &amp; Notifications') ?></h2>            
            <table class="default common-table" cellpadding="10" cellspacing="0" border="0">
            <tr class="actionRow foldable">
                <td class="title">
                	<h4 class="headline4" id="rulesAnchor"><?=Yii::t('translate','Defined Notification Rules') ?></h4>
                </td>
                <td class="controls">
                    <a href="#" title="Show / Hide Options" class="icon foldIcon"></a> 
                    <?php /*?><a href="#" title="Print This View" class="icon printIcon hidden"></a> 
                    <a href="#" title="Export to Excel" class="icon excelIcon hidden"></a> 
                    <a href="#" title="Search in View" class="icon searchIcon hidden"></a><?php */?>
                    <div class="actionBtn_drop">
                        <div class="grid_12">
                            <input class="full" type="text" value="<?php echo Yii::t('translate','Search in title ...'); ?>" placeholder="<?php echo Yii::t('translate','Search in title ...'); ?>" />
                        </div>
                        <div class="tinymargin"></div>                    
                        <div class="grid_4">
                            <input class="full" type="text" value="<?php echo Yii::t('translate','Start Date'); ?>" placeholder="<?php echo Yii::t('translate','Start Date'); ?>" />
                        </div>
                        <div class="grid_4">
                            <input class="full" type="text" value="<?php echo Yii::t('translate','End Date'); ?>"  placeholder="<?php echo Yii::t('translate','End Date'); ?>" />
                        </div>
                        <div class="grid_4">
                            <select class="full">
                                <option selected="selected" value="Active">
                                <?=Yii::t('translate','Active') ?>
                                </option>
                                <option value="Inactive">
                                <?=Yii::t('translate','Inactive') ?>
                                </option>
                            </select>
                        </div>
                        <div class="tinymargin"></div>
                        <div class="grid_12">
                            <input type="submit" class="GoBtn" value="" />
                        </div>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td colspan="2" class="p-l-0"><div >
                <table class="ACL" cellpadding="10" cellspacing="0" border="0" width="100%">
                <tr class="trheader">
                    <th width="" class="p-l-0"><?=Yii::t('translate','Action Name') ?></th>
                    <th width="" class="p-l-0"><?=Yii::t('translate','Tempelate Name') ?></th>
                    <th width="" class="p-l-0"><?=Yii::t('translate','Timestamp') ?></th>
                    <th width="" class="p-l-0"><?=Yii::t('translate','Operations') ?></th>
                </tr>
				<?php         
					$this->widget('zii.widgets.CListView', array(
									'dataProvider'=>$RuledataProvider,
									'itemView'=>'_rulesresult',
									'template'=>"{items}\n\n{pager}",
									'pager'=>array(
											'header' => '',
											'nextPageLabel' => '>>',
											'prevPageLabel'=>'<<',
											'maxButtonCount'=>'0',
											'cssFile'=>'false'
									),
					));
				?>
                </table>
                </div>
                </td>
            </tr>
            
            <tr class="actionRow foldable">
                <td class="title"><h4 class="headline4" id="templatesAnchor"><?=Yii::t('translate','Templates') ?></h4></td>
                <td class="controls">
                    <a href="#" title="<?=Yii::t('translate','Show / Hide Options') ?>" class="icon foldIcon"></a> 
                    <?php /*?><a href="#" title="<?=Yii::t('translate','Print This View') ?>" class="icon printIcon hidden"></a> 
                    <a href="#" title="Export to Excel" class="icon excelIcon hidden"></a>
                    <a href="#" title="<?=Yii::t('translate','Search in View') ?>" class="icon searchIcon hidden"></a><?php */?>
                    <div class="actionBtn_drop">
                        <div class="grid_12">
                        	<input class="full" type="text" value="<?php echo Yii::t('translate','Search in title ...'); ?>"  placeholder="<?php echo Yii::t('translate','Search in title ...'); ?>"/>
                        </div>
                        <div class="tinymargin"></div>                        
                        <div class="grid_4">
                        	<input class="full" type="text" value="<?php echo Yii::t('translate','Start Date'); ?>"  placeholder="<?php echo Yii::t('translate','Start Date'); ?>" />
                        </div>
                        <div class="grid_4">
                        	<input class="full" type="text" value="<?php echo Yii::t('translate','End Date'); ?>"  placeholder="<?php echo Yii::t('translate','End Date'); ?>"/>
                        </div>
                        <div class="grid_4">
                            <select class="full">
                                <option selected="selected" value="Active"><?php echo Yii::t('translate','Active'); ?></option>
                                <option value="Inactive"><?php echo Yii::t('translate','Inactive'); ?></option>
                            </select>
                        </div>
                        <div class="tinymargin"></div>
                        <div class="grid_12">
                        	<input type="submit" class="GoBtn" value="" />
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="holder"><div class="safeWrapper">
                <table class="ACL" cellpadding="10" cellspacing="0" border="0">
                <tr class="trheader">
                    <th><?=Yii::t('translate','Template Name') ?></th>
                    <th><?=Yii::t('translate','Timestamp') ?></th>
                    <th><?=Yii::t('translate','Operations') ?></th>
                </tr>
		    <?          
			$this->widget('zii.widgets.CListView', array(
			    'dataProvider'=>$dataProvider,
			    'itemView'=>'_templateresult',
			    'template'=>"{items}\n\n{pager}",
			    'pager'=>array(
			    'header' => '',
			    'nextPageLabel' => '>>',
			    'prevPageLabel'=>'<<',
			    'maxButtonCount'=>'0',
			    'cssFile'=>'false'						
			    ),
			)); 
		    ?>
                </table>
                </div>
                </td>
            </tr>
            </table>
        	<div class="halfmargin"></div>
        </div>
    </div>
</div>
<div class="modal">
    <div id="editTemplate" class="container_12">
    	<div class="emptyModal"></div>
    </div>
</div>
<div class="modal">
    <div id="editRule" class="container_10">
    	<div class="emptyModal"></div>
    </div>
</div>

<script type="text/javascript">
/*$(document).on({
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
}, 'a.smallEditIcon');*/

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  //console.log(elem.attr('id'));
	  var projid = $(this).attr('data-delID');
	  $.ajax({
			  type:'POST',
			  url: '<?php echo $gtype; ?>/appsettings/notifications/deleteTemplate/type/<?=$_GET['type']?>/id/'+$(this).attr('data-delID'),
		      success: function(data){

			  $("#templ_"+projid).hide(); 
			  noticeAjax("Template Deleted Successfully","success"); 
			  
		   } 
         });
	   
	   return false;

	}
}, 'a.tempTrash');


/*$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  //console.log(elem.attr('id'));
	  $.ajax({
				type:'POST',
				url: '/members/notifications/editRules/type/<?=$_GET['type']?>/id/'+$(this).attr('data-ruleID'),
				success: function(data){
				$('#editRule').html(data);
				$(this).colorbox.resize();
			} 
		});
	}
}, 'a.editIcon');*/

$(document).on({

	  click:

	  function(e) {

	  // Cancel any default actions 

	  e.stopPropagation();

	  e.preventDefault();

	  // Super-charged Ajax call with geniun callback 

	  $('#editRule').load('<?php echo $gtype; ?>/appsettings/notifications/editRules/type/<?=$_GET['type']?>/id/'+$(this).attr('data-ruleID'), null, function() { $.colorbox.load(true); } );
	  
	}

}, 'a.editIcon');

$(document).on({
	  click:
	  function(e) {
	  e.stopPropagation();
	  var elem = $(this);
	  console.log(elem.attr('id'));
	  var projid = $(this).attr('data-RuleID');
	  $.ajax({
			  type:'POST',
			  url: '<?php echo $gtype; ?>/appsettings/notifications/deleteRule/type/<?=$_GET['type']?>/id/'+$(this).attr('data-RuleID'),
		      success: function(data){

			  $("#rules_"+projid).hide(); 
			  noticeAjax("Notification Rule Deleted Successfully","success"); 
			  
		   } 
         });
	   
	   return false;

	}
}, 'a.ruleTrash');

$(document).ready( function(){
	
   $('.foldable').trigger('click');
});


</script>
<?php $this->renderpartial('appsettings.views.modals._addRule',array("model"=>$rulesmodel)); ?>
<?php $this->renderpartial('appsettings.views.modals._addTemplate',array("model"=>$templatemodel)); ?>
