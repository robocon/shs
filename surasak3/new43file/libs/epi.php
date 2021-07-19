<?php
//
//-------------------- Create file epi ไฟล์ที่ 39 --------------------//
//

list($year, $month, $day) = explode('-', $thimonth);

$dServ = ( $year - 543 ).$month.$day;

$sql = "SELECT * FROM `43epi` WHERE `D_UPDATE` LIKE '$dServ%' ";
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

    $epiTXT .= "$HOSPCODE|$PID|$SEQ|$DATE_SERV|$VACCINETYPE|$VACCINEPLACE|$PROVIDER|$D_UPDATE|$CID\r\n";

}  //close while


$custom_vaccine_list = array(
	"AstraZeneca1" => "CA1",
	"AstraZeneca2" => "CA2",
	"Sinovac Life Sciences1" => "CS1",
	"Sinovac Life Sciences2" => "CS2"
);

$c19_thDate = ($year-543)."-$month-$day";
$sql_c19Patient = "SELECT *, CONCAT(`vaccine_name`,`vaccine_plant_no`) AS `custom_code` FROM `c19_patients` WHERE `date` LIKE '$c19_thDate%'";
$q_c19 = mysql_query($sql_c19Patient, $db2);
while ($c19 = mysql_fetch_assoc($q_c19)) {
    
    $HOSPCODE = '11512';
    $PID = $c19['hn'];

    list($c19date, $c19time) = explode(' ', $c19['date']);
    list($c19Y, $c19m, $c19d) = explode('-', $c19date);
    list($c19H, $c19i, $c19s) = explode(':', $c19time);
    
    $SEQ = $c19Y.$c19m.$c19d.$c19H.$c19i.$c19s;
    $DATE_SERV = $c19Y.$c19m.$c19d;

    $custom_code = $c19['custom_code'];
    $VACCINETYPE = $custom_vaccine_list[$custom_code];
    $VACCINEPLACE = '11512';

    list($staff_name, $staff_surname) = explode(' ', $c19['staff']);
    $sql_provider = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `NAME` = '$staff_name' AND `LNAME` = '$staff_surname' ";
    $q_provider = mysql_query($sql_provider);
    if(mysql_num_rows($q_provider) > 0)
    {
        $provider = mysql_fetch_assoc($q_provider);
        $PROVIDER = $provider['PROVIDER'];
    }
    else
    {
        $PROVIDER = '11512166330101';
    }
    $D_UPDATE = $SEQ;

    $sql_opcard = "SELECT `idcard` FROM `opcard` WHERE `hn` = '$PID' ";
    $q_opcard = mysql_query($sql_opcard);
    $opcard = mysql_fetch_assoc($q_opcard);
    $CID = $opcard['idcard'];

    $epiTXT .= "$HOSPCODE|$PID|$SEQ|$DATE_SERV|$VACCINETYPE|$VACCINEPLACE|$PROVIDER|$D_UPDATE|$CID\r\n";

}

$filePath = $dirPath.'/epi.txt';
file_put_contents($filePath, $epiTXT);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|SEQ|DATE_SERV|VACCINETYPE|VACCINEPLACE|PROVIDER|D_UPDATE|CID\r\n";
$epiTXT = $header.$epiTXT;
$qofPath = $dirPath.'/qof_epi.txt';
file_put_contents($qofPath, $epiTXT);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม epi เสร็จเรียบร้อย<br>";