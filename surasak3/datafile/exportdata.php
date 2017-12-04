<?
include("../connect.inc");
$day="01";
$newyear="$thiyr$rptmo$day";
$thimonth="$thiyr-$rptmo";
$thiyr=$thiyr-543;
$yrmonth="$thiyr-$rptmo";
$yy=543;

// ลบไฟล์ก่อน-----------------)
$filename1 = "person.txt";
$filename2=  "death.txt";
$filename3=  "chronic.txt";
$filename4 = "card.txt";
$filename5 = "service.txt";
$filename6 = "diag.txt";
$filename7 = "appoint.txt";
$filename8 = "surveil.txt";
$filename9 = "drug.txt";
$filename10 = "proced.txt";
$filename11 = "women.txt";
$filename12=  "fp.txt";
$filename13=  "epi.txt";
$filename14 = "nutri.txt";
$filename15 = "anc.txt";
$filename16 = "pp.txt";
$filename17 = "mch.txt";
$filename18 = "home.txt";
$filename19 = "ncdscreen.txt";
$filename20 = "chronicfu.txt";
$filename21 = "labfu.txt";

if(file_exists("$filename1") && file_exists("$filename2") && file_exists("$filename3") && file_exists("$filename4") && file_exists("$filename5") && file_exists("$filename6") && file_exists("$filename7") && file_exists("$filename8") && file_exists("$filename9") && file_exists("$filename10") && file_exists("$filename11") && file_exists("$filename12") && file_exists("$filename13") && file_exists("$filename14") && file_exists("$filename15") && file_exists("$filename16") && file_exists("$filename17") && file_exists("$filename18") && file_exists("$filename19") && file_exists("$filename20") && file_exists("$filename21")){
	unlink("$filename1");
	unlink("$filename2");
	unlink("$filename3");
	unlink("$filename4");
	unlink("$filename5");		
	unlink("$filename6");		
	unlink("$filename7");		
	unlink("$filename8");		
	unlink("$filename9");		
	unlink("$filename10");		
	unlink("$filename11");	
	unlink("$filename12");
	unlink("$filename13");
	unlink("$filename14");
	unlink("$filename15");		
	unlink("$filename16");		
	unlink("$filename17");		
	unlink("$filename18");		
	unlink("$filename19");		
	unlink("$filename20");	
	unlink("$filename21");											
	echo "เรียบร้อย </br>";				
}
// จบ ลบไฟล์-----------------)
?>

<?
//-------------------- Create file person ไฟล์ที่ 1 --------------------//
$sql="SELECT a.hn,a.changwat,a.ampur,a.dbirth,a.sex,a.married,a.career,a.nation,a.idcard,b.thidate,a.yot,a.name,a.surname,a.education,a.career,a.address,a.tambol,a.ampur,a.religion,b.thidate,a.blood  ,a.idguard From opcard as a,opday as b where a.hn=b.hn AND a.regisdate like '$yrmonth%'  group by a.hn";
   $result = mysql_query($sql) or die(mysql_error());
    while (list ($hn,$changwat,$amphur,$dob,$sex,$marringe,$occupa,$nation,$id,$thidate,$yot,$name,$surname,$education,$career,$address,$tambol,$ampur,$religion,$thidate,$blood,$idguard ) = mysql_fetch_row ($result)) {	
	$num1=11512;
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

$sql ="SELECT DISTRICT_CODE ,AMPHUR_CODE,PROVINCE_CODE FROM `district` INNER JOIN `amphur` ON `district`.`AMPHUR_ID` = `amphur`.`AMPHUR_ID` INNER JOIN `province` ON `amphur`.`PROVINCE_ID` = `province`.`PROVINCE_ID` where `province`.`PROVINCE_NAME`='$changwat' AND `district`.`district_name` ='$tambol' AND `amphur`.`amphur_name` = '$ampur' ";

$row = mysql_query($sql);
list($cdistrict,$camphur,$cprovince) = mysql_fetch_array($row);

$cdistrict=substr($cdistrict,4,2);
$camphur=substr($camphur,2,2);
$subadd = explode(" ",$address); 
$num_address = $subadd[0];
$posmoo = strpos($address,"ม.");
if($posmoo!=false){
	$moo = substr($address,$posmoo+2,2);
	if($moo<=9){
		$moo = "0".$moo;
	}
}

if(substr($idguard,0,4)== "MX04"){$dcstatus="1";}
else{$dcstatus="9";}

$strText1="$num1|$id|$hn||$codeyot|$name|$surname|$hn|$sex1|$dob1|$num_address|$moo|$cdistrict|$camphur|$cprovince|$marringe1|$codeocc|000|$nation1|$religion|$education||||||$dcstatus||$codeblood|||4| $thidatey1$thidatem$thidated$thidatem1$thidatem2$thidatem3\r\n";

$strFileName1 = "person.txt";
$objFopen1 = fopen($strFileName1, 'a');
fwrite($objFopen1, $strText1);

	if($objFopen1){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen1);
}  // close while
//-------------------- Close create file person --------------------//
?>


<?
//-------------------- Create file death ไฟล์ที่ 2 --------------------//
$strText2="test\r\n";
				
$strFileName2 = "death.txt";
$objFopen2 = fopen($strFileName2, 'a');
fwrite($objFopen2, $strText2);
			
	if($objFopen2){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen2);
//-------------------- Close file death ไฟล์ที่ 2 --------------------//
?>


<?
//-------------------- Create file chronic ไฟล์ที่ 3 --------------------//
$strText3="test\r\n";
				
$strFileName3 = "chronic.txt";
$objFopen3 = fopen($strFileName3, 'a');
fwrite($objFopen3, $strText3);
			
	if($objFopen3){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen3);
//-------------------- Close file chronic ไฟล์ที่ 3 --------------------//
?>


<?
//-------------------- Create file card ไฟล์ที่ 4 --------------------//
$strText4="test\r\n";
				
$strFileName4 = "card.txt";
$objFopen4 = fopen($strFileName4, 'a');
fwrite($objFopen4, $strText4);
			
	if($objFopen4){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen4);
//-------------------- Close file card ไฟล์ที่ 4 --------------------//
?>


<?
//-------------------- Create file service ไฟล์ที่ 5 --------------------//
$query="CREATE TEMPORARY TABLE reportnhso03 SELECT hn,doctor,thidate,clinic,ptname,thdatehn,vn,ptright,an FROM opday WHERE thidate LIKE '$thimonth%' ";
$result = mysql_query($query) or die("Query failed,warphar");

$query="CREATE TEMPORARY TABLE reportnhso0318 SELECT date,paid,hn,credit,txdate FROM opacc WHERE txdate LIKE '$thimonth%' ";
$result = mysql_query($query) or die("Query failed,warphar");
	
$query="SELECT 
   reportnhso03.hn,
   reportnhso03.doctor,
   date_format(reportnhso03.thidate,'%d/ %m/ %Y'),
   reportnhso03.thidate,
   opcard.idcard,
   reportnhso03.clinic, 
   reportnhso03.ptname,reportnhso03.thdatehn,reportnhso03.vn,reportnhso03.ptright,reportnhso03.an,reportnhso03.thidate,opcard.idcard FROM reportnhso03 INNER JOIN opcard ON reportnhso03.hn=opcard.hn ";
   
  $result = mysql_query($query);
    while (list ($hn,$doctor,$date,$date2,$idcard,$clinic,$full_name,$thdatehn,$vn,$ptright,$an,$date5,$cid) = mysql_fetch_row ($result)) {	
	$num1=11512;
	$num2=543;
$num4=1;
$num3=0;
    $d=substr($date,0,2);
    $m=substr($date,4,2); 
   $y=substr($date,8,4); 
    $time=substr($date5,11,8); 

   $y1=$y-$num2;
   $y2=substr($y1,2,2);
   
    $date1="$d/$m/$y2"; 
$date1="$y1$m$d";
$date2="$y-$m-$d";
   $clinic1=substr($clinic,0,2);
   $time1=substr($date2,11,2);
   $time2=substr($date2,14,2);
   $thdatehn1= substr($thdatehn,0,9);
   $vn=sprintf('%03d',$vn);
$ptright=substr($ptright,0,3);

$sql = "Select sum(paid),date From reportnhso0318 where hn = '$hn' and txdate like '$date2%'  ";
	list($paid,$date12)  = mysql_fetch_row(Mysql_Query($sql));

	$sql = "Select sum(paid) From reportnhso0318 where hn = '$hn' and txdate like '$date2%' and credit = 'เงินสด' ";
	list($paid2)  = mysql_fetch_row(Mysql_Query($sql));

if($ptright=='R09'){$ptright1="0100";} 
else if($ptright=='R10'){$ptright1="0100";}
else if($ptright=='R11'){$ptright1="0100";}
else if($ptright=='R13'){$ptright1="0100";}
else if($ptright=='R17'){$ptright1="0100";}
else if($ptright=='R07'){$ptright1="4200";}
else if($ptright=='R03'){$ptright1="1100";}
else if($ptright=='R02'){$ptright1="1100";}
else {$ptright1="9100";};

if($clinic1==''){$clinic1="99";} ;
if($paid==''){$paid="0.00";} ;
if($paid2==''){$paid2="0.00";} ;
if($an== '' ){$c1="0";} else {$c1="1";};

$num00='00';

if($time >= "08:00:00" && $time <= "15:59:59"){
	$intime = "1";
}else{
	$intime = "2";
}

if($date12!=""){
	$y5=substr($date12,0,4)-543;
    $m5=substr($date12,5,2); 
   	$d5=substr($date12,8,2); 
    $t5=substr($date12,11,2); 
	$t6=substr($date12,14,2); 
	$t7=substr($date12,17,2); 
	$date12 = "$y5$m5$d5$t5$t6$t7";
}   

		$strText5="11512|$hn|$date1$vn|$date1|2|0|$intime|$paid|$ptright1|||$paid2|0|11512|0|11512|$date12|$c1$clinic1$num00|1|$paid|$cid\r\n";
			
		$strFileName5 = "service.txt";
		$objFopen5 = fopen($strFileName5, 'a');
		fwrite($objFopen5, $strText5);
				
		if($objFopen5){
			/*echo "File writed.";*/
		}else{
			/*echo "File can not write";*/
		}
		fclose($objFopen5);	
}			
//-------------------- Close create file service --------------------//
?>


<?
//-------------------- Create file diag ไฟล์ที่ 6 --------------------//

$query="CREATE TEMPORARY TABLE reportnhso05 SELECT hn,thidate,doctor,icd10,clinic , toborow,vn,diagtype,an FROM opday WHERE thidate LIKE '$thimonth%' ";
$result = mysql_query($query) or die("Query failed,warphar");

$query="SELECT reportnhso05.hn,date_format(reportnhso05.thidate,'%d/ %m/ %Y'),reportnhso05.doctor,reportnhso05.clinic,opcard.idcard , reportnhso05.toborow,reportnhso05.vn,reportnhso05.an,reportnhso05.thidate,reportnhso05.icd10 FROM reportnhso05 LEFT JOIN opcard ON reportnhso05.hn=opcard.hn";

   $result = mysql_query($query);
    while (list ($hn,$date,$doctor,$clinic,$id,$toborow,$vn,$an,$date2,$icd10opday) = mysql_fetch_row ($result)) {	

         $sql3 = "SELECT icd10,type,svdate FROM diag WHERE svdate LIKE '".substr($date2,0,10)."%' and hn='$hn' and status='Y' and icd10!='' ";

		$rows3 = mysql_query($sql3);
		$num1 = mysql_num_rows($rows3);
		if($num1>0){
			while(list($icd10,$typediag,$svdate) =mysql_fetch_array($rows3)){
				if($typediag=="PRINCIPLE"){$type="1";}
				elseif($typediag=="CO-MORBIDITY"){$type="2";}
				elseif($typediag=="COMPLICATION"){$type="3";}
				elseif($typediag=="OTHER"){$type="4";}
				elseif($typediag=="EXTERNAL CAUSE"){$type="5";}
				
				$num1=1;
				$num3='0';
				$num2=543;
				$num00='00';
			
				$d=substr($date,0,2);
				$m=substr($date,4,2); 
				$y=substr($date,8,4); 
				$y1=$y-$num2;
				$y2=substr($y1,2,2);
				$clinic1=substr($clinic,0,2);
				
				if($icd10 == ""){
							
					if($toborow == "EX 91 ออก VN โดย กายภาพ")
						$icd10 = "Z501";
					else if(substr($toborow,0,4) == "EX01"){
						$icd10 = "Z501";
					}else if(substr($toborow,0,4) == "EX07")
						$icd10 = "Z012";
					else if(substr($toborow,0,4) == "EX11")
						$icd10 = "Z501";
					else if(substr($toborow,0,4) == "EX14")
						$icd10 = "Z018";
					else if($toborow == "ออก VN โดย LAB")
						$icd10 = "Z017";
						
				}
				
				$vn=sprintf('%03d',$vn);
				$date1="$y1$m$d";
				if($clinic1==''){$clinic1="99";} ;
				if($icd10==''){$icd10="Z532";};
				if($an== '' ){$c1="0";} else {$c1="1";};
			
				$clinicall="$c1$clinic1$num00";
				$yy = substr($svdate,0,4)-543;
				$mm = substr($svdate,5,2);
				$dd = substr($svdate,8,2);
				$hh = substr($svdate,11,2);
				$ii = substr($svdate,14,2);
				$ss = substr($svdate,17,2);
				$dateup = "$yy$mm$dd$hh$ii$ss";
				
				$strText61="11512|$hn|$date1$vn|$date1|$type|$icd10|$dateup|$clinicall|$id\r\n";
				
				$strFileName6 = "diag.txt";
				$objFopen6 = fopen($strFileName6, 'a');
				fwrite($objFopen6, $strText61);
				
					if($objFopen6){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen6);
				}
		}else{
			$icd10=$icd10opday;
			$type="1";
			$num1=1;
			$num3='0';
			$num2=543;
			$num00='00';
		
			$d=substr($date,0,2);
			$m=substr($date,4,2); 
			$y=substr($date,8,4); 
			$y1=$y-$num2;
			$y2=substr($y1,2,2);
			$clinic1=substr($clinic,0,2);
			
			if($icd10 == ""){
						
				if($toborow == "EX 91 ออก VN โดย กายภาพ")
					$icd10 = "Z501";
				else if(substr($toborow,0,4) == "EX01"){
					$icd10 = "Z501";
				}else if(substr($toborow,0,4) == "EX07")
					$icd10 = "Z012";
				else if(substr($toborow,0,4) == "EX11")
					$icd10 = "Z501";
				else if(substr($toborow,0,4) == "EX14")
					$icd10 = "Z018";
				else if($toborow == "ออก VN โดย LAB")
					$icd10 = "Z017";
					
			}
			
			$vn=sprintf('%03d',$vn);
			$date1="$y1$m$d";
			if($clinic1==''){$clinic1="99";} ;
			if($icd10==''){$icd10="Z532";};
			if($an== '' ){$c1="0";} else {$c1="1";};
		
			$clinicall="$c1$clinic1$num00";
			$yy = substr($svdate,0,4);
			$mm = substr($svdate,5,2);
			$dd = substr($svdate,8,2);
			$hh = substr($svdate,11,2);
			$ii = substr($svdate,14,2);
			$ss = substr($svdate,17,2);
			$dateup = "$yy$mm$dd$hh$ii$ss";		
			
			$strText62="11512|$hn|$date1$vn|$date1|$type|$icd10|$dateup|$clinicall|$id\r\n";
				
			$strFileName6 = "diag.txt";
			$objFopen6 = fopen($strFileName6, 'a');
			fwrite($objFopen6, $strText62);
				
				if($objFopen6){
					/*echo "File writed.";*/
				}else{
					/*echo "File can not write";*/
				}
				fclose($objFopen6);
		}	
	}				
			
//-------------------- Close create file diag --------------------//
?>


<?
//-------------------- Create file appoint ไฟล์ที่ 7 --------------------//
$strText7="test\r\n";
				
$strFileName7 = "appoint.txt";
$objFopen7 = fopen($strFileName7, 'a');
fwrite($objFopen7, $strText7);
			
	if($objFopen7){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen7);
//-------------------- Close file appoint ไฟล์ที่ 7 --------------------//
?>


<?
//-------------------- Create file surveil ไฟล์ที่ 8 --------------------//
$strText8="test\r\n";
				
$strFileName8 = "surveil.txt";
$objFopen8 = fopen($strFileName8, 'a');
fwrite($objFopen8, $strText8);
			
	if($objFopen8){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen8);
//-------------------- Close file surveil ไฟล์ที่ 8 --------------------//
?>

<?
//-------------------- Create file drug ไฟล์ที่ 9 --------------------//
$inj="INJ";
$status="Y";
$query="CREATE TEMPORARY TABLE reportnhso16 SELECT date,hn,an,drugcode,tradname,amount FROM drugrx WHERE date LIKE '$thimonth%' and drugcode<>'$inj' and an is null and status = '$status' ";
$result = mysql_query($query) or die("Query failed,warphar0");
    
$query="CREATE TEMPORARY TABLE opday3 SELECT clinic,vn,thdatehn,an FROM opday WHERE  thidate  LIKE '$thimonth%'  ";
$result = mysql_query($query) or die("Query failed,warphar1");	
 
  $query="SELECT date_format(reportnhso16.date,'%d/ %m/ %Y'),reportnhso16.hn,reportnhso16.an,reportnhso16.drugcode,reportnhso16.tradname,reportnhso16.amount,druglst.unitpri,druglst.salepri,druglst.code24,druglst.subunit,druglst.packing ,reportnhso16.date FROM reportnhso16 LEFT JOIN druglst ON reportnhso16.drugcode=druglst.drugcode where reportnhso16.amount > 0  ";
   $result = mysql_query($query);
   while (list ($date,$hn,$an,$drugcode,$tradname,$amount,$unitpri,$salepri,$code24,$subunit,$packing,$daterx) = mysql_fetch_row ($result)) {	

         
$sql = "Select idcard From opcard where hn = '$hn' limit 1";
$result2 = Mysql_Query($sql);
list($idcard) = Mysql_fetch_row($result2);



$num1=1;
$num3=0;
$num2=543;

    $d=substr($date,0,2);
    $m=substr($date,4,2); 
   $y=substr($date,8,4); 
   $y1=$y-$num2;
   $y2=substr($y1,2,2);
   
	$time2 = substr($daterx,11,2); 
	$time3 = substr($daterx,14,2); 
	$time4 = substr($daterx,17,2); 
  	$dtimerx = "$y1$m$d$time2$time3$time4";
$thidatehn1="$d-$m-$y$hn";
	//print "$thidatehn1";
		
$sql = "Select clinic,vn,an From opday3 where thdatehn='$thidatehn1'  limit 1";
$result3 = Mysql_Query($sql);
list($clinic,$vn,$an) = Mysql_fetch_row($result3);

 $clinic1=substr($clinic,0,2);
 $vn=sprintf('%03d',$vn);
 if($an== '' ){$c1="0";} else {$c1="1";};
$num00='00';

// $date1="$d/$m/$y2"; 
$date1="$y1$m$d";
if($clinic1==''){$clinic1="00";} ;
//$datem1=date_format(datem,'%d/ %m/ %Y');

//if($an==''){$datevn=$date1.''.$vn;}else{$datevn='';};
$clinicall="$c1$clinic1$num00";
			
		$strText9="11512|$hn|$date1$vn|$date1|$drugcode|$amount|$salepri|$unitpri|$tradname|$code24|$subunit|$packing|$dtimerx|$clinicall|$idcard\r\n";
				
		$strFileName9 = "drug.txt";
		$objFopen9 = fopen($strFileName9, 'a');
		fwrite($objFopen9, $strText9);
				
		if($objFopen9){
			/*echo "File writed.";*/
		}else{
			/*echo "File can not write";*/
		}
		fclose($objFopen9);
}					
			
//-------------------- Close create file drug --------------------//
?>


<?
//-------------------- Create file proced ไฟล์ที่ 10 --------------------//
$na1='';
$query="CREATE TEMPORARY TABLE reportnhso06 SELECT hn,thidate,doctor,icd9cm,clinic,vn,an FROM opday WHERE thidate LIKE '$thimonth%' and icd9cm != 'NA' and icd9cm != '' ";
$result = mysql_query($query) or die("Query failed,warphar");

$query="SELECT reportnhso06.hn,date_format(reportnhso06.thidate,'%d/ %m/ %Y'),reportnhso06.doctor,reportnhso06.icd9cm,reportnhso06.clinic,opcard.idcard,reportnhso06.vn,reportnhso06.an FROM reportnhso06 LEFT JOIN opcard ON reportnhso06.hn=opcard.hn";

   $result = mysql_query($query);
    while (list ($hn,$date,$doctor,$icd9,$clinic,$id,$vn,$an) = mysql_fetch_row ($result)) {	
	
		$sql3 = "SELECT icd9cm FROM opicd9cm WHERE svdate LIKE '$thimonth%' and hn='$hn' ";
		$rows = mysql_query($sql3);
		list($icd9) =mysql_fetch_array($rows);
		$num1=11512;
		$num2=543;
		$num3=0;
		$num4=1;
		$d=substr($date,0,2);
		$m=substr($date,4,2); 
	   $y=substr($date,8,4); 
	   $y1=$y-$num2;
	   $y2=substr($y1,2,2);
   
 //   $date1="$d/$m/$y2"; 
$date1="$y1$m$d";
 $clinic1=substr($clinic,0,2);
$doctor1=substr($doctor,0,5);
if  ($doctor1=='MD022'){$doctor2="";} else 
if  ($doctor1=='MD006'){$doctor2="12891";} else 
if  ($doctor1=='MD007'){$doctor2="12456";} else 
if  ($doctor1=='MD008'){$doctor2="16633";} else 
if  ($doctor1=='MD009'){$doctor2="19364";} else 
if  ($doctor1=='MD011'){$doctor2="20186";} else 
if  ($doctor1=='MD013'){$doctor2="19921";} else 
if  ($doctor1=='MD014'){$doctor2="20182";} else 
if  ($doctor1=='MD015'){$doctor2="21504";} else 
if  ($doctor1=='MD016'){$doctor2="21329";} else 
if  ($doctor1=='MD020'){$doctor2="3448";} else 
if  ($doctor1=='MD030'){$doctor2="5947";} else 
if  ($doctor1=='MD036'){$doctor2="20278";} else 
if  ($doctor1=='MD037'){$doctor2="10212";} else 
if  ($doctor1=='MD041'){$doctor2="27035";} else 
if  ($doctor1=='MD043'){$doctor2="1850";} else 
if  ($doctor1=='MD047'){$doctor2="24535";} else 
if  ($doctor1=='MD048'){$doctor2="29290";} else 
if  ($doctor1=='MD049'){$doctor2="37555";} else 
if  ($doctor1=='MD050'){$doctor2="37525";} else 
if  ($doctor1=='MD051'){$doctor2="24512";} else 
if  ($doctor1=='MD052'){$doctor2="19286";} else 
{$doctor2 ="";};
 $vn=sprintf('%03d',$vn);

   $icd91=substr($icd9,0,4);
   if($icd91!='9007'){$icd92=substr($icd9,0,4);}else{ $icd92=$icd9;};
   
if($clinic1==''){$clinic1="99";} ;

 if($an== '' ){$c1="0";} else {$c1="1";};
$num00='00';
		$strText10="11512|$hn|$date1$vn|$date1|$icd92|0.00|$date1|$c1$clinic1$num00||$id\r\n";
				
		$strFileName10 = "proced.txt";
		$objFopen10 = fopen($strFileName10, 'a');
		fwrite($objFopen10, $strText10);
				
		if($objFopen10){
			/*echo "File writed.";*/
		}else{
			/*echo "File can not write";*/
		}
		fclose($objFopen10);
}					
			
//-------------------- Close create file proced --------------------//
?>


<?
//-------------------- Create file women ไฟล์ที่ 11 --------------------//
$strText11="test\r\n";
				
$strFileName11 = "women.txt";
$objFopen11 = fopen($strFileName11, 'a');
fwrite($objFopen11, $strText11);
			
	if($objFopen11){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen11);
//-------------------- Close file women ไฟล์ที่ 11 --------------------//
?>


<?
//-------------------- Create file fp ไฟล์ที่ 12 --------------------//
$strText12="test\r\n";
				
$strFileName12 = "fp.txt";
$objFopen12 = fopen($strFileName12, 'a');
fwrite($objFopen12, $strText12);
			
	if($objFopen12){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen12);
//-------------------- Close file fp ไฟล์ที่ 12 --------------------//
?>


<?
//-------------------- Create file epi ไฟล์ที่ 13 --------------------//
$strText13="11512|$hn|$seq|$date|$type|$place|$dedit|$idcard\r\n";				
$strFileName13 = "epi.txt";
$objFopen13 = fopen($strFileName13, 'a');
fwrite($objFopen13, $strText13);
			
	if($objFopen13){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen13);
//-------------------- Close file epi ไฟล์ที่ 13 --------------------//
?>


<?
//-------------------- Create file nutri ไฟล์ที่ 14 --------------------//
$strText14="test\r\n";
				
$strFileName14 = "nutri.txt";
$objFopen14 = fopen($strFileName14, 'a');
fwrite($objFopen14, $strText14);
			
	if($objFopen14){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen14);
//-------------------- Close file nutri ไฟล์ที่ 14 --------------------//
?>


<?
//-------------------- Create file anc ไฟล์ที่ 15 --------------------//
$strText15="test\r\n";
				
$strFileName15 = "anc.txt";
$objFopen15 = fopen($strFileName15, 'a');
fwrite($objFopen15, $strText15);
			
	if($objFopen15){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen15);
//-------------------- Close file anc ไฟล์ที่ 15 --------------------//
?>


<?
//-------------------- Create file pp ไฟล์ที่ 16 --------------------//
$strText16="test\r\n";
				
$strFileName16 = "pp.txt";
$objFopen16 = fopen($strFileName16, 'a');
fwrite($objFopen16, $strText16);
			
	if($objFopen16){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen16);
//-------------------- Close file pp ไฟล์ที่ 16 --------------------//
?>


<?
//-------------------- Create file mch ไฟล์ที่ 17 --------------------//
$strText17="test\r\n";
				
$strFileName17 = "mch.txt";
$objFopen17 = fopen($strFileName17, 'a');
fwrite($objFopen17, $strText17);
			
	if($objFopen17){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen17);
//-------------------- Close file mch ไฟล์ที่ 17 --------------------//
?>


<?
//-------------------- Create file home ไฟล์ที่ 18 --------------------//
$strText18="test\r\n";
				
$strFileName18 = "home.txt";
$objFopen18 = fopen($strFileName18, 'a');
fwrite($objFopen18, $strText18);
			
	if($objFopen18){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen18);
//-------------------- Close file home ไฟล์ที่ 18 --------------------//
?>


<?
//-------------------- Create file ncdscreen ไฟล์ที่ 19 --------------------//
$strText19="test\r\n";
				
$strFileName19 = "ncdscreen.txt";
$objFopen19 = fopen($strFileName19, 'a');
fwrite($objFopen19, $strText19);
			
	if($objFopen19){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen19);
//-------------------- Close file ncdscreen ไฟล์ที่ 19 --------------------//
?>


<?
//-------------------- Create file chronicfu ไฟล์ที่ 20 --------------------//
$strText20="test\r\n";
				
$strFileName20 = "chronicfu.txt";
$objFopen20 = fopen($strFileName20, 'a');
fwrite($objFopen20, $strText20);
			
	if($objFopen20){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen20);
//-------------------- Close file chronicfu ไฟล์ที่ 20 --------------------//
?>


<?
//-------------------- Create file labfu ไฟล์ที่ 21 --------------------//
$strText21="test\r\n";
				
$strFileName21 = "labfu.txt";
$objFopen21 = fopen($strFileName21, 'a');
fwrite($objFopen21, $strText21);
			
	if($objFopen21){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
fclose($objFopen21);
//-------------------- Close file labfu ไฟล์ที่ 21 --------------------//
?>


<?
//-------------------- Add to zip --------------------//
	$f21="F21_11512_";
	$default="090000";
	$dbfname ="$f21$newyear$default";
	$subfolder ="$f21$newyear$default";
	$ZipName = "21file/$dbfname.zip";
	require_once("dZip.inc.php"); // include Class
	$zip = new dZip($ZipName); // New Class
	$zip->addDir($subfolder); // Add Folder		
	$zip->addFile($strFileName1, $subfolder."/".$strFileName1); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName2, $subfolder."/".$strFileName2); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName3, $subfolder."/".$strFileName3); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName4, $subfolder."/".$strFileName4); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName5, $subfolder."/".$strFileName5); // ต้นทาง,ปลายทาง			
	$zip->addFile($strFileName6, $subfolder."/".$strFileName6); // ต้นทาง,ปลายทาง	
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
	$zip->addFile($strFileName19, $subfolder."/".$strFileName19); // ต้นทาง,ปลายทาง	
	$zip->addFile($strFileName20, $subfolder."/".$strFileName20); // ต้นทาง,ปลายทาง
	$zip->addFile($strFileName21, $subfolder."/".$strFileName21); // ต้นทาง,ปลายทาง*/							
	$zip->save();
	
	echo "ดาวน์โหลดข้อมูล 21 แฟ้ม... <a href=$ZipName>คลิกที่นี่</a> <br>";
	echo "<a href='../export21_data.php'><< กลับหน้าเดิม</a>";	
//-------------------- Close add to zip --------------------//
include("unconnect.inc");
?>
