<body Onload="window.print();">

<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$Thidate2 = date("Y").date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$patienttype = "OPD";
	$sourcecode = "";//ÃËÑÊward
	$build = array("ËÍ¼Ùé»èÇÂË­Ô§"=>"42","ËÍ¼Ùé»èÇÂ ICU"=>"44","ËÍ¼Ùé»èÇÂÊÙµÔ"=>"43","ËÍ¼Ùé»èÇÂ¾ÔàÈÉ"=>"45");

	$sourcename = "";//ª×èÍward
	$room = ""; //ËéÍ§¼Ùé»èÇÂ
	$clinicalinfo = "";


	$sql = "INSERT INTO `orderhead2` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".$nLab."', '".$cHn."', '".$patienttype."', '".iconv("UTF-8", "TIS-620", $cPtname)."', '".$gender."', '".$dbirth."', '".$sourcecode."', '".$sourcename."', '".$room."','".$cliniciancode."', '".$clinicianname."', '".$priority."', '".$clinicalinfo."');";
	echo $sql;
	$result = mysql_query($sql)or die("Query failed,INSERT orderhead ");
	
?>