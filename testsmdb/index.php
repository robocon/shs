<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=smdb', 'root', '1234');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

/**
*
*/
class Test_Runno
{
	private $db = null;
	private $hn = null;
	function __construct($hn = null)
	{
		global $dbh;
		$this->db = $dbh;
		$this->hn = $hn;
		
		$this->init();
	}
	
	public function init(){
		// Insert
		$this->set_new_opday();
	}
	
	public function set_new_opday(){
		
	}
	
	public function get_run_number(){
		$stmt = $this->db->prepare("SELECT * FROM `runno` WHERE `title` = 'kew'");
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function set_run_number($number){
		$stmt = $this->db->prepare("UPDATE `runno` SET `runno` = '$number' WHERE `title` = 'kew';");
		$stmt->execute();
	}
	
	public function get_user_number(){
		$hn = $this->hn;
		$stmt = $this->db->prepare("SELECT * FROM `opday` WHERE `thdatehn` = '$hn'");
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function get_last_user_number(){
		$sql = "
		SELECT `kew`
		FROM `opday`
		WHERE `kew` LIKE 'Q_%'
		ORDER BY `row_id` DESC 
		LIMIT 1
		";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function set_user_number(){
		$run = $this->get_run_number();
		$run_number = intval($run['runno']);
		if( $run_number == 0 ){
			$next_run = 1;
			$last_queue = 0;
			
		}else{
			
			$last = $this->get_last_user_number();
			$last_queue = (int) str_replace($run['prefix'], '', $last['kew']);
			$next_run = $last_queue+1;
		}
		
		// var_dump($last_queue);
		// var_dump($next_run);
		
		// Update runno
		$this->set_run_number($next_run);
		
		if( $next_run > $last_queue ){
			
			$queue_txt = $run['prefix'].$next_run;
			
			$hn = $this->hn;
			$stmt = $this->db->prepare("UPDATE `opday` SET `kew` = '$queue_txt' WHERE `thdatehn` = '$hn' ");
			$stmt->execute();
			
			$user = $this->get_user_number();
			var_dump($user['kew']);
		}else{
			$this->set_user_number();
		}
	}
}



$a = new Test_Runno('21-10-255858-2733');
// $b = new Test_Runno('21-10-255858-2085');

$a->set_user_number();
// $b->set_user_number();