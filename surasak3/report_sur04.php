<?php

set_time_limit(3);
include("connect.inc");
include("memo_sur_in.php");
?>

<form method='POST' action='report_sur04.php'>
	<TABLE id="form_01" style="font-size: 14px; font-family: 'MS Sans Serif'; ">
	<TR>
		<TD>
	
	พ.ศ. <input type='text' name='year' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' ></TD>
	</TR>
	</TABLE>
	</form>


<?php
if(isset($_POST["year"])){

$list = array();

echo "<FONT style=\"font-size: 14px; font-family: 'MS Sans Serif';\"><CENTER>สรุปยอดผู้ป่วยแบ่งตามสิทธิการรักษา ปีงบประมาณ ".$_POST["year"]."</CENTER></FONT>";
echo "<TABLE border=\"1\" align=\"center\" border='1' bordercolor=\"#000000\" style=\"font-size: 14px; font-family: 'MS Sans Serif'; BORDER-COLLAPSE: collapse;\" cellpadding=\"2\">";
echo "<TR>";
	echo "<TD rowspan=\"2\">เดือน ปี</TD>";
	 foreach( $cfg_ptright as  $key => $value){
		echo "<TD colspan=\"2\" width=\"80\" align=\"center\">".$value."</TD>";
	 }
		echo "<TD colspan=\"3\" width=\"80\" align=\"center\">รวม</TD>";
echo "</TR>";
echo "<TR>";
 foreach( $cfg_ptright as  $key => $value){
		echo "<TD width=\"40\"  align=\"center\">ใหญ่</TD><TD width=\"20\"  align=\"center\">เล็ก</TD>";
	 }
	 echo "<TD width=\"40\"  align=\"center\">ใหญ่</TD><TD width=\"20\"  align=\"center\">เล็ก</TD><TD width=\"20\"  align=\"center\">รวม</TD>";
echo "</TR>";
$sum2= array();
for($i=10;$i<=12;$i++){
	$year = ($_POST["year"]-1);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_ptright as  $key => $value){

		 $sql = "Select type_case,count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND ptright = '".$key."' Group by type_case  ";
		 $result = mysql_query($sql);
		 while(list($type_case,$count) = mysql_fetch_row($result)){
			$list[$type_case] = $count;
		 }
		
		
		echo "<TD>".($list["TC1"])."</TD>";
		echo "<TD>".($list["TC2"]+$list["TC3"])."</TD>";
		$sum1_1 += ($list["TC1"]);
		$sum1_2 += ($list["TC2"]+$list["TC3"]);
		$list = array();
		$sum2[$key][0] += ($list["TC1"]);
		$sum2[$key][1] += ($list["TC2"]+$list["TC3"]);

	 }
		echo "<TD>".($sum1_1)."</TD>";
		echo "<TD>".$sum1_2."</TD>";
		echo "<TD>".($sum1_1+$sum1_2)."</TD>";
		$sum1_1 = 0;$sum1_2 = 0;
echo "</TR>";
}
for($i=1;$i<=9;$i++){
	$year = ($_POST["year"]);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_ptright as  $key => $value){

		 $sql = "Select type_case,count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND ptright = '".$key."' Group by type_case  ";
		 $result = mysql_query($sql);
		 while(list($type_case,$count) = mysql_fetch_row($result)){
			$list[$type_case] = $count;
		 }
		
		echo "<TD>".($list["TC1"])."</TD>";
		echo "<TD>".($list["TC2"]+$list["TC3"])."</TD>";
		$sum1_1 += ($list["TC1"]);
		$sum1_2 += ($list["TC2"]+$list["TC3"]);
		$sum2[$key][0] += ($list["TC1"]);
		$sum2[$key][1] += ($list["TC2"]+$list["TC3"]);
		$list = array();

	 }
		echo "<TD>".($sum1_1)."</TD>";
		echo "<TD>".$sum1_2."</TD>";
		echo "<TD>".($sum1_1+$sum1_2)."</TD>";
		$sum1_1 = 0;$sum1_2 = 0;
echo "</TR>";
}

echo "<TR>";
	echo "<TD>รวม</TD>";
foreach( $cfg_ptright as  $key => $value){
	echo "<TD>".$sum2[$key][0]."</TD>";
	echo "<TD>".$sum2[$key][1]."</TD>";
	$sum2_1 += $sum2[$key][0];
	$sum2_2 += $sum2[$key][1];
}
	echo "<TD>".$sum2_1."</TD>";
	echo "<TD>".$sum2_2."</TD>";
	echo "<TD>".($sum2_1+$sum2_2)."</TD>";
echo "</TR>";
echo "</TABLE>";

//******************************************************************************************************************************

echo "<BR><BR>";
echo "<FONT style=\"font-size: 14px; font-family: 'MS Sans Serif';\"><CENTER>สรุปยอดผู้ป่วยแบ่งตามสิทธิการรักษา ปีพ.ศ. ".$_POST["year"]."</CENTER></FONT>";
echo "<TABLE border=\"1\" align=\"center\" border='1' bordercolor=\"#000000\" style=\"font-size: 14px; font-family: 'MS Sans Serif'; BORDER-COLLAPSE: collapse;\" cellpadding=\"2\">";
echo "<TR>";
	echo "<TD rowspan=\"2\">เดือน ปี</TD>";
	 foreach( $cfg_ptright as  $key => $value){
		echo "<TD colspan=\"2\" width=\"80\" align=\"center\">".$value."</TD>";
	 }
	 echo "<TD colspan=\"3\" width=\"80\" align=\"center\">รวม</TD>";
echo "</TR>";
echo "<TR>";
 foreach( $cfg_ptright as  $key => $value){
		echo "<TD width=\"40\"  align=\"center\">ใหญ่</TD><TD width=\"20\"  align=\"center\">เล็ก</TD>";
	 }
	  echo "<TD width=\"40\"  align=\"center\">ใหญ่</TD><TD width=\"20\"  align=\"center\">เล็ก</TD><TD width=\"20\"  align=\"center\">รวม</TD>";
echo "</TR>";
$sum2 = array();
$sum2_1 = 0;
$sum2_2 = 0;

for($i=1;$i<=12;$i++){
	$year = ($_POST["year"]);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_ptright as  $key => $value){

		 $sql = "Select type_case,count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND ptright = '".$key."' Group by type_case  ";
		 $result = mysql_query($sql);
		 while(list($type_case,$count) = mysql_fetch_row($result)){
			$list[$type_case] = $count;
		 }
		
		echo "<TD>".($list["TC1"])."</TD>";
		echo "<TD>".($list["TC2"]+$list["TC3"])."</TD>";
		$sum1_1 += ($list["TC1"]);
		$sum1_2 += ($list["TC2"]+$list["TC3"]);
		$sum2[$key][0] += ($list["TC1"]);
		$sum2[$key][1] += ($list["TC2"]+$list["TC3"]);
		$list = array();

	 }
		echo "<TD>".($sum1_1)."</TD>";
		echo "<TD>".$sum1_2."</TD>";
		echo "<TD>".($sum1_1+$sum1_2)."</TD>";
		$sum1_1 = 0;$sum1_2 = 0;
echo "</TR>";
}
echo "<TR>";
	echo "<TD>รวม</TD>";
foreach( $cfg_ptright as  $key => $value){
	echo "<TD>".$sum2[$key][0]."</TD>";
	echo "<TD>".$sum2[$key][1]."</TD>";
	$sum2_1 += $sum2[$key][0];
	$sum2_2 += $sum2[$key][1];
}
	echo "<TD>".$sum2_1."</TD>";
	echo "<TD>".$sum2_2."</TD>";
	echo "<TD>".($sum2_1+$sum2_2)."</TD>";
echo "</TR>";
echo "</TABLE>";
}

include("unconnect.inc");
?>


