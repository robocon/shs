<body Onload="window.print();">
<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdhn=date("d-m-").(date("Y")+543).$cHn;
    $Essd    =array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $Nessdn=array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
    $DSY     =array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  
    $DPY     =array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  

$netfree=$Essd+$Nessdy+$DPY;
$netpay=$Nessdn+$DSY+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;

/*test
echo "aDPY:$aDPY[1] aDPN:$aDPN[1]<br>";
echo " Essd: $Essd,Nessdy:$Nessdy,Nessdn:$Nessdn<br>";
echo " DPY :$DPY, DPN: $DPN,  DSY :$DSY, DSN: $DSN <br>";

echo "ยาในบัญชียาหลักแห่งชาติ(Essd)...................$Essd<br>";
echo "ยานอกบัญชียาหลักแห่งชาติ เบิกได้ (Nessdy).$Nessdy.............เบิกไม่ได้ (Nessdny):$Nessdn<br>";
echo "ค่าเวชภัณฑ์ เบิกได้ (DSY).............................$DSY...........................เบิกไม่ได้(DSN):$DSN<br>";
echo "ค่าอุปกรณ์ เบิกได้ (DPY).............................$DPY...........................เบิกไม่ได้(DPN):$DPN<br>";

echo "รวมเบิกได้.................................................$netfree..........................รวมเบิกไม่ได้:$netpay<br>";
echo "รวมทั้งสิ้น...........$total<br>";
*/


//item count
$item=0;
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
             $item++;
	}
        };

 include("connect.inc");

//insert data into phardep
       $query = "INSERT INTO phardep(chktranx,date,ptname,hn,price,doctor,item,
                    idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright,phapt)VALUES('$nRunno','$Thidate','$cPtname','$cHn',
                    '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
	    '$Nessdn','$DPY','$DPN','$DSY','$DSN','$tvn','$cPtright','$sOfficer');";

       $result = mysql_query($query) or 
                die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้ตัด stock ไปก่อนแล้ว หรือการตัด stock ล้มเหลว<br>
	*โปรดตรวจสอบว่ามีรายการยาในเมนู [ใบสั่งยา,การจ่ายเงิน] หรือไม่<br>
	*ถ้ามีแสดงว่า ได้ตัด stock ไปก่อนแล้ว<br>
	*ถ้าไม่มีแสดงว่า  การตัด stock ล้มเหลว<br><br>
                -------- รายการจ่าย ---------<br> 
                $Thaidate<br>
                $cPtname  HN:$cHn VN:$tvn<br>
                สิทธิ:$cPtright<br>
                โรค $cDiag<br>
                รวมเงินค่ายา  $total  บาท<br>
                แพทย์ $cDoctor<br>");

//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//update data in druglst 
 for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query ="UPDATE druglst SET stock = stock-$aAmount[$n],
              			  rxaccum = rxaccum + $aAmount[$n],
             			  rx1day   = rx1day +$aAmount[$n],
        			  totalstk = stock + mainstk
                       WHERE drugcode= '$aDgcode[$n]' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
			}
        };

//insert data into drugrx
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){

	   	 $sql = "Select stock From druglst where drugcode = '".$aDgcode[$n]."' limit 0,1 ";
		 $result = Mysql_Query($sql);
		 $arr = Mysql_fetch_assoc($result);
		 $stock = $arr["stock"];

        $query = "INSERT INTO drugrx(date,hn,drugcode,tradname,
             amount,price,item,slcode,part,idno,stock)VALUES('$Thidate','$cHn','$aDgcode[$n]','$aTrade[$n]',
             '$aAmount[$n]','$aMoney[$n]','$item','$aSlipcode[$n]','$aPart[$n]','$idno','$stock');";
        $result = mysql_query($query) or die("Query failed,insert into drugrx");
			}
        };

//update data in opday 

        $query ="UPDATE opday SET diag = '$cDiag',
              			         doctor='$cDoctor',
			         phar= phar+$Netprice
                       WHERE thdatehn= '$Thdhn'  AND vn = '$tvn' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");


//ใบสั่งยา
  print "<font face='Angsana New' size='1'>.</B><BR></font>";
     
  print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>ใบแสดงรายการยา</B><BR></font>";
     
 print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$Thaidate&nbsp; VN:$tvn<br></font>";
      print "<font face='Angsana New' size='2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cPtname  HN:$cHn<br></font>";
      print "<font face='Angsana New' size='2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สิทธิ:$cPtright<br></font></font>";
      //print "โรค $cDiag<br>";
    //  print "<table>";
    //  print " <tr>";
    //  print "  <th>#</th>";
    //  print "  <th>รายการ</th>";
//      print "  <th>วิธีใช้</th>";
   //   print "  <th>จำนวน</th>";
   //   print "  <th>ราคา</th>";
   //   print " </tr>";
  //    $no=0;
///      for ($n=1; $n<=$x; $n++){
//   If (!empty($aDgcode[$n])){
 //             $no++;
  //       print (" <tr>\n".
    //       "  <td>$no</td>\n".
   //        "  <td>$aTrade[$n]</td>\n".
    //       "  <td>$aSlipcode[$n]</td>\n".
  //         "  <td>$aAmount[$n]</td>\n".
    //       "  <td>$aMoney[$n]</td>\n".
     //      " </tr>\n");
	//		}
   //                                           };
  //    print "</table>";
     // print "รวมเงิน  $total  บาท(เบิกไม่ได้ $netpay บาท , เบิกได้ $netfree บาท)<br></font>";
     // print "แพทย์ $cDoctor<br>";
	    print "<font face='Angsana New' size='3'><B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เบิกได้ $netfree บาท&nbsp;";
		
  print "เบิกไม่ได้ $netpay บาท <br></B></font>";
	
    print "<font face='Angsana New' size='3'><B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;***รวมเงิน &nbsp; $total  บาท***</B><BR></font>";
	
   // print "<font face='Angsana New' size='1'>เจ้าหน้าที่ :$sOfficer<BR></font>";
		
  //  print "<B>*นำไปชำระเงินที่ห้องเก็บเงิน</B>";
    
print "<br>";
//



// print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;<B>ใบแจ้งการชำระเงิน</B><BR></font>";
    
  print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$Thaidate&nbsp; HN:$cHn<br></font>";
//      print "<font face='Angsana New' size='1'>$cPtname  HN:$cHn<br></font>";
      print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สิทธิ:$cPtright<br></font>";

 //    print "<font face='Angsana New' size='1'>$cPtname  HN:$cHn &nbsp;VN:$tvn<br></font>";
    print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;บัญชียาหลัก &nbsp;$Essd <br></font>";
    print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;นอกบัญชียาหลัก &nbsp;$Nessdy &nbsp;เบิกไม่ได้&nbsp; $Nessdn <br></font>";
    print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ค่าเวชภัณฑ์ &nbsp;$DSY &nbsp;เบิกไม่ได้&nbsp;$DSN <br></font>";
    print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ค่าอุปกรณ์  &nbsp;$DPY &nbsp;เบิกไม่ได้&nbsp;$DPN <br></font>";
      //print "โรค $cDiag<br>";
    //  print "<table>";
    //  print " <tr>";
    //  print "  <th>#</th>";
    //  print "  <th>รายการ</th>";
//      print "  <th>วิธีใช้</th>";
   //   print "  <th>จำนวน</th>";
   //   print "  <th>ราคา</th>";
   //   print " </tr>";
  //    $no=0;
///      for ($n=1; $n<=$x; $n++){
//   If (!empty($aDgcode[$n])){
 //             $no++;
  //       print (" <tr>\n".
    //       "  <td>$no</td>\n".
   //        "  <td>$aTrade[$n]</td>\n".
    //       "  <td>$aSlipcode[$n]</td>\n".
  //         "  <td>$aAmount[$n]</td>\n".
    //       "  <td>$aMoney[$n]</td>\n".
     //      " </tr>\n");
	//		}
   //                                           };
  //    print "</table>";
     // print "รวมเงิน  $total  บาท(เบิกไม่ได้ $netpay บาท , เบิกได้ $netfree บาท)<br></font>";
     // print "แพทย์ $cDoctor<br>";
  print "<font face='Angsana New' size='2'><B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เบิกได้ $netfree บาท&nbsp;";
		
  print "เบิกไม่ได้ $netpay บาท </B><br></font>";
		
//    print "<font face='Angsana New' size='3'><B>***รวมเงิน &nbsp; $total  บาท***</B><BR></font>";
		
//print "<font face='Angsana New' size='1'>เจ้าหน้าที่ :$sOfficer<BR></font>";
			
  //  print "<B>*นำไปชำระเงินที่ห้องเก็บเงิน</B>";
   







 include("unconnect.inc");
?>


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
//ตัดค่าฉึดยาทิ้ง
    $injcount=0;
    for ($n=1; $n<=$x; $n++){
	if ($aDgcode[$n]=='INJ'){
		$injcount++;
		}
	};
    $injcount=$x - $injcount;
//$aDrugnote[$n]=substr($aDrugnote[$n],0,27);

    for ($n=1; $n<=$x; $n++){
         If (!empty($aSlipcode[$n])){
$aDgcode[$n]=substr($aDgcode[$n],0,2);
$cPtname=substr($cPtname,0,25);
            print "<font face='Cordia UPC' size='1'> &nbsp;<br></font>";
              print "<font face='Cordia UPC' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cPtname&nbsp;<br></font>";
              print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$Thaidate&nbsp;(vn$tvn).NO.$n/$injcount <br></font>";
     
//         print "<font face='Cordia UPC' size='1'>$aTrade[$n],$aDgcode[$n],$aAmount[$n]<br></font>";
           $aTrade[$n]=substr($aTrade[$n],0,18);
           print "<font face='Cordia UPC' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;ยา&nbsp;$aTrade[$n],</font><font face='Cordia UPC' size='1'><B>$aAmount[$n]</B>&nbsp;($aDgcode[$n])<br></font>";
        print "<font face='Microsoft sans serif' size='0.5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></font>";
      
  print "<font face='Cordia UPC' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$aDetail1[$n]<br></font>";
           print "<font face='Cordia UPC' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$aDetail2[$n]<br></font>";

           if ($n==$x){
                      print "<font face='Cordia UPC' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$aDetail3[$n]<br></font>";
			    print "<font face='Angsana New' size='2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$aDrugnote[$n]</font>";

		   
                           }
           else {   
                      print "<font face='Cordia UPC' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$aDetail3[$n]<br></font>";
                      print "<font face='Angsana New' size='2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$aDrugnote[$n]<br></font>";
	         	   }
		//   print "<font face='Angsana New' size='1'>$aDetail4[$n]<br></font>";
         	}
	}
	

 include("unconnect.inc");
?>


