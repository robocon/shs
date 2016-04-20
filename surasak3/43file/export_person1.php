<?php
include("../connect.inc");
$thiyr=$thiyr-543;
$yrmonth="$thiyr-$rptmo";
$yy=543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่1 ตาราง PERSON ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

$temp1="CREATE  TEMPORARY  TABLE report_person SELECT a.hn, a.dbirth, a.sex, a.married, a.career, a.nation, a.idcard, b.thidate, a.yot, a.name, a.surname, a.education, a.religion, a.regisdate, a.blood, a.idguard
FROM opcard AS a, opday AS b where a.hn=b.hn AND a.regisdate like '$yrmonth%'  group by a.hn";
$querytmp1 = mysql_query($temp1) or die("Query failed,Create temp1");

	$sql1="SELECT hn,dbirth,sex,married,career,nation,idcard,thidate,yot,name,surname,education,religion,regisdate, blood,idguard From report_person";
   $result1 = mysql_query($sql1) or die("Query failed, Select report_person");
    while (list ($hn,$dob,$sex,$marringe,$occupa,$nation,$id,$thidate,$yot,$name,$surname,$education,$religion,$regisdate,$blood,$idguard ) = mysql_fetch_row ($result1)) {
		
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$num2=543;
    $d=substr($dob,8,2);
    $m=substr($dob,5,2); 
    $y=substr($dob,0,4); 
	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
   	$occupa1=substr($occupa,0,2);
	if($education==""){
		$education="9";
	}
    //$dob1="$d/$m/$y2";
	$dob1="$y1$m$d";
	if($sex=='ช'){$sex1="1";} else {$sex1="2";}    ;
	if($marringe=='โสด'){$marringe1="1";} 
	else if($marringe=='สมรส'){$marringe1="2";} 
	else if($marringe=='หม้าย'){$marringe1="3";} 
	else if($marringe=='หย่า'){$marringe1="4";} 
	else if($marringe=='แยก'){$marringe1="5";} 
	else if($marringe=='สมณะ'){$marringe1="6";} 
	else {$marringe1="9";};

	if($nation=='ไทย'){$nation1="099";} else {$nation1="999";};
	$fullname=$name.' '.$surname.','.$yot;
	if(strlen($id)=="13" and substr($id,0,1) != "0"){$idtype="1";}else {$idtype="4";};

 	$career=substr($career,3);
	$career = ereg_replace('[[:space:]]+', '', trim($career)); 
	$career = str_replace(" ","",$career);
	
	$sql ="select code from occupa where detail like '%$career%'  ";
	$row = mysql_query($sql);
	list($codeocc) = mysql_fetch_array($row);
	if($codeocc==""){
		$codeocc="9629";
	}

	if($religion=='พุทธ'||$religion=='ศาสนาพุทธ'){$religion='01';}
	else{$religion='99';};

	$regis1=substr($regisdate,0,10);
	$regis2=substr($regisdate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=$yy.$mm.$dd.$hh.$ss.$ii;


  	$thidated=substr($thidate,8,2);
   	$thidatem=substr($thidate,5,2); 
 	$thidatey=substr($thidate,0,4); 
  	$thidatem1=substr($thidate,11,2); 
	$thidatem2=substr($thidate,14,2); 
    $thidatem3=substr($thidate,17,2); 

    $thidatey1= $thidatey-$num2;
  
$sql ="select code from pername where (detail1='$yot' or detail2='$yot')   ";
$row = mysql_query($sql);
list($codeyot) = mysql_fetch_array($row);

$sql ="select code from bloodgroup where (detail='$blood' or detail2='$blood')   ";
$row = mysql_query($sql);
list($codeblood) = mysql_fetch_array($row);


if(substr($idguard,0,4)== "MX04"){$dcstatus="1";}
else{$dcstatus="9";}

$typearea="1";
       echo  "$hospcode|$id|$hn|$hid|$codeyot|$name|$surname|$hn|$sex1|$dob1|$marringe1|$codeocc||000|$nation1|$religion|$education|$fstatus|$father|$mother|$couple|$vstatus|$movein|$dcstatus|$ddischarge|$codeblood|$rhgroup|$labor|$passport|$typearea|$d_update<br>";

          }
		  
  //  print "<table>";
	

    include("unconnect.inc");
?>
