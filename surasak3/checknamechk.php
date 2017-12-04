<table>
 <tr>
  <th bgcolor=6495ED>เลขบัตร ปชช.</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ยศ</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>สกุล</th>
<th bgcolor=6495ED>วันเกิด</th>
<th bgcolor=6495ED>ที่อยู่</th>
<th bgcolor=6495ED>บิดา</th>
<th bgcolor=6495ED>มารดา</th>
 </tr>

<?php
If (!empty($fullname)){
    include("connect.inc");
    $query = "SELECT idcard,hn,yot,name,surname,dbirth,address,father,mother FROM opcard WHERE  concat(name,surname)= '$fullname'";

    $result = mysql_query($query)
        or die("query failed,opcard");

    while (list ($idcard,$hn,$yot,$name,$surname ,$dbirth,$address,$father,$mother) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$idcard</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$yot</td>\n".
           "  <td BGCOLOR=66CDAA>$name</td>\n".
           "  <td BGCOLOR=66CDAA>$surname</td>\n".
"<td BGCOLOR=66CDAA>$dbirth</td>\n".
"<td BGCOLOR=66CDAA>$address</td>\n".
"<td BGCOLOR=66CDAA>$father</td>\n".
"<td BGCOLOR=66CDAA>$mother</td>\n".
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
