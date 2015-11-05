<?php
  session_start();
  if (isset($sIdname)){} else {die;} //for security
  $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

//item count
$item=0;
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
             $item++;
	}
        };

 include("connect.inc");

//insert data into stkbill
         $query = "INSERT INTO stkbill(chktranx,date,depcode,billno,item,price,idname)
                                            VALUES('$nRunno','$Thidate','$cDepcode','$cBillno','$item','$Netprice','$sOfficer');";
                 
   $result = mysql_query($query) or
	die(" เตือน ! เมื่อพบหน้าต่างนี้แสดงว่า<br>
	1. การตัด stock ล้มเหลว<br>
	หรือ<br>
	2. ได้ตัด stock ไปก่อนแล้ว<br><br>
	โปรดตรวจสอบ<br><br>
                -------- รายการจ่าย ---------<br> 
           $Thaidate<br>
           หน่วยเบิก:$cDepcode<br>
           เลขที่ใบเบิก:$cBillno<br>
           จำนวน $item รายการ<br>
           รวมเงิน $Netprice บาท<br>
          <br>จนท. $sOfficer<br>");

//insert data into stkdata
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
         $query = "INSERT INTO stkdata(date,billno,depcode,drugcode,tradname,
             amount,price,part)VALUES('$Thidate','$cBillno','$cDepcode','$aDgcode[$n]','$aTrade[$n]',
             '$aAmount[$n]','$aMoney[$n]','$aPart[$n]');";

        $result = mysql_query($query)
        or die("Query failed,insert into drugrx");
	}
        };


//update data in druglst 
 for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query ="UPDATE druglst SET stock = stock - $aAmount[$n],
              			  rxaccum = rxaccum + $aAmount[$n],
             			  rx1day   = rx1day +$aAmount[$n],
        			  totalstk = stock + mainstk
                       WHERE drugcode= '$aDgcode[$n]' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
		}
        };

 include("unconnect.inc");

//report
   print "$Thaidate<br>";
   print "หน่วยเบิก:$cDepcode<br>";
   print "เลขที่ใบเบิก:$cBillno<br>";
   $no=0;
   for ($n=1; $n<=$x; $n++){
        If (!empty($aDgcode[$n])){
              $no++;
              print "$no - $aTrade[$n],
              จำนวน $aAmount[$n],รวมเงิน $aMoney[$n] บาท<br> ";
	}
                } ;
   print "รวมเงิน $Netprice บาท<br>";
   print "<br>จนท. $sOfficer<br>";
//end report
?>
 
