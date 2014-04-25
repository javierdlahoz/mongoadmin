<?php

	class MongoDB{
		private $username;
		private $password;
		private $port;
		private $db;
		private $host;

		function __construct(){
			$params = file_get_contents("connect.json");
			$params = json_decode($params);
			$this->username = $params->{'username'};
			$this->password = $params->{'password'};			
			$this->port = $params->{'port'};
			$this->host = $params->{'host'};
			$this->db = $params->{'db'};
			$this->host = $params->{'host'};
		}




	}