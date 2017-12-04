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
FROM `opcardchk` WHERE hn='".$_GET['hn']."'  LIMIT 1 ";
$query=mysql_query($sql)or die (mysql_error());
$arr=mysql_fetch_array($query);

print "<font  style='line-height:25px;'  face='Angsana New' size='5'><center>HN $_GET[hn]<br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='1'><center>$_GET[name]<br></font>";
//print "<font  style='line-height:20px;'  face='Angsana New' size='4'><u>$_GET[idcard]</b></font></center>";
print "<font  style='line-height:25px;'  face='Angsana New' size='5'><u><b>CBC</u> </b>NO. $_GET[exam_no]</font></center>";
print "<div style=\"page-break-before: always;\"></div>";

print "<font  style='line-height:25px;'  face='Angsana New' size='5'><center>HN $_GET[hn] <br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='1'><center>$_GET[name]<br></font>";
//print "<font  style='line-height:20px;'  face='Angsana New' size='4'><u><b>$_GET[idcard]</u></b></font></center>";
print "<font  style='line-height:25px;'  face='Angsana New' size='5'><u><b>BS</u> </b>NO. $_GET[exam_no]</font></center>";

print "<div style=\"page-break-before: always;\"></div>";

print "<font  style='line-height:25px;'  face='Angsana New' size='5'><center>HN $_GET[hn] <br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='1'><center>$_GET[name]<br></font>";
//print "<font  style='line-height:20px;'  face='Angsana New' size='4'><u><b>$_GET[idcard]</u></b></font></center>";
print "<font  style='line-height:25px;'  face='Angsana New' size='5'><u><b>CHEM</u> </b>NO. $_GET[exam_no]</font></center>";
/*
print "<div style=\"page-break-before: always;\"></div>";

print "<font  style='line-height:20px;'  face='Angsana New' size='4'><center>HN $_GET[hn]<br></font>";
print "<font  style='line-height:25px;'  face='Angsana New' size='5'><center>$_GET[name]<br></font>";
print "<font  style='line-height:20px;'  face='Angsana New' size='5'><u><b>$_GET[idcard]</u></b></font></center>";
print "<font  style='line-height:25px;'  face='Angsana New' size='4'><u><b>STOOL</u></b></font></center>";

print "<div style=\"page-break-before: always;\"></div>";

print "<font  style='line-height:20px;'  face='Angsana New' size='4'><center>HN $_GET[hn]<br></font>";
print "<font  style='line-height:20px;'  face='Angsana New' size='5'><center>$_GET[name]<br></font>";
print "<font  style='line-height:20px;'  face='Angsana New' size='5'><u><b>$_GET[idcard]</u></b></font></center>";
print "<font  style='line-height:20px;'  face='Angsana New' size='6'><u><b>EKG</u></b></font></center>";

*/
?>
</body>
</html>