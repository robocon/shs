<?php 

list($year, $month, $day) = explode('-', $thimonth);

$dServ = ( $year - 543 ).$month.$day;

$sql = "SELECT * 
FROM `43policy` 
WHERE `d_update` LIKE '$dServ%' ";
$q = mysql_query($sql, $db2);
$txt = '';
while ( $item = mysql_fetch_assoc($q) ) {

    $txt .= $item['hospcode'].'|'.$item['policy_id'].'|'.$item['policy_year'].'|'.$item['policy_data'].'|'.$item['d_update']."\r\n";

}

$filePath = $dirPath.'/policy.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$headerQof = "HOSPCODE|POLICY_ID|POLICY_YEAR|POLICY_DATA|D_UPDATE\r\n";
$qofPath = $dirPath.'/qof_policy.txt';
file_put_contents($qofPath, $headerQof.$txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม policy เสร็จเรียบร้อย<br>";