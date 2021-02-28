<?php

class Dbc{
	
	private $host = 'localhost';
	private $user = 'root';
	private $pwd = '';
	private $dbname = 'db_project_system';
	
	protected function connect(){
		$conn = new mysqli($this->host, $this->user, $this->pwd, $this->dbname);
		return $conn;
	}
}