
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(1/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>

<?php
    session_start();
    include("connect.inc");
$cy='X';

//update kew in opday
        $query ="UPDATE opday SET phaok='$cy' WHERE thdatehn = '$thdatehn'  AND vn = '".$_SESSION["nVn"]."' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";
   If (!$result){
        echo "insert into opday fail";
                    }
   else {
        echo "บันทึกแก้ไขข้อมูลเรียบร้อย";

        echo "ส่งข้อมูลเรียบร้อย";
       
          }
include("unconnect.inc");
session_unregister("sTdatehn");
?>


