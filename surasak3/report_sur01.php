<?php

set_time_limit(3);
include("connect.inc");

?>

<form method='POST' action='report_sur01.php'>
	<TABLE id="form_01" style="font-size: 14px; font-family: 'MS Sans Serif'; ">
	<TR>
		<TD>
	
	เดือน&nbsp; <input type='text' name='month' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='year' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' ></TD>
	</TR>
	</TABLE>
	</form>


<?php
if(isset($_POST["month"]) && isset($_POST["year"])){

	$l = date("",mktime(0,0,0,$_POST["month"],1,$_POST["year"]-543));
$list = array();
for($i=1;$i<= 31 ;$i++){
	
	if(checkdate($_POST["month"],$i,$_POST["year"]-543)){
		$w = date("w",mktime(0,0,0,$_POST["month"],$i,$_POST["year"]-543));
		if($w == 0 || $w == 6){
			array_push($list,$_POST["year"]."-".sprintf("%02d",$_POST["month"])."-".sprintf("%02d",$i));
			
		}

	}
}

$sql = "Select date_holiday From holiday where date_holiday like '".$_POST["year"]."-".sprintf("%02d",$_POST["month"])."%' ";
$result = mysql_query($sql);
while($arr = mysql_fetch_assoc($result)){
	array_push($list,$arr["date_holiday"]);
}

if(count($list) > 0){
	$where = " (thaidate in ('".implode("','",$list)."')) OR ";
}

$sql = "Select hn,date_format(thaidate,'%d/%m/%Y') as dt2, ptname, doctor, diag, opertion, timein, timeout  From memo_sur where ".$where." (thaidate like '".($_POST["year"])."-".sprintf("%02d",$_POST["month"])."%' AND ( (timein >= '16:00:00' AND timein <= '23:59:59') OR (timein >= '00:00:00' AND timein < '08:00:00') OR (thaidate like '".($_POST["year"])."-".sprintf("%02d",$_POST["month"])."%' AND ((timeout >= '16:00:00' AND timeout <= '23:59:59') OR (timeout >= '00:00:00' AND timeout < '08:00:00'))) ))";

$result = mysql_query($sql);
echo "<TABLE border='1' bordercolor=\"#000000\" style=\"font-size: 14px; font-family: 'MS Sans Serif'; BORDER-COLLAPSE: collapse;\" cellpadding=\"2\">";
echo "<TR align=\"center\">
<TD>No.</TD>
<TD>ว/ด/ป</TD>
<TD>ชื่อ-สกุล</TD>
<TD>แพทย์</TD>
<TD>Dx</TD>
<TD>Opertion</TD>
<TD>เวลา</TD>
</TR>";
$i=1;
while($arr = mysql_fetch_assoc($result)){
if($arr["hn"] != "49-6677"){


echo "<TR>
				<TD>".$i.".</TD>
				<TD>".$arr["dt2"]."</TD>
				<TD>".$arr["ptname"]."</TD>
				<TD>".$arr["doctor"]."</TD>
				<TD>".$arr["diag"]."</TD>
				<TD>".$arr["opertion"]."</TD>
				<TD>".$arr["timeout"]."</TD>
			</TR>";
$i++;
}
}
}

include("unconnect.inc");
?>


