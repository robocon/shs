<?php
  




    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$Thidate2 = date("Y").date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$patienttype = "OPD";

	
    include("connect.inc");

//àÅ¢ LAB


$query = "SELECT runno, startday FROM runno WHERE title = 'lab'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}

//  	    $cTitle=$row->title;  //=VN
$nLab=$row->runno;
$dLabdate=$row->startday;
$dLabdate=substr($dLabdate,0,10);

if(substr($dLabdate,0,10) != date("Y-m-d")){
	$nLab = 1;
	$dLabdate = date("Y-m-d 00:00:00");
}

$today = date("Y-m-d"); 


	
	 for ($n=1; $n<=$x; $n++){

		 list($olddetail) = mysql_fetch_row(mysql_query("Select oldcode From labcare where code = '".$aDgcode[$n]."' limit 0,1 "));

		$sql = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $nLab)."', '".$aDgcode[$n]."', '".$olddetail."', '".$aTrade[$n]."');";
		 $result = mysql_query($sql) or die("Query failed,INSERT orderdetail");

		 $clinicalinfo .=$aDgcode[$n]." ,";
	 }

////*runno µÃÇ¨ÊØ¢ÀÒ¾*/////////
/*$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;*/
////*runno µÃÇ¨ÊØ¢ÀÒ¾*/////////

	 if($cDiag == "chk01-µÃÇ¨ÊØ¢ÀÒ¾»ÃĞ¨Ó»Õ¡Í§·Ñºº¡" || $cDiag == "chk01-µÃÇ¨ÊØ¢ÀÒ¾»ÃĞ¨Ó»Õ¡Í§·Ñ¾º¡")
			$clinicalinfo = "µÃÇ¨ÊØ¢ÀÒ¾»ÃĞ¨Ó»Õ".$nPrefix;

	  if($cDiag == "µÃÇ¨ÊØ¢ÀÒ¾")
			$clinicalinfo = "µÃÇ¨ÊØ¢ÀÒ¾»ÃĞ¨Ó»Õ".$nPrefix;
	
	$sql = "Select sex, dbirth From opcard where hn = '".$cHn."' limit 0,1 ";
	$result = mysql_query($sql) or die("Query failed,update opday");
	list($sex, $dbirth) = mysql_fetch_row($result);

	if($sex == "ª")
		$gender = "M";
	else if($sex == "­")
		$gender = "F";
	else
		$gender = "0";
	
	if(empty($_SESSION["aPriority"]))
		$priority = "R";
	else
		$priority = $_SESSION["aPriority"];
	
	$first_year = explode("-",$dbirth);
	$first_year[0] = $first_year[0]-543;
	
	if(checkdate($first_year[1],$first_year[2],$first_year[0])){
		$dbirth = $first_year[0].substr($dbirth,4);
	}else{
		$dbirth = date("Y-m-d");
	}
	
	$sql = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $nLab)."', '".$cHn."', '".$patienttype."', '".$cPtname."', '".$gender."', '".$dbirth."', '".$_SESSION['sourcecode']."', '".$sourcename."', '".$room."','".$cliniciancode."', '".$clinicianname."', '".$priority."', '".$clinicalinfo."');";
	$result = mysql_query($sql)or die("Query failed,INSERT orderhead ");



		$nLab++;
		$query ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
		$result = mysql_query($query) or die("Query failed runno");

   include("unconnect.inc");
?>