<?php
//
//-------------------- Create file drugallergy ����� 11 --------------------//
//
$sql5 = "SELECT a.`regisdate`,b.`date`,b.`hn`,b.`drugcode`,b.`tradname`,b.`advreact`,b.`asses`,b.`reporter`, c.`code24` 
FROM `opcard` AS a 
RIGHT JOIN `drugreact` AS b ON a.`hn`=b.`hn` 
LEFT JOIN `druglst` AS c ON b.`drugcode` = c.`drugcode` 
WHERE a.`regisdate` LIKE '$yrmonth%' 
AND b.`date` LIKE '$thimonth%' 
AND b.`drugcode` != '' ;";
$result5 = mysql_query($sql5) or die("Query failed, Select report_drugallergy (drugallergy)");
$num = mysql_num_rows($result5);

$txt = '';
while (list ($regisdate,$date,$hn,$drugcode,$tradname,$advreact,$asses,$reporter,$code24) = mysql_fetch_row ($result5)) {	
        
    $date = substr($date,0,10);
    list($yy,$mm,$dd) = explode("-",$date);
    $yy = $yy-543;
    $daterecord = "$yy$mm$dd";

    $regis1 = substr($regisdate,0,10);
    $regis2 = substr($regisdate,11,19);
    list($yy,$mm,$dd) = explode("-",$regis1);
    list($hh,$ss,$ii) = explode(":",$regis2);
    $d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //�ѹ��͹�շ���Ѻ��ا������

    $typedx = "";  //����������ԹԨ���
    $alevel = $asses;  //�дѺ�����ع�ç
    $symptom = $advreact;  //�ѡɳ��ҡ��
    $informant = "1";  //���������ѵԡ����

    $inline = "$hospcode|$hn|$daterecord|$code24|$dname|$typedx|$alevel|$symptom|$informant|$hospcode|$d_update\r\n";
    // print($inline);
    $txt .= $inline;
    
}  //close while
$filePath = $dirPath.'/drugallergy.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|DATERECORD|DRUGALLERGY|DNAME|TYPEDX|ALEVEL|SYMPTOM|INFORMANT|INFORMHOSP|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_drugallergy.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "���ҧ��� drugallergy �������º����<br>";