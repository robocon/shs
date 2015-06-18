<?php
include("connect.inc");

$thidate=(date("Y")+543).'-'.date("m-d H:i:s");

$_POST["fha_time"] = $_POST["fha_time1"].":".$_POST["fha_time2"].":00";
	
	$sqladd2="INSERT INTO  `drug_fail_2` (  `thidate` ,  `ptname` ,  `hn` ,  `an` ,  `type_opd` ,  `area` ,  `fha_date` ,  `fha_time` ,  `order_name` ,  `pay_name` ,  `give_name` ,  `report_name` ,  `depart` ,  `p1` ,  `p2` ,  `p3` ,  `p4` ,  `p5` ,  `p6` ,  `p7` ,  `p_detail` ,  `p8` ,  `p9` ,  `p10` ,  `p11` ,  `p12` ,  `p13` ,  `p14` ,  `p15` , `d1` ,  `d2` ,  `d3` ,  `d4` ,  `d5` ,  `d6` ,  `d7` ,  `d8` ,  `d9` ,  `d_detail` ,  `t1` ,  `t2` ,  `t3` ,  `t4` ,  `t5` ,  `t6` ,  `t7` ,  `t8` ,  `t_detail` ,  `a1` ,  `a2` ,  `a3` ,  `a4` ,  `a5` ,  `a6` ,  `a7` ,  `a_detail` ,  `a8` ,  `a9` ,  `a10` ,  `a11` ,  `a12` ,  `c1` ,  `c2` ,  `c_detail` ,  `level_vio` ,  `action_detail`,status_row) 
VALUES ('".$thidate."',  '".$_POST['ptname']."',  '".$_POST['hn']."',  '".$_POST['an']."',  '".$_POST['type_opd']."',  '".$_POST['area']."','".$_POST['fha_date']."',  '".$_POST['fha_time']."',  '".$_POST['order_name']."',  '".$_POST['pay_name']."',  '".$_POST['give_name']."',  '".$_POST['report_name']."',  '".$_POST['depart']."',  '".$_POST['p1']."',  '".$_POST['p2']."',  '".$_POST['p3']."',  '".$_POST['p4']."',  '".$_POST['p5']."',  '".$_POST['p6']."',  '".$_POST['p7']."',  '".$_POST['p_detail']."',  '".$_POST['p8']."',  '".$_POST['p9']."',  '".$_POST['p10']."',  '".$_POST['p11']."', '".$_POST['p12']."',  '".$_POST['p13']."',  '".$_POST['p14']."',  '".$_POST['p15']."',  '".$_POST['d1']."',  '".$_POST['d2']."',  '".$_POST['d3']."',  '".$_POST['d4']."',  '".$_POST['d5']."',  '".$_POST['d6']."',  '".$_POST['d7']."',  '".$_POST['d8']."',  '".$_POST['d9']."',  '".$_POST['d_detail']."',  '".$_POST['t1']."', '".$_POST['t2']."', '".$_POST['t3']."',  '".$_POST['t4']."',  '".$_POST['t5']."',  '".$_POST['t6']."',  '".$_POST['t7']."',  '".$_POST['t8']."',  '".$_POST['t_detail']."',  '".$_POST['a1']."',  '".$_POST['a2']."', '".$_POST['a3']."', '".$_POST['a4']."',  '".$_POST['a5']."',  '".$_POST['a6']."',  '".$_POST['a7']."',  '".$_POST['a_detail']."',  '".$_POST['a8']."',  '".$_POST['a9']."', '".$_POST['a10']."',  '".$_POST['a11']."',  '".$_POST['a12']."',  '".$_POST['c1']."',  '".$_POST['c2']."',  '".$_POST['c_detail']."','".$_POST['level_vio']."' ,  '".$_POST['action_detail']."','Y');";
	
	$result2 = mysql_query($sqladd2) or die(mysql_error());
	
//echo $sqladd;
$id2=mysql_insert_id();
	
if($result2){

echo "<span class='font1'>บันทึกข้อมูลเรียบร้อยแล้ว </font><br>";
echo "<meta http-equiv='refresh' content='2; url=fha_report.php?row_id=$id2'>";
//echo "<meta http-equiv='refresh' content='2; url=fha_report.php?row_id=$id'>";
	?>
<!--<script>
window.opener.location.href="fha_report.php?row_id=<?//=$id;?>";
window.open('','_self');
	self.close();
</script>-->
<?
	}
?>