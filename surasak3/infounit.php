<?php
session_start();
?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>ลบ</th>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>
  <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New'>ราคา</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New'>รวมเงิน</th>
 </tr>

<?php
    include("connect.inc");

    $query = "SELECT drugcode,tradname,unitpri,part FROM druglst WHERE drugcode = '$Dgcode' ";
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

  //  echo "<BR> นอก  array  $row->drugcode, $row->tradname, ราคาเม็ดละ  $row->salepri บาท, <br />\n";

    $x++;
    $aDgcode[$x]=$row->drugcode;
    $aTrade[$x]=$row->tradname;

    $aPrice[$x]=$row->unitpri;
    $aPart[$x]=$row->part;
    $aAmount[$x]=$Amount;
    $money = $Amount*$row->unitpri ;
    $aMoney[$x]=$money;
    $Netprice=array_sum($aMoney);

   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><a target='right'  href=\"itemdele.php? Delrow=$n\"><font face='Angsana New'>ลบ</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
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
?>
    <br><a target=_BLANK href="rxutranx.php">ตัดสต๊อก/ใบรายงาน</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="notrxu.php">(ยกเลิกทั้งหมด)</a>


