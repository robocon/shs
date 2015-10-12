<?php
/**
 * 
 */
class Model	
{
	
	private $db = null;
	private static $connect = null;
	private $item = null;
	private $items = array();
	private $rows = 0;
	
	function __construct(){
		global $config;
		
		if( $this->db === null ){
			$this->db = mysql_connect($config['db_host'], $config['db_username'], $config['db_password']) or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");
			mysql_select_db($config['db_name'], $this->db) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");
			
			// If run on outside main server
			if( $_SERVER['SERVER_ADDR'] !== '192.168.1.2' ){
				mysql_query("SET NAMES TIS620", $this->db);
			}
		}
		
		return $this->db;
	}
	
	public function select($sql, $items = null){
		
		if( !empty($items) ){
			foreach($items as $key => &$item){
				$item = mysql_real_escape_string($item);
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
