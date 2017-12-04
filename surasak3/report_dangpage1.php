<?php
    include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style1 {
	font-size: 20px;
	font-weight: bold;
}
-->
</style>
<table width="100%" border="0">
  <tr>
    <td colspan="3" align="center" valign="middle"><span class="style1">แบบสรุปรายงานการตรวจสุขภาพประจำปี 2557</span></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="middle"><span class="style1">หน่วย ร.พ.ค่ายสุรศักดิ์มนตรี</span></td>
  </tr>
  <tr>
    <td width="3%" align="right" valign="middle">1. </td>
    <td colspan="2" valign="middle">จำนวนหน่วยทหารในความรับผิดชอบ ทั้งหมด 33 หน่วย</td>
  </tr>
	<?
    $sql="SELECT age, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, summary 
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%'";
    $query=mysql_query($sql);
	$num=mysql_num_rows($query);
   // echo $sql;
    $i=0;
    while($rows=mysql_fetch_array($query)){
    $i++;
    $age = $rows["subage"];
    if($age >= 35){
    $sum35 =count($age);
    $total35 = $total35 + $sum35;
    //echo "$i || 35 || $sum35 <br />";

		//------------------ ดัชนีมวลกาย -------------------------//	
		if($rows["stat_bmi"]=="ปกติ"){
			$sumbmi35 =count($rows["stat_bmi"]);
			$totalbmi35 = $totalbmi35 + $sumbmi35;
		}else{  // ผิดปกติ
			if($rows["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน"){
				$sumbmifat35 =count($rows["reason_bmi"]);
				$totalbmifat35 = $totalbmifat35 + $sumbmifat35;			
			}else if($rows["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
				$sumbmivfat35 =count($rows["reason_bmi"]);
				$totalbmivfat35 = $totalbmivfat35 + $sumbmivfat35;						
			}else if($rows["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
				$sumbmilow35 =count($rows["reason_bmi"]);
				$totalbmilow35 = $totalbmilow35 + $sumbmilow35;					
			}
		}  // close else ผิดปกติ
		//------------------ จบดัชนีมวลกาย -------------------------//			
		
		//------------------ ผลการตรวจสุขภาพ -------------------------//
		if($rows["summary"]=="ปกติ" || $rows["summary"]==""){
			$summary35 =count($rows["summary"]);
			$totalsummary35 = $totalsummary35 + $summary35;
		}else{  // ผิดปกติ
			$summaryesc35 =count($rows["summary"]);
			$totalsummaryesc35 = $totalsummaryesc35 + $summaryesc35;		
		}  // close else ผิดปกติ
		//------------------ จบผลการตรวจสุขภาพ -------------------------//				
		
    }else{  // else age 34
    $sum34=count($age);
    $total34 = $total34 + $sum34;
   // echo "$i || 34 || $sum34 <br />";
 
		//------------------ ดัชนีมวลกาย -------------------------//	   
		if($rows["stat_bmi"]=="ปกติ" || $rows["stat_bmi"]=="NULL"){
			$sumbmi34 =count($rows["stat_bmi"]);
			$totalbmi34 = $totalbmi34 + $sumbmi34;
		}else{
			if($rows["reason_bmi"]=="ท่านมีน้ำหนักเกินหรือภาวะอ้วน"){
				$sumbmifat34 =count($rows["reason_bmi"]);
				$totalbmifat34 = $totalbmifat34 + $sumbmifat34;			
			}else if($rows["reason_bmi"]=="ท่านมีภาวะอ้วนค่อนข้างมาก" || $rows["reason_bmi"]=="ท่านมีภาวะอ้วนรุนแรง"){
				$sumbmivfat34 =count($rows["reason_bmi"]);
				$totalbmivfat34 = $totalbmivfat34 + $sumbmivfat34;						
			}else if($rows["reason_bmi"]=="ท่านมีน้ำหนักน้อยเกินไป"){
				$sumbmilow34 =count($rows["reason_bmi"]);
				$totalbmilow34 = $totalbmilow34 + $sumbmilow34;				
			}	
		}  // close else ผิดปกติ
		//------------------ จบดัชนีมวลกาย -------------------------//			
		
		//------------------ ผลการตรวจสุขภาพ -------------------------//
		if($rows["summary"]=="ปกติ" || $rows["summary"]==""){
			$summary34 =count($rows["summary"]);
			$totalsummary34 = $totalsummary34 + $summary34;
		}else{  // ผิดปกติ
			$summaryesc34 =count($rows["summary"]);
			$totalsummaryesc34 = $totalsummaryesc34 + $summaryesc34;		
		}  // close else ผิดปกติ
		//------------------ จบผลการตรวจสุขภาพ -------------------------//		
		
				
    }  //close age 34
    }  // close while
    //echo "==>$total35 <br />";
   // echo "-->$total34 <br />";
    ?>    
  <tr>
    <td align="right" valign="middle">2. </td>
    <td colspan="2" valign="middle">จำนวนกำลังพล ทบ. ทั้งหมด <strong><?=$total=$num+57;?></strong> นาย แบ่งเป็น</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td width="4%" align="right" valign="middle">2.1 </td>
    <td width="93%" valign="middle">กำลังพลที่มีอายุตั้งแต่ 35 ปีขึ้นไป&nbsp;&nbsp;จำนวน <strong><?=$total35+37;?></strong> นาย</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">2.2 </td>
    <td valign="middle">กำลังพลที่มีอายุน้อยกว่า 35 ปี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน <strong><?=$total34+20;?></strong> นาย</td>
  </tr>
  <tr>
    <td align="right" valign="middle">3. </td>
    <td colspan="2" align="left" valign="middle">จำนวนกำลังพลที่เข้ารับการการตรวจสุขภาพ ทั้งสิ้น <strong><?=$num;?></strong> นาย&nbsp;&nbsp;คิดเป็นร้อยละ <strong><? $percen=$num*100/$total; echo number_format($percen,2); ?></strong> แบ่งเป็น</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">3.1 </td>
    <td width="93%" valign="middle">กำลังพลที่มีอายุตั้งแต่ 35 ปีขึ้นไป&nbsp;&nbsp;จำนวน <strong><?=$total35; ?></strong> นาย&nbsp;&nbsp;คิดเป็นร้อยละ <strong><? $percen35=$total35*100/$num; echo number_format($percen35,2); ?></strong></td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">3.2 </td>
    <td valign="middle">กำลังพลที่มีอายุน้อยกว่า 35 ปี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน <strong><?=$total34; ?></strong> นาย&nbsp;&nbsp;คิดเป็นร้อยละ <strong><? $percen34=$total34*100/$num; echo number_format($percen34,2); ?></strong></td>
  </tr>
  <tr>
    <td align="right" valign="middle">4. </td>
    <td colspan="2" align="left" valign="middle">ค่าดัชนีมวลกาย</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">4.1 </td>
    <td valign="middle">กำลังพลที่มีอายุตั้งแต่ 35 ปีขึ้นไป&nbsp;&nbsp;ปกติ จำนวน <strong>
      315
      </strong> นาย&nbsp;&nbsp;น้อยกว่าปกติ จำนวน<strong>
      6
      </strong>นาย&nbsp;&nbsp;น้ำหนักเกิน จำนวน <strong>
      390
      </strong> นาย&nbsp;&nbsp;อ้วน จำนวน<strong>
      37
    </strong>นาย</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">4.2 </td>
    <td valign="middle">กำลังพลที่มีอายุน้อยกว่า 35 ปี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ปกติ จำนวน <strong>
    171
    </strong> นาย&nbsp;&nbsp;น้อยกว่าปกติ จำนวน<strong>
    7
    </strong>นาย&nbsp;&nbsp;น้ำหนักเกิน จำนวน <strong>
    131
    </strong> นาย&nbsp;&nbsp;อ้วน จำนวน<strong>
    15
    </strong>นาย</td>
  </tr>
  
  <tr>
    <td align="right" valign="middle">5. </td>
    <td colspan="2" align="left" valign="middle">ผลการตรวจสุขภาพประจำปี</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">5.1 </td>
    <td valign="middle">กำลังพลที่มีผลการตรวจสุขภาพปกติ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน <strong>
      <?=$totalsummary35+$totalsummary34; ?>
    </strong>นาย</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">&nbsp;</td>
    <td valign="middle">5.1.1 กำลังพลที่มีอายุตั้งแต่ 35 ปีขึ้นไป&nbsp;&nbsp;จำนวน <strong>
    <?=$totalsummary35; ?>
    </strong> นาย</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">&nbsp;</td>
    <td valign="middle">5.1.2 กำลังพลที่มีอายุน้อยกว่า 35 ปี&nbsp;&nbsp; &nbsp;&nbsp;จำนวน <strong>
    <?=$totalsummary34; ?>
    </strong> นาย</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">5.2 </td>
    <td valign="middle">กำลังพลที่มีผลการตรวจสุขภาพผิดปกติ &nbsp;&nbsp;จำนวน <strong>
      <?=$totalsummaryesc35+$totalsummaryesc34; ?>
    </strong>นาย</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">&nbsp;</td>
    <td valign="middle">5.2.1 กำลังพลที่มีอายุตั้งแต่ 35 ปีขึ้นไป&nbsp;&nbsp;จำนวน <strong>
      <?=$totalsummaryesc35; ?>
    </strong> นาย</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">&nbsp;</td>
    <td valign="middle">5.2.2 กำลังพลที่มีอายุน้อยกว่า 35 ปี&nbsp;&nbsp; &nbsp;&nbsp;จำนวน <strong>
      <?=$totalsummaryesc34; ?>
    </strong> นาย</td>
  </tr>
  
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">&nbsp;</td>
    <td valign="middle">&nbsp;</td>
  </tr>
</table>
