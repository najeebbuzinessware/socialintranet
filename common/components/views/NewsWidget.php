<?php 
/* $feedcriteria = new CDbCriteria;
$feedcriteria->condition = "UserId=".Yii::app()->user->Id." and RssId = '".$newsettings['FeedId']."'";
$feedcriteria->group = "ItemName"; */
//$feedmodel = TblNewsRss::model()->findByAttributes(array("UserId"=>Yii::app()->user->Id,"MId"=>Yii::app()->user->MId));
$feedmodel = TblNewsRss::model()->findByPk($newsettings['FeedId']);
if(count($feedmodel)<1){
	$feedmodel = New TblNewsRss();
}

?>

<div class="rnBox" >
    <div class="rnbox_Title" >
        <p class="pull-left" >News</p>
        <ul class="inline pull-right" >
            <li> <a href="#NewsSetting" data-toggle="modal"><i class="icon-cog righteditAction">&nbsp;</i></a></li>
            <li><a href="#addNews" data-toggle="modal" ><i class="icon-plus icon-green" ></i></a></li>
        </ul>
    </div>

     <? 					
        if(strlen($feedmodel->RssLink)>0)
         { 
            $count="";
                if($newsettings['RecordLimit']>0){$limit=$newsettings['RecordLimit'];}else{$limit=3;}
                    $this->widget('application.extensions.yii-feed-widget.YiiFeedWidget'.$count,array('url'=>$feedmodel->RssLink,'limit'=>$limit));
                    $count+=1;
            
        }  ?>

</div>