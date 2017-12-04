<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

   $sHn=$row->hn;
    $sAn=$row->an;
    $sPtname=$row->ptname;
    $sDoctor=$row->doctor;
    $sDepart=$row->depart;
    $sDetail=$row->detail;  
    $sNetprice=$row->price*-1;
    $sDiag=$row->diag;

    $cPaid=$sNetprice;

   //item count
   $item=0;
   for ($n=1; $n<=$x; $n++){
        If (!empty($aDgcode[$n])){
             $item++;
	}
            };

    include("connect.inc");
//insert data into depart
   $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,
                    idname,diag,accno,tvn)VALUES('$nRunno','$Thidate','$cPtname','$cHn','$cAn','$cDoctor','$cDepart','$item','$aDetail',
                    '$Netprice','$sOfficer','$cDiag','$cAccno','$tvn');";

       $result = mysql_query($query) or 
                die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้บันทึกข้อมูลไปก่อนแล้ว หรือการบันทึกล้มเหลว<br>
	*โปรดตรวจสอบว่ามีรายการในเมนู [ดูการจ่ายเงิน] หรือไม่<br>
	*ถ้ามีแสดงว่า ได้บันทึกไปก่อนแล้ว<br>
	*ถ้าไม่มีแสดงว่า  การบันทึกล้มเหลว<br><br>
                -------- รายการ ---------<br> 
	$Thaidate<br>
	$cPtname HN:$cHn AN:$cAn VN:$tvn<br>
                สิทธิ: $cPtright<br>
                โรค:$cDiag<br>
                แพทย์:$cDoctor<br>
                $aDetail<br>
               จำนวน $item รายการ<br>
               ราคารวม $Netprice บาท<br>
               จนท. $sOfficer<br>");

//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//insert data into patdata
    for ($n=1; $n<=$x; $n++){
         If (!empty($aDgcode[$n])){
                $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno)
                                 VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$aDgcode[$n]','$aTrade[$n]','$aAmount[$n]',
                                 '$aMoney[$n]','$cDepart','$aPart[$n]','$idno');";
                $result = mysql_query($query) or die("Query failed,cannot insert into patdata");
        }
        }

// in case of inpatient insert data into ipacc
IF (!empty($cAn)) {
     for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                                    idname,part,accno,idno)VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n]',
                                    '$aAmount[$n]','$aMoney[$n]','$sOfficer','$aPart[$n]','$cAccno','$idno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
        }
   }
}

   include("unconnect.inc");

//ใบแจ้งหนี้
    print "<font face='Angsana New'>$Thaidate<br>";
    print "$cPtname HN:$cHn VN:$tvn  สิทธิ: $cPtright<br>";
//    print "สิทธิ: $cPtright<br>";
    print "โรค:$cDiag แพทย์:$cDoctor<br>";
//    print "แพทย์:$cDoctor<br>";

      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>รายการ</th>";
      print "  <th>จำนวน</th>";
      print "  <th>ราคา</th>";
      print " </tr>";

    $no=0;
    for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
              $no++;
         print (" <tr>\n".
           "  <td>$no</td>\n".
           "  <td>$aTrade[$n]</td>\n".
           "  <td>$aAmount[$n]</td>\n".
           "  <td>$aMoney[$n]</td>\n".
           " </tr>\n");
                         }
                         } ;
      print "</table>";
   print "ราคารวม $Netprice บาท<br>";
   print "จนท. $sOfficer<br>";  
//จบใบแจ้งหนี้
?>
 
