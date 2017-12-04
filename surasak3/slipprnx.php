<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $aDetail1 = array("detail1");
    $aDetail2 = array("detail2");
    $aDetail3 = array("detail3");
    $aDetail4 = array("detail4");

    include("connect.inc");

    for ($n=1; $n<=$x; $n++){
         If (!empty($aSlipcode[$n])){
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

$cDetail4=$row->detail4;
if(empty($cDetail4)){
$cDetail4='()';
}
             array_push($aDetail1,$row->detail1); 
             array_push($aDetail2,$row->detail2); 
             array_push($aDetail3,$row->detail3); 
             array_push($aDetail4,$cDetail4); 
                                                  }    
                                          }

// print slip   
    for ($n=1; $n<=$x; $n++){
           print "<font face='Angsana New' size='1'>$cPtname , $Thaidate<br></font>";
           $aTrade[$n]=substr($aTrade[$n],0,15);
           print "<font face='Angsana New' size='1'>$aTrade[$n]#$aAmount[$n],$aDgcode[$n]<br></font>";
           print "<font face='Angsana New' size='2'>$aDetail1[$n]<br></font>";
           print "<font face='Angsana New' size='2'>$aDetail2[$n]<br></font>";
           print "<font face='Angsana New' size='2'>$aDetail3[$n]<br></font>";
           if ($n==$x){
                      print "<font face='Angsana New' size='2'>$cDetail4<br><br></font>";
                           }
           else {   
                      print "<font face='Angsana New' size='2'>$cDetail4<br><br><br></font>";
                    }

             }

 include("unconnect.inc");
?>


