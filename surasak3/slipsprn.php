<?php
    session_start();

    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $aDetail1 = array("detail1");
    $aDetail2 = array("detail2");
    $aDetail3 = array("detail3");
    $aDetail4 = array("detail4");

    include("connect.inc");
//////// add drugnote from druglst
    $aDrugnote = array("drugnote");
    for ($n=1; $n<=$x; $n++){
             $query = "SELECT drugnote FROM druglst WHERE drugcode = '$aDgcode[$n]' ";
             $result = mysql_query($query) or die("Query failed drugnote,druglst ");

             for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
                  if (!mysql_data_seek($result, $i)) {
                            echo "Cannot seek to row $i\n";
                            continue;
                                                                        }
                 if(!($row = mysql_fetch_object($result)))
                        continue;
		              }
             array_push($aDrugnote,$row->drugnote); 
                                          }
////// end  add drugnote from druglst
    for ($n=1; $n<=$x; $n++){
             $query = "SELECT slcode,detail1,detail2,detail3,detail4 FROM drugslip WHERE slcode = '$aSlipcode[$n]' ";
             $result = mysql_query($query) or die("Query failed");
//             echo mysql_errno() . ": " . mysql_error(). "\n";
//             echo "<br>";
             for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
                  if (!mysql_data_seek($result, $i)) {
                            echo "Cannot seek to row $i\n";
                            continue;
                                                                        }
                 if(!($row = mysql_fetch_object($result)))
                        continue;
		              }
             array_push($aDetail1,$row->detail1); 
             array_push($aDetail2,$row->detail2); 
             array_push($aDetail3,$row->detail3); 
             array_push($aDetail4,$row->detail4); 
                                          }

// print slip   
//µ—¥§Ë“©÷¥¬“∑‘Èß
    $injcount=0;
    for ($n=1; $n<=$x; $n++){
	if ($aDgcode[$n]=='INJ'){
		$injcount++;
		}
	}
    $injcount=$x - $injcount;

    for ($n=1; $n<=$x; $n++){
         If (!empty($aSlipcode[$n])){
           print "<font face='Angsana New' size='1'>$Thaidate<br></font>";
           print "<font face='Angsana New' size='1'>$sPtname...<b>$injcount #</b><br></font>";
//         print "<font face='Angsana New' size='1'>$aTrade[$n],$aDgcode[$n],$aAmount[$n]<br></font>";
           $aTrade[$n]=substr($aTrade[$n],0,22);
           print "<font face='Angsana New' size='1'>$aTrade[$n],...$aDgcode[$n],....$aAmount[$n]<br></font>";
           print "<font face='Microsoft sans serif' size='2'>$aDetail1[$n]<br></font>";
           print "<font face='Microsoft sans serif' size='2'>$aDetail2[$n]<br></font>";

           if ($n==$x){
                      print "<font face='Microsoft sans serif' size='2'>$aDetail3[$n]<BR></font>";
			    print "<font face='AngsanaUPC' size='2'>$aDrugnote[$n]</font>";/// add drugnote from
                           }
           else {   
                      print "<font face='Microsoft sans serif' size='2'>$aDetail3[$n]<br><BR></font>";
                      print "<font face='AngsanaUPC' size='2'>$aDrugnote[$n]<br></font>";/// add drugnote from druglst
		   }print "<font face='Angsana New' size='1'>$aDetail4[$n]<br><br><BR></font>";
     
	 }
	}
	
/*
    for ($n=1; $n<=$x; $n++){
           print "$today <br>";
           print "$sPtname<br>";
           print "$aTrade[$n],$aDgcode[$n],$aAmount[$n]<br>";
           print "$aDetail1[$n]<br>";
           print "$aDetail2[$n]<br>";
           print "$aDetail3[$n]<br>";
           print "$aDetail4[$n]<br><br><br><br><br>";
             }
<body>
<p><font face="AngsanaUPC" size="1">AAAAAAAA</font></p>
<p><font face="AngsanaUPC" size="3">BBBBBBBB</font></p>
<p><font face="CordiaUPC" size="5">CCCCCCC</font></p>
<p><b>DDDDDDD</b></p>
<p>&nbsp;</p>
</body>                                           
*/
 include("unconnect.inc");
?>


