<?php
/**
 * �к�����Ң������Է��30�ҷ�ҡ ʻʪ ������� ���͹������º�����Ѻ�����Ţͧ þ. ����������ª��ͺ�ҧ���������� þ.
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

// ���������������͡��������͹
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
	echo "�������ö����Ң�������";
}else{
	echo "����Ң������������º����";
}