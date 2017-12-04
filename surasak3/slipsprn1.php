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
       //  $aDgcode0[$n]=substr($aDgcode[$n],0,1);
//$aDgcode1[$n]=substr($aDgcode[$n],1,1);
//$aDgcode2[$n]=substr($aDgcode[$n],2,1);
//$aDgcode3[$n]=substr($aDgcode[$n],3,1);
//$aDgcode4[$n]=substr($aDgcode[$n],4,1);
//$aDgcode5[$n]=substr($aDgcode[$n],5,1);
//$aDgcode6[$n]=substr($aDgcode[$n],6,1);
$cPtname=substr($cPtname,0,25);
            print "<font face='Cordia UPC' size='1'> &nbsp;<br></font>";
              print "<font face='Cordia UPC' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sPtname&nbsp;<br></font>";
              print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$Thaidate&nbsp;(vn$tvn).NO.$n/$injcount <br></font>";
     
//         print "<font face='Cordia UPC' size='1'>$aTrade[$n],$aDgcode[$n],$aAmount[$n]<br></font>";
           $aTrade[$n]=substr($aTrade[$n],0,18);
           print "<font face='Cordia UPC' size='1'>$aDgcode0[$n]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$aTrade[$n],</font><font face='Cordia UPC' size='1'><B>$aAmount[$n]</B><br></font>";
        print "<font face='Microsoft sans serif' size='1'>$aDgcode1[$n]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></font>";
      
  print "<font face='Cordia UPC' size='1'>$aDgcode2[$n]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$aDetail1[$n]<br></font>";
           print "<font face='Cordia UPC' size='1'>$aDgcode3[$n]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$aDetail2[$n]<br></font>";

           if ($n==$x){
                      print "<font face='Cordia UPC' size='1'>$aDgcode4[$n]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$aDetail3[$n]<br></font>";
			    print "<font face='Cordia UPC' size='1'>$aDgcode5[$n]</font>&nbsp;&nbsp;&nbsp;<font face='Angsana New' size='2'>$aDrugnote[$n]</font>";

		   
                           }
           else {   
                      print "<font face='Cordia UPC' size='1'>$aDgcode4[$n]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$aDetail3[$n]<br></font>";
                      print "<font face='Cordia UPC' size='1'>$aDgcode5[$n]</font>&nbsp;&nbsp;&nbsp;&nbsp;<font face='Angsana New' size='2'>$aDrugnote[$n]<br></font>";
	         	   }
		//   print "<font face='Angsana New' size='1'>$aDetail4[$n]<br></font>";
         	}
	}
	
 include("unconnect.inc");
?>


