#!/usr/bin/php
<?php 

$conn = new mysqli("192.168.1.2", "remoteuser", "", "smdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$handle = fopen("C:\\Users\\roboc\\OneDrive\\Documents\\Drug-Offline.csv", "w");

$row = array('รหัสยา','ชื่อทางการค้า','ชื่อสามัญ','DRUGNAME','UNIT','STOCK','ราคาขาย','NOTE','คุณสมบัติ','PART');
fputcsv($handle, $row);

$sql = "SELECT `drugcode`,`tradname`,`genname`,`drugname`,`unit`,`stock`,`salepri`,`drugnote`,`drug_properties`,
CASE 
	WHEN `part` = 'DDL' THEN 'ยา เบิกได้' 
	WHEN `part` = 'DDY' THEN 'ยา เบิกได้' 
	WHEN `part` = 'DDN' THEN 'ยา เบิกไม่ได้' 
	WHEN `part` = 'DPY' THEN 'อุปกรณ์ เบิกได้' 
    WHEN `part` = 'DPN' THEN 'อุปกรณ์ เบิกไม่ได้' 
    WHEN `part` = 'DSY' THEN 'เวชภัณฑ์ เบิกได้' 
    WHEN `part` = 'DSN' THEN 'เวชภัณฑ์ เบิกไม่ได้' 
END AS `part`
FROM `druglst` ORDER BY `drugcode` ASC ";
$result = $conn->query($sql);
if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 

        fputcsv($handle, $row);

    }
}

fclose($handle);