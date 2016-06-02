<?php 
// Set about php.ini
error_reporting(1);
ini_set('display_errors', 1);
session_start();

include 'includes/config.php';

// ถ้าไม่มีการประกาศ NEW_SITE ให้โหลดคอนฟิกตัวเดิมมาใช้งาน
if(!defined('NEW_SITE')){
	
	if( $_SERVER['SERVER_ADDR'] !== '192.168.1.2' ){
		// header('Content-Type: text/html; charset=tis-620');
	}
	
	include 'includes/connect.php';
	
}else{
	
	header('Content-Type: text/html; charset=utf-8');
	$Conn = mysql_connect(HOST, USER, PASS) or die( mysql_error() );
	mysql_select_db(DB, $Conn) or die( mysql_error() );
	mysql_query("SET NAMES UTF8", $Conn);
}

/**
 * HOW TO USED
 *
 * // Connect DB
 * DB::load(); // Default is connect with tis620 encoding
 * DB::load('utf8'); // Connect with utf8 encoding
 * 
 * // Query for SELECT
 * $items = DB::select('MYSQL_STATEMENT');
 * foreach($items as $key => $item){ echo $item; } // Loop for display
 * 
 * Example SELECT.
 * $id = 1234;
 * $item = DB::select("SELECT * FROM `user` WHERE `id` = :id", array(':id' => $id));
 *
 * // Query for UPDATE AND DELETE
 * DB::exec('MYSQL_STATEMENT');
 * 
 * Example UPDATE.
 * $name = 'test';
 * $id = 1234;
 * $exe = DB::exec("UPDATE `user` SET `name` = :name WHERE `id` = :id", array(':name' => $name, ':id' => $id));
 */
class DB{
	
	private static $connect = null;
	private $db = null;
	private static $lastId = 0;
	private static $rows = 0;
	
	
	
	/**
	 * !!!! CUTION !!!!
	 * for windows (mysql version 14.12 Distrib 5.0.51b) using TIS620
	 * for linux (Ver 14.12 Distrib 5.0.77) using TIS-620
	 */
	private static $set_names = 'TIS620';
	
	public static $host = null;
	public static $port = null;
	public static $dbname = null;
	public static $user = null;
	public static $pass = null;
	
	public function __construct(){
		try{
			$this->db = new PDO('mysql:host='.HOST.';port='.PORT.';dbname='.DB, USER, PASS);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$names = self::$set_names;
			
			if( $_SERVER['SERVER_ADDR'] !== '192.168.1.2' ){
				// $this->db->exec("SET NAMES $names ;");
			}

		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}
	
	/**
	 * NOT COMPLETE FUNCTION
	 */
	public static function load($names = null){
		
		if($names !== null){
			self::$set_names = $names;
		}
		
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
	
	public static function select($sql = null, $data = array(), $single = false){
		if($sql === null){
			echo 'STATEMENT IS NULL';
			exit;
		}
		

		$db = self::init();
		$result = $db->run($sql, $data);
		
		if($single !== false){
			return $result['0'];
		}
		
		return $result;
	}
	
	private function run($sql, $data){
		
		try {
			
			$sth = $this->db->prepare($sql);
			foreach($data as $key => &$value){
				$sth->bindValue( $key, $value);
			}
			
			// Exec prepareing
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			self::$rows = count($result);
			return $result;
			
		} catch(exception $e) {
			
			// Keep error into log file
			$log_id = $this->set_log($e);
			$msg = array('error' => $e->getMessage(), 'id' => $log_id);
			return $msg;
		}
	}
	
	/**
	 * This function is calling after run() or exec()
	 */
	public static function rows(){
		return self::$rows;
	}
	
	public static function numRows($sql, $data){
		$db = self::init();
		$db->run($sql, $data); // @important execRows not work in PHP 5.1.x but the other version work well
		$result = self::$rows;
		return $result;
	}
	
	private function execRows($sql, $data){
		try {
			
			$sth = $this->db->prepare($sql);
			foreach($data as $key => &$value){
				$sth->bindValue( $key, $value);
			}
			
			// Exec prepareing
			$sth->execute();
			$count = $sth->rowCount();
			return $count;
			
		} catch(exception $e) {
			// Keep error into log file
			$log_id = $this->set_log($e);
			$msg = array('error' => $e->getMessage(), 'id' => $log_id);
			return $msg;
		}
	}
	
	public static function exec($sql, $data = null){
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
				self::$lastId = $this->db->lastInsertId();
			}
			return $query;
			
		} catch(Exception  $e) {

			// Keep error into log file
			$log_id = $this->set_log($e);
			$msg = array('error' => $e->getMessage(), 'id' => $log_id);
			return $msg;
			
		}
	}
	
	private function set_log($e){
		$id = uniqid();
		$data = array(
			'id' => $id.' ',
			'date' => '['.date('Y-m-d H:i:s').'] ',
			'request' => $_SERVER['REQUEST_URI'].' - ',
			'msg' => $e->getMessage()."\n"
		);
		
		file_put_contents('logs/mysql-errors.log', $data, FILE_APPEND);
		return $id;
	}
	
	public static function get_lastId(){
		return self::$lastId;
	}
}

/**
 * 
 */
class Mysql
{
	private $db = null;
	private static $connect = null;
	private $item = null;
	private $items = array();
	private $rows = 0;
	private $lastId = 0;
	
	function __construct(){
			
		// $this->db = mysql_connect(HOST, USER, PASS) or die ( mysql_error() );
		// mysql_select_db(DB, $this->db) or die ( mysql_error() );
		
		// if( $_SERVER['SERVER_ADDR'] !== '192.168.1.2' ){
		// 	mysql_query("SET NAMES TIS620", $this->db);
		// }
		
		try{
			$this->db = new PDO('mysql:host='.HOST.';port='.PORT.';dbname='.DB, USER, PASS);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// $names = self::$set_names;
			
			// if( $_SERVER['SERVER_ADDR'] !== '192.168.1.2' ){
			// 	// $this->db->exec("SET NAMES $names ;");
			// }

		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
		
	}
	
	public static function load(){
		
		if (self::$connect === null) {
			self::$connect = new self();
		}
		
		return self::$connect;
	}
	
	public function select($sql, $data = NULL){
		
		try {
			
			// $sth = $this->db->prepare($sql);
			
			// if( !is_null($data) ){
			// 	foreach($data as $key => &$value){
			// 		$sth->bindValue( $key, $value);
			// 	}
			// }
			
			// // Exec prepareing
			// $sth->execute();
			
			$sth = $this->prepare($sql, $data);
			
			$this->items = $sth->fetchAll(PDO::FETCH_ASSOC);
			// self::$rows = count($result);
			// $this->items = $result;
			return true;
			
		} catch(exception $e) {
			
			// Keep error into log file
			$log_id = $this->set_log($e);
			$msg = array('error' => $e->getMessage(), 'id' => $log_id);
			return $msg;
		}
		
	}
	
	public function get_item(){
		return $this->items['0'];
	}
	
	public function get_items(){
		return $this->items;
	}
	
	public function get_rows(){
		return $this->rows;
	}
	
	public function insert($sql, $data = NULL ){
		try {
			
			// $sth = $this->db->prepare($sql);
			
			// if( !is_null($data) ){
			// 	foreach($data as $key => &$value){
			// 		$sth->bindValue( $key, $value);
			// 	}
			// }
			
			// $query = $sth->execute();
			$this->prepare($sql, $data);
			
			$this->lastId = $this->db->lastInsertId();
			return true;
			
		} catch(Exception  $e) {

			// Keep error into log file
			$log_id = $this->set_log($e);
			$msg = array('error' => $e->getMessage(), 'id' => $log_id);
			return $msg;
			
		}
	}
	
	public function get_last_id(){
		return $this->lastId;
	}
	
	public function prepare($sql, $data){
		
		$sth = $this->db->prepare($sql);
			
		if( !is_null($data) ){
			foreach($data as $key => &$value){
				$sth->bindValue( $key, $value);
			}
		}
		
		$sth->execute();
		return $sth;
		
	}
	
	public function set_log($e){
		$id = uniqid();
		$data = array(
			'id' => $id.' ',
			'date' => '['.date('Y-m-d H:i:s').'] ',
			'request' => $_SERVER['REQUEST_URI'].' - ',
			'msg' => $e->getMessage()."\n"
		);
		
		file_put_contents('logs/mysql-errors.log', $data, FILE_APPEND);
		return $id;
	}
	
}

// $db = Mysql::load();
// $sql = "SELECT * FROM `opcard` WHERE `hn` LIKE :hn";
// $data = array(':hn' => '58-27%');
// $db->select($sql, $data);
// $item = $db->get_item();

// E.g. http://localhost/
define('DOMAIN', ( strtolower(getenv('HTTPS')) == 'on' ? 'https' : 'http' ).'://'.getenv('HTTP_HOST').'/');
define('WEB_REQUEST', substr(getenv('REQUEST_URI'), 1));

// E.g. http://localhost/sub_folder
define('DOMAIN_PATH', DOMAIN.dirname(WEB_REQUEST));

// E.g. http://localhost/sub_folder/file.php
define('DOMAIN_REQUEST', DOMAIN.WEB_REQUEST);

require "includes/functions.php";
