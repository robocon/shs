<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบจำนวนครั้งที่รับป่วย</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>ชื่อ-สกุล</th>
  <th bgcolor=CD853F>สิทธิ</th>
  <th bgcolor=CD853F>รับป่วย</th>
  <th bgcolor=CD853F>จำหน่าย</th>
  <th bgcolor=CD853F>โรค</th>
  <th bgcolor=CD853F>แพทย์</th>
  <th bgcolor=CD853F>เตียง</th>
 </tr>

<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT an,hn,ptname,ptright,date,dcdate,diag,doctor,bedcode FROM ipcard WHERE hn = '$hn' ORDER BY date DESC";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($an,$hn,$ptname,$ptright,$date,$dcdate,$diag,$doctor,$bedcode) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3>$an</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3>$ptname</td>\n".
           "  <td BGCOLOR=F5DEB3>$ptright</td>\n".
           "  <td BGCOLOR=F5DEB3>$date</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$dcdate</td>\n".
           "  <td BGCOLOR=F5DEB3>$diag</td>\n".
           "  <td BGCOLOR=F5DEB3>$doctor</td>\n".
           "  <td BGCOLOR=F5DEB3>$bedcode</td>\n".
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
