<table>
 <tr>
  <th bgcolor=6495ED>ICD10</th>
  <th bgcolor=6495ED>‚√§</th>
 </tr>

<?php
    include("connect.inc");
    $query = "SELECT code,name FROM icd10";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($code,$name) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$code</td>\n".
           "  <td BGCOLOR=66CDAA>$name</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
?>

</table>