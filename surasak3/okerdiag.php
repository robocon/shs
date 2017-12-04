<?php
    session_start();
    include("connect.inc");

//update data in opday
        $query ="UPDATE opday SET  erdiag = '$diag' 	 WHERE  thdatehn='$sTdatehn' AND vn = '".$_POST["hVn"]."' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";
   If (!$result){
        echo "insert into opday fail";
                    }
   else {
        echo "บันทึกแก้ไขข้อมูลเรียบร้อย";
 echo "$thdatehn";
 echo "บันทึกแก้ไขข้อมูลเรียบร้อย";
          }
include("unconnect.inc");
session_unregister("sTdatehn");
?>


