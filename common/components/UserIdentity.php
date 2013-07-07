<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		//Check Again TblRegister AR
		$record = TblSysUsers::model()->findByAttributes(array('Email'=>$this->username,'Password'=>$this->password));
		if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($record->Password != $this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{	
			$Email = $record->Email;
			$this->_id = $record->Userid;
			$this->setState('Name',$record->Name);
			$this->setState('username',$Email);
			$this->setState('MId',$record->MId);
			$this->setState('Userid',$record->Userid);
			$this->setState('ReportTo',$record->ReportTo);
			$this->setState('Preferences',$record->Preferences);
			$this->setState('UserType',$record->UserType);
			$this->errorCode=self::ERROR_NONE;
            //Fetch Master Logo Depending upon MID
			
            $Master = TblMaster::model()->findByPk($record->MId);
			if(strlen($Master->Company)>0)
			{
				$this->setState('BusinessName',$Master->Company);		
			}
            //If Logo field is not Null
		
            if(strlen($Master->FrontendLogo)>0)
            {
              //Check if file exists
              $path = "userData/uploads/";
			 /*var_dump(file_exists($path.$Master->FrontendLogo));
			  exit;*/
			//Yii::app()->params['documentPath'].
			  if(file_exists($path.$Master->FrontendLogo))
              { 
                $this->setState('Logo',$Master->FrontendLogo);
              }else{
			  	 $this->setState('Logo',"");
			  }
            }else{
				$this->setState('Logo',"");
			}
			
		}
		return !$this->errorCode;
	}
	
	public function getId()
	{
		return $this->_id;
	}
}