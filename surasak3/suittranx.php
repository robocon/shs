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

//insert data into labsuit
     $sql = "INSERT INTO labcare(code,depart,detail,price,part)
                  VALUES('$cSuitcode','$cDepart','$cSuitname','$Netprice','');";
      $result = mysql_query($sql) or 
                die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้บันทึกข้อมูลไปก่อนแล้ว หรือการบันทึกล้มเหลว<br>
	*โปรดตรวจสอบว่ามีรายการในเมนู [ดูการจ่ายเงิน] หรือไม่<br>
	*ถ้ามีแสดงว่า ได้บันทึกไปก่อนแล้ว<br>
	*ถ้าไม่มีแสดงว่า  การบันทึกล้มเหลว<br><br>
                -------- รายการ ---------<br> 
	ชื่อสูตร :$cSuitname<br>
                รหัสสูตร :$cSuitcode<br>
                $cSuitname<br>
               จำนวน $item รายการ<br>
               ราคารวม $Netprice บาท<br>
               จนท. $sOfficer<br>");

    for ($n=1; $n<=$x; $n++){
         If (!empty($aDgcode[$n])){
                $query = "INSERT INTO labsuit(suitcode,code,depart,detail,amount,price,part,idname)
                                 VALUES('$cSuitcode','$aDgcode[$n]','$cDepart','$aTrade[$n]','$aAmount[$n]',
                                 '$aMoney[$n]','$aPart[$n]','$sOfficer');";
           $result = mysql_query($query) or  die("Query failed,update opday");
		        }
		        };

   include("unconnect.inc");

//ใบแจ้งหนี้
    print "ชื่อสูตร :$cSuitname<br>";
    print "รหัสสูตร :$cSuitcode<br>";
    $no=0;
    for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
              $no++;
              print "$no - $aTrade[$n],จำนวน$aAmount[$n],ราคา$aMoney[$n] บาท<br>";
                         }
                         } ;
   print "ราคารวม $Netprice บาท<br>";
   print "จนท. $sOfficer<br>";  
//จบใบแจ้งหนี้
?>
 
