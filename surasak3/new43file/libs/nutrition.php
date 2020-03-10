<?php

list($year, $month, $day) = explode('-', $thimonth);

$dServ = ( $year - 543 ).$month.$day;

$sql = "SELECT * 
FROM `43nutrition` 
WHERE `D_UPDATE` LIKE '$dServ%' ";
$qNUTRITION = mysql_query($sql, $db2) or die(mysql_error());

$nutritionTxt = '';
while ($item = mysql_fetch_assoc($qNUTRITION)) { 
    
    $HOSPCODE = $item['HOSPCODE'];
    $PID = $item['PID'];
    $SEQ = $item['SEQ'];
    $DATE_SERV = $item['DATE_SERV'];
    $NUTRITIONPLACE = $item['NUTRITIONPLACE'];
    $WEIGHT = $item['WEIGHT'];
    $HEIGHT = $item['HEIGHT'];
    $HEADCIRCUM = $item['HEADCIRCUM'];
    $CHILDDEVELOP = $item['CHILDDEVELOP'];
    $FOOD = $item['FOOD'];
    $BOTTLE = $item['BOTTLE'];
    $PROVIDER = $item['PROVIDER'];
    $D_UPDATE = $item['D_UPDATE'];
    $CID = $item['CID'];

    $nutritionTxt = "$HOSPCODE|$PID|$SEQ|$DATE_SERV|$NUTRITIONPLACE|$WEIGHT|$HEIGHT|$HEADCIRCUM|$CHILDDEVELOP|$FOOD|$BOTTLE|$PROVIDER|$D_UPDATE|$CID\r\n";

}  //close while
$filePath = $dirPath.'/nutrition.txt';
file_put_contents($filePath, $nutritionTxt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|SEQ|DATE_SERV|NUTRITIONPLACE|WEIGHT|HEIGHT|HEADCIRCUM|CHILDDEVELOP|FOOD|BOTTLE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_nutrition.txt';
file_put_contents($qofPath, $nutritionTxt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม nutrition เสร็จเรียบร้อย<br>";