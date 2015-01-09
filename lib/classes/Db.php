<?php
class Db {
	
	private $db;
	private $connection;
	
	public function __construct()
	{
		$db_host = _DB_HOST;
		$db_user = _DB_USER;
		$db_pass = _DB_PASS;
		$database = _DATABASE;

		$this->connection = mysqli_connect($db_host, $db_user, $db_pass, $database);

		if( $this->connection->connect_errno )
		{
			throw new Exception('Error in db connection: '.$this->connection->connect_error);
		}
			
		mysqli_query($this->connection, 'SET NAMES utf8');
	}
	
	public function __destruct()
	{
		$this->connection->close();
	}
	
	public function getConnection()
	{
		if($this->db == null)
		{
			$this->db = new Db;
		}
		return $this->connection;
	}
}
?>