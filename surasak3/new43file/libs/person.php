<?php

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );


//-------------------- Create file person ����� 1 --------------------//
// $temp1="CREATE  TEMPORARY  TABLE report_person1 
// SELECT a.regisdate, a.hn, a.dbirth, a.sex, a.married, a.career, a.nation, a.idcard, b.thidate, a.yot, a.name, a.surname, a.education, a.religion, a.blood, a.idguard
// FROM opcard AS a, 
// opday AS b 
// WHERE a.hn=b.hn 
// AND b.thidate like '$thimonth%'  
// GROUP BY a.hn";

$temp1 = "CREATE  TEMPORARY  TABLE report_person1 
SELECT d.regisdate, d.hn, d.dbirth, d.sex, d.married, d.career, d.nation, d.idcard, c.`date2` AS `thidate`, d.yot, d.name, d.surname, d.education, d.religion, d.blood, d.idguard, d.ptright,  
CASE 
    WHEN d.hphone <> '' THEN d.hphone 
    WHEN d.phone <> '' THEN d.phone
    WHEN d.ptffone <> '' THEN d.ptffone
END AS `PHONE` ,
d.`typearea` AS `TYPEAREA`,
thDateTimeToEn(d.`lastupdate`) AS `d_update` 
FROM (
    SELECT y.`hn`, SUBSTRING(y.`thidate`, 1, 10) AS `date2`
		FROM ( 
			SELECT MAX(`row_id`) as `row_id`,`hn` 
			FROM `opday` 
			WHERE `thidate` LIKE '$thimonth%' 
			GROUP BY `hn` 
		) AS x 
		LEFT JOIN `opday` AS y ON y.`row_id` = x.`row_id` 
) AS c 
LEFT JOIN `opcard` AS d ON d.`hn` = c.`hn` 
WHERE d.`hn` IS NOT NULL 
AND ( d.`idguard` NOT LIKE 'MX05%' AND d.`idguard` NOT LIKE 'MX07%' ) ";
$querytmp1 = mysql_query($temp1, $db2) or die("Query failed person ,Create temp1: ".mysql_error());

$sql1="SELECT * FROM report_person1 ";
$result1 = mysql_query($sql1, $db2) or die("Query failed, Select report_person1 (person)");
$txt = '';
while (list ($regisdate,$hn,$dob,$sex,$marringe,$caree,$nation,$cid,$thidate,$yot,$name,$lname,$education,$religion,$blood,$idguard,$ptright,$phone,$typearea,$d_update) = mysql_fetch_row ($result1)) {		

    $PID = $hn;
    $fstatus = "";
    $vstatus = "";

    $phone = trim($phone);
    $phone = str_replace('-', '', $phone);

    // �Ѵ / , ��ͧ��ҧ ���੾�������á
    $test_phone = strpos($phone,'/');
    if( $test_phone > 0 ){
        $phone = substr($phone, 0, $test_phone);
    }

    $test_phone = strpos($phone,',');
    if( $test_phone > 0 ){
        $phone = substr($phone, 0, $test_phone);
    }

    $test_phone = strpos($phone,' ');
    if( $test_phone > 0 ){
        $phone = substr($phone, 0, $test_phone);
    }

    // �Ѵ / , ��ͧ��ҧ ���੾�������á

    $yot = trim($yot);
    if( stripos($yot,'˭ԧ') > 0 ){ 
        $yot = str_replace('˭ԧ', '', $yot);
    }

    $yot = trim($yot);
    if( stripos($yot,'�ŷ���') > 0 ){ 
        $yot = str_replace('�ŷ���', '���', $yot);
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
    
/*    $sql ="select code from occupa where detail like '%$career%'  ";  //���ҧ�Ҫվ����
    $row = mysql_query($sql);
    list($occ_new) = mysql_fetch_array($row);
    if($occ_new==""){
        $occ_new="9999";
    }*/
	
	if(($career=="05   ����/���Ǩ" || $career=="05 ����/���Ǩ") && ($yot=="�.�.�." || $yot=="�.�.�." || $yot=="�.�.�." || $yot=="�.�." ||  $yot=="�.�.�."  || $yot=="�.�.�." || $yot=="�.�.�." || $yot=="�.�.�." || $yot=="�.�.�." || $yot=="�.�.�." || $yot=="�.�.�.˭ԧ" || $yot=="�.�.�.˭ԧ" || $yot=="�.�.�.˭ԧ" || $yot=="�.�.˭ԧ" ||  $yot=="�.�.�.˭ԧ"  || $yot=="�.�.�.˭ԧ" || $yot=="�.�.�.˭ԧ" || $yot=="�.�.�.˭ԧ" || $yot=="�.�.�.˭ԧ" || $yot=="�.�.�.˭ԧ")){
		$occ_new="5412";   //���˹�ҷ����Ǩ
	}else if(($career=="05   ����/���Ǩ" || $career=="05 ����/���Ǩ") && ($yot=="�.�."  || $yot=="�.�" || $yot=="�.�." || $yot=="�.�" || $yot=="�.�." || $yot=="�.�" || $yot=="�.�." || $yot=="�.�." || $yot=="�.�." || $yot=="��.�." || $yot=="��.�." || $yot=="��.�." || $yot=="�ŵ��" || $yot=="���" || $yot=="���͡" || $yot=="�.�.˭ԧ"  || $yot=="�.�.˭ԧ" || $yot=="�.�.˭ԧ" || $yot=="�.�.˭ԧ" || $yot=="�.�.˭ԧ" || $yot=="�.�.˭ԧ")){		
		$occ_new="0110";   //��·����ѭ�Һѵ�
	}else if(($career=="05   ����/���Ǩ" || $career=="05 ����/���Ǩ") && ($yot=="�.�."  || $yot=="�.�." || $yot=="�.�." || $yot=="�.�.�."  || $yot=="�.�.�." || $yot=="�.�.�." || $yot=="�.�.˭ԧ"  || $yot=="�.�.˭ԧ" || $yot=="�.�.˭ԧ" | $yot=="�.�.�.˭ԧ"  || $yot=="�.�.�.˭ԧ" || $yot=="�.�.�.˭ԧ")){		
		$occ_new="0210";   //���ê�鹻�зǹ
	}else if($career=="����������"){
		$occ_new="0310";
	}else if($career=="09   ����Ҫ��÷����" || $career=="09 ����Ҫ��÷����"){
		$occ_new="1111";	
	}else if($career=="��ǹһ�١����" || $career=="01 �ɵá�" || $career=="01   �ɵá�" || $career=="01 �ɵá�"){
		$occ_new="6111";										
	}else{
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

    // $d_update = str_replace(array(' ', ':', '-'), '', $lastupdate);
    // $d_update=$yy.$mm.$dd.$hh.$ss.$ii;


    $thidated=substr($thidate,8,2);
    $thidatem=substr($thidate,5,2); 
    $thidatey=substr($thidate,0,4); 
    $thidatem1=substr($thidate,11,2); 
    $thidatem2=substr($thidate,14,2); 
    $thidatem3=substr($thidate,17,2); 

    $thidatey1= $thidatey-543;

    $sql ="SELECT `code` FROM `pername` WHERE (`detail1`='$yot' OR `detail2`='$yot' OR `detail3`='$yot' OR `detail4`='$yot')";
    $row = mysql_query($sql, $db2);
    list($pername) = mysql_fetch_array($row);

/*    $sql ="select code from bloodgroup where (detail='$blood' or detail2='$blood')   ";
    $row = mysql_query($sql);
    list($abogroup) = mysql_fetch_array($row);*/
	
	//�������ʹ
	$blood=trim($blood);
	if($blood=="��" || $blood=="A"){
		$abogroup="1";
	}else if($blood=="��" || $blood=="B"){
		$abogroup="2";
	}else if($blood=="�ͺ�" || $blood=="AB"){
		$abogroup="3";
	}else if($blood=="��" || $blood=="O"){
		$abogroup="4";
	}else{
		$abogroup="9";
	}						
	


    if(substr($idguard,0,4)== "MX04"){$dcstatus="1";}else{$dcstatus="9";}

    if ( empty($typearea) ) {
        $ptright=substr($ptright,0,2);
        if($ptright=="R01"){
            $typearea="4";
        }else{
            $typearea="1";  //ʶҹкؤ��
        }
    }
	
    
   //���ͪҵ�
    if($race=="��" || $race=="01 ��"){
		$race="099";  
	}else if($race=="����"){
		$race="048";  
	}else if($race=="�չ"){
		$race="044";  
	}else if($race=="���"){
		$race="056";  
	}else if($race=="����٪�"){
		$race="057";  
	}else if($race=="�Թ���"){
		$race="045";  						
	}else if($race=="���´���"){
		$race="046";  						
	}else{
		$race="999";  
	}

   
   //�ѭ�ҵ�
    if($nation=="��" || $nation=="01 ��"){
		$nation="099";  
	}else if($nation=="����"){
		$nation="048";  
	}else if($nation=="�չ"){
		$nation="044";  
	}else if($nation=="���"){
		$nation="056";  
	}else if($nation=="����٪�"){
		$nation="057";  
	}else if($nation=="�Թ���"){
		$nation="045";  						
	}else if($nation=="���´���"){
		$nation="046";  						
	}else{
		$nation="999";  
	}
	
	
	if(!empty($education)){
		$neweducation=sprintf("%02d",$education);
	}else{
    	$neweducation="09";  //�дѺ����֡��
	}
	
    $discharge = "9";  //ʶҹ�/���˵ء�è�˹���
    $occ_old = '';

    $inline = "$hospcode|$cid|$PID|$hid|$pername|$name|$lname|$hn|$sex|$birth|$mstatus|$occ_old|$occ_new|$race|$nation|$religion|$neweducation|$fstatus|$father|$mother|$couple|$vstatus|$movein|$discharge|$ddischarge|$abogroup|$rhgroup|$labor|$passport|$typearea|$d_update|$phone|$phone\r\n";

    $txt .= $inline;

} //close while

$filePath = $dirPath.'/person.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

//����Ѻ qof
$header = "HOSPCODE|CID|PID|HID|PRENAME|NAME|LNAME|HN|SEX|BIRTH|MSTATUS|OCCUPATION_OLD|OCCUPATION_NEW|RACE|NATION|RELIGION|EDUCATION|FSTATUS|FATHER|MOTHER|COUPLE|VSTATUS|MOVEIN|DISCHARGE|DDISCHARGE|ABOGROUP|RHGROUP|LABOR|PASSPORT|TYPEAREA|D_UPDATE|TELEPHONE|MOBILE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_person.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "���ҧ��� person �������º����<br>";
//-------------------- Close create file person --------------------//