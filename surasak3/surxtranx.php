<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 

    $Essd    =array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $Nessdn=array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
    $DSY     =array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  
    $DPY     =array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  

$netfree=$Essd+$Nessdy+$DSY+$DPY;
$netpay=$Nessdn+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;

//item count
$item=0;
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
             $item++;
	}
        };

 include("connect.inc");

//insert data into labsuit
    for ($n=1; $n<=$x; $n++){
         If (!empty($aDgcode[$n])){
                $query = "INSERT INTO labsuit(suitcode,drugcode,depart,detail,amount,price,part,slipcode,idname)
                                 VALUES('$cSuitcode','$aDgcode[$n]','$cDepart','$aTrade[$n]','$aAmount[$n]',
                                 '$aMoney[$n]','$aPart[$n]','$aSlipcode[$n]','$sOfficer');";
           $result = mysql_query($query) or 
                die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้บันทึกข้อมูลไปก่อนแล้ว หรือการบันทึกล้มเหลว<br>
	*โปรดตรวจสอบ<br>
                -------- รายการ ---------<br> 
	ชื่อสูตร :$cSuitname<br>
                รหัสสูตร :$cSuitcode<br>
               จำนวน $item รายการ<br>
               ราคารวม $Netprice บาท<br>
               รวมเงินค่ายา  $total  บาท<br>
               จนท. $sOfficer<br>");
        }
        }

     $sql = "INSERT INTO druglst(drugcode,tradname,salepri,part)
                  VALUES('$cSuitcode','$cSuitname','$Netprice','');";
      $result = mysql_query($sql);

   include("unconnect.inc");

//ใบสั่งยา
      print "ชื่อสูตร :$cSuitname<br>";
      print "รหัสสูตร :$cSuitcode<br>";
      $no=0;
      for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
              $no++;
              print "$no - $aTrade[$n],$aSlipcode[$n],
                        จำนวน$aAmount[$n],ราคา$aMoney[$n] บาท<br>";
			}
                                              };
      print "รวมเงิน  $total  บาท<br>";
      print "จนท. $sOfficer<br><br>";
//
?>
 
