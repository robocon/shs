<?php
session_start();
$thidate = (date("Y")+543).date("-m-d H:i:s"); 

include("connect.inc");
$sql = "INSERT INTO ipcard (date,an,hn)
              VALUES('$thidate','$vAN','$cHn');";
$result = mysql_query($sql) or die("�����Ţ AN $vAN ���    �������ö�ѹ�֡��    �ô���Ѻ�������� !");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";

If (!$result){
echo "query fail inset into ipcard";
     }
else {
print " ŧ����¹�Ѻ�������º����<br>";
print "  HN:  $cHn       AN: $vAN <br> ";
print "  $cPtname<br>"; 
print "�Է�ԡ���ѡ�� : $cPtright<br>";
         }

include("unconnect.inc");
?>


