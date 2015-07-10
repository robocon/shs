
<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="1;URL=oplistex.php">
</head>
<?php
    session_start();
    include("connect.inc");
$cy='Y';
$time=date("H:i:s");

//update kew in opday
        $query ="UPDATE opday SET phaok='$cy',time2='$time' WHERE thdatehn = '$cTdatehn' AND vn = '".$_GET["cVn"]."' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");





//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";
   If (!$result){
        echo "insert into opday fail";
                    }
   else {
        echo "ºÑ¹·Ö¡á¡éä¢¢éÍÁÙÅàÃÕÂºÃéÍÂ";

        echo "Êè§¢éÍÁÙÅàÃÕÂºÃéÍÂ";
       
          }
include("unconnect.inc");
session_unregister("sTdatehn");
?>


