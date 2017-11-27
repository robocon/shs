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
FROM chkup_solider where (yearchkup='61' and active='' and camp = 'D01 รพ.ค่ายสุรศักดิ์มนตรี') order by  row_id asc";
//echo $sql;
$query=mysql_query($sql)or die (mysql_error());
$i=300;
while($arr=mysql_fetch_array($query)){
$i++;

$no=sprintf("%03d",$i);

$runno=$i;
$labno="171206".$no;
$orderdate="2017-12-06";
$ptname=$arr["yot"]." ".$arr["ptname"];
$camp=$arr["camp"];


$labno1=$labno."01";
$labno2=$labno."02";
$labno3=$labno."03";

print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>HN: $arr[hn] ($no) $orderdate<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>$ptname <br></font>";
print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno1\"><font size='+6' style='margin-left:5px;'>1</font></span></div>";


if($arr["age"] >=35){
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>HN: $arr[hn] ($no) $orderdate<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>$ptname<br></font>";
print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno2\"><font size='+6' style='margin-left:5px;'>2</font></span></div>";
}

print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>HN: $arr[hn] ($no) $orderdate<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>$ptname<br></font>";
print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno3\"><font size='+6' style='margin-left:5px;'>3</font></span></div>";

print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>HN: $arr[hn] ($no) $orderdate<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='4'><center>$ptname<br></font>";
print "<font  style='line-height:15px;'  face='Angsana New' size='3'><u><b></u>($camp)</b></font></center>";
print "<div style='left:65PX;top:55PX;width:180PX;height:50PX;'><span class='fc1-0'><font size='+3' style='margin-left:5px;'>4</font></span></div>";
}
?>
</body>
</html>