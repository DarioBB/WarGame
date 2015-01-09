<?php
class WarGame 
{
	private $param1;
	private $param2;
	
	public function __construct($param1, $param2)
	{
		$param1 = ($param1 >= 9999) ? 9999 : $param1; // param 1 max number of team members
		$param2 = ($param2 >= 9999) ? 9999 : $param2; // param 2 max number of team members
		$this->setParam1($param1);
		$this->setParam2($param2);
	}
	
	public function getParam1() 
	{
		return $this->param1;
	}
	
	public function setParam1($param1)
	{
		$this->param1 = $param1;
	}
	
	public function getParam2() 
	{
		return $this->param2;
	}
	
	public function setParam2($param2)
	{
		$this->param2 = $param2;
	}
	
	
	public function play_game($show_stats, $show_prize)
	{
		$content = '';
		$next_content = '';
		$game_info = '';
		$game_info_rest = '';
		
		$session = new Sessions();
		$crew = new Crew();
		$ranks = new Ranks();
		$tactics = new Tactics();
		$battle = new Battle();
		
		$session->setSessionId();
		
		$next_label = ($session->isLastSession()) ? 'Start NEW game' : 'Go to next round';
		$next_content .= '<p><a href="'.$_SERVER['REQUEST_URI'].'">'.$next_label.'</a></p>';
		$next_content .= $session->printSessionRoundInfo().'<br />';
		
		$content .= $next_content;
		if($show_stats != 'true')
		{
			$game_info .= $next_content;
		}
		
		//////////// crew 1
		$crew->setCrew($this->getParam1());
		$crew->setMilitaryType();
		$tactics->setTacticsType();
		$battle->setPoints($tactics->getTacticsTypeId());
		$battle->setActions();
		//$content .= $battle->getActions();
		$content .= $crew->crewInfo($crew->getCrewIndex(), $this->getParam1(), $tactics->getTacticsType());
		$battle->setOperation();
		$content .= 'Team decieded to go with operation: '.$battle->getOperation().', points: '.$battle->getOperation(1).'<br />'; // param 1 = print points
		
		$counter = 0;
		for($i = 0; $i < $this->getParam1(); $i++)
		{
			if($i <= 5)
			{
				$ranks->setRankType(5); // we set first few team members to soldiers
			}
			else 
			{
				$ranks->setRankType();
			}
			$battle->setPoints($ranks->getRankTypeId());
			$crew->setStrength();
			$crew->setStrengthName();
			$counter += $battle->getPoints()+$crew->getStrength();
			$person_total_points = $battle->getPoints()+$crew->getStrength();
			$content .= '<br />Assigned ['.($i+1).'] '.$ranks->getRankType().', points: '.$battle->getPoints().', '.$crew->getStrengthName().', strength: '.$crew->getStrength().', Total points: '.$person_total_points.'';
		}
		$total = $counter+$battle->getTacticsPoints($tactics->getTacticsType())+$battle->getOperation(1);
		$content .= '<br />Total: <u>'.$total.'</u>';
		
		$session->setSessionCrewTotal($crew->getCrewIndex(), $total);
		$total_round_count = $session->getSessionCrewTotal();
		$content .= '<br />Total points per rounds count: <strong>'.$total_round_count.'</strong>';
		
		
		//////////// crew 2
		$crew->setCrew($this->getParam2());
		$crew->setMilitaryType();
		$tactics->setTacticsType();
		$battle->setPoints($tactics->getTacticsTypeId());
		$battle->setActions();
		$content .= $crew->crewInfo($crew->getCrewIndex(), $this->getParam1(), $tactics->getTacticsType());
		$battle->setOperation();
		$content .= 'Team decieded to go with operation: '.$battle->getOperation().', points: '.$battle->getOperation(1).'<br />'; // param 1 = print points
		
		$counter_2 = 0;
		for($i = 0; $i < $this->getParam2(); $i++)
		{
			if($i <= 5)
			{
				$ranks->setRankType(5); // we set first few team members to soldiers
			}
			else 
			{
				$ranks->setRankType();
			}
			$battle->setPoints($ranks->getRankTypeId());
			$crew->setStrength();
			$crew->setStrengthName();
			$counter_2 += $battle->getPoints()+$crew->getStrength();
			$person_total_points = $battle->getPoints()+$crew->getStrength();
			$content .= '<br />Assigned ['.($i+1).'] '.$ranks->getRankType().', points: '.$battle->getPoints().', '.$crew->getStrengthName().', strength: '.$crew->getStrength().',  Total points: '.$person_total_points.'';
		}
		$total_2 = $counter_2+$battle->getTacticsPoints($tactics->getTacticsType())+$battle->getOperation(1);
		$content .= '<br />Total: <u>'.$total_2.'</u>';
		
		$session->setSessionCrewTotal($crew->getCrewIndex(), $total_2);
		$total_round_count_2 = $session->getSessionCrewTotal();
		$content .= '<br />Total points per rounds count: <strong>'.$total_round_count_2.'</strong>';
		
		if( $total > $total_2 )
		{
			$status = 'Team 1';
		}
		else if( $total == $total_2 )
		{
			$status = 'no_winner';
			$game_info .= '<h1>It\'s a tie! No winner here!</h2>';
		}
		else 
		{
			$status = 'Team 2';
		}
		
		if( ($total != $total_2) && (!$session->isLastSession()) )
		{
			$game_info .= '<h3>Round ('.$session->getSessionId().') winner is: '.$status.'</h3>';
		}
		
		if($session->isLastSession())
		{
			if( $total_round_count > $total_round_count_2 )
			{
				$status = 'Team 1';
			}
			else if( $total_round_count == $total_round_count_2 )
			{
				$status = 'no_winner';
				$game_info .= '<h1 class="winner_label">It\'s a tie! No winner here!</h2>';
			}
			else 
			{
				$status = 'Team 2';
			}
	
			$game_info .= '<h1 class="winner_label">Game winner is: '.$status.'</h1>';
			$game_info_rest = '<h2>Congrats, here is your <a href="javascript:;" onclick="$(\'#prize_container\').slideToggle();">prize</a></h2>
				<div id="prize_container" style="display:none;"><img src="images/prize'.(mt_rand(1,10)).'.jpg" alt="Prize" /></div>';
		}
		
		
		if($show_stats != 'true')
		{
			$content = '';
		}
		
		if($show_prize == 'true')
		{
			$game_info .= $game_info_rest;
		}
		
		$data['stats'] = $content;
		$data['status'] = $status;
		$data['info'] = $game_info;
		
		return $data;
	}
	
}
?>