<?php
session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);
//function baht///
function baht($nArabic){
    $cTarget = Ltrim($nArabic);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
   $cRtnum=substr($cTarget,$x+1,2);
   $nUnit=$x;
   $nNum=$nUnit;
   $cRead  = "**";

include("connect.inc");
 
 IF ($cLtnum <> "0"){
  $count=0;
  For ($i = 0;$i<=$nNum;$i++){
    $cNo   = Substr($cLtnum,$count,1);
     $count++;
//อ่านหลัก
    IF ($cNo <>0 and $cNo != "-"){
      If ($nUnit <> 1){  

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$nUnit' ";
          $result = mysql_query($query) or die("Query 1 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

        $cVarU = $row->fld4;  //อ่านหลัก
                }
      Else {
        $cVarU = "";
              }

//อ่านเลข
          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' ";
          $result = mysql_query($query) or die("Query 2 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

      $cVar1 = $row->fld2; //อ่านตัวเลข
///           
if ($nUnit =='2' && $cNo =='2'):
   $cVar1 = "ยี่";
elseif ($nUnit == '2' && $cNo=='1'):
         $cVar1 =  "";
elseif ($nUnit =='1' && $cNo =='1' && $nNum <> 1 ):
          $cVar1 = "เอ็ด";
else:
   echo "";
endif; 

      $cRead  = $cRead.$cVar1.$cVarU;
        }
      $nUnit--;
            }
$cRead = $cRead."บาท";
	}
////Stang////  
  IF ($cRtnum <> "00"){
    $nUnit = 2;
    $count=0;
    For ($i = 0;$i<=2;$i++){  
      $cNo = Substr($cRtnum,$count,1);
      $count++;
      If ($cNo != "0"){

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' ";
          $result = mysql_query($query) or die("Query failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

         $cVar1 = $row->fld2 ;
         /////
         If ($nUnit == '2' && $cNo == '2'){
            $cVar1 = "ยี่";
            }
         if ($nUnit == '2' && $cNo == '1'){
            $cVar1 = "" ;
             }   
         if ($nUnit == '1' && $cNo =='1'){
              $cVar1 = "เอ็ด";
            }            
         If (Substr($cRtnum,0,1) == '0' && $cNo == '1'){
            $cVar1 = "หนึ่ง";
            }
         ///////
         If ($nUnit != '1'){ 
           $cRead = $cRead.$cVar1."สิบ";
                 }
         Else{
           $cRead = $cRead.$cVar1;
                }
      }   
         $nUnit--;
             }
    $cRead = $cRead."สตางค์**"  ;
	}    
    else{
           $cRead = $cRead."ถ้วน**" ;
           }  
    include("connect.inc");

   return $cRead;
}
///end function baht


    $Netpri=array_sum($aPri);
    $Netpaid=array_sum($aPaid);
    $BFY       = array_sum($aBFY);
    $BFN       = array_sum($aBFN);
//ค่ารักษาพยาบาลทั้งหมด  เพื่อบันทึกใน ipmonrep table
//ยาที่ใช้ใน รพ.
    $Essd    =array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDLDDY =$Essd+$Nessdy; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
    $Nessdn=array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
//ยาที่นำไปใช้ต่อที่บ้าน
    $DEssd    =array_sum($aDEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $DNessdy=array_sum($aDNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDgy= $DEssd+$DNessdy; //ยาที่นำไปใช้ต่อที่บ้านและเบิกได้
    $DNessdn=array_sum($aDNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้

    $DSY     =array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  

    $DPY     =array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  
 
    $Blood     = array_sum($aBlood);
    $Labo         =array_sum($aLabo);
    $Xray         =array_sum($aXray);
    $Sinv        = array_sum($aSinv);
    $Tool        = array_sum($aTool);  //ค่าใช้เครื่องมือทางการแพทย์ เช่น respirator
    $Surg         =array_sum($aSurg);
    $Ncare       = array_sum($aNcare);
    $Dent          =array_sum($aDent);
    $Physi        =array_sum($aPhysi);
    $Stx            = array_sum($aStx);
    $Mc            = array_sum($aMc); //ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา

    $debt=$Netpri-$Netpaid-$paid;
/*
CREATE TABLE ipmonrep (
date,admit,dcdate,days,an,hn,ptname,ptright,price,paid,debt,
cash,idname,bfy,bfn,dpy,dpn,ddl,ddy,ddn,dsy,dsn,blood,
lab,xray,sinv,surg,ncare,denta,pt,stx,mc 

'$Thidate','$cAdmit','$cDcdate','$cDays','$cAn','$cHn','$cPtname','$cPtright',price,paid,debt,
cash,'$sOfficer','$BFY','$BFN','$DPY','$DPN','$Essd','$Nessdy','$Nessdn','$DSY','$DSN','$Blood',
'$Labo','$Xray','$Sinv','$Surg','$Ncare','$Dent','$Physi','$Stx','$Mc' 

Netpaid=รวมที่ทะยอยจ่ายทั้งหมด
cash =จ่ายครั้งนี้($paid)
debt= Netpri-Netpaid-$paid
*/
    include("connect.inc");
       $query = "INSERT INTO ipmonrep(date,admit,dcdate,days,an,hn,ptname,ptright,price,
                paid,debt,cash,idname,bfy,bfn,dpy,dpn,ddl,ddy,ddn,dsy,dsn,blood,
	lab,xray,sinv,surg,ncare,denta,pt,stx,mc)VALUES('$Thidate','$cAdmit',
	'$cDcdate','$cDays','$cAn','$cHn','$cPtname','$cPtright','$Netpri','$Netpaid','$debt',
	'$paid','$sOfficer','$BFY','$BFN','$DPY','$DPN','$Essd',
	'$Nessdy','$Nessdn','$DSY','$DSN','$Blood',
	'$Labo','$Xray','$Sinv','$Surg','$Ncare','$Dent','$Physi','$Stx','$Mc');";
 
       $result = mysql_query($query) or die("Query failed,insert into ipmonrep");
//       echo mysql_errno() . ": " . mysql_error(). "\n";
//       echo "<br>";

       $sql = "UPDATE ipcard SET price='$Netpri',
			    paid= $Netpaid+$paid,
	              	                    calc='$Thidate'
	   WHERE an='$cAn' ";
       $result = mysql_query($sql) or die("Query failed ipcard");
//       echo mysql_errno() . ": " . mysql_error(). "\n";
//       echo "<br>";

/* ถ้าเพิ่มส่วนนี้จะเป็น ipdibill.phpคือทะยอยเก็บ  แล้วเพิ่มหมายเลขบัญชี
       $cAccno++;
       $query ="UPDATE bed SET price='$Netpri',
                	paid='$Netpaid',
	                debt='$debt',
		caldate='$Thidate',
                                accno='$cAccno'
                       WHERE an='$cAn' ";
       $result = mysql_query($query) or die("Query failed bed");     
       echo mysql_errno() . ": " . mysql_error(). "\n";
       echo "<br>";
*/
   include("unconnect.inc");
//ค่ารักษาพยาบาล หักที่จ่ายแล้ว  เพื่อออกใบเสร็จส่วนที่ค้างจ่าย
    $BFY       = array_sum($aBBFY);
    $BFN       = array_sum($aBBFN);
//ยาที่ใช้ใน รพ.   รายการในใบเสร็จ หักเงินที่จ่ายแล้วออก
    $Essd    =array_sum($aBEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aBNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDLDDY =$Essd+$Nessdy; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
    $Nessdn=array_sum($aBNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
//ยาเวชภัณฑ์ที่นำไปใช้ต่อที่บ้าน
    $DEssd    =array_sum($aBDEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $DNessdy=array_sum($aBDNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDgy= $DEssd+$DNessdy; //ยาที่นำไปใช้ต่อที่บ้านและเบิกได้
    $DNessdn=array_sum($aBDNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
//
    $DSY     =array_sum($aBDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aBDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  

    $DPY     =array_sum($aBDPY);   //รวมเงินค่าซื้ออุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aBDPN);   //รวมเงินค่าซื้ออุปกรณ์ ส่วนที่เบิกไม่ได้  

    $Blood     = array_sum($aBBlood);
    $Labo         =array_sum($aBLabo);
    $Xray         =array_sum($aBXray);
    $Sinv        = array_sum($aBSinv);
    $Tool        = array_sum($aBTool);  //ค่าใช้เครื่องมือทางการแพทย์ เช่น respirator
    $Surg         =array_sum($aBSurg);
    $Ncare       = array_sum($aBNcare);
    $Dent          =array_sum($aBDent);
    $Physi        =array_sum($aBPhysi);
    $Stx            = array_sum($aBStx);
    $Mc            = array_sum($aBMc); //ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา

    $debt=$Netpri-$Netpaid-$paid;
/*
//พิมพ์ใบเสร็จรับเงิน
   print "สรุปค่ารักษาพยาบาล(ค้างจ่าย) ณ วันที่จำหน่าย $sDiscdate<br>";
   print "ผู้ป่วย $cPtname<br>";
   print "HN: $cHn  AN: $cAn<br>";
   print "สิทธิการรักษา :$cPtright<br>";
   print "ป่วยโรค  $cDiag<br>";
   print "มารับการรักษาใน รพ. วันที่ $cAdmit ถึง $cDcdate รวม $cDays วัน<br>";
//   print "<font face='Angsana New'>จำนวนทั้งสิ้น $item รายการ ดังนี้<br>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='5%'></td>";
print "      <td width='55%'><font face='Angsana New'>สรุปค่ารักษาพยาบาล:<br>";
print "รายการ<br>";
print "1. ค่าห้อง/ค่าอาหาร<br>";	
print "   .......ค่าห้อง/ค่าอาหาร(ส่วนเกิน)<br>";	
print "2. อวัยวะเทียม/อุปกรณ์ในการบำบัดรักษา<br>";	
print "3. ยาและสารอาหารทางเส้นเลือดที่ใช้ในโรงพยาบาล<br>";
print "4. ยาที่นำไปใช้ต่อที่บ้าน<br>	";
print "5. เวชภัณฑ์ที่ไม่ใช่ยา<br>";
print "6. ค่าบริการโลหิตและส่วนประกอบของโลหิต<br>";
print "7. ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา<br>";
print "8. ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา<br>";
print "9.  ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ<br>";
print "10. ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์<br>"; 
print "11. ค่าผ่าตัด  ทำคลอด  ทำหัตถการและบริการวิสัญญี<br>";	
print "12. ค่าบริการทางการพยาบาลทั่วไป<br>";
print "13. ค่าบริการทางทันตกรรม<br>";
print "14. ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู<br>";
print "15. ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ<br>";
print "16. ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา</font></td>";
print "      <td width='16%' valign='middle'><font face='Angsana New'>รายการ<br>";
print "        เบิกได้<br>";
print "        $BFY<br>";
print "        ...<br>";
print "        $DPY<br>";
print "        $DDLDDY<br>";
print "        $DDgy<br>";//4. ยาที่นำไปใช้ต่อที่บ้านเบิกได้
print "        $DSY<br>";
print "        $Blood<br>";
print "        $Labo<br>";
print "        $Xray<br>";
print "        $Sinv<br>"; // 9.ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ
print "        $Tool<br>"; //10.ค่าใช้เครื่องมือทางการแพทย์
print "        $Surg<br>";
print "        $Ncare<br>";
print "        $Dent<br>";
print "        $Physi<br>";
print "        $Stx<br>";
print "        ...</font></td>";
print "      <td width='24%'><font face='Angsana New'>รายการ<br>";
print "        เบิกไม่ได้<br>";
print "        ...<br>";
print "        $BFN<br>";
print "        $DPN<br>";
print "        $Nessdn<br>";
print "        $DNessdn<br>"; //4. ยาที่นำไปใช้ต่อที่บ้าน เบิกไม่ได้
print "        $DSN<br>";
print "       ...<br>";
print "        ....<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        $Mc</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "</table>";
*/
//$bedfood=$BFY+$BFN;
$invlab=$Blood+$Labo+$Xray+$Sinv;

$BEssd=$Essd+$DEssd;
$BNessdy=$Nessdy+$DNessdy;
$BNessdn=$Nessdn+$DNessdn;

$equip=$DPY+$Tool;  //TOOL-ค่าใช้เครื่องมือทางการแพทย์, DPY-ค่าซื้อตัวอุปกรณ์ทางการแพทย์
$medcare=$Surg+ $Ncare+$Dent+$Physi+$Stx;

$Ysubtotal=$BFY+$invlab+$BEssd+$BNessdy+$DSY+$equip+$medcare;
$Nsubtotal=$BFN+$BNessdn+$DSN+$DPN+$Mc;

$billsum=$BFY+$BFN+$invlab+$Essd+$Nessdy+$Nessdn+$DSY+ $DSN+$DEssd+$DNessdy+$DNessdn+$equip+$DPN+$medcare+$Mc;
$debt=$billsum-$paid;
$cbaht=baht($paid);
/*
echo "$billsum<br>";

print "สรุปพิมพ์ลงใบเสร็จ<br>";
print "1. ค่าห้องและค่าอาหารรวม $cDays วัน...เบิกได้.. $BFY ........เบิกไม่ได้... $BFN<br>";
print "2. ค่าตรวจ ค่าวิเคราะห์โรค.....................เบิกได้.. $invlab <br>";
print "3. ค่ายา(ในบัญชียาหลักแห่งชาติ)............เบิกได้.. $BEssd <br>";
print "4. ค่ายา(นอกบัญชียาหลักแห่งชาติ).........เบิกได้.. $BNessdy ...เบิกไม่ได้... $BNessdn<br>";
print "5. ค่าเวชภัณฑ์ที่ไม่ใช่ยา........................เบิกได้... $DSY.........เบิกไม่ได้...  $DSN <br>";
print "6. ค่าอุปกรณ์/เครื่องมือทางการแพทย์....เบิกได้... $equip .......เบิกไม่ได้... $DPN <br>";
print "7. ค่าบริการทางการแพทย์....................เบิกได้.. $medcare <br>";
print "8. ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา............................... เบิกไม่ได้... $Mc<br>";
print "รวมเงิน $billsum <br>";
//print " ".baht($billsum)."<br>";//ตัวหนังสือ

print "<br>รวมเงินทั้งสิ้น $billsum บาท<br>";
//print "ทะยอยจ่ายแล้ว $Netpaid บาท<br>";
//$debt=$Netpri-$Netpaid-$paid;

print "จ่ายครั้งนี้ $paid<br>";
print " ".baht($paid)."<br>";//ตัวหนังสือ
print "ค้างจ่าย $debt บาท<br>";
print "จนท. $sOfficer วันที่ $Thaidate<br>";
*/
//พิมพ์ใบเสร็จ
if ($paid==$billsum){
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='80%'></td>";
print "      <td width='20%'><font face='Angsana New'>$Thdate</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='32%'></td>";
print "      <td width='68%'><font face='Angsana New'>&#3648;&#3591;&#3636;&#3609;&#3588;&#3656;&#3634;&#3619;&#3633;&#3585;&#3625;&#3634;&#3614;&#3618;&#3634;&#3610;&#3634;&#3621;</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='91%'><font face='Angsana New'>$cPtname&nbsp;";
print "        &#3611;&#3656;&#3623;&#3618;&#3650;&#3619;&#3588; $cDiag</font></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='91%'><font face='Angsana New'>&#3619;&#3633;&#3610;&#3611;&#3656;&#3623;&#3618;";
print "        $cAdmit &#3606;&#3638;&#3591; $cDcdate &#3619;&#3623;&#3617; $cDays &#3623;&#3633;&#3609;</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='63%'>";
print "        <p><font face='Angsana New'>1. &#3588;&#3656;&#3634;&#3627;&#3657;&#3629;&#3591;&#3649;&#3621;&#3632;&#3588;&#3656;&#3634;&#3629;&#3634;&#3627;&#3634;&#3619;&#3619;&#3623;&#3617;&nbsp;</font></td>";
print "      <td width='17%' valign='bottom'><font face='Angsana New'>$BFY</font></td>";
print "      <td width='11%' valign='bottom'><font face='Angsana New'>$BFN</font></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>2. &#3588;&#3656;&#3634;&#3605;&#3619;&#3623;&#3592; &#3588;&#3656;&#3634;&#3623;&#3636;&#3648;&#3588;&#3619;&#3634;&#3632;&#3627;&#3660;&#3650;&#3619;&#3588;</font></td>";
print "      <td width='17%'><font face='Angsana New'>$invlab</font></td>";
print "      <td width='11%'></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>3. &#3588;&#3656;&#3634;&#3618;&#3634;(&#3651;&#3609;&#3610;&#3633;&#3597;&#3594;&#3637;&#3618;&#3634;&#3627;&#3621;&#3633;&#3585;&#3649;&#3627;&#3656;&#3591;&#3594;&#3634;&#3605;&#3636;)</font></td>";
print "      <td width='17%'><font face='Angsana New'>$BEssd</font></td>";
print "      <td width='11%'></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>4. &#3588;&#3656;&#3634;&#3618;&#3634;(&#3609;&#3629;&#3585;&#3610;&#3633;&#3597;&#3594;&#3637;&#3618;&#3634;&#3627;&#3621;&#3633;&#3585;&#3649;&#3627;&#3656;&#3591;&#3594;&#3634;&#3605;&#3636;)</font></td>";
print "      <td width='17%'><font face='Angsana New'>$BNessdy</font></td>";
print "      <td width='11%'><font face='Angsana New'>$BNessdn</font></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='56%'><font face='Angsana New'>5. &#3588;&#3656;&#3634;&#3648;&#3623;&#3594;&#3616;&#3633;&#3603;&#3601;&#3660;&#3607;&#3637;&#3656;&#3652;&#3617;&#3656;&#3651;&#3594;&#3656;&#3618;&#3634;</font></td>";
print "      <td width='17%'><font face='Angsana New'>$DSY</font></td>";
print "      <td width='11%'><font face='Angsana New'>$DSN</font></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>6. &#3588;&#3656;&#3634;&#3629;&#3640;&#3611;&#3585;&#3619;&#3603;&#3660;/&#3648;&#3588;&#3619;&#3639;&#3656;&#3629;&#3591;&#3617;&#3639;&#3629;&#3607;&#3634;&#3591;&#3585;&#3634;&#3619;&#3649;&#3614;&#3607;&#3618;&#3660;</font></td>";
print "      <td width='17%'><font face='Angsana New'>$equip</font></td>";
print "      <td width='11%'><font face='Angsana New'>$DPN</font></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>7. &#3588;&#3656;&#3634;&#3610;&#3619;&#3636;&#3585;&#3634;&#3619;&#3607;&#3634;&#3591;&#3585;&#3634;&#3619;&#3649;&#3614;&#3607;&#3618;&#3660;</font></td>";
print "      <td width='17%'><font face='Angsana New'>$medcare</font></td>";
print "      <td width='11%'></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>8. &#3588;&#3656;&#3634;&#3610;&#3619;&#3636;&#3585;&#3634;&#3619;&#3629;&#3639;&#3656;&#3609;&#3607;&#3637;&#3656;&#3652;&#3617;&#3656;&#3648;&#3585;&#3637;&#3656;&#3618;&#3623;&#3586;&#3657;&#3629;&#3591;&#3585;&#3633;&#3610;&#3585;&#3634;&#3619;&#3619;&#3633;&#3585;&#3625;&#3634;</font></td>";
print "      <td width='17%'></td>";
print "      <td width='11%'><font face='Angsana New'>$Mc</font></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='9%'></td>";
print "      <td width='63%'></td>";
print "      <td width='17%'><font face='Angsana New'>$Ysubtotal</font></td>";
print "      <td width='11%'><font face='Angsana New'>$Nsubtotal</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='15%'></td>";
print "      <td width='74%'><font face='Angsana New'>$cbaht</font></td>";
print "      <td width='11%'><font face='Angsana New'>$paid</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='71%'></td>";
print "      <td width='29%'>&nbsp;";
print "        <p><font face='Angsana New'>&#3648;&#3592;&#3657;&#3634;&#3627;&#3609;&#3657;&#3634;&#3607;&#3637;&#3656;&#3648;&#3585;&#3655;&#3610;&#3648;&#3591;&#3636;&#3609;</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
	}
else {
print "ราคารวม $billsum บาท<br>";
print "รับเงิน $paid บาท ไม่เท่ากับราคารวม";
        }
/////
    session_unregister("cAdmit");
    session_unregister("cDcdate");
    session_unregister("cDays");
    session_unregister("cAn");
    session_unregister("cHn");
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("cDiag");

    session_unregister("x");
    session_unregister("aIdname");
    session_unregister("aDep");
    session_unregister("aDtail");
    session_unregister("aPri");
    session_unregister("aPaid");
    session_unregister("aPart");
    session_unregister("aDay");
    session_unregister("aBFY");
    session_unregister("aBFN");
    session_unregister("aBBFY");
    session_unregister("aBBFN");
    session_unregister("aEssd");
    session_unregister("aNessdy");
    session_unregister("aNessdn");
    session_unregister("aDDL");
    session_unregister("aDDY");
    session_unregister("aDDN");
    session_unregister("aDPY");
    session_unregister("aDPN");
    session_unregister("aDSY");
    session_unregister("aDSN");
    session_unregister("aBlood");
    session_unregister("aLabo");
    session_unregister("aXray");
    session_unregister("aSinv");
    session_unregister("aTool");
    session_unregister("aSurg");    
    session_unregister("aNcare");    
    session_unregister("aDent");
    session_unregister("aPhysi");
    session_unregister("aStx");
    session_unregister("aMc");

//  session_unregister("sDiscdate");
    session_unregister("aDEssd");
    session_unregister("aDNessdy");
    session_unregister("aDNessdn");

    session_unregister("aBDEssd");
    session_unregister("aBDNessdy");
    session_unregister("aBDNessdn");

    session_unregister("aBEssd");
    session_unregister("aBNessdy");
    session_unregister("aBNessdn");
    session_unregister("aBDDL");
    session_unregister("aBDDY");
    session_unregister("aBDDN");
    session_unregister("aBDPY");
    session_unregister("aBDPN");
    session_unregister("aBDSY");
    session_unregister("aBDSN");
    session_unregister("aBBlood");
    session_unregister("aBLabo");
    session_unregister("aBXray");
    session_unregister("aBSinv");
    session_unregister("aBTool");
    session_unregister("aBSurg");    
    session_unregister("aBNcare");    
    session_unregister("aBDent");
    session_unregister("aBPhysi");
    session_unregister("aBStx");
    session_unregister("aBMc");
?>

