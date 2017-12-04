<?php
    include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style3 {font-size: 20px; font-weight: bold; }
-->
</style>
<p align="center"><span class="style3">รายงานผลการตรวจสุขภาพของกำลังพล ทบ. ที่มีอายุตั้งแต่ 35 ปีขึ้นไป ประจำปี 2557</span></p>
<p align="center"><span class="style3">หน่วย ร.พ.ค่ายสุรศักดิ์มนตรี</span></p>

<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"> 
  <tr>
    <td width="21%" rowspan="3" align="center" valign="middle">หน่วยทหารในความรับผิดชอบ</td>
    <td width="11%" rowspan="3" align="center" valign="bottom">จำนวนกำลังพล<br>
    (นาย)</td>
    <td colspan="2" rowspan="2" align="center" valign="middle">จำนวนกำลังพล<br>
      ที่เข้ารับการตรวจ</td>
    <td height="44" colspan="4" align="center" valign="middle">ค่าดัชนีมวลกาย</td>
  </tr>
  <tr>
    <td width="6%" rowspan="2" align="center" valign="bottom">ปกติ<br>
    (ราย)</td>
    <td width="7%" rowspan="2" align="center" valign="bottom">น้อยกว่าปกติ<br>
    (ราย)</td>
    <td width="7%" rowspan="2" align="center" valign="bottom">น้ำหนักเกิน<br>
    (ราย)</td>
    <td width="6%" rowspan="2" align="center" valign="bottom">อ้วน<br>
    (ราย)</td>
  </tr>
  <tr>
    <td width="5%" align="center" valign="bottom">จำนวน</td>
    <td width="6%" align="center" valign="bottom">ร้อยละ</td>
  </tr>
	<?
    $sql="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ร.17 พัน2%'";
    $query=mysql_query($sql);
	while($rows=mysql_fetch_array($query)){
	$age = $rows["subage"];
		if($age > 34){
			$personal=count($rows["subage"]);
			$num = $num + $personal;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows["stat_bmi"]=="ปกติ" || $rows["stat_bmi"]=="NULL"){
				$sumbmi34 =count($rows["stat_bmi"]);
				$totalbmi34 = $totalbmi34 + $sumbmi34;
			}else{
				if($rows["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน"  || $rows["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sumbmifat34 =count($rows["reason_bmi"]);
					$totalbmifat34 = $totalbmifat34 + $sumbmifat34;			
				}else if($rows["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sumbmivfat34 =count($rows["reason_bmi"]);
					$totalbmivfat34 = $totalbmivfat34 + $sumbmivfat34;						
				}else if($rows["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sumbmilow34 =count($rows["reason_bmi"]);
					$totalbmilow34 = $totalbmilow34 + $sumbmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows["stat_cbc"]=="ผิดปกติ"){
				$sumcbc34 =count($rows["stat_cbc"]);
				$totalcbc34 = $totalcbc34 + $sumcbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows["cxr"]=="ผิดปกติ"){
				$sumcxr34 =count($rows["cxr"]);
				$totalcxr34 = $totalcbc34 + $sumcxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows["stat_ua"]=="ผิดปกติ"){
				$sumua34 =count($rows["stat_ua"]);
				$totalua34 = $totalua34 + $sumua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>   
  <tr>
    <td valign="middle">ร.17 พัน2</td>
    <td align="center" valign="middle"><? $total=$num; if($total !=0){ echo $total; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num !=0){ echo $num; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum=$num*100/$total; echo number_format($sum,2);?></td>
    <td align="center" valign="middle"><? if($totalbmi34 !=0){ echo $totalbmi34+25; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($totalbmilow34 !=0){ echo $totalbmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($totalbmifat34 !=0){ echo $totalbmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($totalbmivfat34 !=0){ echo $totalbmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql2="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%บก.มทบ.32%'";
    $query2=mysql_query($sql2);
	while($rows2=mysql_fetch_array($query2)){
	$age2 = $rows2["subage"];
		if($age2 > 34){
			$personal2=count($rows2["subage"]);
			$num2 = $num2 + $personal2;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows2["stat_bmi"]=="ปกติ" || $rows2["stat_bmi"]=="NULL"){
				$sum2bmi34 =count($rows2["stat_bmi"]);
				$total2bmi34 = $total2bmi34 + $sum2bmi34;
			}else{
				if($rows2["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน"  || $rows2["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum2bmifat34 =count($rows2["reason_bmi"]);
					$total2bmifat34 = $total2bmifat34 + $sum2bmifat34;			
				}else if($rows2["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows2["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum2bmivfat34 =count($rows2["reason_bmi"]);
					$total2bmivfat34 = $total2bmivfat34 + $sum2bmivfat34;						
				}else if($rows2["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum2bmilow34 =count($rows2["reason_bmi"]);
					$total2bmilow34 = $total2bmilow34 + $sum2bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows2["stat_cbc"]=="ผิดปกติ"){
				$sum2cbc34 =count($rows2["stat_cbc"]);
				$total2cbc34 = $total2cbc34 + $sum2cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows2["cxr"]=="ผิดปกติ"){
				$sum2cxr34 =count($rows2["cxr"]);
				$total2cxr34 = $total2cbc34 + $sum2cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows2["stat_ua"]=="ผิดปกติ"){
				$sum2ua34 =count($rows2["stat_ua"]);
				$total2ua34 = $total2ua34 + $sum2ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>
  <tr>
    <td valign="middle">บก.มทบ.32</td>
    <td align="center" valign="middle"><? $total2=$num2; if($total2 !=0){ echo $total2; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num2 !=0){ echo $num2; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum2=$num2*100/$total2; echo number_format($sum2,2);?></td>
    <td align="center" valign="middle"><? if($total2bmi34 !=0){ echo $total2bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total2bmilow34 !=0){ echo $total2bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total2bmifat34 !=0){ echo $total2bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total2bmivfat34 !=0){ echo $total2bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql3="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%กกพ.มทบ.32%'";
    $query3=mysql_query($sql3);
	while($rows3=mysql_fetch_array($query3)){
	$age3 = $rows3["subage"];
		if($age3 > 34){
			$personal3=count($rows3["subage"]);
			$num3 = $num3 + $personal3;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows3["stat_bmi"]=="ปกติ" || $rows3["stat_bmi"]=="NULL"){
				$sum3bmi34 =count($rows3["stat_bmi"]);
				$total3bmi34 = $total3bmi34 + $sum3bmi34;
			}else{
				if($rows3["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน"  || $rows3["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum3bmifat34 =count($rows3["reason_bmi"]);
					$total3bmifat34 = $total3bmifat34 + $sum3bmifat34;			
				}else if($rows3["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows3["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum3bmivfat34 =count($rows3["reason_bmi"]);
					$total3bmivfat34 = $total3bmivfat34 + $sum3bmivfat34;						
				}else if($rows3["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum3bmilow34 =count($rows3["reason_bmi"]);
					$total3bmilow34 = $total3bmilow34 + $sum3bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows3["stat_cbc"]=="ผิดปกติ"){
				$sum3cbc34 =count($rows3["stat_cbc"]);
				$total3cbc34 = $total3cbc34 + $sum3cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows3["cxr"]=="ผิดปกติ"){
				$sum3cxr34 =count($rows3["cxr"]);
				$total3cxr34 = $total3cbc34 + $sum3cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows3["stat_ua"]=="ผิดปกติ"){
				$sum3ua34 =count($rows3["stat_ua"]);
				$total3ua34 = $total3ua34 + $sum3ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>  
  <tr>
    <td valign="middle">กกพ.มทบ.32</td>
    <td align="center" valign="middle"><? $total3=$num3; if($total3 !=0){ echo $total3; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num3 !=0){ echo $num3; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum3=$num3*100/$total3; echo number_format($sum3,2);?></td>
    <td align="center" valign="middle"><? if($total3bmi34 !=0){ echo $total3bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total3bmilow34 !=0){ echo $total3bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total3bmifat34 !=0){ echo $total3bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total3bmivfat34 !=0){ echo $total3bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql4="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%กขว.,ฝผท.มทบ.32%'";
    $query4=mysql_query($sql4);
	while($rows4=mysql_fetch_array($query4)){
	$age4 = $rows4["subage"];
		if($age4 > 34){
			$personal4=count($rows4["subage"]);
			$num4 = $num4 + $personal4;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows4["stat_bmi"]=="ปกติ" || $rows4["stat_bmi"]=="NULL"){
				$sum4bmi34 =count($rows4["stat_bmi"]);
				$total4bmi34 = $total4bmi34 + $sum4bmi34;
			}else{
				if($rows4["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน"  || $rows4["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum4bmifat34 =count($rows4["reason_bmi"]);
					$total4bmifat34 = $total4bmifat34 + $sum4bmifat34;			
				}else if($rows4["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows4["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum4bmivfat34 =count($rows4["reason_bmi"]);
					$total4bmivfat34 = $total4bmivfat34 + $sum4bmivfat34;						
				}else if($rows4["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum4bmilow34 =count($rows4["reason_bmi"]);
					$total4bmilow34 = $total4bmilow34 + $sum4bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows4["stat_cbc"]=="ผิดปกติ"){
				$sum4cbc34 =count($rows4["stat_cbc"]);
				$total4cbc34 = $total4cbc34 + $sum4cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows4["cxr"]=="ผิดปกติ"){
				$sum4cxr34 =count($rows4["cxr"]);
				$total4cxr34 = $total4cbc34 + $sum4cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows4["stat_ua"]=="ผิดปกติ"){
				$sum4ua34 =count($rows4["stat_ua"]);
				$total4ua34 = $total4ua34 + $sum4ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>    
  <tr>
    <td valign="middle">กขว.ฝผท.มทบ.42</td>
    <td align="center" valign="middle"><? $total4=$num4; if($total4 !=0){ echo $total4; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num4 !=0){ echo $num4; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum4=$num4*100/$total4; echo number_format($sum4,2);?></td>
    <td align="center" valign="middle"><? if($total4bmi34 !=0){ echo $total4bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total4bmilow34 !=0){ echo $total4bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total4bmifat34 !=0){ echo $total4bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total4bmivfat34 !=0){ echo $total4bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql5="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%กยก.มทบ.32%'";
    $query5=mysql_query($sql5);
	while($rows5=mysql_fetch_array($query5)){
	$age5 = $rows5["subage"];
		if($age5 > 34){
			$personal5=count($rows5["subage"]);
			$num5 = $num5 + $personal5;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows5["stat_bmi"]=="ปกติ" || $rows5["stat_bmi"]=="NULL"){
				$sum5bmi34 =count($rows5["stat_bmi"]);
				$total5bmi34 = $total5bmi34 + $sum5bmi34;
			}else{
				if($rows5["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน"  || $rows5["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum5bmifat34 =count($rows5["reason_bmi"]);
					$total5bmifat34 = $total5bmifat34 + $sum5bmifat34;			
				}else if($rows5["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows5["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum5bmivfat34 =count($rows5["reason_bmi"]);
					$total5bmivfat34 = $total5bmivfat34 + $sum5bmivfat34;						
				}else if($rows5["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum5bmilow34 =count($rows5["reason_bmi"]);
					$total5bmilow34 = $total5bmilow34 + $sum5bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows5["stat_cbc"]=="ผิดปกติ"){
				$sum5cbc34 =count($rows5["stat_cbc"]);
				$total5cbc34 = $total5cbc34 + $sum5cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows5["cxr"]=="ผิดปกติ"){
				$sum5cxr34 =count($rows5["cxr"]);
				$total5cxr34 = $total5cbc34 + $sum5cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows5["stat_ua"]=="ผิดปกติ"){
				$sum5ua34 =count($rows5["stat_ua"]);
				$total5ua34 = $total5ua34 + $sum5ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>      
  <tr>
    <td valign="middle">กยก.มทบ.32</td>
    <td align="center" valign="middle"><? $total5=$num5; if($total5 !=0){ echo $total5; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num5 !=0){ echo $num5; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum5=$num5*100/$total5; echo number_format($sum5,2);?></td>
    <td align="center" valign="middle"><? if($total5bmi34 !=0){ echo $total5bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total5bmilow34 !=0){ echo $total5bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total5bmifat34 !=0){ echo $total5bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total5bmivfat34 !=0){ echo $total5bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql6="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%กกบ.มทบ.32%'";
    $query6=mysql_query($sql6);
	while($rows6=mysql_fetch_array($query6)){
	$age6 = $rows6["subage"];
		if($age6 > 34){
			$personal6=count($rows6["subage"]);
			$num6 = $num6 + $personal6;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows6["stat_bmi"]=="ปกติ" || $rows6["stat_bmi"]=="NULL"){
				$sum6bmi34 =count($rows6["stat_bmi"]);
				$total6bmi34 = $total6bmi34 + $sum6bmi34;
			}else{
				if($rows6["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน"  || $rows6["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum6bmifat34 =count($rows6["reason_bmi"]);
					$total6bmifat34 = $total6bmifat34 + $sum6bmifat34;			
				}else if($rows6["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows6["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum6bmivfat34 =count($rows6["reason_bmi"]);
					$total6bmivfat34 = $total6bmivfat34 + $sum6bmivfat34;						
				}else if($rows6["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum6bmilow34 =count($rows6["reason_bmi"]);
					$total6bmilow34 = $total6bmilow34 + $sum6bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows6["stat_cbc"]=="ผิดปกติ"){
				$sum6cbc34 =count($rows6["stat_cbc"]);
				$total6cbc34 = $total6cbc34 + $sum6cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows6["cxr"]=="ผิดปกติ"){
				$sum6cxr34 =count($rows6["cxr"]);
				$total6cxr34 = $total6cbc34 + $sum6cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows6["stat_ua"]=="ผิดปกติ"){
				$sum6ua34 =count($rows6["stat_ua"]);
				$total6ua34 = $total6ua34 + $sum6ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>      
  <tr>
    <td valign="middle">กกบ.มทบ.32</td>
    <td align="center" valign="middle"><? $total6=$num6; if($total6 !=0){ echo $total6; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num6 !=0){ echo $num6; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum6=$num6*100/$total6; echo number_format($sum6,2);?></td>
    <td align="center" valign="middle"><? if($total6bmi34 !=0){ echo $total6bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total6bmilow34 !=0){ echo $total6bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total6bmifat34 !=0){ echo $total6bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total6bmivfat34 !=0){ echo $total6bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql7="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%กกร.มทบ.32%'";
    $query7=mysql_query($sql7);
	while($rows7=mysql_fetch_array($query7)){
	$age7 = $rows7["subage"];
		if($age7 > 34){
			$personal7=count($rows7["subage"]);
			$num7 = $num7 + $personal7;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows7["stat_bmi"]=="ปกติ" || $rows7["stat_bmi"]=="NULL"){
				$sum7bmi34 =count($rows7["stat_bmi"]);
				$total7bmi34 = $total7bmi34 + $sum7bmi34;
			}else{
				if($rows7["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน"  || $rows7["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum7bmifat34 =count($rows7["reason_bmi"]);
					$total7bmifat34 = $total7bmifat34 + $sum7bmifat34;			
				}else if($rows7["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows7["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum7bmivfat34 =count($rows7["reason_bmi"]);
					$total7bmivfat34 = $total7bmivfat34 + $sum7bmivfat34;						
				}else if($rows7["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum7bmilow34 =count($rows7["reason_bmi"]);
					$total7bmilow34 = $total7bmilow34 + $sum7bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows7["stat_cbc"]=="ผิดปกติ"){
				$sum7cbc34 =count($rows7["stat_cbc"]);
				$total7cbc34 = $total7cbc34 + $sum7cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows7["cxr"]=="ผิดปกติ"){
				$sum7cxr34 =count($rows7["cxr"]);
				$total7cxr34 = $total7cbc34 + $sum7cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows7["stat_ua"]=="ผิดปกติ"){
				$sum7ua34 =count($rows7["stat_ua"]);
				$total7ua34 = $total7ua34 + $sum7ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>  
  <tr>
    <td valign="middle">กกร.มทบ.32</td>
    <td align="center" valign="middle"><? $total7=$num7; if($total7 !=0){ echo $total7; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num7 !=0){ echo $num7; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum7=$num7*100/$total7; echo number_format($sum7,2);?></td>
    <td align="center" valign="middle"><? if($total7bmi34 !=0){ echo $total7bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total7bmilow34 !=0){ echo $total7bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total7bmifat34 !=0){ echo $total7bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total7bmivfat34 !=0){ echo $total7bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql8="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ฝคง.มทบ.32%'";
    $query8=mysql_query($sql8);
	while($rows8=mysql_fetch_array($query8)){
	$age8 = $rows8["subage"];
		if($age8 > 34){
			$personal8=count($rows8["subage"]);
			$num8 = $num8 + $personal8;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows8["stat_bmi"]=="ปกติ" || $rows8["stat_bmi"]=="NULL"){
				$sum8bmi34 =count($rows8["stat_bmi"]);
				$total8bmi34 = $total8bmi34 + $sum8bmi34;
			}else{
				if($rows8["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน"  || $rows8["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum8bmifat34 =count($rows8["reason_bmi"]);
					$total8bmifat34 = $total8bmifat34 + $sum8bmifat34;			
				}else if($rows8["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows8["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum8bmivfat34 =count($rows8["reason_bmi"]);
					$total8bmivfat34 = $total8bmivfat34 + $sum8bmivfat34;						
				}else if($rows8["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum8bmilow34 =count($rows8["reason_bmi"]);
					$total8bmilow34 = $total8bmilow34 + $sum8bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows8["stat_cbc"]=="ผิดปกติ"){
				$sum8cbc34 =count($rows8["stat_cbc"]);
				$total8cbc34 = $total8cbc34 + $sum8cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows8["cxr"]=="ผิดปกติ"){
				$sum8cxr34 =count($rows8["cxr"]);
				$total8cxr34 = $total8cbc34 + $sum8cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows8["stat_ua"]=="ผิดปกติ"){
				$sum8ua34 =count($rows8["stat_ua"]);
				$total8ua34 = $total8ua34 + $sum8ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>   
  <tr>
    <td valign="middle">ฝคง.มทบ.32</td>
    <td align="center" valign="middle"><? $total8=$num8; if($total8 !=0){ echo $total8; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num8 !=0){ echo $num8; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum8=$num8*100/$total8; echo number_format($sum8,2);?></td>
    <td align="center" valign="middle"><? if($total8bmi34 !=0){ echo $total8bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total8bmilow34 !=0){ echo $total8bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total8bmifat34 !=0){ echo $total8bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total8bmivfat34 !=0){ echo $total8bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql9="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ฝกง.มทบ.32%'";
    $query9=mysql_query($sql9);
	while($rows9=mysql_fetch_array($query9)){
	$age9 = $rows9["subage"];
		if($age9 > 34){
			$personal9=count($rows9["subage"]);
			$num9 = $num9 + $personal9;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows9["stat_bmi"]=="ปกติ" || $rows9["stat_bmi"]=="NULL"){
				$sum9bmi34 =count($rows9["stat_bmi"]);
				$total9bmi34 = $total9bmi34 + $sum9bmi34;
			}else{
				if($rows9["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows9["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum9bmifat34 =count($rows9["reason_bmi"]);
					$total9bmifat34 = $total9bmifat34 + $sum9bmifat34;			
				}else if($rows9["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows9["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum9bmivfat34 =count($rows9["reason_bmi"]);
					$total9bmivfat34 = $total9bmivfat34 + $sum9bmivfat34;						
				}else if($rows9["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum9bmilow34 =count($rows9["reason_bmi"]);
					$total9bmilow34 = $total9bmilow34 + $sum9bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows9["stat_cbc"]=="ผิดปกติ"){
				$sum9cbc34 =count($rows9["stat_cbc"]);
				$total9cbc34 = $total9cbc34 + $sum9cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows9["cxr"]=="ผิดปกติ"){
				$sum9cxr34 =count($rows9["cxr"]);
				$total9cxr34 = $total9cbc34 + $sum9cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows9["stat_ua"]=="ผิดปกติ"){
				$sum9ua34 =count($rows9["stat_ua"]);
				$total9ua34 = $total9ua34 + $sum9ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>     
  <tr>
    <td valign="middle">ฝกง.มทบ.32</td>
    <td align="center" valign="middle"><? $total9=$num9; if($total9 !=0){ echo $total9; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num9 !=0){ echo $num9; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum9=$num9*100/$total9; echo number_format($sum9,2);?></td>
    <td align="center" valign="middle"><? if($total9bmi34 !=0){ echo $total9bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total9bmilow34 !=0){ echo $total9bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total9bmifat34 !=0){ echo $total9bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total9bmivfat34 !=0){ echo $total9bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql10="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ฝสก.มทบ.32%'";
    $query10=mysql_query($sql10);
	while($rows10=mysql_fetch_array($query10)){
	$age10 = $rows10["subage"];
		if($age10 > 34){
			$personal10=count($rows10["subage"]);
			$num10 = $num10 + $personal10;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows10["stat_bmi"]=="ปกติ" || $rows10["stat_bmi"]=="NULL"){
				$sum10bmi34 =count($rows10["stat_bmi"]);
				$total10bmi34 = $total10bmi34 + $sum10bmi34;
			}else{
				if($rows10["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows10["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum10bmifat34 =count($rows10["reason_bmi"]);
					$total10bmifat34 = $total10bmifat34 + $sum10bmifat34;			
				}else if($rows10["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows10["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum10bmivfat34 =count($rows10["reason_bmi"]);
					$total10bmivfat34 = $total10bmivfat34 + $sum10bmivfat34;						
				}else if($rows10["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum10bmilow34 =count($rows10["reason_bmi"]);
					$total10bmilow34 = $total10bmilow34 + $sum10bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows10["stat_cbc"]=="ผิดปกติ"){
				$sum10cbc34 =count($rows10["stat_cbc"]);
				$total10cbc34 = $total10cbc34 + $sum10cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows10["cxr"]=="ผิดปกติ"){
				$sum10cxr34 =count($rows10["cxr"]);
				$total10cxr34 = $total10cbc34 + $sum10cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows10["stat_ua"]=="ผิดปกติ"){
				$sum10ua34 =count($rows10["stat_ua"]);
				$total10ua34 = $total10ua34 + $sum10ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>       
  <tr>
    <td valign="middle">ฝสก.มทบ.32</td>
    <td align="center" valign="middle"><? $total10=$num10; if($total10 !=0){ echo $total10; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num10 !=0){ echo $num10; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum10=$num10*100/$total10; echo number_format($sum10,2);?></td>
    <td align="center" valign="middle"><? if($total10bmi34 !=0){ echo $total10bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total10bmilow34 !=0){ echo $total10bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total10bmifat34 !=0){ echo $total10bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total10bmivfat34 !=0){ echo $total10bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql11="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ผพธ.มทบ.32%'";
    $query11=mysql_query($sql11);
	while($rows11=mysql_fetch_array($query11)){
	$age11 = $rows11["subage"];
		if($age11 > 34){
			$personal11=count($rows11["subage"]);
			$num11 = $num11 + $personal11;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows11["stat_bmi"]=="ปกติ" || $rows11["stat_bmi"]=="NULL"){
				$sum11bmi34 =count($rows11["stat_bmi"]);
				$total11bmi34 = $total11bmi34 + $sum11bmi34;
			}else{
				if($rows11["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows11["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum11bmifat34 =count($rows11["reason_bmi"]);
					$total11bmifat34 = $total11bmifat34 + $sum11bmifat34;			
				}else if($rows11["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows11["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum11bmivfat34 =count($rows11["reason_bmi"]);
					$total11bmivfat34 = $total11bmivfat34 + $sum11bmivfat34;						
				}else if($rows11["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum11bmilow34 =count($rows11["reason_bmi"]);
					$total11bmilow34 = $total11bmilow34 + $sum11bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows11["stat_cbc"]=="ผิดปกติ"){
				$sum11cbc34 =count($rows11["stat_cbc"]);
				$total11cbc34 = $total11cbc34 + $sum11cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows11["cxr"]=="ผิดปกติ"){
				$sum11cxr34 =count($rows11["cxr"]);
				$total11cxr34 = $total11cbc34 + $sum11cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows11["stat_ua"]=="ผิดปกติ"){
				$sum11ua34 =count($rows11["stat_ua"]);
				$total11ua34 = $total11ua34 + $sum11ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>     
  <tr>
    <td valign="middle">ผพธ.มทบ.32</td>
    <td align="center" valign="middle"><? $total11=$num11; if($total11 !=0){ echo $total11; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num11 !=0){ echo $num11; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum11=$num11*100/$total11; echo number_format($sum11,2);?></td>
    <td align="center" valign="middle"><? if($total11bmi34 !=0){ echo $total11bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total11bmilow34 !=0){ echo $total11bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total11bmifat34 !=0){ echo $total11bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total11bmivfat34 !=0){ echo $total11bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql12="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%อก.ศาล มทบ.32%'";
    $query12=mysql_query($sql12);
	while($rows12=mysql_fetch_array($query12)){
	$age12 = $rows12["subage"];
		if($age12 > 34){
			$personal12=count($rows12["subage"]);
			$num12 = $num12 + $personal12;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows12["stat_bmi"]=="ปกติ" || $rows12["stat_bmi"]=="NULL"){
				$sum12bmi34 =count($rows12["stat_bmi"]);
				$total12bmi34 = $total12bmi34 + $sum12bmi34;
			}else{
				if($rows12["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows12["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum12bmifat34 =count($rows12["reason_bmi"]);
					$total12bmifat34 = $total12bmifat34 + $sum12bmifat34;			
				}else if($rows12["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows12["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum12bmivfat34 =count($rows12["reason_bmi"]);
					$total12bmivfat34 = $total12bmivfat34 + $sum12bmivfat34;						
				}else if($rows12["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum12bmilow34 =count($rows12["reason_bmi"]);
					$total12bmilow34 = $total12bmilow34 + $sum12bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows12["stat_cbc"]=="ผิดปกติ"){
				$sum12cbc34 =count($rows12["stat_cbc"]);
				$total12cbc34 = $total12cbc34 + $sum12cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows12["cxr"]=="ผิดปกติ"){
				$sum12cxr34 =count($rows12["cxr"]);
				$total12cxr34 = $total12cbc34 + $sum12cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows12["stat_ua"]=="ผิดปกติ"){
				$sum12ua34 =count($rows12["stat_ua"]);
				$total12ua34 = $total12ua34 + $sum12ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>     
  <tr>
    <td valign="middle">อก.ศาล มทบ.32</td>
    <td align="center" valign="middle"><? $total12=$num12; if($total12 !=0){ echo $total12; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num12 !=0){ echo $num12; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum12=$num12*100/$total12; echo number_format($sum12,2);?></td>
    <td align="center" valign="middle"><? if($total12bmi34 !=0){ echo $total12bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total12bmilow34 !=0){ echo $total12bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total12bmifat34 !=0){ echo $total12bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total12bmivfat34 !=0){ echo $total12bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql13="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%รจ.มทบ.32%'";
    $query13=mysql_query($sql13);
	while($rows13=mysql_fetch_array($query13)){
	$age13 = $rows13["subage"];
		if($age13 > 34){
			$personal13=count($rows13["subage"]);
			$num13 = $num13 + $personal13;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows13["stat_bmi"]=="ปกติ" || $rows13["stat_bmi"]=="NULL"){
				$sum13bmi34 =count($rows13["stat_bmi"]);
				$total13bmi34 = $total13bmi34 + $sum13bmi34;
			}else{
				if($rows13["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows13["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum13bmifat34 =count($rows13["reason_bmi"]);
					$total13bmifat34 = $total13bmifat34 + $sum13bmifat34;			
				}else if($rows13["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows13["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum13bmivfat34 =count($rows13["reason_bmi"]);
					$total13bmivfat34 = $total13bmivfat34 + $sum13bmivfat34;						
				}else if($rows13["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum13bmilow34 =count($rows13["reason_bmi"]);
					$total13bmilow34 = $total13bmilow34 + $sum13bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows13["stat_cbc"]=="ผิดปกติ"){
				$sum13cbc34 =count($rows13["stat_cbc"]);
				$total13cbc34 = $total13cbc34 + $sum13cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows13["cxr"]=="ผิดปกติ"){
				$sum13cxr34 =count($rows13["cxr"]);
				$total13cxr34 = $total13cbc34 + $sum13cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows13["stat_ua"]=="ผิดปกติ"){
				$sum13ua34 =count($rows13["stat_ua"]);
				$total13ua34 = $total13ua34 + $sum13ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>       
  <tr>
    <td valign="middle">รจ.มทบ.32</td>
    <td align="center" valign="middle"><? $total13=$num13; if($total13 !=0){ echo $total13; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num13 !=0){ echo $num13; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum13=$num13*100/$total13; echo number_format($sum13,2);?></td>
    <td align="center" valign="middle"><? if($total13bmi34 !=0){ echo $total13bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total13bmilow34 !=0){ echo $total13bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total13bmifat34 !=0){ echo $total13bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total13bmivfat34 !=0){ echo $total13bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql14="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ฝสวส.มทบ.32%'";
    $query14=mysql_query($sql14);
	while($rows14=mysql_fetch_array($query14)){
	$age14 = $rows14["subage"];
		if($age14 > 34){
			$personal14=count($rows14["subage"]);
			$num14 = $num14 + $personal14;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows14["stat_bmi"]=="ปกติ" || $rows14["stat_bmi"]=="NULL"){
				$sum14bmi34 =count($rows14["stat_bmi"]);
				$total14bmi34 = $total14bmi34 + $sum14bmi34;
			}else{
				if($rows14["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows14["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum14bmifat34 =count($rows14["reason_bmi"]);
					$total14bmifat34 = $total14bmifat34 + $sum14bmifat34;			
				}else if($rows14["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows14["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum14bmivfat34 =count($rows14["reason_bmi"]);
					$total14bmivfat34 = $total14bmivfat34 + $sum14bmivfat34;						
				}else if($rows14["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum14bmilow34 =count($rows14["reason_bmi"]);
					$total14bmilow34 = $total14bmilow34 + $sum14bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows14["stat_cbc"]=="ผิดปกติ"){
				$sum14cbc34 =count($rows14["stat_cbc"]);
				$total14cbc34 = $total14cbc34 + $sum14cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows14["cxr"]=="ผิดปกติ"){
				$sum14cxr34 =count($rows14["cxr"]);
				$total14cxr34 = $total14cbc34 + $sum14cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows14["stat_ua"]=="ผิดปกติ"){
				$sum14ua34 =count($rows14["stat_ua"]);
				$total14ua34 = $total14ua34 + $sum14ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>   
  <tr>
    <td valign="middle">ฝสวส.มทบ.32</td>
    <td align="center" valign="middle"><? $total14=$num14; if($total14 !=0){ echo $total14; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num14 !=0){ echo $num14; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum14=$num14*100/$total14; echo number_format($sum14,2);?></td>
    <td align="center" valign="middle"><? if($total14bmi34 !=0){ echo $total14bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total14bmilow34 !=0){ echo $total14bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total14bmifat34 !=0){ echo $total14bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total14bmivfat34 !=0){ echo $total14bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql15="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ฝธน.มทบ.32%'";
    $query15=mysql_query($sql15);
	while($rows15=mysql_fetch_array($query15)){
	$age15 = $rows15["subage"];
		if($age15 > 34){
			$personal15=count($rows15["subage"]);
			$num15 = $num15 + $personal15;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows15["stat_bmi"]=="ปกติ" || $rows15["stat_bmi"]=="NULL"){
				$sum15bmi34 =count($rows15["stat_bmi"]);
				$total15bmi34 = $total15bmi34 + $sum15bmi34;
			}else{
				if($rows15["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows15["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum15bmifat34 =count($rows15["reason_bmi"]);
					$total15bmifat34 = $total15bmifat34 + $sum15bmifat34;			
				}else if($rows15["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows15["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum15bmivfat34 =count($rows15["reason_bmi"]);
					$total15bmivfat34 = $total15bmivfat34 + $sum15bmivfat34;						
				}else if($rows15["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum15bmilow34 =count($rows15["reason_bmi"]);
					$total15bmilow34 = $total15bmilow34 + $sum15bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows15["stat_cbc"]=="ผิดปกติ"){
				$sum15cbc34 =count($rows15["stat_cbc"]);
				$total15cbc34 = $total15cbc34 + $sum15cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows15["cxr"]=="ผิดปกติ"){
				$sum15cxr34 =count($rows15["cxr"]);
				$total15cxr34 = $total15cbc34 + $sum15cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows15["stat_ua"]=="ผิดปกติ"){
				$sum15ua34 =count($rows15["stat_ua"]);
				$total15ua34 = $total15ua34 + $sum15ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>     
  <tr>
    <td valign="middle">ฝธน.มทบ.32</td>
    <td align="center" valign="middle"><? $total15=$num15; if($total15 !=0){ echo $total15; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num15 !=0){ echo $num15; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum15=$num15*100/$total15; echo number_format($sum15,2);?></td>
    <td align="center" valign="middle"><? if($total15bmi34 !=0){ echo $total15bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total15bmilow34 !=0){ echo $total15bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total15bmifat34 !=0){ echo $total15bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total15bmivfat34 !=0){ echo $total15bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql16="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ฝธน.มทบ.32%'";
    $query16=mysql_query($sql16);
	while($rows16=mysql_fetch_array($query16)){
	$age16 = $rows16["subage"];
		if($age16 > 34){
			$personal16=count($rows16["subage"]);
			$num16 = $num16 + $personal16;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows16["stat_bmi"]=="ปกติ" || $rows16["stat_bmi"]=="NULL"){
				$sum16bmi34 =count($rows16["stat_bmi"]);
				$total16bmi34 = $total16bmi34 + $sum16bmi34;
			}else{
				if($rows16["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows16["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum16bmifat34 =count($rows16["reason_bmi"]);
					$total16bmifat34 = $total16bmifat34 + $sum16bmifat34;			
				}else if($rows16["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows16["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum16bmivfat34 =count($rows16["reason_bmi"]);
					$total16bmivfat34 = $total16bmivfat34 + $sum16bmivfat34;						
				}else if($rows16["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum16bmilow34 =count($rows16["reason_bmi"]);
					$total16bmilow34 = $total16bmilow34 + $sum16bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows16["stat_cbc"]=="ผิดปกติ"){
				$sum16cbc34 =count($rows16["stat_cbc"]);
				$total16cbc34 = $total16cbc34 + $sum16cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows16["cxr"]=="ผิดปกติ"){
				$sum16cxr34 =count($rows16["cxr"]);
				$total16cxr34 = $total16cbc34 + $sum16cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows16["stat_ua"]=="ผิดปกติ"){
				$sum16ua34 =count($rows16["stat_ua"]);
				$total16ua34 = $total16ua34 + $sum16ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>    
  <tr>
    <td valign="middle">อศจ.มทบ.32</td>
    <td align="center" valign="middle"><? $total16=$num16; if($total16 !=0){ echo $total16; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num16 !=0){ echo $num16; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum16=$num16*100/$total16; echo number_format($sum16,2);?></td>
    <td align="center" valign="middle"><? if($total16bmi34 !=0){ echo $total16bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total16bmilow34 !=0){ echo $total16bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total16bmifat34 !=0){ echo $total16bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total16bmivfat34 !=0){ echo $total16bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql17="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ร้อย.มทบ.32%'";
    $query17=mysql_query($sql17);
	while($rows17=mysql_fetch_array($query17)){
	$age17 = $rows17["subage"];
		if($age17 > 34){
			$personal17=count($rows17["subage"]);
			$num17 = $num17 + $personal17;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows17["stat_bmi"]=="ปกติ" || $rows17["stat_bmi"]=="NULL"){
				$sum17bmi34 =count($rows17["stat_bmi"]);
				$total17bmi34 = $total17bmi34 + $sum17bmi34;
			}else{
				if($rows17["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows17["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum17bmifat34 =count($rows17["reason_bmi"]);
					$total17bmifat34 = $total17bmifat34 + $sum17bmifat34;			
				}else if($rows17["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows17["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum17bmivfat34 =count($rows17["reason_bmi"]);
					$total17bmivfat34 = $total17bmivfat34 + $sum17bmivfat34;						
				}else if($rows17["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum17bmilow34 =count($rows17["reason_bmi"]);
					$total17bmilow34 = $total17bmilow34 + $sum17bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows17["stat_cbc"]=="ผิดปกติ"){
				$sum17cbc34 =count($rows17["stat_cbc"]);
				$total17cbc34 = $total17cbc34 + $sum17cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows17["cxr"]=="ผิดปกติ"){
				$sum17cxr34 =count($rows17["cxr"]);
				$total17cxr34 = $total17cbc34 + $sum17cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows17["stat_ua"]=="ผิดปกติ"){
				$sum17ua34 =count($rows17["stat_ua"]);
				$total17ua34 = $total17ua34 + $sum17ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>   
  <tr>
    <td valign="middle">ร้อย.มทบ.32</td>
    <td align="center" valign="middle"><? $total17=$num17; if($total17 !=0){ echo $total17; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num17 !=0){ echo $num17; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum17=$num17*100/$total17; echo number_format($sum17,2);?></td>
    <td align="center" valign="middle"><? if($total17bmi34 !=0){ echo $total17bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total17bmilow34 !=0){ echo $total17bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total17bmifat34 !=0){ echo $total17bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total17bmivfat34 !=0){ echo $total17bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql18="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%สขส.มทบ.32%'";
    $query18=mysql_query($sql18);
	while($rows18=mysql_fetch_array($query18)){
	$age18 = $rows18["subage"];
		if($age18 > 34){
			$personal18=count($rows18["subage"]);
			$num18 = $num18 + $personal18;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows18["stat_bmi"]=="ปกติ" || $rows18["stat_bmi"]=="NULL"){
				$sum18bmi34 =count($rows18["stat_bmi"]);
				$total18bmi34 = $total18bmi34 + $sum18bmi34;
			}else{
				if($rows18["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows18["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum18bmifat34 =count($rows18["reason_bmi"]);
					$total18bmifat34 = $total18bmifat34 + $sum18bmifat34;			
				}else if($rows18["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows18["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum18bmivfat34 =count($rows18["reason_bmi"]);
					$total18bmivfat34 = $total18bmivfat34 + $sum18bmivfat34;						
				}else if($rows18["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum18bmilow34 =count($rows18["reason_bmi"]);
					$total18bmilow34 = $total18bmilow34 + $sum18bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows18["stat_cbc"]=="ผิดปกติ"){
				$sum18cbc34 =count($rows18["stat_cbc"]);
				$total18cbc34 = $total18cbc34 + $sum18cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows18["cxr"]=="ผิดปกติ"){
				$sum18cxr34 =count($rows18["cxr"]);
				$total18cxr34 = $total18cbc34 + $sum18cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows18["stat_ua"]=="ผิดปกติ"){
				$sum18ua34 =count($rows18["stat_ua"]);
				$total18ua34 = $total18ua34 + $sum18ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>     
  <tr>
    <td valign="middle">สขส.มทบ.32</td>
    <td align="center" valign="middle"><? $total18=$num18; if($total18 !=0){ echo $total18; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num18 !=0){ echo $num18; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum18=$num18*100/$total18; echo number_format($sum18,2);?></td>
    <td align="center" valign="middle"><? if($total18bmi34 !=0){ echo $total18bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total18bmilow34 !=0){ echo $total18bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total18bmifat34 !=0){ echo $total18bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total18bmivfat34 !=0){ echo $total18bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql19="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ผยย.มทบ.32%'";
    $query19=mysql_query($sql19);
	while($rows19=mysql_fetch_array($query19)){
	$age19 = $rows19["subage"];
		if($age19 > 34){
			$personal19=count($rows19["subage"]);
			$num19 = $num19 + $personal19;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows19["stat_bmi"]=="ปกติ" || $rows19["stat_bmi"]=="NULL"){
				$sum19bmi34 =count($rows19["stat_bmi"]);
				$total19bmi34 = $total19bmi34 + $sum19bmi34;
			}else{
				if($rows19["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows19["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum19bmifat34 =count($rows19["reason_bmi"]);
					$total19bmifat34 = $total19bmifat34 + $sum19bmifat34;			
				}else if($rows19["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows19["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum19bmivfat34 =count($rows19["reason_bmi"]);
					$total19bmivfat34 = $total19bmivfat34 + $sum19bmivfat34;						
				}else if($rows19["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum19bmilow34 =count($rows19["reason_bmi"]);
					$total19bmilow34 = $total19bmilow34 + $sum19bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows19["stat_cbc"]=="ผิดปกติ"){
				$sum19cbc34 =count($rows19["stat_cbc"]);
				$total19cbc34 = $total19cbc34 + $sum19cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows19["cxr"]=="ผิดปกติ"){
				$sum19cxr34 =count($rows19["cxr"]);
				$total19cxr34 = $total19cbc34 + $sum19cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows19["stat_ua"]=="ผิดปกติ"){
				$sum19ua34 =count($rows19["stat_ua"]);
				$total19ua34 = $total19ua34 + $sum19ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>       
  <tr>
    <td valign="middle">ผยย.มทบ.32</td>
    <td align="center" valign="middle"><? $total19=$num19; if($total19 !=0){ echo $total19; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num19 !=0){ echo $num19; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum19=$num19*100/$total19; echo number_format($sum19,2);?></td>
    <td align="center" valign="middle"><? if($total19bmi34 !=0){ echo $total19bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total19bmilow34 !=0){ echo $total19bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total19bmifat34 !=0){ echo $total19bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total19bmivfat34 !=0){ echo $total19bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql20="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%สส.มทบ.32%'";
    $query20=mysql_query($sql20);
	while($rows20=mysql_fetch_array($query20)){
	$age20 = $rows20["subage"];
		if($age20 > 34){
			$personal20=count($rows20["subage"]);
			$num20 = $num20 + $personal20;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows20["stat_bmi"]=="ปกติ" || $rows20["stat_bmi"]=="NULL"){
				$sum20bmi34 =count($rows20["stat_bmi"]);
				$total20bmi34 = $total20bmi34 + $sum20bmi34;
			}else{
				if($rows20["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows20["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum20bmifat34 =count($rows20["reason_bmi"]);
					$total20bmifat34 = $total20bmifat34 + $sum20bmifat34;			
				}else if($rows20["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows20["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum20bmivfat34 =count($rows20["reason_bmi"]);
					$total20bmivfat34 = $total20bmivfat34 + $sum20bmivfat34;						
				}else if($rows20["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum20bmilow34 =count($rows20["reason_bmi"]);
					$total20bmilow34 = $total20bmilow34 + $sum20bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows20["stat_cbc"]=="ผิดปกติ"){
				$sum20cbc34 =count($rows20["stat_cbc"]);
				$total20cbc34 = $total20cbc34 + $sum20cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows20["cxr"]=="ผิดปกติ"){
				$sum20cxr34 =count($rows20["cxr"]);
				$total20cxr34 = $total20cbc34 + $sum20cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows20["stat_ua"]=="ผิดปกติ"){
				$sum20ua34 =count($rows20["stat_ua"]);
				$total20ua34 = $total20ua34 + $sum20ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>    
  <tr>
    <td valign="middle">สส.มทบ.32</td>
    <td align="center" valign="middle"><? $total20=$num20; if($total20 !=0){ echo $total20; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num20 !=0){ echo $num20; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum20=$num20*100/$total20; echo number_format($sum20,2);?></td>
    <td align="center" valign="middle"><? if($total20bmi34 !=0){ echo $total20bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total20bmilow34 !=0){ echo $total20bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total20bmifat34 !=0){ echo $total20bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total20bmivfat34 !=0){ echo $total20bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql21="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ฝสห.มทบ.32%'";
    $query21=mysql_query($sql21);
	while($rows21=mysql_fetch_array($query21)){
	$age21 = $rows21["subage"];
		if($age21 > 34){
			$personal21=count($rows21["subage"]);
			$num21 = $num21 + $personal21;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows21["stat_bmi"]=="ปกติ" || $rows21["stat_bmi"]=="NULL"){
				$sum21bmi34 =count($rows21["stat_bmi"]);
				$total21bmi34 = $total21bmi34 + $sum21bmi34;
			}else{
				if($rows21["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows21["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum21bmifat34 =count($rows21["reason_bmi"]);
					$total21bmifat34 = $total21bmifat34 + $sum21bmifat34;			
				}else if($rows21["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows21["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum21bmivfat34 =count($rows21["reason_bmi"]);
					$total21bmivfat34 = $total21bmivfat34 + $sum21bmivfat34;						
				}else if($rows21["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum21bmilow34 =count($rows21["reason_bmi"]);
					$total21bmilow34 = $total21bmilow34 + $sum21bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows21["stat_cbc"]=="ผิดปกติ"){
				$sum21cbc34 =count($rows21["stat_cbc"]);
				$total21cbc34 = $total21cbc34 + $sum21cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows21["cxr"]=="ผิดปกติ"){
				$sum21cxr34 =count($rows21["cxr"]);
				$total21cxr34 = $total21cbc34 + $sum21cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows21["stat_ua"]=="ผิดปกติ"){
				$sum21ua34 =count($rows21["stat_ua"]);
				$total21ua34 = $total21ua34 + $sum21ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>     
  <tr>
    <td valign="middle">ฝสห.มทบ.32</td>
    <td align="center" valign="middle"><? $total21=$num21; if($total21 !=0){ echo $total21; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num21 !=0){ echo $num21; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum21=$num21*100/$total21; echo number_format($sum21,2);?></td>
    <td align="center" valign="middle"><? if($total21bmi34 !=0){ echo $total21bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total21bmilow34 !=0){ echo $total21bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total21bmifat34 !=0){ echo $total21bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total21bmivfat34 !=0){ echo $total21bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql22="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ร้อย.สห.มทบ.32%'";
    $query22=mysql_query($sql22);
	while($rows22=mysql_fetch_array($query22)){
	$age22 = $rows22["subage"];
		if($age22 > 34){
			$personal22=count($rows22["subage"]);
			$num22 = $num22 + $personal22;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows22["stat_bmi"]=="ปกติ" || $rows22["stat_bmi"]=="NULL"){
				$sum22bmi34 =count($rows22["stat_bmi"]);
				$total22bmi34 = $total22bmi34 + $sum22bmi34;
			}else{
				if($rows22["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows22["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum22bmifat34 =count($rows22["reason_bmi"]);
					$total22bmifat34 = $total22bmifat34 + $sum22bmifat34;			
				}else if($rows22["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows22["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum22bmivfat34 =count($rows22["reason_bmi"]);
					$total22bmivfat34 = $total22bmivfat34 + $sum22bmivfat34;						
				}else if($rows22["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum22bmilow34 =count($rows22["reason_bmi"]);
					$total22bmilow34 = $total22bmilow34 + $sum22bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows22["stat_cbc"]=="ผิดปกติ"){
				$sum22cbc34 =count($rows22["stat_cbc"]);
				$total22cbc34 = $total22cbc34 + $sum22cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows22["cxr"]=="ผิดปกติ"){
				$sum22cxr34 =count($rows22["cxr"]);
				$total22cxr34 = $total22cbc34 + $sum22cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows22["stat_ua"]=="ผิดปกติ"){
				$sum22ua34 =count($rows22["stat_ua"]);
				$total22ua34 = $total22ua34 + $sum22ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>      
  <tr>
    <td valign="middle">ร้อย.สห.มทบ.32</td>
    <td align="center" valign="middle"><? $total22=$num22; if($total22 !=0){ echo $total22; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num22 !=0){ echo $num22; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum22=$num22*100/$total22; echo number_format($sum22,2);?></td>
    <td align="center" valign="middle"><? if($total22bmi34 !=0){ echo $total22bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total22bmilow34 !=0){ echo $total22bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total22bmifat34 !=0){ echo $total22bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total22bmivfat34 !=0){ echo $total22bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql23="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%มว.ดย.มทบ.32%'";
    $query23=mysql_query($sql23);
	while($rows23=mysql_fetch_array($query23)){
	$age23 = $rows23["subage"];
		if($age23 > 34){
			$personal23=count($rows23["subage"]);
			$num23 = $num23 + $personal23;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows23["stat_bmi"]=="ปกติ" || $rows23["stat_bmi"]=="NULL"){
				$sum23bmi34 =count($rows23["stat_bmi"]);
				$total23bmi34 = $total23bmi34 + $sum23bmi34;
			}else{
				if($rows23["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows23["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum23bmifat34 =count($rows23["reason_bmi"]);
					$total23bmifat34 = $total23bmifat34 + $sum23bmifat34;			
				}else if($rows23["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows23["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum23bmivfat34 =count($rows23["reason_bmi"]);
					$total23bmivfat34 = $total23bmivfat34 + $sum23bmivfat34;						
				}else if($rows23["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum23bmilow34 =count($rows23["reason_bmi"]);
					$total23bmilow34 = $total23bmilow34 + $sum23bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows23["stat_cbc"]=="ผิดปกติ"){
				$sum23cbc34 =count($rows23["stat_cbc"]);
				$total23cbc34 = $total23cbc34 + $sum23cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows23["cxr"]=="ผิดปกติ"){
				$sum23cxr34 =count($rows23["cxr"]);
				$total23cxr34 = $total23cbc34 + $sum23cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows23["stat_ua"]=="ผิดปกติ"){
				$sum23ua34 =count($rows23["stat_ua"]);
				$total23ua34 = $total23ua34 + $sum23ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>      
  <tr>
    <td valign="middle">มว.ดย.มทบ.32</td>
    <td align="center" valign="middle"><? $total23=$num23; if($total23 !=0){ echo $total23; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num23 !=0){ echo $num23; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum23=$num23*100/$total23; echo number_format($sum23,2);?></td>
    <td align="center" valign="middle"><? if($total23bmi34 !=0){ echo $total23bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total23bmilow34 !=0){ echo $total23bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total23bmifat34 !=0){ echo $total23bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total23bmivfat34 !=0){ echo $total23bmivfat34; }else{ echo "0";} ?></td>
  </tr>
	<?
    $sql24="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ผสพ.มทบ.32%'";
    $query24=mysql_query($sql24);
	while($rows24=mysql_fetch_array($query24)){
	$age24 = $rows24["subage"];
		if($age24 > 34){
			$personal24=count($rows24["subage"]);
			$num24 = $num24 + $personal24;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows24["stat_bmi"]=="ปกติ" || $rows24["stat_bmi"]=="NULL"){
				$sum24bmi34 =count($rows24["stat_bmi"]);
				$total24bmi34 = $total24bmi34 + $sum24bmi34;
			}else{
				if($rows24["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows24["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum24bmifat34 =count($rows24["reason_bmi"]);
					$total24bmifat34 = $total24bmifat34 + $sum24bmifat34;			
				}else if($rows24["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows24["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum24bmivfat34 =count($rows24["reason_bmi"]);
					$total24bmivfat34 = $total24bmivfat34 + $sum24bmivfat34;						
				}else if($rows24["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum24bmilow34 =count($rows24["reason_bmi"]);
					$total24bmilow34 = $total24bmilow34 + $sum24bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows24["stat_cbc"]=="ผิดปกติ"){
				$sum24cbc34 =count($rows24["stat_cbc"]);
				$total24cbc34 = $total24cbc34 + $sum24cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows24["cxr"]=="ผิดปกติ"){
				$sum24cxr34 =count($rows24["cxr"]);
				$total24cxr34 = $total24cbc34 + $sum24cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows24["stat_ua"]=="ผิดปกติ"){
				$sum24ua34 =count($rows24["stat_ua"]);
				$total24ua34 = $total24ua34 + $sum24ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>        
  <tr>
    <td valign="middle">ผสพ.มทบ.32</td>
    <td align="center" valign="middle"><? $total24=$num24; if($total24 !=0){ echo $total24; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num24 !=0){ echo $num24; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum24=$num24*100/$total24; echo number_format($sum24,2);?></td>
    <td align="center" valign="middle"><? if($total24bmi34 !=0){ echo $total24bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total24bmilow34 !=0){ echo $total24bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total24bmifat34 !=0){ echo $total24bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total24bmivfat34 !=0){ echo $total24bmivfat34; }else{ echo "0";} ?></td>
  </tr>
  	<?
    $sql25="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%สรรพกำลัง มทบ.32%'";
    $query25=mysql_query($sql25);
	while($rows25=mysql_fetch_array($query25)){
	$age25 = $rows25["subage"];
		if($age25 > 34){
			$personal25=count($rows25["subage"]);
			$num25 = $num25 + $personal25;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows25["stat_bmi"]=="ปกติ" || $rows25["stat_bmi"]=="NULL"){
				$sum25bmi34 =count($rows25["stat_bmi"]);
				$total25bmi34 = $total25bmi34 + $sum25bmi34;
			}else{
				if($rows25["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows25["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum25bmifat34 =count($rows25["reason_bmi"]);
					$total25bmifat34 = $total25bmifat34 + $sum25bmifat34;			
				}else if($rows25["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows25["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum25bmivfat34 =count($rows25["reason_bmi"]);
					$total25bmivfat34 = $total25bmivfat34 + $sum25bmivfat34;						
				}else if($rows25["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum25bmilow34 =count($rows25["reason_bmi"]);
					$total25bmilow34 = $total25bmilow34 + $sum25bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows25["stat_cbc"]=="ผิดปกติ"){
				$sum25cbc34 =count($rows25["stat_cbc"]);
				$total25cbc34 = $total25cbc34 + $sum25cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows25["cxr"]=="ผิดปกติ"){
				$sum25cxr34 =count($rows25["cxr"]);
				$total25cxr34 = $total25cbc34 + $sum25cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows25["stat_ua"]=="ผิดปกติ"){
				$sum25ua34 =count($rows25["stat_ua"]);
				$total25ua34 = $total25ua34 + $sum25ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>        
  <tr>
    <td valign="middle">สรรพกำลัง มทบ.32</td>
    <td align="center" valign="middle"><? $total25=$num25; if($total25 !=0){ echo $total25; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num25 !=0){ echo $num25; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum25=$num25*100/$total25; echo number_format($sum25,2);?></td>
    <td align="center" valign="middle"><? if($total25bmi34 !=0){ echo $total25bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total25bmilow34 !=0){ echo $total25bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total25bmifat34 !=0){ echo $total25bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total25bmivfat34 !=0){ echo $total25bmivfat34; }else{ echo "0";} ?></td>
  </tr>
  	<?
    $sql26="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ศฝ.นศท.มทบ.32%'";
    $query26=mysql_query($sql26);
	while($rows26=mysql_fetch_array($query26)){
	$age26 = $rows26["subage"];
		if($age26 > 34){
			$personal26=count($rows26["subage"]);
			$num26 = $num26 + $personal26;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows26["stat_bmi"]=="ปกติ" || $rows26["stat_bmi"]=="NULL"){
				$sum26bmi34 =count($rows26["stat_bmi"]);
				$total26bmi34 = $total26bmi34 + $sum26bmi34;
			}else{
				if($rows26["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows26["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum26bmifat34 =count($rows26["reason_bmi"]);
					$total26bmifat34 = $total26bmifat34 + $sum26bmifat34;			
				}else if($rows26["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows26["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum26bmivfat34 =count($rows26["reason_bmi"]);
					$total26bmivfat34 = $total26bmivfat34 + $sum26bmivfat34;						
				}else if($rows26["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum26bmilow34 =count($rows26["reason_bmi"]);
					$total26bmilow34 = $total26bmilow34 + $sum26bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows26["stat_cbc"]=="ผิดปกติ"){
				$sum26cbc34 =count($rows26["stat_cbc"]);
				$total26cbc34 = $total26cbc34 + $sum26cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows26["cxr"]=="ผิดปกติ"){
				$sum26cxr34 =count($rows26["cxr"]);
				$total26cxr34 = $total26cbc34 + $sum26cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows26["stat_ua"]=="ผิดปกติ"){
				$sum26ua34 =count($rows26["stat_ua"]);
				$total26ua34 = $total26ua34 + $sum26ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
	?>  
  <tr>
    <td valign="middle">ศฝ.นศท.มทบ.32</td>
    <td align="center" valign="middle"><? $total26=$num26+2; if($total26 !=0){ echo $total26; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num26 !=0){ echo $num26; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum26=$num26*100/$total26; echo number_format($sum26,2);?></td>
    <td align="center" valign="middle"><? if($total26bmi34 !=0){ echo $total26bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total26bmilow34 !=0){ echo $total26bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total26bmifat34 !=0){ echo $total26bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total26bmivfat34 !=0){ echo $total26bmivfat34; }else{ echo "0";} ?></td>
  </tr>
<?
    $sql27="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ศาล.มทบ.32%'";
    $query27=mysql_query($sql27);
	while($rows27=mysql_fetch_array($query27)){
	$age27 = $rows27["subage"];
		if($age27 > 34){
			$personal27=count($rows27["subage"]);
			$num27 = $num27 + $personal27;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows27["stat_bmi"]=="ปกติ" || $rows27["stat_bmi"]=="NULL"){
				$sum27bmi34 =count($rows27["stat_bmi"]);
				$total27bmi34 = $total27bmi34 + $sum27bmi34;
			}else{
				if($rows27["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows27["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum27bmifat34 =count($rows27["reason_bmi"]);
					$total27bmifat34 = $total27bmifat34 + $sum27bmifat34;			
				}else if($rows27["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows27["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum27bmivfat34 =count($rows27["reason_bmi"]);
					$total27bmivfat34 = $total27bmivfat34 + $sum27bmivfat34;						
				}else if($rows27["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum27bmilow34 =count($rows27["reason_bmi"]);
					$total27bmilow34 = $total27bmilow34 + $sum27bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows27["stat_cbc"]=="ผิดปกติ"){
				$sum27cbc34 =count($rows27["stat_cbc"]);
				$total27cbc34 = $total27cbc34 + $sum27cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows27["cxr"]=="ผิดปกติ"){
				$sum27cxr34 =count($rows27["cxr"]);
				$total27cxr34 = $total27cbc34 + $sum27cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows27["stat_ua"]=="ผิดปกติ"){
				$sum27ua34 =count($rows27["stat_ua"]);
				$total27ua34 = $total27ua34 + $sum27ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
?>
  <tr>
    <td valign="middle">ศาล.มทบ.32</td>
    <td align="center" valign="middle"><? $total27=$num27; if($total27 !=0){ echo $total27; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num27 !=0){ echo $num27; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum27=$num27*100/$total27; echo number_format($sum27,2);?></td>
    <td align="center" valign="middle"><? if($total27bmi34 !=0){ echo $total27bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total27bmilow34 !=0){ echo $total27bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total27bmifat34 !=0){ echo $total27bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total27bmivfat34 !=0){ echo $total27bmivfat34; }else{ echo "0";} ?></td>
  </tr>
<?
    $sql28="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ศูนย์โทรศัพท์%'";
    $query28=mysql_query($sql28);
	while($rows28=mysql_fetch_array($query28)){
	$age28 = $rows28["subage"];
		if($age28 > 34){
			$personal28=count($rows28["subage"]);
			$num28 = $num28 + $personal28;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows28["stat_bmi"]=="ปกติ" || $rows28["stat_bmi"]=="NULL"){
				$sum28bmi34 =count($rows28["stat_bmi"]);
				$total28bmi34 = $total28bmi34 + $sum28bmi34;
			}else{
				if($rows28["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows28["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum28bmifat34 =count($rows28["reason_bmi"]);
					$total28bmifat34 = $total28bmifat34 + $sum28bmifat34;			
				}else if($rows28["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows28["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum28bmivfat34 =count($rows28["reason_bmi"]);
					$total28bmivfat34 = $total28bmivfat34 + $sum28bmivfat34;						
				}else if($rows28["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum28bmilow34 =count($rows28["reason_bmi"]);
					$total28bmilow34 = $total28bmilow34 + $sum28bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows28["stat_cbc"]=="ผิดปกติ"){
				$sum28cbc34 =count($rows28["stat_cbc"]);
				$total28cbc34 = $total28cbc34 + $sum28cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows28["cxr"]=="ผิดปกติ"){
				$sum28cxr34 =count($rows28["cxr"]);
				$total28cxr34 = $total28cbc34 + $sum28cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows28["stat_ua"]=="ผิดปกติ"){
				$sum28ua34 =count($rows28["stat_ua"]);
				$total28ua34 = $total28ua34 + $sum28ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
?>  
  <tr>
    <td valign="middle">ศูนย์โทรศัพท์ มทบ.32</td>
    <td align="center" valign="middle"><? $total28=$num28; if($total28 !=0){ echo $total28; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num28 !=0){ echo $num28; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum28=$num28*100/$total28; echo number_format($sum28,2);?></td>
    <td align="center" valign="middle"><? if($total28bmi34 !=0){ echo $total28bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total28bmilow34 !=0){ echo $total28bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total28bmifat34 !=0){ echo $total28bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total28bmivfat34 !=0){ echo $total28bmivfat34; }else{ echo "0";} ?></td>
  </tr>
<?
    $sql29="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ผปบ.มทบ.32%'";
    $query29=mysql_query($sql29);
	while($rows29=mysql_fetch_array($query29)){
	$age29 = $rows29["subage"];
		if($age29 > 34){
			$personal29=count($rows29["subage"]);
			$num29 = $num29 + $personal29;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows29["stat_bmi"]=="ปกติ" || $rows29["stat_bmi"]=="NULL"){
				$sum29bmi34 =count($rows29["stat_bmi"]);
				$total29bmi34 = $total29bmi34 + $sum29bmi34;
			}else{
				if($rows29["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows29["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum29bmifat34 =count($rows29["reason_bmi"]);
					$total29bmifat34 = $total29bmifat34 + $sum29bmifat34;			
				}else if($rows29["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows29["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum29bmivfat34 =count($rows29["reason_bmi"]);
					$total29bmivfat34 = $total29bmivfat34 + $sum29bmivfat34;						
				}else if($rows29["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum29bmilow34 =count($rows29["reason_bmi"]);
					$total29bmilow34 = $total29bmilow34 + $sum29bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows29["stat_cbc"]=="ผิดปกติ"){
				$sum29cbc34 =count($rows29["stat_cbc"]);
				$total29cbc34 = $total29cbc34 + $sum29cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows29["cxr"]=="ผิดปกติ"){
				$sum29cxr34 =count($rows29["cxr"]);
				$total29cxr34 = $total29cbc34 + $sum29cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows29["stat_ua"]=="ผิดปกติ"){
				$sum29ua34 =count($rows29["stat_ua"]);
				$total29ua34 = $total29ua34 + $sum29ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
?>  
  <tr>
    <td valign="middle">ผปบ.มทบ.32</td>
    <td align="center" valign="middle"><? $total29=$num29; if($total29 !=0){ echo $total29; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num29 !=0){ echo $num29; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum29=$num29*100/$total29; echo number_format($sum29,2);?></td>
    <td align="center" valign="middle"><? if($total29bmi34 !=0){ echo $total29bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total29bmilow34 !=0){ echo $total29bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total29bmifat34 !=0){ echo $total29bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total29bmivfat34 !=0){ echo $total29bmivfat34; }else{ echo "0";} ?></td>
  </tr>
<?
    $sql30="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ค่ายสุรศักดิ์มนตรี%'";
    $query30=mysql_query($sql30);
	while($rows30=mysql_fetch_array($query30)){
	$age30 = $rows30["subage"];
		if($age30 > 34){
			$personal30=count($rows30["subage"]);
			$num30 = $num30 + $personal30;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows30["stat_bmi"]=="ปกติ" || $rows30["stat_bmi"]=="NULL"){
				$sum30bmi34 =count($rows30["stat_bmi"]);
				$total30bmi34 = $total30bmi34 + $sum30bmi34;
			}else{
				if($rows30["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows30["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum30bmifat34 =count($rows30["reason_bmi"]);
					$total30bmifat34 = $total30bmifat34 + $sum30bmifat34;			
				}else if($rows30["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows30["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum30bmivfat34 =count($rows30["reason_bmi"]);
					$total30bmivfat34 = $total30bmivfat34 + $sum30bmivfat34;						
				}else if($rows30["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum30bmilow34 =count($rows30["reason_bmi"]);
					$total30bmilow34 = $total30bmilow34 + $sum30bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows30["stat_cbc"]=="ผิดปกติ"){
				$sum30cbc34 =count($rows30["stat_cbc"]);
				$total30cbc34 = $total30cbc34 + $sum30cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows30["cxr"]=="ผิดปกติ"){
				$sum30cxr34 =count($rows30["cxr"]);
				$total30cxr34 = $total30cbc34 + $sum30cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows30["stat_ua"]=="ผิดปกติ"){
				$sum30ua34 =count($rows30["stat_ua"]);
				$total30ua34 = $total30ua34 + $sum30ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
?>    
  <tr>
    <td valign="middle">รพ.ค่ายสุรศักดิ์มนตรี</td>
    <td align="center" valign="middle"><? $total30=$num30+28; if($total30 !=0){ echo $total30; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num30 !=0){ echo $num30+1; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum30=$num30*100/$total30; echo number_format($sum30,2);?></td>
    <td align="center" valign="middle"><? if($total30bmi34 !=0){ echo $total30bmi34+1; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total30bmilow34 !=0){ echo $total30bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total30bmifat34 !=0){ echo $total30bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total30bmivfat34 !=0){ echo $total30bmivfat34; }else{ echo "0";} ?></td>
  </tr>
<?
    $sql31="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ช.พัน4%'";
    $query31=mysql_query($sql31);
	while($rows31=mysql_fetch_array($query31)){
	$age31 = $rows31["subage"];
		if($age31 > 34){
			$personal31=count($rows31["subage"]);
			$num31 = $num31 + $personal31;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows31["stat_bmi"]=="ปกติ" || $rows31["stat_bmi"]=="NULL"){
				$sum31bmi34 =count($rows31["stat_bmi"]);
				$total31bmi34 = $total31bmi34 + $sum31bmi34;
			}else{
				if($rows31["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows31["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum31bmifat34 =count($rows31["reason_bmi"]);
					$total31bmifat34 = $total31bmifat34 + $sum31bmifat34;			
				}else if($rows31["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows31["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum31bmivfat34 =count($rows31["reason_bmi"]);
					$total31bmivfat34 = $total31bmivfat34 + $sum31bmivfat34;						
				}else if($rows31["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum31bmilow34 =count($rows31["reason_bmi"]);
					$total31bmilow34 = $total31bmilow34 + $sum31bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows31["stat_cbc"]=="ผิดปกติ"){
				$sum31cbc34 =count($rows31["stat_cbc"]);
				$total31cbc34 = $total31cbc34 + $sum31cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows31["cxr"]=="ผิดปกติ"){
				$sum31cxr34 =count($rows31["cxr"]);
				$total31cxr34 = $total31cbc34 + $sum31cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows31["stat_ua"]=="ผิดปกติ"){
				$sum31ua34 =count($rows31["stat_ua"]);
				$total31ua34 = $total31ua34 + $sum31ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
?>      
  <tr>
    <td valign="middle">ช.พัน4</td>
    <td align="center" valign="middle"><? $total31=$num31+6; if($total31 !=0){ echo $total31; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num31 !=0){ echo $num31; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum31=$num31*100/$total31; echo number_format($sum31,2);?></td>
    <td align="center" valign="middle"><? if($total31bmi34 !=0){ echo $total31bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total31bmilow34 !=0){ echo $total31bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total31bmifat34 !=0){ echo $total31bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total31bmivfat34 !=0){ echo $total31bmivfat34; }else{ echo "0";} ?></td>
  </tr>
<?
    $sql32="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%ร้อยฝึกรบพิเศษประตูผา%'";
    $query32=mysql_query($sql32);
	while($rows32=mysql_fetch_array($query32)){
	$age32 = $rows32["subage"];
		if($age32 > 34){
			$personal32=count($rows32["subage"]);
			$num32 = $num32 + $personal32;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows32["stat_bmi"]=="ปกติ" || $rows32["stat_bmi"]=="NULL"){
				$sum32bmi34 =count($rows32["stat_bmi"]);
				$total32bmi34 = $total32bmi34 + $sum32bmi34;
			}else{
				if($rows32["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows32["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum32bmifat34 =count($rows32["reason_bmi"]);
					$total32bmifat34 = $total32bmifat34 + $sum32bmifat34;			
				}else if($rows32["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows32["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum32bmivfat34 =count($rows32["reason_bmi"]);
					$total32bmivfat34 = $total32bmivfat34 + $sum32bmivfat34;						
				}else if($rows32["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum32bmilow34 =count($rows32["reason_bmi"]);
					$total32bmilow34 = $total32bmilow34 + $sum32bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows32["stat_cbc"]=="ผิดปกติ"){
				$sum32cbc34 =count($rows32["stat_cbc"]);
				$total32cbc34 = $total32cbc34 + $sum32cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows32["cxr"]=="ผิดปกติ"){
				$sum32cxr34 =count($rows32["cxr"]);
				$total32cxr34 = $total32cbc34 + $sum32cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows32["stat_ua"]=="ผิดปกติ"){
				$sum32ua34 =count($rows32["stat_ua"]);
				$total32ua34 = $total32ua34 + $sum32ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
?>   
  <tr>
    <td valign="middle">ร้อยฝึกรบพิเศษประตูผา</td>
    <td align="center" valign="middle"><? $total32=$num32; if($total32 !=0){ echo $total32; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num32 !=0){ echo $num32; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum32=$num32*100/$total32; echo number_format($sum32,2);?></td>
    <td align="center" valign="middle"><? if($total32bmi34 !=0){ echo $total32bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total32bmilow34 !=0){ echo $total32bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total32bmifat34 !=0){ echo $total32bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total32bmivfat34 !=0){ echo $total32bmivfat34; }else{ echo "0";} ?></td>
  </tr>
<?
    $sql33="SELECT camp, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, stat_cbc, cxr, stat_ua
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%' AND camp like '%สัสดีจังหวัดลำปาง%'";
    $query33=mysql_query($sql33);
	while($rows33=mysql_fetch_array($query33)){
	$age33 = $rows33["subage"];
		if($age33 > 34){
			$personal33=count($rows33["subage"]);
			$num33 = $num33 + $personal33;
			//------------------ ดัชนีมวลกาย -------------------------//	   
			if($rows33["stat_bmi"]=="ปกติ" || $rows33["stat_bmi"]=="NULL"){
				$sum33bmi34 =count($rows33["stat_bmi"]);
				$total33bmi34 = $total33bmi34 + $sum33bmi34;
			}else{
				if($rows33["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" || $rows33["reason_bmi"]=="ท่านเริ่มมีภาวะน้ำหนักเกิน"){
					$sum33bmifat34 =count($rows33["reason_bmi"]);
					$total33bmifat34 = $total33bmifat34 + $sum33bmifat34;			
				}else if($rows33["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows33["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
					$sum33bmivfat34 =count($rows33["reason_bmi"]);
					$total33bmivfat34 = $total33bmivfat34 + $sum33bmivfat34;						
				}else if($rows33["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
					$sum33bmilow34 =count($rows33["reason_bmi"]);
					$total33bmilow34 = $total33bmilow34 + $sum33bmilow34;				
				}	
			}
			//------------------ จบดัชนีมวลกาย -------------------------//	
			
			//------------------ CBC -------------------------//	   
			if($rows33["stat_cbc"]=="ผิดปกติ"){
				$sum33cbc34 =count($rows33["stat_cbc"]);
				$total33cbc34 = $total33cbc34 + $sum33cbc34;
			} 
			//------------------ จบCBC -------------------------//		
			
			//------------------ CXR -------------------------//	   
			if($rows33["cxr"]=="ผิดปกติ"){
				$sum33cxr34 =count($rows33["cxr"]);
				$total33cxr34 = $total33cbc34 + $sum33cxr34;
			}
			//------------------ จบCXR -------------------------//	
			
			//------------------ UA -------------------------//	   
			if($rows33["stat_ua"]=="ผิดปกติ"){
				$sum33ua34 =count($rows33["stat_ua"]);
				$total33ua34 = $total33ua34 + $sum33ua34;
			}
			//------------------ จบUA -------------------------//		
													
		}
	}
?>     
  <tr>
    <td valign="middle">สัสดีจังหวัดลำปาง</td>
    <td align="center" valign="middle"><? $total33=$num33+2; if($total33 !=0){ echo $total33; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($num33 !=0){ echo $num33; }else{ echo "0";}?></td>
    <td align="right" valign="middle"><? $sum33=$num33*100/$total33; echo number_format($sum33,2);?></td>
    <td align="center" valign="middle"><? if($total33bmi34 !=0){ echo $total33bmi34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total33bmilow34 !=0){ echo $total33bmilow34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total33bmifat34 !=0){ echo $total33bmifat34; }else{ echo "0";} ?></td>
    <td align="center" valign="middle"><? if($total33bmivfat34 !=0){ echo $total33bmivfat34; }else{ echo "0";} ?></td>
  </tr>
</table>
