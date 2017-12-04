<?php
session_start();
?>
<table>
 <tr> 
  <th bgcolor=CD853F><font face='Angsana New'>ลบ</th>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>
  <th bgcolor=CD853F><font face='Angsana New'>ชื่อการค้า</th>
  <th bgcolor=CD853F><font face='Angsana New'>วิธีใช้</th>
  <th bgcolor=CD853F><font face='Angsana New'>ราคา</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New'>รวมเงิน</th>
 </tr>

<?php
    include("connect.inc");

    $query = "SELECT * FROM druglst WHERE drugcode = '$Dgcode' ";
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

    $x++;

    $aDgcode[$x]=$row->drugcode;
    $aTrade[$x]=$row->tradname;
    $aSlipcode[$x]=$Slcode;        
    $aPrice[$x]=$row->salepri;
    $aFreepri[$x]=$row->freepri;
    $aUnit[$x]=$row->unit;
    $aPart[$x]=$row->part;
    $aAmount[$x]=$Amount;
    $money = $aAmount[$x]*$row->salepri ;
    $aMoney[$x]=$money;
    $Netprice=array_sum($aMoney);

//  รวมเงินค่ายาอุปกรณ์ ส่วนที่เบิกได้และไม่ได้
    $notfree=$row->salepri - $row->freepri;
    $Free=$Amount*$row->freepri;   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $Pay =$Amount*$notfree;   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้, ต้องจ่าย

//  รวมเงินค่าเวชภัณฑ์ที่ไม่ใช่ยา ส่วนที่เบิกได้และไม่ได้
    $Snotfree=$row->salepri - $row->freepri;
    $SFree=$Amount*$row->freepri;   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $SPay =$Amount*$Snotfree;   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้, ต้องจ่าย

if (substr($row->part,0,3)=="DDL"){
            $aEssd[$x]=$money;
            }
else {
            $aEssd[$x]=0;
        }
//
if (substr($row->part,0,3)=="DDY"){
            $aNessdy[$x]=$money;
            }
else {
            $aNessdy[$x]=0;
         }
//
if (substr($row->part,0,3)=="DDN"){
            $aNessdn[$x]=$money;
            }
else {
             $aNessdn[$x]=0;
         }
//อุปกรณ์
if (substr($row->part,0,3)=="DPY"){
            $aDPY[$x]=$Free;  //อุปกรณ์ ส่วนที่เบิกได้ $row->free
            $aDPN[$x]=$Pay;  // อุปกรณ์ ส่วนที่เบิกไม่ได้ $row->salepri - $row->free
            }
else {
            $aDPY[$x]=0;
            $aDPN[$x]=0;
        }
if (substr($row->part,0,3)=="DPN"){
            $aDPN[$x]=$money;  //อุปกรณ์เบิกไม่ได้
            } 

//เวชภัณฑ์ไม่ใช่ยา
if (substr($row->part,0,3)=="DSY"){
            $aDSY[$x]=$SFree;  //เวชภัณฑ์ไม่ใช่ยา ส่วนที่เบิกได้ $row->free
            $aDSN[$x]=$SPay;  // เวชภัณฑ์ไม่ใช่ยา ส่วนที่เบิกไม่ได้ $row->salepri - $row->free
            }
else {
            $aDSY[$x]=0; 
            $aDSN[$x]=0;
        }
if (substr($row->part,0,3)=="DSN"){
            $aDSN[$x]=$money;  //เวชภัณฑ์ไม่ใช่ยา เบิกไม่ได้
            }   

//
   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><a target='right'  href=\"ipddel.php? Delrow=$n\"><font face='Angsana New'>ลบ</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aSlipcode[$n]</td>\n".    
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aMoney[$n]</td>\n".  
                " </tr>\n");
        }
 include("unconnect.inc");
?>
</table>
<?php
     echo " ราคารวม  $Netprice บาท ";
     $sDcode="";
     $sSlip="";
?>
    <br><a target=_BLANK href="slipprn.php">ดูสลากยา</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="ipdgtranx.php">หมดรายการ/บันทึก</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="notrxop.php">(ยกเลิก)</a>


