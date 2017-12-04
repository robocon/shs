<?php
    session_start(); //sDiscdate
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    print "<font face='Angsana New'>รายชื่อคนไข้ในที่จำหน่ายในวันที่ $sDiscdate<br>";
?>
<table>
 <tr>
  <th>ชื่อ</th>
  <th>HN</th>
  <th>AN</th>
  <th>ค่ารักษา</th>
  <th>จ่ายก่อน</th>
  <th>จ่ายวันนี้</th>
  <th>ค้างจ่าย</th>
  <th>จนท.</th>
  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT ptname,hn,an,price,paid,cash,debt,idname FROM ipmonrep WHERE dcdate LIKE '$sDiscdate%' ";
    $result = mysql_query($query)
        or die("Query failed ipcard");

    while (list ($ptname,$hn,$an,$price,$paid,$cash,$debt,$idname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td>$ptname</td>\n".
           "  <td>$hn</td>\n".
           "  <td>$an</td>\n".
           "  <td>$price</td>\n".
           "  <td>$paid</td>\n".
           "  <td>$cash</td>\n".
           "  <td>$debt</td>\n".
           "  <td>$idname</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>

<?php
    print "<br>ลงชื่อ ........................................................ ผู้รายงาน<br>";
    print "รายงานวันที่ $Thaidate ";
?>

