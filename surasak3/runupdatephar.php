
<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="1;URL=kewpharedit.php">
</head>

<?php
$runno='1';
$title='pharin_m';
    include("connect.inc");
        $query ="UPDATE runno SET runno = '$runno'				
                       WHERE title = '$title' ";
        $result = mysql_query($query)
                       or die("Query failed,update labcare");
   If (!$result){
        echo "insert into labcare fail";
                    }
   else {
        echo "ºÑ¹·Ö¡á¡éä¢¢éÍÁÙÅàÃÕÂºÃéÍÂ";
          }
include("unconnect.inc");
?>


<?php
$runno='1';
$title='pharin_l';
    include("connect.inc");
        $query ="UPDATE runno SET runno = '$runno'				
                       WHERE title = '$title' ";
        $result = mysql_query($query)
                       or die("Query failed,update labcare");
   If (!$result){
        echo "insert into labcare fail";
                    }
   else {
        echo "ºÑ¹·Ö¡á¡éä¢¢éÍÁÙÅàÃÕÂºÃéÍÂ";
          }
include("unconnect.inc");
?>
