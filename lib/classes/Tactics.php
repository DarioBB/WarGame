<?php
class Tactics
{
	private $tactics_type_id;
	private $tactics_type;

	public function getTacticsTypeId()
	{
		return $this->tactics_type_id;
	}
	
	public function getTacticsType()
	{
		return $this->tactics_type;
	}
	
	public function setTacticsType($type_id=false) // define $type_id for non-random value
	{
		$coll = new Collections();
		$tactics_types_arr = $coll->tacticsTypes();
		$content = 0;
		if( (is_numeric($type_id)) && ($type_id <= (sizeof($tactics_types_arr)-1) ) )
		{
			$content = $tactics_types_arr[$type_id];
			
			$this->tactics_type_id = $type_id;
		}
		else 
		{
			$index = mt_rand(0, (sizeof($tactics_types_arr)-1) );
			$content = $tactics_types_arr[$index];
			
			$this->tactics_type_id = $index;
		}
		
		$content_2 = null;
		foreach($content as $k=>$n)
		{
			$content_2 = $k;
		}
		
		$this->tactics_type = $content_2;
	}
}
?>