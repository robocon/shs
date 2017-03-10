<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<? 
include("connect.inc");
$part="ราชทัณฑ์59";
$sql="SELECT * FROM `opcardchk` WHERE part = '".$part."' order by row asc limit 5,883";
$query=mysql_query($sql)or die (mysql_error());
while($arr=mysql_fetch_array($query)){
$hn=$arr["HN"];
$name= $arr["yot"].' '.$arr["name"].' '.$arr["surname"];
$exam_no=$arr["exam_no"];

print "<font  style='line-height:25px;'  face='Angsana New' size='5'><center>HN $hn ($exam_no)<br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='3'><center>$name<br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='4'><u><b>X-RAY</u> </b></font></center>";
print "<div style=\"page-break-before: always;\"></div>";
}
?>
