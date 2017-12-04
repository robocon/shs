<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="10;URL=oplistex.php">
</head>

<?php

	$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;
     $today="$d-$m-$yr";
    print "วันที่ $today  รายชื่อคนไข้เรียงตามลำดับเวลาก่อนหลัง ที่ค้างในระบบ";
  
    
$today="$yr-$m-$d";
$N='N';

?>
<?php

	$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;
     $today="$d-$m-$yr";
    print "วันที่ $today  รายชื่อผู้ป่วยที่ให้คิวแล้วไม่ได้ส่งค้นข้อมูล";
    // print "<a target=_self  href='../nindex.htm'><<ไปเมนู............</a><br> ";
 // print "<a target=_self  href='oplistexok.php'>ลบรายการ</a>เพื่อที่จะล้างหน้าจอในกรณีเลิกงานเท่านั้น<br> ";
    
$today="$yr-$m-$d";
$N='A';

?>
<table>
 <tr>
  <th bgcolor=6495ED>VN</th>
<th bgcolor=6495ED>คิว</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>กดส่งค้นบัตร</th>

  <th bgcolor=6495ED>สิทธิ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ออกโดย</th>
  <th bgcolor=6495ED><font face='Angsana New'>ผู้ยืม</th>
  <th bgcolor=6495ED><font face='Angsana New'>ผู้บันทึก</th>
  <th bgcolor=6495ED><font face='Angsana New'>ยกเลิก</th>
  </tr>

<?php
    $detail="ค่ายา";
    include("connect.inc");
  
    $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,phaok FROM opday WHERE thidate LIKE '$today%'and phaok='$N' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$kew,$phaok) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$kew</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a   href=\"sentkew1.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">$ptname</a></td>\n".
     //     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$goup</td>\n".
           //"  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$okopd</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$toborow</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$borow</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'><a href=\"sentkew2.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">ยกเลิก</td>\n".
 
           " </tr>\n");
       }
    include("unconnect.inc");
?>


</table>
<br>
<br>
<br>
<?php

	$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;
     $today="$d-$m-$yr";
    print "วันที่ $today  รายชื่อผู้ป่วยรอค้นบัตร พิมพ์ใบสั่งยา";

    
$today="$yr-$m-$d";
$N='X';
$ex='EX0';
?>
<table>
 <tr>
  <th bgcolor=6495ED>VN</th>
<th bgcolor=6495ED>คิว</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ชื่อ</th>

  <th bgcolor=6495ED>สิทธิ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ออกโดย</th>
  <th bgcolor=6495ED><font face='Angsana New'>ผู้ยืม</th>
  <th bgcolor=6495ED><font face='Angsana New'>ผู้บันทึก</th>
  </tr>

<?php
    $detail="ค่ายา";
    include("connect.inc");
  
    $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,phaok FROM opday WHERE thidate LIKE '$today%'and phaok='$N' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$kew,$phaok) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$kew</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</a></td>\n".
      //     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$goup</td>\n".
           //"  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$okopd</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$toborow</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$borow</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>



