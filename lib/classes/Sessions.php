<?php
class Sessions
{
	private $session_id = 1;
	private $session_crew_id = null;
	private $session_id_total = 5;

	public function getSessionIdTotal()
	{
		return $this->session_id_total;
	}
	
	public function getSessionId()
	{
		return $this->session_id;
	}
	
	public function setSessionId() 
	{
		session_start();
		
		if(!isset($_SESSION['session_id']))
		{
			$_SESSION['session_id'] = $this->session_id;
		}
		
		if($_SESSION['session_id'] >= 6)
		{
			$_SESSION['session_id'] = 1;
		}
		$this->session_id = $_SESSION['session_id']++;
	}
	
	public function getSessionCrewTotal()
	{
		return $this->session_crew_id;
	}
	
	public function setSessionCrewTotal($crew_id, $crew_total_points) 
	{
		if(!isset($_SESSION['session_crew_'.$crew_id.'']))
		{
			$_SESSION['session_crew_'.$crew_id.''] = '';
		}
		$_SESSION['session_crew_'.$crew_id.''] += $crew_total_points;
		
		if($this->session_id == 1)
		{
			$_SESSION['session_crew_'.$crew_id.''] = $crew_total_points;
		}

		$this->session_crew_id = $_SESSION['session_crew_'.$crew_id.''];
	}
	
	public function printSessionRoundInfo()
	{
		return 'Round: '.$this->getSessionId().'/'.$this->getSessionIdTotal();
	}
	
	public function isLastSession()
	{
		$content = false;
		
		if($this->getSessionId() == $this->getSessionIdTotal())
		{
			$content = true;
		}
		return $content;
	}
}
?>