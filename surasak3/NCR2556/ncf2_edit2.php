<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<script>
function closeWindow() {

     //var browserName = navigator.appName;

     //var browserVer = parseInt(navigator.appVersion);

     var ie7 = (document.all && !window.opera && window.XMLHttpRequest) ? true : false;  

     if (ie7)

           {    

           //This method is required to close a window without any prompt for IE7

window.open('','_self');
setTimeout("self.close()",2000);

           }

     else

           {

           //This method is required to close a window without any prompt for IE6

           this.focus();

           self.opener = this;

           self.close();

           }

}

</script>
<body>
<?
include("connect.inc");

$_POST["nonconf_time"] = $_POST["nonconf_time1"].":".$_POST["nonconf_time2"].":00";



$sql_update="UPDATE `ncr2556` SET `ncr` = '".$_POST['ncr']."',
`until` = '".$_POST['until']."',
`nonconf_date` = '".$_POST['nonconf_date']."',
`nonconf_dategroup` = '".$_POST['nonconf_dategroup']."',
`nonconf_time` = '".$_POST['nonconf_time']."',
`event` = '".$_POST['event']."',
`come_from_id` = '".$_POST['come_from_id']."',
`come_from_detail` = '".$_POST['come_from_detail']."',
`topic1_1` = '".$_POST['topic1_1']."',
`topic1_2` = '".$_POST['topic1_2']."',
`topic1_3` ='".$_POST['topic1_3']."',
`topic1_4` = '".$_POST['topic1_4']."',
`topic1_5` ='".$_POST['topic1_5']."',
`topic1_6` = '".$_POST['topic1_6']."',
`topic1_7` = '".$_POST['topic1_7']."',
`topic2_1` = '".$_POST['topic2_1']."',
`topic2_2` = '".$_POST['topic2_2']."',
`topic2_3` = '".$_POST['topic2_3']."',
`topic2_4` = '".$_POST['topic2_4']."',
`topic2_5` = '".$_POST['topic2_5']."',
`topic2_6` = '".$_POST['topic2_6']."',
`topic2_7` = '".$_POST['topic2_7']."',
`topic3_1` = '".$_POST['topic3_1']."',
`topic3_2` = '".$_POST['topic3_2']."',
`topic3_3` = '".$_POST['topic3_3']."',
`topic3_4` = '".$_POST['topic3_4']."',
`topic4_1` = '".$_POST['topic4_1']."',
`topic4_2` = '".$_POST['topic4_2']."',
`topic4_3` = '".$_POST['topic4_3']."',
`topic4_4` = '".$_POST['topic4_4']."',
`topic4_5` = '".$_POST['topic4_5']."',
`topic4_6` = '".$_POST['topic4_6']."',
`topic5_1` = '".$_POST['topic5_1']."',
`topic5_2` = '".$_POST['topic5_2']."',
`topic5_3` ='".$_POST['topic5_3']."',
`topic5_4` ='".$_POST['topic5_4']."',
`topic5_5` = '".$_POST['topic5_5']."',
`topic5_6` ='".$_POST['topic5_6']."',
`topic5_7` = '".$_POST['topic5_7']."',
`topic5_8` = '".$_POST['topic5_8']."',
`topic5_9` = '".$_POST['topic5_9']."',
`topic5_10` = '".$_POST['topic5_10']."',
`topic5_11` = '".$_POST['topic5_11']."',
`topic6_1` = '".$_POST['topic6_1']."',
`topic6_2` = '".$_POST['topic6_2']."',
`topic6_3` = '".$_POST['topic6_3']."',
`topic6_4` = '".$_POST['topic6_4']."',
`topic6_5` = '".$_POST['topic6_5']."',
`topic7_1` = '".$_POST['topic7_1']."',
`topic7_2` = '".$_POST['topic7_2']."',
`topic7_3` = '".$_POST['topic7_3']."',
`topic7_4` = '".$_POST['topic7_4']."',
`topic7_5` = '".$_POST['topic7_5']."',
`topic7_6` = '".$_POST['topic7_6']."',
`topic7_7` = '".$_POST['topic7_7']."',
`topic8_1` = '".$_POST['topic8_1']."',
`topic8_2` = '".$_POST['topic8_2']."',
`topic8_3` = '".$_POST['topic8_3']."',
`topic8_4` = '".$_POST['topic8_4']."',
`topic8_5` = '".$_POST['topic8_5']."',
`topic8_6` = '".$_POST['topic8_6']."',
`topic8_7` = '".$_POST['topic8_7']."',
`topic8_8` = '".$_POST['topic8_8']."',
`topic8_9` = '".$_POST['topic8_9']."',
`topic8_10` = '".$_POST['topic8_10']."',
`topic8_11` ='".$_POST['topic8_11']."',
`clinic` = '".$_POST['clinic']."',
`quality` = '".$_POST['quality']."',
`cpno` ='".$_POST['cpno']."',
`risk1` = '".$_POST['risk1']."',
`risk2` = '".$_POST['risk2']."',
`risk3` = '".$_POST['risk3']."',
`risk4` = '".$_POST['risk4']."',
`risk5` = '".$_POST['risk5']."',
`risk6` = '".$_POST['risk6']."',
`risk7` = '".$_POST['risk7']."',
`risk8` = '".$_POST['risk8']."',
`risk9` = '".$_POST['risk9']."',
`pro_f` = '".$_POST['pro_f']."',
`pro_b` = '".$_POST['pro_b']."',
`pro_i` = '".$_POST['pro_i']."',
`pro_t` = '".$_POST['pro_t']."',
`pro_s` = '".$_POST['pro_s']."',
`pro_other` = '".$_POST['pro_other']."',
`sum_up` = '".$_POST['sum_up']."',
`problem` = '".$_POST['problem']."',
`protect` = '".$_POST['protect']."',
`head_name` = '".$_POST['head_name']."' ,
`free_event` = '".$_POST['free_event']."' ,
`return` = '".$_POST['return']."' ,
`accept` = '".$_POST['accept']."'  WHERE `nonconf_id` = '".$_POST['nonconf_id']."' ";
$query_update=mysql_query($sql_update) or die (mysql_error());


if($query_update){
	
echo "<div align='center'>บันทึกข้อมูลเรียบร้อยแล้ว</div>";
//echo "<div align='center'><a href='ncf_print.php?ncr_id=$_POST[nonconf_id]'>พิมพ์ใบรายงาน</a></div>";
//echo "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=ncf_print.php?ncr_id=$_POST[nonconf_id]'>";
//echo "<div align='center'><a href='#' onClick='window.close()'>ปิดหน้าต่างนี้</a></div>";
?>
<script>

window.open('','_self');
setTimeout("self.close()",1000);



</script>	
<?
}else{
	
 echo "<div align='center'>ไม่สามารถบันทึกข้อมูล ERROR !!!  </div> ";
 
}
?>
</body>
</html>