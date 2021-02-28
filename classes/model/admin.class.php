<?php

class Login extends Dbc{
	public function login(){
		$sql = "SELECT * FROM admin WHERE user_name='$uname' AND password='$pass'";
		$stmt = $this->connect()->prepare($sql);
		$results = $stmt->execute();
		return $results;
	}
}