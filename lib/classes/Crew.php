<?php
class Crew extends Military implements Characteristics
{
	private $crew_index = 0;
	private $crew_count;
	private $military_type;
	private $strength;
	private $strength_name;
	
	public function getMilitaryType()
	{
		return $this->military_type;
	}
	
	public function setMilitaryType($type_id=false) // define $type_id for non-random value
	{
		$coll = new Collections();
		$military_types_arr = $coll->militaryTypes();
		
		$content = 0;
		if( (is_numeric($type_id)) && ($type_id <= (sizeof($military_types_arr)-1) ) )
		{
			$content = $military_types_arr[$type_id];
		}
		else 
		{
			$index = mt_rand(0, (sizeof($military_types_arr)-1) );
			$content = $military_types_arr[$index];
		}
		
		$content_2 = null;
		foreach($content as $k=>$n)
		{
			$content_2 = $k;
		}
		
		$this->military_type = $content_2;
	}
	
	public function getCrew() 
	{
		return $this->crew_count;
	}
	
	public function setCrew($crew_count)
	{
		$this->setCrewIndex();
		$this->crew_count = $crew_count;
	}
	
	public function getCrewIndex() 
	{
		return $this->crew_index;
	}
	
	public function setCrewIndex()
	{
		$this->crew_index++;
	}
	
	public function crewInfo($index, $crew_count, $tactics=false)
	{
		$br_dod = ($index > 1) ? "<br /><br />" : "";
		$content = '';
		$content .= $br_dod."Team information: <br />--------<br />
			Team number: ".$index."<br />
			Crew type: ".$this->getMilitaryType();
		if($tactics != false)
		{
			$battle = new Battle();
			$points = $battle->getTacticsPoints($tactics);
			$content .= '<br />Tactics: '.$tactics.', '.$points .' points<br />';
		}
		
		return $content;
	}
	
	public function getStrength()
	{
		return $this->strength;
	}
	
	public function setStrength($strength=false)
	{
		if($strength == false)
		{
			$coll = new Collections();
			$strength_types_arr = $coll->strengthTypes();
			
			$strength = mt_rand(0,(sizeof($strength_types_arr)-1));
		}
		$this->strength = $strength;
	}
	
	public function getStrengthName()
	{
		return $this->strength_name;
	}
	
	public function setStrengthName()
	{
		$coll = new Collections();
		$strength_types_arr = $coll->strengthTypes();
		
		$a = $this->getStrength();
		
		$name = key($strength_types_arr[$a]);
		
		$this->strength_name = $name;
	}
}
?>