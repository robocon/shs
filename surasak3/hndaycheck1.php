<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
<table>
    <tr>
        <th bgcolor=CD853F>HN</th>
        <th bgcolor=CD853F>AN</th>
        <th bgcolor=CD853F>VN</th>
        <th bgcolor=CD853F>ชื่อ-สกุล</th>
        <th bgcolor=CD853F>สิทธิ</th>
        <th bgcolor=CD853F>วันและเวลา</th>
        <th bgcolor=CD853F>ออกโดย</th>
        <th bgcolor=CD853F>ผู้ยืม</th>
        <th bgcolor=CD853F>ผู้บันทึก</th>
    </tr>
<?php
If (!empty($hn)){
    include("connect.inc");

    $thdatehn = $_GET['thdatehn'];
    global $hn;
    $query = "SELECT hn,an,vn,ptname,ptright,thidate,diag,doctor,okopd,toborow,borow,officer,icd10,icd101 
    FROM opday2 
    WHERE thdatehn = '$thdatehn' 
    ORDER BY thidate ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$an,$vn,$ptname,$ptright,$thidate,$diag,$doctor,$okopd,$toborow,$borow,$officer,$icd10,$icd101) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3 width=80 style='font-size:18px;'>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3 width=50 style='font-size:15px;'>$an</td>\n".
  "  <td BGCOLOR=F5DEB3  width=20 style='font-size:18px;'>$vn</td>\n".
           "  <td BGCOLOR=F5DEB3  width=200 style='font-size:18px;'>$ptname</td>\n".
           "  <td BGCOLOR=F5DEB3  width=80 style='font-size:15px;'>$ptright</td>\n".
           "  <td BGCOLOR=F5DEB3  width=200 style='font-size:15px;'><B>$thidate</B></a></td>\n".
              "  <td BGCOLOR=F5DEB3 width=80 style='font-size:15px;'>$toborow</td>\n".

           
     "  <td BGCOLOR=F5DEB3 width=80 style='font-size:15px;'>$borow</td>\n".

         
     "  <td BGCOLOR=F5DEB3 width=80 style='font-size:15px;'>$officer</td>\n".

         
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
