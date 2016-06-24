<?php
/**
 * ระบบนำเข้าข้อมูลสิทธิ30บาทจาก สปสช เจ้แหม่ม เพื่อนำมาเปรียบเทียมกับข้อมูลของ รพ. ว่ามีใครในรายชื่อบ้างที่มีอยู่ใน รพ.
 * 
 * @author Kritsanasak
 */
include 'bootstrap.php';

$user_code = get_session('smenucode');
if( $user_code !== 'ADM' ){
	echo "Invalid User";
	exit;
}

$db = Mysql::load();

// เคลียร์ข้อมูลเดิมออกให้หมดก่อน
$db->select("TRUNCATE TABLE `sso30`");

$txt = file_get_contents('popuckai.txt', true);
$test = true;
foreach( explode("\n", $txt) as $key => $item ){
    preg_match('/^\d{13}/', $item, $match);
    if( !empty($match['0']) ){

		$sql = "INSERT INTO  `sso30` (  `id` ,  `idcard` ) 
		VALUES ( NULL,  :idcard );";
		$data = array(':idcard' => $match['0']);
		$insert = $db->insert($sql, $data);
		if( $insert !== true ){
			$test = false;
		}
	}
}

if( $test === false ){
	echo "ไม่สามารถนำเข้าข้อมูลได้";
}else{
	echo "นำเข้าข้อมูลเสร็จเรียบร้อย";
}