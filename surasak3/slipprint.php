<?php
    session_start();
    $cDcode=$cDrugcode;
    $cTrad=$cTradname;
    $cAmt=$cAmount;
    session_register("cDcode");
    session_register("cTrad");
    session_register("cAmt");
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    include("connect.inc");

//////// add drugnote from druglst
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
////// end  add drugnote from druglst

    $query = "SELECT * FROM drugslip WHERE slcode = '$cSlcode' ";
    $result = mysql_query($query) or die("Query failed");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

		$cDetail1=$row->detail1;
        $cDetail2=$row->detail2;
        $cDetail3=$row->detail3;
        $cDetail4=$row->detail4;

    print "<font face='AngsanaUPC' size='1'>$Thaidate<br></font>";
    print "<font face='AngsanaUPC' size='1'>$sPtname<br></font>";
    $cTrad=substr($cTrad,0,22);
    print "<font face='AngsanaUPC' size='1'>$cTrad,...$cDcode,....$cAmt<br></font>";
    print "<font face='AngsanaUPC' size='1'>$cDetail1<br></font>";
    print "<font face='AngsanaUPC' size='1'>$cDetail2<br></font>";
    print "<font face='AngsanaUPC' size='1'>$cDetail3<br></font>";
    print "<font face='AngsanaUPC' size='2'>$cDrugnote<br><br><br></font>";///// add drugnote from druglst
//    print "<font face='Angsana New' size='1'>$cDetail4<br><br><br></font>";
    include("unconnect.inc");

?>






