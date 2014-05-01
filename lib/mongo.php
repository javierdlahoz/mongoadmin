<?php

	class MongoHelper{
		private $username;
		private $password;
		private $port;
		private $db;
		private $host;
        private $con;
        private $verion = "1.0.0";

		function __construct(){
			$params = file_get_contents("lib/connect.json");
            $params = json_decode($params);

            $this->username = $params->{'username'};
			$this->password = $params->{'password'};			
			$this->port = $params->{'port'};
			$this->db = $params->{'db'};
			$this->host = $params->{'host'};
            try{
                $this->con = new Mongo("mongodb://$this->username:$this->password@$this->host:$this->port");
            }
            catch(Exception $ex){
                echo "Error: ".$ex;
                die();
            }
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

        function createDatabase($dbName){
            try{
                $db = $this->getDb($dbName);
                $collection = $db->createCollection("mongoadmin");
                $collection->insert(array("version"=>$this->version));
                return true;
            }
            catch(Exception $ex)
            {
                echo $ex;
                die();
                return false;
            }
        }

        function dropDatabase($dbName){            
            $db = $this->getDb($dbName);
            $result = $db->drop();
            if($result['ok']==1)
                return true;
            else
                return false;
        }

        function getStats($dbName){
            $db = $this->getDb($dbName);
            $result = $db->command(array('dbStats' => 1));
            return $result['raw'];
        }

        function ensureIndex($dbName, $collection, $index){
            $db = $this->getDb($dbName);
            $collection = $db->selectCollection($collection);
            $result = $collection->ensureIndex(array($index => "hashed"));
            return $result;
        }

        function dropCollection($dbName, $collection){
            $db = $this->getDb($dbName);
            $collection = $db->selectCollection($collection);
            try{
                $collection->drop();
                return true;
            }
            catch(Exception $ex){
                echo $ex;
                die();
                return false;
            }
        }

        function shardCollection($dbName, $collectionName, $index){
            $db = $this->con->selectDB('admin');
            $result = $db->command(array('shardCollection'=> $dbName.'.'.$collectionName, 'key' => array($index => 'hashed')));
            return $result;
        }

        function createDocument($dbName, $collectionName, $document){
            $db = $this->getDb($dbName);
            $collection = $db->selectCollection($collectionName);
            try{
                $collection->insert(json_decode($document));
                return true;
            }
            catch(Exception $ex)
            {
                return false;
            }

        }

        function findDocument($dbName, $collectionName, $query){
            $db = $this->getDb($dbName);
            $collection = $db->selectCollection($collectionName);
            $result = $collection->find(json_decode($query))->limit(10);
            return $result;
        }

        function deleteDocument($dbName, $collectionName, $documentId){
            $db = $this->getDb($dbName);
            $collection = $db->selectCollection($collectionName);         
            $result = $collection->remove(array('_id' => new MongoId($documentId)));            
            return $result;
        }

        function getConnectionData(){
            $dataArray = array(
                    "host" => $this->host,
                    "username" => $this->username,
                    "password" => $this->password,
                    "port" => $this->port
                );
            return $dataArray; 
        }

        function setConnectionData($data){
            $tmp = $this->getConnectionData();
            $this->host = $data['host'];
            $this->port = $data['port'];
            $this->username = $data['username'];
            $this->password = $data['password'];

            try{
                $this->con = 
                    new Mongo("mongodb://$this->username:$this->password@$this->host:$this->port");
                
                if($this->isMongos()){
                    $jsonArray = array(
                                "username"  => $this->username,
                                "password"  => $this->password,
                                "port"  => $this->port,
                                "db"    => "admin",
                                "host"  => $this->host
                                );
                    $json = json_encode($jsonArray);
                    $fp = fopen("lib/connect.json", 'w');
                    fwrite($fp, $json);
                    fclose($fp);   
                    return true;
                }
                else
                    return false;
            }
            catch(Exception $ex){
                $this->setConnectionData($tmp);
                return false;
            }
        }
	}