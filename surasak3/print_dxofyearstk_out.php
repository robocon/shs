<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<? 
include("connect.inc");
$sql="SELECT * FROM `opcardchk` WHERE part = '".$_GET['part']."' order by hn asc";
$query=mysql_query($sql)or die (mysql_error());
while($arr=mysql_fetch_array($query)){
$hn=$arr["HN"];
$name= $arr["yot"].' '.$arr["name"].' '.$arr["surname"];
$exam_no=$arr["exam_no"];

print "<font  style='line-height:25px;'  face='Angsana New' size='5'><center>HN $hn <br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='3'><center>$exam_no.$name<br></font>";
//print "<font  style='line-height:20px;'  face='Angsana New' size='4'><u><b>$_GET[idcard]</u></b></font></center>";
print "<font  style='line-height:25px;'  face='Angsana New' size='4'><u><b>CHEM</u> </b></font></center>";
print "<div style=\"page-break-before: always;\"></div>";

print "<font  style='line-height:25px;'  face='Angsana New' size='5'><center>HN $hn <br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='3'><center>$exam_no.$name<br></font>";
//print "<font  style='line-height:20px;'  face='Angsana New' size='4'><u><b>$_GET[idcard]</u></b></font></center>";
print "<font  style='line-height:25px;'  face='Angsana New' size='4'><u><b>CBC</u> </b></font></center>";
print "<div style=\"page-break-before: always;\"></div>";
}
?>
