<?php
session_start();
if (isset($sIdname)){} else {die;} //for security
?>
<table>
 <tr>
  <th bgcolor=CD853F>ลบ</th>
  <th bgcolor=CD853F>#</th>
  <th bgcolor=CD853F>รหัส</th>
  <th bgcolor=CD853F>รายการ</th>
  <th bgcolor=CD853F>ราคา</th>
  <th bgcolor=CD853F>จำนวน</th>
  <th bgcolor=CD853F>รวมเงิน</th>
 </tr>
<?php
    include("connect.inc");

    $query = "SELECT * FROM labcare WHERE code = '$Dgcode' ";
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
    $aDgcode[$x]=$row->code; 
    $aTrade[$x]=$row->detail;
    $aPrice[$x]=$row->price;
    $aPart[$x]=$row->part;
    $aAmount[$x]=$Amount;
    $money = $Amount*$row->price ;
    $aMoney[$x]=$money;
    $Netprice=array_sum($aMoney);

   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><a target='right'  href=\"labdele.php? Delrow=$n\">ลบ</td>\n".
                "<td bgcolor=F5DEB3>$n</td>\n".
                "<td bgcolor=F5DEB3>$aDgcode[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aTrade[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aPrice[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aAmount[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aMoney[$n]</td>\n".
                " </tr>\n");
        }
 

   include("unconnect.inc");
?>
</table>
<?php
     echo " ราคารวม  $Netprice บาท ";
?>
    <br><a target='right' href="suittranx.php">หมดรายการ/บันทึกสูตร</a>


