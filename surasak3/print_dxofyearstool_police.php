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
$sql="SELECT * FROM `opcardchk` WHERE part = '".$part."' order by row asc";
$query=mysql_query($sql)or die (mysql_error());
$i=300;
while($arr=mysql_fetch_array($query)){
$i++;
$hn=$arr["HN"];
$name= $arr["yot"].' '.$arr["name"].' '.$arr["surname"];
$exam_no=$arr["exam_no"];

print "<font  style='line-height:25px;'  face='Angsana New' size='5'><center>HN $hn ($i)<br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='3'><center>$name<br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='4'><u><b>STOOL</u> </b></font></center>";
print "<div style=\"page-break-before: always;\"></div>";
}
?>
