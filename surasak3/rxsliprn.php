<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

/////// add drugnote from druglst
    include("connect.inc");
             $cDrugnote = "";
             $query = "SELECT drugnote FROM druglst WHERE drugcode = '$cDcode' ";
             $result = mysql_query($query) or die("Query failed drugnote,druglst ");

             for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
                  if (!mysql_data_seek($result, $i)) {
                            echo "Cannot seek to row $i\n";
                            continue;
                                                                        }
                 if(!($row = mysql_fetch_object($result)))
                        continue;
		              }
             $cDrugnote = $row->drugnote; 
    include("unconnect.inc");
////// end  add drugnote from druglst
    include("connect.inc");
    print "<font face='AngsanaUPC' size='1'>$Thaidate<br></font>";
    print "<font face='AngsanaUPC' size='1'>$sPtname<br></font>";
    $cTrad=substr($cTrad,0,22);
    print "<font face='AngsanaUPC' size='1'>$cTrad,...$cDcode,....$cAmt<br></font>";
    print "<font face='AngsanaUPC' size='1'>$cDetail1<br></font>";
    print "<font face='AngsanaUPC' size='1'>$cDetail2<br></font>";
    print "<font face='AngsanaUPC' size='1'>$cDetail3<br></font>";
    print "<font face='AngsanaUPC' size='2'>$cDrugnote<br><br><br></font>";///// add drugnote from druglst
//    print "<font face='Angsana New' size='1'>$cDetail4<br><br><br><br></font>";
?>



