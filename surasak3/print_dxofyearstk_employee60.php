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
$sql="SELECT * FROM `opcardchk` WHERE part = '".$part."' and pid='4' order by exam_no asc";
$query=mysql_query($sql)or die (mysql_error());
while($arr=mysql_fetch_array($query)){
$i=$arr["exam_no"];
$hn=$arr["HN"];
$name= $arr["name"]." ".$arr["surname"];

$labno1="170312".$i."01";  //cbc
$labno2="170312".$i."02";  //chem

if($arr["HN"] =="59-3783" || $arr["HN"] =="59-8184"){  //ทั้ง 2 HBSAG และ HBSAB

//HBSAG
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name***</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>4-$i</b><center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>HBSAG</b></center></font>";
print "<div style=\"page-break-before: always;\"></div>";


//HBSAB
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name***</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>5-$i</b><center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>HBSAB</b></center></font>";
print "<div style=\"page-break-before: always;\"></div>";

}else{
//HBSAB
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>$name***</b></center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='6'><center><b>5-$i</b><center></font>";
print "<font  style='line-height:23px;'  face='Angsana New' size='5'><center><b>HBSAB</b></center></font>";
print "<div style=\"page-break-before: always;\"></div>";

}

}
?>
