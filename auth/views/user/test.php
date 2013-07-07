<div id="outer_container" class="custom_background">
     <?php $this->renderpartial('application.views.common._common'); ?>
     <div class="container_12">
        
          <div class="grid_11 box shadowed_little">
               <div class="padding">
                    <h2 class="headline1-inner bigtrashIcon lined">Recycle Bin</h2>
                    <p>Recover or permanently delete records from the system.</p>
                    <div class="halfmargin"></div>
                    <div class="bodyControls"></div>
                    <table class="default" cellpadding="10" cellspacing="0" border="0">
                        
                       <? 
                       $alphasort = array("1","2");
                       //if(count($alphasort)>0){ 
					   		foreach($alphasort as $key=>$val){
							$tablename = preg_replace('/(?<!^)([A-Z])/', " $0", str_replace("Tbl","",$val['TableName']));
							$dataProvider=new CActiveDataProvider('TblRecycleBin', array(
									'pagination'=>array(
											'pageSize'=>1,
									),
							));
								
						?>
                                               
                         <tr class="actionRow foldable">
                              <td class="title"><h4 class="headline4" id="<?=$val['TableName'] ?>Anchor">Deleted <?=$tablename ?></h4></td>
                              <td class="controls">
                              <a href="#" title="Show / Hide Options" class="icon foldIcon"></a>
                            </td>
                         </tr>
                                                  
                         
                         <tr>
                              <td colspan="2" class="holder"><div class="safeWrapper">
                                        <table class="ACL" cellpadding="10" cellspacing="0" border="0" id="<?=$val['TableName'] ?>posts">
                                        
                                             <tr class="trheader">
                                                  <th>Record Title</th>
                                                  <th>Deletion Timestamp</th>
                                                  <th>Deleted By</th>
                                                  <th>Operations</th>
                                             </tr></table>
                            <?          
							
$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_recyclebin',
		'template'=>"{items}\n\n{pager}",
		'pager'=>array(
				'header' => '',
		),
)); 
								
							?>

							<table>
                              </table>
                              
                                   </div></td>
                         </tr>
                         <? //}
					   		 } ?>
                      
                    </table>
                    <div class="margin"></div>
               </div>
          </div>
     </div>
</div>
