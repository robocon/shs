<?php

set_time_limit(3);
include("connect.inc");
include("memo_sur_in.php");
?>

<form method='POST' action='report_sur06.php'>
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

$sum1 = array();
$sum2 = array();

echo "<FONT style=\"font-size: 14px; font-family: 'MS Sans Serif';\"><CENTER>สรุปยอดผู้ป่วย แบ่งตามประเภทของผู้ป่วย ห้องผ่าตัดเล็ก ปีงบประมาณ ".$_POST["year"]."</CENTER></FONT>";
echo "<TABLE border=\"1\" align=\"center\" border='1' bordercolor=\"#000000\" style=\"font-size: 14px; font-family: 'MS Sans Serif'; BORDER-COLLAPSE: collapse;\" cellpadding=\"2\">";
echo "<TR>";
	echo "<TD>เดือน ปี</TD>";
	 foreach( $cfg_type_wounded as  $key => $value){
		echo "<TD>".$value."</TD>";
	 }
	 echo "<TD>รวม</TD>";
echo "</TR>";
for($i=10;$i<=12;$i++){
	$year = ($_POST["year"]-1);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_type_wounded as  $key => $value){

		 $sql = "Select count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND type_wounded = '".$key."' AND type_case in ('TC2','TC3') ";
		 list($count) = mysql_fetch_row(mysql_query($sql));
		echo "<TD>".$count."</TD>";
		$sum1[$j] += $count;
		$sum2[$key] += $count;
	 }
	 echo "<TD>".$sum1[$j]."</TD>";
echo "</TR>";
}
for($i=1;$i<=9;$i++){
	$year = ($_POST["year"]);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_type_wounded as  $key => $value){

		 $sql = "Select count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND type_wounded = '".$key."' AND type_case in ('TC2','TC3')  ";
		 list($count) = mysql_fetch_row(mysql_query($sql));
		echo "<TD>".$count."</TD>";
		$sum1[$j] += $count;
		$sum2[$key] += $count;
	 }
	 echo "<TD>".$sum1[$j]."</TD>";
echo "</TR>";
}
echo "<TR>";
	echo "<TD>รวม</TD>";
	 foreach( $cfg_type_wounded as  $key => $value){
		echo "<TD>".$sum2[$key]."</TD>";
	 }
	 echo "<TD>".array_sum($sum2)."</TD>";
	 echo "</TD>";
 echo "</TR>";
echo "</TABLE>";

$sum1 = array();
$sum2 = array();

echo "<BR><BR>";
echo "<FONT style=\"font-size: 14px; font-family: 'MS Sans Serif';\"><CENTER>สรุปยอดผู้ป่วย แบ่งตามประเภทของผู้ป่วย ห้องผ่าตัดเล็ก ปีพ.ศ. ".$_POST["year"]."</CENTER></FONT>";
echo "<TABLE border=\"1\" align=\"center\" border='1' bordercolor=\"#000000\" style=\"font-size: 14px; font-family: 'MS Sans Serif'; BORDER-COLLAPSE: collapse;\" cellpadding=\"2\">";
echo "<TR>";
	echo "<TD>เดือน ปี</TD>";
	 foreach( $cfg_type_wounded as  $key => $value){
		echo "<TD>".$value."</TD>";
	 }
	 echo "<TD>รวม</TD>";
echo "</TR>";
for($i=1;$i<=12;$i++){
	$year = ($_POST["year"]);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_type_wounded as  $key => $value){

		 $sql = "Select count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND type_wounded = '".$key."' AND type_case in ('TC2','TC3')  ";
		 list($count) = mysql_fetch_row(mysql_query($sql));
		echo "<TD>".$count."</TD>";
		$sum1[$j] += $count;
		$sum2[$key] += $count;
	 }
	 echo "<TD>".$sum1[$j]."</TD>";
echo "</TR>";
}
echo "<TR>";
	echo "<TD>รวม</TD>";
	 foreach( $cfg_type_wounded as  $key => $value){
		echo "<TD>".$sum2[$key]."</TD>";
	 }
	 echo "<TD>".array_sum($sum2)."</TD>";
	 echo "</TD>";
 echo "</TR>";
echo "</TABLE>";
}

include("unconnect.inc");
?>


