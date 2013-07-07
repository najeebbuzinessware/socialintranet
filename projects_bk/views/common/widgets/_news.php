<?php 
$feedcriteria = new CDbCriteria;
$feedcriteria->condition = "UserId=".Yii::app()->user->Id." and MId = '".Yii::app()->user->MId."'";
$feedcriteria->group = "ItemName";
//$feedmodel = TblNewsRss::model()->findByAttributes(array("UserId"=>Yii::app()->user->Id,"MId"=>Yii::app()->user->MId));
$feedmodel = TblNewsRss::model()->find($feedcriteria);
if(count($feedmodel)<1){
	$feedmodel = New TblNewsRss();
}
?>
<div class="borderedBox">
     <header>
          <h3>
               <i class="icon-bullhorn m-r-10"></i>News
              <i class="righteditAction">
               <?php 
               
               //$model = new TblNewsRss();
               //echo $feedmodel->NumberOfNews;
               $this->widget('bootstrap.widgets.TbEditableField', array(
               		'type'      => 'select',
               		'model'     => $feedmodel,
               		'attribute' => 'NumberOfNews',
               		'url'       => $this->createUrl('news/editableLimit'),  //url for submit data
               		'source'    => array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5"),
					
               ));
              ?> 
               </i>
        
               <a href="#addNews" data-toggle="modal"><i class="iconAction">+</i></a>
          </h3>
     </header>
     <div class="news">
     
          <ul class="nav-list">
          <? 		
					
					if(strlen($feedmodel->RssLink)>0)
					 { 
					 	$count="";
						 /* $count="";
						 foreach($feedmodel as $keyrss=>$valrss)
						 {
							if(strlen($valrss['RssLink'])>0)
							{ */
								if($feedmodel->NumberOfNews>0){$limit=$feedmodel->NumberOfNews;}else{$limit=3;}
								$this->widget('application.extensions.yii-feed-widget.YiiFeedWidget'.$count,array('url'=>$feedmodel->RssLink,'limit'=>$limit));
								$count+=1;
							/* }
						 } */
					}  ?>

          </ul>
     </div>
</div>