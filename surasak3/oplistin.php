....................................................................รายงานตามแผนก.........................................<br>
<?php
$num= '0';
$ex= 'EX01';
    print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and toborow LIKE '$ex%' ";
    $result = mysql_query($query) or die("Query failed,app");


  print "จำนวนผู้ป่วยแต่ละรายการ  กดเลือกรายการ = รายชื่อผู้ป่วย<a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
   $query="SELECT toborow ,COUNT(*) AS duplicate FROM opday1 GROUP BY toborow HAVING duplicate > 0 ORDER BY toborow";
   $result = mysql_query($query);
     $n=0;
 while (list ($toborow,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$toborow&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "จำนวนผู้ป่วยทั้งหมด.... $num..คน</a><br> ";
   include("unconnect.inc");
?>
.....................................................................รายงานตามแพทย์..............................................<br>
<?php
$ex= 'EX01';
$num= '0';
    print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and toborow LIKE '$ex%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print "จำนวนผู้ป่วยแต่ละแพทย์  กดเลือกแพทย์ = รายชื่อผู้ป่วย<a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "จำนวนผู้ป่วยทั้งหมด.... $num..คน</a><br> ";
   include("unconnect.inc");
?>
....................................................................รายงานตามสิทธิ.........................................<br>
<?php
$num= '0';
$ex= 'EX01';
    print "<input type=button onclick='history.back()' value='<< กลับไป'>";

    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and toborow LIKE '$ex%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print "จำนวนผู้ป่วยแต่ละรายการ  กดเลือกรายการ = รายชื่อผู้ป่วย<a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
   $query="SELECT ptright ,COUNT(*) AS duplicate FROM opday1 GROUP BY ptright HAVING duplicate > 0 ORDER BY ptright";
   $result = mysql_query($query);
     $n=0;
 while (list ($ptright,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$ptright&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "จำนวนผู้ป่วยทั้งหมด.... $num..คน</a><br> ";
   include("unconnect.inc");
?>
....................................................................รายงานตามประเภท.........................................<br>
<?php
$num= '0';
$ex= 'EX01';
    print "<input type=button onclick='history.back()' value='<< กลับไป'>";

    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%'  and toborow LIKE '$ex%' ";
    $result = mysql_query($query) or die("Query failed,app");


  print "จำนวนผู้ป่วยแต่ละรายการ  กดเลือกรายการ = รายชื่อผู้ป่วย<a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
   $query="SELECT goup ,COUNT(*) AS duplicate FROM opday1 GROUP BY goup HAVING duplicate > 0 ORDER BY goup";
   $result = mysql_query($query);
     $n=0;
 while (list ($goup,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$goup&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "จำนวนผู้ป่วยทั้งหมด.... $num..คน</a><br> ";
   include("unconnect.inc");
?>
...............................................................................................รายชื่อผู้ป่วยทั้งหมด..............................<br>
<?php
$ex= 'EX01';
    print "วันที่ $today  รายชื่อคนไข้เรียงตามลำดับเวลาก่อนหลัง";
    print "<input type=button onclick='history.back()' value='<< กลับไป'>";

?>
<table>
 <tr>
  <th bgcolor=6495ED>VN</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>โรค</th>
  <th bgcolor=6495ED>สิทธิ</th>
  <th bgcolor=6495ED>ประเภท</th>
  <th bgcolor=6495ED>แพทย์</th>
  <th bgcolor=6495ED><font face='Angsana New'>คืนOPD</th>
  <th bgcolor=6495ED><font face='Angsana New'>ออกโดย</th>
  <th bgcolor=6495ED><font face='Angsana New'>ผู้ยืม</th>
  <th bgcolor=6495ED><font face='Angsana New'>ผู้บันทึก</th>
  </tr>

<?php
    $detail="ค่ายา";
  $ex= 'EX01';
    include("connect.inc");

    $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer FROM opday WHERE thidate LIKE '$today%' and toborow LIKE '$ex%'  ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"chkopd.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$goup</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$okopd</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$toborow</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$borow</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




