<?php
 session_start();
  if (isset($dcode)){
       $sDcode=$dcode; 
              		}
  if (isset($slip)){
       $sSlip=$slip; 
              		}
// echo "HN : $cPtname,  สิทธิ์ : $cPtright <br> ";
print "<form method='post' action='ddgseek.php'>";
print "สั่งยา  <font face='Angsana New'><a target=_BLANK href='drdgcode.php'>รหัสยา</a>&nbsp;&nbsp;";
print "<input type='text' name='drugcode' size='8' value=$sDcode>&nbsp;&nbsp;&nbsp;&nbsp;";
print "จำนวน  <input type='text' name='amount' size='4'>&nbsp;&nbsp;&nbsp;<a target=_BLANK href="drulist.php">บัญชียา</a></font>";
print "<p><font face='Angsana New'><a target=_BLANK href='drslcode.php'>วิธีใช้</a>&nbsp;&nbsp;&nbsp;&nbsp; ";
print "<input type='text' name='slipcode' size='8' value=$sSlip>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ";
print "<input type='submit' value='    ตกลง    ' name='B1'>";
print"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='ptrm.php'>ยาเดิม/RM</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='dgsuit.php'>สูตรยา</a>";
print "</font></p>";
print "</form>";
print "<table>";
print " <tr>";
print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
print " </tr>";

If (!empty($drugcode)){
    include("connect.inc");

    $query = "SELECT drugcode,tradname,genname,salepri FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$salepri) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target='top'  href=\"dinfo.php? Dgcode=$drugcode& Amount=$amount& Trade=$tradname & Price=$salepri & Slcode=$slipcode\">$drugcode</a></td>\n".
           "  <td BGCOLOR=66CDAA>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA>$genname</td>\n".
           "  <td BGCOLOR=66CDAA>$salepri</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }


print "</table>";
?>