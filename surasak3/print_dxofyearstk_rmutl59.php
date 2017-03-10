<? 
include("connect.inc");
$_GET['part']="ราชมงคล59";
$sql="SELECT * FROM `opcardchk` WHERE part = '".$_GET['part']."' order by row asc";
$query=mysql_query($sql)or die (mysql_error());
while($arr=mysql_fetch_array($query)){
$hn=$arr["HN"];
$examno=$arr["exam_no"];
$pid=$arr["pid"];
$name= $arr["name"];
$course=$arr["course"];
$branch=$arr["branch"];

print "<font  style='line-height:25px;'  face='Angsana New' size='5'><center>HN $hn ($examno)<br></font>";
print "<font  style='line-height:20px;'  face='Angsana New' size='3'><center>$name<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='3'><center>$course<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='2'><center>$branch<br></font>";
print "<font  style='line-height:20px;'  face='Angsana New' size='3'><u><b>X-RAY</u></b></font></center>";
print "<div style=\"page-break-before: always;\"></div>";
}
?>
