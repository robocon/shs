<!--<body Onload="window.print();">-->
<body>
<Script Language="JavaScript">
window.print();
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<?php
session_start();
include("connect.inc");
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");
$time=date("H:i:s");
$today = date("Y-m-d"); 

 
$query = "SELECT title,prefix,runno,startday FROM runno WHERE title = 'kewcard'";
$result = mysql_query($query)or die("Query failed runno ask");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $vTitle=$row->title;
    $vPrefix=$row->prefix;
    $nRunno=$row->runno;  //ลำดับคิว
	$nRunno++;  //เพิ่มค่าทีละ1
	$dVndate=$row->startday;  //วันที่และเวลา
	$dVndate=substr($dVndate,0,10);  //วันที่
 	//echo $today."==>".$dVndate;
// update kew to table runno
if($today==$dVndate){  //ภายในวัน
    $query ="UPDATE runno SET runno ='$nRunno' WHERE title='kewcard'";
   // var_dump($query);
    $result = mysql_query($query);
	
print "<center><font size=5><b> ลำดับที่: $nRunno </b><br> ";
print "<center><font size=4><b>คิวทำบัตรใหม่</b><br> ";
print "<center><font size=2><b>วันที่ $Thaidate</b><br> ";
print "<center><b>รอรับบริการที่จุดคัดแยก</b><br>";
print "<div style='page-break-after:always;'>&nbsp;</div>";
print "<center><font size=5><b> ลำดับที่: $nRunno </b><br> ";
print "<center><font size=4><b>คิวทำบัตรใหม่</b><br> ";
print "<center><font size=2><b>วันที่ $Thaidate</b><br> ";
print "<center><b>รอรับบริการที่จุดคัดแยก</b><br>";	
}else{  //วันใหม่
	$nKew=1;
    $query ="UPDATE runno SET runno ='$nKew',startday=now() WHERE title='kewcard'";
    // var_dump($query);
    $result = mysql_query($query);	
print "<center><font size=5><b> ลำดับที่: $nKew </b><br> ";
print "<center><font size=4><b>คิวทำบัตรใหม่</b><br> ";
print "<center><font size=2><b>วันที่ $Thaidate</b><br> ";
print "<center><b>รอรับบริการที่จุดคัดแยก</b><br>";
print "<div style='page-break-after:always;'>&nbsp;</div>";
print "<center><font size=5><b> ลำดับที่: $nRunno </b><br> ";
print "<center><font size=4><b>คิวทำบัตรใหม่</b><br> ";
print "<center><font size=2><b>วันที่ $Thaidate</b><br> ";
print "<center><b>รอรับบริการที่จุดคัดแยก</b><br>";	
}

include("unconnect.inc");
?>

