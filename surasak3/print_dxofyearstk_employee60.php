<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<? 
include("connect.inc");
$part="ลูกจ้าง60";
$sql="SELECT * FROM `opcardchk` WHERE part = '".$part."' order by exam_no asc";
$query=mysql_query($sql)or die (mysql_error());
while($arr=mysql_fetch_array($query)){
$i=$arr["exam_no"];
$hn=$arr["HN"];
$name= $arr["name"]." ".$arr["surname"];

$labno1="170312".$i."01";
$labno2="170312".$i."02";

if($arr["pid"]=="1"){
//CBC
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>1-$i</b><center></font>";
print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno1\"></span></div>";
print "<div style=\"page-break-before: always;\"></div>";

//UA
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>3-$i</b><center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>UA</b></center></font>";
print "<div style=\"page-break-before: always;\"></div>";


print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>$hn</b><center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>P.1 ($i)</b></center></font>";
print "<div style=\"page-break-before: always;\"></div>";

}else if($arr["pid"]=="3"){
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


print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>$hn</b><center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>P.3 ($i)</b></center></font>";
print "<div style=\"page-break-before: always;\"></div>";

}else{
//CBC
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name***</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>1-$i</b><center></font>";
print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno1\"></span></div>";
print "<div style=\"page-break-before: always;\"></div>";

//CHEM
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name***</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>2-$i</b><center></font>";
print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno2\"></span></div>";
print "<div style=\"page-break-before: always;\"></div>";

//UA
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name***</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>3-$i</b><center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>UA</b></center></font>";
print "<div style=\"page-break-before: always;\"></div>";


print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name***</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>$hn</b><center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>P.4 ($i)</b></center></font>";
print "<div style=\"page-break-before: always;\"></div>";
}

}
?>
