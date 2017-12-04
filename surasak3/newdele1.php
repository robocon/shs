<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="1;URL=newedit.php">
</head>


<?php
    include("connect.inc");
  $num = Y;
    $query = "UPDATE  new SET status = '$num' WHERE row = '$row' ";
    $result = mysql_query($query)
        or die("Query failed");

    If ($result){
          print "Åº¢éÍÁÙÅàÃÕÂºÃéÍÂáÅéÇ<br>";
          print "»Ô´Ë¹éÒµèÒ§¹Õé";
 	}
    include("unconnect.inc");
?>