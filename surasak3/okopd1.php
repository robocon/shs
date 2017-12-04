<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="2;URL=opdcardnohn.php">
</head>

<?php
    session_start();
    include("connect.inc");

//update data in opday
        $query ="UPDATE opday SET 
			         okopd = '$okopd'	
                       WHERE hn='$cHn' AND vn = '".$_GET["cVn"]."' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";
   If (!$result){
        echo "insert into opday fail";
                    }
   else {
        echo "ºÑ¹·Ö¡á¡éä¢¢éÍÁÙÅàÃÕÂºÃéÍÂ";
        echo "......$cHn,...$okopd";
echo "....$cPtname";
          }
include("unconnect.inc");
session_unregister("sTdatehn");
?>


