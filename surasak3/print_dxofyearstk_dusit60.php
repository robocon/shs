<Script Language="JavaScript">
function CloseWindowsInTime(t){
	t = t*1000;
	setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<?php 
include("connect.inc");
$part="สวนดุสิต60";
$sql="SELECT * FROM `opcardchk` WHERE part = '".$part."' and idcard='52-1081' order by row asc";
$query=mysql_query($sql)or die (mysql_error());
$i=351;

while($arr=mysql_fetch_array($query)){

	$i++;
	$hn=$arr["idcard"];

	$newname=substr($arr["name"],6);
	$name= $newname.' '.$arr["surname"];

	$labno1="170110".$i."01";
	$labno2="170110".$i."02";

	if($arr["pid"]=="1" || $arr["pid"]=="3"){
		//CBC
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>1-$i</b><center></font>";
		print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno1\"></span></div>";
		print "<div style=\"page-break-before: always;\"></div>";

		//CHEM
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>2-$i</b><center></font>";
		print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno2\"></span></div>";
		print "<div style=\"page-break-before: always;\"></div>";

		//UA
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>3-$i</b><center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>UA</b></center></font>";
		print "<div style=\"page-break-before: always;\"></div>";

	}else{
		//CBC
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>1-$i</b><center></font>";
		print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno1\"></span></div>";
		print "<div style=\"page-break-before: always;\"></div>";

		//CHEM
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>2-$i</b><center></font>";
		print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno2\"></span></div>";
		print "<div style=\"page-break-before: always;\"></div>";

		//UA
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>3-$i</b><center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>UA</b></center></font>";
		print "<div style=\"page-break-before: always;\"></div>";

		//1
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>4-$i</b><center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>OUTLAB</b></center></font>";
		print "<div style=\"page-break-before: always;\"></div>";

		//2
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>4-$i</b><center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>OUTLAB</b></center></font>";
		print "<div style=\"page-break-before: always;\"></div>";

		//3
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>4-$i</b><center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>OUTLAB</b></center></font>";
		print "<div style=\"page-break-before: always;\"></div>";

		//4
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>4-$i</b><center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>OUTLAB</b></center></font>";
		print "<div style=\"page-break-before: always;\"></div>";

		//5
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>4-$i</b><center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>OUTLAB</b></center></font>";
		print "<div style=\"page-break-before: always;\"></div>";

		//STOOL
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>5-$i</b><center></font>";
		print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>STOOL</b></center></font>";
		print "<div style=\"page-break-before: always;\"></div>";
	}

}
?>
