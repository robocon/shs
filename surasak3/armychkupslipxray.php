<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body onload="print();">
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<? 
include("connect.inc");

$sql="SELECT *
FROM `xray_doctor` where date like '2559-11-25 02:00:00' and detail='1.CHEST CHECK UP' order by xrayno asc";
//echo $sql;
$query=mysql_query($sql)or die (mysql_error());
while($arr=mysql_fetch_array($query)){

		$query1 = "SELECT camp FROM chkup_solider WHERE hn = '$arr[hn]' and yearchkup='60' AND (camp like 'D31%') AND active = '' 
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";
		$result = mysql_query($query1) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		
		$nCamp=$row->camp;


$xrayno=$arr["xrayno"];
$ptname=$arr["yot"]."".$arr["name"]." ".$arr["sname"];



print "<font  style='line-height:15px;'  face='Angsana New' size='3'><center>HN: $arr[hn] $arr[date]<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>$ptname<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>$nCamp<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><u><b>XRAY</u> ($xrayno)</b></font></center>";
print "<div style=\"page-break-before: always;\"></div>";

}
?>
</body>
</html>