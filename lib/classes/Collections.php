<?php
class Collections //methods can be filled from database. These are data collections
{
	public function militaryTypes()
	{
		// format: array(name, points), ...
		$military_types_arr = array(
			array('Army'=>20),
			array('Marine Corps'=>25),
			array('Navy'=>30),
			array('Air Force'=>25),
			array('Coast Guard'=>15)
		);
		
		return $military_types_arr;
	}
	
	public function rankTypes()
	{
		// format: array(name, points), ...
		$soldier_types_arr = array(
			array('General'=>22), 
			array('Brigadier'=>20), 
			array('Lieutenant'=>18), 
			array('Sergeant'=>15), 
			array('Officer'=>12), 
			array('Soldier'=>10)
		);
		
		return $soldier_types_arr;
	}
	
	public function strengthTypes()
	{
		// format: array(name, points), ...
		$strength_types_arr = array(
			array('Weak'=>''), 
			array('Average'=>''), 
			array('Strong'=>'')
		);
		
		return $strength_types_arr;
	}
	
	public function tacticsTypes()
	{
		// format: array(name, points), ...
		$tactics_types_arr = array(
			array('Offensive'=>55), 
			array('Defensive'=>45)
		);
		
		return $tactics_types_arr;
	}
	
	public function actionsTypes()
	{
		// format: array(name, points), ...
		$actions_types_arr = array(
			array('attack'), 
			array('defend'), 
			array('white_flag')
		);
		
		return $actions_types_arr;
	}
	
	public function attackTypes()
	{
		// format: array(name, points), ...
		$attack_types_arr = array(
			array('Blitzkrieg'=>180), 
			array('Carpet bombing'=>190),
			array('Base of fire'=>150),
			array('Frontal assault'=>140),
			array('Vertical envelopment'=>230),
			array('Chemical weapons'=>320),
		);
		
		return $attack_types_arr;
	}
	
	public function defendTypes()
	{
		// format: array(name, points), ...
		$defend_types_arr = array(
			array('Counter attack'=>190), 
			array('Minefields'=>190),
			array('Booby traps'=>100),
			array('Rapid reaction force'=>130),
			array('Hedgehog defence'=>220),
			array('Nuclear assault'=>700),
		);
		
		return $defend_types_arr;
	}
}
?>