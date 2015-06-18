

<body>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:24px;
	font-weight:bold;
}
.font2{
	font-family:"TH SarabunPSK";
	font-size:16px;
}

@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
</style>
<?php
include("connect.inc");

$thidate=(date("Y")+543).'-'.date("m").'-'.date("d");

	$_POST["fha_time"] = $_POST["fha_time1"].":".$_POST["fha_time2"].":00";
	
$sqledit="UPDATE `drug_fail_2` SET 
`an` = '".$_POST['an']."',
`type_opd` = '".$_POST['type_opd']."',
`area` = '".$_POST['area']."',
`fha_date` = '".$_POST['fha_date']."',
`fha_time` ='".$_POST['fha_time']."',
`order_name` = '".$_POST['order_name']."',
`pay_name` = '".$_POST['pay_name']."',
`give_name` = '".$_POST['give_name']."',
`report_name` = '".$_POST['report_name']."',
`depart` = '".$_POST['depart']."',
`p1` = '".$_POST['p1']."',
`p2` = '".$_POST['p2']."',
`p3` = '".$_POST['p3']."',
`p4` = '".$_POST['p4']."',
`p5` = '".$_POST['p5']."',
`p6` = '".$_POST['p6']."',
`p7` = '".$_POST['p7']."',
`p_detail` = '".$_POST['p_detail']."',
`p8` = '".$_POST['p8']."',
`p9` = '".$_POST['p9']."',
`p10` = '".$_POST['p10']."',
`p11` = '".$_POST['p11']."',
`p12` = '".$_POST['p12']."',
`p13` = '".$_POST['p13']."',
`p14` = '".$_POST['p14']."',
`p15` = '".$_POST['p15']."',
`d1` 	 = '".$_POST['d1']."',
`d2` = '".$_POST['d2']."',
`d3` = '".$_POST['d3']."',
`d4` = '".$_POST['d4']."',
`d5` = '".$_POST['d5']."',
`d6` = '".$_POST['d6']."',
`d7` = '".$_POST['d7']."',
`d8` = '".$_POST['d8']."',
`d9` = '".$_POST['d9']."',
`d_detail` = '".$_POST['d_detail']."',
`t1` = '".$_POST['t1']."',
`t2` = '".$_POST['t2']."',
`t3` = '".$_POST['t3']."',
`t4` = '".$_POST['t4']."',
`t5` ='".$_POST['t5']."',
`t6` = '".$_POST['t6']."',
`t7` = '".$_POST['t7']."',
`t8` = '".$_POST['t8']."',
`t_detail` = '".$_POST['t_detail']."',
`a1` = '".$_POST['a1']."',
`a2` = '".$_POST['a2']."',
`a3` = '".$_POST['a3']."',
`a4` = '".$_POST['a4']."',
`a5` = '".$_POST['a5']."',
`a6` = '".$_POST['a6']."',
`a7` = '".$_POST['a7']."',
`a_detail` = '".$_POST['a_detail']."',
`a8` = '".$_POST['a8']."',
`a9` = '".$_POST['a9']."',
`a10` = '".$_POST['a10']."',
`a11` = '".$_POST['a11']."',
`a12` = '".$_POST['a12']."',
`c1` = '".$_POST['c1']."',
`c2` = '".$_POST['c2']."',
`c_detail` = '".$_POST['c_detail']."',
`level_vio` = '".$_POST['level_vio']."',
`action_detail` = '".$_POST['action_detail']."' WHERE `row_id`='".$_POST['row_id']."' ";
	
	$result = mysql_query($sqledit) or die(mysql_error());
	
//echo $sqledit;

	
	if($result){
	
	echo "<span class='font1'>บันทึกข้อมูลเรียบร้อยแล้ว </font><br>";
    echo "<meta http-equiv='refresh' content='2; url=fha_report.php?row_id=$_POST[row_id]'>";
	}
?>
</body>
</html>