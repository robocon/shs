<?php
 session_start();
 print "ชื่อสูตร :$cSuitname<br>";
 print "รหัสสูตร :$cSuitcode<br>";
?>
<form method="POST" action="<?php echo $PHP_SELF ?>"> <font face="Angsana New"><a target=_BLANK href="code_hlp.php">&#3619;&#3627;&#3633;&#3626;</a>&nbsp;&nbsp;&nbsp;
  <input type="text" name="code" size="10">&nbsp; &nbsp;&nbsp;&nbsp;
  &nbsp;&#3592;&#3635;&#3609;&#3623;&#3609;&nbsp; <input type="text" name="amount" size="4" value="1">&nbsp;</font>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <font face="Angsana New"><input type="submit" value="    &#3605;&#3585;&#3621;&#3591;    " name="B1"></font></p>
</form>

<table>
 <tr>
  <th bgcolor=6495ED>รหัส</th>
  <th bgcolor=6495ED>รายการ</th>
  <th bgcolor=6495ED>ราคา</th>
 </tr>

<?php
 If (!empty($code)){
    include("connect.inc");
    $query = "SELECT code,depart,detail,price FROM labcare WHERE code LIKE '$code%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($code,$depart,$detail,$price) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target='right'  href=\"suitinfo.php? Dgcode=$code & Depart=$depart & Amount=$amount &Trade=$detail & nPrice=$price\">$code</a></td>\n".
           "  <td BGCOLOR=66CDAA>$detail</td>\n".
           "  <td BGCOLOR=66CDAA>$price</td>\n".
           " </tr>\n");
                                        					     }
include("unconnect.inc");
                               }
?>

</table>


