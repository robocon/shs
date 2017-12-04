<?php
session_start();
$thidate = (date("Y")+543).date("-m-d H:i:s"); 

include("connect.inc");
$sql = "INSERT INTO ipcard (date,an,hn)
              VALUES('$thidate','$vAN','$cHn');";
$result = mysql_query($sql) or die("หมายเลข AN $vAN ซ้ำ    ไม่สามารถบันทึกได้    โปรดทำรับป่วยใหม่ !");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";

If (!$result){
echo "query fail inset into ipcard";
     }
else {
print " ลงทะเบียนรับป่วยเรียบร้อย<br>";
print "  HN:  $cHn       AN: $vAN <br> ";
print "  $cPtname<br>"; 
print "สิทธิการรักษา : $cPtright<br>";
         }

include("unconnect.inc");
?>


