<?php
session_start();
if (isset($sIdname)){} else {die;} //for security
 
$num=0;
 $aFrm_code = array("labcode");
   if(!empty($cxr)){
     $num++;
             array_push($aFrm_code,$cxr); 
			}
   if(!empty($ivp)){
     $num++;
             array_push($aFrm_code,$ivp); 
			}
   if(!empty($skull)){
     $num++;
             array_push($aFrm_code,$skull); 
			}
   if(!empty($be)){
     $num++;
             array_push($aFrm_code,$be); 
			}
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
            for ($n=1; $n<=$num; $n++){
 	   $query = "SELECT * FROM labcare WHERE code = '$aFrm_code[$n]' ";
    	   $result = mysql_query($query) or die("Query failed");
                   for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	        }

	        if(!($row = mysql_fetch_object($result)))
	            continue;
	         }
	    $m++;
	    $aLabcode[$m]=$row->code; 
	    $aDetail[$m]=$row->detail;
	    $aEachprice[$m]=$row->price;
	    $aLabpart[$m]=$row->part;
	    $aTime[$m]=1;//***
	    $money = 1*$row->price ;
	    $aItemprice[$m]=$money;
	    $nLabprice=array_sum($aItemprice);

	    $aYprice[$m]=$row->yprice*$aTime[$m];
	    $aNprice[$m]=$row->nprice*$aTime[$m];
	    $aSumYprice=array_sum($aYprice);
	    $aSumNprice=array_sum($aNprice);
                     }
/////////
	   for ($n=1; $n<=$m; $n++){
	        print("<tr>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'><a target='top'  href=\"dlabdele.php? Delrow=$n\">ลบ</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aLabcode[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDetail[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aEachprice[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTime[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aItemprice[$n]</td>\n".
	                " </tr>\n");
	        }
   include("unconnect.inc");
?>
</table>
<?php
     echo " <font face='Angsana New'>ราคารวม  $nLabprice บาท ";
?>
    <br><a target=_BLANK href="dlabtranx.php">หมดรายการ/บันทึกส่งตรวจ</a>

