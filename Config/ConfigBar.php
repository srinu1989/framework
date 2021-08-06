<?php
//	error_reporting(0);
class Config {
			protected $servername;
			protected $username;
			protected $password;
			protected $dbname;
			protected $conn;
				public function connect($servername,$username,$password,$dbname) {
					$this->servername 	= 	$servername;
					$this->username 	=	$username;
					$this->password 	=	$password;
					$this->dbname 		=	$dbname;	
							$this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
							if ($this->conn->connect_error) {
									die('connection failed: ' . $this->conn->connect_error);	
							} else {
								return $this->conn;
							}
				}
	}
$myObj = new Config();
?>