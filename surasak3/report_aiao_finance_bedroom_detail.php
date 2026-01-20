<?php
session_start();
require_once 'connect.php';

// รับค่าจาก Form
$chkdate1 = $_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2 = $_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

// กำหนดชื่อแผนก
$depart_name="ค่าห้อง/ค่าอาหาร";

// SQL Query แบบเดิม
$sql = "SELECT 
    ipc.*,
    DATE(rep.`date`) AS ip_date,
    DATE(rep.`dcdate`) AS dc_date,
    rep.`hn`,
    rep.`an`,
    rep.`ptname`,
    rep.`days`,
    rep.`price`,
    rep.`paid`,
    rep.`bfy`,
    rep.`bfn`,
    rep.`billno`,
    rep.`credit`,
    rep.`credit_detail`
FROM `ipcard` AS ipc
INNER JOIN (
    SELECT *
    FROM `ipmonrep`
    WHERE `days` != '0'
      AND `bfy` != '0.00'
      AND `credit` != ''
    GROUP BY `an` 
) AS rep ON ipc.`an` = rep.`an`
WHERE ipc.`dcdate` BETWEEN '$chkdate1' AND '$chkdate2'
  AND ipc.`days` != '0'
ORDER BY ip_date ASC";
//echo $sql;
$result = mysql_query($sql) or die(mysql_error());
$list_data = array();

while($row = mysql_fetch_array($result)){
	
$date_part = substr($row['ip_date'], 0, 10); // ตัดเอาเฉพาะ "2568-01-01"
$ex_date = explode("-", $date_part); 
$formatted_date = $ex_date[2]."/".$ex_date[1]."/".$ex_date[0]; // จะได้ "01/01/2568"

    // เก็บข้อมูลลง Array เพื่อไปวน Loop แสดงผล
    $list_data[] = array(
        "date" => $formatted_date,
        "hn"   => $row['hn'],
        "an"   => $row['an'],
		"name" => $row['ptname'],
		"days" => $row['days'],
		"bfy" => $row['bfy'],
		"bfn" => $row['bfn'],
		"my_food" => $row['my_food'],
        "cr"   => $showcredit,
        "amt"  => $claim
    );
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายงานส่งAudit <?=$depart_name;?></title>
    <style>
        body { font-family: TH SarabunPSK; font-size: 22px; }
        table { border-collapse: collapse; width: 90%; margin: 0 auto; }
        th, td { border: 1px solid #000; padding: 3px 8px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>    
</head>
<body>

<div style="text-align: center; font-weight: bold;">
    ลูกหนี้หมวด <?=$depart_name;?><br>
    โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง
</div>

<table>
    <thead>
        <tr style="font-weight: bold; background: #eee;">
            <td class="text-center" width="5%">#</td>
            <td class="text-center" width="12%">วันที่</td>
			<td class="text-center" width="10%">HN</td>
			<td class="text-center" width="10%">AN</td>
            <td class="text-center">ชื่อ - สกุล</td>
			<td class="text-center" width="6%">วันนอน</td>
            <td class="text-center" width="8%">ประเภท</td>
            <td class="text-center" width="8%">ค่าห้องเบิกได้</td>
			<td class="text-center" width="8%">ค่าห้องส่วนเกิน</td>			
			<td class="text-center" width="8%">รวมทั้งสิ้น</td>
			<td class="text-center" width="10%">ค่าห้อง</td>
			<td class="text-center" width="10%">ค่าอาหาร</td>
			
			
        </tr>
    </thead>
    <tbody>
        <?php
        $num = 0;
        $sumtotal = 0;
		
        if(count($list_data) > 0){
            foreach ($list_data as $item) {
                $num++;
                $sumtotal += $item['amt']; // บวกยอดเงินรวม
				$sumroom = $item['bfy']+$item['bfn'];
			
			$chk_bed=$item['bfy']/$item['days'];
			$chk_bed=number_format($chk_bed, 2);
			
			if($chk_bed=="400.00"){
				$showroom="สามัญ";
			}else{
				$showroom="พิเศษ";
			}
			$food=	$item['days']*200;
			$bed=	$sumroom-$food;
        ?>
            <tr>
                <td class="text-center"><?=$num;?></td>
                <td class="text-center"><?=$item['date'];?></td>
                <td class="text-center"><?=$item['hn'];?></td>
				 <td class="text-center"><?=$item['an'];?></td>
                <td><?=$item['name'];?></td>
				<td class="text-center"><?=$item['days'];?></td>
                <td class="text-center"><?=$showroom;?></td>
				<td class="text-right"><?=number_format($item['bfy'], 2);?></td>
				<td class="text-right"><?=number_format($item['bfn'], 2);?></td>				
                <td class="text-right"><?=number_format($sumroom, 2);?></td>
				<td class="text-right"><?=number_format($bed, 2);?></td>
				<td class="text-right"><?=number_format($food, 2);?></td>
            </tr>
        <?php 
            } // end foreach
        } else {
            echo "<tr><td colspan='6' class='text-center'>--- ไม่พบข้อมูลในช่วงเวลาที่เลือก ---</td></tr>";
        }
        ?>
    </tbody>
    <!--tfoot>
        <tr style="font-weight: bold;">
            <td colspan="5" class="text-right">รวมทั้งหมด</td>
            <td class="text-right"><?=number_format($sumtotal, 2);?></td>
        </tr>
    </tfoot-->
</table>

</body>
</html>