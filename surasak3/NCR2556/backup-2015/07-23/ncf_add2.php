

<BODY>
<?php
include("connect.inc");

$_POST["nonconf_time"] = $_POST["nonconf_time1"].":".$_POST["nonconf_time2"].":00";

if($_POST['ncr']==''){
	$ncr='000';
}else{
	$ncr=$_POST['ncr'];
}

$sql="INSERT INTO `ncr2556` (`ncr` , `until` , `nonconf_date` , `nonconf_time` , `event` , `come_from_id` , `come_from_detail` , `topic1_1` , `topic1_2` , `topic1_3` , `topic1_4` , `topic1_5` , `topic1_6` , `topic1_7` , `topic2_1` , `topic2_2` , `topic2_3` , `topic2_4` , `topic2_5` , `topic2_6` , `topic2_7` , `topic3_1` , `topic3_2` , `topic3_3` , `topic3_4` , `topic4_1` , `topic4_2` , `topic4_3` , `topic4_4` , `topic4_5` , `topic4_6` ,`topic5_1` , `topic5_2` , `topic5_3` , `topic5_4` , `topic5_5` , `topic5_6` , `topic5_7` , `topic5_8` , `topic5_9` , `topic5_10` , `topic5_11` , `topic6_1` , `topic6_2` , `topic6_3` , `topic6_4` , `topic6_5` , `topic7_1` , `topic7_2` , `topic7_3` , `topic7_4` , `topic7_5` , `topic7_6` , `topic7_7` , `topic8_1` , `topic8_2` , `topic8_3` , `topic8_4` , `topic8_5` , `topic8_6` , `topic8_7` , `topic8_8` , `topic8_9` , `topic8_10` , `topic8_11` , `clinic` , `quality` , `cpno` , `risk1` , `risk2` , `risk3` , `risk4` , `risk5` , `risk6` , `risk7` , `risk8` , `risk9` , `sum_up` , `problem` , `protect` , `head_name` , `menucode` , `officer` )
VALUES ('".$ncr."', '".$_POST['until']."', '".$_POST['nonconf_date']."', '".$_POST['nonconf_time']."', '".$_POST['event']."', '".$_POST['come_from_id']."','".$_POST['come_from_detail']."', '".$_POST['topic1_1']."', '".$_POST['topic1_2']."', '".$_POST['topic1_3']."', '".$_POST['topic1_4']."', '".$_POST['topic1_5']."', '".$_POST['topic1_6']."', '".nl2br($_POST['topic1_7'])."', '".$_POST['topic2_1']."', '".$_POST['topic2_2']."', '".$_POST['topic2_3']."', '".$_POST['topic2_4']."', '".$_POST['topic2_5']."', '".$_POST['topic2_6']."', '".nl2br($_POST['topic2_7'])."', '".$_POST['topic3_1']."', '".$_POST['topic3_2']."', '".$_POST['topic3_3']."', '".nl2br($_POST['topic3_4'])."', '".$_POST['topic4_1']."', '".$_POST['topic4_2']."', '".$_POST['topic4_3']."', '".$_POST['topic4_4']."','".$_POST['topic4_5']."', '".nl2br($_POST['topic4_6'])."' , '".$_POST['topic5_1']."', '".$_POST['topic5_2']."', '".$_POST['topic5_3']."', '".$_POST['topic5_4']."', '".$_POST['topic5_5']."', '".$_POST['topic5_6']."', '".$_POST['topic5_7']."', '".$_POST['topic5_8']."', '".$_POST['topic5_9']."', '".$_POST['topic5_10']."', '".nl2br($_POST['topic5_11'])."', '".$_POST['topic6_1']."', '".$_POST['topic6_2']."', '".$_POST['topic6_3']."', '".$_POST['topic6_4']."', '".nl2br($_POST['topic6_5'])."', '".$_POST['topic7_1']."', '".$_POST['topic7_2']."', '".$_POST['topic7_3']."', '".$_POST['topic7_4']."', '".$_POST['topic7_5']."', '".$_POST['topic7_6']."', '".nl2br($_POST['topic7_7'])."', '".$_POST['topic8_1']."', '".$_POST['topic8_2']."', '".$_POST['topic8_3']."', '".$_POST['topic8_4']."', '".$_POST['topic8_5']."', '".$_POST['topic8_6']."', '".$_POST['topic8_7']."','".$_POST['topic8_8']."','".$_POST['topic8_9']."','".$_POST['topic8_10']."', '".nl2br($_POST['topic8_11'])."', '".$_POST['clinic']."', '".$_POST['quality']."','".$_POST['cpno']."','".$_POST['risk1']."', '".$_POST['risk2']."','".$_POST['risk3']."','".$_POST['risk4']."','".$_POST['risk5']."','".$_POST['risk6']."','".$_POST['risk7']."', '".$_POST['risk8']."','".$_POST['risk9']."','".nl2br($_POST['sum_up'])."', '".nl2br($_POST['problem'])."','".nl2br($_POST['protect'])."','".$_POST['head_name']."', '".$_POST['menucode']."', '".$_POST['officer']."')";

$query=mysql_query($sql) or die (mysql_error());

$id=mysql_insert_id();

if($query){
	
/*$sql2 ="UPDATE runno SET runno ='".$_POST['ncr']."' WHERE title='NCR'";
$result2 = mysql_query($sql2) or die("Query failed NCR runno");*/

echo "<div align='center'>บันทึกข้อมูลเรียบร้อยแล้ว</div>";



?>
<script>
window.opener.location.reload();
</script>
<?
//echo "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=ncf_print.php?ncr_id=$id'>";
}else{
	
 echo "ไม่สามารถบันทึกข้อมูล ERROR !!!   ";
 
}

?>
</BODY>
</HTML>