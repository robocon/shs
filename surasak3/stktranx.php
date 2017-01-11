<?php
    session_start();
  //  $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thidate = (date("Y")+543).date("-m-d");
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $cGetdate=date("Y-m-d");

    include("connect.inc");

//insert data into stktranx table
/*
$aDgcode[$n]
$aTrade[$n]
$aExpdate[$n]
$aLotno[$n]
$aAmount[$n]
$aStkcut[$n]
$aNetlot[$n]
$aUnit[$n]

$cBillno
$cDepcode
$aUnitpri[$n]
$nChktran;
*/

// print "$Thidate<br>";
//insert data into billtranx เพื่อป้องกันการตัดสต๊อกซ้ำ
   $query = "INSERT INTO billtranx(chktranx,date,officer)
                    VALUES('$nRunno','$Thidate','$sOfficer');";
       $result = mysql_query($query) or 
                die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้บันทึกข้อมูลไปก่อนแล้ว หรือการบันทึกล้มเหลว<br>");

//insert data into stktranx เพื่อบันทึกรายการเบิกจากคลังยาไปหน่วยเบิก
 for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
 $nNetlot=$aAmount[$n]-$aStkcut[$n];
   $query = "INSERT INTO stktranx(date,drugcode,tradname,expdate,lotno,stkcut,unit,officer,billno,department,unitpri,netlotno,getdate,
	mainstk,stock,totalstk)
                    VALUES('$cGetdate','$aDgcode[$n]','$aTrade[$n]','$aExpdate[$n]','$aLotno[$n]',
                    	'$aStkcut[$n]','$aUnit[$n]','$sOfficer','$cBillno','$cDepcode','$aUnitpri[$n]','$nNetlot','$cGetdate',
	                '$aMainstk[$n]','$aStock[$n]','$aTotalstk[$n]');";
   $result = mysql_query($query) or die("ท่านได้ตัดสต๊อกไปก่อนแล้ว");
//   echo mysql_errno() . ": " . mysql_error(). "\n";
//   echo "<br>";
		   }
   };
//update data in combill
 for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query ="UPDATE combill SET amount = amount- $aStkcut[$n]
                       WHERE dgexplot= '$aDglotno[$n]' ";
        $result = mysql_query($query)
                       or die("Query failed,update combill");
//       echo mysql_errno() . ": " . mysql_error(). "\n";
//        echo "<br>";
		}
        };

//update data in druglst 
 for ($n=1; $n<=$x; $n++){
   If ($cDepcode=='ห้องจ่ายยา'){
        $query ="UPDATE druglst SET stock = stock+$aStkcut[$n],
			          mainstk=mainstk-$aStkcut[$n],
            			          totalstk = stock + mainstk,
								  datetranx = '".(date("Y")+543)."".date("-m-d H:i:s")."'

                       WHERE drugcode= '$aDgcode[$n]' ";
        $result = mysql_query($query)
                       or die("1Query failed,update druglst");
		}
   else{
        $query ="UPDATE druglst SET mainstk=mainstk-$aStkcut[$n],
              			          rxaccum = rxaccum + $aStkcut[$n],
             			          rx1day   = rx1day + $aStkcut[$n],
            			          totalstk = stock + mainstk,
								  datetranx = '".(date("Y")+543)."".date("-m-d H:i:s")."'
                       WHERE drugcode= '$aDgcode[$n]' ";
        $result = mysql_query($query)
                       or die("2Query failed,update druglst");
         }
        };

///////เบิกจากหน่วยเบิกอื่น ไม่ใช่ห้องจ่ายยาย่อย
 $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
 $Netprice=0;
     If ($cDepcode!='ห้องจ่ายยา'){
            for ($n=1; $n<=$x; $n++){
                 $nPrice = $aStkcut[$n]*$aUnitpri[$n];
                 $Netprice=$Netprice + $nPrice;
         
                 $query = "INSERT INTO stkdata(date,billno,depcode,drugcode,tradname,
                         amount,price,part)VALUES('$Thidate','$cBillno','$cDepcode','$aDgcode[$n]','$aTrade[$n]',
                         '$aStkcut[$n]','$nPrice','$aPart[$n]');";
                 $result = mysql_query($query) or die("Query failed,insert into stkdata");
          			       };

	//insert data into stkbill
                $query = "INSERT INTO stkbill(chktranx,date,depcode,billno,item,price,idname)
                                            VALUES('$nChktran','$Thidate','$cDepcode','$cBillno','$x','$Netprice','$sOfficer');";               
                $result = mysql_query($query) or
	        die(" เตือน ! เมื่อพบหน้าต่างนี้แสดงว่า<br>
	       1. การตัด stock in stkbill ล้มเหลว<br>
	           หรือ<br>
	       2. ได้ตัด stock ไปก่อนแล้ว<br><br>
	          โปรดตรวจสอบ<br>");
			}

 include("unconnect.inc");
//report
   print "<font face='Angsana New'>วันที่ $Thaidate<br>";
   print "<font face='Angsana New'>รายการเบิกยาเวชภัณฑ์จากคลังยาใหญ่ไป$cDepcode<br>";
   print "<table>";
   print " <tr>";
   print "  <th>#</th>";
   print "  <th>รายการ</th>";
   print "  <th>หมดอายุ</th>";
   print "  <th>Lot.No.</th>";
   print "  <th>จำนวน</th>";
   print "  <th>เบิก</th>";
   print "  <th>หน่วย</th>";
   print "  <th>เหลือ</th>";

   print " </tr>";
      $no=0;
   for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
         $no++;
   $nNetlot=$aAmount[$n]-$aStkcut[$n];
         print (" <tr>\n".
           "  <td>$no</td>\n".
           "  <td>$aTrade[$n]</td>\n".
           "  <td>$aExpdate[$n]</td>\n".
           "  <td>$aLotno[$n]</td>\n".
           "  <td>$aAmount[$n]</td>\n".
           "  <td>$aStkcut[$n]</td>\n".
           "  <td>$aUnit[$n]</td>\n".
           "  <td>$nNetlot</td>\n".
           " </tr>\n");
			}
                                              };
   print "</table>";
   print "<br><font face='Angsana New'>จนท. $sOfficer<br>";
//end report
?>
