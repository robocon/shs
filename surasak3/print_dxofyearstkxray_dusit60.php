<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<? 
include("connect.inc");
$part="สวนดุสิต60";
$sql="SELECT * FROM `opcardchk` WHERE part = '".$part."' order by row asc";
$query=mysql_query($sql)or die (mysql_error());
$i=300;
while($arr=mysql_fetch_array($query)){
$i++;
$hn=$arr["HN"];
$exam_no=$arr["exam_no"];
if($arr["idcard"]=="60-240" || $arr["idcard"]=="60-244" || $arr["idcard"]=="58-8182" || $arr["idcard"]=="52-9120" || $arr["idcard"]=="52-1081"){
	$newname=substr($arr["name"],6);
	$name= $newname.' '.$arr["surname"];
}else if($arr["idcard"]=="49-5823"){
	$newname=substr($arr["name"],3);
	$name= $newname.' '.$arr["surname"];
}else{
	$name= $arr["name"].' '.$arr["surname"];
}


print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>HN : $hn ($exam_no)</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name</b><center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>XRAY</b></center></font>";
print "<div style=\"page-break-before: always;\"></div>";

}
?>
