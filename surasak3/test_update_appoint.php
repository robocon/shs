<?php
include 'includes/connect.php';

$update_lists = array(
	// '47-8711' => array('left' => 3, 'start' => '2558-08-28'),
	// '57-9953' => array('left' => 3, 'start' => '2558-08-28'),
	// '50-10034' => array('left' => 3, 'start' => '2558-08-28'),
	// '50-13132' => array('left' => 3, 'start' => '2558-08-27'),
	// '53-11321' => array('left' => 4, 'start' => '2558-08-29'),
	// '55-5973' => array('left' => 4, 'start' => '2558-08-29'),
	// '48-13582' => array('left' => 4, 'start' => '2558-08-31'),
);

$left_3 = array(7, 14, 30);
$left_4 = array(3, 7, 14, 30);

foreach($update_lists as $hn => $item){
	
	// $sql = "SELECT `idno` FROM `drugrx` 
	// WHERE `hn` = '$hn' 
	// AND `date` like '".$item['start']."%' 
	// AND `drugcode` = '0VERO' 
	// AND `status` = 'Y' LIMIT 1";
	// $result = mysql_query($sql);
	// $user = mysql_fetch_assoc($result);
	// var_dump($hn);
	
	$query = mysql_query("SELECT * FROM `opcard` WHERE `hn` LIKE '$hn'");
	$user = mysql_fetch_assoc($query);
	
	echo "<pre>";
	for($i=0; $i<$item['left']; $i++){
		
		$runno_query = mysql_query("SELECT `runno` FROM `runno` WHERE `title` = 'phardep' LIMIT 1") or die( mysql_error() );
		$fitem = mysql_fetch_assoc($runno_query);
		$runno = $fitem['runno'];
		$runno++;
		
		$update_runno = mysql_query("UPDATE `runno` SET `runno` = '$runno' WHERE `title` = 'phardep' LIMIT 1") or die( mysql_error() );
		
		if( $item['left'] == 3 ){
			$next = $left_3;
			$injno = 'à¢çÁ·Õè '.( 3 + $i);
		}else{
			$next = $left_4;
			$injno = 'à¢çÁ·Õè '.( 2 + $i);
		}
		
		list($y, $m, $d) = explode('-', $item['start']);
		$unix_next = strtotime(($y-543).'-'.$m.'-'.$d) + ($next[$i] * 86400);
		$th_next = (date('Y', $unix_next) + 543).'-'.date('m-d', $unix_next);
		
		$full_name = $user['yot'].' '.$user['name'].' '.$user['surname'];
		$sql = "
		INSERT INTO `dphardep` VALUES (null, '$runno', '$th_next 00:00:00', '$full_name', '$hn', NULL, 349.00, 0.00, '¾ÔÈÒÅ ÈÔÃÔªÕ¾ªÑÂÂÑ¹µì (Ç.29268)', 1, '¾ÔÈÒÅ ÈÔÃÔªÕ¾ªÑÂÂÑ¹µì (Ç.29268)', '', 349.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, NULL, '', '".$user['ptright']."', 'DR', NULL, NULL, '', NULL, NULL, '', '');
		";
		var_dump($sql);
		mysql_query($sql);
		$last_id = mysql_insert_id();
		
		$sql = "
		INSERT INTO `ddrugrx` VALUES (null, '$th_next 00:00:00', '$hn', NULL, '0VERO', 'VERORAB 0.5 ml.', 349.00, 0.00, 1, 349.00, 2, '', 'DDL', '$last_id', '1', '', '', '', '', 'IM', '(1 DOSE)', '', NULL, '', '0', '', '', 0, '', '$injno', '');
		";
		var_dump($sql);
		mysql_query($sql);
	}
		
	echo "<hr>";
	
		
}



