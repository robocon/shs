<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

	 include("connect.inc");
    $query = "SELECT * FROM ddepart WHERE row_id = '$sRow_id' "; 
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
    $nRunno=$row->chktranx;
    $cHn=$row->hn;
    $cPtname=$row->ptname;
    $cDoctor=$row->doctor;
	$cDepart=$row->depart;
	$item=$row->item;
	$cDetail=$row->detail;
	$Netprice=$row->price;
	    $nSumYprice=$row->sumyprice;
	    $nSumNprice=$row->sumnprice;
	$cDiag=$row->diag;
	$cAccno=$row->accno;
	$tvn=$row->tvn;
	$cPtright=$row->ptright;
	////////
    $query = "SELECT code,detail,amount,price,yprice,nprice,part FROM dpatdata WHERE idno = '$sRow_id' ";
    $result = mysql_query($query)
        or die("Query failed");
    $n=0;
    while (list ($code,$detail,$amount, $price,$yprice,$nprice,$part) = mysql_fetch_row ($result)) {
        $n++;
		$aDgcode[$n]=$code;
		$aTrade[$n]=$detail;
		$aAmount[$n]=$amount;
		$aMoney[$n]=$price;
		$aYprice[$n]=$yprice;
		$aNprice[$n]=$nprice;
		$aPart[$n]=$part;
	     };
    /////////
   //insert data into depart
   $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice, sumnprice,idname,diag,accno,tvn,ptright)VALUES('$nRunno','$Thidate','$cPtname','$cHn','','$cDoctor','$cDepart','$item','$cDetail',
                    '$Netprice','$nSumYprice','$nSumNprice','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright');";
    $result = mysql_query($query) or 
                die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้บันทึกข้อมูลไปก่อนแล้ว หรือการบันทึกล้มเหลว<br>
	*โปรดตรวจสอบว่ามีรายการในเมนู [ดูการจ่ายเงิน] หรือไม่<br>
	*ถ้ามีแสดงว่า ได้บันทึกไปก่อนแล้ว<br>
	*ถ้าไม่มีแสดงว่า  การบันทึกล้มเหลว<br><br>
                -------- รายการ ---------<br> 
	$Thaidate<br>
	$cPtname HN:$cHn  VN:$tvn<br>
                สิทธิ: $cPtright<br>
                โรค:$cDiag<br>
                แพทย์:$cDoctor<br>
                $cDetail<br>
               จำนวน $item รายการ<br>
               ราคารวม $Netprice บาท<br>
               จนท. $sOfficer<br>");

//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//insert data into patdata
    for ($n=1; $n<=$item; $n++){
         If (!empty($aDgcode[$n])){
                $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
                                 VALUES('$Thidate','$cHn','','$cPtname','$cDoctor','$item','$aDgcode[$n]','$aTrade[$n]','$aAmount[$n]',
                                 '$aMoney[$n]','$aYprice[$n]','$aNprice[$n]','$cDepart','$aPart[$n]','$idno','$cPtright');";
                $result = mysql_query($query) or die("Query failed,cannot insert into patdata");
        }
        }
/* in case of inpatient insert data into ipacc
IF (!empty($cAn)) {
     for ($n=1; $n<=$item; $n++){
          If (!empty($aDgcode[$n])){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                                    idname,part,accno,idno)VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n]',
                                    '$aAmount[$n]','$aMoney[$n]','$sOfficer','$aPart[$n]','$cAccno','$idno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
        }
   }
}
*/
//update data in opday 
	if ($cDepart == 'XRAY'){
			    $xraypri=$Netprice;
	            }
	else {
					    $xraypri=0;
	         }
	if ($cDepart =='PATHO'){
			    $pathopri=$Netprice;
	            }
	else {
					    $pathopri=0;
	         }
	if ($cDepart =='EMER'){
			    $emerpri=$Netprice;
	            }
	else {
					    $emerpri=0;
	         }
	if ($cDepart =='SURG'){
			    $surgpri=$Netprice;
	            }
	else {
					    $surgpri=0;
	         }
	if ($cDepart =='PHYSI'){
			    $physipri=$Netprice;
	            }
	else {
					    $physipri=0;
	         }
	if ($cDepart =='DENTA'){
			    $dentapri=$Netprice;
	            }
	else {
					    $dentapri=0;
	         }
	if ($cDepart =='OTHER'){
			    $otherpri=$Netprice;
	            }
	else {
					    $otherpri=0;
	         }
		$Thdhn=date("d-m-").(date("Y")+543).$cHn;
        $query ="UPDATE opday SET   xray= xray+$xraypri,
																patho=patho+$pathopri,
																emer=emer+$emerpri,
																surg=surg+$surgpri,
																physi=physi+$physipri,
																denta=denta+$dentapri,
																other=other+$otherpri
					   WHERE thdatehn= '$Thdhn' AND vn = '$tvn' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");
   include("unconnect.inc");
//ใบแจ้งหนี้
  print "ใบแจ้งหนี้<br>";
     print "<font face='Angsana New'>$cPtname HN:$cHn VN:$tvn  สิทธิ: $cPtright<br>";
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
    for ($n=1; $n<=$item; $n++){
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
   print "<B>ราคารวม $Netprice บาท</B><br>";
   print "จนท. $sOfficer";  
      print "<font face='Angsana New'>&nbsp;&nbsp;$Thaidate<br>";
      print "***************************************************<br>";  
	     print "<B>นำใบแจ้งหนี้ไปชำระเงินที่ห้องเก็บเงิน</B>";  
//จบใบแจ้งหนี้
?>
 
