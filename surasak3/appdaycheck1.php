<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบจำนวนครั้งที่นัดมาโรงพยาบาล</p>


<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT hn,ptname,doctor,appdate,patho,xray,other FROM appoint WHERE hn = '$hn' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$ptname,$doctor,$appdate,$patho,$xray,$other) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3>$ptname</td>\n".
           "  <td BGCOLOR=F5DEB3>$doctor</td>\n".
           "  <td BGCOLOR=F5DEB3>$appdate</td>\n".
           "  <td BGCOLOR=F5DEB3>$patho</td>\n".
           "  <td BGCOLOR=F5DEB3>$xray</td>\n".
           "  <td BGCOLOR=F5DEB3>$other</td>\n".
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
