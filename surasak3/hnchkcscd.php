
<?php
{
    include("connect.inc");
    $query = "SELECT hn,yot,name,surname,idcard,ptright FROM opcard WHERE ptright LIKE 'R03%' limit 1000 ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$yot,$name,$surname,$idcard,$ptright) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
		  "  <td BGCOLOR=F5DEB3>$row_id</a></td>\n".

           "  <td BGCOLOR=F5DEB3><center>$hn</a><br></td>\n".
           "  <td BGCOLOR=F5DEB3>$yot</td>\n".
           "  <td BGCOLOR=F5DEB3>$name</td>\n".
           "  <td BGCOLOR=F5DEB3>$surname</td>\n".
           "  <td BGCOLOR=F5DEB3>$idcard</a><br></td>\n".
	   "  <td BGCOLOR=F5DEB3>$ptright</a><br><br><br></center></td>\n".




           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
