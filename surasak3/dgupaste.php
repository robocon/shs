<?php
  session_start();
//  global $drugcode;
//  global $amount;

  if (isset($dcode)){
        $xCode=$dcode; 
              		}
  else {
        $xCode="";
          }

  echo "หน่วยเบิก: $cDepcode  <br>";
  echo "เลขที่ใบเบิก: $cBillno <br>";

print "<form method='post' action='dguseek.php'>";
print "<font face='Angsana New'><a target=_BLANK href='dgucode.php'>รหัสยา</a>&nbsp;&nbsp;";
print "<input type='text' name='drugcode' size='10' value=$xCode>&nbsp;&nbsp;&nbsp;";
print "จำนวน  <input type='text' name='amount' size='6'>&nbsp;</font></p>";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='   ตกลง   ' name='B1'>";
print "</font></p>";
print "</form>";
print "<table>";
print " <tr>";
print "  <th bgcolor=6495ED>รหัส</th>";
print "  <th bgcolor=6495ED>รายการ</th>";
print "  <th bgcolor=6495ED>ราคา</th>";
print " </tr>";

If (!empty($drugcode)){
    include("connect.inc");

    $query = "SELECT drugcode,tradname,unitpri FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname, $unitpri) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target='right'  href=\"infounit.php? Dgcode=$drugcode& Amount=$amount& Trade=$tradname & Price=$unitpri\">$drugcode</a></td>\n".
           "  <td BGCOLOR=66CDAA>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA>$unitpri</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }

print "</table>";
?>