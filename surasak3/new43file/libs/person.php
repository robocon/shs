<?php 
$dbi = new mysqli(HOST, USER, PASS, DB);

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


    $PRENAME = $be_prename = $ps['PRENAME'];
    $q_prename = $dbi->query("SELECT `code` FROM `f43_person_1` WHERE `detail` = '$be_prename'");
    if($q_prename->num_rows() > 0 )
    {
        $f_prename = $q_prename->fetch_assoc();
        $PRENAME = $f_prename['code'];
    }
    
    $HOSPCODE = $ps['HOSTPCODE'];
    $CID = $ps['CID'];
    $PID = $ps['PID'];
    $HID = $ps['HID'];
    // $PRENAME = $ps['PRENAME'];
    $NAME = $ps['NAME'];
    $LNAME = $ps['LNAME'];
    $HN = $ps['HN'];

    $SEX = '1';
    if($ps['SEX']=='�')
    {
        $SEX = '2';
    }
    
    list($year, $month, $day) = explode('-', $ps['BIRTH']);
    $BIRTH = ($year-543).$month.$day;

    $pre_mstatus = $ps['MSTATUS'];
    $q_mstatus = $dbi->query("SELECT `code` FROM `f43_person_3` WHERE `detail` = '$pre_mstatus'");
    if($q_mstatus->num_rows() > 0 )
    {
        $f_mstatus = $q_mstatus->fetch_assoc();
        $MSTATUS = $f_mstatus['code'];
    }

    $OCCUPATION_OLD = $ps['OCCUPATION_OLD'];
    $pre_occ_new = $ps['OCCUPATION_NEW'];

    $twodigi_occ_new = substr($pre_occ_new, 0,2);
    
    if($twodigi_occ_new=='01'){$OCCUPATION_OLD="001";} 
    else if($twodigi_occ_new=='02'){$OCCUPATION_OLD="002";}
    else if($twodigi_occ_new=='03'){$OCCUPATION_OLD="014";}
    else if($twodigi_occ_new=='04'){$OCCUPATION_OLD="003";}
    else if($twodigi_occ_new=='05'){$OCCUPATION_OLD="007";}
    else if($twodigi_occ_new=='06'){$OCCUPATION_OLD="004";}
    else if($twodigi_occ_new=='07'){$OCCUPATION_OLD="004";}
    else if($twodigi_occ_new=='08'){$OCCUPATION_OLD="901";}
    else if($twodigi_occ_new=='09'){$OCCUPATION_OLD="004";}
    else if($twodigi_occ_new=='10'){$OCCUPATION_OLD="005";}
    else if($twodigi_occ_new=='11'){$OCCUPATION_OLD="000";}
    else if($twodigi_occ_new=='12'){$OCCUPATION_OLD="013";}
    else if($twodigi_occ_new=='13'){$OCCUPATION_OLD="010";}
    else {$OCCUPATION_OLD="901";};

    if(($pre_occ_new=="05   ����/���Ǩ" || $pre_occ_new=="05 ����/���Ǩ") && ($be_prename=="�.�.�." || $be_prename=="�.�.�." || $be_prename=="�.�.�." || $be_prename=="�.�." ||  $be_prename=="�.�.�."  || $be_prename=="�.�.�." || $be_prename=="�.�.�." || $be_prename=="�.�.�." || $be_prename=="�.�.�." || $be_prename=="�.�.�." || $be_prename=="�.�.�.˭ԧ" || $be_prename=="�.�.�.˭ԧ" || $be_prename=="�.�.�.˭ԧ" || $be_prename=="�.�.˭ԧ" ||  $be_prename=="�.�.�.˭ԧ"  || $be_prename=="�.�.�.˭ԧ" || $be_prename=="�.�.�.˭ԧ" || $be_prename=="�.�.�.˭ԧ" || $be_prename=="�.�.�.˭ԧ" || $be_prename=="�.�.�.˭ԧ")){
		$OCCUPATION_NEW="5412";   //���˹�ҷ����Ǩ
	}else if(($pre_occ_new=="05   ����/���Ǩ" || $pre_occ_new=="05 ����/���Ǩ") && ($be_prename=="�.�."  || $be_prename=="�.�" || $be_prename=="�.�." || $be_prename=="�.�" || $be_prename=="�.�." || $be_prename=="�.�" || $be_prename=="�.�." || $be_prename=="�.�." || $be_prename=="�.�." || $be_prename=="��.�." || $be_prename=="��.�." || $be_prename=="��.�." || $be_prename=="�ŵ��" || $be_prename=="���" || $be_prename=="���͡" || $be_prename=="�.�.˭ԧ"  || $be_prename=="�.�.˭ԧ" || $be_prename=="�.�.˭ԧ" || $be_prename=="�.�.˭ԧ" || $be_prename=="�.�.˭ԧ" || $be_prename=="�.�.˭ԧ")){		
		$OCCUPATION_NEW="0110";   //��·����ѭ�Һѵ�
	}else if(($pre_occ_new=="05   ����/���Ǩ" || $pre_occ_new=="05 ����/���Ǩ") && ($be_prename=="�.�."  || $be_prename=="�.�." || $be_prename=="�.�." || $be_prename=="�.�.�."  || $be_prename=="�.�.�." || $be_prename=="�.�.�." || $be_prename=="�.�.˭ԧ"  || $be_prename=="�.�.˭ԧ" || $be_prename=="�.�.˭ԧ" | $be_prename=="�.�.�.˭ԧ"  || $be_prename=="�.�.�.˭ԧ" || $be_prename=="�.�.�.˭ԧ")){		
		$OCCUPATION_NEW="0210";   //���ê�鹻�зǹ
	}else if($pre_occ_new=="����������"){
		$OCCUPATION_NEW="0310";
	}else if($pre_occ_new=="09   ����Ҫ��÷����" || $pre_occ_new=="09 ����Ҫ��÷����"){
		$OCCUPATION_NEW="1111";
	}else if($pre_occ_new=="��ǹһ�١����" || $pre_occ_new=="01 �ɵá�" || $pre_occ_new=="01   �ɵá�" || $pre_occ_new=="01 �ɵá�"){
		$OCCUPATION_NEW="6111";
	}else{
	   $OCCUPATION_NEW="9629";
	}

    
    
    $xxx = $ps['RACE'];
    $xxx = $ps['xxx'];
    $xxx = $ps['xxx'];
    $xxx = $ps['xxx'];
    $xxx = $ps['xxx'];

    $inline = "$HOSPCODE|$CID|$PID|$HID|$PRENAME|$NAME|$LNAME|$HN|$SEX|$BIRTH|$MSTATUS|$OCCUPATION_OLD|$OCCUPATION_NEW|$race|$nation|$religion|$neweducation|$fstatus|$father|$mother|$couple|$vstatus|$movein|$discharge|$ddischarge|$abogroup|$rhgroup|$labor|$passport|$typearea|$d_update|$phone|$phone\r\n";

    $txt .= $inline;
}

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