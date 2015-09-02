<?php 
// Set about php.ini
error_reporting(1);
ini_set('display_errors', 1);

session_start();

if(!defined('NEW_SITE')){
	header('Content-Type: text/html; charset=tis-620');
	require_once 'includes/connect.php';
	
}else{
	
	header('Content-Type: text/html; charset=utf-8');
	$Conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
	mysql_select_db('smdb', $Conn) or die( mysql_error() );
	mysql_query("SET NAMES UTF8", $Conn);
}

define('HOST', 'localhost');
define('PORT', '3306');
define('DB', 'smdb');
define('USER', 'root');
define('PASS', '1234');

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
	
	/**
	 * !!!! CUTION !!!!
	 * for windows (mysql version 14.12 Distrib 5.0.51b) using TIS620
	 * for linux (Ver 14.12 Distrib 5.0.77) using TIS-620
	 */
	private static $set_names = 'TIS620';
	
	public function __construct(){
		try{
			$this->db = new PDO('mysql:host='.HOST.';port='.PORT.';dbname='.DB, USER, PASS);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$names = self::$set_names;
			$this->db->exec("SET NAMES $names ;");

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
			return $result;
			
		} catch(exception $e) {
			
			// Keep error into log file
			$this->set_log();
			$result = false;
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
			$this->set_log();
			return false;
			
		}
	}
	
	private function set_log(){
		$data = array(
			'date' => '['.date('Y-m-d H:i:s').'] ',
			'request' => $_SERVER['REQUEST_URI'].' - ',
			'msg' => $e->getMessage()."\n"
		);
		
		file_put_contents('logs/mysql-errors.log', $data, FILE_APPEND);
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
	
	function __construct(){
			
		$this->db = mysql_connect(HOST, USER, PASS) or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");
		mysql_select_db(DB, $this->db) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");
		
		// mysql_query("SET NAMES TIS620", $this->db);

	}
	
	public static function load(){
		
		if (self::$connect === null) {
			self::$connect = new self();
		}
		
		return self::$connect;
	}
	
	public function select($sql, $items){
		
		if( !empty($items) ){
			foreach($items as $key => &$item){
				$sql = str_replace($key, "'$item'", $sql);
			}
		}
		
		$query = mysql_query($sql, $this->db);
		$this->rows = mysql_num_rows($query);
		if( $this->rows > 1 ){
			
			while($item = mysql_fetch_assoc($query)){
				$this->items[] = $item;
			}
			
		}else{
			$this->item = mysql_fetch_assoc($query);
		}
	}
	
	public function get_item(){
		return $this->item;
	}
	
	public function get_items(){
		return $this->items;
	}
	
	public function get_rows(){
		return $this->rows;
	}
	
}

// $db = Mysql::load();
// $sql = "SELECT * FROM `opcard` WHERE `hn` LIKE :hn";
// $data = array(':hn' => '58-27%');
// $db->select($sql, $data);
// $item = $db->get_item();


require "includes/functions.php";
