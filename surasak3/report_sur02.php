<?php

set_time_limit(3);
include("connect.inc");
include("memo_sur_in.php");
?>

<form method='POST' action='report_sur02.php'>
	<TABLE id="form_01" style="font-size: 14px; font-family: 'MS Sans Serif'; ">
	<TR>
		<TD>
	
	�.�. <input type='text' name='year' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	
	<TR>
		<TD><input type='submit' name="submit" value='     ��ŧ     ' ></TD>
	</TR>
	</TABLE>
	</form>


<?php
if(isset($_POST["year"])){
echo "<FONT style=\"font-size: 14px; font-family: 'MS Sans Serif';\"><CENTER>��ػ�ʹ������ �觵�����¡��� ��ͧ��ҵѴ�˭� �է�����ҳ ".$_POST["year"]."</CENTER></FONT>";
echo "<TABLE border=\"1\" align=\"center\" border='1' bordercolor=\"#000000\" style=\"font-size: 14px; font-family: 'MS Sans Serif'; BORDER-COLLAPSE: collapse;\" cellpadding=\"2\">";
echo "<TR>";
	echo "<TD>��͹ ��</TD>";
	 foreach( $cfg_surgery as  $key => $value){
		echo "<TD>".$value."</TD>";
	 }
		echo "<TD>���</TD>";
echo "</TR>";
$sum = array();
for($i=10;$i<=12;$i++){
	$sum1 = 0;
	
	$year = ($_POST["year"]-1);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_surgery as  $key => $value){

		 $sql = "Select count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND surgery = '".$key."' AND type_case = 'TC1' ";
		 list($count) = mysql_fetch_row(mysql_query($sql));
		echo "<TD>".$count."</TD>";
		$sum1 +=$count;
		$sum[$key] += $count;
	 }
		echo "<TD>".$sum1."</TD>";
echo "</TR>";

}
for($i=1;$i<=9;$i++){
	$sum1 = 0;
	$year = ($_POST["year"]);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_surgery as  $key => $value){

		 $sql = "Select count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND surgery = '".$key."' AND type_case = 'TC1'  ";
		 list($count) = mysql_fetch_row(mysql_query($sql));
		echo "<TD>".$count."</TD>";
		$sum1 +=$count;
		$sum[$key] += $count;
	 }
	 echo "<TD>".$sum1."</TD>";
echo "</TR>";
}
echo "<TR>";
	echo "<TD>���</TD>";
	 foreach( $cfg_surgery as  $key => $value){
		echo "<TD>{$sum[$key]}</TD>";
		$sum2 +=$sum[$key];
	 }
	 echo "<TD>".$sum2."</TD>";
echo "</TR>";
echo "</TABLE>";
	
echo "<BR><BR>";
echo "<FONT style=\"font-size: 14px; font-family: 'MS Sans Serif';\"><CENTER>��ػ�ʹ������ �觵�����¡��� ��ͧ��ҵѴ�˭� �վ.�. ".$_POST["year"]."</CENTER></FONT>";
echo "<TABLE border=\"1\" align=\"center\" border='1' bordercolor=\"#000000\" style=\"font-size: 14px; font-family: 'MS Sans Serif'; BORDER-COLLAPSE: collapse;\" cellpadding=\"2\">";
echo "<TR>";
	echo "<TD>��͹ ��</TD>";
	$sum = array();
	 foreach( $cfg_surgery as  $key => $value){
		echo "<TD>".$value."</TD>";
	 }
	 echo "<TD>���</TD>";
echo "</TR>";
for($i=1;$i<=12;$i++){
	$sum1 = 0;
	$year = ($_POST["year"]);
	$j= sprintf("%02d",$i);
echo "<TR>";
	echo "<TD>".$month[$j]." ".$year."</TD>";
	 foreach( $cfg_surgery as  $key => $value){

		 $sql = "Select count(hn) From memo_sur where thaidate like '".$year."-".$j."%' AND surgery = '".$key."' AND type_case = 'TC1'  ";
		 list($count) = mysql_fetch_row(mysql_query($sql));
		echo "<TD>".$count."</TD>";
		$sum1 += $count;
		$sum[$key] += $count;
	 }
		echo "<TD>".$sum1."</TD>";
echo "</TR>";
}
echo "<TR>";
	echo "<TD>���</TD>";
	$sum2 = 0;
	 foreach( $cfg_surgery as  $key => $value){

		echo "<TD>".$sum[$key]."</TD>";
		$sum2 += $sum[$key];

	 }
		echo "<TD>".$sum2."</TD>";
echo "</TR>";
echo "</TABLE>";
}

include("unconnect.inc");
?>


