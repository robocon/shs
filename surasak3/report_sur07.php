<?php

set_time_limit(3);
include("connect.inc");
include("memo_sur_in.php");
?>

<form method='POST' action='report_sur07.php'>
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

echo "<FONT style=\"font-size: 14px; font-family: 'MS Sans Serif';\"><CENTER>สรุปยอดผู้ป่วยแบ่งตามประเภทบาดแผลผ่าตัด(ผ่าตัดเล็ก) ปีงบประมาณ ".$_POST["year"]."</CENTER></FONT>";
echo "<TABLE border=\"1\" align=\"center\" border='1' bordercolor=\"#000000\" style=\"font-size: 14px; font-family: 'MS Sans Serif'; BORDER-COLLAPSE: collapse;\" cellpadding=\"2\">";
echo "<TR>";
	echo "<TD rowspan=\"2\" width=\"100\">เดือน ปี</TD>";
	 foreach( $cfg_surgery as  $key => $value){
		echo "<TD colspan=\"4\" width=\"80\" align=\"center\">".$value."</TD>";
	 }
	 echo "<TD colspan=\"5\" width=\"100\" align=\"center\">รวม</TD>";
echo "</TR>";
echo "<TR>";
 foreach( $cfg_surgery as  $key => $value){
		echo "<TD width=\"20\"  align=\"center\">1</TD><TD width=\"20\"  align=\"center\">2</TD><TD width=\"20\"  align=\"center\">3</TD><TD width=\"20\"  align=\"center\">4</TD>";
	 }
	 echo "<TD width=\"20\"  align=\"center\">1</TD><TD width=\"20\"  align=\"center\">2</TD><TD width=\"20\"  align=\"center\">3</TD><TD width=\"20\"  align=\"center\">4</TD><TD width=\"20\"  align=\"center\">S</TD>";
echo "</TR>";
for($i=10;$i<=12;$i++){
	$year = ($_POST["year"]-1);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_surgery as  $key => $value){

		 $sql = "Select type_scar,count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND surgery = '".$key."' AND type_case in ('TC2','TC3') Group by type_scar  ";
		 $result = mysql_query($sql);

		 while(list($type_scar,$count) = mysql_fetch_row($result)){
			$list[$type_scar] = $count;
			$sum1[$type_scar] += $count;
			$sum11 += $count;
		 }
		
		foreach( $cfg_type_scar as  $key => $value){
		echo "<TD>".$list[$key]."</TD>";
		}

		$list = array();

	 }
	 echo "<TD width=\"20\"  align=\"center\">",$sum1["S01"],"</TD><TD width=\"20\"  align=\"center\">",$sum1["S02"],"</TD><TD width=\"20\"  align=\"center\">",$sum1["S03"],"</TD><TD width=\"20\"  align=\"center\">",$sum1["S04"],"</TD><TD width=\"20\"  align=\"center\">",$sum11,"</TD>";
	 $sum1 = array();
	$sum11 = 0;
echo "</TR>";
}
for($i=1;$i<=9;$i++){
	$year = ($_POST["year"]);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_surgery as  $key => $value){

		 $sql = "Select type_scar,count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND surgery = '".$key."' Group by type_scar  ";
		 $result = mysql_query($sql);
		 while(list($type_scar,$count) = mysql_fetch_row($result)){
			$list[$type_scar] = $count;
			$sum1[$type_scar] += $count;
			$sum2[$key][$type_scar] += $count;
			$sum11 += $count;
		 }
		
		foreach( $cfg_type_scar as  $key => $value){
		echo "<TD>".$list[$key]."</TD>";
		}
		$list = array();

	 }
	 echo "<TD width=\"20\"  align=\"center\">",$sum1["S01"],"</TD><TD width=\"20\"  align=\"center\">",$sum1["S02"],"</TD><TD width=\"20\"  align=\"center\">",$sum1["S03"],"</TD><TD width=\"20\"  align=\"center\">",$sum1["S04"],"</TD><TD width=\"20\"  align=\"center\">",$sum11,"</TD>";
	 $sum1 = array();
	$sum11 = 0;
echo "</TR>";
}
	echo "<TR>";
	echo "<TD>รวม</TD>";
 foreach( $cfg_surgery as  $key => $value){
	foreach( $cfg_type_scar as  $key2 => $value2){
		echo "<TD width=\"20\"  align=\"center\">",$sum2[$key][$key2],"</TD>";
		$sum2_2[$key2] += $sum2[$key][$key2];
		$sum3 += $sum2[$key][$key2];
		
	}
 }
	foreach( $cfg_type_scar as  $key2 => $value2){
	echo "<TD width=\"20\"  align=\"center\">",$sum2_2[$key2],"</TD>";
	}
	echo "<TD width=\"20\"  align=\"center\">",$sum3,"</TD>";
	echo "</TR>";
$sum2_2 = array();
$sum3=0;

echo "</TABLE>";

/********************************************************/

$list = array();

echo "<FONT style=\"font-size: 14px; font-family: 'MS Sans Serif';\"><CENTER>สรุปยอดผู้ป่วยแบ่งตามประเภทบาดแผลผ่าตัด(ผ่าตัดเล็ก) ปีพ.ศ. ".$_POST["year"]."</CENTER></FONT>";
echo "<TABLE border=\"1\" align=\"center\" border='1' bordercolor=\"#000000\" style=\"font-size: 14px; font-family: 'MS Sans Serif'; BORDER-COLLAPSE: collapse;\" cellpadding=\"2\">";
echo "<TR>";
	echo "<TD rowspan=\"2\" width=\"100\">เดือน ปี</TD>";
	 foreach( $cfg_surgery as  $key => $value){
		echo "<TD colspan=\"4\" width=\"80\" align=\"center\">".$value."</TD>";
	 }
	 echo "<TD colspan=\"5\" width=\"100\" align=\"center\">รวม</TD>";
echo "</TR>";
echo "<TR>";
 foreach( $cfg_surgery as  $key => $value){
		echo "<TD width=\"20\"  align=\"center\">1</TD><TD width=\"20\"  align=\"center\">2</TD><TD width=\"20\"  align=\"center\">3</TD><TD width=\"20\"  align=\"center\">4</TD>";
	 }
	 echo "<TD width=\"20\"  align=\"center\">1</TD><TD width=\"20\"  align=\"center\">2</TD><TD width=\"20\"  align=\"center\">3</TD><TD width=\"20\"  align=\"center\">4</TD><TD width=\"20\"  align=\"center\">S</TD>";
echo "</TR>";
$sum2 = array();
for($i=1;$i<=12;$i++){
	$year = ($_POST["year"]);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_surgery as  $key => $value){

		 $sql = "Select type_scar,count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND surgery = '".$key."' Group by type_scar  ";
		 $result = mysql_query($sql);
		 while(list($type_scar,$count) = mysql_fetch_row($result)){
			$list[$type_scar] = $count;
			$sum1[$type_scar] += $count;
			$sum2[$key][$type_scar] += $count;
			$sum11 += $count;
		 }
		
		foreach( $cfg_type_scar as  $key => $value){
		echo "<TD>".$list[$key]."</TD>";
		}
		$list = array();

	 }
	 echo "<TD width=\"20\"  align=\"center\">",$sum1["S01"],"</TD><TD width=\"20\"  align=\"center\">",$sum1["S02"],"</TD><TD width=\"20\"  align=\"center\">",$sum1["S03"],"</TD><TD width=\"20\"  align=\"center\">",$sum1["S04"],"</TD><TD width=\"20\"  align=\"center\">",$sum11,"</TD>";
	 $sum1 = array();
	$sum11 = 0;
echo "</TR>";
}
	echo "<TR>";
	echo "<TD>รวม</TD>";
	
 foreach( $cfg_surgery as  $key => $value){
	foreach( $cfg_type_scar as  $key2 => $value2){
		echo "<TD width=\"20\"  align=\"center\">",$sum2[$key][$key2],"</TD>";
		$sum2_2[$key2] += $sum2[$key][$key2];
		$sum3 += $sum2[$key][$key2];
		
	}
 }
	foreach( $cfg_type_scar as  $key2 => $value2){
	echo "<TD width=\"20\"  align=\"center\">",$sum2_2[$key2],"</TD>";
	}
	echo "<TD width=\"20\"  align=\"center\">",$sum3,"</TD>";
	echo "</TR>";
$sum2_2 = array();
$sum3=0;

echo "</TABLE>";
}

include("unconnect.inc");
?>


