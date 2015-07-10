<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>บันทึกข้อมูลการติดตามภาวะการติดเชื้อ</title>
</head>

<body>
<?
include("../connect.inc");

echo $_POST['row_id'];

$strsql="UPDATE  `ic_infection` SET 
`an` =  '".$_POST['an']."',
`hn` =   '".$_POST['hn']."',
`ptname` =   '".$_POST['ptname']."',
`age` = '".$_POST['age']."',
`ptright` = '".$_POST['ptright']."',
`addate` = '".$_POST['addate']."',
`dcdate` =  '".$_POST['dcdate']."',
`tel` =  '".$_POST['tel']."',
`diag1` =  '".$_POST['diag1']."',
`diag2` =  '".$_POST['diag2']."',
`diag3` =  '".$_POST['diag3']."',
`diag4` =  '".$_POST['diag4']."',
`date1` = '".$_POST['date1']."',
`disease` =  '".$_POST['disease']."',
`status_dc` =  '".$_POST['status_dc']."',
`refer_host` = '".$_POST['refer_host']."',
`date2` = '".$_POST['date2']."',
`respirator` = '".$_POST['respirator']."',
`date3` = '".$_POST['date3']."',
`date4` =  '".$_POST['date4']."',
`surgery` = '".$_POST['surgery']."',
`surgeryor` = '".$_POST['surgeryor']."',
`date5` =  '".$_POST['date5']."',
`birth` =  '".$_POST['birth']."',
`date6` =  '".$_POST['date6']."',
`procedure` =  '".$_POST['procedure']."',
`dateproc` =  '".$_POST['dateproc']."',
`date7` =  '".$_POST['date7']."',
`fever` =  '".$_POST['fever']."',
`date8` =  '".$_POST['date8']."',
`urine` ='".$_POST['urine']."',
`date9` = '".$_POST['date9']."',
`abdominal` = '".$_POST['abdominal']."',
`date10` =  '".$_POST['date10']."',
`pubis` =  '".$_POST['pubis']."',
`date11` =  '".$_POST['date11']."',
`cough` = '".$_POST['cough']."',
`date12` = '".$_POST['date12']."',
`wound` =  '".$_POST['wound']."',
`date13` =  '".$_POST['date13']."',
`episiotomy` =  '".$_POST['episiotomy']."',
`date14` = '".$_POST['date14']."',
`smell` = '".$_POST['smell']."',
`date15` =  '".$_POST['date15']."',
`skin` =  '".$_POST['skin']."',
`date16` = '".$_POST['date16']."',
`initial_diag` =  '".$_POST['initial_diag']."' WHERE  `row_id` =  '".$_POST['row_id']."' LIMIT 1 ;";
	$strresult=mysql_query($strsql);		
	

	if($strresult){
		echo "บันทึกข้อมูลเรียบร้อยแล้ว";
		echo "<BR><META HTTP-EQUIV='Refresh' CONTENT='2;URL=report_ift_print.php?row_id=$_POST[row_id]'>";
		
	}else{
		echo "ไม่สามารถบันทึกข้อมูลได้";
echo "<BR><META HTTP-EQUIV='Refresh' CONTENT='2;URL=report_ift.php'>";
	}

?>
</body>
</html>