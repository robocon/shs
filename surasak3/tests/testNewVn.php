<?php
class TestNewVn extends PHPUnit_Framework_TestCase{
	
	private $db;
	public function setUp(){
		$this->db = mysql_connect("localhost","root","1234");
		mysql_select_db("smdb", $this->db);
		mysql_query("SET NAMES TIS620", $this->db);
	}
	
	/**
	 * เทสในกรณีที่ User คลิกอัพเดท Running Number พร้อมกัน
	 */
	public function testVnSetup(){
		
		// อัพเดท Running Number แบบเก่า
		$this->updateOldVn();
		
		// อัพเดท Running Number แบบใหม่
		$this->updateNewVn();
	}
	
	
	public function updateOldVn(){
		$res1 = $this->plusRunno();
		$res2 = $this->plusRunno();
		
		$update1 = $this->updateRunno($res1);
		$update2 = $this->updateRunno($res2);
		
		$this->assertGreaterThan(1, $update1);
		$this->assertGreaterThan(1, $update2);
		
		$this->resetRunno();
		echo "User1 get VN $update1 and User2 get VN $update2\n";
	}
	
	public function plusRunno(){
		$item = $this->getRunno();
		$runno = (int)$item['runno'];
		$runno++;
		return $runno;
	}
	
	public function getRunno(){
		$sql = "SELECT * FROM `runno` WHERE `title` = 'VN'";
		$item = $this->getQuery($sql);
		return $item;
	}
	
	public function updateRunno($number){
		$sql = "UPDATE `runno` SET `runno` = '$number' WHERE `title` = 'VN';";
		mysql_query($sql, $this->db);
		return $number;
	}
	
	public function resetRunno(){
		$this->updateRunno(1);
	}
	
	public function getQuery($sql){
		$q = mysql_query($sql, $this->db);
		return mysql_fetch_assoc($q);
	}
	
	public function updateNewVn(){
		$res1 = $this->plusRunno();
		$res2 = $this->plusRunno();
		
		$update1 = $this->newUpdateRunno($res1);
		$update2 = $this->newUpdateRunno($res2);
		
		$this->assertGreaterThan(1, $update1);
		$this->assertGreaterThan(1, $update2);
		
		$this->resetRunno();
		echo "User1 get VN $update1 and User2 get VN $update2\n";
	}
	
	public function newUpdateRunno($number){
		
		$item = $this->getRunno();
		$test_runno = (int) $item['runno'];
		
		if( $number > $test_runno ){
			return $this->updateRunno($number);
		}else{
			$number += 1;
			return $this->newUpdateRunno($number);
		}
	}
}