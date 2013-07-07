<?php

class BWColFunctions
{
	
	/*
	 * Function to handle redirect with Get Params encrypted
	 */
	
	public static function funcLike($ltype,$recordid,$userid,$walltype)
	{
		$model = new TblCollFollowers();
		$model->RecordId = $recordid;
		$model->MId = Yii::app()->user->MId;
		$model->FollowingBy = $userid;
		$model->CType = $walltype;
		$model->FollowingType = $ltype;
		$model->CreatedBy = Yii::app()->user->Id;
		$model->CreatedOn = date("Y-m-d H:i:s");
		if($model->save())
		{
			$where = "";
			if($ltype=='comment'){	$where =  ' and FollowingType="'.$ltype.'"';	}
			
			$criteria = new CDbCriteria();
			$criteria->condition = 'RecordId='.$recordid.' and MId='.Yii::app()->user->MId.' and CType="'.$walltype.'"'.$where;
			$model = TblCollFollowers::model()->findAll($criteria);
			return count($model);
		}
	}
	
	public static function funcUnLike($ltype=NULL,$recordid,$userid,$walltype)
	{
		$where = "";
		if($ltype=='comment'){	$where =  ' and FollowingType="'.$ltype.'"';	}
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'RecordId='.$recordid.' and MId='.Yii::app()->user->MId.' and CType="'.$walltype.'"'.$where;
		$model = TblCollFollowers::model()->deleteAll($criteria);
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'RecordId='.$recordid.' and MId='.Yii::app()->user->MId.' and CType="'.$walltype.'"'.$where;
		$model = TblCollFollowers::model()->findAll($criteria);
		return count($model);
	}
	
	public static function funcCheckUserLike($recordid,$userid,$walltype,$ltype=NULL)
	{
		$where = "";
		if($ltype=='comment'){	$where =  ' and FollowingType="'.$ltype.'"';	}
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'RecordId='.$recordid.' and MId='.Yii::app()->user->MId.' and CType="'.$walltype.'" and CreatedBy='.$userid.$where;
		$model = TblCollFollowers::model()->findAll($criteria);
		return count($model);
	}
	
	public static function funcToalUserLike($recordid,$walltype,$ltype=NULL)
	{
		$where = "";
		if($ltype=='comment'){	$where =  ' and FollowingType="'.$ltype.'"';	}
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'RecordId='.$recordid.' and MId='.Yii::app()->user->MId.' and CType="'.$walltype.'"'.$where;
		$model = TblCollFollowers::model()->findAll($criteria);
		return count($model);
	}
	
	
	public static function funcTotalWallPost($recordid,$walltype,$userid=NULL)
	{
		$where = "";
		if($walltype=="group")
		{
			$where = " and GroupId=".$recordid;
		}else if($walltype=="wall")
		{
			$where = " and UserId=".$recordid;
		}
		$criteria = new CDbCriteria();
		$criteria->condition = 'MId='.Yii::app()->user->MId.' and CType="'.$walltype.'"'.$where;
		$model = TblCollWall::model()->findAll($criteria);
		return count($model);
	}
	

	public static function funcShareData($recordid,$ctype,$shareid)
	{
			$explode = explode("_",$shareid);
			//if($explode[0]=='user'){ $stype=0;}else{ $stype=1; }
			
			$model = new TblCollShare();
			$model->MId = Yii::app()->user->MId;
			$model->RecordId = $recordid;
			$model->SharedWith = $explode[1];
			$model->SType = $explode[0]; 
			$model->CType = $ctype; 
			$model->CreatedBy = Yii::app()->user->Id;
			$model->CreatedOn = date("Y-m-d H:i:s");
			if($model->save())
			{
			 return true;
			}else{
			 return false;
			}
	}
	
	public static function funcMultiShareData($recordid,$ctype,$shareids)
	{
		if(count($shareids)>0){		
		
		foreach($shareids as $shareid){
			
				//$explode = explode("_",$shareid);
				
				$model = new TblCollShare();
				$model->MId = Yii::app()->user->MId;
				$model->RecordId = $recordid;
				$model->SharedWith = $shareid;
				$model->SType = 'User'; 
				$model->CType = $ctype; 
				$model->CreatedBy = Yii::app()->user->Id;
				$model->CreatedOn = date("Y-m-d H:i:s");
				$model->save();
			}
		}else{
				$model = new TblCollShare();
				$model->MId = Yii::app()->user->MId;
				$model->RecordId = $recordid;
				$model->SharedWith = 0;
				$model->SType = 'User'; 
				$model->CType = $ctype; 
				$model->CreatedBy = Yii::app()->user->Id;
				$model->CreatedOn = date("Y-m-d H:i:s");
				$model->save();
		}
		return true;
			
	}

	public static function funcGetUserFiles()
	{
		$where = "";
		if($_GET['id']>0 && !isset($_GET['type']))
		{
			$where = " and t.ParentId=".$_GET['id'];
			$fwhere = " and t.TreeId=".$_GET['id'];
		}else{
			$where = " and t.ParentId=0";
			$fwhere = " and t.TreeId=0";
		}	
			
        $criteria = new CDbCriteria();
		$criteria->join = " JOIN tbl_DM_Share as Ass ON t.TreeId = Ass.Folder"; 
		$criteria->condition = 't.IsDelete=0 and t.MId = "'.Yii::app()->user->MId.'" and t.UserId='.Yii::app()->user->Id.' and Ass.IsDelete=0 and (Ass.`Group`="'.$groupname.'" or Ass.UserId='.Yii::app()->user->Id.')'.$where;
		$criteria->group = 'Ass.Folder';
		$model = TblDMTree::model()->findAll($criteria);
		
		$criteria = new CDbCriteria();
		$criteria->join = " JOIN tbl_DM_Share as Ass ON t.DMRId = Ass.ShareId"; 
		$criteria->condition = 't.IsDelete=0 and t.MId = "'.Yii::app()->user->MId.'" and t.UserId='.Yii::app()->user->Id.' and Ass.IsDelete=0 and (Ass.Group="'.$groupname.'" or Ass.UserId='.Yii::app()->user->Id.')'.$fwhere;
		$filemodel = TblDMResource::model()->findAll($criteria);
		
		return $filemodel;

	}
	
	public static function funcGetUserWeblinks()
	{
		$where = "";
		if(base64_decode($_GET['type'])=="company")
		{
			$where = " and csh.CType='company'";
		}else{
			$where = " and csh.CType='Weblink'";
		}
		
		$criteria = new CDbCriteria;
		$criteria->join = " join tbl_Coll_Share as csh on t.BMarkId=csh.RecordId";
		$criteria->condition = "t.MId = '".Yii::app()->user->MId."' and csh.MId = '".Yii::app()->user->MId."' and (t.UserId=".Yii::app()->user->Id." or csh.SharedWith=".Yii::app()->user->Id.")".$where;
		//$criteria->condition = "MId = '".Yii::app()->user->MId."' and UserId=".Yii::app()->user->Id;
		$alphasort = TblBookMarks::model()->findAll($criteria);
		
		return $alphasort;

	}
	
	public static function funcGetAttachData($ctype,$recordid)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "MId = '".Yii::app()->user->MId."' and CType='".$ctype."' and RecordId=".$recordid;
		$model = TblCollAttachments::model()->findAll($criteria);
		
		return $model;

	}
	
	public static function funcAttachData($recordid,$ctype,$post)
	{
			//$explode = explode("_",$shareid);
			if(count($post['hdnfilename'])>0)
			{
				foreach($post['hdnfilename'] as $keyf=>$valf)
				{			
					$model = new TblCollAttachments();
					$model->MId = Yii::app()->user->MId;
					$model->ItemName = $valf;
					$model->ItemId = $keyf;
					$model->RecordId = $recordid;
					$model->ShareType = 'file'; 
					$model->CType = $ctype; 
					$model->CreatedBy = Yii::app()->user->Id;
					$model->CreatedOn = date("Y-m-d H:i:s");
					$model->save();
				}
			}
			
			if(count($post['hdnweblink'])>0)
			{
				foreach($post['hdnweblink'] as $keyw=>$valw)
				{			
					$model = new TblCollAttachments();
					$model->MId = Yii::app()->user->MId;
					$model->ItemName = $valw;
					$model->ItemId = $keyw;
					$model->RecordId = $recordid;
					$model->ShareType = 'wlink'; 
					$model->CType = $ctype; 
					$model->CreatedBy = Yii::app()->user->Id;
					$model->CreatedOn = date("Y-m-d H:i:s");
					$model->save();
				}
			}
	}
	
	public static function funcgetGroupTypes()
	{
		$array = array("Public"=>"Public","Private"=>"Private");
		return $array;
	}
	
	public static function funcHasGroupInvited($recordid,$userid,$walltype)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'RecordId='.$recordid.' and UserId='.$userid.' and MId='.Yii::app()->user->MId.' and CType="'.$walltype.'"';
		$model = TblInvitations::model()->findAll($criteria);
		return count($model);
	}
	
	public static function funcTextToLink($text){
	
		//return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
		return $text;
	}
		
	public function getYouTubeVideo($string)
	{
		Yii::import('common.extensions.Yiitube');
		
		//$string = $url;
		preg_match('/(http:\/\/)(.*)/', $string, $link);
		//print_r($link);
		if (empty($link[0])) {
			echo $string;
		} else {
			echo $string."<br />";
		}
		
		if(count($link)>0)
		{
			foreach($link as $key=>$val)
			{
				$explode = explode(" ",str_replace("<br />"," ",$val));
				$url = $explode[0];
				if(strlen($url)>0){
					$parsed = parse_url($url);
					//print_r($parsed);
					$imagepath = explode(".",$parsed['path']);
					//print_r($imagepath);
					if(strlen($parsed['query'])>0){
						$videoname = str_replace("v=","",$parsed['query']);
						return $this->widget('common.extensions.Yiitube', array('v' => $videoname));
					}elseif($parsed['host']=="youtu.be" && strlen($parsed['path'])>0){
						$videoname = str_replace("/","",$parsed['path']);
						return $this->widget('common.extensions.Yiitube', array('v' => $videoname));
					}elseif($parsed['host']!="youtu.be" && strlen($parsed['path'])>0 && (in_array("jpg",$imagepath) || in_array("png",$imagepath) || in_array("gif",$imagepath)))
					{	
						//$image = BWColFunctions::getWallPostImageThumb("Big",$url); 
						return '<a href="'.$url.'"><img title="YouTube video player" src="'.$url.'" height="150" width="150"  border="0" /></a>';
					}		
				
				}
			}	
		}	
	}
	
	public static function getWallPostImageThumb($type="Small",$wallImage)
	{
		if($type == "Big")
		{
			$ImageTypeWidth = 240;
			$ImageTypeHeight = 240;
			$ImageOption = "resizepercent";
		}else{
			$ImageTypeWidth = 90;
			$ImageTypeHeight = 90;
			$ImageOption = "resize";
		}
		if($wallImage != '' || !empty($wallImage))
		{
			echo $path = $wallImage;
		}
		
		/* if(!file_exists($path))
		{
			$path = $wallImage
		} */
	
		$img = ImageHelper::externalthumb( $ImageTypeWidth, $ImageTypeHeight, $path, array('method'=>$ImageOption));
		return $img;
	}
	
	
	
}

?>
