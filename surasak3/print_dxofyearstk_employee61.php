<?php
include("connect.inc");

$part = "ลูกจ้าง61";
$part = "test61";

$sql = "SELECT * FROM `opcardchk` 
WHERE `part` = '$part' 
ORDER BY `pid`";
$query = mysql_query($sql) or die (mysql_error());
$i = 301;

while($arr = mysql_fetch_array($query)){

	$hn = $arr["hn"];
	$age = $arr['agey'];

	$name = $arr["name"].' '.$arr["surname"];

	$labno1 = "180422".$i."01";
	$labno2 = "180422".$i."02";


	//CBC
	print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$name</b></center></font>";
	print "<div style='text-align:center;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno1\"></span></div>";
	print "<div style=\"page-break-before: always;\"></div>";

	//CHEM
	print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$name</b></center></font>";
	print "<div style='text-align:center;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno2\"></span></div>";
	print "<div style=\"page-break-before: always;\"></div>";

	//UA
	print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$name</b></center></font>";
	print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$hn</b></center></font>";
	print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>UA</b></center></font>";
	print "<div style=\"page-break-before: always;\"></div>";

	//1
	print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$name</b></center></font>";
	print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$hn</b></center></font>";
	print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>180422$i</b></center></font>";
	print "<div style=\"page-break-before: always;\"></div>";

	if( $age >= 50 ){
		//2
		print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$hn</b></center></font>";
		print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>180422$i</b></center></font>";
		print "<div style=\"page-break-before: always;\"></div>";
	}

	$i++;
}
?>
<Script Language="JavaScript">
	function CloseWindowsInTime(t){
		t = t*1000;
		setTimeout("window.close()",t);
	}
	CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>