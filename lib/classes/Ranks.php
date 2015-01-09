<?php
class Ranks
{
	private $rank_type_id;
	private $rank_type;
	
	public function getRankTypeId()
	{
		return $this->rank_type_id;
	}
	
	public function getRankType()
	{
		return $this->rank_type;
	}
	
	public function setRankType($type_id=false) // define $type_id for non-random value
	{
		$coll = new Collections();
		$rank_types_arr = $coll->rankTypes();
		
		$content = 0;
		if( (is_numeric($type_id)) && ($type_id <= (sizeof($rank_types_arr)-1) ) )
		{
			$content = $rank_types_arr[$type_id];
			
			$this->rank_type_id = $type_id;
		}
		else 
		{
			$index = mt_rand(0, (sizeof($rank_types_arr)-1) );
			$content = $rank_types_arr[$index];
			
			$this->rank_type_id = $index;
		}
		
		$content_2 = null;
		foreach($content as $k=>$n)
		{
			$content_2 = $k;
		}
		
		$this->rank_type = $content_2;
	}
}
?>