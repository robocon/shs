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
FROM `orderhead` as a inner join chkup_solider as b on a.hn=b.hn where (a.orderdate like '2016-11-24%' and a.clinicalinfo='ตรวจสุขภาพประจำปี60' and b.yearchkup='60') and (b.camp like 'D31%') GROUP BY b.hn order by a.autonumber, b.row_id desc";
//echo $sql;
$query=mysql_query($sql)or die (mysql_error());
while($arr=mysql_fetch_array($query)){

$runno=substr($arr["labnumber"],6,3);

$labno1=$arr["labnumber"]."01";
$labno2=$arr["labnumber"]."02";
$labno3=$arr["labnumber"]."03";

print "<font  style='line-height:15px;'  face='Angsana New' size='2'><center>HN: $arr[hn] $arr[orderdate]<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>$arr[patientname]<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='3'><u><b>CBC</u> ($runno)</b></font></center>";
print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno1\"></span></div>";
print "<div style=\"page-break-before: always;\"></div>";

if($arr["age"] >=35){
print "<font  style='line-height:15px;'  face='Angsana New' size='2'><center>HN: $arr[hn] $arr[orderdate]<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>$arr[patientname]<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='3'><u><b>CHEM</u> ($runno)</b></font></center>";
print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno2\"></span></div>";
print "<div style=\"page-break-before: always;\"></div>";
}

print "<font  style='line-height:15px;'  face='Angsana New' size='2'><center>HN: $arr[hn] $arr[orderdate]<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>$arr[patientname]<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='3'><u><b>UA</u> ($runno)</b></font></center>";
print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno3\"></span></div>";
print "<div style=\"page-break-before: always;\"></div>";
}
?>
</body>
</html>