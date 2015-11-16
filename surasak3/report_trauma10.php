<?php
session_start();
set_time_limit(30);
include("connect.inc");

?>
<html>
<head>
<title>สถิติสิทธิ์การรักษา</title>
<style type="text/css">


a:link {color:#000000; text-decoration:none;}
a:visited {color:#000000; text-decoration:none;}
a:active {color:#000000; text-decoration:none;}
a:hover {color:#000000; text-decoration:none;}

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
</head>
<body>

<?php
	
	
	$list_ptright = array();
	
	$list_ptright["P01"] = "-------";
	$list_ptright["P02"] = "ทหาร (น)";
	$list_ptright["P03"] = "ทหาร (นส)";
	$list_ptright["P04"] = "ทหาร (พลฯ)";
	$list_ptright["P05"] = "ครอบครัว";
	$list_ptright["P06"] = "พ.ต้น";
	$list_ptright["P07"] = "พ.";
	$list_ptright["P08"] = "ประกันสังคม";
	$list_ptright["P09"] = "30บาท";
	$list_ptright["P10"] = "30บาทฉุกเฉิน";
	$list_ptright["P11"] = "พรบ.";
	$list_ptright["P12"] = "กท.44";


	if(isset($_POST["submit"])){

		$_POST["d"] = sprintf('%02d',$_POST["d"]);

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

		$select_day2 = $_POST["yr2"]."-".$_POST["m2"]."-".$_POST["d2"];
		

		$day_now2 = $_POST["d2"];
		$month_now2 = $_POST["m2"];
		$year_now2 = $_POST["yr2"];

	}else{

		$select_day = (date("Y")+543).date("-m-d");
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

		$select_day2 = (date("Y",mktime(0,0,0,$month_now,$day_now+1,$year_now-543))+543).date("-m-d",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));

		$day_now2 = date("d",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));
		$month_now2 = date("m",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));
		$year_now2 = (date("Y",mktime(0,0,0,$month_now,$day_now+1,$year_now-543))+543);


	}
?>
	<SCRIPT LANGUAGE="JavaScript">
	
		function wprint(){

			document.getElementById("form_01").style.display='none';
			window.print();

		}
	
	</SCRIPT>
	<form method='POST' action='<?php echo $_SERVER["PHP_SELF"];?>'>
	<TABLE id="form_01">
	<TR>
		<TD>
		วันที่&nbsp;&nbsp; 
	<input type='text' name='d' size='2' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	<TR>
		<TD>
		ถึง วันที่&nbsp;&nbsp; 
	<input type='text' name='d2' size='2' value='<?php echo $day_now2;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m2' size='4' value='<?php echo $month_now2;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr2' size='8' value='<?php echo $year_now2;?>'>
		</TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>

<?php 
	if(isset($_POST["submit"])){
		
?>

สถิติผู้ป่วยสิทธิ์หลัก
<table  cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
  <tr>
    <td align="center">สิทธิ์</td>
    <td align="center">จำนวน</td>
  </tr>
  <?php

$sql = "Select list_ptright, count(list_ptright) as c_count From trauma where  ( date_in between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59' ) AND list_ptright <> 'P01' Group by list_ptright";

$result = Mysql_Query($sql) or die(Mysql_error());
$i=1;

while($arr = Mysql_fetch_assoc($result)){
	
 echo" <tr>
					<td align=\"center\">".$list_ptright[$arr["list_ptright"]]."</td>
					<td align=\"right\">&nbsp;<A HREF='report_trauma10_1.php?select_day=".$select_day."&select_day2=".$select_day2."&field=list_ptright&list_ptright=".$arr["list_ptright"]."'  target='_blank'>".$arr["c_count"]."</A>&nbsp;&nbsp;</td>
				</tr>";

	$i++;

 }?>
</table>
<BR>
สถิติผู้ป่วยสิทธิ์รอง
<table  cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
  <tr>
    <td align="center">สิทธิ์</td>
    <td align="center">จำนวน</td>
  </tr>
  <?php

$sql = "Select list_ptright2, count(list_ptright) as c_count From trauma where  ( date_in between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59' ) AND list_ptright2 <> 'P01' AND list_ptright2 <> '' Group by list_ptright2";

$result = Mysql_Query($sql) or die(Mysql_error());
$i=1;

while($arr = Mysql_fetch_assoc($result)){
	
 echo" <tr>
					<td align=\"center\">".$list_ptright[$arr["list_ptright2"]]."</td>
					<td align=\"right\">&nbsp;<A HREF='report_trauma10_1.php?select_day=".$select_day."&select_day2=".$select_day2."&field=list_ptright2&list_ptright=".$arr["list_ptright2"]."'  target='_blank' >".$arr["c_count"]."</A>&nbsp;&nbsp;</td>
				</tr>";

	$i++;

 }?>
</table>



<?php }?>


</body>
</html>





<?php include("unconnect.inc");?>