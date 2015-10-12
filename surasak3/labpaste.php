<?php
 session_start();
 global $code;
//get code from codehlp script

  if (isset($vCode)){
        $xCode=$vCode; 
              		}
  else {
        $xCode="";
        $vCode=""; 
          }
//echo "$vCode ,$xCode <br>";

 echo "HN : $cHn,  $cPtname,  สิทธิการรักษา : $cPtright <br> ";

print "<form method='POST' action='labseek.php'>"; 
print "<font face='Angsana New'><a target=_BLANK href='codehlp.php'>"; 
print "&#3619;&#3627;&#3633;&#3626;</a>&nbsp;&nbsp;&nbsp;"; 
print "<input type='text' name='code' size='8' value=$xCode>&nbsp; &nbsp;&nbsp;&nbsp;"; 
print "&nbsp;&#3592;&#3635;&#3609;&#3623;&#3609;&nbsp; "; 
print "<input type='text' name='amount' size='4' value='1'>&nbsp;</font>"; 
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
print "<font face='Angsana New'><input type='submit' value='    &#3605;&#3585;&#3621;&#3591;    ' name='B1'>"; 
print "</font></p>"; 
print "</form>"; 

print "<table>"; 
print " <tr>"; 
print "  <th bgcolor=6495ED>รหัส</th>"; 
print "  <th bgcolor=6495ED>รายการ</th>"; 
print "  <th bgcolor=6495ED>ราคา</th>"; 
print " </tr>"; 

 If (!empty($code)){
    include("connect.inc");
    $query = "SELECT code,depart,detail,price FROM labcare WHERE code LIKE '$code%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($code,$depart,$detail,$price) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target='right'  href=\"labinfo.php? Dgcode=$code & Depart=$depart & Amount=$amount &Trade=$detail & nPrice=$price\">$code</a></td>\n".
           "  <td BGCOLOR=66CDAA>$detail</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           " </tr>\n");
                                        					     }
include("unconnect.inc");
                               }

print "</table>";
?>

