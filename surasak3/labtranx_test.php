<body Onload="window.print();">

<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$Thidate2 = date("Y").date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$patienttype = "OPD";
	$sourcecode = "";//����ward
	$build = array("�ͼ�����˭ԧ"=>"42","�ͼ����� ICU"=>"44","�ͼ������ٵ�"=>"43","�ͼ����¾����"=>"45");

	$sourcename = "";//����ward
	$room = ""; //��ͧ������
	$clinicalinfo = "";


	$sql = "INSERT INTO `orderhead2` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".$nLab."', '".$cHn."', '".$patienttype."', '".iconv("UTF-8", "TIS-620", $cPtname)."', '".$gender."', '".$dbirth."', '".$sourcecode."', '".$sourcename."', '".$room."','".$cliniciancode."', '".$clinicianname."', '".$priority."', '".$clinicalinfo."');";
	echo $sql;
	$result = mysql_query($sql)or die("Query failed,INSERT orderhead ");
	
?>