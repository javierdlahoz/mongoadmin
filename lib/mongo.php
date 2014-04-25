<?php

	class MongoHelper{
		private $username;
		private $password;
		private $port;
		private $db;
		private $host;
        private $con;

		function __construct(){
			$params = file_get_contents("lib/connect.json");
			$params = json_decode($params);
			$this->username = $params->{'username'};
			$this->password = $params->{'password'};			
			$this->port = $params->{'port'};
			$this->db = $params->{'db'};
			$this->host = $params->{'host'};
            $this->con = new Mongo("mongodb://$this->username:$this->password@$this->host:$this->port");
		}

        function getDb($db){
            $db = $this->con->selectDB($db);
            return $db;
        }

        function addShard($hostIP, $shardName = null){
            $db = $this->con->selectDB('admin');
            if(empty($shardName))
                $results = $db->command(array("addShard" => $hostIP ));
            else
                $results = $db->command(array("addShard" => $hostIP, "name" => $shardName));

            return $results;
        }

        function getShards(){
            $db = $this->con->selectDB('admin');
            $results = $db->command(array("listShards" => 1 ));
            return $results['shards'];
        }

        function deleteShard($id){
            $db = $this->con->selectDB('admin');
            $results = $db->command(array("removeShard" => $id ));
            return $results;
        }

        function getDatabases(){
            $db = $this->con->selectDB('config');
            $databases = new MongoCollection($db, 'databases');
            $results = $databases->find();
            $dbArray = array();
            foreach($results as $database){
                if(($database['_id']!="admin")&&($database['_id']!="config")){
                    $database['name'] = $database['_id'];
                    array_push($dbArray, $database);
                }
            }
            return $dbArray;
        }

        function enableSharding($dbName){
            $db = $this->con->selectDB('admin');
            $results = $db->command(array("enableSharding" => $dbName ));
            return $results;
        }

        function isMongos(){
            $db = $this->con->selectDB('admin');
            $results = $db->command(array("isdbgrid" => 1 ));
            if($results['isdbgrid']==1)
                return true;
            else
                return false;
        }

        function getCollections($dbName){
            $db = $this->getDb($dbName);
            $collections = $db->getCollectionNames();
            $collectionsArray = array();
            foreach($collections as $collection){
                if($collection != "system.indexes"){
                    array_push($collectionsArray, $collection);
                }
            }
            return $collectionsArray;
        }
	}