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
       $query = "INSERT INTO dphardep(chktranx,date,ptname,hn,price,doctor,item,
                    idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright,whokey)VALUES('$nRunno','$Thidate','$cPtname','$cHn',
                    '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
	    '$Nessdn','$DPY','$DPN','$DSY','$DSN','$tvn','$cPtright','DR');";

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

//insert data into drugrx
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query = "INSERT INTO ddrugrx(date,hn,drugcode,tradname,
             amount,price,item,slcode,part,idno)VALUES('$Thidate','$cHn','$aDgcode[$n]','$aTrade[$n]',
             '$aAmount[$n]','$aMoney[$n]','$item','$aSlipcode[$n]','$aPart[$n]','$idno');";
        $result = mysql_query($query) or die("Query failed,insert into drugrx");
			}
        };

/*
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

//update data in opday 

        $query ="UPDATE opday SET diag = '$cDiag',
              			         doctor='$cDoctor',
			         phar= phar+$Netprice
                       WHERE thdatehn= '$Thdhn' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");
*/

//
  print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;<B>ใบสั่งยา</B><BR>";
      print "$Thaidate<font face='Angsana New' size='2'>&nbsp; VN:$tvn<br>";
      print "<font face='Angsana New' size='1'>$cPtname  HN:$cHn<br>";
      print "สิทธิ:$cPtright<br>";
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
     // print "รวมเงิน  $total  บาท(เบิกไม่ได้ $netpay บาท , เบิกได้ $netfree บาท)<br>";
     // print "แพทย์ $cDoctor<br>";
	    print "เบิกได้ $netfree บาท&nbsp;";
		  print "เบิกไม่ได้ $netpay บาท <br>";
		    print "<font face='Angsana New' size='2'><B>***รวมเงิน &nbsp; $total  บาท***</B><BR>";
		    print "<font face='Angsana New' size='1'>เจ้าหน้าที่ :$sOfficer<BR>";
			  //  print "<B>*นำไปชำระเงินที่ห้องเก็บเงิน</B>";
//
 include("unconnect.inc");
?>
 
