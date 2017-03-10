<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<? 
include("connect.inc");
$part="สอบตำรวจ59";
$sql="SELECT * FROM `opcardchk` WHERE part = '".$part."' order by row asc limit 220,1";
$query=mysql_query($sql)or die (mysql_error());
$i=520;
while($arr=mysql_fetch_array($query)){
$i++;
$hn=$arr["HN"];
$name= $arr["yot"].' '.$arr["name"].' '.$arr["surname"];
$exam_no=$i;

$labno2="161218".$i."01";

print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center>HN $hn ($exam_no)<br></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='3'><center>$name<br></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='4'><u><b>CHEM</u> </b></font></center>";
print "<div style=\"page-break-before: always;\"></div>";

print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center>HN $hn ($exam_no)<br></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='3'><center>$name<br></font>";
print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno2\"></span></div>";
print "<div style=\"page-break-before: always;\"></div>";

print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center>HN $hn ($exam_no)<br></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='3'><center>$name<br></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='4'><u><b>UA</u> </b></font></center>";
print "<div style=\"page-break-before: always;\"></div>";

print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center>HN $hn ($exam_no)<br></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='3'><center>$name<br></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='4'><u><b>STOOL</u> </b></font></center>";
print "<div style=\"page-break-before: always;\">&nbsp;</div>";

}
?>
