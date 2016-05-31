<?php
//-------------------- Create file person ����� 1 --------------------//
// $temp1="CREATE  TEMPORARY  TABLE report_person1 
// SELECT a.regisdate, a.hn, a.dbirth, a.sex, a.married, a.career, a.nation, a.idcard, b.thidate, a.yot, a.name, a.surname, a.education, a.religion, a.blood, a.idguard
// FROM opcard AS a, 
// opday AS b 
// WHERE a.hn=b.hn 
// AND b.thidate like '$thimonth%'  
// GROUP BY a.hn";


$temp1 = "CREATE  TEMPORARY  TABLE report_person1 
SELECT d.regisdate, d.hn, d.dbirth, d.sex, d.married, d.career, d.nation, d.idcard, c.`date2` AS `thidate`, d.yot, d.name, d.surname, d.education, d.religion, d.blood, d.idguard
FROM (
    SELECT `hn`, SUBSTRING(`thidate`, 1, 10) AS `date2` 
        FROM `opday` 
        WHERE `thidate` LIKE '$thimonth%' 
    UNION 
    SELECT b.`hn`, SUBSTRING(`dcdate`, 1, 10) AS `date2` 
        FROM `ipcard` AS b 
        WHERE b.`dcdate` LIKE '$thimonth%' 
) AS c 
LEFT JOIN `opcard` AS d 
    ON d.`hn` = c.`hn`
GROUP BY d.`hn`";


$querytmp1 = mysql_query($temp1) or die("Query failed,Create temp1");

$sql1="SELECT * 
From report_person1";
$result1 = mysql_query($sql1) or die("Query failed, Select report_person1 (person)");
$txt = '';
while (list ($regisdate,$hn,$dob,$sex,$marringe,$caree,$nation,$id,$thidate,$yot,$name,$lname,$education,$religion,$blood,$idguard) = mysql_fetch_row ($result1)) {		

    // $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
    // list($hospcode)=mysql_fetch_array($sqlhos);
    
    if(empty($id) || $id=="-"){
        $cid="";
        $fstatus="";  //ʶҹ�㹤�ͺ����
        $vstatus="";  //ʶҹ�㹪����		
    }else{
        $cid=$id;
        $fstatus="2";  //ʶҹ�㹤�ͺ����
        $vstatus="5";  //ʶҹ�㹪����		
    }
    
    if(empty($dob)){
        $birth=date("Y")."0101";
    }else{
        list($by,$bm,$bd)=explode("-",$dob);
        $by=$by-543;
        $birth="$by$bm$bd";
    }
    $occupa1=substr($occupa,0,2);
    if($sex=="�"){ $sex="1";}else{ $sex="2";}
    
    if($marringe=="�ʴ"){$mstatus="1";} 
    else if($marringe=="����"){$mstatus="2";} 
    else if($marringe=="�����"){$mstatus="3";} 
    else if($marringe=="����"){$mstatus="4";} 
    else if($marringe=="�¡"){$marringe1="5";} 
    else if($marringe=="����"){$mstatus="6";} 
    else {$mstatus="9";};

    $fullname=$name.' '.$lname.','.$yot;
    if(strlen($id)=="13" and substr($id,0,1) != "0"){$idtype="1";}else {$idtype="4";};

    $career=substr($career,3);
    $career = ereg_replace('[[:space:]]+', '', trim($career)); 
    $career = str_replace(" ","",$career);
    
    if($career=='01'){$occ_old="001";} 
    else if($career=='02'){$occ_old="002";}
    else if($career=='03'){$occ_old="014";}
    else if($career=='04'){$occ_old="003";}
    else if($career=='05'){$occ_old="007";}
    else if($career=='06'){$occ_old="004";}
    else if($career=='07'){$occ_old="004";}
    else if($career=='08'){$occ_old="901";}
    else if($career=='09'){$occ_old="004";}
    else if($career=='10'){$occ_old="005";}
    else if($career=='11'){$occ_old="000";}
    else if($career=='12'){$occ_old="013";}
    else if($career=='13'){$occ_old="010";}
    else {$occ_old="901";};	
    
    $sql ="select code from occupa where detail like '%$career%'  ";  //���ҧ�Ҫվ����
    $row = mysql_query($sql);
    list($occ_new) = mysql_fetch_array($row);
    if($occ_new==""){
        $occ_new="9629";
    }

    if($religion=="�ط�"||$religion=="��ʹҾط�"){
        $religion="01";
    }else if($religion=="������"||$religion=="��ʹ�������"){
        $religion="02";
    }else if($religion=="���ʵ�"||$religion=="��ʹҤ��ʵ�"){
        $religion="03";
    }else{
        $religion="99";
    }

    $regis1=substr($regisdate,0,10);
    $regis2=substr($regisdate,11,19);
    list($yy,$mm,$dd)=explode("-",$regis1);
    $movein="$yy$mm$dd";  //�ѹ�������������ࢵ��鹷��
    $ddischarge="$yy$mm$dd";  //�ѹ����˹���
    list($hh,$ss,$ii)=explode(":",$regis2);
    $d_update=$yy.$mm.$dd.$hh.$ss.$ii;


    $thidated=substr($thidate,8,2);
    $thidatem=substr($thidate,5,2); 
    $thidatey=substr($thidate,0,4); 
    $thidatem1=substr($thidate,11,2); 
    $thidatem2=substr($thidate,14,2); 
    $thidatem3=substr($thidate,17,2); 

    $thidatey1= $thidatey-543;

    $sql ="select code from pername where (detail1='$yot' or detail2='$yot')   ";
    $row = mysql_query($sql);
    list($pername) = mysql_fetch_array($row);

    $sql ="select code from bloodgroup where (detail='$blood' or detail2='$blood')   ";
    $row = mysql_query($sql);
    list($abogroup) = mysql_fetch_array($row);


    if(substr($idguard,0,4)== "MX04"){$dcstatus="1";}else{$dcstatus="9";}

    $typearea="1";  //ʶҹкؤ��
    $race="999";  //���ͪҵ�
    $nation="999";  //�ѭ�ҵ�
    $education="09";  //�дѺ����֡��
    $discharge="9";  //ʶҹ�/���˵ء�è�˹���
    $inline = "$hospcode|$cid|$hn|$hid|$pername|$name|$lname|$hn|$sex|$birth|$mstatus|$occ_old|$occ_new|$race|$nation1|$religion|$education|$fstatus|$father|$mother|$couple|$vstatus|$movein|$discharge|$ddischarge|$abogroup|$rhgroup|$labor|$passport|$typearea|$d_update\r\n";
    $txt .= $inline;

} //close while
$filePath = $dirPath.'/person.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

//����Ѻ qof
$header = "HOSPCODE|CID|PID|HID|PRENAME|NAME|LNAME|HN|SEX|BIRTH|MSTATUS|OCCUPATION_OLD|OCCUPATION_NEW|RACE|NATION|RELIGION|EDUCATION|FSTATUS|FATHER|MOTHER|COUPLE|VSTATUS|MOVEIN|DISCHARGE|DDISCHARGE|ABOGROUP|RHGROUP|LABOR|PASSPORT|TYPEAREA|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_person.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "���ҧ��� person �������º����<br>";
//-------------------- Close create file person --------------------//