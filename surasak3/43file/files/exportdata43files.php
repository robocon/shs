<?
include("../../../connect.inc");
$day="01";
$newyear="$thiyr$rptmo$day";
$thimonth="$thiyr-$rptmo";
$thiyr=$thiyr-543;
$yrmonth="$thiyr-$rptmo";
$yy=543;

// ลบไฟล์ก่อน-----------------)
$filename1 = "person.txt";
$filename2=  "address.txt";
$filename3=  "death.txt";
$filename4 = "card.txt";
$filename5 = "drugallergy.txt";
//$filename6 = "home.txt";
$filename7 = "service.txt";
$filename8 = "appointment.txt";
$filename9 = "accident.txt";
$filename10 = "diagnosis_opd.txt";
$filename11 = "procedure_opd.txt";
$filename12=  "drug_opd.txt";
$filename13=  "charge_opd.txt";
$filename14 = "admission.txt";
$filename15 = "diagnosis_ipd.txt";
$filename16 = "procedure_ipd.txt";
$filename17 = "drug_ipd.txt";
$filename18 = "charge_ipd.txt";
/*$filename19 = "surveillance.txt";
$filename20 = "women.txt";
$filename21 = "fp.txt";*/
$filename22=  "epi.txt";
/*$filename23=  "nutrition.txt";
$filename24 = "prenatal.txt";
$filename25 = "anc.txt";
$filename26 = "labor.txt";
$filename27 = "postnatal.txt";
$filename28 = "newborn.txt";
$filename29 = "newborncare.txt";
$filename30 = "dental.txt";
$filename31 = "specialpp.txt";
$filename32=  "ncdscreen.txt";
$filename33=  "chronic.txt";
$filename34 = "chronicfu.txt";
$filename35 = "labfu.txt";
$filename36 = "community_service.txt";
$filename37 = "disability.txt";
$filename38 = "icf.txt";
$filename39 = "functional.txt";
$filename40 = "rehabilitation.txt";
$filename41 = "village.txt";
$filename42=  "community_activity.txt";
$filename43=  "provider.txt";*/

if(unlink("$filename1") && unlink("$filename2") && unlink("$filename3") && unlink("$filename4") && unlink("$filename5") && unlink("$filename7") && unlink("$filename8") && unlink("$filename9") && unlink("$filename10") && unlink("$filename11") && unlink("$filename12") && unlink("$filename13") && unlink("$filename14") && unlink("$filename15") && unlink("$filename16") && unlink("$filename17") && unlink("$filename18") && unlink("$filename22")){ 
	echo "ลบไฟล์เรียบร้อย <br>";
}												
// จบ ลบไฟล์-----------------)
?>

<?
//-------------------- Create file person ไฟล์ที่ 1 --------------------//
$temp1="CREATE  TEMPORARY  TABLE report_person1 SELECT a.regisdate, a.hn, a.dbirth, a.sex, a.married, a.career, a.nation, a.idcard, b.thidate, a.yot, a.name, a.surname, a.education, a.religion, a.blood, a.idguard
FROM opcard AS a, opday AS b where a.hn=b.hn AND b.thidate like '$thimonth%'  group by a.hn";
$querytmp1 = mysql_query($temp1) or die("Query failed,Create temp1");

$sql1="SELECT regisdate,hn,dbirth,sex,married,career,nation,idcard,thidate,yot,name,surname,education,religion, blood,idguard From report_person1";
$result1 = mysql_query($sql1) or die("Query failed, Select report_person1 (person)");
while (list ($regisdate,$hn,$dob,$sex,$marringe,$caree,$nation,$id,$thidate,$yot,$name,$lname,$education,$religion,$blood,$idguard) = mysql_fetch_row ($result1)) {		

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	if(empty($id) || $id=="-"){
		$cid="";
		$fstatus="";  //สถานะในครอบครัว
		$vstatus="";  //สถานะในชุมชน		
	}else{
		$cid=$id;
		$fstatus="2";  //สถานะในครอบครัว
		$vstatus="5";  //สถานะในชุมชน		
	}
	
	if(empty($dob)){
		$birth=date("Y")."0101";
	}else{
		list($by,$bm,$bd)=explode("-",$dob);
		$by=$by-543;
		$birth="$by$bm$bd";
	}
   	$occupa1=substr($occupa,0,2);
	if($sex=="ช"){ $sex="1";}else{ $sex="2";}
	
	if($marringe=="โสด"){$mstatus="1";} 
	else if($marringe=="สมรส"){$mstatus="2";} 
	else if($marringe=="หม้าย"){$mstatus="3";} 
	else if($marringe=="หย่า"){$mstatus="4";} 
	else if($marringe=="แยก"){$marringe1="5";} 
	else if($marringe=="สมณะ"){$mstatus="6";} 
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
	
	$sql ="select code from occupa where detail like '%$career%'  ";  //ตารางอาชีพใหม่
	$row = mysql_query($sql);
	list($occ_new) = mysql_fetch_array($row);
	if($occ_new==""){
		$occ_new="9629";
	}




	if($religion=="พุทธ"||$religion=="ศาสนาพุทธ"){
		$religion="01";
	}else if($religion=="อิสลาม"||$religion=="ศาสนาอิสลาม"){
		$religion="02";
	}else if($religion=="คริสต์"||$religion=="ศาสนาคริสต์"){
		$religion="03";
	}else{
		$religion="99";
	}

	$regis1=substr($regisdate,0,10);
	$regis2=substr($regisdate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$movein="$yy$mm$dd";  //วันที่ย้ายเข้ามาในเขตพื้นที่
	$ddischarge="$yy$mm$dd";  //วันที่จำหน่าย
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

$typearea="1";  //สถานะบุคคล
$race="999";  //เชื้อชาติ
$nation="999";  //สัญชาติ
$education="09";  //ระดับการศึกษา
$discharge="9";  //สถานะ/สาเหตุการจำหน่าย
$strText1="$hospcode|$cid|$hn|$hid|$pername|$name|$lname|$hn|$sex|$birth|$mstatus|$occ_old|$occ_new|$race|$nation1|$religion|$education|$fstatus|$father|$mother|$couple|$vstatus|$movein|$discharge|$ddischarge|$abogroup|$rhgroup|$labor|$passport|$typearea|$d_update\r\n";	

$strFileName1 = "person.txt";
$objFopen1 = fopen($strFileName1, 'a');
fwrite($objFopen1, $strText1);

if($objFopen1){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen1);
} //close while
//-------------------- Close create file person --------------------//
?>


<?
//-------------------- Create file address ไฟล์ที่ 2 --------------------//
$temp2="CREATE TEMPORARY TABLE report_person2 SELECT a.regisdate,a.hn,a.yot,a.name,a.surname,a.address,a.tambol,a.ampur,a.changwat,a.idguard,a.hphone,a.phone From opcard as a,opday as b where a.hn=b.hn AND a.regisdate like '$yrmonth%'  group by a.hn";
//echo $temp2;
$querytmp2 = mysql_query($temp2) or die("Query failed,Create temp2");

$sql2="SELECT regisdate,hn,yot,name,surname,address,tambol,ampur,changwat,idguard,hphone,phone From report_person2";

$result2= mysql_query($sql2) or die("Query failed, Select report_person1 (address)");
while (list ($regisdate,$hn,$yot,$name,$lname,$address,$tambol,$ampur,$province,$idguard,$hphone,$phone) = mysql_fetch_row ($result2)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);

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
$subadd = explode(" ",$address); 
$num_address = $subadd[0];
$posmoo = strpos($address,"ม.");
if($posmoo!=false){
	$moo = substr($address,$posmoo+2,2);
	if($moo<=9){
		$moo = "0".$moo;
	}
}

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

$strText2="$hospcode|$hn|$addresstype|$house_id|$housetype|$roomno|$condo|$num_address|$soisub|$soimain|$road|$villaname|$moo|$cdistrict|$camphur|$cprovince|$telephone|$mobile|$d_update\r\n";			
	
$strFileName2 = "address.txt";
$objFopen2 = fopen($strFileName2, 'a');
fwrite($objFopen2, $strText2);
			
if($objFopen2){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen2);
} //close while
//-------------------- Close file address ไฟล์ที่ 2 --------------------//
?>


<?
//-------------------- Create file death ไฟล์ที่ 3 --------------------//
$temp3="CREATE  TEMPORARY  TABLE report_death SELECT date,dcdate,hn,an,icd10,doctor  From ipcard where dctype like '%dead%' and dcdate like '$thimonth%' and dcdate is not null";
$querytmp3 = mysql_query($temp3) or die("Query failed,Create temp3");

$sql3="SELECT date,dcdate,hn,an,icd10,doctor From report_death";
$result3= mysql_query($sql3) or die("Query failed, Select report_death (death)");
while (list ($date,$dcdate,$hn,$an,$icd10,$doctor) = mysql_fetch_row ($result3)) {	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$chkdate=substr($date,0,10);	
	$sqlopd="select vn from opday where thidate like '$chkdate%' and hn='$hn'";
	//echo $sqlopd."<br>";
	$resultopd=mysql_query($sqlopd);	
	list($vn)=mysql_fetch_array($resultopd);	

$dateseq=substr($date,0,10);
$timeseq=substr($date,11,19);
list($yy,$mm,$dd)=explode("-",$dateseq);
$yy=$yy-543;
$date_serv="$yy$mm$dd";

$vn=sprintf("%03d",$vn);
$seq=$date_serv.$vn;	  //ลำดับที่


$regis1=substr($dcdate,0,10);
$regis2=substr($dcdate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
list($hh,$ss,$ii)=explode(":",$regis2);
$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
$ddeath="$yy$mm$dd";  //วันที่ตาย

$cdeath_a=$icd10;  //รหัสโรคที่เป็นสาเหตุการตาย
$cdeath=$icd10;  //สาเหตุการตาย
$pregdeath="9";  //การตังครรภ์และการคลอด
$pdeath="1";  //สถานที่ตาย

$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
list($doctorcode)=mysql_fetch_array($sqldoc);
if(empty($doctorcode)){
$provider=$date_serv.$vn."00000";
}else{
$provider=$date_serv.$vn.$doctorcode;
}

$strText3="$hospcode|$hn|$hospcode|$an|$seq|$ddeath|$cdeath_a|$cdeath_b|$cdeath_c|$cdeath_d|$odisease|$cdeath|$pregdeath|$pdeath|$provider|$d_update\r\n";				
$strFileName3 = "death.txt";
$objFopen3 = fopen($strFileName3, 'a');
fwrite($objFopen3, $strText3);
			
if($objFopen3){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen3);
}  //close while
//-------------------- Close file death ไฟล์ที่ 3 --------------------//
?>


<?
//-------------------- Create file card ไฟล์ที่ 4 --------------------//
$temp4="CREATE  TEMPORARY  TABLE report_card SELECT regisdate, hn, ptright,ptrightdetail,hospcode FROM opcard WHERE regisdate like '$yrmonth%' ORDER BY regisdate ASC";
//echo $temp4;
$querytmp4 = mysql_query($temp4) or die("Query failed,Create temp4");

$sql4="SELECT regisdate,hn,ptright,ptrightdetail,hospcode From report_card";
$result4= mysql_query($sql4) or die("Query failed, Select report_card (card)");
$num=mysql_num_rows($result4);
//echo "$num <br>";
while (list ($regisdate,$hn,$ptright,$ptrightdetail,$main) = mysql_fetch_row ($result4)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);

$regis1=substr($regisdate,0,10);
$regis2=substr($regisdate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
list($hh,$ss,$ii)=explode(":",$regis2);
$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

	
/*$newptright=substr($ptright,0,3);
if($newptright=="R01" || $newptright=="R05"){  //เงินสด
	$instype_new="9100";  //ประเภทสิทธิการรักษา
}else if($newptright=="R02" || $newptright=="R03"  || $newptright=="R04"){  //โครงการเบิกจ่ายตรง
	$instype_new="1100";  //ประเภทสิทธิการรักษา
}else if($newptright=="R06"){  //พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ
	$instype_new="6100";  //ประเภทสิทธิการรักษา
}else if($newptright=="R07"){  //ประกันสังคม
	$instype_new="4200";  //ประเภทสิทธิการรักษา
}else if($newptright=="R09"){  //ประกันสุขภาพถ้วนหน้า
	$instype_new="0100";  //ประเภทสิทธิการรักษา
}*/

$sqlptr = "Select code From  ptrightdetail where detail='$ptrightdetail'";
$resultptr = mysql_query($sqlptr) or die(mysql_error());
list($instype_new) = mysql_fetch_row($resultptr);
	
$inside="";  //เลขที่บัตรตามสิทธิ
$startdate="";  //วันเดือนปีที่ออกบัตร
$expiredate="";  //วันเดือนปีที่หมดอายุ
$main=substr($main,0,5);  //สถานบริการหลัก
$sub=substr($main,0,5);  //สถานบริการรอง
$strText4="$hospcode|$hn|$instype_old|$instype_new|$inside|$startdate|$expiredate|$main|$sub|$d_update\r\n";	
$strFileName4 = "card.txt";
$objFopen4 = fopen($strFileName4, 'a');
fwrite($objFopen4, $strText4);
			
if($objFopen4){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen4);
}  //close while
//-------------------- Close file card ไฟล์ที่ 4 --------------------//
?>


<?
//-------------------- Create file drugallergy ไฟล์ที่ 5 --------------------//
$temp5="CREATE  TEMPORARY  TABLE report_drugallergy1 SELECT a.regisdate, a.hn
FROM opcard AS a, opday AS b where a.hn=b.hn AND a.regisdate like '$yrmonth%'  group by a.hn";
//echo $temp5;
$querytmp5 = mysql_query($temp5) or die("Query failed,Create temp5");

$temp51="CREATE  TEMPORARY  TABLE report_drugallergy2 SELECT date,hn,drugcode,tradname,advreact,asses,reporter
FROM drugreact where date like '$thimonth%'";
//echo $temp51;
$querytmp51 = mysql_query($temp51) or die("Query failed,Create temp51");

$sql5="SELECT a.regisdate,b.date,b.hn,b.drugcode,b.tradname,b.advreact,b.asses,b.reporter From report_drugallergy1 as a inner join report_drugallergy2 as b on a.hn=b.hn";
$result5= mysql_query($sql5) or die("Query failed, Select report_drugallergy (drugallergy)");
$num=mysql_num_rows($result5);
//echo "$num <br>";
while (list ($regisdate,$date,$hn,$drugcode,$tradname,$advreact,$asses,$reporter) = mysql_fetch_row ($result5)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);

$sqldrug=mysql_query("select drugcode,tradname,code24 from druglst where tradname like '%$tradname%'");
list($dcode,$dname,$drugallergy)=mysql_fetch_array($sqldrug);	
	
$date=substr($date,0,10);
list($yy,$mm,$dd)=explode("-",$date);
$yy=$yy-543;
$daterecord="$yy$mm$dd";

$regis1=substr($regisdate,0,10);
$regis2=substr($regisdate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
list($hh,$ss,$ii)=explode(":",$regis2);
$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

$typedx="";  //ประเภทการวินิจฉัย
$alevel=$asses;  //ระดับความรุนแรง
$symptom=$advreact;  //ลักษณะอาการ
$informant="1";  //ผู้ให้ประวัติการแพ้


$strText5="$hospcode|$hn|$daterecord|$drugallergy|$dname|$typedx|$alevel|$symptom|$informant|$hospcode|$d_update\r\n";	
	
$strFileName5 = "drugallergy.txt";
$objFopen5 = fopen($strFileName5, 'a');
fwrite($objFopen5, $strText5);
				
if($objFopen5){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen5);
}  //close while	
//-------------------- Close create file drugallergy --------------------//
?>


<?
//-------------------- Create file home ไฟล์ที่ 6 --------------------//
/*$strText6="test\r\n";			
$strFileName6 = "home.txt";
$objFopen6 = fopen($strFileName6, 'a');
fwrite($objFopen6, $strText6);
				
if($objFopen6){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen6);		*/			
//-------------------- Close create file home --------------------//
?>


<?
//-------------------- Create file service ไฟล์ที่ 7 --------------------//
$temp7="CREATE  TEMPORARY  TABLE report_service SELECT thidate, hn, vn, an, ptname, ptright, goup, toborow FROM opday WHERE thidate like '$thimonth%' ORDER BY thidate ASC";
//echo $temp7;
$querytmp7 = mysql_query($temp7) or die("Query failed,Create temp7");

$temp71="CREATE TEMPORARY TABLE report_serviceopacc SELECT date,paid,hn,credit,txdate FROM opacc WHERE txdate LIKE '$thimonth%' ";
$querytmp71 = mysql_query($temp71) or die("Query failed,Create temp71");

$sql7="SELECT thidate, hn, vn, an, ptname, ptright, goup, toborow From report_service";
$result7= mysql_query($sql7) or die("Query failed, Select report_service (service)");
$num=mysql_num_rows($result7);
//echo "$num <br>";
while (list ($thidate,$hn,$vn,$an,$ptname,$ptright,$goup,$toborow) = mysql_fetch_row ($result7)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$sqlpt=mysql_query("select ptrightdetail from opcard where hn='$hn'");
	list($ptrightdetail)=mysql_fetch_array($sqlpt);
	
	
$chkdate=substr($thidate,0,10);	
$sqlopd="select temperature, pause, rate, bp1, bp2, organ from opd where thidate like '$chkdate%' and hn='$hn' and vn='$vn' order by thidate asc";
$resultopd=mysql_query($sqlopd);
$num=mysql_num_rows($resultopd);
//echo "==>$num <br>";
list($btemp,$pr,$rr,$sbp,$dbp,$organ)=mysql_fetch_array($resultopd);	

$sql = "Select sum(paid),credit From report_serviceopacc where hn = '$hn' and txdate like '$thimonth%'  ";
list($price,$credit)  = mysql_fetch_row(mysql_query($sql));
	
$sql1 = "Select sum(paid) From report_serviceopacc where hn = '$hn' and txdate like '$thimonth%' and credit = 'เงินสด' ";
list($paycash)  = mysql_fetch_row(mysql_query($sql1));
$payprice=$paycash;
if(empty($payprice) || $payprice==0){
$payprice="0.00";
}
$actualpay=$paycash;
if(empty($actualpay) || $actualpay==0){
$actualpay="0.00";
}	
$date=substr($date,0,10);
list($yy,$mm,$dd)=explode("-",$date);
$yy=$yy-543;
$daterecord="$yy$mm$dd";

$regis1=substr($thidate,0,10);
$regis2=substr($thidate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
list($hh,$ss,$ii)=explode(":",$regis2);
$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
$time_serv="$hh$ss$ii";  //เวลาที่มารับบริการ

$vn=sprintf("%03d",$vn);
$seq=$date_serv.$vn;	  //ลำดับที่

$location="1";  //ที่ตั้งของที่อยู่ผู้มารับบริการ
if($toborow=="EX04 ผู้ป่วยนัด"){
		$typein="2";  //ประเภทการมารับบริการ
		$intime="1";  //เวลามารับบริการ
}else if($toborow=="EX11 รักษาโรคนอกเวลาราชการ"){
		$typein="1";  //ประเภทการมารับบริการ
		$intime="2";  //เวลามารับบริการ
}else  if($toborow=="EX01 รักษาโรคทั่วไปในเวลาราชการ"){
		$typein="1";  //ประเภทการมารับบริการ
		$intime="1";	  //เวลามารับบริการ	
}else{
		$typein="1";  //ประเภทการมารับบริการ
		$intime="1";  //เวลามารับบริการ
	}
	
/*$newptright=substr($ptright,0,3);
if($newptright=="R01" || $newptright=="R05"){  //เงินสด
	$instype="9100";  //ประเภทสิทธิการรักษา
}else if($newptright=="R02" || $newptright=="R03"  || $newptright=="R04"){  //โครงการเบิกจ่ายตรง
	$instype="1100";  //ประเภทสิทธิการรักษา
}else if($newptright=="R06"){  //พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ
	$instype="6100";  //ประเภทสิทธิการรักษา
}else if($newptright=="R07"){  //ประกันสังคม
	$instype="4200";  //ประเภทสิทธิการรักษา
}else if($newptright=="R09"){  //ประกันสุขภาพถ้วนหน้า
	$instype="0100";  //ประเภทสิทธิการรักษา
}*/

$sqlptr = "Select code From  ptrightdetail where detail='$ptrightdetail'";
$resultptr = mysql_query($sqlptr) or die(mysql_error());
list($instype) = mysql_fetch_row($resultptr);

if(!empty($an)){  //สถานะผู้มารับบริการ
	$typeout="2";    //รับไว้รักษาต่อ
}else{
	$typeout="1";  //กลับบ้าน
}
		
$insid="";  //เลขที่บัตรตามสิทธิ
$causein="1";  //สาเหตุการส่งผู้ป่วย
$servplace="1";  //สถานที่บริการ
$referouthos="";  //สถานพยาบาลที่ส่งต่อ

$organ1 = str_replace("/\r\n|\r|\n/","<br/>|<br>",$organ);
$organ2=(string)$organ1;
$chiefcomp=ereg_replace('[[:space:]]+', '', trim($organ2)); 

if(empty($price) || $price=="0.00"){
	$price="50.00";
}

$strText7="$hospcode|$hn|$hn|$seq|$date_serv|$time_serv|$location|$intime|$instype|$insid|$hospcode|$typein|$hospcode|$causein|$chiefcomp|$servplace|$btemp|$sbp|$dbp|$pr|$rr|$typeout|$referouthos|$caseout|$cost|$price|$payprice|$actualpay|$d_update\r\n";			
	
$strFileName7 = "service.txt";
$objFopen7 = fopen($strFileName7, 'a');
fwrite($objFopen7, $strText7);
			
if($objFopen7){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen7);
}  //close while
//-------------------- Close file service ไฟล์ที่ 7 --------------------//
?>


<?
//-------------------- Create file appointment ไฟล์ที่ 8 --------------------//
$temp8="CREATE  TEMPORARY  TABLE report_appointment SELECT date,hn,appdate,doctor,detail,depcode From  appoint where date like '$thimonth%' ORDER BY date ASC";
//echo $temp8;
$querytmp8 = mysql_query($temp8) or die("Query failed,Create temp8");

$sql8="SELECT date,hn,appdate,doctor,detail,depcode From report_appointment";
$result8= mysql_query($sql8) or die("Query failed, Select report_appointment (appoint)");
$num=mysql_num_rows($result8);
//echo "$num <br>";
while (list ($date,$hn,$appdate,$doctor,$detail,$depcode) = mysql_fetch_row ($result8)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
$chkdate=substr($date,0,10);	
$sqlopd="select vn,clinic,icd10 from opday where thidate like '$chkdate%' and hn='$hn'";
$resultopd=mysql_query($sqlopd);	
list($vn,$cliniccode,$apdiag)=mysql_fetch_array($resultopd);

$sqlipa="select an from ipcard where dcdate like '$chkdate%' and hn='$hn'";
$resultipa=mysql_query($sqlipa);	
list($an)=mysql_fetch_array($resultipa);	

$newclinic=substr($cliniccode,0,2);
if($newclinic==""){ $newclinic="99";}else{ $newclinic=$newclinic;}
if(!empty($vn)){ $firstcode="0";}
$treecode="00";
$clinic=$firstcode.$newclinic.$treecode;

$lenappdate=strlen($appdate);
if($lenappdate < 12){
list($app1,$app2,$app3)=explode("-",$appdate);
list($yapp,$mapp,$dapp)=explode("-",$appdate);
$yapp=$yapp-543;
$apdate=$yapp.$mapp.$dapp;	
}else{
list($app1,$app2,$app3)=explode(" ",$appdate);
if($app2=="มกราคม"){ $app2="01";}
if($app2=="กุมภาพันธ์"){ $app2="02";}
if($app2=="มีนาคม"){ $app2="03";}
if($app2=="เมษายน"){ $app2="04";}
if($app2=="พฤษภาคม"){ $app2="05";}
if($app2=="มิถุนายน"){ $app2="06";}
if($app2=="กรกฎาคม"){ $app2="07";}
if($app2=="สิงหาคม"){ $app2="08";}
if($app2=="กันยายน"){ $app2="09";}
if($app2=="ตุลาคม"){ $app2="10";}
if($app2=="พฤศจิกายน"){ $app2="11";}
if($app2=="ธันวาคม"){ $app2="12";}
if($app3=="2557"){ $app3="2014";}
$apdate=$app3.$app2.$app1;
}

$regis1=substr($date,0,10);
$regis2=substr($date,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
list($hh,$ss,$ii)=explode(":",$regis2);
$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
$vn=sprintf("%03d",$vn);
$seq=$date_serv.$vn;	  //ลำดับที่

$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
list($doctorcode)=mysql_fetch_array($sqldoc);
if(empty($doctorcode)){
$provider=$date_serv.$vn."00000";
}else{
$provider=$date_serv.$vn.$doctorcode;
}

$strText8="$hospcode|$hn|$an|$seq|$date_serv|$clinic|$apdate|$aptype|$apdiag|$provider|$d_update\r\n";	
$strFileName8 = "appointment.txt";
$objFopen8 = fopen($strFileName8, 'a');
fwrite($objFopen8, $strText8);
			
if($objFopen8){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen8);
}  //close while
//-------------------- Close file appointment ไฟล์ที่ 8 --------------------//
?>

<?
//-------------------- Create file accident ไฟล์ที่ 9 --------------------//
$temp9="CREATE  TEMPORARY  TABLE report_accident SELECT  date,hn,date_in,time_in,type_accident,sender,type_wounded,wounded_vehicle,wounded_detail,spirits,belt,helmet,accident_detail  From  trauma where hn !='' and date_in like '$thimonth%' ORDER BY date ASC";
//echo $temp9;
$querytmp9 = mysql_query($temp9) or die("Query failed,Create temp9");

$sql9="SELECT date,hn,date_in,time_in,type_accident,sender,type_wounded,wounded_vehicle,wounded_detail,spirits,belt,helmet,accident_detail  From report_accident";
$result9= mysql_query($sql9) or die("Query failed, Select report_accident (accident)");
$num=mysql_num_rows($result9);
//echo "$num <br>";
while (list ($date,$hn,$appdate,$doctor,$type_accident,$depcode,$urgency,$wounded_vehicle,$wounded_detail,$spirits,$belt,$helmet,$accident_detail) = mysql_fetch_row ($result9)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$chkdate=substr($appdate,0,10);	
	$sqlopd="select vn from opday where thidate like '$chkdate%' and hn='$hn'";
	//echo $sqlopd."<br>";
	$resultopd=mysql_query($sqlopd);	
	list($vn)=mysql_fetch_array($resultopd);

$regis1=substr($date,0,10);
$regis2=substr($date,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
list($hh,$ss,$ii)=explode(":",$regis2);
$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
$datetime_serv="$yy$mm$dd$hh$ss$ii";  //วันที่และเวลามารับบริการ
$datetime_ae="$yy$mm$dd$hh$ss$ii";  //วันที่และเวลาที่เกิดอุบัติเหตุ


list($yy1,$mm1,$dd1)=explode("-",$appdate);
$yy1=$yy1-543;
$date_serv="$yy1$mm1$dd1";  //วันที่มารับบริการ
$vn=sprintf("%03d",$vn);
$seq=$date_serv.$vn;	  //ลำดับที่

$aeplace="99";  //สถานที่เกิดอุบัติเหตุ
$nacrotic_drug="9";  //การใช้สารเสพติด

if($sender=="1"){
	$typein_ae="1";
}else if($sender=="2"){
	$typein_ae="4";
}else if($sender=="3"){
	$typein_ae="3";
}else if($sender=="4"){
	$typein_ae="2";
}else if($sender=="5"){
	$typein_ae="7";	
}else{
	$typein_ae="9";	
}

if($wounded_vehicle=="V01"){
	$vehicle="01";
}else if($wounded_vehicle=="V02"){
	$vehicle="02";
}else if($wounded_vehicle=="V12"){
	$vehicle="03";
}else if($wounded_vehicle=="V03"){
	$vehicle="04";
}else if($wounded_vehicle=="V04"){
	$vehicle="05";
}else if($wounded_vehicle=="V11"){
	$vehicle="06";
}else if($wounded_vehicle=="V07"){
	$vehicle="07";
}else if($wounded_vehicle=="V08"){
	$vehicle="08";	
}else if($wounded_vehicle=="V05" || $wounded_vehicle=="V06"){
	$vehicle="09";			
}else if($wounded_vehicle=="V09"){
	$vehicle="98";
}else if($wounded_vehicle=="V10" || $wounded_vehicle=="0"){
	$vehicle="99";				
}else{
	$vehicle="99";	
}

if($wounded_vehicle=="W01"){
	$traffic="1";
}else if($wounded_vehicle=="W02"){
	$traffic="2";
}else if($wounded_vehicle=="W03"){
	$traffic="3";
}else if($wounded_vehicle=="W04" || $wounded_vehicle=="0"){
	$traffic="9";				
}else{
	$traffic="9";	
}

if($spirits=="1"){
	$alcohol="1";
}else if($spirits=="0"){
	$alcohol="2";
}else if($spirits=="2"){
	$alcohol="9";
}else{
	$alcohol="9";
}

if($belt=="1"){
	$belt="1";
}else if($belt=="0"){
	$belt="2";
}else if($belt=="2"){
	$belt="9";
}else{
	$belt="9";
}		

if($helmet=="1"){
	$helmet="1";
}else if($helmet=="0"){
	$helmet="2";
}else if($helmet=="2"){
	$helmet="9";
}else{
	$helmet="9";
}

if($type_accident=="1"){
	$aetype="01";
}else if($type_accident=="2"){
	if($accident_detail=="A02"){
		$aetype="02";
	}else if($accident_detail=="A03"){
		$aetype="03";
	}else if($accident_detail=="A04"){
		$aetype="04";
	}else if($accident_detail=="A05"){
		$aetype="05";
	}else if($accident_detail=="A06"){
		$aetype="06";
	}else if($accident_detail=="A03"){
		$aetype="03";
	}else if($accident_detail=="A07"){
		$aetype="07";
	}else if($accident_detail=="A08"){
		$aetype="08";
	}else if($accident_detail=="A03"){
		$aetype="03";
	}else if($accident_detail=="A09"){
		$aetype="09";
	}else if($accident_detail=="A10"){
		$aetype="10";
	}else if($accident_detail=="A11"){
		$aetype="11";
	}else if($accident_detail=="A12"){
		$aetype="12";
	}else if($accident_detail=="A13"){
		$aetype="13";
	}else if($accident_detail=="A14"){
		$aetype="14";
	}else if($accident_detail=="A15"){
		$aetype="15";
	}else if($accident_detail=="A16"){
		$aetype="16";
	}else if($accident_detail=="A17"){
		$aetype="17";		
	}else if($accident_detail=="A18"){
		$aetype="18";																																		
	}else{
		$aetype="19";
	}
}else{
	$aetype="19";
}

$airway="3";
$stopbleed="3";
$splint="3";
$fluid="3";

$strText9="$hospcode|$hn|$seq|$datetime_serv|$datetime_ae|$aetype|$aeplace|$typein_ae|$traffic|$vehicle|$alcohol|$nacrotic_drug|$belt|$helmet|$airway|$stopbleed|$splint|$fluid|$urgency|$coma_eye|$coma_speak|$coma_movement|$d_update\r\n";
$strFileName9 = "accident.txt";
$objFopen9 = fopen($strFileName9, 'a');
fwrite($objFopen9, $strText9);
if($objFopen9){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen9);		
}  //close while				
//-------------------- Close create file accident --------------------//
?>


<?
//-------------------- Create file diagnosis_opd ไฟล์ที่ 10 --------------------//
$temp10="CREATE  TEMPORARY  TABLE report_diagnosisopd SELECT thidate, hn, vn, doctor, clinic FROM opday WHERE hn !='' and thidate like '$thimonth%' ORDER BY thidate ASC";
//echo $temp10;
$querytmp10 = mysql_query($temp10) or die("Query failed,Create temp10");

$sql10="SELECT thidate, hn, vn, doctor, clinic From report_diagnosisopd";
$result10= mysql_query($sql10) or die("Query failed, Select report_diagnosisopd (diagnosis_opd)");
$num=mysql_num_rows($result10);
//echo "$num <br>";
while (list ($thidate,$hn,$vn,$doctor,$cliniccode) = mysql_fetch_row ($result10)) {	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
$chkdate=substr($thidate,0,10);	
$sqlopd="SELECT  regisdate,icd10,type From diag where hn='$hn' and svdate like '$chkdate%'";
$resultopd=mysql_query($sqlopd);	
$numopd=mysql_num_rows($resultopd);
if($numopd > 1){  //ถ้ามีหลาย record
	while(list($regisdate,$icd10,$type)=mysql_fetch_array($resultopd)){
	
	if(empty($icd10)){
	$diagcode="Z538";
	$diagtype="1";
	}else{
	$diagcode=$icd10;
	if($type=="PRINCIPLE"){ $diagtype="1";}
	if($type=="CO-MORBIDITY"){ $diagtype="2";}
	if($type=="COMPLICATION"){ $diagtype="3";}
	if($type=="OTHER"){ $diagtype="4";}
	if($type=="EXTERNAL CAUSE"){ $diagtype="5";}	
	}
	
	
	$newclinic=substr($cliniccode,0,2);
	if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
	if(!empty($vn)){ $firstcode="0";}
	$treecode="00";
	$clinic=$firstcode.$newclinic.$treecode;	
	
	$regis1=substr($thidate,0,10);
	$regis2=substr($thidate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
	
	$regis1=substr($thidate,0,10);
	$regis2=substr($thidate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
	$vn=sprintf("%03d",$vn);	
	$seq=$date_serv.$vn;	  //ลำดับที่
	
	$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
	list($doctorcode)=mysql_fetch_array($sqldoc);
	if(empty($doctorcode)){
	$provider=$date_serv.$vn."00000";
	}else{
	$provider=$date_serv.$vn.$doctorcode;
	}	
	
	$strText10="$hospcode|$hn|$seq|$date_serv|$diagtype|$diagcode|$clinic|$provider|$d_update\r\n";

		$strFileName10 = "diagnosis_opd.txt";
		$objFopen10 = fopen($strFileName10, 'a');
		fwrite($objFopen10, $strText10);
		if($objFopen10){
			/*echo "File writed.";*/
		}else{
			/*echo "File can not write";*/
		}
		fclose($objFopen10);
	}  //close while
}else{  //ถ้ามี 1 record
	list($regisdate,$icd10,$type)=mysql_fetch_array($resultopd);
	
	if(empty($icd10)){
	$diagcode="Z538";
	$diagtype="1";
	}else{
	$diagcode=$icd10;
	if($type=="PRINCIPLE"){ $diagtype="1";}
	if($type=="CO-MORBIDITY"){ $diagtype="2";}
	if($type=="COMPLICATION"){ $diagtype="3";}
	if($type=="OTHER"){ $diagtype="4";}
	if($type=="EXTERNAL CAUSE"){ $diagtype="5";}	
	}
	
	
	$newclinic=substr($cliniccode,0,2);
	if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
	if(!empty($vn)){ $firstcode="0";}
	$treecode="00";
	$clinic=$firstcode.$newclinic.$treecode;
	
	$regis1=substr($thidate,0,10);
	$regis2=substr($thidate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
	
	$regis1=substr($thidate,0,10);
	$regis2=substr($thidate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
	$vn=sprintf("%03d",$vn);	
	$seq=$date_serv.$vn;	  //ลำดับที่
	
	$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
	list($doctorcode)=mysql_fetch_array($sqldoc);
	if(empty($doctorcode)){
	$provider=$date_serv.$vn."00000";
	}else{
	$provider=$date_serv.$vn.$doctorcode;
	}	
	
	$strText10="$hospcode|$hn|$seq|$date_serv|$diagtype|$diagcode|$clinic|$provider|$d_update\r\n";

		$strFileName10 = "diagnosis_opd.txt";
		$objFopen10 = fopen($strFileName10, 'a');
		fwrite($objFopen10, $strText10);
		if($objFopen10){
			/*echo "File writed.";*/
		}else{
			/*echo "File can not write";*/
		}
		fclose($objFopen10);
	}  // close while
}  //close if
//-------------------- Close create file diagnosis_opd --------------------//
?>


<?
//-------------------- Create file procedure_opd ไฟล์ที่ 11 --------------------//
$temp11="CREATE  TEMPORARY  TABLE report_procedureopd SELECT thidate, hn, vn, doctor, clinic, icd9cm FROM opday WHERE thidate like '$thimonth%' and icd9cm != 'NA' and icd9cm != '' ORDER BY thidate ASC";
//echo $temp11;
$querytmp11 = mysql_query($temp11) or die("Query failed,Create temp11");

$sql11="SELECT thidate, hn, vn, doctor, clinic, icd9cm From report_procedureopd";
$result11= mysql_query($sql11) or die("Query failed, Select report_procedureopd (procedure_opd)");
$num=mysql_num_rows($result11);
//echo "$num <br>";
while (list ($thidate,$hn,$vn,$doctor,$cliniccode,$procedcode) = mysql_fetch_row ($result11)) {	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);


$newclinic=substr($cliniccode,0,2);
if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
if(!empty($vn)){ $firstcode="0";}
$treecode="00";
$clinic=$firstcode.$newclinic.$treecode;

$regis1=substr($thidate,0,10);
$regis2=substr($thidate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
list($hh,$ss,$ii)=explode(":",$regis2);
$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

$regis1=substr($thidate,0,10);
$regis2=substr($thidate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
$vn=sprintf("%03d",$vn);	
$seq=$date_serv.$vn;	  //ลำดับที่
	
$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
list($doctorcode)=mysql_fetch_array($sqldoc);
if(empty($doctorcode)){
$provider=$date_serv.$vn."00000";
}else{
$provider=$date_serv.$vn.$doctorcode;
}	

$serviceprice="0.00";
$strText11="$hospcode|$hn|$seq|$date_serv|$clinic|$procedcode|$serviceprice|$provider|$d_update\r\n";
$strFileName11 = "procedure_opd.txt";
$objFopen11 = fopen($strFileName11, 'a');
fwrite($objFopen11, $strText11);
			
if($objFopen11){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen11);
}  //close while
//-------------------- Close file procedure_opd ไฟล์ที่ 11 --------------------//
?>


<?
//-------------------- Create file drug_opd ไฟล์ที่ 12 --------------------//
$inj="INJ";
$status="Y";
$temp12="CREATE  TEMPORARY  TABLE report_drugopd SELECT a.date,a.hn,a.an,a.drugcode,a.tradname,a.amount,b.code24,b.unit,b.packing,b.salepri,b.unitpri FROM drugrx as a inner join druglst as b on a.drugcode=b.drugcode WHERE a.date LIKE '$thimonth%' and a.drugcode<>'$inj' and a.an is null and a.status = '$status'";
//echo $temp12;
$querytmp12 = mysql_query($temp12) or die("Query failed,Create temp12");

$sql12="SELECT date, hn, an, drugcode, tradname, amount, code24, unit, packing, salepri, unitpri From report_drugopd";
$result12= mysql_query($sql12) or die("Query failed, Select report_drugopd (drug_opd)");
$num=mysql_num_rows($result12);
//echo "$num <br>";
while (list ($date,$hn,$an,$drugcode,$dname,$amount,$didstd,$unit,$unit_packing,$drugprice,$drugcost) = mysql_fetch_row ($result12)) {	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$chkdate=substr($date,0,10);
	$sqlop=mysql_query("select thidate,vn from opday where hn ='$hn' and thidate like '$chkdate%'");
	list($thidate,$vn)=mysql_fetch_array($sqlop);


$newclinic=substr($cliniccode,0,2);
if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
if(!empty($vn)){ $firstcode="0";}
$treecode="00";
$clinic=$firstcode.$newclinic.$treecode;

$regis1=substr($thidate,0,10);
$regis2=substr($thidate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
list($hh,$ss,$ii)=explode(":",$regis2);
$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

$regis1=substr($thidate,0,10);
$regis2=substr($thidate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
$vn=sprintf("%03d",$vn);	
$seq=$date_serv.$vn;	  //ลำดับที่
	
$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
list($doctorcode)=mysql_fetch_array($sqldoc);
if(empty($doctorcode)){
$provider=$date_serv.$vn."00000";
}else{
$provider=$date_serv.$vn.$doctorcode;
}	

$strText12="$hospcode|$hn|$seq|$date_serv|$clinic|$didstd|$dname|$amount|$unit|$unit_packing|$drugprice|$drugcost|$provider|$d_update\r\n";	
$strFileName12 = "drug_opd.txt";
$objFopen12 = fopen($strFileName12, 'a');
fwrite($objFopen12, $strText12);
			
if($objFopen12){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen12);
}  //close while
//-------------------- Close file drug_opd ไฟล์ที่ 12 --------------------//
?>


<?
//-------------------- Create file charge_opd ไฟล์ที่ 13 --------------------//
$temp13="CREATE  TEMPORARY  TABLE report_chargeopd SELECT  date,hn,depart,price,paid,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,ptright,credit From opacc where date like '$thimonth%' ORDER BY date ASC";
//echo $temp13;
$querytmp13 = mysql_query($temp13) or die("Query failed,Create temp13");

$sql13="SELECT date,hn,depart,price,paid,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,ptright,credit From report_chargeopd";
$result13= mysql_query($sql13) or die("Query failed, Select report_chargeopd (charge_opd)");
$num=mysql_num_rows($result13);
//echo "$num <br>";
while (list ($date,$hn,$depart,$essd,$nessdy,$nessdn,$dpy,$dpn,$dsy,$dsn,$price,$paid,$ptright,$credit) = mysql_fetch_row ($result13)) {	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$sqlpt=mysql_query("select ptrightdetail from opcard where hn='$hn'");
	list($ptrightdetail)=mysql_fetch_array($sqlpt);	
	
	$chkdate=substr($date,0,10);
	$sqlop=mysql_query("select thidate,vn from opday where hn ='$hn' and thidate like '$chkdate%'");
	list($thidate,$vn)=mysql_fetch_array($sqlop);


$newclinic=substr($cliniccode,0,2);
if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
if(!empty($vn)){ $firstcode="0";}
$treecode="00";
$clinic=$firstcode.$newclinic.$treecode;

/*$newptright=substr($ptright,0,3);
if($newptright=="R01" || $newptright=="R05"){  //เงินสด
	$instype="9100";  //ประเภทสิทธิการรักษา
}else if($newptright=="R02" || $newptright=="R03"  || $newptright=="R04"){  //โครงการเบิกจ่ายตรง
	$instype="1100";  //ประเภทสิทธิการรักษา
}else if($newptright=="R06"){  //พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ
	$instype="6100";  //ประเภทสิทธิการรักษา
}else if($newptright=="R07"){  //ประกันสังคม
	$instype="4200";  //ประเภทสิทธิการรักษา
}else if($newptright=="R09"){  //ประกันสุขภาพถ้วนหน้า
	$instype="0100";  //ประเภทสิทธิการรักษา
}*/

$sqlptr = "Select code From  ptrightdetail where detail='$ptrightdetail'";
$resultptr = mysql_query($sqlptr) or die(mysql_error());
list($instype) = mysql_fetch_row($resultptr);


$cost="0.00";  //ราคาทุน
if($credit=="เงินสด" || $credit=="อื่นๆ"){
		$price=$price;
		$payprice=$price;
}else{
		$price=$paid;
		$payprice=$price-$paid;
}
$payprice=number_format($payprice,2);

if($depart=="PHAR"){
	if((!empty($dpy) || $dpy !="0.00") || (!empty($dpn) || $dpn !="0.00")){
		$chargeitem="02";
	}
	if((!empty($dsy) || $dsy !="0.00") || (!empty($dsn) || $dsn !="0.00")){
		$chargeitem="05";
	}	
	if((!empty($nessdy) || $nessdy !="0.00") || (!empty($nessdn) || $nessdn !="0.00")){
		$chargeitem="17";
	}	
}else if($depart=="PATHO"){
$chargeitem="07";
}else if($depart=="XRAY"){
$chargeitem="08";
}else if($depart=="HEMO"){
$chargeitem="09";
}else if($depart=="SURG"){
$chargeitem="11";
}else if($depart=="OTHER" || $depart=="EMER" || $depart=="WARD" || $depart=="EYE"){
$chargeitem="12";
}else if($depart=="DENTA"){
$chargeitem="13";
}else if($depart=="PHYSI"){
$chargeitem="14";
}else if($depart=="NID"){
$chargeitem="16";
}

$regis1=substr($thidate,0,10);
$regis2=substr($thidate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
list($hh,$ss,$ii)=explode(":",$regis2);
$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

$regis1=substr($thidate,0,10);
$regis2=substr($thidate,11,19);
list($yy,$mm,$dd)=explode("-",$regis1);
$yy=$yy-543;
$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
$vn=sprintf("%03d",$vn);	
$seq=$date_serv.$vn;	  //ลำดับที่

$chargelist="000000";
$quantity="1";

$strText13="$hospcode|$hn|$seq|$date_serv|$clinic|$chargeitem|$chargelist|$quantity|$instype|$cost|$price|$payprice|$d_update\r\n";			
$strFileName13 = "charge_opd.txt";
$objFopen13 = fopen($strFileName13, 'a');
fwrite($objFopen13, $strText13);
			
if($objFopen13){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen13);
}  //close while
//-------------------- Close file charge_opd ไฟล์ที่ 13 --------------------//
?>


<?
//-------------------- Create file admission ไฟล์ที่ 14 --------------------//
$temp14="CREATE  TEMPORARY  TABLE report_admission SELECT *  From ipcard where dcdate like '$thimonth%' and dcdate is not null";
$querytmp14 = mysql_query($temp14) or die("Query failed,Create temp14");
		
$sql14="SELECT date,an,hn,ptright,clinic,my_ward,dcdate,dcstatus,dctype,doctor  From report_admission";
$result14 = mysql_query($sql14) or die("Query failed,Select report_admission");
while (list ($date,$an,$hn,$ptright,$clinic,$my_ward,$dcdate,$dcstatus,$dctype,$doctor) = mysql_fetch_row ($result14)){	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$sqlpt=mysql_query("select ptrightdetail from opcard where hn='$hn'");
	list($ptrightdetail)=mysql_fetch_array($sqlpt);

	$sqlopd=mysql_query("select weight,height from opd where hn='$hn' order by row_id desc");
	list($admitweight,$admitheight)=mysql_fetch_array($sqlopd);
	
	$chkdate=substr($date,0,10);	
	$sqlopd1="select vn from opday where thidate like '$chkdate%' and hn='$hn'";
	$resultopd1=mysql_query($sqlopd1);	
	list($vn)=mysql_fetch_array($resultopd1);	
	
	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$regis2);
	$datetime_admit="$yy$mm$dd$hh$ss$ii";  //วันที่และเวลามารับบริการ
	
	$vn=sprintf("%03d",$vn);
	$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
	$seq=$date_serv.$vn;	  //ลำดับที่

	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
	
	$dcdate1=substr($dcdate,0,10);
	$dcdate2=substr($dcdate,11,19);
	list($yy,$mm,$dd)=explode("-",$dcdate1);
	list($hh,$ss,$ii)=explode(":",$dcdate2);
	$datetime_disch=($yy-543).$mm.$dd.$hh.$ss.$ii;	
	
	$newclinic=substr($clinic,0,2);
	if($newclinic=="12"){
		$newclinic="99";
	}
	if(!empty($clinic)){
		$wardadmit="1$newclinic00";
		$warddisch="1$newclinic00";
	}
	
/*	$newptright=substr($ptright,0,3);
	if($newptright=="R01" || $newptright=="R05"){
		$instype="9100";
	}else if($newptright=="R02" || $newptright=="R03"  || $newptright=="R04"){
		$instype="1100";
	}else if($newptright=="R06"){
		$instype="6100";
	}else if($newptright=="R07"){
		$instype="4200";
	}else if($newptright=="R09"){
		$instype="0100";
	}*/
	
$sqlptr = "Select code From ptrightdetail where detail like '%$ptrightdetail%'";
$resultptr = mysql_query($sqlptr) or die(mysql_error());
list($instype) = mysql_fetch_row($resultptr);	
	
	$typein="1";
	$dischtype=substr($dctype,0,1);
	$dischstatus=$dcstatus;
	
	$ipmonsql=mysql_query("select price,cash,credit from ipmonrep where an='$an'");
	list($price,$cash,$credit)=mysql_fetch_array($ipmonsql);
	
	if($credit=="เงินสด" || $credit=="อื่นๆ"){
		$price=$cash;
		$payprice=$cash;
		$actualpay=$cash;
	}else{
		$payprice=0;
		$actualpay=0;	
	}
	
$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
list($doctorcode)=mysql_fetch_array($sqldoc);
if(empty($doctorcode)){
$provider=$date_serv.$vn."00000";
}else{
$provider=$date_serv.$vn.$doctorcode;
}

$strText14="$hospcode|$hn|$seq|$an|$datetime_admit|$wardadmit|$instype|$typein|$referinhosp|$causein|$admitweight|$admitheight|$datetime_disch|$warddisch|$dischstatus|$dischtype|$referouthosp|$causeout|$cost|$price|$payprice|$actualpay|$provider|$d_update\r\n";	
$strFileName14 = "admission.txt";
$objFopen14 = fopen($strFileName14, 'a');
fwrite($objFopen14, $strText14);
			
if($objFopen14){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen14);
}  //close while
//-------------------- Close file admission ไฟล์ที่ 14 --------------------//
?>


<?
//-------------------- Create file diagnosis_ipd ไฟล์ที่ 15 --------------------//
$temp15="CREATE  TEMPORARY  TABLE report_admission1 SELECT *  From ipcard where dcdate like '$thimonth%' and dcdate is not null ";
$querytmp15 = mysql_query($temp15) or die("Query failed,Create temp15");
	
$sql15="SELECT  a.regisdate,a.hn,a.an,b.date,b.my_ward,b.doctor,a.icd10,a.type,a.svdate From diag as a,report_admission1 as b where a.an = b.an";
$result15 = mysql_query($sql15) or die("Query failed,Select report_admission And diag");
while (list ($regisdate,$hn,$an,$date,$my_ward,$doctor,$diagcode,$type,$svdate) = mysql_fetch_row ($result15)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$chkdate=substr($date,0,10);	
	$sqlopd1="select vn from opday where thidate like '$chkdate%' and hn='$hn'";
	//echo $sqlopd1;
	$resultopd1=mysql_query($sqlopd1);	
	list($vn)=mysql_fetch_array($resultopd1);		

	
	if($type=="PRINCIPLE"){ $diagtype="1";}
	if($type=="CO-MORBIDITY"){ $diagtype="2";}
	if($type=="COMPLICATION"){ $diagtype="3";}
	if($type=="OTHER"){ $diagtype="4";}
	if($type=="EXTERNAL CAUSE"){ $diagtype="5";}

	
	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$regis2);
	$datetime_admit="$yy$mm$dd$hh$ss$ii";  //วันที่และเวลาที่รับบริการ
	
	$vn=sprintf("%03d",$vn);
	$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
	
	$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
	list($doctorcode)=mysql_fetch_array($sqldoc);
	if(empty($doctorcode)){
	$provider=$date_serv.$vn."00000";
	}else{
	$provider=$date_serv.$vn.$doctorcode;
	}	
	
		
	if($myward=="หอผู้ป่วย ICU"){
		$warddiag="10100";
	}else if($myward=="หอผู้ป่วยสูติ"){
		$warddiag="10300";
	}else if($myward=="หอผู้ป่วยรวม"){
		$warddiag="10100";
	}else if($myward=="หอผู้ป่วยพิเศษ"){
		$warddiag="10200";
	}else{
		$warddiag="19900";
	}
	

	$regis1=substr($regisdate,0,10);
	$regis2=substr($regisdate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
	
$strText15="$hospcode|$hn|$an|$datetime_admit|$warddiag|$diagtype|$diagcode|$provider|$d_update\r\n";
$strFileName15 = "diagnosis_ipd.txt";
$objFopen15 = fopen($strFileName15, 'a');
fwrite($objFopen15, $strText15);
			
if($objFopen15){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen15);
}  //close while
//-------------------- Close file diagnosis_ipd ไฟล์ที่ 15 --------------------//
?>


<?
//-------------------- Create file procedure_ipd ไฟล์ที่ 16 --------------------//
$temp16="CREATE  TEMPORARY  TABLE report_admission2 SELECT *  From ipcard where dcdate like '$thimonth%' and dcdate is not null";
$querytmp16 = mysql_query($temp16) or die("Query failed,Create temp16");

$sql16="SELECT a.admdate,a.an,a.icd9cm,b.hn,b.clinic,b.doctor,b.date FROM  ipicd9cm as a,report_admission2 as b WHERE a.an=b.an";
$result16 = mysql_query($sql16) or die("Query failed,Select report_admission2 And ipicd9cm");
while (list ($admdate,$an,$icd9cm,$hn,$my_ward,$doctor,$date) = mysql_fetch_row ($result16)) {	

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	$procedcode=$icd9cm;
	
	$chkdate=substr($date,0,10);	
	$sqlopd1="select vn from opday where thidate like '$chkdate%' and hn='$hn'";
	//echo $sqlopd1;
	$resultopd1=mysql_query($sqlopd1);	
	list($vn)=mysql_fetch_array($resultopd1);			
	
	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$regis2);
	$datetime_admit="$yy$mm$dd$hh$ss$ii";  //วันที่และเวลาที่รับบริการ	
	
	$vn=sprintf("%03d",$vn);
	$date_serv="$yy$mm$dd";  //วันที่มารับบริการ	
	
	$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
	list($doctorcode)=mysql_fetch_array($sqldoc);
	if(empty($doctorcode)){
	$provider=$date_serv.$vn."00000";
	}else{
	$provider=$date_serv.$vn.$doctorcode;
	}	
	
	if($myward=="หอผู้ป่วย ICU"){
		$wardstay="10100";
	}else if($myward=="หอผู้ป่วยสูติ"){
		$wardstay="10300";
	}else if($myward=="หอผู้ป่วยรวม"){
		$wardstay="10100";
	}else if($myward=="หอผู้ป่วยพิเศษ"){
		$wardstay="10200";
	}else{
		$wardstay="19900";
	}	
	
	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
	
	$timestart=$datetime_admit;
	$timefinish=$datetime_admit;
	$serviceprice="0.00";
	
$strText16="$hospcode|$hn|$an|$datetime_admit|$wardstay|$procedcode|$timestart|$timefinish|$serviceprice|$provider|$d_update\r\n";					
$strFileName16 = "procedure_ipd.txt";
$objFopen16 = fopen($strFileName16, 'a');
fwrite($objFopen16, $strText16);
			
if($objFopen16){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen16);
}  //close while
//-------------------- Close file procedure_ipd ไฟล์ที่ 16 --------------------//
?>


<?
//-------------------- Create file drug_ipd ไฟล์ที่ 17 --------------------//
$temp17="CREATE  TEMPORARY  TABLE report_admission3 SELECT *  From ipcard where dcdate like '$thimonth%' and dcdate is not null";
$querytmp17 = mysql_query($temp17) or die("Query failed,Create temp17");

$sql="SELECT a.date,b.hn,a.an,a.code,a.detail,a.amount,b.date,b.dcdate,b.my_ward,b.doctor FROM ipacc as a, report_admission3 as b WHERE a.an=b.an and (part='DDL' or part='DDN' or part='DDY') group by a.code";
$result = mysql_query($sql) or die(mysql_error());
while (list ($date,$hn,$an,$code,$dname,$amount,$admdate,$dcdate,$myward,$doctor) = mysql_fetch_row ($result)) {	

	$drugsql="select code24,unit,unitpri,salepri from druglst where drugcode = '$code'";
	//echo $drugsql."--->";
	$drugquery=mysql_query($drugsql);
	list($didstd,$unitpack,$drugcost,$drugprice)=mysql_fetch_array($drugquery);
	
	$drugsql1="select min(date) from ipacc where an='$an' and code = '$code'";
	$drugquery1=mysql_query($drugsql1);
	list($datestart)=mysql_fetch_array($drugquery1);	
	$start1=substr($datestart,0,10);
	$start2=substr($datestart,11,19);
	list($yy,$mm,$dd)=explode("-",$start1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$start2);
	$datestart="$yy$mm$dd$hh$ss$ii";  //วันที่เริ่มให้ยา
		
	
	$drugsql2="select max(date) from ipacc where an='$an' and code = '$code'";
	$drugquery2=mysql_query($drugsql2);
	list($datefinish)=mysql_fetch_array($drugquery2);		
	$finish1=substr($datefinish,0,10);
	$finish2=substr($datefinish,11,19);
	list($yy,$mm,$dd)=explode("-",$finish1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$finish2);
	$datefinish="$yy$mm$dd$hh$ss$ii";  //วันที่เลิกให้ยา
	
	$typedrug="1";
		
	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);
	
	$chkdate=substr($admdate,0,10);	
	$sqlopd1="select vn from opday where thidate like '$chkdate%' and hn='$hn'";
	//echo $sqlopd1;
	$resultopd1=mysql_query($sqlopd1);	
	list($vn)=mysql_fetch_array($resultopd1);			
	
	$regis1=substr($admdate,0,10);
	$regis2=substr($admdate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$regis2);
	$datetime_admit="$yy$mm$dd$hh$ss$ii";  //วันที่และเวลาที่รับบริการ	
	
	$vn=sprintf("%03d",$vn);
	$date_serv="$yy$mm$dd";  //วันที่มารับบริการ	
	
	$sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'");
	list($doctorcode)=mysql_fetch_array($sqldoc);
	if(empty($doctorcode)){
	$provider=$date_serv.$vn."00000";
	}else{
	$provider=$date_serv.$vn.$doctorcode;
	}	
	
	if($myward=="หอผู้ป่วย ICU"){
		$wardstay="10100";
	}else if($myward=="หอผู้ป่วยสูติ"){
		$wardstay="10300";
	}else if($myward=="หอผู้ป่วยรวม"){
		$wardstay="10100";
	}else if($myward=="หอผู้ป่วยพิเศษ"){
		$wardstay="10200";
	}else{
		$wardstay="19900";
	}

	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;
	
	$datestart=$datetime_admit;  //วันที่เริ่มให้ยา
	$datefinish=$datetime_admit;  //วันสุดท้ายที่ให้ยา

$strText17="$hospcode|$hn|$an|$datetime_admit|$wardstay|$typedrug|$didstd|$dname|$datestart|$datefinish|$amount|$unit|$unitpack|$drugprice|$drugcost|$provider|$d_update\r\n";

$strFileName17 = "drug_ipd.txt";
$objFopen17 = fopen($strFileName17, 'a');
fwrite($objFopen17, $strText17);
			
if($objFopen17){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen17);
}  //close while
//-------------------- Close file drug_ipd ไฟล์ที่ 17 --------------------//
?>


<?
//-------------------- Create file charge_ipd ไฟล์ที่ 18 --------------------//
$temp18="CREATE  TEMPORARY  TABLE report_admission4 SELECT *  From ipcard where dcdate like '$thimonth%' and dcdate is not null";
$querytmp18 = mysql_query($temp18) or die("Query failed,Create temp18"); 
 
$sql="SELECT  a.date,b.hn,b.date,b.my_ward,a.an,a.depart,a.amount,a.price,a.paid,a.part From ipacc as a, report_admission4 as b where a.an=b.an and a.amount > 0";
$result = mysql_query($sql) or die("Query failed,Select report_admission4 And ipacc");
while (list ($date,$hn,$admdate,$myward,$an,$depart,$amount,$price,$paid,$part) = mysql_fetch_row ($result)) {	
	$chargelist="000000";

	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);

	$sqlpt=mysql_query("select ptrightdetail from opcard where hn='$hn'");
	list($ptrightdetail)=mysql_fetch_array($sqlpt);
	
	$sqlptr = "Select code From  ptrightdetail where detail='$ptrightdetail'";
	$resultptr = mysql_query($sqlptr) or die(mysql_error());
	list($instype) = mysql_fetch_row($resultptr);	

$cost="0.00";  //ราคาทุน

$sqlmonrep = "Select credit From  ipmonrep where an='$an'";
$resultmonrep= mysql_query($sqlmonrep) or die(mysql_error());
list($credit) = mysql_fetch_row($resultmonrep);	
if($credit=="เงินสด" || $credit=="อื่นๆ"){
		$price=$price;
		$payprice=$price;
}else{
		$price=$paid;
		$payprice=$price-$paid;
}
$payprice=number_format($payprice,2);	
$quantity=$amount;

if($depart=="PHAR"){
	if($part=="dpy" || $part=="dpn"){
		$chargeitem="02";
	}else if($part=="dsy" || $part=="dsn"){
		$chargeitem="05";
	}else if($part=="nessdy" || $part=="nessdn"){
		$chargeitem="17";
	}	
}else if($depart=="PATHO"){
$chargeitem="07";
}else if($depart=="XRAY"){
$chargeitem="08";
}else if($depart=="HEMO"){
$chargeitem="09";
}else if($depart=="SURG"){
$chargeitem="11";
}else if($depart=="OTHER" || $depart=="EMER" || $depart=="WARD" || $depart=="EYE"){
$chargeitem="12";
}else if($depart=="DENTA"){
$chargeitem="13";
}else if($depart=="PHYSI"){
$chargeitem="14";
}else if($depart=="NID"){
$chargeitem="16";
}
	
	$regis1=substr($admdate,0,10);
	$regis2=substr($admdate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$regis2);
	$datetime_admit="$yy$mm$dd$hh$ss$ii";  //วันที่และเวลาที่รับผู้ป่วย	
	
	if($myward=="หอผู้ป่วย ICU"){
		$wardstay="10100";
	}else if($myward=="หอผู้ป่วยสูติ"){
		$wardstay="10300";
	}else if($myward=="หอผู้ป่วยรวม"){
		$wardstay="10100";
	}else if($myward=="หอผู้ป่วยพิเศษ"){
		$wardstay="10200";
	}else{
		$wardstay="19900";
	}	

	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;

$strText18="$hospcode|$hn|$an|$datetime_admit|$wardstay|$chargeitem|$chargelist|$quantity|$instype|$cost|$price|$payprice|$d_update\r\n";
		
$strFileName18 = "charge_ipd.txt";
$objFopen18 = fopen($strFileName18, 'a');
fwrite($objFopen18, $strText18);
			
if($objFopen18){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen18);
}  //close while
//-------------------- Close file charge_ipd ไฟล์ที่ 18 --------------------//
?>


<?
//-------------------- Create file surveilance ไฟล์ที่ 19 --------------------//
/*$strText19="test\r\n";	
$strFileName19 = "surveilance.txt";
$objFopen19 = fopen($strFileName19, 'a');
fwrite($objFopen19, $strText19);
			
if($objFopen19){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen19);*/
//-------------------- Close file surveilance ไฟล์ที่ 19 --------------------//
?>


<?
//-------------------- Create file women ไฟล์ที่ 20 --------------------//
/*$strText20="test\r\n";			
$strFileName20 = "women.txt";
$objFopen20 = fopen($strFileName20, 'a');
fwrite($objFopen20, $strText20);
			
if($objFopen20){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen20);*/
//-------------------- Close file women ไฟล์ที่ 20 --------------------//
?>


<?
//-------------------- Create file fp ไฟล์ที่ 21 --------------------//
/*$strText21="test\r\n";	
$strFileName21 = "fp.txt";
$objFopen21 = fopen($strFileName21, 'a');
fwrite($objFopen21, $strText21);
			
if($objFopen21){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen21);*/
//-------------------- Close file fp ไฟล์ที่ 21 --------------------//
?>



<?
//-------------------- Create file epi ไฟล์ที่ 22 --------------------//
$sql22="SELECT thidate,hn,drugcode  FROM trauma_inject WHERE thidate LIKE '$thimonth%'";
$result22 = mysql_query($sql22) or die("Query Create file epi Error");
$num22=mysql_num_rows($result22);
$i=0;
while (list ($thidate,$hn,$drugcode) = mysql_fetch_row ($result22)) {	
$i++;
	$sqlhos22=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos22);
	
	$chkdate=substr($thidate,0,10);	
	$sqlopd22="select vn,doctor from opday where thidate like '$chkdate%' and hn='$hn'";
	//echo $sqlopd1;
	$resultopd22=mysql_query($sqlopd22);	
	list($vn,$doctor)=mysql_fetch_array($resultopd22);	
	$newdoctor=substr($doctor,7,10);
	
	if($drugcode=='0TT'){$vaccinetype='101';}else{$vaccinetype='111';};

	$regis1=substr($thidate,0,10);
	$regis2=substr($thidate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$yy=$yy-543;
	$d_update=$yy.$mm.$dd.$hh.$ss.$ii;

	$date_serv="$yy$mm$dd";
	$vn=sprintf("%03d",$vn);
	$seq=$date_serv.$vn;	  //ลำดับที่	
	
	$sqldoc22=mysql_query("select doctorcode from doctor where name like'%$newdoctor%'");
	list($doctorcode)=mysql_fetch_array($sqldoc22);
	if(empty($doctorcode)){
		$sqldoc22=mysql_query("select codedoctor from inputm where name like'%$doctor%'");
		list($doctorcode)=mysql_fetch_array($sqldoc22);
		if(empty($doctorcode)){
			$provider=$date_serv.$vn."00000";
		}else{
			$provider=$date_serv.$vn.$doctorcode;
		}
	}else{
		$provider=$date_serv.$vn.$doctorcode;
	}	
	
$strText22="$hospcode|$hn|$seq|$date_serv|$vaccinetype|$hospcode|$provider|$d_update\r\n";		
//echo "--->".$strText22."<br>";			
$strFileName22 = "epi.txt";
$objFopen22 = fopen($strFileName22, 'a');
fwrite($objFopen22, $strText22);
			
if($objFopen22){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen22);
}  //close while
if($num22==$i){
$sql221="SELECT date,hn,drugcode  FROM drugrx WHERE date LIKE '$thimonth%' and drugcode like '0INF2015%' and amount='1' group by hn";
$result221 = mysql_query($sql221) or die("Query Create file epi Error");
while (list ($thidate,$hn,$drugcode) = mysql_fetch_row ($result221)) {	
	$sqlhos221=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos221);
	
	$chkdate=substr($thidate,0,10);	
	$sqlopd221="select vn,doctor from opday where thidate like '$chkdate%' and hn='$hn'";
	//echo $sqlopd1;
	$resultopd221=mysql_query($sqlopd221);	
	list($vn,$doctor)=mysql_fetch_array($resultopd221);	
	$newdoctor=substr($doctor,7,10);
	
	$vaccinetype='815';

	$regis1=substr($thidate,0,10);
	$regis2=substr($thidate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$yy=$yy-543;
	$d_update=$yy.$mm.$dd.$hh.$ss.$ii;

	$date_serv="$yy$mm$dd";
	$vn=sprintf("%03d",$vn);
	$seq=$date_serv.$vn;	  //ลำดับที่	
	
	$sqldoc22=mysql_query("select doctorcode from doctor where name like'%$newdoctor%'");
	list($doctorcode)=mysql_fetch_array($sqldoc22);
	if(empty($doctorcode)){
		$sqldoc22=mysql_query("select codedoctor from inputm where name like'%$doctor%'");
		list($doctorcode)=mysql_fetch_array($sqldoc22);
		if(empty($doctorcode)){
			$provider=$date_serv.$vn."00000";
		}else{
			$provider=$date_serv.$vn.$doctorcode;
		}
	}else{
		$provider=$date_serv.$vn.$doctorcode;
	}	
	
$strText22="$hospcode|$hn|$seq|$date_serv|$vaccinetype|$hospcode|$provider|$d_update\r\n";	
//echo "===>".$strText22."<br>";			
$strFileName22 = "epi.txt";
$objFopen22 = fopen($strFileName22, 'a');
fwrite($objFopen22, $strText22);
			
if($objFopen22){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen22);
}  //close while
}  //close if $num22==$i
//-------------------- Close file epi ไฟล์ที่ 22 --------------------//
?>


<?
//-------------------- Create file nutrition ไฟล์ที่ 23 --------------------//
/*$strText23="test\r\n";				
$strFileName23 = "nutrition.txt";
$objFopen23 = fopen($strFileName23, 'a');
fwrite($objFopen23, $strText23);
			
if($objFopen23){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen23);*/
//-------------------- Close file nutrition ไฟล์ที่ 23 --------------------//
?>


<?
//-------------------- Create file prenatal ไฟล์ที่ 24 --------------------//
/*$strText24="test\r\n";	
$strFileName24 = "prenatal.txt";
$objFopen24 = fopen($strFileName24, 'a');
fwrite($objFopen24, $strText24);
			
if($objFopen24){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen24);*/
//-------------------- Close file prenatal ไฟล์ที่ 24 --------------------//
?>


<?
//-------------------- Create file anc ไฟล์ที่ 25 --------------------//
/*$strText25="test\r\n";			
$strFileName25 = "anc.txt";
$objFopen25 = fopen($strFileName25, 'a');
fwrite($objFopen25, $strText25);
			
if($objFopen25){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen25);*/
//-------------------- Close file anc ไฟล์ที่ 25 --------------------//
?>


<?
//-------------------- Create file labor ไฟล์ที่ 26 --------------------//
/*$strText26="test\r\n";			
$strFileName26 = "labor.txt";
$objFopen26 = fopen($strFileName26, 'a');
fwrite($objFopen26, $strText26);
			
if($objFopen26){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen26);*/
//-------------------- Close file labor ไฟล์ที่ 26 --------------------//
?>


<?
//-------------------- Create file postnatal ไฟล์ที่ 27 --------------------//
/*$strText27="test\r\n";		
$strFileName27 = "postnatal.txt";
$objFopen27 = fopen($strFileName27, 'a');
fwrite($objFopen27, $strText27);
			
if($objFopen27){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen27);*/
//-------------------- Close file postnatal ไฟล์ที่ 27 --------------------//
?>


<?
//-------------------- Create file newborn ไฟล์ที่ 28 --------------------//
/*$strText28="test\r\n";
				
$strFileName28 = "newborn.txt";
$objFopen28 = fopen($strFileName28, 'a');
fwrite($objFopen28, $strText28);
			
if($objFopen28){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen28);*/
//-------------------- Close file newborn ไฟล์ที่ 28 --------------------//
?>


<?
//-------------------- Create file newborncare ไฟล์ที่ 29 --------------------//
/*$strText29="test\r\n";
				
$strFileName29 = "newborncare.txt";
$objFopen29 = fopen($strFileName29, 'a');
fwrite($objFopen29, $strText29);
			
if($objFopen29){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen29);*/
//-------------------- Close file newborncare ไฟล์ที่ 19 --------------------//
?>


<?
//-------------------- Create file dental ไฟล์ที่ 30 --------------------//
/*$strText30="test\r\n";
				
$strFileName30 = "dental.txt";
$objFopen30 = fopen($strFileName30, 'a');
fwrite($objFopen30, $strText30);
			
if($objFopen30){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen30);*/
//-------------------- Close file dental ไฟล์ที่ 30 --------------------//
?>


<?
//-------------------- Create file specialpp ไฟล์ที่ 31 --------------------//
/*$strText31="test\r\n";
				
$strFileName31 = "specialpp.txt";
$objFopen31 = fopen($strFileName31, 'a');
fwrite($objFopen31, $strText31);
			
if($objFopen31){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen31);*/
//-------------------- Close file specialpp ไฟล์ที่ 31 --------------------//
?>


<?
//-------------------- Create file ncdscreen ไฟล์ที่ 32 --------------------//
/*$strText32="test\r\n";			
$strFileName32 = "ncdscreen.txt";
$objFopen32 = fopen($strFileName32, 'a');
fwrite($objFopen32, $strText32);
			
if($objFopen32){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen32);*/
//-------------------- Close file ncdscreen ไฟล์ที่ 32 --------------------//
?>


<?
//-------------------- Create file chronic ไฟล์ที่ 33 --------------------//
/*$strText33="test\r\n";				
$strFileName33 = "chronic.txt";
$objFopen33 = fopen($strFileName33, 'a');
fwrite($objFopen33, $strText33);
			
if($objFopen33){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen33);*/
//-------------------- Close file chronic ไฟล์ที่ 33 --------------------//
?>


<?
//-------------------- Create file chronicfu ไฟล์ที่ 34 --------------------//
/*$strText34="test\r\n";
$strFileName34 = "chronicfu.txt";
$objFopen34 = fopen($strFileName34, 'a');
fwrite($objFopen34, $strText34);
			
if($objFopen34){
	//echo "File writed.";
}else{
	/echo "File can not write";
}
fclose($objFopen34);*/
//-------------------- Close file chronicfu ไฟล์ที่ 34 --------------------//
?>


<?
//-------------------- Create file labfu ไฟล์ที่ 35 --------------------//
/*$strText35="test\r\n";
				
$strFileName35 = "labfu.txt";
$objFopen35 = fopen($strFileName35, 'a');
fwrite($objFopen35, $strText35);
			
if($objFopen35){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen35);*/
//-------------------- Close file labfu ไฟล์ที่ 35 --------------------//
?>


<?
//-------------------- Create file community_service ไฟล์ที่ 36 --------------------//
/*$strText36="test\r\n";
				
$strFileName36 = "community_service.txt";
$objFopen36 = fopen($strFileName36, 'a');
fwrite($objFopen36, $strText36);
			
if($objFopen36){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen36);*/
//-------------------- Close file community_service ไฟล์ที่ 36 --------------------//
?>


<?
//-------------------- Create file disability ไฟล์ที่ 37 --------------------//
/*$strText37="test\r\n";			
$strFileName37 = "disability.txt";
$objFopen37 = fopen($strFileName37, 'a');
fwrite($objFopen37, $strText37);
			
if($objFopen37){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen37);*/
//-------------------- Close file disability ไฟล์ที่ 37 --------------------//
?>


<?
//-------------------- Create file icf ไฟล์ที่ 38 --------------------//
/*$strText38="test\r\n";
$strFileName38 = "icf.txt";
$objFopen38 = fopen($strFileName38, 'a');
fwrite($objFopen38, $strText38);
			
if($objFopen38){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen38);*/
//-------------------- Close file icf ไฟล์ที่ 38 --------------------//
?>


<?
//-------------------- Create file functional ไฟล์ที่ 39 --------------------//
/*$strText39="test\r\n";		
$strFileName39 = "functional.txt";
$objFopen39 = fopen($strFileName39, 'a');
fwrite($objFopen39, $strText39);
			
if($objFopen39){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen39);*/
//-------------------- Close file functional ไฟล์ที่ 39 --------------------//
?>


<?
//-------------------- Create file rehabilitation ไฟล์ที่ 40 --------------------//
/*$strText40="test\r\n";			
$strFileName40 = "rehabilitation.txt";
$objFopen40 = fopen($strFileName40, 'a');
fwrite($objFopen40, $strText40);
			
if($objFopen40){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen40);*/
//-------------------- Close file rehabilitation ไฟล์ที่ 40 --------------------//
?>


<?
//-------------------- Create file village ไฟล์ที่ 41 --------------------//
/*$strText41="test\r\n";
				
$strFileName41 = "village.txt";
$objFopen41 = fopen($strFileName41, 'a');
fwrite($objFopen41, $strText41);
			
if($objFopen41){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen41);*/
//-------------------- Close file village ไฟล์ที่ 41 --------------------//
?>


<?
//-------------------- Create file community_activity ไฟล์ที่ 42 --------------------//
/*$strText42="test\r\n";		
$strFileName42 = "community_activity.txt";
$objFopen42 = fopen($strFileName42, 'a');
fwrite($objFopen42, $strText42);
			
if($objFopen42){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen42);*/
//-------------------- Close file community_activity ไฟล์ที่ 42 --------------------//
?>


<?
//-------------------- Create file provider ไฟล์ที่ 43 --------------------//
/*$strText43="test\r\n";				
$strFileName43 = "provider.txt";
$objFopen43 = fopen($strFileName43, 'a');
fwrite($objFopen43, $strText43);
			
if($objFopen43){
	//echo "File writed.";
}else{
	//echo "File can not write";
}
fclose($objFopen43);*/
//-------------------- Close file provider ไฟล์ที่ 43 --------------------//
?>


<?
//-------------------- Add to zip --------------------//
	$f43="F43_11512_";
	$default="090000";
	$dbfname ="$f43$newyear$default";
	$subfolder ="$f43$newyear$default";
	$ZipName = "43files/$dbfname.zip";
	require_once("dZip.inc.php"); // include Class
	$zip = new dZip($ZipName); // New Class
	$zip->addDir($subfolder); // Add Folder		
	$zip->addFile($strFileName1, $subfolder."/".$strFileName1); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName2, $subfolder."/".$strFileName2); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName3, $subfolder."/".$strFileName3); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName4, $subfolder."/".$strFileName4); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName5, $subfolder."/".$strFileName5); // ต้นทาง,ปลายทาง			
	//$zip->addFile($strFileName6, $subfolder."/".$strFileName6); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName7, $subfolder."/".$strFileName7); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName8, $subfolder."/".$strFileName8); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName9, $subfolder."/".$strFileName9); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName10, $subfolder."/".$strFileName10); // ต้นทาง,ปลายทาง
	$zip->addFile($strFileName11, $subfolder."/".$strFileName11); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName12, $subfolder."/".$strFileName12); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName13, $subfolder."/".$strFileName13); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName14, $subfolder."/".$strFileName14); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName15, $subfolder."/".$strFileName15); // ต้นทาง,ปลายทาง			
	$zip->addFile($strFileName16, $subfolder."/".$strFileName16); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName17, $subfolder."/".$strFileName17); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName18, $subfolder."/".$strFileName18); // ต้นทาง,ปลายทาง	
/*	$zip->addFile($strFileName19, $subfolder."/".$strFileName19); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName20, $subfolder."/".$strFileName20); // ต้นทาง,ปลายทาง
	$zip->addFile($strFileName21, $subfolder."/".$strFileName21); // ต้นทาง,ปลายทาง*/		
	$zip->addFile($strFileName22, $subfolder."/".$strFileName22); // ต้นทาง,ปลายทาง	
/*	$zip->addFile($strFileName23, $subfolder."/".$strFileName23); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName24, $subfolder."/".$strFileName24); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName25, $subfolder."/".$strFileName25); // ต้นทาง,ปลายทาง			
	$zip->addFile($strFileName26, $subfolder."/".$strFileName26); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName27, $subfolder."/".$strFileName27); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName28, $subfolder."/".$strFileName28); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName29, $subfolder."/".$strFileName29); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName30, $subfolder."/".$strFileName30); // ต้นทาง,ปลายทาง		
	$zip->addFile($strFileName31, $subfolder."/".$strFileName31); // ต้นทาง,ปลายทาง		
	$zip->addFile($strFileName32, $subfolder."/".$strFileName32); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName33, $subfolder."/".$strFileName33); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName34, $subfolder."/".$strFileName34); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName35, $subfolder."/".$strFileName35); // ต้นทาง,ปลายทาง			
	$zip->addFile($strFileName36, $subfolder."/".$strFileName36); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName37, $subfolder."/".$strFileName37); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName38, $subfolder."/".$strFileName38); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName39, $subfolder."/".$strFileName39); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName40, $subfolder."/".$strFileName40); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName41, $subfolder."/".$strFileName41); // ต้นทาง,ปลายทาง		
	$zip->addFile($strFileName42, $subfolder."/".$strFileName42); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName43, $subfolder."/".$strFileName43); // ต้นทาง,ปลายทาง*/							
	$zip->save();
	
	echo "ดาวน์โหลดข้อมูล 43 แฟ้ม... <a href=../files/$ZipName>คลิกที่นี่</a> <br>";
	echo "<a href='../export43files.php'><< กลับหน้าเดิม</a>";	
//-------------------- Close add to zip --------------------//
include("unconnect.inc");
?>
