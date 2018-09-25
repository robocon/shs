<?php
//-------------------- Create file diagnosis_ipd ไฟล์ที่ 15 --------------------//
$temp15="CREATE  TEMPORARY  TABLE report_admission1 SELECT *  From ipcard where dcdate like '$thimonth%' and dcdate is not null ";
$querytmp15 = mysql_query($temp15) or die("Query failed,Create temp15");
	
$sql15="SELECT  a.regisdate,a.hn,a.an,b.date,b.my_ward,b.doctor,a.icd10,a.type,a.svdate From diag as a,report_admission1 as b where a.an = b.an";
$result15 = mysql_query($sql15) or die("Query failed,Select report_admission And diag");
$txt = '';
while (list ($regisdate,$hn,$an,$date,$my_ward,$doctor,$diagcode,$type,$svdate) = mysql_fetch_row ($result15)) {	

	// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	// list($hospcode)=mysql_fetch_array($sqlhos);
	
	$chkdate=substr($date,0,10);	
	$sqlopd1="select vn, idcard from opday where thidate like '$chkdate%' and hn='$hn'";
	//echo $sqlopd1;
	$resultopd1=mysql_query($sqlopd1);	
	list($vn, $cid)=mysql_fetch_array($resultopd1);		

	
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
	
    $txt .= "$hospcode|$hn|$an|$datetime_admit|$warddiag|$diagtype|$diagcode|$provider|$d_update|$cid\r\n";
    // $strFileName15 = "diagnosis_ipd.txt";
    // $objFopen15 = fopen($strFileName15, 'a');
    // fwrite($objFopen15, $strText15);
                
    // if($objFopen15){
    //     /*echo "File writed.";*/
    // }else{
    //     /*echo "File can not write";*/
    // }
    // fclose($objFopen15);
}  //close while
$filePath = $dirPath.'/diagnosis_ipd.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|AN|DATETIME_ADMIT|WARDDIAG|DIAGTYPE|DIAGCODE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_diagnosis_ipd.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม diagnosis_ipd เสร็จเรียบร้อย<br>";
//-------------------- Close file diagnosis_ipd ไฟล์ที่ 15 --------------------//