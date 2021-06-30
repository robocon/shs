<?php 

$sql_person = "SELECT b.* 
FROM ( 
    SELECT `hn`,`thidate`,`thdatehn` 
    FROM `opday` 
    WHERE `thidate` LIKE '$thimonth%' 
    GROUP BY `hn` 
 ) AS a 
LEFT JOIN `person` AS b ON b.`PID` = a.`hn` "; 

$q_person = $dbi->query($sql_person);
while ($ps = $q_person->fetch_assoc()) {

    # code...


    $inline = "$hospcode|$cid|$PID|$hid|$pername|$name|$lname|$hn|$sex|$birth|$mstatus|$occ_old|$occ_new|$race|$nation|$religion|$neweducation|$fstatus|$father|$mother|$couple|$vstatus|$movein|$discharge|$ddischarge|$abogroup|$rhgroup|$labor|$passport|$typearea|$d_update|$phone|$phone\r\n";

    $txt .= $inline;
}

$filePath = $dirPath.'/person.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

//สำหรับ qof
$header = "HOSPCODE|CID|PID|HID|PRENAME|NAME|LNAME|HN|SEX|BIRTH|MSTATUS|OCCUPATION_OLD|OCCUPATION_NEW|RACE|NATION|RELIGION|EDUCATION|FSTATUS|FATHER|MOTHER|COUPLE|VSTATUS|MOVEIN|DISCHARGE|DDISCHARGE|ABOGROUP|RHGROUP|LABOR|PASSPORT|TYPEAREA|D_UPDATE|TELEPHONE|MOBILE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_person.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม person เสร็จเรียบร้อย<br>";