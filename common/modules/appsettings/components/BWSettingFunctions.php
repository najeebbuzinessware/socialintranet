<?php

class BWSettingFunctions
{
	
	public function getMonths()
	{
		$month = array("January","February","March","April","May","June","July","August","September","October","November","December");
		return $month;
	}
	
	public function getWeekDays()
	{
		$days = array('Sunday'=>'S','Monday'=>'M','Tuesday'=>'T','Wednesday'=>'W','Thursday'=>'T','Friday'=>'F','Saturday'=>'S');
		return $days;
	}
	
	public function getHours()
	{
		$hoursrange = range(1,24);
		$hours = array();
		foreach($hoursrange as $key=>$val)
		{
			$hours[$val]=$val;
		}
		
		return $hours;
	}
	
	public function getTotHours()
	{
		$tothours = array();
		for($i = 0; $i < 24; $i++)
		{
			for($mins=00; $mins<60; $mins+=15)
			{
				$key = ($i*60)+$mins;
				if($i % 12)
					$tothours[$key] =  $i % 12;
				else
					$tothours[$key] = 12;
				
				$tothours[$key] .= ":".str_pad($mins,2,'0',STR_PAD_LEFT);
				if($i >= 12)
					$tothours[$key] .=" pm";
				else
					$tothours[$key] .= " am";
            }
        }        
        return $tothours;
	}
	
	public function getMinsFromHours($dbtime)
	{
		if($dbtime!='')
		{
			$argdate_from = date("G:i",strtotime($dbtime));
			$argFdate_arr = explode(":",$argdate_from);
			if($argFdate_arr[0]>=12)
				$argFdate = $argFdate_arr[0];
			else
				$argFdate = $argFdate_arr[0]%12;
			$keyF = ($argFdate*60)+$argFdate_arr[1];
		}
		else
		{
			$keyF='';
		}
		
		return $keyF;
	}
	
	public function getTimeHours($arg)
	{
		$tothours = array();
		for($i = 0; $i < 24; $i++)
		{
			for($mins=00; $mins<60; $mins+=15)
			{
				$key = ($i*60)+$mins;
				
				$tothours[$key] =  $i;
				
				$tothours[$key] .= " : ".str_pad($mins,2,'0',STR_PAD_LEFT);
				
				if($key==$arg)
				{
					return($tothours[$key]);
				}
            }
        }
	}
	
	public function getMinutes()
	{		
		$timearray = array();
		for($i=0; $i<=60; $i+=15)
		{
			$timearray[$i] =  $i;
		}
		
		return $timearray;
	}
	
}

?>