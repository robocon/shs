<?php
//
//-------------------- Create file drugallergy ����� 11 --------------------//
//
$sql5 = "SELECT a.`regisdate`,b.`date`,b.`hn`,b.`drugcode`,b.`tradname`,b.`advreact`,b.`asses`,b.`reporter`, c.`code24`,
a.`idcard` 
FROM `opcard` AS a 
RIGHT JOIN `drugreact` AS b ON a.`hn`=b.`hn` 
LEFT JOIN `druglst` AS c ON b.`drugcode` = c.`drugcode` 
WHERE a.`regisdate` LIKE '$yrmonth%' 
AND b.`date` LIKE '$thimonth%';";
$result5 = mysql_query($sql5) or die("Query failed, Select report_drugallergy (drugallergy)");
$num = mysql_num_rows($result5);

$txt = '';
while (list ($regisdate,$date,$hn,$drugcode,$tradname,$advreact,$asses,$reporter,$code24, $cid) = mysql_fetch_row ($result5)) {	
    
    $dname = $tradname;
    
    $date = substr($date,0,10);
    list($yy,$mm,$dd) = explode("-",$date);

    $full_year = $yy;

    $yy = $yy-543;

    $sortdate = substr($yy,2,2).$mm.$dd;

    $daterecord = "$yy$mm$dd";

    // �� VN �ҡ�ѹ���ѹ�֡������
    // ��Ң�����͹��������͹����
    $q = mysql_query("SELECT `vn`,`doctor` FROM `opday` WHERE `thidate` LIKE '$full_year-$mm%' AND `hn` = '$hn' ") or die( mysql_error() );
    $opday = mysql_fetch_assoc($q);
    $vn = $opday['vn'];
    if( empty($vn) || $vn == '' ){
        $vn = '000';
    }

    // �� doctorcode �ҡ���� 5����á
    $test_dc = substr($opday['doctor'], 0, 5);
    $q = mysql_query("SELECT `doctorcode` FROM `doctor` WHERE `name` LIKE '$test_dc%'");
    $doctor = mysql_fetch_assoc($q);
    $doctor_code = $doctor['doctorcode'];
    if( empty($doctor['doctorcode']) || $doctor['doctorcode'] == '' ){
        $doctor_code = '00000';
    }

    $regis1 = substr($regisdate,0,10);
    $regis2 = substr($regisdate,11,19);
    list($yy,$mm,$dd) = explode("-",$regis1);
    list($hh,$ss,$ii) = explode(":",$regis2);
    $d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //�ѹ��͹�շ���Ѻ��ا������

    $typedx = $asses;  //����������ԹԨ���
    $alevel = "";  //�дѺ�����ع�ç
    $symptom = $advreact;  //�ѡɳ��ҡ��
    $informant = "1";  //���������ѵԡ����

    $provider = $sortdate.sprintf('%03d', $vn).$doctor_code;

    $inline = "$hospcode|$hn|$daterecord|$code24|$dname|$typedx|$alevel|$symptom|$informant|$hospcode|$d_update|$provider|$cid\r\n";
    // print($inline);
    $txt .= $inline;
    
}  //close while
$filePath = $dirPath.'/drugallergy.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|DATERECORD|DRUGALLERGY|DNAME|TYPEDX|ALEVEL|SYMPTOM|INFORMANT|INFORMHOSP|D_UPDATE|PROVIDER|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_drugallergy.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "���ҧ��� drugallergy �������º����<br>";