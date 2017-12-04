....................................................................รายงานตามICD10.........................................<br>
...............................................................................................รายชื่อผู้ป่วยทั้งหมด..............................<br>
<?php
$ex= 'EX01';
    print "วันที่ $today  รายชื่อคนไข้เรียงตามลำดับเวลาก่อนหลัง";
  print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";

?>
<table>
 <tr>
  <th bgcolor=6495ED>VN</th>

  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>โรค</th>
  <th bgcolor=6495ED>ICDหลัก</th>
  <th bgcolor=6495ED>ICDรอง</th>
  <th bgcolor=6495ED>ICD9CM</th>
  <th bgcolor=6495ED>สิทธิ</th>
  <th bgcolor=6495ED>ออกโดย</th>
  </tr>

<?php
    $detail="ค่ายา";
  $ex= 'EX01';
    include("connect.inc");

    $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,icd10,icd101,icd9cm FROM opday WHERE thidate LIKE '$today%'   ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$icd10,$icd101,$icd9cm) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
    
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd101</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd9cm</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$toborow</td>\n".

           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




