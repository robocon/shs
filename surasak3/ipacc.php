<?php
   session_start();
   print "    รายการค่ารักษาพยาบาล ";
//   print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../index.htm'>ไปหน้าจอหลัก</a>";
   print "<br>"; 
?>
<table>
 <tr>
 <th bgcolor=#669999><font face='Angsana New'>วันที่</th>
 <th bgcolor=#669999><font face='Angsana New'>แผนก</th>
 <th bgcolor=#669999><font face='Angsana New'>รายการ</th>
 <th bgcolor=#669999><font face='Angsana New'>จำนวน</th>
 <th bgcolor=#669999><font face='Angsana New'>ราคา</th>
 <th bgcolor=#669999><font face='Angsana New'>จ่าย</th>
 <th bgcolor=#669999><font face='Angsana New'>ประเภท</th>
 <th bgcolor=#669999><font face='Angsana New'>จนท.</th>

 </tr>
<?php
    include("connect.inc");
/*
mysql> select * from table1 USE INDEX (key1,key2) WHERE key1=1 and key2=2 AND
       key3=3;
mysql> select * from table1 IGNORE INDEX (key3) WHERE key1=1 and key2=2 AND
       key3=3;
*/
    $query = "SELECT date,depart,detail,amount,price,paid,part,idname
                     FROM ipacc WHERE an = '$cAn' and accno='$cAccno' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$depart,$detail,$amount,$price,$paid,$part,$idname) = mysql_fetch_row ($result)) {
           print (" <tr>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$part</td>\n".
           "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$idname</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>

