<?php
session_start();
include("connect.inc");

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


	$month_["01"] = "มกราคม";
    $month_["02"] = "กุมภาพันธ์";
    $month_["03"] = "มีนาคม";
    $month_["04"] = "เมษายน";
    $month_["05"] = "พฤษภาคม";
    $month_["06"] = "มิถุนายน";
    $month_["07"] = "กรกฎาคม";
    $month_["08"] = "สิงหาคม";
    $month_["09"] = "กันยายน";
    $month_["10"] = "ตุลาคม";
    $month_["11"] = "พฤศจิกายน";
    $month_["12"] = "ธันวาคม";
?>
<html>
<head>
<title>สถิติ CPG</title>
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
	
	

	

	if(isset($_POST["submit"])){

		//$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		$select_day = $_POST["yr"];
		

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

	}else{
		//$select_day = (date("Y")+543).date("-m-d");
		$select_day = (date("Y")+543).date("-m-d");
		
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

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
	<!-- 	วันที่&nbsp;&nbsp; 
	<input type='text' name='d' size='2' value='<?php // echo $day_now;?>'>&nbsp;&nbsp; -->
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	<TR>
		<TD><input type='submit' value='     ตกลง     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	<INPUT TYPE="hidden" name="submit" value="true">
	</form>

<?php 

	if(isset($_POST["submit"])){
		
		$sql = "Create Temporary table trauma_now Select * From trauma where date_in like '".$select_day."%' ";
		$result = mysql_query($sql);

		$sql = "Create Temporary table trauma_cpg_now Select for_id, date_in, code_cpg From trauma_cpg where date_in like '".$select_day."%' ";
		$result = mysql_query($sql);

?>
<CENTER>สรุปยอดผู้ป่วยที่ใช้ CPG ต่างๆภายในห้องฉุกเฉิน เดือน <?php echo $month_[$month_now]; ?> ปี <?php echo $year_now; ?></CENTER>
<TABLE align="center" width="300" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000">
<TR align="center">
	<TD rowspan="1">ประเภท</TD>
	<TD colspan="1">จำนวน</TD>
</TR>


<TR align="center">
<TD>CPG CODD</TD>
<?php
	$sql = "Select distinct for_id , date_in From trauma_cpg_now where code_cpg between 10 AND 19 ";
	$result = mysql_query($sql); 
	$total = array();
	while(list($for_id, $date_in) = mysql_fetch_row($result)){
		$date_in = substr($date_in,5);
		$date_in = substr($date_in,0,-3);
		$total[$date_in] = $total[$date_in]+1;
	}


			$j= sprintf("%02d", $month_now);
		echo "<TD>&nbsp;",$total[$j],"&nbsp;</TD>";
		$sum = $sum+$total[$j];

?>

</TR>
<TR align="center">
<TD>CPG MI</TD>
<?php
	$sql = "Select distinct for_id , date_in From trauma_cpg_now where code_cpg between 20 AND 29 ";
	$result = mysql_query($sql); 
	$total = array();
	while(list($for_id, $date_in) = mysql_fetch_row($result)){
		$date_in = substr($date_in,5);
		$date_in = substr($date_in,0,-3);
		$total[$date_in] = $total[$date_in]+1;
	}

		$j= sprintf("%02d", $month_now);
		echo "<TD>&nbsp;",$total[$j],"&nbsp;</TD>";
		$sum = $sum+$total[$j];

?>

</TR>
<TR align="center">
<TD>CPG sepsis</TD>
<?php
	$sql = "Select distinct for_id , date_in From trauma_cpg_now where code_cpg between 30 AND 39 ";
	$result = mysql_query($sql); 
	$total = array();
	while(list($for_id, $date_in) = mysql_fetch_row($result)){
		$date_in = substr($date_in,5);
		$date_in = substr($date_in,0,-3);
		$total[$date_in] = $total[$date_in]+1;
	}

		$j= sprintf("%02d", $month_now);
		echo "<TD>&nbsp;",$total[$j],"&nbsp;</TD>";
		$sum = $sum+$total[$j];

?>

</TR>
<TR align="center">
<TD>CPG head injury</TD>
<?php
	$sql = "Select distinct for_id , date_in From trauma_cpg_now where code_cpg between 40 AND 49 ";
	$result = mysql_query($sql); 
	$total = array();
	while(list($for_id, $date_in) = mysql_fetch_row($result)){
		$date_in = substr($date_in,5);
		$date_in = substr($date_in,0,-3);
		$total[$date_in] = $total[$date_in]+1;
	}

		$j= sprintf("%02d", $month_now);
		echo "<TD>&nbsp;",$total[$j],"&nbsp;</TD>";
		$sum = $sum+$total[$j];

?>

</TR>
<TR align="center">
<TD>Stroke Fast track</TD>
<?php
	$sql = "Select distinct for_id , date_in From trauma_cpg_now where code_cpg between 50 AND 59 ";
	$result = mysql_query($sql); 
	$total = array();
	while(list($for_id, $date_in) = mysql_fetch_row($result)){
		$date_in = substr($date_in,5);
		$date_in = substr($date_in,0,-3);
		$total[$date_in] = $total[$date_in]+1;
	}

		$j= sprintf("%02d", $month_now);
		echo "<TD>&nbsp;",$total[$j],"&nbsp;</TD>";
		$sum = $sum+$total[$j];

?>

</TR>
<TR align="center">
	<TD>รวม</TD>
	<TD><?php echo $sum; ?></TD>
</TR>
</TABLE>

<BR><BR>

<?php
	
$list_cpg["10"] = "COPD";
$list_cpg["20"] = "MI";
$list_cpg["30"] = "sepsis";
$list_cpg["40"] = "head injury";
$list_cpg["50"] = "Stroke Fast track";

foreach($list_cpg as $key => $vlue){

	$sql = "Select date_format(date_in,'%d-%m-%Y'), hn, list_ptright, cure, age, dx From trauma_now  where row_id in (Select for_id From trauma_cpg_now where code_cpg between '".$key."' AND '".($key+9)."' ) ";

	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0 ){

	
?>
<TABLE align="center"  width="850" cellpadding="2" cellspacing="0">
<TR>
	<TD>CPG : <?php echo $vlue;?></TD>
</TR>
</TABLE>
<TABLE  align="center"  width="850" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000">
<TR align="center" >
	<TD>ลำดับ</TD>
	<TD>วดป.</TD>
	<TD>ชื่อ-สกุล</TD>
	<TD>HN/AN</TD>
	<TD>สิทธิ</TD>
	<TD>Dx</TD>
	<TD>อายุ</TD>
	<TD>Admit</TD>
	<TD>D/C</TD>
	<TD>Refer</TD>
</TR>
<?php
	
	$i=0;
	while(list($date_in, $hn, $ptright, $cure, $age, $dx) = mysql_fetch_row($result)){

list($fullname) = mysql_fetch_row(mysql_query("Select concat(yot,' ',name,' ',surname) From opcard where hn = '".$hn."' limit 1;"));

$img1 = "";
$img2 = "";
$img3 = "";

if($cure == "admit"){
	$img1 = "<img src=\"../check.gif\">";
}else if($cure == "d/c"){
	$img2 = "<img src=\"../check.gif\">";

}else if($cure == "refer"){
	$img3 = "<img src=\"../check.gif\">";

}

echo "
<TR>
	<TD align=\"center\">",++$i,".</TD>
	<TD align=\"center\">".$date_in."</TD>
	<TD>&nbsp;".$fullname."</TD>
	<TD>&nbsp;".$hn."</TD>
	<TD>".$list_ptright[$ptright]."</TD>
	<TD>".$dx."</TD>
	<TD>".$age."</TD>
	<TD align=\"center\" >&nbsp;".$img1."&nbsp;</TD>
	<TD align=\"center\" >&nbsp;".$img2."&nbsp;</TD>
	<TD align=\"center\" >&nbsp;".$img3."&nbsp;</TD>
</TR>
	";
	}	
?>
</TABLE><BR><BR>
<?php }?>
<?php }?>

<?php }?>


</body>
</html>





<?php include("unconnect.inc");?>