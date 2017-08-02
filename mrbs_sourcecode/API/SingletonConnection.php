<?php
include_once "Configuration.php";
class SingletonConnection
{
	private $connection;
	private static $instance= null;
	private function __construct()
	{
	}
	static function get_instance()
    {
		if(SingletonConnection::$instance==null)
            SingletonConnection::$instance = new SingletonConnection();
		return SingletonConnection::$instance;
	}

	function get_connection()
	{
//      global $db_host,$db_login,$db_password,$db_database;
        $db_database = Configuration::getConfiguration();
		if(!$this->connection)
			$this->connection = mysqli_connect($db_database->getDbHost(),$db_database->getDbLogin(),$db_database->getDbPassword(),$db_database->getDbDatabase())
			or die("Connection object not created: ".mysqli_error($this->connection));
		mysqli_query($this->connection,"SET character_set_results = 'utf8', 
		character_set_client = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		return $this->connection;
	}
	
}
