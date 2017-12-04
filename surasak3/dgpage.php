<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
.font2{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
</style>
<?php
    echo "<h1 class='font2'  align='center'>$cTitle (เลือกดูรายละเอียด)</h1><br>";
  include("connect.inc");
    print "<table class='font2'>";
    print "<tr>";
    print "<th bgcolor=6495ED>#</th>";
    print "<th bgcolor=6495ED>รหัส</th>";
    print "<th bgcolor=6495ED>ชื่อการค้า</th>";
    print "<th bgcolor=6495ED>ชื่อสามัญ</th>";
    print "<th bgcolor=6495ED>หน่วย</th>";
    print "<th bgcolor=6495ED>ราคา</th>";
    print "<th bgcolor=6495ED>ประเภท</th>";
    print "<th bgcolor=6495ED>บัญชี*</th>";
    print "<th bgcolor=6495ED>มีในคลัง</th>";
    print "</tr>";

  //  $cPage=rtrim($cPage);
    $query = "SELECT drugcode,tradname,genname,unit,salepri,drugtype,part,totalstk FROM druglst WHERE bcode like '$cPage%' ";
    $result = mysql_query($query) or die("Query failed");
//echo $query;
If (!empty($cPage)){
    $num=0;
    while (list ($drugcode, $tradname,$genname,$unit,$salepri,$drugtype,$part,$totalstk) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"dgitem.php? Dgcode=$drugcode\">$tradname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$genname</td>\n".
           "  <td BGCOLOR=66CDAA>$unit</td>\n".
           "  <td BGCOLOR=66CDAA>$salepri</td>\n".
           "  <td BGCOLOR=66CDAA>$drugtype</td>\n".
           "  <td BGCOLOR=66CDAA>$part</td>\n".
           "  <td BGCOLOR=66CDAA>$totalstk</td>\n".
           " </tr>\n");
}}
   print "</table>";

    include("unconnect.inc");

    print "<BR><font face='TH SarabunPSK'>*DDL   ยาในบัญชียาหลักแห่งชาติ เบิกได้<br>";
    print "<font face='TH SarabunPSK'>DDY   ยานอกบัญชียาหลักแห่งชาติ เบิกได้ <br>";
    print "<font face='TH SarabunPSK'>DDN   ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้ <br>";
    print "<font face='TH SarabunPSK'>DPY   อุปกรณ์ ที่เบิกได้(เบิกได้ทั้งหมดหรือบางส่วน)<br>";
    print "<font face='TH SarabunPSK'>DPN   อุปกรณ์ ที่เบิกไม่ได้ <br>";
    print "<font face='TH SarabunPSK'>DSY   เวชภัณฑ์ ที่เบิกได้(เบิกได้เฉพาะIPDขณะอยู่ใน รพ.,OPD เบิกไม่ได้) <br>";
    print "<font face='TH SarabunPSK'>DSN   เวชภัณฑ์ ที่เบิกไม่ได้";
?>




