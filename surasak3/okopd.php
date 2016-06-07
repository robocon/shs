<?php
session_start();
include("connect.inc");

//update data in opday
$query ="UPDATE opday 
SET doctor='$doctor',  diag = '$diag', okopd = '$okopd' 
WHERE  thdatehn='$sTdatehn' 
AND vn = '".$_SESSION["sVn"]."' ";
$result = mysql_query($query) or die("Query failed,update druglst");

If (!$result){
    echo "insert into opday fail";
} else {
    echo "บันทึกแก้ไขข้อมูลเรียบร้อย";
}
include("unconnect.inc");
session_unregister("sTdatehn");
?>