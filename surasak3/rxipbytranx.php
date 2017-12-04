<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
//
    $Essd    =array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $Nessdn=array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
    $DPY     =array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  
    $DSY     =array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  
//IPD เบิกค่าเวชภัณฑ์ได้
$netfree=$Essd+$Nessdy+$DSY+ $DSN+$DPY;
$netpay=$Nessdn+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;

//item count
$item=0;
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
             $item++;
	}
        };

 include("connect.inc");

//insert data into phardep
   $query = "INSERT INTO phardep(chktranx,date,ptname,hn,an,price,doctor,item,
           idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,accno,tvn,ptright)VALUES('$nRunno','$Thidate','$cPtname','$cHn','$cAn',
          '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy','$Nessdn',
          '$DPY','$DPN','$DSY','$DSN','$cAccno','$cAn','$cPtright');";

   $result = mysql_query($query) or 
                die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้ตัด stock ไปก่อนแล้ว หรือการตัด stock ล้มเหลว<br>
	*โปรดตรวจสอบว่ามีรายการยาในเมนู [ใบสั่งยา,การจ่ายเงิน] หรือไม่<br>
	*ถ้ามีแสดงว่า ได้ตัด stock ไปก่อนแล้ว<br>
	*ถ้าไม่มีแสดงว่า  การตัด stock ล้มเหลว<br><br>
                -------- รายการจ่าย ---------<br> 
                $Thaidate<br>
                $cPtname  HN:$cHn<br>
                สิทธิ:$cPtright<br>
                โรค $cDiag<br>
                รวมเงินค่ายา  $total  บาท<br>
                แพทย์ $cDoctor<br>");
/*
     die("$Thaidate<br>
            $cPtname  HN:$cHn  AN:$cAn<br>
            สิทธิ:$cPtright<br>
            โรค $cDiag<br>
            รวมเงินค่ายา  $total  บาท<br>
            แพทย์ $cDoctor<br>");
*/
   $idno=mysql_insert_id();

//update data in druglst 
for ($n=1; $n<=$x; $n++){
	If (!empty($aDgcode[$n])){
		$query ="UPDATE druglst SET stock = stock-$aAmount[$n],
		rxaccum = rxaccum + $aAmount[$n],
		rx1day   = rx1day +$aAmount[$n],
		totalstk = stock + mainstk
		WHERE drugcode= '$aDgcode[$n]' ";
		$result = mysql_query($query) or die("Query failed,update druglst");
	}
};

//insert data into drugrx
for ($n=1; $n<=$x; $n++){
	If (!empty($aDgcode[$n])){
		 $sql = "Select stock From druglst where drugcode = '".$aDgcode[$n]."' limit 0,1 ";
		 $result = Mysql_Query($sql);
		 $arr = Mysql_fetch_assoc($result);
		 $stock = $arr["stock"];

		$query = "INSERT INTO drugrx(date,hn,an,drugcode,tradname,
		amount,price,item,slcode,part,idno,stock)VALUES('$Thidate','$cHn','$cAn','$aDgcode[$n]','$aTrade[$n]',
		'$aAmount[$n]','$aMoney[$n]','$item','$aSlipcode[$n]','$aPart[$n]','$idno','$stock');";
		$result = mysql_query($query) or die("Query failed,insert into drugrx");
	}
};
//  insert data into ipacc
     for ($n=1; $n<=$x; $n++){
            If (substr($aPart[$n],0,2) != "DP"){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno                                  )VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n],$aSlipcode[$n]',
                                   '$aAmount[$n]','$aMoney[$n]','$aPart[$n]','$sOfficer','$cAccno','$idno');";
                   $result = mysql_query($query) or die("insert into ipacc failed");
        }
       //////////
            If ($aPart[$n]=="DPY"){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno                                  )VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n],$aSlipcode[$n]',
                                   '$aAmount[$n]','$aDPY[$n]','$aPart[$n]','$sOfficer','$cAccno','$idno');";
                   $result = mysql_query($query) or die("insert into ipacc failed");
	///////////////////

                   If ($aDPN[$n] > 0){
                                $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno                                )VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n],$aSlipcode[$n]',
                                   '','$aDPN[$n]','DPN','$sOfficer','$cAccno','$idno');";
                                 $result = mysql_query($query) or die("insert into ipacc failed");
		        }

		}
            If ($aPart[$n]=="DPN"){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno                                  )VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n],$aSlipcode[$n]',
                                   '$aAmount[$n]','$aDPN[$n]','$aPart[$n]','$sOfficer','$cAccno','$idno');";
                   $result = mysql_query($query) or die("insert into ipacc failed");
        }

       }

//ใบสั่งยา
      print "<font face='Angsana New'>$Thaidate<br>";
      print "$cPtname  HN:$cHn  AN:$cAn<br>";
      print "สิทธิ:$cPtright<br>";
      print "โรค $cDiag";
      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>รายการ</th>";
      print "  <th>วิธีใช้</th>";
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
           "  <td>$aSlipcode[$n]</td>\n".
           "  <td>$aAmount[$n]</td>\n".
           "  <td>$aMoney[$n]</td>\n".
           " </tr>\n");
		}
                                              };
      print "</table>";
      print "รวมเงิน  $total  บาท<br>";
      print "(เบิกไม่ได้ $netpay บาท,เบิกได้ $netfree บาท)<br>";
      print "แพทย์ $cDoctor<br>";
      print "ผู้ตรวจ: .....";
//
 include("unconnect.inc");
?>
