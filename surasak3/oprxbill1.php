<?php
session_start();
if (isset($sIdname)){} else {die;} //for security

if (empty($sAn) && $xpaid<>$sNetprice+20){
           die("จ่ายเงินไม่เท่ากับราคารวม ออกใบเสร็จรับเงินไม่ได้");
                                    }
if (!empty($sAn) && $xpaid<>$sNetprice){
           die("จ่ายเงินไม่เท่ากับราคารวม ออกใบเสร็จรับเงินไม่ได้");
                                    }

$Thdate=date("d-m-").(date("Y")+543);
$Thidate = (date("Y")+543).date("-m-d G:i:s"); 
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("G:i:s");
$sDepart='PHAR';
$sDetail='ค่ายา';
$paid=$sNetprice;
//function baht 15_4_04///
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
///end function baht 15_4_04

include("connect.inc");
//insert into phardep table
        $query ="UPDATE phardep SET paid = $paid
                                                         
                       WHERE row_id= '$sRow_id' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
// in case of inpatient update data into ipacc
//เข้าบัญชีผู้ป่วยในกรณีจ่ายเงินทั้งหมด
IF (!empty($sAn) && $xpaid==$sNetprice) {
    $query = "SELECT row_id,price FROM ipacc WHERE  date= '$dDate' and accno ='$sAccno' ";
    $result = mysql_query($query) or die("Query failed");

    while (list ($row_id,$price) = mysql_fetch_row ($result)) {
        $x++;
        array_push($sRow,$row_id);
        array_push($aPrice,$price);
        }

         for ($n=1; $n<=$x; $n++){
//             echo " $n $aPrice[$n]<br>";
               $query ="UPDATE ipacc SET paid = $aPrice[$n]
			           	
                       WHERE row_id='$sRow[$n]' ";
              $result = mysql_query($query) or die("Query failed,update ipacc");
              };
	            }
//เข้าบัญชีผู้ป่วยในกรณีจ่ายเงินไม่ทั้งหมด
IF (!empty($sAn) && $xpaid <> $sNetprice) {
                   $query = "INSERT INTO ipacc(date,an,depart,detail,paid,
                                    idname,accno)VALUES('$dDate','$sAn','$sDepart','$sDetail',
                                    '$paid','$sOfficer','$sAccno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
				}

if (empty($sAn)){
       //เข้าบัญชีผู้ป่วยนอก'ค่าบริการทางการแพทย์'
       $sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname,
             essd,nessdy,nessdn,dpy,dpn,dsy,dsn) VALUES('$Thidate','$dDate',
             '$sHn','$sAn','OTHER','ค่าบริการทางการแพทย์','20','20',
            '$sOfficer','','','','','','','');";
       $result = mysql_query($sql);
                        }
//เข้าบัญชีผู้ป่วยนอก
$sql = "INSERT INTO opacc (date,txdate,hn,an,depart,detail,price,paid,idname,
             essd,nessdy,nessdn,dpy,dpn,dsy,dsn) VALUES('$Thidate','$dDate',
             '$sHn','$sAn','$sDepart','$sDetail','$sNetprice','$paid',
            '$sOfficer','$sEssd','$sNessdy','$sNessdn','$sDPY','$sDPN','$sDSY','$sDSN');";
       
$result = mysql_query($sql);
If (!$result){
echo "query fail";
      }
else { 
   $sDSYN=$sDSY+$sDSN;  //เวชภัณฑ์ที่ไม่ใช่ยา เบิก OPD CASE  ไม่ได้
   $netpay=$sNessdn+$sDPN+$sDSY+$sDSN; //เบิกไม่ได้
   $netfree=$sEssd+$sNessdy+$sDPY+20; //เบิกได้
   $total=$sEssd+$sNessdy+$sDSY+$sDPY+$sNessdn+$sDSN+$sDPN+20; //รวมทั้งสิ้น
   if (!empty($sAn)){
       $netfree=$netfree-20;
       $total    =$total-20;
	              }	
   $netfree=number_format($netfree,2);
   $netpay=number_format($netpay,2);
   $total=number_format($total,2);
/*
/*
   echo "HN: $sHn<br>";
   echo "$Thaidate<br>";
//   echo "AN: $sAn <br>";
   echo "เงินสด<br>";
   echo "$sPtname  ป่วยเป็นโรค$sDiag<br>";

echo "ยาในบัญชียาหลักแห่งชาติ(Essd)................... $sEssd<br>";
echo "ยานอกบัญชียาหลักแห่งชาติ เบิกได้ (Nessdy).. $sNessdy....เบิกไม่ได้ (Nessdn):$sNessdn<br>";
echo "ค่าเวชภัณฑ์ที่ไม่ใช่ยา ..........................................................เบิกไม่ได้(DSY+DSN):$sDSYN<br>";
echo "ค่าอุปกรณ์ทางการแพทย์ เบิกได้ (DPY)............$sDPY..........เบิกไม่ได้(DPN):$sDPN<br>";

echo "รวมเบิกได้..........$netfree.......รวมเบิกไม่ได้:$netpay<br>";
echo "รวมทั้งสิ้น...........$total<br>";
echo "จ่าย...... $paid บาท";

echo " ".baht($paid)."<br>";//ตัวหนังสือ
echo "<br><br><br>เจ้าหน้าที่<br>";
*/

$cbaht=baht($xpaid);
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='70%'></td>";
print "      <td width='30%'><font face='Angsana New'>$Thdate</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='20%'></td>";
print "      <td width='80%'><font face='Angsana New'>เงินสด</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='100%'><font face='Angsana New'>$sPtname&nbsp;&nbsp; ป่วยเป็นโรค: $sDiag</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<br><br><br><br>";

//รายการ
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>ยาในบัญชียาหลักแห่งชาติ</td>";
print "      <td width='17%'><font face='Angsana New'>$sEssd</td>";
print "      <td width='11%'></td>";
print "    </tr>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>ยานอกบัญชียาหลักแห่งชาติ</td>";
print "      <td width='21%'><font face='Angsana New'>$sNessdy</td>";
print "      <td width='16%'><font face='Angsana New'>$sNessdn</td>";
print "    </tr>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>ค่าเวชภัณฑ์ที่ไม่ใช่ยา</td>";
print "      <td width='17%'></td>";
print "      <td width='11%'><font face='Angsana New'>$sDSYN</td>";
print "    </tr>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='63%'><font face='Angsana New'>ค่าอุปกรณ์ทางการแพทย์</td>";
print "      <td width='17%'><font face='Angsana New'>$sDPY</td>";
print "      <td width='11%'><font face='Angsana New'>$sDPN</td>";
print "    </tr>";
          if (empty($sAn)){
	print "    <tr>";
	//print "      <td width='9%'></td>";
	print "      <td width='63%'><font face='Angsana New'>ค่าบริการทางการแพทย์</td>";
	print "      <td width='17%'><font face='Angsana New'>20.00</td>";
	print "      <td width='11%'><font face='Angsana New'></td>";
	print "    </tr>";
		}
print "  </table>";
print "</div>";

print "<br><br>";
/*
if ($xpaid<>$sNetprice+20){
	print "จ่ายเงินไม่เท่ากับราคารวม*************************<br>";
                                    }
*/
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
//print "      <td width='9%'></td>";
print "      <td width='60%'><font face='Angsana New'>รวมเงิน</font></td>";
print "      <td width='23%'><font face='Angsana New'>$netfree</td>";
print "      <td width='17%'><font face='Angsana New'>$netpay</td>";
print "    </tr>";
print "  </table>";
print "</div>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='10%'></td>";
print "      <td width='75%'><font face='Angsana New'>$cbaht</td>";
print "      <td width='25%'><font face='Angsana New'>$total</td>";
print "    </tr>";
print "  </table>";
print "</div>";

print "<br>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='60%'></td>";
print "      <td width='40%'><font face='Angsana New'>เจ้าหน้าที่เก็บเงิน</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
        }
include("unconnect.inc");
//session_destroy();
///oprxitem.php
    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
    session_unregister("sPtname");
    session_unregister("sDoctor");
    session_unregister("sEssd");
    session_unregister("sNessdy");
    session_unregister("sNessdn");
    session_unregister("sDPY");
    session_unregister("sDPN");
	session_unregister("sDSY");
    session_unregister("sDSN");
    session_unregister("sNetprice");
    session_unregister("sDiag"); 
    session_unregister("sAccno"); 
    session_unregister("sRow_id"); 
    session_unregister("sRow"); 
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aSlipcode");
    session_unregister("aMoney");
?>
