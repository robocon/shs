
...............................................................................................รายชื่อผู้ป่วยในทั้งหมด..............................<br>
<?php
  //  $today="$d-$m-$yr";
$appd=$appdate.'-'.$appmo.'-'.$thiyr;
$appd1=$thiyr.'-'.$appmo.'-'.$appdate;
    print "วันที่ $appd รายชื่อคนไข้เรียงตามลำดับเวลาก่อนหลัง";
    print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>ลำดับ</th>

<th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ชื่อ-สกุล</th>
  <th bgcolor=6495ED>อายุ</th>
  <th bgcolor=6495ED>สิทธิ</th>
  <th bgcolor=6495ED>หอผู้ป่วย</th>
 <th bgcolor=6495ED>วันนอน</th>
  <th bgcolor=6495ED>วันจำหน่าย</th>
 <th bgcolor=6495ED>โรค</th>
  <th bgcolor=6495ED>แพทย์</th>

  </tr>

<?php
    $detail="ค่ายา";
    include("connect.inc");
  
    $query = "SELECT date_format(date,'%d/ %m/ %Y %H:%i'),date_format(date,'%H:%i'),an,hn,ptname,age,ptright,bedcode,date_format(dcdate,'%d/ %m/ %Y %H:%i'),diag,doctor FROM ipcard WHERE date LIKE '$appd1%' ";
    $result = mysql_query($query)
        or die("Query failed");
 $n=0;
    while (list ($datea,$timea,$an,$hn,$ptname,$age,$ptright,$bedcode,$dcdate,$diag,$doctor) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);
  $n++;
        print (" <tr>\n".
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
 
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$age</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedcode</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$datea </td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




