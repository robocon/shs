<?php

list($y, $m, $d) = explode('-', $thimonth);

$date_serv_selected = ( $y - 543 ).$m.$d;

$sql = "SELECT a.`hospcode` AS `HOSPCODE`,
a.`disabid` AS `DISABID`, 
a.`pid` AS `PID`, 
a.`seq` AS `SEQ`, 
a.`date_serv` AS `DATE_SERV`, 
a.`icf` AS `ICF`, 
a.`qualifier` AS `QUALIFIER`, 
a.`provider` AS `PROVIDER`, 
a.`d_update` AS `D_UPDATE`, 
a.`cid` AS `CID`,
b.`doctor`,
c.`disabtype` 
FROM `icf43` AS a 
LEFT JOIN `opday` AS b ON b.`row_id` = a.`opday_id` 
LEFT JOIN `disability43` AS c ON c.`opday_id` = a.`opday_id`
WHERE a.`d_update` LIKE '$date_serv_selected%' ";

$icf_list = array(1=>'b210.8','b230.8','','','b117.8','d155.8','');

$q = mysql_query($sql, $db2) or die( mysql_error() );

$txt = "";
while ( $item = mysql_fetch_assoc($q) ) {

    if( preg_match('/^(MD\d+)/', $item['doctor'], $matchs) > 0 ){ 

        $pre_doc = $matchs['0'];
        $q2 = mysql_query("SELECT `doctorcode` FROM `doctor` WHERE `name` LIKE '$pre_doc%'", $db2) or die( mysql_error() );
        if ( mysql_num_rows($q2) > 0 ) {
            $dt = mysql_fetch_assoc($q2);
            $code = sprintf("%05d", $dt['doctorcode']);
        }else{

            $code = '00000';
        }

    }else if( preg_match('/(\d+){4,5}/', $item['doctor'], $matchs) > 0 ){

        $code = sprintf("%05d", $matchs['0']);

    }else{
        $code = '00000';
    }

    $provider = $item['SEQ'].$code;

    $disab_item = $item['disabtype'];
    $icf = $icf_list[$disab_item];

    $txt .= $item['HOSPCODE'].'|'
    .$item['DISABID'].'|'
    .$item['PID'].'|'
    .$item['SEQ'].'|'
    .$item['DATE_SERV'].'|'
    .$icf.'|'
    .$item['QUALIFIER'].'|'
    .$provider.'|'
    .$item['D_UPDATE'].'|'
    .$item['CID']."\r\n";
}

$filePath = $dirPath.'/icf.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|DISABID|PID|SEQ|DATE_SERRV|ICF|QUALIFIER|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_icf.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม icf เสร็จเรียบร้อย<br>";