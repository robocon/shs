#!/usr/bin/php
<?php 

$conn = new mysqli("192.168.1.2", "remoteuser", "", "smdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$handle = fopen("C:\\Users\\roboc\\OneDrive\\Documents\\Drug-Offline.csv", "w");

$row = array('������','���ͷҧ��ä��','�������ѭ','DRUGNAME','UNIT','STOCK','�ҤҢ��','NOTE','�س���ѵ�','PART');
fputcsv($handle, $row);

$sql = "SELECT `drugcode`,`tradname`,`genname`,`drugname`,`unit`,`stock`,`salepri`,`drugnote`,`drug_properties`,
CASE 
	WHEN `part` = 'DDL' THEN '�� �ԡ��' 
	WHEN `part` = 'DDY' THEN '�� �ԡ��' 
	WHEN `part` = 'DDN' THEN '�� �ԡ�����' 
	WHEN `part` = 'DPY' THEN '�ػ�ó� �ԡ��' 
    WHEN `part` = 'DPN' THEN '�ػ�ó� �ԡ�����' 
    WHEN `part` = 'DSY' THEN '�Ǫ�ѳ�� �ԡ��' 
    WHEN `part` = 'DSN' THEN '�Ǫ�ѳ�� �ԡ�����' 
END AS `part`
FROM `druglst` ORDER BY `drugcode` ASC ";
$result = $conn->query($sql);
if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 

        fputcsv($handle, $row);

    }
}

fclose($handle);