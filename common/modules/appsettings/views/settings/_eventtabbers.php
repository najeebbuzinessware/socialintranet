<script type="text/javascript">
	$(document).ready(function(){
			
			$('.d-img').hover(function(){
				$(this).parent().find('.img-logo').css('display','block'); 
				
			}, function(){
				$(this).parent().find('.img-logo').css('display','none'); 
			});
	});

</script>

<script type="text/javascript">

	$(document).ready(function(){

		

		$('table.add-item .enableIcon').click(function(){

			var inputcity = $(this).closest('table.add-item').find('input[type="text"]');

			var inputcountry = $(this).closest('table.add-item selectBox').find('input[type="text"]');

			if (!inputcity.val()) {

				alert('Input feilds can not be empty');

			}

			else {

				var city = inputcity.val();

				var btnid = $(this).attr('btnid');

				

				var country = inputcountry.val();

				if($(this).closest('.add-item').hasClass('location')){

					var appenditem = '<tr class="actionRow"><td class="title"><div class="grid_6"><input type="text" class="full" name="Input[cityName][]" value="'+ city +'"/></div><div class="grid_6"><input type="text" name="Input[country][]" class="full" value="'+ country +'"/></div><div class="grid_3"><input type="text" name="Input[cityName][SortOrder][]" class="full" /></div></td><td class="controls"><a href="#" title="Update" class="icon enableIcon"></a><a href="#" title="Delete" class="icon deleteIcon"></a></td></tr>';

				}

				else {

					var appenditem = '<tr class="actionRow"><td class="title"><div class="grid_8"><input type="text" class="full" name="Input['+ btnid +'][]"  value="'+ city +'"/></div><div class="grid_3"><input type="text" name="Input['+ btnid +'][SortOrder][]" class="full" /></div></td><td class="controls"><a href="#" title="Add" class="icon enableIcon"></a><a href="#" title="Edit" class="icon editIcon"></a></td></tr>';

				}

				

				

				$(this).closest('ul.tab-parent').find('table.list-item').prepend(appenditem);
//$('#setting').prepend(appenditem);
				inputcity.val("");

				$('.list-wrap').css('height', 'auto');

			}	

		});	

	});

</script>

<div class="o-tabs">
     <ul class="nav">
          <li><a href="#eventTypes" class="current">
               <?= Yii::t('translate','Event Type') ?>
               </a></li>
     </ul>
     <div class="list-wrap">
          <div class="micromargin"></div>
          <ul id="eventTypes" class="tab-parent">
               
               <!-- Add Item -->
               
               <table class="default add-item" cellpadding="10" cellspacing="0" border="0">
                    <tr class="highlight">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField('eventtype','',array('placeholder'=>'Enter Event Type','class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void()" title="Add" btnid="eventtype" class="icon enableIcon"></a></td>
                    </tr>
               </table>
               <div class="margin"></div>
               
               <!-- listing -->
               
               <table class="default list-item" cellpadding="10" cellspacing="0" border="0" >
                    <tr>
                         <td class="title"><div class="grid_8">
                                   <?= Yii::t('translate','Event Type') ?>
                              </div>
                              <div class="grid_3">
                                   <?= Yii::t('translate','Order') ?>
                              </div></td>
                         <td class="RIGHT"><?= Yii::t('translate','Actions') ?></td>
                    </tr>
                    <?php
						$criteria = new CDbCriteria;
						$criteria->condition = "MID = ".Yii::app()->user->MId." AND IsActive='Yes' AND IsDelete='No'";
						$criteria->order = 'SortOrder ASC';	
						$etypemodel = TblAppClubEventType::model()->findAll($criteria);
					?>
                    <?php foreach($etypemodel as $key=>$value){?>
                    <tr class="actionRow" id="role<?=$value['CETId']?>">
                         <td class="title"><div class="grid_8"> <?php echo CHtml::textField("Edit[eventtype][".$value['CETId']."]",$value['EventType']);?> </div>
                              <div class="grid_3"> <?php echo CHtml::textField('Edit[eventtypeSortOrder]['.$value['CETId'].']',$value['SortOrder'],array('class'=>'full'));?> </div></td>
                         <td class="controls"><a href="javascript:void(0)" title="Delete" class="icon deleteIcon eventtypedel" data-eventtypedelID="<?=$value['CETId']?>"></a> <a href="#" title="Update" class="icon enableIcon eventtypeedit" data-roleID="Edit_eventtype_<?=$value['CETId']?>"></a></td>
                    </tr>
                    <?php }?>
               </table>
          </ul>
     </div>
</div>
<script language="javascript" type="application/javascript">


$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-roleID');

	document.getElementById(projid).disabled = false;	

	e.stopPropagation();

	e.preventDefault();

	}

}, 'a.eventtypeedit');


/*Deleting Process*/



$(document).on({

	click:

	function(e) {

	var projid = $(this).attr('data-eventtypedelID');	

	e.stopPropagation();

	if(confirm("Do you want to Delete the Event Type ?"))
	{
		$.ajax({
			  type:'POST',
			  url: '/appsettings/settings/delete/id/'+projid+'/fieldName/CETId/tableName/TblAppClubEventType',
			  success: function(data){$('#role'+projid).attr('style','display: none');
			  		noticeAjax("Event Type Deleted Successfully...!","success");
			  } 
		 });
	}
   	return false;
	e.preventDefault();
	}
}, 'a.eventtypedel');


$(document).on({

	click:

	function(e) {return false;}

}, 'a.noIcon'); 



</script>