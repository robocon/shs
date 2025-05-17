<?php
    session_start();
?>

<?
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $aDetail1 = array("detail1");
    $aDetail2 = array("detail2");
    $aDetail3 = array("detail3");
    $aDetail4 = array("detail4");

    include("connect.inc");
//////// add drugnote from druglst
    $aDrugnote = array("drugnote");
    for ($n=1; $n<=$x; $n++){
             $query = "SELECT drugnote,drugname,drug_properties FROM druglst WHERE drugcode = '$aDgcode[$n]' ";
            // echo $query;
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
//ตัดค่าฉีดยาทิ้ง
    $injcount=0;
    for ($n=1; $n<=$x; $n++){
	if ($aDgcode[$n]=='INJ'){
		$injcount++;
		}
	}
    $injcount=$x - $injcount;
	
    for ($n=1; $n<=$x; $n++){
         if (!empty($aSlipcode[$n])){
		 
             $query1 = "SELECT drugnote, drugname,drug_properties,part FROM druglst WHERE drugcode = '$aDgcode[$n]' ";
            // echo $query1;
			 $result1 = mysql_query($query1) or die("Query failed drugnote,druglst ");
			 list($eDrugnote,$eDgname,$eDgproperties,$ePart)=mysql_fetch_array($result1);
			 
			$chkdrugname=trim($eDgname);
			$lendrugname=strlen($chkdrugname);	
			
		if($ePart=="DDL"){
			$aText="(ยาหลักแห่งชาติ)";
		}else if($ePart=="DDY" || $ePart=="DDN"){
			$aText="(ยานอกบัญชี)";
		}

					 
		print "<div align='center'>";		   
		print "<div style='margin-left: 35px; line-height:18px;  font-size: 18px;'>$sPtname</div>";
		print "<div style='margin-left: 20px; line-height:18px; font-size: 10px;'>HN:$cHn&nbsp;VN:$tvn&nbsp;Date:$Thaidate&nbsp;No:$n/$injcount</div>";
		   
           $aTrade[$n]=substr($aTrade[$n],0,22);
           print "<div style='margin-left: 35px; line-height:17px; font-size: 12px;'>$aTrade[$n] ($aDgcode[$n])=$aAmount[$n]</div>";
		   print "<div style='line-height:5px;'>&nbsp;</div>";
           print "<div style='margin-left: 35px; line-height:17px; font-size: 16px;'>$aDetail1[$n]</div>";
           print "<div style='margin-left: 35px; line-height:17px; font-size: 16px;'>$aDetail2[$n]</div>";

           if($n==$x){  // 2 บรรทัด
                print "<div style='margin-left: 35px; line-height:17px; font-size: 16px;'>$aDetail3[$n]</div>";
				print "<div style='line-height:5px;'>&nbsp;</div>";
				print "<div style='margin-left: 35px; line-height:17px; font-size: 16px;'><u>$eDgproperties</u></div>";
				if(!empty($chkdrugname)){  //ถ้ามีชื่อสามัญ
					print "<div style='margin-left: 35px; line-height:17px; font-size: 12px;'><b>ชื่อสามัญ $chkdrugname&nbsp;$aText</b></div>";
				}
				print "<div style='margin-left: 35px; line-height:17px; font-size: 12px;'><u><b>$aDrugnote[$n]</b></u></div>";
          }else{  // 3 บรรทัด
                print "<div style='margin-left: 35px; line-height:17px; font-size: 16px;'>$aDetail3[$n]</div>";
				print "<div style='line-height:5px;'>&nbsp;</div>";
				print "<div style='margin-left: 35px; line-height:17px; font-size: 16px;'><u>$eDgproperties</u></div>";
				if(!empty($chkdrugname)){  //ถ้ามีชื่อสามัญ
					print "<div style='margin-left: 35px; line-height:17px; font-size: 12px;'><b>ชื่อสามัญ $chkdrugname&nbsp;$aText</b></div>";
				}
				print "<div style='margin-left: 35px; line-height:17px; font-size: 12px;'><u><b>$aDrugnote[$n]</b></u></div>";
			}
			print "<div style='margin-left: 35px; line-height:17px; font-size: 16px;'>$aDetail4[$n]</div>";
			print "<div style='margin-left: 35px; line-height:17px; font-size: 12px;'>&nbsp;</div>";
			
			print "</div>";	
		 
			 
		 
		 
		 }  //ปิด if line 60
	}  //ปิด for line 59
//print "</div>";	
 include("unconnect.inc");
 //print "<font face='AngsanaUPC' size='2'>$aDrugnote[$n]<br></font>";/// add drugnote from
?>


