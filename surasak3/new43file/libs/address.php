<?php
//-------------------- Create file address ไฟล์ที่ 2 --------------------//
$temp2="CREATE TEMPORARY TABLE report_person2 
SELECT a.regisdate,a.hn,a.yot,a.name,a.surname,a.address,a.tambol,a.ampur,a.changwat,a.idguard,a.hphone,a.phone,a.idcard 
From opcard as a,
opday as b 
where a.hn=b.hn AND a.regisdate like '$yrmonth%'  group by a.hn";
$querytmp2 = mysql_query($temp2) or die("Query failed,Create temp2");

$sql2="SELECT regisdate,hn,yot,name,surname,address,tambol,ampur,changwat,idguard,hphone,phone,idcard From report_person2";
$result2= mysql_query($sql2) or die("Query failed, Select report_person1 (address)");
$txt = '';
while (list ($regisdate,$hn,$yot,$name,$lname,$address,$tambol,$ampur,$province,$idguard,$hphone,$phone,$cid) = mysql_fetch_row ($result2)) {	

    // $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
    // list($hospcode)=mysql_fetch_array($sqlhos);

    $sql1 ="SELECT DISTRICT_CODE FROM `district_new`  where `DISTRICT_NAME` ='$tambol'";
    $row1 = mysql_query($sql1);
    list($cdistrict) = mysql_fetch_array($row1);
    if(empty($cdistrict)){
        $cdistrict="99";
    }else{
        $cdistrict=substr($cdistrict,4,2);
    }

    $sql2 ="SELECT AMPHUR_CODE FROM `amphur_new`  where `AMPHUR_NAME` ='$ampur'";
    $row2 = mysql_query($sql2);
    list($camphur) = mysql_fetch_array($row2);
    if(empty($camphur)){
        $camphur="99";
    }else{
        $camphur=substr($camphur,2,2);
    }


    $sql3 ="SELECT PROVINCE_CODE FROM `province_new`  where `PROVINCE_NAME` ='$province'";
    $row3 = mysql_query($sql3);
    list($cprovince) = mysql_fetch_array($row3);
    
	if(empty($cprovince)){
        $cprovince="99";
    }else{
        $cprovince=$cprovince;
    }
	
	///echo "==>".$address;
    list($address,$posmoo) = explode(" ",$address); 
	//echo "==>".$address.",,,,".$posmoo;
	$posmoo=trim($posmoo);
	
	list($textmoo,$numbermoo) = explode("ม.",$posmoo); 
	list($newmoo,$road)=explode("ถ.",$numbermoo);
   	
	if(is_numeric($newmoo)){
		if($newmoo<=100){	
			$moo = sprintf("%02d",$newmoo);
			$village=$moo;
		}else{
			$village="99";
		}
	}else{
		$village="99";
	}
	//echo "==>".$village."<br>";
	
    $addresstype="1";  //ประเภทของที่อยู่
    $housetype="9";  //ลักษณะของที่อยู่
    if(empty($hphone) || $hphone=="-"){
        $telephone="";
    }else{
        $telephone=$hphone;
    }

    if(empty($phone) || $phone=="-"){
        $mobile="";
    }else{
        $mobile=$phone;
    }

    $regis1=substr($regisdate,0,10);
    $regis2=substr($regisdate,11,19);
    list($yy,$mm,$dd)=explode("-",$regis1);
    list($hh,$ss,$ii)=explode(":",$regis2);
    $d_update=$yy.$mm.$dd.$hh.$ss.$ii;

    $inline = "$hospcode|$hn|$addresstype|$house_id|$housetype|$roomno|$condo|$num_address|$soisub|$soimain|$road|$villaname|$village|$cdistrict|$camphur|$cprovince|$telephone|$mobile|$d_update|$cid\r\n";			
    $txt .= $inline;
} //close while
$filePath = $dirPath.'/address.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|ADDRESSTYPE|HOUSE_ID|HOUSETYPE|ROOMNO|CONDO|HOUSENO|SOISUB|SOIMAIN|ROAD|VILLNAME|VILLAGE|TAMBON|AMPUR|CHANGWAT|TELEPHONE|MOBILE|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_address.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม address เสร็จเรียบร้อย<br>";
//-------------------- Close file address ไฟล์ที่ 2 --------------------//