<?php
class Battle 
{
	private $points;
	private $actions;
	private $actions_type_id;
	private $operations;
	private $operations_points;
	
	public function getPoints()
	{
		return $this->points;
	}
	
	public function setPoints($type_id)
	{
		$coll = new Collections();
		$rank_types_arr = $coll->rankTypes();
		
		$content = $rank_types_arr[$type_id];
		
		$content_2 = null;
		foreach($content as $k=>$n)
		{
			$content_2 = $n;
		}
		
		$this->points = $content_2;
	}
	
	public function getTacticsPoints($tactics_name)
	{
		$coll = new Collections();
		$tactics_types_arr = $coll->tacticsTypes();
		
		$content = $tactics_types_arr;
		
		$content_2 = null;
		$content_3 = null;
		foreach($content as $k=>$n)
		{
			$content_2 = $n;
			foreach($content_2 as $k2=>$n2)
			{
				if($k2 == $tactics_name)
				{
					$content_3 = $n2;
				}
			}
		}
		
		$this->points = $content_3;
		
		return $this->points;
	}
	
	public function getActions()
	{
		return $this->actions;
	}
	
	public function setActions($type_id = false)
	{
		$coll = new Collections();
		$actions_types_arr = $coll->actionsTypes();
		
		$content = 0;
		if( (is_numeric($type_id)) && ($type_id <= (sizeof($actions_types_arr)-1) ) )
		{
			$content = $actions_types_arr[$type_id];
			
			$this->actions_type_id = $type_id;
		}
		else 
		{
			$index = mt_rand(0, (sizeof($actions_types_arr)-1) );
			$content = $actions_types_arr[$index];
			
			$this->actions_type_id = $index;
		}
		
		$content_2 = null;
		foreach($content as $k=>$n)
		{
			$content_2 = $n;
		}
		
		$this->actions = $content_2;
	}
	
	public function getOperation($name=false)
	{
		if($name == 1)
		{
			return $this->operations_points;
		}
		else 
		{
			return $this->operations;
		}
	}
	
	public function setOperation($type_id = false)
	{
		$operations = null;
		$operations_points = null;
		
		if($this->getActions() == 'white_flag')
		{
			$operations = $this->getActions();
			$operations_points = 0;
		}
		else 
		{
			$coll = new Collections();
			if($this->getActions() == 'attack')
			{
				$actions_types_arr = $coll->attackTypes();
			}
			else if($this->getActions() == 'defend') 
			{
				$actions_types_arr = $coll->defendTypes();
			}
			
			$content = 0;
			if( (is_numeric($type_id)) && ($type_id <= (sizeof($actions_types_arr)-1) ) )
			{
				$content = $actions_types_arr[$type_id];
				
				$this->actions_type_id = $type_id;
			}
			else 
			{
				$index = mt_rand(0, (sizeof($actions_types_arr)-1) );
				$content = $actions_types_arr[$index];
				
				$this->actions_type_id = $index;
			}
			
			foreach($content as $k=>$n)
			{
				$operations = $k;
				$operations_points = $n;
			}
		}
		
		$this->operations = $operations;
		$this->operations_points = $operations_points;
		
	}
}
?>