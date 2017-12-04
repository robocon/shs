<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<? 
include("connect.inc");
$part="ควอลิตี้เซรามิค60";
$sql="SELECT * FROM `opcardchk` WHERE part = '".$part."' order by row asc limit 600,10";
$query=mysql_query($sql)or die (mysql_error());
while($arr=mysql_fetch_array($query)){
$hn=$arr["HN"];
$name= $arr["name"].' '.$arr["surname"];
$cLab=$arr["exam_no"]; 
//$cLab="124";

$exam_no=sprintf("%03d",$cLab);
$labcbc="170816".$exam_no."01";
$labno="170816".$exam_no."02";

list($firstname,$lastname)=explode("ไม่มีนามสกุล",$name);
if(!empty($firstname)){
	$name=$firstname;
	$numname=strlen($name);
}

if($numname <= 22){
print "<font  style='line-height:22px;'  face='Angsana New' size='5'><center><b>$name</b><br></font>";
}else{
print "<font  style='line-height:22px;'  face='Angsana New' size='1'><center><b>$name</b><br></font>";
}
print "<font  style='line-height:20px;'  face='Angsana New' size='6'><center><b>1-$exam_no</b><span style='font-size: 14px;'>CBC</span><br></font>";
print "<DIV style='left:65PX;top:55PX;width:100PX;height:10PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labcbc\"></span></DIV>";
print "<div style=\"page-break-before: always;\"></div>";

if($numname <= 22){
print "<font  style='line-height:22px;'  face='Angsana New' size='5'><center><b>$name</b><br></font>";
}else{
print "<font  style='line-height:22px;'  face='Angsana New' size='1'><center><b>$name</b><br></font>";
}
print "<font  style='line-height:20px;'  face='Angsana New' size='6'><center><b>2-$exam_no</b><br></font>";
print "<DIV style='left:65PX;top:55PX;width:100PX;height:10PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno\"></span></DIV>";
//print "<div style=\"page-break-before: always;\"></div>";

}
?>
