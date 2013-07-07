<?php

class BWDataFunction {

	public static function zoomLevelData()
	{
		$ZoomLevel = array("Tablets"=>"Tables","Cozy"=>"Cozy","Comfortable"=>"Comfortable");
		return $ZoomLevel;
	}
	
	public static function timeZoneData()
	{
		$TimeZone = array("0"=>"GMT","+3.5"=>"Abu Dhabi, Tahran");
		return $TimeZone;
	}
	
	public static function languageData()
	{
		$Language = array("en"=>"English");
		return $Language;
	}
	
	public static function userInterfaceData()
	{
		$UserInterface = array("Basic"=>"Basic","Full"=>"Full");
		return $UserInterface;
	}
	
	public static function statusData()
	{
		$StatusData = array("Pending"=>"Pending","Completed"=>"Completed");
		return $StatusData;
	}
	
	public static function getCurrency()
	{
		$currencyData = array("AED"=>"AED","USD"=>"USD","EURO"=>"EURO");
		return $currencyData;
	}
	
	public static function LeadStatusData()
	{
		$StatusData = array("Pending"=>"Pending","In Progress"=>"In Progress","Won & Closed"=>"Won & Closed","Lost & Closed"=>"Lost & Closed");
		return $StatusData;
	}
	
	public static function LeadPriorityData()
	{
		$StatusData = array("Important"=>"Important","Not Important"=>"Not Important");
		return $StatusData;
	}
	
	public static function projectstatusData()
	{
		$StatusData = array("Active"=>"Active","Inactive"=>"Inactive");
		return $StatusData;
		/*,"Completed"=>"Completed","In Progress"=>"In Progress","Active - Discovery"=>"Active - Discovery", "Active- Design"=>"Active- Design", "Active Development"=>"Active Development",  "Active Deployment"=>"Active Deployment"*/
	}
	
	public static function DiscussionstatusData()
	{
		$StatusData = array("Inactive"=>"Inactive","Active"=>"Active","Closed"=>"Closed");
		return $StatusData;
	
	}
	
	public static function TemplateTypeData()
	{
		$StatusData = array("Email"=>"Email");
		return $StatusData;
		/*,"Completed"=>"Completed","In Progress"=>"In Progress","Active - Discovery"=>"Active - Discovery", "Active- Design"=>"Active- Design", "Active Development"=>"Active Development",  "Active Deployment"=>"Active Deployment"*/
	}
	
	public static function ProjectTypeData()
	{
		$ProjectType = array("",'Onetime'=>'Onetime', 'Recurring'=>'Recurring'); 
		return $ProjectType;
	}
	
	public static function TypeData()
	{
		//$ProjectType = array('New Business'=>'New Business', 'Existing Business'=>'Existing Business'); 
		$ProjectType = array('New'=>'New Business', 'Existing'=>'Existing Business');
		return $ProjectType;
	}
	
	
	public static function timesheetstatusData()
	{
		$accountStatus = array('Pending'=>'Pending', 'Approved'=>'Approved', 'Declined'=>'Declined'); 
		return $accountStatus;
	}
	
	
	public static function mime_content_type($filename) {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }
	
	public static function formatbytes($file, $type)  
	{  
		switch($type){  
			case "KB":  
				$filesize = $file * .0009765625; // bytes to KB  
			break;  
			
		}  
		if($filesize <= 0){  
			return $filesize = 'unknown file size';}  
		else{return round($filesize, 2).' '.$type;}  
	}  
	
	public static function get_file_extension($file_name) {
		return end(explode('.',$file_name));
	}
	
	public static function getConvertMinutes2Hours($Minutes)
	{
		if ($Minutes < 0)
		{
			$Min = Abs($Minutes);
		}
		else
		{
			$Min = $Minutes;
		}
		$iHours = Floor($Min / 60);
		$Minutes = ($Min - ($iHours * 60)) / 100;
		$tHours = $iHours + $Minutes;
		if ($Minutes < 0)
		{
			$tHours = $tHours * (-1);
		}
		$aHours = explode(".", $tHours);
		$iHours = $aHours[0];
		
		$xplode = explode(".",$Minutes);
		if($xplode[0]<1 && $xplode[1]>1)
		{
		if($xplode[1] == "3")
		{
			$mints = sprintf("%2d0",$xplode[1]);
		}else{
			$mints = $xplode[1];
		}
			$reHours = $iHours ." hr ". $mints." min";
		}else{
			$mints = $Minutes;
			$reHours = $iHours ." hr ";		
		}
		//$reHours = $iHours ." hr ". $mints." min";
		
		return $reHours;
	}
	
	
	public static function getEstimatedHours($Minutes)
	{
		if ($Minutes < 0)
		{
			$Min = Abs($Minutes);
		}
		else
		{
			$Min = $Minutes;
		}
		$iHours = Floor($Min / 60);
		$Minutes = ($Min - ($iHours * 60)) / 100;
		$tHours = $iHours + $Minutes;
		if ($Minutes < 0)
		{
			$tHours = $tHours * (-1);
		}
		$aHours = explode(".", $tHours);
		$iHours = $aHours[0];
		
		$xplode = explode(".",$Minutes);
		if($xplode[0]<1 && $xplode[1]>1)
		{
		if($xplode[1] == "3")
		{
			$mints = sprintf("%2d0",$xplode[1]);
		}else{
			$mints = $xplode[1];
		}
			$reHours = $iHours; // ." hr ". $mints." min";
		}else{
			$mints = $Minutes;
			$reHours = $iHours; // ." hr ";		
		}
		//$reHours = $iHours ." hr ". $mints." min";
		
		return $reHours;
	}
	
	public static function ConvertMinutes2Hours($Minutes)
	{
		if ($Minutes < 0)
		{
			$Min = Abs($Minutes);
		}
		else
		{
			$Min = $Minutes;
		}
		$iHours = Floor($Min / 60);
		$Minutes = ($Min - ($iHours * 60)) / 100;
		$tHours = $iHours + $Minutes;
		if ($Minutes < 0)
		{
			$tHours = $tHours * (-1);
		}
		$aHours = explode(".", $tHours);
		$iHours = $aHours[0];
		if (empty($aHours[1]))
		{
			$aHours[1] = "00";
		}
		$Minutes = $aHours[1];
		if (strlen($Minutes) < 2)
		{
			$Minutes = $Minutes ."0";
		}
		$timearray = array();
		if($iHours>0)
		{
			$timearray['hours'] =  $iHours ." hr ";
		}
		if($Minutes>0)
		{
			$timearray['minutes'] =  $Minutes ." min ";
		}
		$tHours = $iHours ." hr ". $Minutes." min";
		return $timearray;
	}
	
	public static function getTimespentDropdownvalues()
	{
		$timearray = array();
		for($i=0; $i<=600; $i+=15)
		{
			$array = BWDataFunction::ConvertMinutes2Hours($i);
			if(strlen($array['hours'])>0 && strlen($array['minutes'])<1)
			{
				$timearray[$i] = $array['hours'];
			}
			
			if(strlen($array['hours'])<1 && strlen($array['minutes'])>0)
			{
				$timearray[$i] = $array['minutes'];
			}
			
			
			if(strlen($array['hours'])>0 && strlen($array['minutes'])>0)
			{
				$timearray[$i] = $array['hours']." ".$array['minutes'];
			}
			
		}
		
		return $timearray;
	
	}
	
	public static function ConvertHours2Minutes($mins) { 
     
            $minutes = ($mins * 60); 

            return $minutes; 
    }
	
	public static function getIconClass($tablename)
	{
		$array = array("TblToDoNotes"=>"todosIcon","TblDocuments"=>"filesIcon","TblProjectAssignees"=>"smallUserIcon","TblSysAuthItem"=>"groupIcon","TblNotes"=>"notesIcon","TblNotes"=>"notesIcon","TblProjects"=>"labelIcon");
		
		return $array[$tablename];
	}
	
	
	public static function getActionForNotifications()
	{
		$array = array("AddProject"=>"Project Added","EditProject"=>"Project Edited","DeleteProject"=>"Project Deleted","AssignProject"=>"Project Assigned","FileUpload"=>"File Uploaded","AddTask"=>"Task Added","EditTask"=>"Task Edited","DeleteTask"=>"Task Deleted","AddNotes"=>"Add Notes","EditNotes"=>"Notes Edited","DeleteNotes"=>"Notes Deleted","AddTimesheet"=>"Timesheet Added","EditTimesheet"=>"Timesheet Edited","DeleteTimesheet"=>"Timesheet Deleted");
		
		return $array;
	}
	
	public static function getResponsesForNotifications()
	{
		$array = array("EmailRegisteredClient"=>"Email Registered Client",
		"EmailAssignedTo"=>"Email Assigned To","EmailProjectManager"=>"Email Project Manager","EmailAdministrators"=>"Email Administrators","EmailRegisteredUser"=>"Email Registered User");
		
		return $array;
	}
	
	
	public static function getMergeFields()
	{
		$array = array("UserId"=>"{$userid}","UserName"=>"{$username}","Name"=>"{$name}","useremail"=>"{$useremail}","ProjectId"=>"{$projectid}","Projectname"=>"{$projectname}","signature"=>"{$signature}");
		
		return $array;
	}
	
	
	public static function ProposalValidFor()
	{
		$array = array("1"=>"1 Days","2"=>"2 Days","3"=>"3 Days","4"=>"4 Days","5"=>"5 Days","6"=>"6 Days","7"=>"7 Days","15"=>"15 Days","20"=>"20 Days","25"=>"25 Days","30"=>"30 Days");
		return $array;
	}
	
	public static function file_extension($fn){
		$str=explode('/',$fn);
		$len=count($str);
		$str2=explode('.',$str[($len-1)]);
		$len2=count($str2);
		$ext=$str2[($len2-1)];
		return $ext;
	}
	
	public static function getRssNewsLinks()
	{
		$array = array("World"=>"https://news.google.com/news/feeds?pz=1&cf=all&ned=in&hl=en&topic=w&output=rss","UAE"=>"https://news.google.com/news/feeds?pz=1&cf=all&ned=in&hl=en&geo=Uae&output=rss","India"=>"https://news.google.com/news/feeds?pz=1&cf=all&ned=in&hl=en&geo=India&output=rss");
		return $array;
	}
	
	
	public static function getFormElements()
	{
		$fieldArray = array('text' => 'Text Box', 'textArea'=>'Text Area', 'datePicker'=>'Date Time Picker', 'dropdown'=>'Drop Down', 'tickbox'=>'Tick Box',); 
		//'password' => 'Password', 'dropdown'=>'Drop Down', 'tickbox'=>'Tick Box',
		//array("textField"=>"Text Box","textArea"=>"Text Area","calender"=>"Calender",);
		return $fieldArray;
	}	
	
	public static function getSearchDefaultText($controller)
	{
		$array = array("members/dashboard"=>"Search for anything, anytime! ...","members/collaboration/filemanager"=>"Search for files","members/collaboration/discussions"=>"Search for discussions","members/todos"=>"Search for tasks","members/collaboration/meetings"=>"Search for meetings","members/collaboration/knowledgeBase"=>"Search for knowledge","members/collaboration/peoples"=>"Search for peoples","members/projects"=>"Search for projects","members/documents"=>"Search for files","members/notes"=>"Search for notes","members/timeSheet"=>"Search for timesheet","members/reports"=>"Search for reports","members/enquiries/leads"=>"Search for leads");
		
		if(strlen($array[$controller])>0){
		
			return $array[$controller];
		}else{
			return "Search for anything, anytime! ...";
		}
		
		
	}
	
	public static function getProductsTerm()
	{
		$fieldArray = array('Monthly' => 'Monthly', 'Quarterly'=>'Quarterly', 'Yearly'=>'Yearly',); 
		
		return $fieldArray;
	}	
	
	public static function getReportsFor()
	{	
		$Array = array();
		
		if($_GET['type']=='Projects')
		{
			if(Yii::app()->user->checkAccess('viewProjects')){
				$Array['Projects'] = 'Projects'; //array('Projects' => 'Projects', 'Timesheet'=>'Timesheet','leads'=>'Leads'); 
			}
			$Array['Timesheet'] = 'Timesheet';
		}
		
		
		if($_GET['type']=='leads')
		{
			//if(Yii::app()->user->checkAccess('viewLeads')){
				$Array['leads'] = 'leads';
		//	}
			//$Array['Timesheet'] = 'Timesheet';
		}
		
		if($_GET['type']=='Careers')
		{
			//if(Yii::app()->user->checkAccess('viewLeads')){
			$Array['Careers'] = 'Careers';
			//	}
			//$Array['Timesheet'] = 'Timesheet';
		}
		
		return $Array;
	}	
	
	public static function getReportsTimesheetEstimateHours()
	{
		$Array = array('' => 'Any', '<=20'=>'Less than 20 hrs','20-80'=>'Between 20 and 80 hrs', '80-150'=>'Between 80 and 150 hrs', '>150'=>'More than 150 hrs'); 
		
		return $Array;
	}	
	
	public static function humanTiming ($time)
	{
		$timeDiff = time() - $time; // to get the time since that moment
		$tokens = array (31536000 => 'year back',2592000 => 'month back',604800 => 'week back',86400 => 'day back',3600 => 'hour ago',60 => 'minute ago',1 => 'second ago');
	
		foreach ($tokens as $unit => $text) 
		{
			
			if ($timeDiff < $unit) continue; 
			$numberOfUnits = floor($timeDiff / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'':'');
		}
	
	}
	
	
	public static function getImageExtentionsArray()
	{
		$array = array("JPG","GIF","PNG","JPEG");
		return $array;
	}
	
	public static function getSectionNameFromCtype($ctype)
	{
		if($ctype=='leads'){$gtype="/sales";}
		else if($ctype=='Projects'){$gtype="/projects";}
		else if($ctype=='Careers'){$gtype="/careers-admin";}
		else if($ctype=='Events'){ $gtype="/events-admin"; }
		return $gtype;
	}
	
	public static function getSectionMenuFromCtype($ctype)
	{
		if($ctype=='Projects' || $ctype=='Timesheet'){ return $this->renderpartial('projects.views._projectmenu'); }
		else if($ctype=='leads'){ return $this->renderpartial('sales.views._salescommon');}
		else if($ctype=='Careers'){ return $this->renderpartial('careers-admin.views._recruitmentmenu');}
		else if($ctype=='clubs'){ return $this->renderpartial('events-admin.views._eventmenu');}
		else { return $this->renderpartial('intranet.views._collaborationmenu'); } 
		
	}
	
	public static function getDashletConditions($dashid, $type)
	{
		$usercondition = array();
		$usrcriteria = new CDbCriteria();
		$usrcriteria->select = "RecordLimit, DashboardDivClass";
		$usrcriteria->condition = 'CType="'.$type.'" and DashId="'.$dashid.'" and UserId='.Yii::app()->user->Id;
		$usercondition = TblUserDashletConditions::model()->find($usrcriteria);
		//if(count($usercondition)>0){
			$recordlimit=5;
			return $usercondition;
		//} 
				
	}
	
	public static function bwgetAssignees($id , $ctype)
	{
		$userarray = array();
		$criteria = new CDbCriteria();
		$criteria->condition = 'CType="' . $ctype . '" and IsDelete=0 and RecordId=' . $id;
		$model = TblAssignees::model()->findAll( $criteria );
		if (count( $model ) > 0)
		{
			foreach ( $model as $key => $val )
			{
				//$userarray[$val['PAId']] = $val['UserId'];
				$userarray['Users'][$val['PAId']] = $val['UserId'];
				$userarray['Groups'][$val['PAId']] = $val['GroupId'];
			}
		}
		return $userarray;
	}
	
	public static function getWallPostFromCtype($ctype,$limit=25)
	{
		$userarray = array();
		$criteria = new CDbCriteria();
		$criteria->condition = 'CType="' . $ctype . '" and MId='.Yii::app()->user->MId;
		$criteria->limit = $limit;
		$model = TblCollWall::model()->findAll( $criteria );
		return $model;
	}
}

?>