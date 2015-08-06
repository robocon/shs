<?php 
// Set about php.ini
// error_reporting(1);
// ini_set('display_errors', 1);

session_start();

if(!defined('NEW_SITE')){
	header('Content-Type: text/html; charset=tis-620');
	require_once 'connect.php';
	mysql_query("SET NAMES TIS620", $Conn);
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
	private static $set_names = 'TIS620';
	
	public function __construct(){
		try{
			$this->db = new PDO('mysql:host='.HOST.';port='.PORT.';dbname='.DB, USER, PASS);
			$names = self::$set_names;
			$this->db->exec("set names $names;");

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
		$sth = $this->db->prepare($sql);
		
		foreach($data as $key => $value){
			$sth->bindParam( $key, $value);
		}
		
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		// if(count($result) === 1){
		// 	return $result['0'];
		// }
		
		return $result;
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
			}
			
		} catch(PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $query;
	}
}


require "includes/functions.php";
