<?php
session_start();
error_reporting(1); // Show all error

include 'connect.inc';

/**
!!! REMOVE employee field !!!
ALTER TABLE `opcard` DROP `employee` ;

!!! ADD employee field !!!
ALTER TABLE `opcard` ADD `employee` VARCHAR(  ) NULL ;
 */

// !!! FOR DEVELOP ONLY !!!
// $host = "localhost";
// $db = "smdb";
// $user = "root"; 
// $pass = "1234";
// $conn = mysql_connect($host,$user,$pass) or die ("Can not connect to server");
// mysql_select_db($db,$conn) or die ("Can not connect to database");


mysql_query("SET NAMES tis620");
// !!! FOR DEVELOP ONLY !!!

$sql = "SELECT `hn`,`vn`,`ptname`,`temperature`,`pause`,`rate`,`weight`,`height`,`bp1`,`bp2`,`organ`,`thidate`,`toborow` 
FROM `opd` 
WHERE (`thidate` LIKE '2558-03%' OR `thidate` LIKE '2558-04%') 
AND ( 
	`organ` LIKE '%��Ǩ�آ�Ҿ��Шӻ�58�١��ҧþ.����%' 
	OR `organ` LIKE '%��Ǩ�آ�Ҿ�١��ҧ��Шӻ�þ.���»� 58%' 
	OR `organ` LIKE '%��Ǩ�آ�Ҿ��Шӻ��١��ҧ���Ǥ��� þ.����%' 
	OR `organ` LIKE '%��Ǩ�آ�Ҿ��Шӻ��١��ҧ%' 
	OR `organ` LIKE '%��Ǩ�آ�Ҿ��Шӻ��١��ҧþ.�����%' 
	OR `organ` LIKE '%��Ǩ�آ�Ҿ��Шӻ��١��ҧþ.����%' 
	OR `organ` LIKE '%��Ǩ�آ�Ҿ�١��ҧþ.�����%'
	OR `organ` LIKE '%��Ǩ�آ�Ҿ�١��ҧ �.�. ����%'
	OR `organ` LIKE '%��Ǩ�آ�Ҿ�١��ҧ �.�.�����%'
	OR `organ` LIKE '%��Ǩ�آ�Ҿ��Шӻ��١��ҧ���Ǥ��� þ.���� ��58%'
	OR `organ` LIKE '%��Ǩ�آ�Ҿ�١��ҧ�.�. ����%'
	OR `organ` LIKE '%��Ǩ�آ�Ҿ�١��ҧ%'
	OR `organ` LIKE '%��Ǩ�آ�Ҿ��Шӻ��١��ҧ �.�. �����%'
	OR `organ` LIKE '1.��Ǩ�آ�Ҿ��Шӻ�%'
	OR `organ` = '��Ǩ�آ�Ҿ��Шӻ�'
	OR `organ` = ' ��Ǩ�آ�Ҿ��Шӻ�'
	
	OR `organ` LIKE '%�١��ҧ%'
	) 
GROUP BY `hn` 
ORDER BY `row_id` DESC ";

$result = mysql_query($sql);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

$i = 0;
while ($row = mysql_fetch_assoc($result)) {	
	
	$sql = "SELECT `row_id`,`name`,`surname`,`employee` FROM `opcard` WHERE `hn` = '".$row['hn']."';";
	$res = mysql_query($sql);
	$item = mysql_fetch_assoc($res);
	if($item !== false && $item['employee'] != 'y'){
		
		$sql = "UPDATE `opcard` SET `employee` = 'y' WHERE `hn` = '".$row['hn']."' ";
		$update = mysql_query($sql);
		
		if($update){
			echo '<p>'.$item['name'].' '.$item['surname'].'</p>';
			$i++;
		}
		
	}
	
}

echo '<p><b>��������� '.$i.' �� ����Ѻ�������� ��ѡ�ҹ�ç��Һ��</b></p>';