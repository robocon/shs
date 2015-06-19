<?php 
// Set about php.ini
// error_reporting(1);
// ini_set('display_errors', 1);

// header('Content-Type: text/html; charset=tis-620');
session_start();

if(!defined('NEW_SITE')){
	require "connect.php";
}else{
	
	header('Content-Type: text/html; charset=utf-8');
	$Conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
	mysql_select_db('smdb', $Conn) or die( mysql_error() );
	mysql_query("SET NAMES UTF8", $Conn);
	mysql_query("SET character_set_results=utf8");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_connection=utf8");
	
}

define('HOST', 'localhost');
define('PORT', '3306');
define('DB', 'smdb');
define('USER', 'root');
define('PASS', '1234');

class DB{
	
	private static $connect = null;
	private $db = null;
	
	public function __construct(){
		try{
			$this->db = new PDO('mysql:host='.HOST.';port='.PORT.';dbname='.DB, USER, PASS);
			$this->db->exec("set names tis620;");

		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}
	
	/**
	 * NOT COMPLETE FUNCTION
	 */
	public static function load(){
		$db = self::init();
		return $db;
	}
	
	private static function init(){
		if(self::$connect === null){
			self::$connect = new DB();
		}
		
		$db = self::$connect;
		return $db;
	}
	
	public static function select($sql = null, $data = array()){
		if($sql === null){
			echo 'STATEMENT IS NULL';
			exit;
		}
		

		$db = self::init();
		$result = $db->run($sql, $data);
		return $result;
	}
	
	private function run($sql, $data){
		$sth = $this->db->prepare($sql);
		$sth->execute($data);
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($result) === 1){
			return $result['0'];
		}
		
		return $result;
	}
	
	public static function exec($sql, $data = null){
		
		if($sql === null){
			echo 'STATEMENT IS NULL';
			exit;
		}
		
		$db = self::init();
		$result = $db->run_exec($sql, $data);
		return $result;
	}
	
	private function run_exec($sql, $data){
		try {
			if($data === null){
				$query = $this->db->exec($sql);
			}else{
				$sth = $this->db->prepare($sql);
				$query = $sth->execute($data);
			}
			
		} catch(PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $query;
	}
}


require "includes/functions.php";
