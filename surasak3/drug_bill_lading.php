<?php
# ��¡���ҷ���ԡ
include 'bootstrap.php';

$items_left = array();
$items_right = array();
$rows = (int) $_POST['sump'];
$full_items = array();

$datetime = get_session('datetime');
$sOfficer = get_session('sOfficer');
$yymall = get_session('yymall');

$db = Mysql::load();
$sql = "SELECT `runno` FROM `runno` WHERE title = 'drugimp';";
$db->select($sql);
$item = $db->get_item();
$runno = (int) $item['runno'];
++$runno;

$sql = "UPDATE `runno` SET `runno` = '$runno' WHERE title = 'drugimp'; ";
$db->update($sql);

// ������������������͹
for ($i=1; $i <= $rows; $i++) { 

	$drugcode = trim($_POST['drx'.$i]);
	$tradename = trim($_POST['tname'.$i]);
	$rxdrug = $_POST['rxdrug'.$i];
	$num = (int) $_POST['import'.$i];

	$sql = "SELECT b.`min`, b.`max`, a.`stock`, a.`mainstk` 
	FROM `druglst` AS a 
	RIGHT JOIN `drug_control_user` AS b ON b.`drugcode` = a.`drugcode` 
	WHERE a.`drugcode` = '$drugcode' 
	AND b.`username` = '$sOfficer'";
	$db->select($sql);
	$item = $db->get_item();

	$insert_sql = "INSERT INTO drugimport (
	thidate,drugcode,tradname,min,max,
	stock,mainstk,dispense,amountrx,idno,
	usercontrol,datesearch
	) values (
	'$datetime','$drugcode','$tradename','".$item['min']."','".$item['max']."',
	'".$item['stock']."','".$item['mainstk']."','$rxdrug','$num','$runno',
	'$sOfficer','$yymall'
	);";
	$db->insert($insert_sql);

    $full_items[$i] = array(
		'drugcode' => $drugcode,
        'tradename' => $tradename,
        'rxdrug' => $rxdrug,
        'num' => $num
    );
}

// ������� $full_items �¹����˹����§ҹ���ҧ������¨��
include 'bill_lading_pdf.php';