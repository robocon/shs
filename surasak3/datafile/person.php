<?
include("../connect.inc");
$thiyr=$thiyr-543;
$yrmonth="$thiyr-$rptmo";
$yy=543;

// ลบไฟล์ก่อน-----------------)
$filename1 = "person".".txt";
$filename2 = "diag".".txt";
$filename3 = "drug".".txt";
$filename4 = "proced".".txt";
$filename5 = "service".".txt";


if(file_exists("$filename1") && file_exists("$filename2") && file_exists("$filename3") && file_exists("$filename4") && file_exists("$filename5")){
	unlink("$filename1");
	unlink("$filename2");
	unlink("$filename3");
	unlink("$filename4");
	unlink("$filename5");				
	echo "เรียบร้อย </br>";				
}
// จบ ลบไฟล์-----------------)

//-------------------- Create file person --------------------//
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

$strFileName1 = "person".".txt";
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


//-------------------- Create file diag --------------------//
	if(isset($_POST["noicd10"]) && $_POST["noicd10"] =="1"){
		$where = " AND icd10 = '' ";
	}

    $query="CREATE TEMPORARY TABLE reportnhso05 SELECT hn,thidate,doctor,icd10,clinic , toborow,vn,diagtype,an FROM opday WHERE thidate LIKE '$yrmonth%' ".$where;
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
				
				$strText2="11512|$hn|$date1$vn|$date1|$type|$icd10|$dateup|$clinicall|$id\r\n";
				
				$strFileName2 = "diag".".txt";
				$objFopen2 = fopen($strFileName2, 'a');
				fwrite($objFopen2, $strText2);
				
					if($objFopen2){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen2);						
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
			
			$strText2="11512|$hn|$date1$vn|$date1|$type|$icd10|$dateup|$clinicall|$id\r\n";
			
			$strFileName2 = "diag".".txt";
			$objFopen2 = fopen($strFileName2, 'a');
			fwrite($objFopen2, $strText2);
			
				if($objFopen2){
					/*echo "File writed.";*/
				}else{
					/*echo "File can not write";*/
				}
				fclose($objFopen2);			
		}	
}  // close while
//-------------------- Close create file diag --------------------//


//-------------------- Create file drug --------------------//
$strFileName3 = "drug".".txt";
$objFopen3 = fopen($strFileName3, 'a');
fwrite($objFopen3, $strText3);

	if($objFopen3){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen3);
//}  // close while
//-------------------- Close create file drug --------------------//


//-------------------- Create file proced --------------------//
$strFileName4 = "proced".".txt";
$objFopen4 = fopen($strFileName4, 'a');
fwrite($objFopen4, $strText4);

	if($objFopen4){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen4);
//}  // close while
//-------------------- Close create file proced --------------------//


//-------------------- Create file service --------------------//
$strFileName5 = "service".".txt";
$objFopen5 = fopen($strFileName5, 'a');
fwrite($objFopen5, $strText5);

	if($objFopen5){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen5);
//}  // close while
//-------------------- Close create file service --------------------//


//-------------------- Add to zip --------------------//
	$dbfname =$yrmonth;
	$ZipName = "21file/$dbfname.zip";
	require_once("dZip.inc.php"); // include Class
	$zip = new dZip($ZipName); // New Class
	$zip->addFile($strFileName1, $strFileName1); // Source,Destination	
	$zip->addFile($strFileName2, $strFileName2); // Source,Destination	
	$zip->addFile($strFileName3, $strFileName3); // Source,Destination	
	$zip->addFile($strFileName4, $strFileName4); // Source,Destination	
	$zip->addFile($strFileName5, $strFileName5); // Source,Destination	
	
	$zip->save();
	
	echo "ดาวน์โหลดข้อมูล 21 แฟ้ม... <a href=$ZipName>คลิกที่นี่</a>";	
//-------------------- Close add to zip --------------------//
include("unconnect.inc");
?>