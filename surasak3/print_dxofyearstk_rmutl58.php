<? 
include("connect.inc");
$_GET['part']="ราชมงคล58";
$sql="SELECT * FROM `opcardchk` WHERE part = '".$_GET['part']."' order by row asc limit 798,178";
$query=mysql_query($sql)or die (mysql_error());
while($arr=mysql_fetch_array($query)){
$hn=$arr["HN"];
$name= $arr["yot"].' '.$arr["name"].' '.$arr["surname"];
$course=$arr["course"];
$branch=$arr["branch"];

print "<font  style='line-height:25px;'  face='Angsana New' size='5'><center>HN $hn <br></font>";
print "<font  style='line-height:20px;'  face='Angsana New' size='3'><center>$name<br></font>";
print "<font  style='line-height:20px;'  face='Angsana New' size='3'><center>$course<br></font>";
print "<font  style='line-height:20px;'  face='Angsana New' size='3'><center>$branch<br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='4'><u><b>X-RAY</u> </b></font></center>";
print "<div style=\"page-break-before: always;\"></div>";
}
?>
