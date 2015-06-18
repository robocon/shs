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

require "includes/functions.php";


// include 'connect.inc';
// include 'common.php';
// if(PHP_VERSION_ID >= 50217){
	// include 'connect.inc.php';

// }else{
	
	
	
	// For DB Calss 
	// define('HOST', $ServerName);
	// define('PORT', '3306');
	// define('DB', $DatabaseName);
	// define('USER', $User);
	// define('PASS', $Password);
// }



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
	
	public static function exec($sql){
		
		if($sql === null){
			echo 'STATEMENT IS NULL';
			exit;
		}
		
		$db = self::init();
		$result = $db->run_exec($sql);
		return $result;
	}
	
	private function run_exec($sql){
		try {
			$query = $this->db->exec($sql);
		} catch(PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $query;
	}
}
