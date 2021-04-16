<?php 
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
// $dbi->query("SET NAMES tis620");
// $dbi->query("SET NAMES UTF8");

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY »Õ";
	}else{
		$pAge="$ageY »Õ $ageM à´×Í¹";
	}

    return $pAge;
}

$test_row_id = rand(100000, 230725);
$thai_date = (date('Y')+543).date('-m-d H:i:s');
$rand_min = rand(10,29);
$rand_sec = rand(10,50);

$sql = "SELECT *,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`,`ptright1`,`dbirth` FROM `opcard` WHERE `row_id` = '$test_row_id' ";
$op_q = $dbi->query($sql);
$item = $op_q->fetch_assoc();

$pre_countdown_c19 = strtotime("+$rand_min minutes +$rand_sec seconds");
$countdown_c19 = date('Y-m-d H:i:s', $pre_countdown_c19);

$ptname = $item['ptname'];
$ptright = $item['ptright1'];
$hn = $item['hn'];

$age = calcage($item['dbirth']);

$sql = "INSERT INTO `test_trauma_inject` (
    `row_id`, `thidate`, `thidate_regis`, `hn`, `ptname`, `age`, 
    `ptright`, `TYPE`, `drugcode`, `tradname`, `number`, `opd`, 
    `toborow`, `status_c19`, `countdown_c19`
) 
VALUES 
(
    NULL, '$thai_date', '$thai_date', '$hn', '$ptname', '$age', 
    '$ptright', 'V', 'C19', '·´ÊÍºÇÑ¤«Õ¹', '', '0', 
    'EX52 ©Õ´ÇÑ¤«Õ¹â¤ÇÔ´ 19', 'N', '$countdown_c19'
);";
$test = $dbi->query($sql);
dump($test);

