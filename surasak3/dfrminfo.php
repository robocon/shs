<?php
session_start();
if (isset($sIdname)){} else {die;} //for security
 
$num=0;
 $aFrm_code = array("labcode");
   if(!empty($cbc)){
     $num++;
             array_push($aFrm_code,$cbc); 
			}
   if(!empty($ua)){
     $num++;
             array_push($aFrm_code,$ua); 
			}
   if(!empty($st)){
     $num++;
             array_push($aFrm_code,$st); 
			}
   if(!empty($bs)){
     $num++;
             array_push($aFrm_code,$bs); 
			}
   if(!empty($bun)){
     $num++;
             array_push($aFrm_code,$bun); 
			}
   if(!empty($cr)){
     $num++;
             array_push($aFrm_code,$cr); 
			}
   if(!empty($lft)){
     $num++;
             array_push($aFrm_code,$lft); 
			}

   if(!empty($chol)){
     $num++;
             array_push($aFrm_code,$chol); 
			}
   if(!empty($tri)){
     $num++;
             array_push($aFrm_code,$tri); 
			}
   if(!empty($uric)){
     $num++;
             array_push($aFrm_code,$uric); 
			}
//// FT4,T3
   if(!empty($ft4)){
     $num++;
             array_push($aFrm_code,$ft4); 
			}
   if(!empty($ft3)){
     $num++;
             array_push($aFrm_code,$ft3); 
			}
   if(!empty($tsh)){
     $num++;
             array_push($aFrm_code,$tsh); 
			}
   if(!empty($hbsag)){
     $num++;
             array_push($aFrm_code,$hbsag); 
			}
   if(!empty($hbsab)){
     $num++;
             array_push($aFrm_code,$hbsab); 
			}
   if(!empty($hbcab)){
     $num++;
             array_push($aFrm_code,$hbcab); 
			}
   if(!empty($hiv)){
     $num++;
             array_push($aFrm_code,$hiv); 
			}
   if(!empty($hiva)){
     $num++;
             array_push($aFrm_code,$hiva); 
			}
   if(!empty($rf)){
     $num++;
             array_push($aFrm_code,$rf); 
			}
   if(!empty($wlt)){
     $num++;
             array_push($aFrm_code,$wlt); 
			}
   if(!empty($vdrl)){
     $num++;
             array_push($aFrm_code,$vdrl); 
			}
   if(!empty($e)){
     $num++;
             array_push($aFrm_code,$e); 
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

