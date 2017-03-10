<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<? 
include("connect.inc");
$part="อินทราเซรามิค";
$sql="SELECT * FROM `opcardchk` WHERE part = '".$part."' order by row asc";
$query=mysql_query($sql)or die (mysql_error());
while($arr=mysql_fetch_array($query)){
$hn=$arr["HN"];
//$hn="47-9999";
$name= $arr["yot"].' '.$arr["name"].' '.$arr["surname"];
//$name="พ.ต. สมยศ แสงสุข";
$exam_no=$arr["exam_no"];
$cLab=$arr["exam_no"]; 
//$cLab="124";
$Thaidate="20-10-2558 01:01:01";
$nLab21=sprintf("%03d",$cLab);
$labno="151021".$nLab21."02";

print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>HN:$hn<br></font>";
print "<font  style='line-height:20px;'  face='Angsana New' size='3'><center>$name<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><u><b>CHEM</b></u><br></font>";
print "<DIV style='left:65PX;top:55PX;width:100PX;height:10PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno\"></span></DIV>";
print "<div style=\"page-break-before: always;\"></div>";

/*print "<font  style='line-height:25px;'  face='Angsana New' size='5'><center>HN $hn <br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='3'><center>$name<br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='4'><u><b>UA</u> </b></font></center>";
print "<div style=\"page-break-before: always;\"></div>";*/

}
//echo date("Y-m-d H:i:s");
?>
