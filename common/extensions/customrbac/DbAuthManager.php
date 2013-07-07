<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class DbAuthManager extends CDbAuthManager
{
    	/**
	 * @var string the name of the table storing authorization items. Defaults to 'AuthItem'.
	 */
	public $itemTable='tbl_sys_AuthItem';
	/**
	 * @var string the name of the table storing authorization item hierarchy. Defaults to 'AuthItemChild'.
	 */
	public $itemChildTable='tbl_sys_AuthItemChild';
	/**
	 * @var string the name of the table storing authorization item assignments. Defaults to 'AuthAssignment'.
	 */
	public $assignmentTable='tbl_sys_AuthAssignment';

	public function checkAccess($itemName,$userId,$params=array())
	{ 
		$assignments=$this->getAuthAssignments($userId);
		return $this->checkAccessRecursive($itemName,$userId,$params,$assignments);
	}
	
	public function checkUserAccess($itemName,$userId)
	{
		
		$sql="SELECT * FROM {$this->assignmentTable} WHERE userid=:userid AND MId=:mid";
		$command=$this->db->createCommand($sql);
		$command->bindValue(':userid',$userId);
        $command->bindValue(':mid',Yii::app()->user->MId);
		$assignments=array();
		foreach($command->queryAll($sql) as $row)
		{
			if(($data=@unserialize($row['data']))===false)
				$data=null;
			$assignments[$row['AuthAssignId']]= $row['itemname'];
		}		
		
		if(count($assignments)>0)
		{		
			foreach($assignments as $key=>$val)
			{
				$sql="SELECT * FROM {$this->itemTable} WHERE child=:child AND parent=:parent AND MId=:mid";
				$command=$this->db->createCommand($sql);
				$command->bindValue(':child',$itemName);
				$command->bindValue(':parent',$val);
				$command->bindValue(':mid',Yii::app()->user->MId);
				$row = $command->queryAll($sql);
				if(count($row)>0){
					return true;
				}
			}
		}
	}


	protected function checkAccessRecursive($itemName,$userId,$params,$assignments)
	{
		if(($item=$this->getAuthItem($itemName))===null)
			return false;
		Yii::trace('Checking permission "'.$item->getName().'"','system.web.auth.CDbAuthManager');
		if($this->executeBizRule($item->getBizRule(),$params,$item->getData()))
		{
			if(in_array($itemName,$this->defaultRoles))
				return true;
			if(isset($assignments[$itemName]))
			{
				$assignment=$assignments[$itemName];
				if($this->executeBizRule($assignment->getBizRule(),$params,$assignment->getData()))
					return true;
			}
			$sql="SELECT parent FROM {$this->itemChildTable} WHERE child=:name AND MId=".Yii::app()->user->MId;
			foreach($this->db->createCommand($sql)->bindValue(':name',$itemName)->queryColumn() as $parent)
			{
				if($this->checkAccessRecursive($parent,$userId,$params,$assignments))
					return true;
			}
		}
		return false;
	}

	public function getAuthAssignments($userId)
	{
		$sql="SELECT * FROM {$this->assignmentTable} WHERE userid=:userid AND MId=:mid";
		$command=$this->db->createCommand($sql);
		$command->bindValue(':userid',$userId);
        $command->bindValue(':mid',Yii::app()->user->MId);
		$assignments=array();
		foreach($command->queryAll($sql) as $row)
		{
			if(($data=@unserialize($row['data']))===false)
				$data=null;
			$assignments[$row['itemname']]=new CAuthAssignment($this,$row['itemname'],$row['userid'],$row['bizrule'],$data);
		}
		return $assignments;
	}

	public function getAuthItem($name)
	{ 
		$sql="SELECT * FROM {$this->itemTable} WHERE name=:name AND MId=:mid";
		$command=$this->db->createCommand($sql);
		$command->bindValue(':name',$name);
        $command->bindValue(':mid',Yii::app()->user->MId);
		if(($row=$command->queryRow())!==false)
		{
			if(($data=@unserialize($row['data']))===false)
				$data=null;
			return new CAuthItem($this,$row['name'],$row['type'],$row['description'],$row['bizrule'],$data);
		}
		else
			return null;
	}
	
	public function rbaccheckAuth($task = null)
	{
		if ($task == null)
			return true;
		if (Yii::app()->user->checkAccess( $task ))
		{
			return true;
		} else
		{
			throw new CHttpException( 404, 'The specified action cannot be found or not allowed to access.' );
		}
	}	
}
?>
