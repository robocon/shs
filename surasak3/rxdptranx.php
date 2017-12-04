<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security

    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdhn=date("d-m-").(date("Y")+543).$cHn;

for ($n=1; $n<=$x; $n++){
    //  รวมเงินค่ายาอุปกรณ์ ส่วนที่เบิกได้และไม่ได้/unit

	if($aFreepri[$n] > $aSalepri[$n])
		$aFreepri[$n] = $aSalepri[$n];

    $notfree=$aSalepri[$n] - $aFreepri[$n];
    //echo "notfree: $notfree<br>";
    $Free=$aAmount[$n]*$aFreepri[$n];   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $Pay =$aAmount[$n]*$notfree;   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้, ต้องจ่าย

    //echo "Pay: $Pay<br>";
    //  รวมเงินค่าเวชภัณฑ์ที่ไม่ใช่ยา ส่วนที่เบิกได้และไม่ได้
    $Snotfree=$aSalepri[$n] - $aFreepri[$n];
    $SFree=$aAmount[$n]*$aFreepri[$n];   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $SPay =$aAmount[$n]*$Snotfree;   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้, ต้องจ่าย

    if (substr($aPart[$n],0,3)=="DDL"){
            $aEssd[$n]=$aMoney[$n];
            }
    else {
            $aEssd[$n]=0;
        }
     //
     if (substr($aPart[$n],0,3)=="DDY"){
            $aNessdy[$n]=$aMoney[$n];
            }
     else {
            $aNessdy[$n]=0;
            }
     //
     if (substr($aPart[$n],0,3)=="DDN"){
            $aNessdn[$n]=$aMoney[$n];
            }
     else {
             $aNessdn[$n]=0;
         }
     //อุปกรณ์
     if (substr($aPart[$n],0,3)=="DPY"){
            $aDPY[$n]=$Free;  //อุปกรณ์ ส่วนที่เบิกได้ $row->free
            $aDPN[$n]=$Pay;  // อุปกรณ์ ส่วนที่เบิกไม่ได้ $row->salepri - $row->free
      //echo "aDPY:$aDPY[$n]<br>";
      //echo "aDPN:$aDPN[$n]<br>";
            }
      else {
            $aDPY[$n]=0;
            $aDPN[$n]=0;   
            }
     if (substr($aPart[$n],0,3)=="DPN"){
            $aDPN[$n]=$aMoney[$n]; //อุปกรณ์เบิกไม่ได้
            } 

      //echo "aDPY:$aDPY[$n]<br>";
      //echo "aDPN:$aDPN[$n]<br>";
     //เวชภัณฑ์ไม่ใช่ยา
     if (substr($aPart[$n],0,3)=="DSY"){
            $aDSY[$n]=$SFree;  //เวชภัณฑ์ไม่ใช่ยา ส่วนที่เบิกได้ $row->free
            $aDSN[$n]=$SPay;  // เวชภัณฑ์ไม่ใช่ยา ส่วนที่เบิกไม่ได้ $row->salepri - $row->free
            }
     else {
            $aDSY[$n]=0; 
            $aDSN[$n]=0;
            }
     if (substr($aPart[$n],0,3)=="DSN"){
            $aDSN[$n]=$aMoney[$n]; //เวชภัณฑ์ไม่ใช่ยา เบิกไม่ได้
            }   
			};
	///////////////////////////////////////
    $Essd    =array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $Nessdn=array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
    $DSY     =array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  
    $DPY     =array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  

$netfree=$Essd+$Nessdy+$DPY+$DSY;
$netpay=$Nessdn+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;

$Netprice=array_sum($aMoney);

//item count
$item=0;
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
             $item++;
	}
};

//insert data into dphardep
////////////////////////
//'$nRunno','$Thidate','$cPtname','$cHn',
// '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
// '$Nessdn','$DPY','$DPN','$DSY','$DSN','$tvn','$cPtright','DR');";

//'$aDgcode[$n]','$aTrade[$n]',
//'$aAmount[$n]','$aMoney[$n]','$aSlipcode[$n]','$aPart[$n]','$idno');";
///////////////////////////////////

 include("connect.inc");

       $query = "INSERT INTO dphardep(chktranx,date,ptname,hn,an,price,doctor,item,
                    idname,diag,essd,nessdy,nessdn,dpy,dpn,accno,dsy,dsn,tvn,ptright,whokey)VALUES('$nRunno','$Thidate','$cPtname','$cHn','$cAn',
                    '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
	    '$Nessdn','$DPY','$DPN','$cAccno','$DSY','$DSN','$cAn','$cPtright','$cBedcode');";

       $result = mysql_query($query) or 
                die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้ตกลงเบิกยาไปก่อนแล้ว หรือการเบิกยาล้มเหลว<br>
	*โปรดตรวจสอบ<br>
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
//print "<br>$idno <br>";//test 9/4/47 to find the last row

//insert data into ddrugrx
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query = "INSERT INTO ddrugrx(date,hn,an,drugcode,tradname,
             amount,salepri,freepri,price,item,slcode,part,idno)VALUES('$Thidate','$cHn','$cAn','$aDgcode[$n]','$aTrade[$n]',
             '$aAmount[$n]','$aSalepri[$n]','$aFreepri[$n]','$aMoney[$n]','$item','$aSlipcode[$n]','$aPart[$n]','$idno');";
        $result = mysql_query($query) or die("Query failed,insert into drugrx");
			}
        };

	   If (!empty($status)){
			print"$status<br>";
				   }
    print  "<font face='Angsana New'>เบิกยาผู้ป่วยในจำนวน $nDay วัน,  วันที่ $Thaidate<br> ";
    print "<font face='AngsanaUPC' size='2'><b> $cWard,เตียง $cBed, ชื่อ $cPtname, อายุ $cAge, HN:$cHn,AN:$cAn</b></font><br>";
	print" สิทธิ $cPtright , แพทย์  $cDoctor";
print"<table>";
 print"<tr>";
  print"<th><font face='Angsana New'>#</th>";
 print"  <th><font face='Angsana New'>วันที่</th>";
  print" <th><font face='Angsana New'>รายการ</th>";
   print"<th><font face='Angsana New'>หน่วยนับ</th>";
  print" <th><font face='Angsana New'>วิธิใช้</th>";
  print" <th><font face='Angsana New'>จำนวน</th>";
   print"<th><font face='Angsana New'>ราคา</th>";
//  print"<th><font face='Angsana New'>PART</th>";
//  print"<th><font face='Angsana New'>ราคาเบิกได้</th>";
 print"</tr>";
$num=0;
for ($n=1; $n<=$x; $n++){
	   If (!empty($aDgcode[$n])){
            $num++;
			print (" <tr>\n".
               "  <td>$num</td>\n".
               "  <td><font face='Angsana New'>$aDgcode[$n]</td>\n".
               "  <td><font face='Angsana New'>$aTrade[$n]</td>\n".
               "  <td><font face='Angsana New'>$aUnit[$n]</td>\n".
               "  <td><font face='Angsana New'>$aSlipcode[$n]</td>\n".
               "  <td><font face='Angsana New'> $aAmount[$n] </td>\n".
               "  <td><font face='Angsana New'>$aMoney[$n]</td>\n".
//               "  <td><font face='Angsana New'>$aPart[$n]</td>\n".
//               "  <td><font face='Angsana New'>$aFreepri[$n]*$aAmount[$n]</td>\n".
               " </tr>\n");
               }
				}
   print"</table>";
   print " ราคารวม  $Netprice(total= $total) บาท(เบิกไม่ได้ $netpay บาท , เบิกได้ $netfree บาท)<br> ";
   print "ผู้จ่ายยา.....................................ผู้รับยา................................"; 

//รายการแพ้ยา
   $query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '$cHn' ";
   $result = mysql_query($query)
        or die("Query drugreact failed!");

   if(mysql_num_rows($result)){
		print"<table>";
		print"<tr>
		  <td width='80%'><br>ประวัติการแพ้ยา";
			while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
              print (" <tr>\n".
                "  <td BGCOLOR=F5DEB3><font face='cordia New'  size=3>$tradname...$advreact($asses)</td>\n".
                " </tr>\n");
  						    }
		  print"	</td>";
		print"</tr>";
		print"</table>";
		print"(1=ใช่แน่นอน,2=น่าจะใช่,3=อาจจะใช่,4=สงสัย)";
   }

 include("unconnect.inc");
 session_unregister("nRunno");
   ?>


 