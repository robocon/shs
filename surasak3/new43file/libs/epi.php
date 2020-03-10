<?php
//
//-------------------- Create file epi ไฟล์ที่ 39 --------------------//
//

list($year, $month, $day) = explode('-', $thimonth);

$dServ = ( $year - 543 ).$month.$day;

$sql = "SELECT * 
FROM `43epi` 
WHERE `D_UPDATE` LIKE '$dServ%' ";
$qEPI = mysql_query($sql, $db2) or die(mysql_error());

$epiTXT = '';
while ($item = mysql_fetch_assoc($qEPI)) { 
    
    $HOSPCODE = $item['HOSPCODE'];
    $PID = $item['PID'];
    $SEQ = $item['SEQ'];
    $DATE_SERV = $item['DATE_SERV'];
    $VACCINETYPE = $item['VACCINETYPE'];
    $VACCINEPLACE = $item['VACCINEPLACE'];
    $PROVIDER = $item['PROVIDER'];
    $D_UPDATE = $item['D_UPDATE'];
    $CID = $item['CID'];

    $epiTXT = "$HOSPCODE|$PID|$SEQ|$DATE_SERV|$VACCINETYPE|$VACCINEPLACE|$PROVIDER|$D_UPDATE|$CID\r\n";	

}  //close while
$filePath = $dirPath.'/epi.txt';
file_put_contents($filePath, $epiTXT);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|SEQ|DATE_SERV|VACCINETYPE|VACCINEPLACE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_epi.txt';
file_put_contents($qofPath, $epiTXT);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม epi เสร็จเรียบร้อย<br>";