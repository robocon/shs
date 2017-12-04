<?php
    echo "<font face='Angsana New' size='5'>$cTitle (เลือกเข้าบัญชียาของแพทย์)   <input type=button onclick='history.back()'                               value=<<กลับไปสารบัญ></font><br>";
  include("connect.inc");
    print "<table>";
    print "<tr>";
    print "<th bgcolor=6495ED>#</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>บัญชี*</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>มีในคลัง</th>";
    print "</tr>";

    $cPage=rtrim($cPage);
    $query = "SELECT drugcode,tradname,genname,unit,salepri,drugtype,part,totalstk FROM druglst WHERE bcode LIKE '$cPage%' ";
    $result = mysql_query($query)
        or die("Query failed");

If (!empty($cPage)){
    $num=0;
    while (list ($drugcode, $tradname,$genname,$unit,$salepri,$drugtype,$part,$totalstk) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"drdglist.php? Dgcode=$drugcode\">$tradname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA>$salepri</td>\n".
           "  <td BGCOLOR=66CDAA>$drugtype</td>\n".
           "  <td BGCOLOR=66CDAA>$part</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           " </tr>\n");
}}
   print "</table>";

    include("unconnect.inc");

    print "<font face='Angsana New'>*DDL   ยาในบัญชียาหลักแห่งชาติ เบิกได้<br>";
    print "<font face='Angsana New'>DDY   ยานอกบัญชียาหลักแห่งชาติ เบิกได้ <br>";
    print "<font face='Angsana New'>DDN   ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้ <br>";
    print "<font face='Angsana New'>DPY   อุปกรณ์ ที่เบิกได้(เบิกได้ทั้งหมดหรือบางส่วน)<br>";
    print "<font face='Angsana New'>DPN   อุปกรณ์ ที่เบิกไม่ได้ <br>";
    print "<font face='Angsana New'>DSY   เวชภัณฑ์ ที่เบิกได้(เบิกได้เฉพาะIPDขณะอยู่ใน รพ.,OPD เบิกไม่ได้) <br>";
    print "<font face='Angsana New'>DSN   เวชภัณฑ์ ที่เบิกไม่ได้";
?>




