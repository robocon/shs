<?php
	
include("connect.inc");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>ใบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</TITLE>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('nonconf_date'));

};

</script>
</HEAD>
<table width="100%" border="0"  align="center">
  <tr>
    <td align="center"><div align="center"><? include("ncf_menu.php");?></div></td>
  </tr>
</table>
<BODY>


<FORM Name="f1" METHOD=POST ACTION="">
<TABLE border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE>
<TR align="center">
	<TD colspan="2" align="center" bgcolor="#3366FF" style="color:#FFFFFF;font-weight: bold;">ค้นหา</TD>
</TR>
<TR>
	<TD align="right">ปี : </TD>
	<TD>
	<Select Name="year">
<?php
	
	$sql = "Select distinct date_format( nonconf_date, '%Y' ) From ncr2556 Order by nonconf_date ASC ";
	$result = Mysql_Query($sql);
	while(list($year) = Mysql_fetch_row($result)){
		echo "<Option value=\"".$year."\" ";
			if(isset($_POST["year"]) && $_POST["year"] ==$year){ echo " Selected "; $w_year = $year;}
			else if(empty($_POST["year"]) && (date("Y")+543) == $year){ echo " Selected "; $w_year = $year;}
		echo ">".$year."</Option>";
	}

?>
	</Select>
	</TD>
</TR>
<TR>
	<TD colspan='2' align="center"><INPUT TYPE="submit" value="ตกลง"></TD>
</TR>
</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>

<CENTER><B>อุบัติการณ์ปี <?php echo $w_year;?></B><BR>
หน่วยงานที่มีการรายงานอุบัติการณ์เรียงจากมากไปน้อย
</CENTER><BR>

<?php
	
	$sql = "Select until, sum(topic1_1),  sum(topic1_2),  sum(topic1_3),  sum(topic1_4),  sum(topic1_5),  sum(topic1_6), sum(topic2_1),  sum(topic2_2),  sum(topic2_3),  sum(topic2_4),  sum(topic2_5),  sum(topic2_6),  sum(topic3_1),  sum(topic3_2),  sum(topic3_3),  sum(topic4_1),  sum(topic4_2),  sum(topic4_3),  sum(topic4_4),  sum(topic4_5),  sum(topic4_6),  sum(topic5_1),  sum(topic5_2),  sum(topic5_3),  sum(topic5_4),  sum(topic5_5),  sum(topic5_6),  sum(topic5_7),  sum(topic5_8),  sum(topic5_9),  sum(topic5_10),  sum(topic6_1),  sum(topic6_2),  sum(topic6_3),  sum(topic6_4),  sum(topic7_1),  sum(topic7_2),  sum(topic7_3),  sum(topic7_4),  sum(topic7_5),  sum(topic7_6),  sum(topic8_1),  sum(topic8_2),  sum(topic8_3),  sum(topic8_4),  sum(topic8_5),  sum(topic8_6),  sum(topic8_7),  sum(topic8_8),  sum(topic8_9),  sum(topic8_10)   From ncr2556 as a where a.nonconf_date LIKE '".$w_year."%' Group by until ";
	$result = Mysql_Query($sql);
	
	while($arr = Mysql_fetch_row($result)){
		$count = count($arr);
		echo $count;
		for($i=1;$i<$count;$i++){
			$amount[$arr[0]] = $amount[$arr[0]]+ $arr[$i];
		//echo $amount[$arr[0]];
		}
	}
	
	$sql = "Select until, CASE WHEN topic1_7 <> '' then 1 else 0 end , CASE WHEN topic2_7 <> '' then 1 else 0 end , CASE WHEN topic3_4 <> '' then 1 else 0 end , CASE WHEN topic4_7 <> '' then 1 else 0 end , CASE WHEN topic5_11 <> '' then 1 else 0 end , CASE WHEN topic6_5 <> '' then 1 else 0 end , CASE WHEN topic7_7 <> '' then 1 else 0 end , CASE WHEN topic8_11 <> '' then 1 else 0 end   From ncr2556 as a where a.nonconf_date LIKE '".$w_year."%' ";
	$result = Mysql_Query($sql);
	
	while($arr = Mysql_fetch_row($result)){
		$count = count($arr);
		for($i=1;$i<$count;$i++){
			$amount[$arr[0]] = $amount[$arr[0]]+ $arr[$i];
			echo $amount[$arr[0]];
		}
	}


?>

<TABLE width="300" align="center" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<?php
	foreach($amount as $key => $val){

echo "<TR>";
echo "<TD width=\"200\">",$cfg_until[$key],"</TD>";
echo "<TD width=\"100\" align='right'>จำนวน ",$val,"&nbsp;ครั้ง&nbsp;</TD>";
echo "</TR>";
}	
?>
</TABLE>

</BODY>
</HTML>

